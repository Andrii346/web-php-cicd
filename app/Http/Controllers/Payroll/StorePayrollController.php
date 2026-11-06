<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payroll\StorePayrollRequest;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\PayrollComponent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class StorePayrollController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StorePayrollRequest $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validated();
        $employee = Employee::findOrFail((int) $validated['employee_id']);

        $standardDays = 22;
        $workedDays = (int) $validated['worked_days'];
        $baseSalary = round(($employee->base_salary / $standardDays) * $workedDays, 2);
        $bonus = isset($validated['bonus']) ? (float) $validated['bonus'] : 0.00;

        $syncData = [];
        $allowancesTotal = 0.00;
        $deductionsTotal = 0.00;

        if (! empty($validated['components'])) {
            $componentModels = PayrollComponent::whereIn('id', collect($validated['components'])->pluck('id'))->get()->keyBy('id');

            foreach ($validated['components'] as $item) {
                $amount = isset($item['amount']) ? (float) $item['amount'] : 0.00;
                if ($amount > 0 && isset($componentModels[$item['id']])) {
                    $comp = $componentModels[$item['id']];
                    $syncData[$comp->id] = ['amount' => $amount];

                    if ($comp->type === 'allowance') {
                        $allowancesTotal += $amount;
                    } else {
                        $deductionsTotal += $amount;
                    }
                }
            }
        }

        $grossSalary = $baseSalary + $bonus + $allowancesTotal;
        $taxAmount = round($grossSalary * 0.195, 2);
        $netSalary = round($grossSalary - $taxAmount - $deductionsTotal, 2);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('payroll_docs', 'public');
        }

        $payroll = Payroll::create([
            'employee_id' => $employee->id,
            'period' => $validated['period'],
            'base_salary' => $baseSalary,
            'worked_days' => $workedDays,
            'bonus' => $bonus,
            'tax_amount' => $taxAmount,
            'net_salary' => $netSalary,
            'status' => 'calculated',
            'attachment_path' => $attachmentPath,
        ]);

        if (! empty($syncData)) {
            $payroll->components()->sync($syncData);
        }

        $payroll->load(['employee', 'components']);

        if ($request->expectsJson()) {
            return response()->json(['status' => 'created', 'data' => $payroll], 201);
        }

        return redirect()->route('payrolls.index')
            ->with('success', 'Розрахунок заробітної плати успішно проведено!');
    }
}

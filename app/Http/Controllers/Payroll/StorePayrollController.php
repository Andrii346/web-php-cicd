<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Repositories\PayrollRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StorePayrollController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'employee_id' => ['required', 'integer', 'min:1'],
            'employee_name' => ['required', 'string', 'min:3', 'max:255'],
            'period' => ['required', 'string', 'regex:/^\d{4}-(0[1-9]|1[0-2])$/'],
            'base_salary' => ['required', 'numeric', 'min:0'],
            'worked_days' => ['required', 'integer', 'min:0', 'max:31'],
            'bonus' => ['nullable', 'numeric', 'min:0'],
        ]);

        $baseSalary = (float) $validated['base_salary'];
        $bonus = isset($validated['bonus']) ? (float) $validated['bonus'] : 0.0;
        $grossSalary = $baseSalary + $bonus;

        $taxAmount = round($grossSalary * 0.195, 2);
        $netSalary = $grossSalary - $taxAmount;

        $newPayroll = PayrollRepository::create([
            'employee_id' => (int) $validated['employee_id'],
            'employee_name' => $validated['employee_name'],
            'period' => $validated['period'],
            'base_salary' => $baseSalary,
            'worked_days' => (int) $validated['worked_days'],
            'bonus' => $bonus,
            'tax_amount' => $taxAmount,
            'net_salary' => $netSalary,
            'status' => 'calculated',
        ]);

        return response()->json([
            'status' => 'created',
            'message' => 'Розрахунковий запис заробітної плати успішно сформовано.',
            'data' => $newPayroll,
        ], 201);
    }
}

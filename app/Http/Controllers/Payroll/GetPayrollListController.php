<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payroll\FilterPayrollRequest;
use App\Models\Payroll;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class GetPayrollListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FilterPayrollRequest $request): View|JsonResponse
    {
        $validated = $request->validated();

        $payrolls = Payroll::query()
            ->with(['employee:id,first_name,last_name,tax_number,position', 'components:id,name,code,type'])
            ->when($validated['period'] ?? null, fn ($q, $period) => $q->where('period', $period))
            ->when($validated['employee_id'] ?? null, fn ($q, $empId) => $q->where('employee_id', $empId))
            ->latest()
            ->paginate(15);

        if ($request->expectsJson()) {
            return response()->json(['status' => 'success', 'data' => $payrolls]);
        }

        return view('payrolls.index', compact('payrolls'));
    }
}

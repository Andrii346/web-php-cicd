<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\PayrollComponent;
use Illuminate\View\View;

class CreatePayrollController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        $employees = Employee::where('is_active', true)->orderBy('last_name')->get();
        $components = PayrollComponent::orderBy('name')->get();

        return view('payrolls.create', compact('employees', 'components'));
    }
}

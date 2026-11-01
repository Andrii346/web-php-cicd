<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'report' => [
                'current_period' => '2026-10',
                'total_accrued' => 57000.00,
                'total_taxes_withheld' => 12675.00,
                'total_payable' => 52325.00,
                'currency' => 'UAH',
            ],
        ], 200);
    }
}

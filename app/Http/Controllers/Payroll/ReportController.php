<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'summary' => [
                'total_records' => Payroll::count(),
                'total_net_paid' => round((float) Payroll::sum('net_salary'), 2),
                'total_tax_amount' => round((float) Payroll::sum('tax_amount'), 2),
                'trashed_records' => Payroll::onlyTrashed()->count(),
            ],
        ]);
    }
}

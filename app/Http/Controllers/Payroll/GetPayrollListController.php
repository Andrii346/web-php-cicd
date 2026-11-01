<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Repositories\PayrollRepository;
use Illuminate\Http\Request;

class GetPayrollListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $records = PayrollRepository::all();

        return response()->json([
            'status' => 'success',
            'count' => count($records),
            'data' => $records,
        ], 200);
    }
}

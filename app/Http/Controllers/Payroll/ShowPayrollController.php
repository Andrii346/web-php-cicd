<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShowPayrollController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id): View|JsonResponse
    {
        $payroll = Payroll::with(['employee', 'components'])->findOrFail($id);

        if ($request->expectsJson()) {
            return response()->json(['status' => 'success', 'data' => $payroll]);
        }

        return view('payrolls.show', compact('payroll'));
    }
}

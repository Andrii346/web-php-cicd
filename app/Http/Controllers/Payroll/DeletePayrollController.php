<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeletePayrollController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id): RedirectResponse|JsonResponse
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->delete();

        if ($request->expectsJson()) {
            return response()->json(['status' => 'deleted']);
        }

        return redirect()->route('payrolls.index')
            ->with('success', 'Відомість переміщено до кошика (Soft Deleted).');
    }
}

<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeleteEmployeeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id): RedirectResponse|JsonResponse
    {
        $employee = Employee::findOrFail($id);
        $employee->delete(); // М'яке видалення (Soft Delete)

        if ($request->expectsJson()) {
            return response()->json(['status' => 'deleted']);
        }

        return redirect()->route('employees.index')
            ->with('success', 'Співробітника переміщено в архів (Soft Deleted).');
    }
}

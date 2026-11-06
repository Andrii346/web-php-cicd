<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class StoreEmployeeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreEmployeeRequest $request): RedirectResponse|JsonResponse
    {
        $employee = Employee::create($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['status' => 'created', 'data' => $employee], 201);
        }

        return redirect()->route('employees.index')
            ->with('success', "Співробітника {$employee->last_name} {$employee->first_name} успішно додано!");
    }
}

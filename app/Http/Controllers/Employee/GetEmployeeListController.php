<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\FilterEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class GetEmployeeListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FilterEmployeeRequest $request): View|JsonResponse
    {
        $validated = $request->validated();

        $employees = Employee::query()
            ->withCount('payrolls')
            ->when($validated['search'] ?? null, function ($q, $search) {
                $q->where('last_name', 'like', "%{$search}%")
                    ->orWhere('tax_number', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(15);

        if ($request->expectsJson()) {
            return response()->json(['status' => 'success', 'data' => $employees]);
        }

        return view('employees.index', compact('employees'));
    }
}

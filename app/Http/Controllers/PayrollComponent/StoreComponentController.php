<?php

namespace App\Http\Controllers\PayrollComponent;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayrollComponent\StorePayrollComponentRequest;
use App\Models\PayrollComponent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class StoreComponentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StorePayrollComponentRequest $request): RedirectResponse|JsonResponse
    {
        $component = PayrollComponent::create($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['status' => 'created', 'data' => $component], 201);
        }

        return redirect()->route('components.index')
            ->with('success', "Компонент «{$component->name}» успішно створено!");
    }
}

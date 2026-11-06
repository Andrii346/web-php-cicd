<?php

namespace App\Http\Controllers\PayrollComponent;

use App\Http\Controllers\Controller;
use App\Models\PayrollComponent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeleteComponentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id): RedirectResponse|JsonResponse
    {
        $component = PayrollComponent::findOrFail($id);
        $component->delete();

        if ($request->expectsJson()) {
            return response()->json(['status' => 'deleted']);
        }

        return redirect()->route('components.index')
            ->with('success', 'Компонент ЗП м’яко видалено.');
    }
}

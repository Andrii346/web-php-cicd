<?php

namespace App\Http\Controllers\PayrollComponent;

use App\Http\Controllers\Controller;
use App\Models\PayrollComponent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GetComponentListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View|JsonResponse
    {
        $components = PayrollComponent::withCount('payrolls')->latest()->get();

        if ($request->expectsJson()) {
            return response()->json(['status' => 'success', 'data' => $components]);
        }

        return view('components.index', compact('components'));
    }
}

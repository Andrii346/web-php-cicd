<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Repositories\PayrollRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowPayrollController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $id): JsonResponse
    {
        $record = PayrollRepository::find((int) $id);
        if ($record === null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Розрахунковий лист із зазначеним ідентифікатором не знайдено.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $record,
        ], 200);
    }
}

<?php

use App\Http\Controllers\Payroll\GetPayrollListController;
use App\Http\Controllers\Payroll\ReportController;
use App\Http\Controllers\Payroll\ShowPayrollController;
use App\Http\Controllers\Payroll\StorePayrollController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json([
        'status' => 'OK',
        'subsystem' => 'Payroll Accounting Workplace',
        'timestamp' => now()->toIso8601String(),
    ]);
});

Route::prefix('payrolls')->name('payrolls.')->group(function () {
    Route::get('/', GetPayrollListController::class)->name('index');

    Route::post('/', StorePayrollController::class)
        ->middleware('accountant.access')
        ->name('store');

    Route::get('/{id}', ShowPayrollController::class)
        ->whereNumber('id')
        ->name('show');

    Route::get('/report/summary', ReportController::class)->name('report.summary');
});

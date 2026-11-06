<?php

use App\Http\Controllers\Employee\CreateEmployeeController;
use App\Http\Controllers\Employee\DeleteEmployeeController;
use App\Http\Controllers\Employee\GetEmployeeListController;
use App\Http\Controllers\Employee\StoreEmployeeController;
use App\Http\Controllers\Payroll\CreatePayrollController;
use App\Http\Controllers\Payroll\DeletePayrollController;
use App\Http\Controllers\Payroll\GetPayrollListController;
use App\Http\Controllers\Payroll\ReportController;
use App\Http\Controllers\Payroll\ShowPayrollController;
use App\Http\Controllers\Payroll\StorePayrollController;
use App\Http\Controllers\PayrollComponent\CreateComponentController;
use App\Http\Controllers\PayrollComponent\DeleteComponentController;
use App\Http\Controllers\PayrollComponent\GetComponentListController;
use App\Http\Controllers\PayrollComponent\StoreComponentController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('payrolls.index'));

Route::get('/health', function () {
    return response()->json([
        'status' => 'OK',
        'subsystem' => 'Payroll Accounting Workplace',
        'timestamp' => now()->toIso8601String(),
    ]);
})->middleware('payroll.client');

Route::prefix('employees')
    ->name('employees.')
    ->middleware(['payroll.client', 'payroll.log'])
    ->group(function () {
        Route::get('/', GetEmployeeListController::class)->name('index');
        Route::get('/create', CreateEmployeeController::class)->name('create');
        Route::post('/', StoreEmployeeController::class)->middleware('accountant.access')->name('store');
        Route::delete('/{id}', DeleteEmployeeController::class)->whereNumber('id')->middleware('accountant.access')->name('destroy');
    });

Route::prefix('components')
    ->name('components.')
    ->middleware(['payroll.client', 'payroll.log'])
    ->group(function () {
        Route::get('/', GetComponentListController::class)->name('index');
        Route::get('/create', CreateComponentController::class)->name('create');
        Route::post('/', StoreComponentController::class)->middleware('accountant.access')->name('store');
        Route::delete('/{id}', DeleteComponentController::class)->whereNumber('id')->middleware('accountant.access')->name('destroy');
    });

Route::prefix('payrolls')
    ->name('payrolls.')
    ->middleware(['payroll.client', 'payroll.log'])
    ->group(function () {
        Route::get('/', GetPayrollListController::class)->name('index');
        Route::get('/create', CreatePayrollController::class)->name('create');
        Route::post('/', StorePayrollController::class)->middleware('accountant.access')->name('store');
        Route::get('/report/summary', ReportController::class)->name('report.summary');
        Route::get('/{id}', ShowPayrollController::class)->whereNumber('id')->name('show');
        Route::delete('/{id}', DeletePayrollController::class)->whereNumber('id')->middleware('accountant.access')->name('destroy');
    });

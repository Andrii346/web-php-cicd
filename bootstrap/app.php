<?php

use App\Http\Middleware\CheckAccountantAccess;
use App\Http\Middleware\EnsureValidPayrollClient;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'accountant.access' => \App\Http\Middleware\EnsureAccountantAccess::class,
            'payroll.client'    => \App\Http\Middleware\EnsureValidPayrollClient::class,
            'payroll.log'       => \App\Http\Middleware\LogPayrollActivity::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            'payrolls',
            'payrolls/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn(Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();

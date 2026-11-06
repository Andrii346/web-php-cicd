<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogPayrollActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('Payroll Action Executed', [
            'method' => $request->method(),
            'uri'    => $request->getRequestUri(),
            'ip'     => $request->ip(),
        ]);

        return $next($request);
    }
}

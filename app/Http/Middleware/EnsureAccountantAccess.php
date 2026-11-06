<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountantAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->expectsJson()) {
            $hasAccess = $request->hasHeader('X-App-Client') || $request->header('X-Accountant-Role') === 'chief';
            if (! $hasAccess) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Доступ заборонено: необхідні права бухгалтера (X-App-Client).',
                ], Response::HTTP_FORBIDDEN);
            }
        }

        return $next($request);
    }
}

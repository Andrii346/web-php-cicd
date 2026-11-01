<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountantAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('post') && ! $request->hasHeader('X-Accountant-Token')) {
            return response()->json([
                'status' => 'access_denied',
                'message' => 'Відхилено: відсутній обов\'язковий службовий заголовок доступу бухгалтера X-Accountant-Token.',
            ], 403);
        }
        $response = $next($request);
        $response->headers->set('X-Security-Policy', 'Enforced');

        return $response;
    }
}

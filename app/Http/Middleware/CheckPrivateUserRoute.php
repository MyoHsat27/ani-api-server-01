<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPrivateUserRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->id !== $request->user->id) {
            return response()->json(['error' => 'Unauthorized Action'],401);
        }

        return $next($request);
    }
}

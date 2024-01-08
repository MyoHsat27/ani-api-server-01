<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiVersionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestedVersion = $request->segment(2);
        $supportedVersion = ['v1', 'v2'];
        if (!in_array($requestedVersion, $supportedVersion)) {
            return response()->json(['error' => 'Unsupported API Version'],400);
        }
        $request->attributes->add(['api_version' => $requestedVersion]);

        return $next($request);
    }
}

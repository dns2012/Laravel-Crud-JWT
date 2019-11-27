<?php

namespace App\Http\Middleware;

use Closure;

use JWTAuth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (\Throwable $error) {
            throw $error;
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class JsonMiddleware
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
        $request->headers->set('Accept', 'application/json'); // treat to always accept json even in HTTP requests
        // auto attach bearer token via httponly cookie
        try {
            $accessToken = $request->cookie(config('session.passport_token_cookie'));
            if ($accessToken) {
                $request->headers->set('Authorization', "Bearer {$accessToken}");
            }
        } catch (\Exception $e) {
            $accessToken = '';
        }
        return $next($request);
    }
}

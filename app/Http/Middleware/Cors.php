<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->getMethod() === 'OPTIONS')
        {
            return $next($request)
                // Depending of your application you can't use '*'
                // Some security CORS concerns
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, DELETE, PUT')
                ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, X-Auth-Token, Authorization');
        }

        return $next($request)
            ->header('Access-Control-Allow-Origin', '*');
    }
}

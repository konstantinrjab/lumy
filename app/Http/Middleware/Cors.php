<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->getMethod() === 'OPTIONS')
        {
            return $next($request)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, DELETE, PUT')
                ->header('Access-Control-Allow-Headers', '*');
        }

        return $next($request)
            ->header('Access-Control-Allow-Origin', '*');
    }
}

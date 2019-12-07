<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $user = Auth::user();
        if (!$user || !$user->isAdmin()) {
            throw new AuthorizationException();
        }

        return $next($request);
    }
}

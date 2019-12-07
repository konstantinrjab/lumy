<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Localization
{
    public function handle(Request $request, Closure $next)
    {
        if ($user = Auth::user()) {
            App::setLocale($user->profile->language);
        }

        return $next($request);
    }
}

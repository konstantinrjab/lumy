<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Authenticate extends Middleware
{
    private const MESSAGE_UNAUTHENTICATED = 'Unauthenticated.';

    protected function unauthenticated($request, array $guards)
    {
        if ($request->expectsJson()) {
            throw new UnauthorizedHttpException('Token', self::MESSAGE_UNAUTHENTICATED);
        }

        throw new AuthenticationException(self::MESSAGE_UNAUTHENTICATED, $guards);
    }
}

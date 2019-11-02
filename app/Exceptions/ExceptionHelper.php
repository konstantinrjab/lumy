<?php

namespace App\Exceptions;

use Illuminate\Support\Facades\Auth;

class ExceptionHelper
{
    public static function getExceptionData(\Exception $exception): array
    {
        $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        return [
            'Message'    => $exception->getMessage(),
            'File'       => $exception->getFile(),
            'Line'       => $exception->getLine(),
            'Code'       => $exception->getCode(),
            'Previous'   => $exception->getPrevious(),
            'DateTime'   => date('Y-m-d H:i:s'),
            'Url'        => $url,
            'UserId'     => Auth::id() ?? 'undefined',
            'Trace'      => $exception->getTraceAsString(),
        ];
    }
}

<?php

namespace App\Helpers;

use App\Mail\ExceptionOccurred;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ExceptionHelper
{
    public static function sendExceptionEmail(Exception $exception): void
    {
        try {
            $emails = explode(',', env('EXCEPTION_EMAILS'));

            Mail::to($emails)->send(new ExceptionOccurred($exception));
        } catch (Exception $ex) {
            Log::critical('Cannot send email. Exception: ', ExceptionHelper::getExceptionData($ex));
        }
    }

    public static function getExceptionData(Exception $exception): array
    {
        $url = '';
        if (isset($_SERVER['HTTP_HOST']) && isset($_SERVER['REQUEST_URI'])) {
            $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }

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

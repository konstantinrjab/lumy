<?php

namespace App\Http\Middleware;

use App\Exceptions\Helpers\ExceptionHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;
use Closure;
use Exception;
use DateTimeInterface;

class ApiDataLogger
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        $currentTime = microtime(true);
        $filename = 'api_logger_' . date('d-m-y') . '.log';

        $dataToLog = 'Time: ' . gmdate(DateTimeInterface::ISO8601) . "\n";
        $dataToLog .= 'Duration: ' . number_format($currentTime - LARAVEL_START, 3) . "\n";
        $dataToLog .= 'Status code: ' . $response->getStatusCode() . "\n";
        $dataToLog .= 'Headers: ' . json_encode($response->headers->all(), JSON_PRETTY_PRINT) . "\n";
        $dataToLog .= 'UserId: ' . (Auth::id() ?: 'Unauthorized') . "\n";
        $dataToLog .= 'IP Address: ' . $request->ip() . "\n";
        $dataToLog .= 'URL: ' . $request->fullUrl() . "\n";
        $dataToLog .= 'Method: ' . $request->method() . "\n";
        $dataToLog .= 'Input: ' . $request->getContent() . "\n";
        $dataToLog .= 'Output: ' . json_encode(json_decode($response->getContent()), JSON_PRETTY_PRINT) . "\n";

        try {
            File::append(storage_path('logs' . DIRECTORY_SEPARATOR . $filename), $dataToLog . "\n");
        } catch (Exception $e) {
            ExceptionHelper::sendExceptionEmail($e);
        }
    }
}

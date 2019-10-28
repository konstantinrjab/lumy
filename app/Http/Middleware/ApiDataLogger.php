<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Closure;
use Symfony\Component\HttpFoundation\Response;

class ApiDataLogger
{
    private $startTime;

    public function handle($request, Closure $next)
    {
        $this->startTime = microtime(true);

        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        if (env('API_DATALOGGER', true)) {
            $endTime = microtime(true);
            $filename = 'api_datalogger_' . date('d-m-y') . '.log';
            $dataToLog = 'Time: ' . gmdate("F j, Y, g:i a") . "\n";
            $dataToLog .= 'Duration: ' . number_format($endTime - LARAVEL_START, 3) . "\n";
            $dataToLog .= 'IP Address: ' . $request->ip() . "\n";
            $dataToLog .= 'URL: ' . $request->fullUrl() . "\n";
            $dataToLog .= 'Method: ' . $request->method() . "\n";
            $dataToLog .= 'Input: ' . $request->getContent() . "\n";
            $dataToLog .= 'Output: ' . $response->getContent() . "\n";
            File::append(storage_path('logs' . DIRECTORY_SEPARATOR . $filename), $dataToLog . "\n" . str_repeat("=", 20) . "\n\n");
        }
    }
}

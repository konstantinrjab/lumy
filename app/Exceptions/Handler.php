<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $response['data'] = [
            'message' => 'Unexpected error'
        ];
        if ($exception instanceof ValidationException && isset($exception->validator)) {
            $response['data'] = [
                'message' => $exception->getMessage(),
                'errors'  => $exception->validator->errors()->toArray()
            ];
        } elseif ($exception instanceof ModelNotFoundException) {
            $response['data'] = [
                'message' => $exception->getMessage(),
            ];
        }

        if (config('app.debug')) {
            $response['exception'] = get_class($exception);
            $response['message'] = $exception->getMessage();
            $response['trace'] = $exception->getTrace();
        }

        $status = 400;

        if ($this->isHttpException($exception)) {
            $status = $exception->getStatusCode();
        }

        return response()->json($response, $status);
    }
}

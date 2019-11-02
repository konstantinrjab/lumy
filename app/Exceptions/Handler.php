<?php

namespace App\Exceptions;

use App\Mail\ExceptionOccured;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
     *
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        if ($this->shouldReport($exception)) {
            $this->sendEmail($exception);
        }

        return parent::report($exception);
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
        if ($request->wantsJson()) {
            $response['data'] = [
                'message' => $exception->getMessage()
            ];
            if ($exception instanceof ValidationException && isset($exception->validator)) {
                $response['data']['errors'] = $exception->validator->errors()->toArray();
            }
            if ($exception instanceof ModelNotFoundException) {
                $response['data']['message'] = 'Model not found';
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

        return parent::render($request, $exception);
    }

    private function sendEmail(\Exception $exception)
    {
        try {
            $emails = explode(',', env('EXCEPTION_EMAILS'));

            Mail::to($emails)->send(new ExceptionOccured($exception));
        } catch (Exception $ex) {
            Log::critical('cannot send email. exception: ', ExceptionHelper::getExceptionData($ex));
        }
    }
}

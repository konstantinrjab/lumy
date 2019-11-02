<?php

namespace App\Mail;

use App\Exceptions\ExceptionHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExceptionOccured extends Mailable
{
    use Queueable, SerializesModels;

    private $exception;

    public function __construct(\Exception $exception)
    {
        $this->exception = $exception;
    }

    public function build(): self
    {
        $debugData = ExceptionHelper::getExceptionData($this->exception);

        $errorTrace = '';
        foreach (array_filter(explode('#', $this->exception->getTraceAsString())) as $line) {
            $errorTrace .= htmlspecialchars($line) . '<br/>';
        }
        $debugData['Trace'] = $errorTrace;

        return $this->view('emails.exception')
                ->with('debugData', $debugData);
    }
}

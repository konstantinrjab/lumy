<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Debug\Exception\FlattenException;

class ExceptionOccured extends Mailable
{
    use Queueable, SerializesModels;

    private $exception;

    public function __construct(FlattenException $exception)
    {
        $this->exception = $exception;
    }

    public function build(): self
    {
        $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $errorTrace = '';
        foreach (array_filter(explode('#', $this->exception->getTraceAsString())) as $line) {
            $errorTrace .= htmlspecialchars($line) . '<br/>';
        }

        $debugData = [
            'Message' => $this->exception->getMessage(),
            'File' => $this->exception->getFile(),
            'Line' => $this->exception->getLine(),
            'Code' => $this->exception->getCode(),
            'StatusCode' => $this->exception->getStatusCode(),
            'Previous' => $this->exception->getPrevious(),
            'DateTime' => date('Y-m-d H:i:s'),
            'url' => $url,
            'userId' => Auth::id() ?? 'undefined',
            'trace' => $errorTrace,
        ];

        return $this->view('emails.exception')
                ->with('debugData', $debugData);
    }
}

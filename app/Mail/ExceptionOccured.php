<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
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
        return $this->view('emails.exception')
                ->with('exception', $this->exception);
    }
}

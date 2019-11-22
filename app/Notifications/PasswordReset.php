<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class PasswordReset extends Notification
{
    /** @var string $token */
    private $token;

    public function __construct(string $token, string $locale)
    {
        $this->token = $token;
        $this->locale = $locale;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(Lang::get('emails.reset_password_subject'))
            ->line(Lang::get('emails.reset_password_line_1'))
            ->action(
                Lang::get('emails.reset_password_action_1'),
                url(
                    config('app.url') . route('password.reset',
                        ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)
                )
            )
            ->line(
                Lang::get('emails.reset_password_line_2',
                    ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]
                )
            )
            ->line(Lang::get('emails.reset_password_line_3'));
    }
}

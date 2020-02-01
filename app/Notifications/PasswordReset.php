<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class PasswordReset extends Notification
{
    private string $token;

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
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(Lang::get('emails.reset_password_subject'))
            ->line(Lang::get('emails.reset_password_line_1'))
            ->action(
                Lang::get('emails.reset_password_action_1'),
                env('FRONTEND_URL')
                . env('FRONTEND_RECOVER_PASSWORD_URL')
                . "?token={$this->token}&email={$notifiable->getEmailForPasswordReset()}"
            )
            ->line(
                Lang::get('emails.reset_password_line_2',
                    ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]
                )
            )
            ->line(Lang::get('emails.reset_password_line_3'));
    }
}

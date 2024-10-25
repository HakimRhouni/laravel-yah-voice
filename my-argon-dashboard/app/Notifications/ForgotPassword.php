<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class ForgotPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = URL::temporarySignedRoute('change-password', now()->addHours(12), ['id' => $this->token]);

        return (new MailMessage)
                    ->subject('Réinitialisation de mot de passe')
                    ->line('Vous recevez cet email pour réinitialiser votre mot de passe.')
                    ->action('Réinitialiser le mot de passe', $url)
                    ->line("Si vous n'avez pas demandé cela, ignorez cet email.");
    }
}

<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class PasswordReset extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('4thinks.technology@gmail.com', 'Laravel - Recuperação de Senha')
            ->subject('E-mail de Recuperação de Senha')
            ->greeting('Olá ' . $notifiable->name . '!')
            ->line('Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha de sua conta.')
            ->action('Redefinir senha', url(config('app.url') . route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
            ->line('Este link de redefinição de senha irá expirar em 60 minutos.')
            ->line('Se você não solicitou uma redefinição de senha, nenhuma ação adicional será necessária.')
            ->salutation(new HtmlString("Atenciosamente,<br>Suporte"))
            ->markdown('vendor.notifications.email');
    }
}

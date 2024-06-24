<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CandidatureAccepted extends Notification
{
    use Queueable;

    protected $candidature;
    protected $test;

    public function __construct($candidature, $test)
    {
        $this->candidature = $candidature;
        $this->test = $test;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Votre candidature a été acceptée')
                    ->greeting('Bonjour ' . $this->candidature->candidat->user->prenom .' '. $this->candidature->candidat->user->nom . ',')
                    ->line('Nous avons le plaisir de vous informer que votre candidature a été acceptée.')
                    ->line('Un test vous a été soumis.')
                    ->action('Voir le test', url('/tests/' . $this->test->test_id))
                    ->line('Merci pour votre candidature!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

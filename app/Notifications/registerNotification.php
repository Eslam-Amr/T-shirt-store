<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class registerNotification extends Notification
{
    use Queueable;
private $user;
    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        //
        $this->user=$user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {

        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('')
                    // ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }


}

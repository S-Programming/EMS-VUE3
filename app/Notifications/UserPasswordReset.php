<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserPasswordReset extends Notification
{
    use Queueable;


    public $url;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
       
       // dd((new MailMessage)->action('alalala','http://localhost/reset-password/NnJHJTI2JTNCcSU3Q05UY3lOaVUzUTNOaFpHUnBjWFZsWVhKaGFXNDVPU1UwTUdkdFlXbHNMbU52YlElM0QlM0Q=');
        return (new MailMessage)
                    ->line('KodeStudio.')
                    ->action('Password Reset', $this->url['url'])
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

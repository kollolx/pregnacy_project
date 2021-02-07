<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewQuestionAdd extends Notification
{
    use Queueable;
    // private $product;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
        // return ['database', 'broadcast', 'mail];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
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
        $msg = "'<b>" . 'New Question Arrived' . "</b>'";
        $link = route('welcome');
        return [
            'message' => $msg,
            'link' => $link,
            // 'admin' => $notifiable,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        $msg = "'<b>" . 'New Question Arrived' . "</b>'";
        $link = route('welcome');
        return [
            'message' => $msg,
            'link' => $link,
            // 'admin' => $notifiable,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toBroadcast($notifiable)
    {
        $msg = "'<b" . 'New Question Arrived' . "</b>'";
        $link = route('welcome');
        return [
            'message' => $msg,
            'link' => $link,
            // 'admin' => $notifiable,
        ];
    }
}
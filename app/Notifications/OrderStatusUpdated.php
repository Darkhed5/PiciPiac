<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusUpdated extends Notification
{
    use Queueable;

    private $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Rendelési állapot frissítése')
                    ->greeting('Kedves ' . $notifiable->name . '!')
                    ->line('A rendelésed állapota frissült.')
                    ->line('Új állapot: ' . $this->order->status)
                    ->action('Rendelési előzmények megtekintése', url('/order-history'))
                    ->line('Köszönjük, hogy a PiciPiacot választottad!');
    }
}

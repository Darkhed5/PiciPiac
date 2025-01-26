<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderPlaced extends Notification
{
    use Queueable;

    protected $order;

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
                    ->subject('Rendelés visszaigazolása')
                    ->greeting('Kedves ' . $notifiable->name . '!')
                    ->line('Köszönjük, hogy rendelést adtál le a PiciPiacon!')
                    ->line('Rendelésed azonosítója: #' . $this->order->id)
                    ->line('Összesen: ' . $this->order->total_price . ' Ft')
                    ->line('Rendelés állapota: ' . $this->order->status)
                    ->action('Rendelési előzmények megtekintése', route('order.history'))
                    ->line('Köszönjük, hogy minket választottál!');
    }
}

<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderNotification extends Notification
{
    use Queueable;

    protected $order;
    protected $title;
    protected $message;
    protected $type; // new_order, order_confirmed, order_completed, order_cancelled

    public function __construct(Order $order, string $title, string $message, string $type)
    {
        $this->order = $order;
        $this->title = $title;
        $this->message = $message;
        $this->type = $type;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'title' => $this->title,
            'message' => $this->message,
            'type' => $this->type,
        ];
    }
}

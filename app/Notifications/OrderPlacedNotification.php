<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderPlacedNotification extends Notification // Removed ShouldQueue for immediate sending
{
    // Removed Queueable trait for immediate email sending

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $customerInfo = $this->order->orderGroup->getCustomerInfo();
        $array['subject'] = localize('Your order has been placed') . ' - ' . $this->order->orderGroup->order_code;
        $array['order'] = $this->order;

        return (new MailMessage)
            ->view('emails.order.beautiful-invoice', [
                'order' => $this->order,
                'customerInfo' => $customerInfo
            ])
            ->from(env('MAIL_FROM_ADDRESS'))
            ->subject(localize('Order Placed') . ' - ' . env('APP_NAME'));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

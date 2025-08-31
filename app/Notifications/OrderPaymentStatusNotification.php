<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPaymentStatusNotification extends Notification
{
    use Queueable;

    protected $order;
    protected $oldStatus;
    protected $newStatus;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order, $oldStatus, $newStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    /**
     * Get the notification's delivery channels.
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
        $orderCode = getSetting('order_code_prefix') . $this->order->orderGroup->order_code;

        // Determine email content based on payment status
        $emailData = $this->getEmailContent();

        return (new MailMessage)
            ->view('emails.order.payment-status', [
                'order' => $this->order,
                'orderCode' => $orderCode,
                'emailData' => $emailData,
                'customerInfo' => $this->order->orderGroup->getCustomerInfo()
            ])
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject($emailData['subject'] . ' - ' . $orderCode);
    }

    /**
     * Get email content based on payment status
     */
    private function getEmailContent()
    {
        switch ($this->newStatus) {
            case 'paid':
                return [
                    'subject' => localize('Payment Confirmed'),
                    'title' => localize('Payment Confirmed!'),
                    'message' => localize('Great news! Your payment has been successfully processed.'),
                    'description' => localize('Your order is now confirmed and will be processed shortly.'),
                    'color' => '#28a745',
                    'icon' => 'check-circle'
                ];

            case 'unpaid':
                return [
                    'subject' => localize('Payment Required'),
                    'title' => localize('Payment Pending'),
                    'message' => localize('Your order is waiting for payment confirmation.'),
                    'description' => localize('Please complete your payment to proceed with your order.'),
                    'color' => '#ffc107',
                    'icon' => 'clock'
                ];

            default:
                return [
                    'subject' => localize('Payment Status Updated'),
                    'title' => localize('Payment Status Updated'),
                    'message' => localize('Your payment status has been updated.'),
                    'description' => localize('Current status: ') . ucwords(str_replace('_', ' ', $this->newStatus)),
                    'color' => '#17a2b8',
                    'icon' => 'info-circle'
                ];
        }
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'order_code' => $this->order->orderGroup->order_code,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
            'message' => 'Payment status updated from ' . $this->oldStatus . ' to ' . $this->newStatus
        ];
    }
}

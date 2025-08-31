<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderDeliveryStatusNotification extends Notification
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

        // Determine email content based on delivery status
        $emailData = $this->getEmailContent();

        return (new MailMessage)
            ->view('emails.order.delivery-status', [
                'order' => $this->order,
                'orderCode' => $orderCode,
                'emailData' => $emailData,
                'customerInfo' => $this->order->orderGroup->getCustomerInfo()
            ])
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject($emailData['subject'] . ' - ' . $orderCode);
    }

    /**
     * Get email content based on delivery status
     */
    private function getEmailContent()
    {
        switch ($this->newStatus) {
            case 'order_placed':
                return [
                    'subject' => localize('Order Placed'),
                    'title' => localize('Order Placed Successfully!'),
                    'message' => localize('Thank you for your order! We have received your order and it is being processed.'),
                    'description' => localize('You will receive updates as your order progresses.'),
                    'color' => '#007bff',
                    'icon' => 'shopping-bag'
                ];

            case 'pending':
                return [
                    'subject' => localize('Order Processing'),
                    'title' => localize('Order is Being Processed'),
                    'message' => localize('Your order is currently being processed by our team.'),
                    'description' => localize('We are preparing your items for shipment.'),
                    'color' => '#ffc107',
                    'icon' => 'clock'
                ];

            case 'processing':
                return [
                    'subject' => localize('Order Being Prepared'),
                    'title' => localize('Order Being Prepared'),
                    'message' => localize('Great news! Your order is being prepared for delivery.'),
                    'description' => localize('Our team is carefully packing your items.'),
                    'color' => '#fd7e14',
                    'icon' => 'box'
                ];

            case 'picked_up':
                return [
                    'subject' => localize('Order Picked Up'),
                    'title' => localize('Order Picked Up by Delivery Partner'),
                    'message' => localize('Your order has been picked up by our delivery partner.'),
                    'description' => localize('Your order is on its way to you!'),
                    'color' => '#6f42c1',
                    'icon' => 'truck'
                ];

            case 'out_for_delivery':
                return [
                    'subject' => localize('Out for Delivery'),
                    'title' => localize('Out for Delivery!'),
                    'message' => localize('Exciting news! Your order is out for delivery.'),
                    'description' => localize('Our delivery partner will deliver your order soon.'),
                    'color' => '#20c997',
                    'icon' => 'shipping-fast'
                ];

            case 'delivered':
                return [
                    'subject' => localize('Order Delivered'),
                    'title' => localize('Order Delivered Successfully!'),
                    'message' => localize('Congratulations! Your order has been delivered successfully.'),
                    'description' => localize('We hope you enjoy your purchase. Thank you for choosing us!'),
                    'color' => '#28a745',
                    'icon' => 'check-circle'
                ];

            case 'cancelled':
                return [
                    'subject' => localize('Order Cancelled'),
                    'title' => localize('Order Cancelled'),
                    'message' => localize('Your order has been cancelled as requested.'),
                    'description' => localize('If you have any questions, please contact our support team.'),
                    'color' => '#dc3545',
                    'icon' => 'times-circle'
                ];

            default:
                return [
                    'subject' => localize('Order Status Updated'),
                    'title' => localize('Order Status Updated'),
                    'message' => localize('Your order status has been updated.'),
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
            'message' => 'Delivery status updated from ' . $this->oldStatus . ' to ' . $this->newStatus
        ];
    }
}

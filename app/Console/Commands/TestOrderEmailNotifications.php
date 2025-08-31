<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderPaymentStatusNotification;
use App\Notifications\OrderDeliveryStatusNotification;
use Illuminate\Console\Command;

class TestOrderEmailNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:order-emails {order_id} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test order email notifications by sending sample emails';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orderId = $this->argument('order_id');
        $email = $this->argument('email');

        try {
            // Find the order
            $order = Order::with(['orderGroup', 'orderItems.product_variation.product'])->findOrFail($orderId);
            
            $this->info("Testing email notifications for Order ID: {$orderId}");
            $this->info("Sending emails to: {$email}");

            // Create a test user object
            $testUser = new User();
            $testUser->email = $email;
            $testUser->name = 'Test Customer';

            // Test Payment Status Email
            $this->info("\n1. Testing Payment Status Email (unpaid → paid)...");
            $testUser->notify(new OrderPaymentStatusNotification($order, 'unpaid', 'paid'));
            $this->info("✅ Payment status email sent!");

            // Test Delivery Status Email
            $this->info("\n2. Testing Delivery Status Email (pending → processing)...");
            $testUser->notify(new OrderDeliveryStatusNotification($order, 'pending', 'processing'));
            $this->info("✅ Delivery status email sent!");

            // Test Delivery Status Email - Out for Delivery
            $this->info("\n3. Testing Delivery Status Email (processing → out_for_delivery)...");
            $testUser->notify(new OrderDeliveryStatusNotification($order, 'processing', 'out_for_delivery'));
            $this->info("✅ Out for delivery email sent!");

            // Test Delivery Status Email - Delivered
            $this->info("\n4. Testing Delivery Status Email (out_for_delivery → delivered)...");
            $testUser->notify(new OrderDeliveryStatusNotification($order, 'out_for_delivery', 'delivered'));
            $this->info("✅ Delivered email sent!");

            $this->info("\n🎉 All test emails have been sent successfully!");
            $this->info("Please check the email inbox: {$email}");

        } catch (\Exception $e) {
            $this->error("❌ Error: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}

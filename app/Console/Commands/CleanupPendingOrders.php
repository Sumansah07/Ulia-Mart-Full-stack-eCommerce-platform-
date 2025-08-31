<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OrderGroup;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CleanupPendingOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:cleanup-pending {--hours=2 : Hours after which pending orders should be deleted}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up pending orders that were never paid after specified hours';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $hours = $this->option('hours');
        $cutoffTime = Carbon::now()->subHours($hours);

        $this->info("Cleaning up pending orders older than {$hours} hours...");

        // Find pending orders older than cutoff time
        $pendingOrderGroups = OrderGroup::where('payment_status', 'pending')
            ->orWhere('payment_status', 'unpaid')
            ->where('created_at', '<', $cutoffTime)
            ->get();

        $deletedCount = 0;

        foreach ($pendingOrderGroups as $orderGroup) {
            try {
                $orderCode = $orderGroup->order_code;

                // Delete related records first to avoid foreign key constraints
                if ($orderGroup->order) {
                    // Delete order updates
                    $orderGroup->order->orderUpdates()->delete();

                    // Delete order items
                    $orderGroup->order->orderItems()->delete();

                    // Delete order
                    $orderGroup->order()->delete();
                }

                // Delete order group
                $orderGroup->delete();

                $deletedCount++;

                Log::info("Cleaned up pending order: {$orderCode}");

            } catch (\Exception $e) {
                Log::error("Failed to cleanup order {$orderGroup->order_code}: " . $e->getMessage());
                $this->error("Failed to cleanup order {$orderGroup->order_code}: " . $e->getMessage());
            }
        }

        $this->info("Cleanup completed. Deleted {$deletedCount} pending orders.");
        Log::info("Pending orders cleanup completed. Deleted {$deletedCount} orders older than {$hours} hours.");

        return Command::SUCCESS;
    }
}

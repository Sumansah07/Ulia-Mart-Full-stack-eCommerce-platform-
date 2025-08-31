<ul class="tt-side-nav">

    <!-- dashboard -->
    <li class="side-nav-item nav-item">
        <a href="<?php echo e(route('deliveryman.dashboard')); ?>" class="side-nav-link">
            <span class="tt-nav-link-icon"><i data-feather="pie-chart"></i></span>
            <span class="tt-nav-link-text"><?php echo e(localize('Dashboard')); ?></span>
        </a>
    </li>

    <!-- assigned orders -->
    <li class="side-nav-item nav-item <?php echo e(areActiveRoutes(['deliveryman.assigned'], 'tt-menu-item-active')); ?>">
        <a href="<?php echo e(route('deliveryman.assigned')); ?>"
            class="side-nav-link <?php echo e(areActiveRoutes(['deliveryman.assigned'])); ?>">
            <span class="tt-nav-link-icon"><i data-feather="check-square"></i></span>
            <span class="tt-nav-link-text">
                <span><?php echo e(localize('Assigned Orders')); ?></span>

                <?php
                    $user = auth()->user();
                    $orders = App\Models\Order::where('deliveryman_id', $user->id)->latest();
                    $orders = $orders
                        ->where(function ($q) {
                            $q->where('delivery_status', 'order_placed')
                                ->orWhere('delivery_status', 'pending')
                                ->orWhere('delivery_status', 'processing');
                        })
                        ->count();
                ?>

                <?php if($orders > 0): ?>
                    <small class="badge bg-danger"><?php echo e($orders); ?></small>
                <?php endif; ?>
            </span>
        </a>
    </li>

    <!-- picked orders -->
    <li class="side-nav-item nav-item <?php echo e(areActiveRoutes(['deliveryman.pickedUp'], 'tt-menu-item-active')); ?>">
        <a href="<?php echo e(route('deliveryman.pickedUp')); ?>"
            class="side-nav-link <?php echo e(areActiveRoutes(['deliveryman.pickedUp'])); ?>">
            <span class="tt-nav-link-icon"><i data-feather="shopping-bag"></i></span>
            <span class="tt-nav-link-text">
                <span><?php echo e(localize('Picked Orders')); ?></span>

                <?php
                    $orders = App\Models\Order::where('deliveryman_id', $user->id)->latest();
                    $orders = $orders
                        ->where(function ($q) {
                            $q->where('delivery_status', 'picked_up');
                        })
                        ->count();
                ?>

                <?php if($orders > 0): ?>
                    <small class="badge bg-info"><?php echo e($orders); ?></small>
                <?php endif; ?>
            </span>
        </a>
    </li>

    <!-- out for delivery orders -->
    <li class="side-nav-item nav-item <?php echo e(areActiveRoutes(['deliveryman.outForDelivery'], 'tt-menu-item-active')); ?>">
        <a href="<?php echo e(route('deliveryman.outForDelivery')); ?>"
            class="side-nav-link <?php echo e(areActiveRoutes(['deliveryman.outForDelivery'])); ?>">
            <span class="tt-nav-link-icon"><i data-feather="truck"></i></span>
            <span class="tt-nav-link-text">
                <span><?php echo e(localize('Out For Delivery')); ?></span>

                <?php
                    $orders = App\Models\Order::where('deliveryman_id', $user->id)->latest();
                    $orders = $orders
                        ->where(function ($q) {
                            $q->where('delivery_status', 'out_for_delivery');
                        })
                        ->count();
                ?>

                <?php if($orders > 0): ?>
                    <small class="badge bg-warning"><?php echo e($orders); ?></small>
                <?php endif; ?>
            </span>
        </a>
    </li>

    <!-- delivered orders -->
    <li class="side-nav-item nav-item <?php echo e(areActiveRoutes(['deliveryman.delivered'], 'tt-menu-item-active')); ?>">
        <a href="<?php echo e(route('deliveryman.delivered')); ?>"
            class="side-nav-link <?php echo e(areActiveRoutes(['deliveryman.delivered'])); ?>">
            <span class="tt-nav-link-icon"><i data-feather="gift"></i></span>
            <span class="tt-nav-link-text">
                <span><?php echo e(localize('Delivered Orders')); ?></span>

                <?php
                    $orders = App\Models\Order::where('deliveryman_id', $user->id)->latest();
                    $orders = $orders
                        ->where(function ($q) {
                            $q->where('delivery_status', 'delivered');
                        })
                        ->count();
                ?>

                <?php if($orders > 0): ?>
                    <small class="badge bg-success"><?php echo e($orders); ?></small>
                <?php endif; ?>
            </span>
        </a>
    </li>

    <!-- cancelled orders -->
    <li class="side-nav-item nav-item <?php echo e(areActiveRoutes(['deliveryman.cancelled'], 'tt-menu-item-active')); ?>">
        <a href="<?php echo e(route('deliveryman.cancelled')); ?>"
            class="side-nav-link <?php echo e(areActiveRoutes(['deliveryman.cancelled'])); ?>">
            <span class="tt-nav-link-icon"><i data-feather="x-square"></i></span>
            <span class="tt-nav-link-text">
                <span><?php echo e(localize('Cancelled Orders')); ?></span>

                <?php
                    $orders = App\Models\Order::where('deliveryman_id', $user->id)->latest();
                    $orders = $orders
                        ->where(function ($q) {
                            $q->where('delivery_status', 'cancelled');
                        })
                        ->count();
                ?>

                <?php if($orders > 0): ?>
                    <small class="badge bg-soft-danger"><?php echo e($orders); ?></small>
                <?php endif; ?>
            </span>
        </a>
    </li>


    <!-- Earning Histories -->
    <li class="side-nav-item nav-item">
        <a href="<?php echo e(route('deliveryman.earning-history')); ?>" class="side-nav-link">
            <span class="tt-nav-link-icon"><i data-feather="dollar-sign"></i></span>
            <span class="tt-nav-link-text"><?php echo e(localize('Earning Histories')); ?></span>
        </a>
    </li>

    <!-- Payment Histories -->
    <li class="side-nav-item nav-item">
        <a href="<?php echo e(route('deliveryman.payout')); ?>" class="side-nav-link">
            <span class="tt-nav-link-icon"><i data-feather="credit-card"></i></span>
            <span class="tt-nav-link-text"><?php echo e(localize('payout Histories')); ?></span>
        </a>
    </li>
</ul>
<?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/backend/inc/deliverymanSidebarMenus.blade.php ENDPATH**/ ?>
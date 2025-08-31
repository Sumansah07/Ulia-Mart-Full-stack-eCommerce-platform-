<?php $__env->startSection('title'); ?>
    <?php echo e(localize('Dashboard')); ?> <?php echo e(getSetting('title_separator')); ?> <?php echo e(getSetting('system_title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dashboard')): ?>
        <section class="tt-section pt-4">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card tt-page-header">
                            <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                                <div class="tt-page-title">
                                    <h2 class="h5 mb-lg-0"><?php echo e(localize('Admin Dashboard')); ?></h2>
                                </div>
                                <div class="tt-action">

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_orders')): ?>
                                        <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-secondary"><i
                                                data-feather="shopping-cart" class="me-2"></i><?php echo e(localize('Manage Sales')); ?></a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_products')): ?>
                                        <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary ms-2"><i
                                                data-feather="plus" class="me-2"></i>
                                            <?php echo e(localize('Add Product')); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-xl-9">
                        <div class="row g-3">
                            <!-- total sales chart -->
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="card h-100 flex-column">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="text-muted"><?php echo e(localize('Total Earning')); ?></span>
                                            <div class="dropdown tt-tb-dropdown fs-sm">
                                                <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <?php if(isset($timelineText)): ?>
                                                        <?php echo e($timelineText); ?>

                                                    <?php else: ?>
                                                        <?php echo e(localize('Last 7 days')); ?>

                                                    <?php endif; ?>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end shadow">
                                                    <a class="dropdown-item"
                                                        href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(localize('Last 7 days')); ?></a>
                                                    <a class="dropdown-item"
                                                        href="<?php echo e(route('admin.dashboard')); ?>?&timeline=30"><?php echo e(localize('Last 30 days')); ?></a>
                                                    <a class="dropdown-item"
                                                        href="<?php echo e(route('admin.dashboard')); ?>?&timeline=90"><?php echo e(localize('Last 3 months')); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="fw-bold"><?php echo e(formatPrice($totalSalesData->totalEarning)); ?></h4>
                                    </div>
                                    <div id="totalSales"></div>
                                </div>
                            </div>
                            <!-- total sales chart -->


                            <!-- top 5 category sales chart -->
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="card h-100 flex-column">
                                    <div class="card-body d-flex flex-column h-100">
                                        <span class="text-muted"><?php echo e(localize('Top 5 Category Sales')); ?></span>
                                        <h4 class="fw-bold"><?php echo e($totalCatSalesData->totalCategorySalesCount); ?></h4>
                                        <div id="topFive"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- top 5 category sales chart -->

                            <!-- total order this month chart -->
                            <div class="col-sm-6 col-md-4 col-lg-4 d-none d-lg-block d-md-block">
                                <div class="card h-100 flex-column">
                                    <div class="card-body">
                                        <span class="text-muted"><?php echo e(localize('Last 30 Days Orders')); ?></span>
                                        <h4 class="fw-bold"><?php echo e($totalOrdersData->totalOrders); ?></h4>
                                    </div>
                                    <div id="last30DaysOrders"></div>
                                </div>
                            </div>
                            <!-- total order this month chart -->

                            <!-- sales this month chart -->
                            <div class="col-l2">
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="text-muted"><?php echo e(localize('Sales This Months')); ?></span>
                                        </div>
                                        <h4 class="fw-bold mb-0"><?php echo e(formatPrice($thisMonthSaleData->totalEarning)); ?></h4>
                                    </div>
                                    <div id="thisMonthChart" class="px-3"></div>
                                </div>
                            </div>
                            <!-- sales this month chart -->

                        </div>
                    </div>

                    <div class="col-xl-3">
                        <!-- top selling products -->
                        <div class="card h-100 flex-column">
                            <div class="card-body px-0">
                                <div class="px-3">
                                    <h5 class="fw-bold mb-1"><?php echo e(localize('Top Selling Products')); ?></h5>
                                    <span class="text-muted">
                                        <?php echo e(localize('We have listed ' . \App\Models\Product::count() . ' total products.')); ?></span>
                                </div>
                                <div class="tt-top-selling mt-3 h-25rem" data-simplebar>
                                    <ul class="tt-top-selling-list list-unstyled mb-0 px-3">
                                        <?php
                                            $top_selling_products = \App\Models\Product::where('total_sale_count', '>', 0)
                                                ->orderBy('total_sale_count', 'DESC')
                                                ->take(15)
                                                ->get();
                                        ?>
                                        <?php $__currentLoopData = $top_selling_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="py-3 d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md flex-shrink-0">
                                                        <img class="rounded-circle"
                                                            src="<?php echo e(uploadedAsset($product->thumbnail_image)); ?>"
                                                            alt="" />
                                                    </div>
                                                    <div class="ms-2">
                                                        <h6 class="fs-md mb-0 tt-line-clamp tt-clamp-1">
                                                            <?php echo e($product->collectLocalization('name')); ?>

                                                        </h6>
                                                        <span class="text-muted fs-sm"><?php echo e(localize('Brand')); ?>:
                                                            <?php echo e(optional($product->brand)->name); ?>

                                                        </span>
                                                    </div>
                                                </div>
                                                <span class="fw-bold heading-font text-end  cursor-pointer"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="<?php echo e(localize('Total Sales')); ?>">(<?php echo e($product->total_sale_count); ?>)</span>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- top selling products -->
                    </div>
                </div>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_orders')): ?>
                    <div class="row g-3 mb-3">
                        <a href="<?php echo e(route('admin.orders.index')); ?>" class="col-lg-3 col-sm-6">
                            <div class="card h-100 flex-column">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-lg">
                                            <div class="text-center bg-soft-primary rounded-circle">
                                                <span class="text-primary"> <i data-feather="shopping-bag"></i></span>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h4 class="mb-1"><?php echo e(\App\Models\Order::count()); ?></h4>
                                            <span class="text-muted"><?php echo e(localize('Total Orders')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="<?php echo e(route('admin.orders.index')); ?>?delivery_status=<?php echo e(orderPendingStatus()); ?>"
                            class="col-lg-3 col-sm-6">
                            <div class="card h-100 flex-column">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-lg">
                                            <div class="text-center bg-soft-warning rounded-circle">
                                                <span class="text-warning"> <i data-feather="clock"></i></span>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h4 class="mb-1"><?php echo e(\App\Models\Order::isPlacedOrPending()->count()); ?></h4>
                                            <span class="text-muted"><?php echo e(localize('Order Pending')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="<?php echo e(route('admin.orders.index')); ?>?delivery_status=<?php echo e(orderProcessingStatus()); ?>"
                            class="col-lg-3 col-sm-6">
                            <div class="card h-100 flex-column">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-lg">
                                            <div class="text-center bg-soft-info rounded-circle">
                                                <span class="text-info"> <i data-feather="refresh-cw"></i></span>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h4 class="mb-1"><?php echo e(\App\Models\Order::isProcessing()->count()); ?></h4>
                                            <span class="text-muted"><?php echo e(localize('Order Processing')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="<?php echo e(route('admin.orders.index')); ?>?delivery_status=<?php echo e(orderDeliveredStatus()); ?>"
                            class="col-lg-3 col-sm-6">
                            <div class="card h-100 flex-column">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-lg">
                                            <div class="text-center bg-soft-success rounded-circle">
                                                <span class="text-success"> <i data-feather="check-circle"></i></span>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h4 class="mb-1"><?php echo e(\App\Models\Order::isDelivered()->count()); ?></h4>
                                            <span class="text-muted"><?php echo e(localize('Total Delivered')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orders')): ?>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom-0">
                                    <div class="row justify-content-between g-3">
                                        <div class="col-auto flex-grow-1">
                                            <h5 class="mb-1"><?php echo e(localize('Recent Orders')); ?></h5>
                                            <span class="text-muted"><?php echo e(localize('Your 10 Most Recent Orders')); ?></span>
                                        </div>

                                        <div class="col-auto">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_orders')): ?>
                                                <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-primary">
                                                    <i data-feather="eye" width="18"></i>
                                                    <?php echo e(localize('View All')); ?>

                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                    $orders = App\Models\Order::latest()
                                        ->take(10)
                                        ->get();
                                ?>
                                <table class="table tt-footable border-top align-middle" data-use-parent-width="true">
                                    <thead>
                                        <tr>
                                            <th class="ps-4"><?php echo e(localize('Order Code')); ?></th>
                                            <th data-breakpoints="xs sm md"><?php echo e(localize('Customer')); ?></th>
                                            <th><?php echo e(localize('Placed On')); ?></th>
                                            <th data-breakpoints="xs"><?php echo e(localize('Items')); ?></th>
                                            <th data-breakpoints="xs"><?php echo e(localize('Payment Status')); ?></th>
                                            <th data-breakpoints="xs"><?php echo e(localize('Delivery Status')); ?></th>
                                            <th data-breakpoints="xs"><?php echo e(localize('Delivery Type')); ?></th>
                                            <th data-breakpoints="xs" class="text-end"><?php echo e(localize('Action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>

                                                <td class="fs-sm ps-4">
                                                    <?php echo e(getSetting('order_code_prefix')); ?><?php echo e($order->orderGroup->order_code); ?>

                                                </td>

                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md">
                                                            <img class="rounded-circle"
                                                                src="<?php echo e(uploadedAsset(optional($order->user)->avatar)); ?>"
                                                                alt="avatar"
                                                                onerror="this.onerror=null;this.src='<?php echo e(staticAsset('backend/assets/img/placeholder-thumb.png')); ?>';" />
                                                        </div>
                                                        <div class="ms-2">
                                                            <h6 class="fs-sm mb-0"><?php echo e(optional($order->user)->name); ?></h6>
                                                            <span class="text-muted fs-sm">
                                                                <?php echo e(optional($order->user)->phone ?? '-'); ?></span>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <span
                                                        class="fs-sm"><?php echo e(date('d M, Y', strtotime($order->created_at))); ?></span>
                                                </td>



                                                <td class="tt-tb-price">
                                                    <span class="fw-bold">
                                                        <?php echo e($order->orderItems()->count()); ?>

                                                    </span>
                                                </td>

                                                <td>
                                                    <?php if($order->payment_status == unpaidPaymentStatus()): ?>
                                                        <span class="badge bg-soft-danger rounded-pill text-capitalize">
                                                            <?php echo e($order->payment_status); ?>

                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-soft-primary rounded-pill text-capitalize">
                                                            <?php echo e($order->payment_status); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </td>

                                                <td>
                                                    <?php if($order->delivery_status == orderDeliveredStatus()): ?>
                                                        <span class="badge bg-soft-primary rounded-pill text-capitalize">
                                                            <?php echo e($order->delivery_status); ?>

                                                        </span>
                                                    <?php elseif($order->delivery_status == orderCancelledStatus()): ?>
                                                        <span class="badge bg-soft-danger rounded-pill text-capitalize">
                                                            <?php echo e(localize(Str::title(Str::replace('_', ' ', $order->delivery_status)))); ?>

                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-soft-info rounded-pill text-capitalize">
                                                            <?php echo e(localize(Str::title(Str::replace('_', ' ', $order->delivery_status)))); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </td>

                                                <td>
                                                    <span
                                                        class="badge rounded-pill text-capitalize <?php echo e($order->shipping_delivery_type == getScheduledDeliveryType() ? 'bg-soft-warning' : 'bg-secondary'); ?>">
                                                        <?php echo e(Str::title(Str::replace('_', ' ', $order->shipping_delivery_type))); ?>

                                                    </span>
                                                </td>

                                                <td class="text-end">
                                                    <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>"
                                                        class="btn btn-sm p-0 tt-view-details" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="View Details">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- counter in dashboard -->
                <div class="row g-3 mb-3">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_orders')): ?>
                        <a href="<?php echo e(route('admin.orders.index')); ?>?delivery_status=<?php echo e(orderPickedUpStatus()); ?>"
                            class="col-lg-3 col-sm-6">
                            <div class="card h-100 flex-column">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-lg">
                                            <div class="text-center bg-soft-info rounded-circle">
                                                <span class="text-info"> <i data-feather="arrow-down"></i></span>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h4 class="mb-1"><?php echo e(\App\Models\Order::isPickedUp()->count()); ?></h4>
                                            <span class="text-muted"><?php echo e(localize('Picked Up Orders')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="<?php echo e(route('admin.orders.index')); ?>?delivery_status=<?php echo e(orderCancelledStatus()); ?>"
                            class="col-lg-3 col-sm-6">
                            <div class="card h-100 flex-column">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-lg">
                                            <div class="text-center bg-soft-accent rounded-circle">
                                                <span class="text-accent"> <i data-feather="x"></i></span>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h4 class="mb-1"><?php echo e(\App\Models\Order::isCancelled()->count()); ?></h4>
                                            <span class="text-muted"><?php echo e(localize('Cancelled Orders')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="<?php echo e(route('admin.orders.index')); ?>?delivery_status=<?php echo e(orderOutForDeliveryStatus()); ?>"
                            class="col-lg-3 col-sm-6">
                            <div class="card h-100 flex-column">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-lg">
                                            <div class="text-center bg-soft-warning rounded-circle">
                                                <span class="text-warning"> <i data-feather="truck"></i></span>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h4 class="mb-1"><?php echo e(\App\Models\Order::isOutForDelivery()->count()); ?></h4>
                                            <span class="text-muted"><?php echo e(localize('Out For Delivery')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="<?php echo e(route('admin.orders.index')); ?>?payment_status=<?php echo e(paidPaymentStatus()); ?>"
                            class="col-lg-3 col-sm-6">
                            <div class="card h-100 flex-column">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-lg">
                                            <div class="text-center bg-soft-success rounded-circle">
                                                <span class="text-success"> <i data-feather="dollar-sign"></i></span>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h4 class="mb-1"><?php echo e(\App\Models\Order::isPaid()->count()); ?></h4>
                                            <span class="text-muted"><?php echo e(localize('Paid Orders')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="<?php echo e(route('admin.orders.index')); ?>?payment_status=<?php echo e(unpaidPaymentStatus()); ?>"
                            class="col-lg-3 col-sm-6">
                            <div class="card h-100 flex-column">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-lg">
                                            <div class="text-center bg-soft-info rounded-circle">
                                                <span class="text-info"> <i data-feather="credit-card"></i></span>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h4 class="mb-1"><?php echo e(\App\Models\Order::isUnpaid()->count()); ?></h4>
                                            <span class="text-muted"><?php echo e(localize('Unpaid Orders')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endif; ?>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-accent rounded-circle">
                                            <span class="text-accent"> <i data-feather="calendar"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e(formatPrice($todayEarning)); ?></h4>
                                        <span class="text-muted"><?php echo e(localize("Today's Earning")); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-warning rounded-circle">
                                            <span class="text-warning"> <i data-feather="pause"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e(formatPrice($todayPendingEarning)); ?></h4>
                                        <span class="text-muted"><?php echo e(localize("Today's Pending Earning")); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-success rounded-circle">
                                            <span class="text-success"> <i data-feather="bar-chart-2"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e(formatPrice($thisYearEarning)); ?></h4>
                                        <span class="text-muted"><?php echo e(localize('This Year Earning')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3 col-sm-6">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-info rounded-circle">
                                            <span class="text-info"> <i data-feather="dollar-sign"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e(formatPrice($totalEarning)); ?></h4>
                                        <span class="text-muted"><?php echo e(localize('Total Earning')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-accent rounded-circle">
                                            <span class="text-accent"> <i data-feather="shopping-cart"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e(\App\Models\Product::sum('total_sale_count')); ?></h4>
                                        <span class="text-muted"><?php echo e(localize('Total Product Sale')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-warning rounded-circle">
                                            <span class="text-warning"> <i data-feather="calendar"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e($todaySaleCount); ?></h4>
                                        <span class="text-muted"><?php echo e(localize("Today's Product Sale")); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-success rounded-circle">
                                            <span class="text-success"> <i data-feather="check-circle"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e($monthSaleCount); ?></h4>
                                        <span class="text-muted"><?php echo e(localize("This Month's Product Sale")); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-info rounded-circle">
                                            <span class="text-info"> <i data-feather="activity"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e($yearSaleCount); ?></h4>
                                        <span class="text-muted"><?php echo e(localize("This Year's Product Sale")); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="<?php echo e(route('admin.customers.index')); ?>" class="col-lg-3 col-sm-6">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-accent rounded-circle">
                                            <span class="text-accent"> <i data-feather="users"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e(\App\Models\User::where('user_type', 'customer')->count()); ?>

                                        </h4>
                                        <span class="text-muted"><?php echo e(localize('Total Customers')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="<?php echo e(route('admin.subscribers.index')); ?>" class="col-lg-3 col-sm-6">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-warning rounded-circle">
                                            <span class="text-warning"> <i data-feather="at-sign"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e(\App\Models\SubscribedUser::count()); ?></h4>
                                        <span class="text-muted"><?php echo e(localize('Total Subscribers')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="<?php echo e(route('admin.categories.index')); ?>" class="col-lg-3 col-sm-6">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-success rounded-circle">
                                            <span class="text-success"> <i data-feather="sliders"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e(\App\Models\Category::count()); ?></h4>
                                        <span class="text-muted"><?php echo e(localize('Total Categories')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="<?php echo e(route('admin.brands.index')); ?>" class="col-lg-3 col-sm-6 d-none">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-success rounded-circle">
                                            <span class="text-success"> <i data-feather="check-circle"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e(\App\Models\Brand::count()); ?></h4>
                                        <span class="text-muted"><?php echo e(localize('Total Brands')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- counter in dashboard -->

            </div>
        </section>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        "use strict";
        // total earning chart
        var totalSales = {
            chart: {
                type: "area",
                height: 80,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: "smooth",
                width: 2,
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: '<?php echo e(localize('Earning')); ?>',
                data: [<?php echo $totalSalesData->amount; ?>],
            }, ],
            labels: [<?php echo $totalSalesData->labels; ?>],
            xaxis: {
                type: "datetime",
            },
            yaxis: {
                min: 0,
            },
            colors: ["#FF7C08"],
        };
        new ApexCharts(document.querySelector("#totalSales"), totalSales).render();

        //pie chart top five
        var optionsTopFive = {
            chart: {
                type: "donut",
                height: 100,
                offsetY: 15,
                offsetX: -20,
            },
            series: <?php echo $totalCatSalesData->series; ?>,
            labels: [<?php echo $totalCatSalesData->labels; ?>],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200,
                    },
                    legend: {
                        position: "bottom",
                        show: false,
                    },
                    dataLabels: {
                        enabled: false,
                    },
                },
            }, ],
        };

        var chartTopFive = new ApexCharts(
            document.querySelector("#topFive"),
            optionsTopFive
        );
        chartTopFive.render();

        // last 30 days order chart 
        var optionsBar = {
            chart: {
                type: "bar",
                height: 80,
                width: "100%",
                stacked: true,
                offsetX: -3,
                sparkline: {
                    enabled: true,
                },
                zoom: {
                    enabled: false,
                },
                toolbar: {
                    show: false,
                },
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false,
                    },
                    columnWidth: "60%",
                    endingShape: "rounded",
                },
            },
            colors: ["#1E90FF"],
            series: [{
                name: "Orders",
                data: [<?php echo $totalOrdersData->amount; ?>],
            }, ],
            labels: [<?php echo $totalOrdersData->labels; ?>],
            xaxis: {
                type: "datetime",
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
                crosshairs: {
                    show: false,
                },
                labels: {
                    show: false,
                    style: {
                        fontSize: "14px",
                    },
                },
            },
            grid: {
                xaxis: {
                    lines: {
                        show: false,
                    },
                },
                yaxis: {
                    lines: {
                        show: false,
                    },
                },
            },
            yaxis: {
                axisBorder: {
                    show: false,
                },
                labels: {
                    show: false,
                },
            },
            legend: {
                floating: false,
                position: "bottom",
                horizontalAlign: "right",
            },
            tooltip: {
                shared: true,
                intersect: false,
            },
        };
        var chartBar = new ApexCharts(document.querySelector("#last30DaysOrders"), optionsBar);
        chartBar.render();

        // this month sales 
        var options = {
            chart: {
                height: 210,
                width: "100%",
                type: "area",
                offsetX: -10,
                zoom: {
                    enabled: false,
                },
                toolbar: {
                    show: false,
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "smooth",
                width: 2,
            },

            colors: ["#4EB529"],
            series: [{
                name: "Sales",
                data: [<?php echo $thisMonthSaleData->amount; ?>],
            }],
            zoom: {
                enabled: false,
            },
            legend: {
                show: false,
                enabled: false,
            },
            labels: [<?php echo $thisMonthSaleData->labels; ?>],
            xaxis: {
                labels: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },

            }
        };
        var chart = new ApexCharts(document.querySelector("#thisMonthChart"), options);
        chart.render();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/backend/pages/dashboard.blade.php ENDPATH**/ ?>
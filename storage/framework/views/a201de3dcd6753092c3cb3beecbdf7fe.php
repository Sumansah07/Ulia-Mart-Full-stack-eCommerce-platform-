<a class="nav-link position-relative tt-notification" href="#" role="button" id="notificationDropdown"
    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside">
    <i data-feather="bell"></i>
    <?php if($newMsgCount > 0 || $newOrdersCount > 0): ?>
        <span class="tt-notification-dot bg-danger rounded-circle"></span>
    <?php endif; ?>
</a>

<div class="dropdown-menu dropdown-menu-end py-0 shadow-sm border-0" aria-labelledby="notificationDropdown">
    <div class="card position-relative border-0">
        <div class="card-body p-0">
            <div class="scrollbar-overlay">

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orders')): ?>
                    <?php if($newOrdersCount > 0): ?>
                        <div class="p-3 position-relative border-bottom">
                            <a href="<?php echo e(route('admin.orders.index')); ?>" class="d-flex align-items-center">
                                <h4 class="fs-md mb-0"><i data-feather="shopping-cart" class="me-1 text-accent"
                                        width="18"></i>
                                    <?php echo e(localize('New Order Placed')); ?> (<?php echo e($newOrdersCount); ?>)</h4>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contact_us_messages')): ?>
                    <?php if($newMsgCount > 0): ?>
                        <div class="p-3 position-relative border-bottom">
                            <a href="<?php echo e(route('admin.queries.index')); ?>" class="d-flex align-items-center">
                                <h4 class="fs-md mb-0"><i data-feather="mail" width="18" class="me-1 text-success"></i>
                                    <?php echo e(localize('New Contact Message')); ?> (<?php echo e($newMsgCount); ?>)</h4>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>


                <?php if(auth()->user()->user_type == 'admin'): ?>
                    <?php if(auth()->user()->unreadNotifications->count() > 0): ?>

                        <?php $__currentLoopData = auth()->user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-3 position-relative border-bottom">
                                <a href="<?php echo e($noti->data['url']); ?>" class="d-flex align-items-center">
                                    <h4 class="fs-md mb-0"><i data-feather="mail" width="18"
                                            class="me-1 text-success"></i>
                                        <?php echo e($noti->data['message']); ?></h4>
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>
                <?php endif; ?>



                <?php if(auth()->user()->user_type == 'deliveryman'): ?>
                    <?php if(auth()->user()->unreadNotifications->count() > 0): ?>

                        <?php $__currentLoopData = auth()->user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-3 position-relative border-bottom">
                                <a href="<?php echo e($noti->data['url']); ?>" class="d-flex align-items-center">
                                    <h4 class="fs-md mb-0"><i data-feather="mail" width="18"
                                            class="me-1 text-success"></i>
                                        <?php echo e($noti->data['message']); ?></h4>
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>
                <?php endif; ?>

                <?php if($newMsgCount <= 0 && $newOrdersCount <= 0): ?>
                    <div class="p-3 position-relative border-bottom">
                        <h4 class="fs-md mb-0 text-muted fw-normal"><i data-feather="info" width="18"
                                class="me-1 text-danger"></i><?php echo e(localize('No New Notification')); ?>

                        </h4>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/components/notification-component.blade.php ENDPATH**/ ?>
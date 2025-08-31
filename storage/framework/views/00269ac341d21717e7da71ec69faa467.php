<?php $__env->startSection('title'); ?>
    <?php echo e(localize('Dashboard')); ?> <?php echo e(getSetting('title_separator')); ?> <?php echo e(getSetting('system_title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 mb-3">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0"><?php echo e(localize('Deliveryman Dashboard')); ?></h2>
                            </div>
                            <div class="tt-action">
                                
                            </div>
                        </div>
                    </div>
                </div>

               
                    <a href="<?php echo e(route('deliveryman.earning-history')); ?>" class="col-lg-4 col-sm-6 mb-3">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-primary rounded-circle">
                                            <span class="text-primary"> <i data-feather="shopping-bag"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e(auth()->user()->wallets->sum('amount')); ?></h4>
                                        <span class="text-muted"><?php echo e(localize('Total Earnings')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>


                    <a href="<?php echo e(route('deliveryman.assigned')); ?>" class="col-lg-4 col-sm-6 mb-3">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-primary rounded-circle">
                                            <span class="text-primary"> <i data-feather="shopping-bag"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e($assigned); ?></h4>
                                        <span class="text-muted"><?php echo e(localize('Total Assigned Order')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>


                    <a href="<?php echo e(route('deliveryman.pickedUp')); ?>" class="col-lg-4 col-sm-6 mb-3">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-primary rounded-circle">
                                            <span class="text-primary"> <i data-feather="shopping-bag"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e($picked); ?></h4>
                                        <span class="text-muted"><?php echo e(localize('Total Picked Order')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>


                    <a href="<?php echo e(route('deliveryman.outForDelivery')); ?>" class="col-lg-4 col-sm-6 mb-3">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-primary rounded-circle">
                                            <span class="text-primary"> <i data-feather="shopping-bag"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e($out_for_delivery); ?></h4>
                                        <span class="text-muted"><?php echo e(localize('Out for Delivery')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>



                    <a href="<?php echo e(route('deliveryman.delivered')); ?>" class="col-lg-4 col-sm-6 mb-3">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-primary rounded-circle">
                                            <span class="text-primary"> <i data-feather="shopping-bag"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e($delivered); ?></h4>
                                        <span class="text-muted"><?php echo e(localize('Total Delivered Order')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>



                    <a href="<?php echo e(route('deliveryman.cancelled')); ?>" class="col-lg-4 col-sm-6 mb-3">
                        <div class="card h-100 flex-column">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <div class="text-center bg-soft-primary rounded-circle">
                                            <span class="text-primary"> <i data-feather="shopping-bag"></i></span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1"><?php echo e($cancelled); ?></h4>
                                        <span class="text-muted"><?php echo e(localize('Total Cancelled Order')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                



            </div>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/deliveryman/dashboard.blade.php ENDPATH**/ ?>
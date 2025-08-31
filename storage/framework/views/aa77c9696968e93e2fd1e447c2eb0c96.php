<?php $__env->startSection('title'); ?>
    <?php echo e(localize('All Deliverymen')); ?> <?php echo e(getSetting('title_separator')); ?> <?php echo e(getSetting('system_title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0"><?php echo e(localize('All Deliverymen')); ?></h2>
                            </div>
                            <div class="tt-action">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_deliveryman')): ?>
                                    <a href="<?php echo e(route('admin.deliverymen.create')); ?>" class="btn btn-primary"><i
                                            data-feather="plus"></i> <?php echo e(localize('Add Deliveryman')); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12">
                    <div class="card mb-4" id="section-1">
                        <form class="app-search" action="<?php echo e(Request::fullUrl()); ?>" method="GET">
                            <div class="card-header border-bottom-0">
                                <div class="row justify-content-between g-3">
                                    <div class="col-auto flex-grow-1">
                                        <div class="tt-search-box">
                                            <div class="input-group">
                                                <span class="position-absolute top-50 start-0 translate-middle-y ms-2"> <i
                                                        data-feather="search"></i></span>
                                                <input class="form-control rounded-start w-100" type="text"
                                                    id="search" name="search" placeholder="<?php echo e(localize('Search')); ?>"
                                                    <?php if(isset($searchKey)): ?>
                                                        value="<?php echo e($searchKey); ?>"
                                                    <?php endif; ?>>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-secondary">
                                            <i data-feather="search" width="18"></i>
                                            <?php echo e(localize('Search')); ?>

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <table class="table tt-footable border-top" data-use-parent-width="true">
                            <thead>
                                <tr>
                                    <th class="text-center"><?php echo e(localize('S/L')); ?></th>
                                    <th><?php echo e(localize('Name')); ?></th>
                                    <th data-breakpoints="xs sm"><?php echo e(localize('Location')); ?></th>
                                    <th data-breakpoints="xs sm"><?php echo e(localize('Email')); ?></th>
                                    <th data-breakpoints="xs sm"><?php echo e(localize('Phone')); ?></th>
                                    <th data-breakpoints="xs sm"><?php echo e(localize('Balance')); ?></th>
                                    <th data-breakpoints="xs sm" class="text-end"><?php echo e(localize('Action')); ?>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $deliverymen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $deliveryman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center">
                                            <?php echo e($key + 1 + ($deliverymen->currentPage() - 1) * $deliverymen->perPage()); ?>

                                        </td>
                                        <td>
                                            <span class="fw-semibold">
                                                <?php echo e($deliveryman->name); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill bg-secondary">
                                                <?php echo e(@$deliveryman->location->name); ?>

                                            </span>

                                        </td>
                                        <td>
                                            <?php echo e($deliveryman->email); ?>

                                        </td>
                                        <td>
                                            <?php if($deliveryman->phone != null): ?>
                                                <?php echo e($deliveryman->phone); ?>

                                            <?php else: ?>
                                                <span class="badge rounded-pill bg-secondary">
                                                    <?php echo e(localize('N/A')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <span class="text-accent fw-bold">
                                                <?php echo e(formatPrice($deliveryman->user_balance)); ?>

                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <div class="dropdown tt-tb-dropdown">
                                                <button type="button" class="btn p-0" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end shadow">

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_deliveryman')): ?>
                                                        <a class="dropdown-item"
                                                            href="<?php echo e(route('admin.deliverymen.edit', ['id' => $deliveryman->id, 'lang_key' => env('DEFAULT_LANGUAGE')])); ?>&localize">
                                                            <i data-feather="edit-3" class="me-2"></i><?php echo e(localize('Edit')); ?>

                                                        </a>
                                                    <?php endif; ?>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_deliveryman')): ?>
                                                        <a href="#" class="dropdown-item confirm-delete"
                                                            data-href="<?php echo e(route('admin.deliverymen.delete', $deliveryman->id)); ?>"
                                                            title="<?php echo e(localize('Delete')); ?>">
                                                            <i data-feather="trash-2" class="me-2"></i>
                                                            <?php echo e(localize('Delete')); ?>

                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <!--pagination start-->
                        <div class="d-flex align-items-center justify-content-between px-4 pb-4">
                            <span><?php echo e(localize('Showing')); ?>

                                <?php echo e($deliverymen->firstItem()); ?>-<?php echo e($deliverymen->lastItem()); ?> <?php echo e(localize('of')); ?>

                                <?php echo e($deliverymen->total()); ?> <?php echo e(localize('results')); ?></span>
                            <nav>
                                <?php echo e($deliverymen->appends(request()->input())->links()); ?>

                            </nav>
                        </div>
                        <!--pagination end-->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <script>
        "use strict";

        function updateBanStatus(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('<?php echo e(route('admin.customers.updateBanStatus')); ?>', {
                    _token: '<?php echo e(csrf_token()); ?>',
                    id: el.value,
                    status: status
                },
                function(data) {
                    if (data == 1) {
                        location.reload();
                    } else {
                        notifyMe('danger', '<?php echo e(localize('Something went wrong')); ?>');
                    }
                });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/backend/pages/deliverymen/index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(localize('Add New Deliveryman')); ?> <?php echo e(getSetting('title_separator')); ?> <?php echo e(getSetting('system_title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0"><?php echo e(localize('Add New Deliveryman')); ?></h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4 g-4">

                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">
                    <form action="<?php echo e(route('admin.deliverymen.store')); ?>" method="POST" class="pb-650">
                        <?php echo csrf_field(); ?>
                        <!--basic information start-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4"><?php echo e(localize('Basic Information')); ?></h5>

                                <div class="mb-4">
                                    <label for="name" class="form-label"><?php echo e(localize('Name')); ?><span
                                            class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" id="name"
                                        placeholder="<?php echo e(localize('Type name')); ?>" name="name"
                                        value="<?php echo e(old('name')); ?>">
                                    <?php if($errors->has('name')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="form-label"><?php echo e(localize('Email')); ?><span
                                            class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="email" id="email"
                                        placeholder="<?php echo e(localize('Type email')); ?>" name="email"
                                        value="<?php echo e(old('email')); ?>">
                                    <?php if($errors->has('email')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-4">
                                    <label for="phone" class="form-label"><?php echo e(localize('Phone')); ?><span
                                            class="text-danger ms-1"><?php echo e(@getSetting('registration_with') == 'email_and_phone' ? '*' : ''); ?></span></label>
                                    <input class="form-control" type="text" id="phone"
                                        placeholder="<?php echo e(localize('Type phone')); ?>" name="phone"
                                        value="<?php echo e(old('phone')); ?>"
                                        <?php echo e(@getSetting('registration_with') == 'email_and_phone' ? 'required' : ''); ?>>
                                    <?php if($errors->has('phone')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('phone')); ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-4">
                                    <label for="location_id"
                                        class="form-label"><?php echo e(localize('Select User Location')); ?></label>
                                    <select class="form-select select2" name="location_id">
                                        <option value=""><?php echo e(localize('Select location')); ?></option>
                                        <?php $__currentLoopData = \App\Models\Location::where('is_published', 1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($location->id); ?>">
                                                <?php echo e($location->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <?php if(getSetting('delivery_boy_payment_type') == 'salary'): ?>
                                    <div class="mb-4">
                                        <label for="salary" class="form-label"><?php echo e(localize('Salary')); ?></label>
                                        <input type="number" step="any" name="salary" class="form-control" placeholder="<?php echo e(localize('Deliveryman Salary')); ?>" id="salary">

                                        <?php if($errors->has('salary')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('salary')); ?></span>
                                    <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                               

                                <div class="mb-4">
                                    <label for="address" class="form-label"><?php echo e(localize('Address')); ?><span
                                            class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" type="address" id="address" placeholder="<?php echo e(localize('Type address')); ?>"
                                        name="address" rows="4"></textarea>

                                        <?php if($errors->has('address')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('address')); ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="form-label"><?php echo e(localize('Password')); ?><span
                                            class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="password" id="password"
                                        placeholder="<?php echo e(localize('Type password')); ?>" name="password">
                                    <?php if($errors->has('password')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label"><?php echo e(localize('Avatar')); ?> </label>
                                    <div class="tt-image-drop rounded">
                                        <span class="fw-semibold"><?php echo e(localize('Choose Avatar Image')); ?></span>
                                        <!-- choose media -->
                                        <div class="tt-product-thumb show-selected-files mt-3">
                                            <div class="avatar avatar-xl cursor-pointer choose-media"
                                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                                onclick="showMediaManager(this)" data-selection="single">
                                                <input type="hidden" name="image">
                                                <div class="no-avatar rounded-circle">
                                                    <span><i data-feather="plus"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- choose media -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--basic information end-->

                        <!-- submit button -->
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-4">
                                    <button class="btn btn-primary" type="submit">
                                        <i data-feather="save" class="me-1"></i> <?php echo e(localize('Save Changes')); ?>

                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- submit button end -->

                    </form>
                </div>

                <!--right sidebar-->
                <div class="col-xl-3 order-1 order-md-1 order-lg-1 order-xl-2">
                    <div class="card tt-sticky-sidebar d-none d-xl-block">
                        <div class="card-body">
                            <h5 class="mb-4"><?php echo e(localize('Deliveryman Information')); ?></h5>
                            <div class="tt-vertical-step">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#section-1" class="active"><?php echo e(localize('Basic Information')); ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/backend/pages/deliverymen/create.blade.php ENDPATH**/ ?>
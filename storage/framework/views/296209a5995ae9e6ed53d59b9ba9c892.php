<?php $__env->startSection('title'); ?>
    <?php echo e(localize('Home')); ?> <?php echo e(getSetting('title_separator')); ?> <?php echo e(getSetting('system_title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
    <!--hero section start-->
    <?php echo $__env->make('frontend.default.pages.partials.home.hero', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!--hero section end-->

    <!--features section start-->
    <?php echo $__env->make('frontend.default.pages.partials.home.features', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!--features section end-->

    <!--featured products start-->
    <?php echo $__env->make('frontend.default.pages.partials.home.featuredProductsNew', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!--featured products end-->
    
    <?php echo $__env->make('frontend.default.pages.partials.home.categorywise', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--newsletter subscription start-->
    <?php echo $__env->make('frontend.default.pages.partials.home.newsletter-subscription', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!--newsletter subscription end-->

<?php $__env->stopSection(); ?>

<!-- <?php $__env->startSection('scripts'); ?>
    <script>
        "use strict";

        // runs when the document is ready
        $(document).ready(function() {
            <?php if(\App\Models\Location::where('is_published', 1)->count() > 1): ?>
                notifyMe('info', '<?php echo e(localize('Select your location if not selected')); ?>');
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?> -->

<?php echo $__env->make('frontend.default.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/frontend/default/pages/home.blade.php ENDPATH**/ ?>
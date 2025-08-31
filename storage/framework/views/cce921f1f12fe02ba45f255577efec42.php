<!DOCTYPE html>

<?php
    $locale = str_replace('_', '-', app()->getLocale()) ?? 'en';
    $localLang = \App\Models\Language::where('code', $locale)->first();
    if ($localLang == null) {
        $localLang = \App\Models\Language::where('code', 'en')->first();
    }
?>

<?php if($localLang->is_rtl == 1): ?>
    <html dir="rtl" lang="<?php echo e($locale); ?>" data-bs-theme="light">
<?php else: ?>
    <html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" data-bs-theme="light">
<?php endif; ?>


<head>
    <!--required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    


    <!--favicon icon-->
    <?php
        $faviconUrl = getSetting('favicon') ? uploadedAsset(getSetting('favicon')) : staticAsset('frontend/default/assets/img/favicon.jpg');
    ?>
    <link rel="icon" href="<?php echo e($faviconUrl); ?>" type="image/jpg" sizes="16x16">
    <link rel="shortcut icon" href="<?php echo e($faviconUrl); ?>" type="image/jpg">
    <link rel="apple-touch-icon" href="<?php echo e($faviconUrl); ?>" sizes="180x180">

    <!--title-->
    <title>
        <?php echo $__env->yieldContent('title'); ?> - <?php echo e(getSetting('site_name')); ?>

    </title>

    <!--build:css-->
    <?php echo $__env->make('frontend.default.inc.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- endbuild -->

    <!-- recaptcha -->
    <?php if(getSetting('enable_recaptcha') == 1): ?>
        <?php echo RecaptchaV3::initJs(); ?>

    <?php endif; ?>
    <!-- recaptcha -->

    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 80px;
        }
        .navbar-brand img {
            height: 40px;
        }
        .auth-navbar {
            background-color: #fff;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .card {
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
        }
        .nav-tabs .nav-link.active {
            color: #198754;
            border-bottom: 2px solid #198754;
            background-color: transparent;
        }
        .form-control {
            padding: 0.75rem 1rem;
        }
        .btn-success {
            background-color: #198754;
            border-color: #198754;
        }
        .navbar-brand img {
            height: 50px;
            max-width: 100%;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top auth-navbar">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(staticAsset('frontend/default/assets/images/uliaa-mart-logo.jpeg')); ?>" alt="<?php echo e(getSetting('site_name')); ?>">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('home')); ?>"><?php echo e(localize('Home')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('products.index')); ?>"><?php echo e(localize('Shop')); ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--preloader start-->
    <div id="preloader">
        <img src="<?php echo e(staticAsset('frontend/default/assets/images/uliaa-mart-logo.jpeg')); ?>" alt="preloader" class="img-fluid" max-width="180">
    </div>
    <!--preloader end-->

    <!--main content wrapper start-->
    <div class="main-wrapper">
        <?php echo $__env->yieldContent('contents'); ?>
    </div>

    <!-- Footer -->
    <footer class="py-4 mt-5">
        <div class="container">
            <div class="text-center text-muted">
                <p class="mb-0">&copy; <?php echo e(date('Y')); ?> <?php echo e(getSetting('site_name')); ?>. <?php echo e(localize('All rights reserved')); ?>.</p>
            </div>
        </div>
    </footer>

    <!-- scripts -->
    <?php echo $__env->yieldContent('scripts'); ?>

    <!--build:js-->
    <?php echo $__env->make('frontend.default.inc.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!--endbuild-->
</body>

</html>
<?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/layouts/auth.blade.php ENDPATH**/ ?>
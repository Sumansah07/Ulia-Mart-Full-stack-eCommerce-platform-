<!DOCTYPE html>
@php
    $locale = str_replace('_', '-', app()->getLocale()) ?? 'en';
    $localLang = \App\Models\Language::where('code', $locale)->first();
    if ($localLang == null) {
        $localLang = \App\Models\Language::where('code', 'en')->first();
    }
@endphp

@if (isset($localLang) && $localLang->is_rtl == 1)
    <html dir="rtl" lang="{{ $locale }}" data-bs-theme="light">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
@endif

<head>
    <!--required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="format-detection" content="telephone=no">
    <meta name="theme-color" content="#006633">


    <!--meta-->
    <meta name="robots" content="index, follow">
    <meta name="description" content="{{ getSetting('global_meta_description') }}">
    <meta name="keywords" content="{{ getSetting('global_meta_keywords') }}">

    <!--favicon icon-->
    @php
        $faviconUrl = getSetting('favicon') ? uploadedAsset(getSetting('favicon')) : staticAsset('frontend/default/assets/img/favicon.jpg');
    @endphp
    <link rel="icon" href="{{ $faviconUrl }}" type="image/jpg" sizes="16x16">
    <link rel="shortcut icon" href="{{ $faviconUrl }}" type="image/jpg">
    <link rel="apple-touch-icon" href="{{ $faviconUrl }}" sizes="180x180">

    <!--title-->
    <title>
        @yield('title', getSetting('system_title'))
    </title>

    @yield('meta')

    @if (!isset($detailedProduct) && !isset($blog))
        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="{{ getSetting('global_meta_title') }}" />
        <meta itemprop="description" content="{{ getSetting('global_meta_description') }}" />
        <meta itemprop="image" content="{{ uploadedAsset(getSetting('global_meta_image')) }}" />

        <!-- Twitter Card data -->
        <meta name="twitter:card" content="product" />
        <meta name="twitter:site" content="@publisher_handle" />
        <meta name="twitter:title" content="{{ getSetting('global_meta_title') }}" />
        <meta name="twitter:description" content="{{ getSetting('global_meta_description') }}" />
        <meta name="twitter:creator"
            content="@author_handle"/>
    <meta name="twitter:image" content="{{ uploadedAsset(getSetting('global_meta_image')) }}"/>

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ getSetting('global_meta_title') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('home') }}" />
    <meta property="og:image" content="{{ uploadedAsset(getSetting('global_meta_image')) }}" />
    <meta property="og:description" content="{{ getSetting('global_meta_description') }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endif

    <!-- head-scripts -->
    @include('frontend.default.inc.head-scripts')
    <!-- head-scripts -->

    <!--build:css-->
    @include('frontend.default.inc.css', ['localLang' => $localLang])
    <!-- endbuild -->
    @php
        echo getSetting('frontend_header_custom_css');
    @endphp

    <!-- Uliaa Mart Custom Styles -->
    @include('frontend.default.inc.uliaa-style')

    <!-- Hero Section Custom Styles -->
    @include('frontend.default.inc.carousel-styles')

    <!-- Featured Products Custom Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/featured-products-new.css') }}">

    <!-- My Account Custom Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/my-account-new.css') }}">

    <!-- Modal Fix Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/common/css/modal-fix.css') }}">

    <!-- Product Page Custom Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/custom-product-page.css') }}">

    <!-- Product Layout New Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/product-layout-new.css') }}">

    <!-- Simple Breadcrumb Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/simple-breadcrumb.css') }}">

    <!-- Checkout New Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/checkout-new.css') }}">

    <!-- Custom Button Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/custom-button.css') }}">

    <!-- Custom Header Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/custom-header.css') }}">

    <!-- Mobile Category Fix Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/mobile-category-fix.css') }}">

    <!-- Mobile Breadcrumb Fix Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/mobile-breadcrumb-fix.css') }}">

    <!-- Category Breadcrumb Fix Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/category-breadcrumb-fix.css') }}">

    <!-- Breadcrumb Separator Fix Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/breadcrumb-separator-fix.css') }}">

    <!-- Mobile Search Fix Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/mobile-search-fix.css') }}?v=1.1">

    <!-- Mobile Toolbar Redesign Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/mobile-toolbar-redesign.css') }}?v=1.2">

    <!-- Mobile Slider Height Fix Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/mobile-slider-fix.css') }}?v=1.1">

    <!-- Policy Breadcrumb Fix Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/policy-breadcrumb-fix.css') }}?v=1.0">

    <!-- Footer Overlap Fix Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/footer-overlap-fix.css') }}?v=1.1">

    <!-- Footer Duplicate Fix Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/footer-duplicate-fix.css') }}?v=1.0">

    <!-- Customer Dashboard Redesign Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/customer-dashboard-redesign.css') }}?v=1.0">

    <!-- Customer Dashboard New Design Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/customer-dashboard-new-design.css') }}?v=1.0">

    <!-- Mobile Orders Table Fix Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/mobile-orders-table-fix.css') }}?v=1.3">

    <!-- Mobile Account Tabs Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/mobile-account-tabs.css') }}?v=1.0">

    <!-- Mobile Navigation Fix Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/mobile-nav-fix.css') }}?v=1.0">

    <!-- Mobile Account Dashboard Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/mobile-account.css') }}?v=1.0">

    <!-- Shop Breadcrumb Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/shop-breadcrumb.css') }}?v=1.0">

    <!-- Text Color Fix Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/text-color-fix.css') }}?v=1.0">

    <!-- Mobile Product Card Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/mobile-product-card.css') }}?v=1.0">

    <!-- Order Summary Layout Fix Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/order-summary-layout-fix.css') }}?v=1.0">

    <!-- Mobile Tracking URL Hide Styles -->
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/mobile-tracking-url-hide.css') }}?v=1.0">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- PWA  -->
    <meta name="theme-color" content="#006633"/>
    <link rel="manifest" href="{{ staticAsset('/manifest.json') }}"/>

    <!-- recaptcha -->
    @if (getSetting('enable_recaptcha') == 1)
        {!! RecaptchaV3::initJs() !!}
    @endif
    <!-- recaptcha -->

</head>

<body style="margin: 0; padding: 0; overflow-x: hidden; width: 100%; max-width: 100%;">

    @php
        // for visitors to add to cart
        $tempValue = strtotime('now') . rand(10, 1000);
        $theTime = time() + 86400 * 365;
        if (!isset($_COOKIE['guest_user_id'])) {
            setcookie('guest_user_id', $tempValue, $theTime, '/'); // 86400 = 1 day
        }

    @endphp

    <!--preloader start-->
    @if (getSetting('enable_preloader') != '0')
    <div id="preloader">
        <img src="{{ uploadedAsset(getSetting('frontend_preloader')) ?? staticAsset('frontend/default/assets/images/uliaa-mart-logo.jpeg') }}" alt="preloader" class="img-fluid" max-width="180">
    </div>
    @endif
    <!--preloader end-->

    <!--main content wrapper start-->
    @php
        $wrapperClass = 'main-wrapper';
        if(getTheme() == "halal" && \Route::is('home')){
            $wrapperClass = 'main-wrapper meat-body clr-scheme clr-scheme--home-five';

        }elseif (getTheme() == "furniture" && \Route::is('home')) {
            $wrapperClass = 'clr-scheme clr-scheme--home-seven';
        }
    @endphp
    <div class="{{ $wrapperClass }}" style="margin: 0; padding: 0; overflow-x: hidden; width: 100%; max-width: 100%;">
        <!--header section start-->
        @if (isset($exception))
            @if ($exception->getStatusCode() != 503)
                @include('frontend.default.inc.uliaa-header')
            @endif
        @else
            @include('frontend.default.inc.uliaa-header')
        @endif
        <!--header section end-->

        <!-- Navigation is now included in header for sticky behavior -->

        <!-- Horizontal Bar Removed -->

        <!--breadcrumb section start-->
        @if(Route::is('checkout.proceed') || Route::is('checkout.success') || Route::is('checkout.failed') || Route::is('carts.index'))
            @yield('simple-breadcrumb')
        @elseif(!Route::is('products.index') && !Route::is('products.category'))
            @yield('breadcrumb')
        @endif
        <!--breadcrumb section end-->

        <!--offcanvas menu start-->
        <!-- @include('frontend.default.inc.offcanvas') -->
        <!--offcanvas menu end-->

        <div class="main-content" style="position: relative; z-index: 50; padding-bottom: 0; margin: 0; padding: 0; overflow-x: hidden; width: 100%; max-width: 100%;">
            @yield('contents')
        </div>

        <!-- modals -->
        @include('frontend.default.pages.partials.products.quickViewModal')
        <!-- modals -->

        <!--footer section start-->
        @if (isset($exception))
            @if ($exception->getStatusCode() != 503)
                @include('frontend.default.inc.footer')
                @include('frontend.default.inc.bottomToolbar')
            @endif
        @else
            @include('frontend.default.inc.footer')
            @include('frontend.default.inc.bottomToolbar')
        @endif
        <!--footer section end-->

    </div>


    <!-- Removed duplicate scroll-to-top button -->

        <!--build:js-->
        @include('frontend.default.inc.scripts')
        <!--endbuild-->

        <!-- Mobile Navigation Fix Script -->
        <script src="{{ staticAsset('frontend/default/assets/js/mobile-nav-fix.js') }}?v=1.0"></script>

        <!-- Uliaa Custom Scripts -->
        @include('frontend.default.inc.uliaa-scripts')

        <!-- Featured Products Scripts -->
        <script src="{{ staticAsset('frontend/default/assets/js/featured-products-new.js') }}"></script>

        <!-- Modal Fix Scripts -->
        <script src="{{ staticAsset('frontend/common/js/modal-fix.js') }}"></script>
        <script src="{{ staticAsset('frontend/common/js/fix-page-button.js') }}"></script>

        <!-- Category Menu Script -->
        <script src="{{ staticAsset('frontend/default/assets/js/category-menu.js') }}"></script>

        <!-- Product Layout New Script -->
        <script src="{{ staticAsset('frontend/default/assets/js/product-layout-new.js') }}"></script>

        <!-- Mobile Menu Override Script -->
        <script src="{{ staticAsset('frontend/default/assets/js/mobile-menu-override.js') }}"></script>

        <!-- Mobile Orders Table Fix Script -->
        <script src="{{ staticAsset('frontend/default/assets/js/mobile-orders-table-fix.js') }}?v=1.1"></script>

        <!-- Cart Price Update Fix Script -->
        <script src="{{ staticAsset('frontend/default/assets/js/cart-price-update-fix.js') }}?v=1.0"></script>

        <!--page's scripts-->
        @yield('scripts')
        <!--page's script-->

        <!--for pwa-->
        <script src="{{ url('/') . '/public/sw.js' }}"></script>
        <script>
            if (!navigator.serviceWorker?.controller) {
                navigator.serviceWorker?.register("./public/sw.js").then(function(reg) {
                    // console.log("Service worker has been registered for scope: " + reg.scope);
                });
            }
        </script>
        <!--for pwa-->

        </body>

        </html>

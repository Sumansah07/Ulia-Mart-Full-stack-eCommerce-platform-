<!DOCTYPE html>

@php
    $locale = str_replace('_', '-', app()->getLocale()) ?? 'en';
    $localLang = \App\Models\Language::where('code', $locale)->first();
    if ($localLang == null) {
        $localLang = \App\Models\Language::where('code', 'en')->first();
    }
@endphp

@if ($localLang->is_rtl == 1)
    <html dir="rtl" lang="{{ $locale }}" data-bs-theme="light">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
@endif


<head>
    <!--required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    


    <!--favicon icon-->
    @php
        $faviconUrl = getSetting('favicon') ? uploadedAsset(getSetting('favicon')) : staticAsset('frontend/default/assets/img/favicon.jpg');
    @endphp
    <link rel="icon" href="{{ $faviconUrl }}" type="image/jpg" sizes="16x16">
    <link rel="shortcut icon" href="{{ $faviconUrl }}" type="image/jpg">
    <link rel="apple-touch-icon" href="{{ $faviconUrl }}" sizes="180x180">

    <!--title-->
    <title>
        @yield('title') - {{ getSetting('site_name') }}
    </title>

    <!--build:css-->
    @include('frontend.default.inc.css')
    <!-- endbuild -->

    <!-- recaptcha -->
    @if (getSetting('enable_recaptcha') == 1)
        {!! RecaptchaV3::initJs() !!}
    @endif
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
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ staticAsset('frontend/default/assets/images/uliaa-mart-logo.jpeg') }}" alt="{{ getSetting('site_name') }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{ localize('Home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">{{ localize('Shop') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--preloader start-->
    <div id="preloader">
        <img src="{{ staticAsset('frontend/default/assets/images/uliaa-mart-logo.jpeg') }}" alt="preloader" class="img-fluid" max-width="180">
    </div>
    <!--preloader end-->

    <!--main content wrapper start-->
    <div class="main-wrapper">
        @yield('contents')
    </div>

    <!-- Footer -->
    <footer class="py-4 mt-5">
        <div class="container">
            <div class="text-center text-muted">
                <p class="mb-0">&copy; {{ date('Y') }} {{ getSetting('site_name') }}. {{ localize('All rights reserved') }}.</p>
            </div>
        </div>
    </footer>

    <!-- scripts -->
    @yield('scripts')

    <!--build:js-->
    @include('frontend.default.inc.scripts')
    <!--endbuild-->
</body>

</html>

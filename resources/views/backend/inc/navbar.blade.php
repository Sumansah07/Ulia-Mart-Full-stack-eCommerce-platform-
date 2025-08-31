
<!-- Admin Header with Frontend Style -->
<style>
    /* Admin header styles matching frontend */
    .admin-top-bar {
        background-color: #006633;
        padding: 8px 0;
        font-size: 14px;
        position: relative;
        z-index: 102;
    }

    .admin-main-header {
        background-color: white;
        border-bottom: 1px solid #e0e0e0;
        padding: 15px 0;
    }

    .admin-header-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        width: 100%;
        background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .admin-search-container {
        position: relative;
        display: flex;
        align-items: center;
        background: #f8f9fa;
        border: 1px solid #e0e0e0;
        border-radius: 25px;
        overflow: hidden;
    }

    .admin-search-input {
        flex: 1;
        border: none;
        padding: 12px 20px;
        background: transparent;
        outline: none;
        font-size: 14px;
    }

    .admin-search-btn {
        background: #006633;
        color: white;
        border: none;
        padding: 12px 20px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .admin-search-btn:hover {
        background: #004d26;
    }

    .admin-logo img {
        max-height: 50px;
        width: auto;
    }

    .admin-right-section {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .admin-nav-item {
        color: white;
        text-decoration: none;
        padding: 8px 12px;
        border-radius: 4px;
        transition: background-color 0.3s;
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 14px;
    }

    .admin-nav-item:hover {
        background-color: rgba(255,255,255,0.1);
        color: white;
    }

    /* Mobile responsive adjustments */
    @media (max-width: 768px) {
        .admin-nav-item {
            padding: 6px 8px;
            font-size: 12px;
            gap: 3px;
        }

        .admin-right-section {
            gap: 8px;
        }

        .admin-top-bar {
            padding: 6px 0;
            font-size: 12px;
        }

        .admin-nav-item img {
            width: 14px !important;
            height: auto !important;
        }

        /* Hide text on small screens, keep only icons */
        @media (max-width: 480px) {
            .admin-nav-item span:not(.dropdown-toggle):not(.badge) {
                display: none;
            }

            .admin-nav-item {
                padding: 4px;
                min-width: 28px;
                justify-content: center;
                font-size: 10px;
            }

            .admin-top-bar {
                padding: 4px 0;
                font-size: 10px;
            }

            .admin-nav-item img {
                width: 12px !important;
                height: auto !important;
            }

            .admin-right-section {
                gap: 4px;
            }
        }

        /* For screens between 480px and 576px - smaller text but still visible */
        @media (min-width: 481px) and (max-width: 576px) {
            .admin-nav-item {
                padding: 5px 7px;
                font-size: 11px;
                gap: 2px;
            }

            .admin-top-bar {
                padding: 5px 0;
                font-size: 11px;
            }

            .admin-right-section {
                gap: 6px;
            }
        }
    }

    .admin-user-dropdown {
        position: relative;
    }

    .admin-user-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        cursor: pointer;
    }

    /* Mobile toggle for sidebar */
    .admin-mobile-toggle {
        background: none;
        border: none;
        color: #006633;
        font-size: 20px;
        padding: 5px;
        margin-right: 10px;
    }

    /* Adjust body padding for fixed header */
    body {
        padding-top: 120px !important;
    }

    /* Notification icon styling */
    .tt-notification {
        color: white !important;
        text-decoration: none !important;
        padding: 8px 12px !important;
        border-radius: 4px !important;
        transition: background-color 0.3s !important;
        display: flex !important;
        align-items: center !important;
        position: relative !important;
    }

    .tt-notification:hover {
        background-color: rgba(255,255,255,0.1) !important;
        color: white !important;
    }

    .tt-notification i {
        color: white !important;
        width: 18px !important;
        height: 18px !important;
    }

    .tt-notification-dot {
        position: absolute !important;
        top: 6px !important;
        right: 6px !important;
        width: 8px !important;
        height: 8px !important;
        background-color: #dc3545 !important;
        border: 2px solid white !important;
    }

    /* Mobile notification adjustments */
    @media (max-width: 768px) {
        .tt-notification {
            padding: 6px 8px !important;
        }

        .tt-notification i {
            width: 16px !important;
            height: 16px !important;
        }

        .tt-notification-dot {
            top: 4px !important;
            right: 4px !important;
            width: 6px !important;
            height: 6px !important;
        }
    }
</style>

<div class="admin-header-wrapper">
    <!-- Top Bar -->
    <div class="admin-top-bar">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Left: Date -->
                <div class="text-white">
                    <span>{{ date('l, F j, Y') }}</span>
                </div>

                <!-- Right: Navigation Items -->
                <div class="admin-right-section">
                    <!-- Visit Store -->
                    <a href="{{ route('home') }}" class="admin-nav-item" target="_blank">
                        <i data-feather="globe" width="16" height="16"></i>
                        <span>{{ localize('Visit Store') }}</span>
                    </a>

                    <!-- Language Dropdown -->
                    @php
                        if (Session::has('locale')) {
                            $locale = Session::get('locale', Config::get('app.locale'));
                        } else {
                            $locale = env('DEFAULT_LANGUAGE');
                        }
                        $currentLanguage = \App\Models\Language::where('code', $locale)->first();
                        if (is_null($currentLanguage)) {
                            $currentLanguage = \App\Models\Language::where('code', 'en')->first();
                        }
                    @endphp
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="admin-nav-item dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ staticAsset('backend/assets/img/flags/' . $currentLanguage->flag . '.png') }}"
                                alt="country" class="img-fluid me-1" width="16"> {{ $currentLanguage->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @foreach (\App\Models\Language::where('is_active', 1)->get() as $key => $language)
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item"
                                        onclick="changeLocaleLanguage(this)" data-flag="{{ $language->code }}">
                                        <img src="{{ staticAsset('backend/assets/img/flags/' . $language->flag . '.png') }}"
                                            alt="{{ $language->code }}" class="img-fluid me-1" width="16">
                                        {{ $language->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Theme Toggle -->
                    <a href="javascript:void(0)" class="admin-nav-item tt-theme-toggle">
                        <div class="tt-theme-light"><i data-feather="moon" width="16" height="16"></i></div>
                        <div class="tt-theme-dark"><i data-feather="sun" width="16" height="16"></i></div>
                    </a>

                    <!-- Notifications -->
                    <x-notification-component/>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="admin-main-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Logo and Mobile Menu -->
                <div class="col-lg-2 col-md-2 col-4 d-flex align-items-center">
                    <button class="admin-mobile-toggle d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft">
                        <i data-feather="menu"></i>
                    </button>
                    <a href="{{ auth()->user()->user_type != 'deliveryman' ? route('admin.dashboard') : route('deliveryman.dashboard') }}" class="admin-logo">
                        <img src="{{ uploadedAsset(getSetting('admin_panel_logo')) }}" alt="Admin Logo" class="img-fluid">
                    </a>
                </div>

                <!-- Search -->
                <div class="col-lg-6 col-md-6 d-none d-md-block">
                    <div class="admin-search-container">
                        <input type="text" class="admin-search-input searchNav" placeholder="{{ localize('Search admin panel...') }}" name="search">
                        <button type="button" class="admin-search-btn">
                            <i data-feather="search" width="16" height="16"></i>
                        </button>
                        <ul class="search-item position-absolute" style="top: 100%; left: 0; right: 0; background: white; border: 1px solid #e0e0e0; border-top: none; max-height: 300px; overflow-y: auto; z-index: 1000;"></ul>
                    </div>
                </div>

                <!-- User Section -->
                <div class="col-lg-4 col-md-4 col-8">
                    <div class="d-flex justify-content-end align-items-center">
                        <!-- User Dropdown -->
                        <div class="dropdown admin-user-dropdown">
                            <a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button"
                                data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <img class="admin-user-avatar" src="{{ uploadedAsset(auth()->user()->avatar) }}" alt="avatar">
                                    <span class="ms-2 d-none d-lg-inline">{{ auth()->user()->name }}</span>
                                    <i data-feather="chevron-down" width="16" height="16" class="ms-1"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="navbarDropdownUser">
                                <div class="card position-relative border-0">
                                    <div class="card-body py-2">
                                        <ul class="list-unstyled d-flex flex-column">
                                            <li class="nav-item">
                                                <a class="dropdown-item px-0"
                                                    href="{{ auth()->user()->user_type == 'deliveryman' ? route('deliveryman.profile') : route('admin.profile') }}">
                                                    <i data-feather="user" class="me-2" width="16" height="16"></i>
                                                    {{ localize('My Account') }}
                                                </a>
                                            </li>
                                            @can('general_settings')
                                                <li class="nav-item">
                                                    <a class="dropdown-item px-0" href="{{ route('admin.generalSettings') }}">
                                                        <i data-feather="settings" class="me-2" width="16" height="16"></i>
                                                        {{ localize('Settings') }}
                                                    </a>
                                                </li>
                                            @endcan
                                            <li class="nav-item">
                                                <a class="dropdown-item px-0" href="{{ route('logout') }}">
                                                    <i data-feather="log-out" class="me-2" width="16" height="16"></i>
                                                    {{ localize('Sign out') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>

<header class="tt-top-fixed bg-light-subtle d-none">
    <div class="container-fluid">
        <nav class="navbar navbar-top navbar-expand" id="navbarDefault">
            <div class="collapse navbar-collapse justify-content-between">
                <ul class="navbar-nav flex-row align-items-center tt-top-navbar">

                    <!-- Old navbar content hidden -->
                </ul>
            </div>
        </nav>
    </div>
</header>

<!--mobile offcanvas menu start-->
<div class="offcanvas offcanvas-start tt-aside-navbar" id="offcanvasLeft" tabindex="-1">
    <div class="offcanvas-header border-bottom">
        <div class="tt-brand">
            <a href="index.html" class="tt-brand-link">
                <!-- Favicon removed as per request -->
                <img src="{{ uploadedAsset(getSetting('admin_panel_logo')) }}" class="tt-brand-logo ms-2"
                    alt="logo" />
            </a>
        </div>
        <button class="btn-close" type="button" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-2 pb-9" data-simplebar>
        <div class="tt-sidebar-nav">
            <nav class="navbar navbar-vertical">
                <div class="w-100">
                    @if (auth()->user()->user_type != 'deliveryman')
                        @include('backend.inc.sidebarMenus')
                    @else
                        @include('backend.inc.deliverymanSidebarMenus')
                    @endif
                </div>
            </nav>
        </div>
    </div>
</div>
<!--mobile offcanvas menu end-->

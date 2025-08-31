<style>
    /* Override category select styles */
    .category-select-wrapper {
        background-color: white !important;
        border: 1px solid #e0e0e0 !important;
        border-radius: 4px !important;
    }

    .category-select {
        color: #333 !important;
        font-weight: 700 !important;
    }

    .select-arrow {
        color: #333 !important;
    }

    @media (max-width: 767.98px) {
        .category-select-wrapper {
            background-color: white !important;
        }

        .category-select {
            color: #333 !important;
        }

        .select-arrow {
            color: #333 !important;
        }
    }

    /* Simple Sticky Header - No Changes to Design */
    .header-wrapper.sticky {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        z-index: 1000 !important;
        width: 100% !important;
        background: white !important;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1) !important;
    }

    /* Mobile only - Remove top padding/margin from top bar to make icons touch top edge */
    @media (max-width: 767.98px) {
        .top-bar {
            padding-top: 8px !important;
            margin-top: 0 !important;
        }

        .top-bar-content {
            padding-top: 0 !important;
            margin-top: 0 !important;
        }

        .top-bar-right {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        /* Center align date text vertically like the icons */
        .top-bar-left {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
        }

        .top-date {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        /* Override external CSS files for mobile */
        .header-wrapper .top-bar,
        div.top-bar {
            padding-top: 0 !important;
            margin-top: 0 !important;
            border-top: none !important;
        }
    }

    /* Add padding to body when header is sticky */
    body.sticky-active {
        padding-top: var(--header-height, 120px) !important;
    }

</style>

<!-- Header Wrapper -->
<div class="header-wrapper position-relative">
<!-- Top Bar -->
<div class="top-bar">
    <div class="container">
    <div class="top-bar-content d-flex flex-row flex-wrap justify-content-between align-items-center">

            <!-- Left: Date -->
            <div class="top-bar-item top-bar-left text-start">
                <span class="top-date">{{ date('l, F j, Y') }}</span>
            </div>

            <!-- Right: Icons -->
            <div class="top-bar-item top-bar-right d-flex justify-content-end align-items-center gap-3">
<style>
    @media (max-width: 767.98px) {
        .top-bar-content {
            flex-direction: row !important;
            align-items: center !important;
        }
        .top-bar-left {
            flex: 1 1 auto;
            font-size: 0.85rem !important;
            text-align: left !important;
            margin-bottom: 0 !important;
        }
        .top-date {
            font-size: 0.85rem !important;
        }
        .top-bar-right {
            flex: 0 0 auto;
            justify-content: flex-end !important;
            margin-bottom: 0 !important;
        }
    }
</style>
                <!-- Authentication -->
                <div class="gshop-header-user position-relative">
                    <button type="button" class="user-icon">
                        <i class="fas fa-user-circle fa-lg"></i>
                    </button>
                    <div class="user-menu-wrapper">
                        <ul class="user-menu">
                            @auth
                                @if (auth()->user()->user_type == 'customer')
                                    <li><a href="{{ route('customers.dashboard') }}"><span class="me-2"><i
                                                    class="fa-solid fa-user"></i></span>{{ localize('My Account') }}</a>
                                    </li>
                                    <li><a href="{{ route('customers.orderHistory') }}"><span
                                                class="me-2"><i
                                                    class="fa-solid fa-tags"></i></span>{{ localize('My Orders') }}</a>
                                    </li>
                                    <li><a href="{{ route('customers.wishlist') }}"><span class="me-2"><i
                                                    class="fa-solid fa-heart"></i></span>{{ localize('My Wishlist') }}</a>
                                    </li>
                                @elseif(auth()->user()->user_type == 'deliveryman')
                                    <li><a href="{{ route('deliveryman.dashboard') }}"><span
                                                class="me-2"><i
                                                    class="fa-solid fa-bars"></i></span>{{ localize('Dashboard') }}</a>
                                    </li>
                                @else
                                    <li><a href="{{ route('admin.dashboard') }}"><span class="me-2"><i
                                                    class="fa-solid fa-bars"></i></span>{{ localize('Dashboard') }}</a>
                                    </li>
                                @endif

                                <li><a href="{{ route('logout') }}"><span class="me-2"><i
                                                class="fa-solid fa-arrow-right-from-bracket"></i></span>{{ localize('Log Out') }}
                                    </a></li>
                            @endauth

                            @guest
                                <li><a href="{{ route('login') }}"><span class="me-2"><i
                                                class="fa-solid fa-arrow-right-from-bracket"></i></span>{{ localize('Log In') }}</a>
                                </li>
                                <li><a href="{{ route('register') }}"><span class="me-2"><i
                                                class="fa-solid fa-user-plus"></i></span>{{ localize('Registration') }}</a>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>

                <!-- Track Order -->
                <a href="javascript:void(0);" class="track-icon" title="Track Order" onclick="redirectToTrackOrder()">
                    <i class="fas fa-shipping-fast fa-lg"></i>
                </a>

                <!-- Language Selector -->
                <!-- @php
                    if (Session::has('locale')) {
                        $locale = Session::get('locale', Config::get('app.locale'));
                    } else {
                        $locale = env('DEFAULT_LANGUAGE');
                    }
                    $currentLanguage = \App\Models\Language::where('code', $locale)->first();

                    if ($currentLanguage == null) {
                        $currentLanguage = \App\Models\Language::where('code', 'en')->first();
                    }
                @endphp
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-light" data-bs-toggle="dropdown">
                        <img src="{{ staticAsset('backend/assets/img/flags/' . $currentLanguage?->flag . '.png') }}"
                             alt="country" class="img-fluid me-1"> {{ $currentLanguage?->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @foreach (\App\Models\Language::where('is_active', 1)->get() as $key => $language)
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);"
                                   onclick="changeLocaleLanguage(this)" data-flag="{{ $language->code }}">
                                    <img src="{{ staticAsset('backend/assets/img/flags/' . $language->flag . '.png') }}"
                                         alt="country" class="img-fluid me-1">
                                    {{ $language?->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div> -->

                <!-- Currency Selector -->
                <!-- @php
                    // Use the helper function to get a valid currency
                    $currentCurrency = getValidCurrency();
                @endphp -->
                <!-- <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-uppercase text-light" data-bs-toggle="dropdown">
                        {{ $currentCurrency?->symbol }} {{ $currentCurrency?->code }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @foreach (\App\Models\Currency::where('is_active', 1)->get() as $key => $currency)
                            <li>
                                <a class="dropdown-item fs-xs text-uppercase" href="javascript:void(0);"
                                   onclick="changeLocaleCurrency(this)" data-currency="{{ $currency->code }}">
                                    {{ $currency->symbol }} {{ $currency->code }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div> -->
            </div>
        </div>
    </div>
</div>

<!-- Header -->
<header class="main-header">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo and Mobile Menu -->
            <div class="col-lg-2 col-md-2 col-4 d-flex align-items-center">
                <button class="navbar-toggler d-md-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileNav">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="{{ route('home') }}" class="logo"><img
                        src="{{ staticAsset('frontend/default/assets/images/uliaa-mart-logo.jpeg') }}" alt="Uliaa Mart" class="img-fluid"></a>
            </div>

            <!-- Search -->
            <div class="col-lg-6 col-md-6 d-none d-md-block">
                <form class="search-container" action="{{ route('products.index') }}">
                    <input type="text" placeholder="{{ localize('Search for products') }}" class="search-input" name="search"
                        @isset($searchKey) value="{{ $searchKey }}" @endisset>

                    <div class="category-select-wrapper">
                        <select class="category-select" name="category_id" id="headerCategorySelect">
                            <option value="">SELECT CATEGORY</option>
                            @php
                                $categories = \App\Models\Category::where(function($query) {
                                        $query->whereNull('parent_id')
                                            ->orWhere('parent_id', 0)
                                            ->orWhere('parent_id', '');
                                    })
                                    ->orderBy('sorting_order_level', 'asc')
                                    ->get();

                                // If no categories found, use hardcoded ones
                               
                            @endphp

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <i class="fas fa-chevron-down select-arrow"></i>
                    </div>

                    <button type="submit" class="search-btn">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>

            <!-- Order Info & Cart -->
            <div class="col-lg-4 col-md-4 col-8">
                <div class="header-right">
                    <!-- Order Info -->
                    <div class="order-info d-none d-lg-block">
                        <div class="order-label">Order At:</div>
                        <div class="phone-number">{{ getSetting('navbar_contact_number') }}</div>
                    </div>

                    <!-- Contact Icons -->
                    <div class="contact-icons">
                        <a href="https://wa.me/9779803560163" class="me-1" target="_blank">
                            <i class="fab fa-whatsapp-square whatsapp-icon"></i>
                        </a>
                        <a href="viber://chat?number=+9779803560163" target="_blank">
                            <i class="fab fa-viber viber-icon"></i>
                        </a>
                    </div>

                    <!-- Cart Button -->
                    <div class="gshop-header-cart position-relative">
                        @php
                            $carts = [];
                            if (Auth::check()) {
                                $carts = App\Models\Cart::where('user_id', Auth::user()->id)
                                    ->where('location_id', session('stock_location_id'))
                                    ->get();
                            } else {
                                if (isset($_COOKIE['guest_user_id'])) {
                                    $carts = App\Models\Cart::where('guest_user_id', (int) $_COOKIE['guest_user_id'])
                                        ->where('location_id', session('stock_location_id'))
                                        ->get();
                                }
                            }
                        @endphp

                        <button type="button" class="header-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-counter badge rounded-circle p-0 {{ count($carts) > 0 ? '' : 'd-none' }}">{{ count($carts) }}</span>
                            @php
                                // Calculate cart amount using DISCOUNTED PRICES (with admin panel discount applied)
                                $cartAmount = 0;
                                if (count($carts) > 0) {
                                    foreach ($carts as $cart) {
                                        try {
                                            if (isset($cart->product_variation) && isset($cart->product_variation->product)) {
                                                $product = $cart->product_variation->product;
                                                // Get base price
                                                $basePrice = $product->base_price ?? $product->min_price ?? 0;

                                                // Apply discount if active
                                                $discountedPrice = $basePrice;
                                                if ($product->discount_start_date && $product->discount_end_date && $product->discount_value > 0) {
                                                    if (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
                                                        strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
                                                        if ($product->discount_type == 'percent') {
                                                            $discountedPrice = $basePrice - (($basePrice * $product->discount_value) / 100);
                                                        } elseif ($product->discount_type == 'flat') {
                                                            $discountedPrice = $basePrice - $product->discount_value;
                                                        }
                                                    }
                                                }

                                                $cartAmount += $discountedPrice * $cart->qty;
                                            }
                                        } catch (\Exception $e) {
                                            // Handle error silently
                                        }
                                    }
                                }
                            @endphp
                            <span class="cart-amount ms-2">{{ formatPrice($cartAmount) }}</span>
                        </button>
                        <div class="cart-box-wrapper">
                            <div class="apt_cart_box theme-scrollbar">
                                <ul class="at_scrollbar scrollbar cart-navbar-wrapper">
                                    <!--cart listing-->
                                    @include('frontend.default.pages.partials.carts.cart-navbar', [
                                        'carts' => $carts,
                                    ])
                                    <!--cart listing-->
                                </ul>
                                <div class="d-flex align-items-center justify-content-between mt-3">
                                    <h6 class="mb-0">{{ localize('Subtotal') }}:</h6>
                                    @php
                                        // Calculate cart sidebar subtotal using DISCOUNTED PRICES (with admin panel discount applied)
                                        $cartSidebarSubtotal2 = 0;
                                        if (count($carts) > 0) {
                                            foreach ($carts as $cart) {
                                                try {
                                                    if (isset($cart->product_variation) && isset($cart->product_variation->product)) {
                                                        $product = $cart->product_variation->product;
                                                        // Get base price
                                                        $basePrice = $product->base_price ?? $product->min_price ?? 0;

                                                        // Apply discount if active
                                                        $discountedPrice = $basePrice;
                                                        if ($product->discount_start_date && $product->discount_end_date && $product->discount_value > 0) {
                                                            if (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
                                                                strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
                                                                if ($product->discount_type == 'percent') {
                                                                    $discountedPrice = $basePrice - (($basePrice * $product->discount_value) / 100);
                                                                } elseif ($product->discount_type == 'flat') {
                                                                    $discountedPrice = $basePrice - $product->discount_value;
                                                                }
                                                            }
                                                        }

                                                        $cartSidebarSubtotal2 += $discountedPrice * $cart->qty;
                                                    }
                                                } catch (\Exception $e) {
                                                    // Handle error silently
                                                }
                                            }
                                        }
                                    @endphp
                                    <span class="fw-semibold text-secondary sub-total-price">{{ formatPrice($cartSidebarSubtotal2) }}</span>
                                </div>
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-6">
                                        <a href="{{ route('carts.index') }}"
                                            class="btn btn-secondary btn-md mt-4 w-100"><span
                                                class="me-2"><i
                                                    class="fa-solid fa-shopping-bag"></i></span>{{ localize('View Cart') }}</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('checkout.proceed') }}"
                                            class="btn btn-primary btn-md mt-4 w-100"><span class="me-2"><i
                                                    class="fa-solid fa-credit-card"></i></span>{{ localize('Checkout') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Search (visible only on mobile) -->
<div class="mobile-search d-md-none">
    <div class="container">
        <form class="search-container" action="{{ route('products.index') }}">
            <input type="text" class="search-input" placeholder="{{ localize('Search for products') }}" name="search"
                @isset($searchKey) value="{{ $searchKey }}" @endisset>

            <input type="hidden" name="category_id" value="">

            <button type="submit" class="search-btn">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>
</div>

<!-- Include Navigation in Sticky Header -->
@include('frontend.default.inc.uliaa-nav')

</div><!-- End Header Wrapper -->

<script>
// Simple Sticky Header - No Design Changes
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.header-wrapper');
    const body = document.body;

    if (!header) return;

    // Get header height
    const headerHeight = header.offsetHeight;
    document.documentElement.style.setProperty('--header-height', headerHeight + 'px');

    // Sticky on scroll
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            header.classList.add('sticky');
            body.classList.add('sticky-active');
        } else {
            header.classList.remove('sticky');
            body.classList.remove('sticky-active');
        }
    });
});
</script>

<script>
function redirectToTrackOrder() {
    // Check if it's a mobile device using screen width and user agent
    const isMobile = window.innerWidth <= 767 || /iPhone|iPad|iPod|Android|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

    // Exclude tablets from mobile detection
    const isTablet = /iPad|Tablet/i.test(navigator.userAgent);

    if (isMobile && !isTablet) {
        // Mobile: redirect to customer dashboard with orders tracker tab
        window.location.href = "{{ route('customers.dashboard') }}#orders-tracker";
    } else {
        // Desktop/Tablet: redirect to dedicated track order page
        window.location.href = "{{ route('customers.trackOrder') }}";
    }
}
</script>

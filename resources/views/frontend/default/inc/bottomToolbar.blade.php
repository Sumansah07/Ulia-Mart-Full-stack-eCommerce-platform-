<style>
    /* Mobile Toolbar Hover and Active Effects */
    .mobile-toolbar-item {
        transition: all 0.3s ease;
        position: relative;
    }
    
    .mobile-toolbar-item:hover {
        transform: translateY(-2px);
        text-decoration: none !important;
    }
    
    .mobile-toolbar-item:hover .mobile-toolbar-icon {
        background-color: #006633 !important;
        color: white !important;
        border-radius: 12px;
        transform: scale(1.1);
        box-shadow: 0 2px 8px rgba(0, 102, 51, 0.3);
    }
    
    .mobile-toolbar-item:hover .mobile-toolbar-icon i {
        color: white !important;
    }
    
    .mobile-toolbar-item:hover .mobile-toolbar-label {
        color: #006633 !important;
        font-weight: 600;
    }
    
    .mobile-toolbar-item.active .mobile-toolbar-icon {
        background-color: #006633 !important;
        color: white !important;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 102, 51, 0.3);
    }
    
    .mobile-toolbar-item.active .mobile-toolbar-icon i {
        color: white !important;
    }
    
    .mobile-toolbar-item.active .mobile-toolbar-label {
        color: #006633 !important;
        font-weight: bold;
    }
    
    .mobile-toolbar-icon {
        transition: all 0.3s ease;
        padding: 8px;
        margin-bottom: 4px;
    }
    
    .mobile-toolbar-label {
        transition: all 0.3s ease;
    }
</style>

@php
    // Determine current route for active state
    $currentRoute = Route::currentRouteName();
    $isHome = $currentRoute === 'home';
    $isShop = $currentRoute === 'products.index' || str_contains($currentRoute, 'products');
    $isCart = $currentRoute === 'carts.index' || str_contains($currentRoute, 'cart');
    $isAccount = str_contains($currentRoute, 'customers') || str_contains($currentRoute, 'customer');
@endphp

<div class="mobile-toolbar d-block d-md-none d-lg-none">
    <div class="d-table">
        <!-- Home -->
        <a class="mobile-toolbar-item {{ $isHome ? 'active' : '' }}" href="{{ route('home') }}">
            <span class="mobile-toolbar-icon">
                <i class="fas fa-home"></i>
            </span>
            <span class="mobile-toolbar-label">Home</span>
        </a>

        <!-- Shop -->
        <a class="mobile-toolbar-item {{ $isShop ? 'active' : '' }}" href="{{ route('products.index') }}">
            <span class="mobile-toolbar-icon">
                <i class="fas fa-store"></i>
            </span>
            <span class="mobile-toolbar-label">Shop</span>
        </a>

        <!-- Cart -->
        <a class="mobile-toolbar-item {{ $isCart ? 'active' : '' }}" href="{{ route('carts.index') }}">
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
            <span class="mobile-toolbar-icon">
                <i class="fas fa-shopping-cart"></i>
                @if(count($carts) > 0)
                <small class="badge bg-danger cart-counter">{{ count($carts) }}</small>
                @endif
            </span>
            <span class="mobile-toolbar-label">Cart</span>
        </a>

        <!-- Account -->
        <a class="mobile-toolbar-item {{ $isAccount ? 'active' : '' }}" href="{{ route('customers.dashboard') }}">
            <span class="mobile-toolbar-icon">
                <i class="fas fa-user"></i>
            </span>
            <span class="mobile-toolbar-label">Account</span>
        </a>
    </div>
</div>



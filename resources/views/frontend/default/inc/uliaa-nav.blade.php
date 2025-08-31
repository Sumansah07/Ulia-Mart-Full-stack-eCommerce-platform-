<!-- Main Navigation -->
<div class="nav-wrapper position-relative">
    <nav class="main-nav navbar-expand-md navbar-light bg-white border-bottom d-none d-md-block">
        <div class="container">
            <div class="navbar collapse navbar-collapse" style="display: flex !important;">
                <!-- Server-side fallback for categories -->
                @php
                    $categories = \App\Models\Category::where('parent_id', 0)
                        ->orderBy('sorting_order_level', 'asc')
                        ->get();
                @endphp

                @foreach($categories as $category)
                    <div class="dropdown" style="margin-right: 2px !important;">
                        <button class="dropbtn desktop-dropdown-btn" data-category-id="{{ $category->id }}" data-parent-id="0" style="padding: 2px 2px !important;">
                            {{ $category->collectLocalization('name') }}
                        </button>
                        <a class="dropbtn tablet-direct-link" href="{class="navbar collapse navbar-collapse"{ route('products.index') }}?category_id={{ $category->id }}"
                            style="padding: 2px 2px !important; font-size: 14px !important; display: none; background: transparent; border: none; outline: none; white-space: nowrap; color: #333; cursor: pointer; text-decoration: none; pointer-events: auto !important;">
                            {{ $category->collectLocalization('name') }}
                        </a>
                        <div class="dropdown-content desktop-dropdown-content">
                            <!-- ...existing code... -->
                        </div>
                    </div>

                @endforeach
            </div>
    </div>
</nav>

<!-- Mobile Navigation Offcanvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileNav" style="width: 95%; max-width: 450px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" style="font-size: 20px; font-weight: 600;">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <ul class="nav flex-column">
            <!-- Server-side fallback for categories -->
            @foreach($categories as $category)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}?category_id={{ $category->id }}" data-category-id="{{ $category->id }}" data-parent-id="0">
                        {{ $category->collectLocalization('name') }}
                    </a>

                    <!-- Dynamic subcategories -->
                    @php
                        $mobileSubcategories = \App\Models\Category::where('parent_id', $category->id)
                            ->orderBy('sorting_order_level', 'asc')
                            ->get();
                    @endphp

                    @if($mobileSubcategories->count() > 0)
                        <ul class="submenu">
                            @foreach($mobileSubcategories as $mobileSubcategory)
                                <li>
                                    <a class="nav-link" href="{{ route('products.index') }}?category_id={{ $mobileSubcategory->id }}" data-category-id="{{ $mobileSubcategory->id }}" data-parent-id="{{ $category->id }}">
                                        {{ $mobileSubcategory->collectLocalization('name') }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                </li>
            @endforeach
        </ul>
        <hr>
        <div class="d-grid gap-3 mt-4">
            @auth
                <a href="{{ route('customers.dashboard') }}" class="btn btn-outline-secondary" style="font-size: 16px; padding: 10px 0;">My Account</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-secondary" style="font-size: 16px; padding: 10px 0;">Login / Register</a>
            @endauth
            @auth
                <a href="javascript:void(0);" onclick="redirectToTrackOrderFromMobileBottomNav()" class="btn btn-success" style="font-size: 16px; padding: 10px 0;">Track Order</a>
            @else
                <a href="{{ route('login') }}?redirect=track-order" class="btn btn-success" style="font-size: 16px; padding: 10px 0;">Track Order</a>
            @endauth
        </div>
    </div>
</div>

</div>

<script>
    // Function to handle redirect from mobile menu
    function redirectToTrackOrderFromMobileBottomNav() {
        // Check if user is authenticated
        @auth
            // Redirect to customer dashboard with orders-tracker hash
            window.location.href = '{{ route("customers.dashboard") }}#orders-tracker';
        @else
            // Redirect to login page
            window.location.href = '{{ route("login") }}';
        @endauth
    }

    // HIGHLIGHT CATEGORY SCRIPT: Must be last
    window.highlightActiveCategory = function() {
        // Select both <a.dropbtn> and <button.dropbtn> for desktop
        const dropbtns = document.querySelectorAll('.dropbtn');
        const navLinks = document.querySelectorAll('.offcanvas-body .nav-link, .offcanvas-body .submenu a');

        dropbtns.forEach(btn => btn.classList.remove('active-category'));
        navLinks.forEach(link => link.classList.remove('active-category'));

        const urlParams = new URLSearchParams(window.location.search);
        const categoryId = urlParams.get('category_id');
        console.log('DEBUG: [highlightActiveCategory] categoryId from URL:', categoryId);
        // alert('Highlight function running!');

        if (categoryId) {
            let targetParentId = null;
            navLinks.forEach(link => {
                console.log('DEBUG: navLink', link.textContent.trim(), 'data-category-id:', link.dataset.categoryId, 'data-parent-id:', link.dataset.parentId);
                if (link.dataset.categoryId === categoryId) {
                    targetParentId = link.dataset.parentId;
                    link.classList.add('active-category');
                    console.log('DEBUG: Marked navLink as active:', link.textContent.trim());
                }
            });
            dropbtns.forEach(btn => {
                // Use dataset for both <a> and <button>
                console.log('DEBUG: dropbtn', btn.textContent.trim(), 'data-category-id:', btn.dataset.categoryId, 'targetParentId:', targetParentId);
                if (
                    btn.dataset.categoryId === categoryId ||
                    (targetParentId && btn.dataset.categoryId === targetParentId)
                ) {
                    btn.classList.add('active-category');
                    // Force style in case of Bootstrap or inline override
                    // Check if it's a tablet-direct-link and apply active-category without inline styles
                    if (btn.classList.contains('tablet-direct-link')) {
                        btn.classList.add('active-category');
                        console.log('DEBUG: Marked tablet-direct-link as active:', btn.textContent.trim());
                    } else {
                        // Apply inline styles for desktop dropdown buttons
                        btn.style.backgroundColor = '#006633';
                        btn.style.color = '#fff';
                        btn.style.borderRadius = '6px';
                        btn.style.border = '2px solid #006633';
                        btn.style.outline = '2px solid #006633';
                        btn.style.boxShadow = '0 0 0 2px #00663333';
                        btn.style.transition = 'background 0.2s';
                        console.log('DEBUG: Marked desktop dropbtn as active and forced style:', btn.textContent.trim());
                    }
                }
            });
        } else {
            console.log('DEBUG: No category_id in URL');
        }
    };
    document.addEventListener('DOMContentLoaded', function() {
        window.highlightActiveCategory();
    });
</script>

<style>
    /* Override CSS from uliaa-style.blade.php for tighter spacing */
    .navbar {
        gap: 0 !important;
    }

    .dropdown {
        margin-right: 0 !important;
    }

    .dropbtn {
        padding: 8px 4px !important;
        margin-right: 0 !important;
    }

    /* Desktop specific overrides */
    @media (min-width: 1025px) {
        .main-nav .dropdown {
            margin-right: 16px !important;
        }

        .main-nav .dropbtn,
        .main-nav .desktop-dropdown-btn {
            padding: 8px 12px !important;
            margin-right: 0 !important;
        }
    }

    @media (max-width: 1024px) {
        .main-nav .navbar {
            display: flex !important;
            flex-wrap: nowrap !important;
            overflow-x: auto !important;
            overflow-y: hidden !important;
            white-space: nowrap !important;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            height: 56px !important;
            align-items: center;
            background: #fff;
            border-bottom: 1px solid #eee;
            gap: 0 !important;
        }
        .main-nav .dropdown {
            margin-right: 1px !important; /* Minimal gap */
            flex: 0 0 auto;
            position: relative;
        }
        .main-nav .dropbtn {
            font-size: 16px !important;
            padding: 10px 4px !important; /* Minimal horizontal padding */
            white-space: nowrap;
            background: transparent;
            border: none;
            outline: none;
            pointer-events: auto !important;
            cursor: pointer !important;
            z-index: 10 !important;
            position: relative !important;
        }
    }

    /* Desktop: Original dropdown behavior restored */
    @media (min-width: 1025px) {
        .main-nav .desktop-dropdown-btn {
            display: inline-block !important;
        }

        .main-nav .tablet-direct-link {
            display: none !important;
        }

        .main-nav .dropdown:hover .desktop-dropdown-content {
            display: block !important;
        }

        .main-nav .desktop-dropdown-content {
            display: none !important;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1000;
            top: 100%;
            left: 0;
        }

        .main-nav .desktop-dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 14px;
        }

        .main-nav .desktop-dropdown-content a:hover {
            background-color: #f1f1f1;
        }
    }

    /* Tablet-specific fixes for clickability */
    @media (min-width: 768px) and (max-width: 1024px) {
        /* Hide desktop dropdown elements */
        .main-nav .desktop-dropdown-btn {
            display: none !important;
        }

        .main-nav .desktop-dropdown-content {
            display: none !important;
        }

        /* Show tablet direct link */
        .main-nav .tablet-direct-link {
            display: inline-block !important;
            touch-action: manipulation !important;
            -webkit-tap-highlight-color: rgba(0,0,0,0.1) !important;
            user-select: none !important;
            -webkit-user-select: none !important;
        }

        .main-nav .tablet-direct-link:hover,
        .main-nav .tablet-direct-link:active,
        .main-nav .tablet-direct-link:focus {
            background-color: rgba(0, 102, 51, 0.1) !important;
            color: #006633 !important;
        }

        .main-nav .tablet-direct-link.active-category {
            background-color: #006633 !important;
            color: #fff !important;
            border-radius: 6px !important;
            border: 2px solid #006633 !important;
            outline: 2px solid #006633 !important;
            box-shadow: 0 0 0 2px #00663333 !important;
            transition: background 0.2s !important;
        }
    }

    .dropbtn.active-category,
    button.dropbtn.active-category,
    .nav-link.active-category,
    .submenu a.active-category {
        background-color: #006633 !important;
        color: #fff !important;
        border-radius: 6px !important;
        border: 2px solid #006633 !important;
        transition: background 0.2s !important;
        outline: 2px solid #006633 !important;
        box-shadow: 0 0 0 2px #00663333 !important;
    }

    /* Fix for Bootstrap override: force background and color for button.dropbtn.active-category */
    button.dropbtn.active-category {
        background-color: #006633 !important;
        color: #fff !important;
        border-radius: 6px !important;
        border: 2px solid #006633 !important;
        outline: 2px solid #006633 !important;
        box-shadow: 0 0 0 2px #00663333 !important;
        transition: background 0.2s !important;
        /* Remove Bootstrap's background and color */
        background-image: none !important;
        filter: none !important;
    }

    /* Extra: Remove Bootstrap's :focus and :active for .dropbtn.active-category */
    button.dropbtn.active-category:focus,
    button.dropbtn.active-category:active {
        background-color: #006633 !important;
        color: #fff !important;
        outline: 2px solid #006633 !important;
        box-shadow: 0 0 0 2px #00663333 !important;
    }

    nav .desktop-dropdown-btn.active-category {
        background-color: #006633 !important;
        color: #fff !important;
        border-radius: 6px !important;
        border: 2px solid #006633 !important;
        outline: 2px solid #006633 !important;
        box-shadow: 0 0 0 2px #00663333 !important;
        transition: background 0.2s !important;
        z-index: 1001 !important;
    }

    /* SUPER DEBUG: Highest specificity for active-category */
    .main-nav .dropdown .desktop-dropdown-btn.active-category,
    .main-nav .dropdown .dropbtn.active-category,
    .main-nav .dropdown button.dropbtn.active-category,
    .main-nav .dropdown a.dropbtn.active-category {
        background-color: #006633 !important; /* FINAL: Brand green */
        color: #fff !important;
        border: 2px solid #006633 !important;
        border-radius: 6px !important;
        outline: 2px solid #006633 !important;
        box-shadow: 0 0 0 2px #00663333 !important;
        z-index: 2000 !important;
        transition: background 0.2s !important;
    }

    @media (max-width: 767.98px) {
        .mobile-hide-subcategories {
            display: none !important;
        }
    }
</style>

<script>
    // Tablet-only click fix - Desktop untouched
    document.addEventListener('DOMContentLoaded', function() {
        // Only apply on tablet screens (768px - 1024px)
        if (window.innerWidth >= 768 && window.innerWidth <= 1024) {
            const tabletLinks = document.querySelectorAll('.main-nav .tablet-direct-link');

            tabletLinks.forEach(function(link) {
                // Add aggressive click handler for tablet direct links only
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const href = this.getAttribute('href');
                    console.log('Tablet click - Redirecting to:', href);

                    if (href && href !== '#') {
                        window.location.href = href;
                    }
                }, true);

                // Add touch handlers for tablets
                link.addEventListener('touchend', function(e) {
                    e.preventDefault();
                    const href = this.getAttribute('href');
                    if (href && href !== '#') {
                        setTimeout(() => {
                            console.log('Tablet touch - Redirecting to:', href);
                            window.location.href = href;
                        }, 100);
                    }
                });
            });
        }

        // Desktop dropdown - Original hover behavior (CSS handles it)
        if (window.innerWidth > 1024) {
            const desktopButtons = document.querySelectorAll('.main-nav .desktop-dropdown-btn');

            desktopButtons.forEach(function(button) {
                // Prevent button click from redirecting on desktop
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    // CSS hover handles dropdown show/hide
                });
            });
        }
    });
</script>

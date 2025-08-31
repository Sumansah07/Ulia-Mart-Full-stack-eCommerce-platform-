<style>
    /* Full-width breadcrumb styles */
    .shop-breadcrumb {
        width: 100vw !important;
        margin-left: calc(-50vw + 50%) !important;
        position: relative !important;
        left: 0 !important;
        background-color: #f0f0f0 !important; /* Darker grey background */
        padding: 8px 0 8px 0 !important;
        border-bottom: 1px solid #e0e0e0 !important;
    }

    .shop-breadcrumb .container {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
    }

    .shop-breadcrumb .page-title {
        font-size: 18px !important;
        font-weight: 700 !important;
        color: #333 !important;
        margin: 0 !important;
    }

    .shop-breadcrumb .breadcrumb {
        margin: 0 !important;
        padding: 0 !important;
        background: transparent !important;
    }
</style>

<style>
    /* Custom breadcrumb styles */
    .custom-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }

    .custom-breadcrumb span {
        display: inline-block;
    }

    .custom-breadcrumb a {
        color: #006400; /* Dark green color for links */
        text-decoration: none;
    }

    .custom-breadcrumb .separator {
        margin: 0 8px;
        color: #333; /* Darker color for separator */
        font-weight: 500;
    }

    .custom-breadcrumb .active {
        color: #333; /* Dark color for active item */
        font-weight: 500;
    }

    @media (max-width: 767px) {
        .shop-breadcrumb .container {
            flex-direction: column !important;
            align-items: flex-start !important;
        }

        .shop-breadcrumb .page-title {
            margin-bottom: 5px !important;
            font-size: 18px !important;
        }

        .custom-breadcrumb {
            font-size: 14px !important;
        }
    }
</style>

@php
    // Helper function to get the main parent category
    function getMainParentCategory($category) {
        if (!$category) return null;

        // If this category has no parent, it's already a main category
        if (!$category->parent_id || $category->parent_id == 0) {
            return $category;
        }

        // If it has a parent, get the parent category
        if ($category->parentCategory) {
            // Recursively find the top-most parent
            return getMainParentCategory($category->parentCategory);
        }

        // Fallback to the current category if parent not found
        return $category;
    }

    // Get the main category for display
    $mainCategory = null;
    $displayCategory = null;

    // Check if we're on a policy page or other special page
    $currentRoute = request()->route()->getName();
    $isPolicyPage = false;
    $policyTitle = '';

    // Define policy pages and their titles
    $policyPages = [
        'home.pages.privacyPolicy' => 'PRIVACY POLICY',
        'home.pages.returnRefundPolicy' => 'RETURN & REFUND POLICY',
        'home.pages.shippingDeliveryPolicy' => 'SHIPPING & DELIVERY POLICY',
        'home.pages.paymentPolicy' => 'PAYMENT POLICY',
        'home.pages.aboutUs' => 'ABOUT US',
        'home.pages.contactUs' => 'CONTACT US',
    ];

    // Check if current route is a policy page
    if (array_key_exists($currentRoute, $policyPages)) {
        $isPolicyPage = true;
        $policyTitle = $policyPages[$currentRoute];
    }

    // If not a policy page, check for category or product
    if (!$isPolicyPage) {
        if (isset($category) && $category) {
            $mainCategory = getMainParentCategory($category);
            $displayCategory = $category; // Keep the current category for the breadcrumb trail
        }
        elseif (isset($detailedProduct) && $detailedProduct && isset($detailedProduct->categories) && count($detailedProduct->categories) > 0) {
            $productCategory = $detailedProduct->categories->first();
            $mainCategory = getMainParentCategory($productCategory);
            $displayCategory = $productCategory;
        }
    }
@endphp

<div class="shop-breadcrumb">
    <div class="container">
        <div class="page-title">
            @if($isPolicyPage)
                {{ $policyTitle }}
            @elseif($mainCategory)
                SHOP {{ strtoupper($mainCategory->name) }}
            @elseif(request()->has('search'))
                SHOP SEARCH
            @else
                @yield('breadcrumb-title', 'SHOP')
            @endif
        </div>
        <nav aria-label="breadcrumb">
            <div class="custom-breadcrumb">
                <!-- Home is always the first item -->
                <span><a href="{{ route('home') }}">HOME</a></span>

                <!-- Policy pages -->
                @if($isPolicyPage)
                    <span class="separator">&gt;</span>
                    <span class="active">{{ $policyTitle }}</span>
                @else
                    <!-- Shop is always the second item for product pages -->
                    <span class="separator">&gt;</span>
                    <span><a href="{{ route('products.index') }}">SHOP</a></span>

                    <!-- Main Category (if applicable) -->
                    @if($mainCategory)
                        <span class="separator">&gt;</span>
                        <span class="active">{{ strtoupper($mainCategory->name) }}</span>
                    @endif

                    <!-- Search results (if applicable) -->
                    @if(request()->has('search'))
                        <span class="separator">&gt;</span>
                        <span class="active">SEARCH: {{ strtoupper(request()->search) }}</span>
                    @endif

                    <!-- Custom active breadcrumb (if defined) -->
                    @if(!isset($category) && !isset($detailedProduct) && !request()->has('search') && View::hasSection('breadcrumb-active'))
                        <span class="separator">&gt;</span>
                        <span class="active">@yield('breadcrumb-active')</span>
                    @endif
                @endif
            </div>
        </nav>
    </div>
</div>

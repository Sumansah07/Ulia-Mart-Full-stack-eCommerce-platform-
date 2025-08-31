<!-- 3rd party -->
<link rel="stylesheet" href="{{ staticAsset('frontend/common/css/toastr.css') }}">
<!-- 3rd party -->
@if (isset($localLang) && $localLang->is_rtl == 1)
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/main-rtl.css') }}">
@else
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/main.css') }}">
@endif

<link rel="stylesheet" href="{{ staticAsset('frontend/common/css/select2.css') }}">
<link rel="stylesheet" href="{{ staticAsset('frontend/common/css/custom.css') }}">
<link rel="stylesheet" href="{{ staticAsset('frontend/common/css/summernote-lite.min.css') }}">
<link rel="stylesheet" href="{{ staticAsset('frontend/common/css/summernote-custom.css') }}">
<link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/footer-custom.css') }}">
<link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/custom-header.css') }}">
<link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/sticky-header.css') }}">
<link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/custom-button.css') }}">
<link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/iphone-fixes.css') }}">
<link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/zoom-lens-fix.css') }}">
<link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/cart-delete-fix.css') }}">
<link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/cart-sidebar.css') }}">
<link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/price-color-fix.css') }}">
<link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/product-hover-zoom.css') }}">

<style>
    @media (min-width: 1200px) {
        .choose-us-section::after {
            background-image: url({{ uploadedAsset(getSetting('halal_why_choose_us_large_img')) }});
        }

        .on-sale-banner {
            background-image: url({{ uploadedAsset(getSetting('halal_on_sale_banner')) }});
        }
    }

    .furniture_price .pricing .h4 {
        color: #22c55e !important;
        font-size: 16px!important;
    }

    /* Fix for price colors in cart popup */
    .apt_cart_box .subtotal,
    .apt_cart_box .cart-subtotal,
    .apt_cart_box .cart-total,
    .apt_cart_box .total,
    .apt_cart_box .cart-subtotal-title,
    .apt_cart_box .cart-total-title,
    .apt_cart_box .subtotal-title,
    .apt_cart_box .total-title,
    .apt_cart_box .price,
    .apt_cart_box .money,
    .apt_cart_box .text-primary {
        color: #006633 !important; /* Dark green */
    }

    /* Specifically target the subtotal text in the cart popup */
    .cart-navbar-wrapper + div .subtotal,
    .cart-box-wrapper .subtotal,
    .cart-box-wrapper .cart-subtotal,
    .cart-box-wrapper .cart-total,
    .cart-box-wrapper .total,
    .cart-box-wrapper .cart-subtotal-title,
    .cart-box-wrapper .cart-total-title,
    .cart-box-wrapper .subtotal-title,
    .cart-box-wrapper .total-title {
        color: #006633 !important; /* Dark green */
    }
</style>

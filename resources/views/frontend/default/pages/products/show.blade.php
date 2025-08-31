@extends('frontend.default.layouts.master')

@php
    $detailedProduct = $product;
@endphp

@section('title')
    @if ($detailedProduct->meta_title)
        {{ $detailedProduct->meta_title }}
    @else
        {{ localize('Product Details') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
    @endif
@endsection

@section('meta_description')
    {{ $detailedProduct->meta_description }}
@endsection

@section('meta_keywords')
    @foreach ($detailedProduct->tags as $tag)
        {{ $tag->name }} @if (!$loop->last)
            ,
        @endif
    @endforeach
@endsection

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ uploadedAsset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploadedAsset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ formatPrice($detailedProduct->min_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="og:product" />
    <meta property="og:url" content="{{ route('products.show', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ uploadedAsset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ getSetting('meta_title') }}" />
    <meta property="og:price:amount" content="{{ formatPrice($detailedProduct->min_price) }}" />
    <meta property="product:price:currency" content="{{ env('DEFAULT_CURRENCY') }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endsection


@section('breadcrumb-contents')
    <div class="breadcrumb-content">
        <h2 class="mb-2 text-center">{{ localize('Product Details') }}</h2>
        <nav>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fw-bold" aria-current="page"><a
                        href="{{ route('home') }}">{{ localize('Home') }}</a></li>
                <li class="breadcrumb-item fw-bold" aria-current="page">{{ localize('Products') }}</li>
                <li class="breadcrumb-item active fw-bold" aria-current="page">{{ localize('Product Details') }}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('contents')
    <!-- Removed breadcrumb section as requested -->

    <!--product details start-->
    <section class="product-details-area ptb-120">
        <div class="container">
            <!--Product Content-->
            <div class="product-single">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 product-layout-img mb-4 mb-md-0">
                        <!-- product-view-box -->
                        @include('frontend.default.pages.partials.products.sliders',
                            compact('product'))
                        <!-- product-view-box -->
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 product-layout-info">
                        <!-- Product Details -->
                        <div class="product-single-meta">
                            <h2 class="product-main-title">{{ $product->collectLocalization('name') }}</h2>
                            <!-- Product Reviews -->
                            <div class="product-review d-flex-center mb-3">
                                <div class="reviewStar d-flex-center">
                                    @php
                                        $reviews = $product->reviews()->where('status', 1)->get();
                                        $average_rating = $reviews->count() > 0 ? $reviews->average('rating') : 0;
                                    @endphp
                                    @for($i = 0; $i < 5; $i++)
                                        @if($i < round($average_rating))
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                    <span class="caption ms-2">{{ $reviews->count() }} {{ localize('Reviews') }}</span>
                                </div>
                                <a class="reviewLink d-flex-center ms-3" href="#reviews">{{ localize('Write a Review') }}</a>
                            </div>
                            <!-- End Product Reviews -->
                            <!-- Product Info -->
                            <div class="product-info">
                                <p class="product-stock d-flex">{{ localize('Availability') }}:
                                    <span class="pro-stockLbl ps-0">
                                        @php
                                            $isVariantProduct = 0;
                                            $stock = 0;
                                            if ($product->variations()->count() > 1) {
                                                $isVariantProduct = 1;
                                            } else {
                                                $stock = $product->variations[0]->product_variation_stock ? $product->variations[0]->product_variation_stock->stock_qty : 0;
                                            }
                                        @endphp
                                        <span class="d-flex-center stockLbl {{ $stock > 0 ? 'instock' : 'outstock' }} text-uppercase">
                                            {{ $stock > 0 ? localize('In stock') : localize('Out of stock') }}
                                        </span>
                                    </span>
                                </p>
                                @if($product->brand)
                                    <p class="product-vendor">{{ localize('Vendor') }}:<span class="text"><a href="#">{{ $product->brand->name }}</a></span></p>
                                @endif
                                @if($product->categories()->count() > 0)
                                    <p class="product-type">{{ localize('Product Type') }}:<span class="text">{{ $product->categories[0]->collectLocalization('name') }}</span></p>
                                @endif
                                <p class="product-sku">{{ localize('SKU') }}:<span class="text">{{ $product->getSku() ?: $product->getCode() ?: 'N/A' }}</span></p>
                            </div>
                            <!-- End Product Info -->
                            <!-- Product Price -->
                            <div class="product-price d-flex-center my-3">
                                <span class="text-success text-bold fs-6" style="font-family: inherit; font-size: 0.85rem;">
                                    @include('frontend.default.pages.partials.products.pricing-with-tax', compact('product'))
                                </span>
                            </div>
                            <!-- End Product Price -->
                            <hr>
                            <!-- Sort Description -->
                            <div class="sort-description">{{ $product->collectLocalization('short_description') }}</div>
                            <!-- End Sort Description -->
                            <hr>

                            @if(getSetting('enable_countdown_for_flash_deals') == 1)
                                @php
                                    $flash_deal = \App\Models\FlashDeal::where('start_date', '<=', strtotime(date('d-m-Y')))->where('end_date', '>=', strtotime(date('d-m-Y')))->first();
                                @endphp
                                @if($flash_deal != null && $flash_deal->status == 1)
                                    @php
                                        $flash_deal_product = \App\Models\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();
                                    @endphp
                                    @if($flash_deal_product != null)
                                        <!-- Countdown -->
                                        <h3 class="text-uppercase mb-0">{{ localize('Hurry up! Sales Ends In') }}</h3>
                                        <div class="product-countdown d-flex-center text-center my-3" data-countdown="{{ date('Y/m/d', $flash_deal->end_date) }}"></div>
                                        <!-- End Countdown -->
                                    @endif
                                @endif
                            @endif
                        </div>
                        <!-- End Product Details -->

                        <!-- Product Form -->
                        <form action="" class="product-form product-form-border hidedropdown add-to-cart-form">
                            @php
                                $isVariantProduct = 0;
                                $stock = 0;
                                if ($product->variations()->count() > 1) {
                                    $isVariantProduct = 1;
                                } else {
                                    $stock = $product->variations[0]->product_variation_stock ? $product->variations[0]->product_variation_stock->stock_qty : 0;
                                }
                            @endphp

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="product_variation_id"
                                @if (!$isVariantProduct) value="{{ $product->variations[0]->id }}" @endif>

                            <!-- Swatches -->
                            <div class="product-swatches-option">
                                <!-- variations -->
                                {{-- @include('frontend.default.pages.partials.products.variations', compact('product')) --}}
                                <!-- variations -->
                            </div>
                            <!-- End Swatches -->

                            <!-- Product Action -->
                            <div class="product-action w-100 d-flex-wrap my-3 my-md-4">
                                <!-- Product Quantity -->
                                <div class="product-form-quantity d-flex-center">
                                    <div class="product-qty qty-increase-decrease d-flex align-items-center">
                                        <button type="button" class="decrease">-</button>
                                        <input type="text" readonly value="1" name="quantity" min="1"
                                            @if (!$isVariantProduct) max="{{ $stock }}" @endif>
                                        <button type="button" class="increase">+</button>
                                    </div>
                                </div>
                                <!-- End Product Quantity -->
                                <!-- Product Add -->
                                <div class="product-form-submit addcart fl-1 ms-3">
                                    <button type="submit" class="btn btn-secondary product-form-cart-submit add-to-cart-btn"
                                        @if (!$isVariantProduct && $stock < 1) disabled @endif>
                                        <span>
                                            @if (!$isVariantProduct && $stock < 1)
                                                {{ localize('Out of Stock') }}
                                            @else
                                                {{ localize('Add to Cart') }}
                                            @endif
                                        </span>
                                    </button>
                                </div>
                                <!-- Product Add -->
                                <!-- Product Buy -->
                                <div class="product-form-submit buyit fl-1 ms-3">
                                    <button type="button" class="btn btn-primary proceed-to-checkout"><span>{{ localize('Buy it now') }}</span></button>
                                </div>
                                <!-- End Product Buy -->
                            </div>
                            <!-- End Product Action -->

                            <!-- Product Info link -->
                            <p class="infolinks d-flex-center justify-content-between">
                                <a class="text-link wishlist" href="javascript:void(0);" onclick="addToWishlist({{ $product->id }})">
                                    <i class="fa-solid fa-heart me-2"></i> <span>{{ localize('Add to Wishlist') }}</span>
                                </a>
                                <a class="text-link compare" href="javascript:void(0);" onclick="addToCompare({{ $product->id }})">
                                    <i class="fa-solid fa-sync me-2"></i> <span>{{ localize('Add to Compare') }}</span>
                                </a>
                                <a href="#shipping-return" class="text-link shippingInfo">
                                    <i class="fa-solid fa-truck me-2"></i> <span>{{ localize('Delivery & Returns') }}</span>
                                </a>
                                <a href="#" class="text-link emaillink me-0" data-bs-toggle="modal" data-bs-target="#inquiry_modal">
                                    <i class="fa-solid fa-question-circle me-2"></i> <span>{{ localize('Inquiry') }}</span>
                                </a>
                            </p>
                            <!-- End Product Info link -->
                        </form>
                        <!-- End Product Form -->

                        <!-- Product Info -->
                        @if(getSetting('enable_customer_view_count') == 1)
                            <div class="userViewMsg featureText" data-user="20" data-time="11000">
                                <i class="fa-solid fa-eye"></i><b class="uersView">{{ rand(10, 30) }}</b> {{ localize('People are Looking for this Product') }}
                            </div>
                        @endif

                        <!-- <div class="shippingMsg featureText">
                            <i class="fa-solid fa-clock"></i>{{ localize('Estimated Delivery Between') }} <b id="fromDate">{{ date('D, M j', strtotime('+3 days')) }}</b> {{ localize('and') }} <b id="toDate">{{ date('D, M j', strtotime('+7 days')) }}</b>.
                        </div> -->

                        @if(getSetting('enable_free_shipping') == 1)
                            <div class="freeShipMsg featureText" data-price="{{ getSetting('free_shipping_min_amount') }}">
                                <i class="fa-solid fa-truck"></i>{{ localize('Spent') }} <b class="freeShip">{{ formatPrice(getSetting('free_shipping_min_amount')) }}</b> {{ localize('More for Free shipping') }}
                            </div>
                        @endif
                        <!-- End Product Info -->

                        <!-- Social Sharing -->
                        <!-- <div class="social-sharing d-flex-center mt-2 lh-lg">
                            <span class="sharing-lbl fw-600">{{ localize('Share') }} :</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('products.show', $product->slug) }}" class="d-flex-center btn btn-link btn--share share-facebook" target="_blank">
                                <i class="fab fa-facebook-f"></i><span class="share-title">Facebook</span>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ $product->collectLocalization('name') }}&url={{ route('products.show', $product->slug) }}" class="d-flex-center btn btn-link btn--share share-twitter" target="_blank">
                                <i class="fab fa-twitter"></i><span class="share-title">Tweet</span>
                            </a>
                            <a href="https://pinterest.com/pin/create/button/?url={{ route('products.show', $product->slug) }}&media={{ uploadedAsset($product->thumbnail_image) }}&description={{ $product->collectLocalization('name') }}" class="d-flex-center btn btn-link btn--share share-pinterest" target="_blank">
                                <i class="fab fa-pinterest-p"></i> <span class="share-title">Pin it</span>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('products.show', $product->slug) }}&title={{ $product->collectLocalization('name') }}" class="d-flex-center btn btn-link btn--share share-linkedin" target="_blank">
                                <i class="fab fa-linkedin-in"></i><span class="share-title">Linkedin</span>
                            </a>
                            <a href="mailto:?subject={{ $product->collectLocalization('name') }}&body={{ route('products.show', $product->slug) }}" class="d-flex-center btn btn-link btn--share share-email">
                                <i class="fa-solid fa-envelope"></i><span class="share-title">Email</span>
                            </a>
                        </div> -->
                        <!-- End Social Sharing -->
                    </div>
                </div>
            </div>
            <!--Product Content-->

            <!-- description -->
            @include('frontend.default.pages.partials.products.description',
                compact('product'))
            <!-- description -->
        </div>
    </section>
    <!--product details end-->

    <!--related product slider start -->
    @include('frontend.default.pages.partials.products.related-products', [
        'relatedProducts' => $relatedProducts,
    ])
    <!--related products slider end-->

    <!-- Product Video Modal -->
    @if($product->vedio_link)
    <div class="modal fade" id="productVideo_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="video-responsive">
                        {!! $product->vedio_link !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- End Product Video Modal -->

    <!-- Product Inquiry Modal -->
    <div class="modal fade" id="inquiry_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">{{ localize('Product Inquiry') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('contactUs.store') }}" method="POST" class="inquiry-form">
                        @csrf
                        <input type="hidden" name="inquiry_product" value="{{ $product->id }}">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" placeholder="{{ localize('Your Name') }}" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" name="email" placeholder="{{ localize('Your Email') }}" required>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" name="subject" value="{{ localize('Inquiry about') }}: {{ $product->collectLocalization('name') }}" required>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" name="message" rows="4" placeholder="{{ localize('Your Message') }}" required>{{ localize('Subject') }}: {{ localize('Inquiry about') }}: {{ $product->collectLocalization('name') }}

</textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">{{ localize('Send Inquiry') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Inquiry Modal -->
@endsection

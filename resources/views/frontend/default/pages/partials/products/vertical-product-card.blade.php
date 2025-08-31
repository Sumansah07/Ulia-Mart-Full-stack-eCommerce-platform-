<div class="vertical-product-card rounded-2 position-relative swiper-slide product-hover-zoom {{ isset($bgClass) ? $bgClass : '' }}" style="cursor: pointer;" onclick="navigateToProduct(event, '{{ route('products.show', $product->slug) }}')">
    @php
        $discountPercentage = discountPercentage($product);
        $isNew = $product->is_new ?? false;
        
        // Check if discount is applicable
        $discount_applicable = false;
        if ($product->discount_start_date != null && $product->discount_end_date != null) {
            if (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date && 
                strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
                $discount_applicable = true;
            }
        }
    @endphp

    <!-- Discount Badge -->
    @if ($discountPercentage > 0 && $discount_applicable)
        <span class="offer-badge text-white fw-bold fs-xxs position-absolute start-0 top-0 m-3 px-3 py-1 rounded-pill"
              style="background-color: #FFB800; z-index: 1;">
            @if ($product->discount_type == 'percent')
                {{ $discountPercentage }}% OFF
            @else
                Rs.{{ number_format($product->discount_value, 0) }} OFF
            @endif
        </span>
    @elseif($isNew)
        <span class="offer-badge text-white fw-bold fs-xxs position-absolute start-0 top-0 m-3 px-3 py-1 rounded-pill"
              style="background-color: #2ECC71; z-index: 1;">
            NEW
        </span>
    @endif

    <!-- Product Image -->
    <div class="thumbnail position-relative text-center" style="height: 200px; padding: 15px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
        <img src="{{ uploadedAsset($product->thumbnail_image) }}" alt="{{ $product->collectLocalization('name') }}"
            class="img-fluid" style="width: 100%; height: 100%; object-fit: cover; object-position: center; border-radius: 8px;">

        <div class="product-btns position-absolute d-flex gap-2 flex-column">
            @if (Auth::check() && Auth::user()->user_type == 'customer')
                <!-- <a href="javascript:void(0);" class="rounded-btn"><i class="fa-regular fa-heart"
                        onclick="addToWishlist({{ $product->id }})"></i></a> -->
            @elseif(!Auth::check())
                <!-- <a href="javascript:void(0);" class="rounded-btn"><i class="fa-regular fa-heart"
                        onclick="addToWishlist({{ $product->id }})"></i></a> -->
            @endif

            <a href="javascript:void(0);" class="rounded-btn" onclick="showProductDetailsModal({{ $product->id }})"><i
                    class="fa-regular fa-eye"></i></a>
        </div>
    </div>

    <div class="card-content p-3">
        <!-- Reward Points -->
        @if (getSetting('enable_reward_points') == 1)
            <span class="fs-xxs fw-bold" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-title="{{ localize('Reward Points') }}">
                <i class="fas fa-medal"></i> {{ $product->reward_points }}
            </span>
        @endif

        <!--product category start-->
        <div class="mb-2 tt-category tt-line-clamp tt-clamp-1">
            @if ($product->categories()->count() > 0)
                @foreach ($product->categories as $category)
                    <a href="{{ route('products.index') }}?&category_id={{ $category->id }}"
                        class="d-inline-block text-muted fs-xxs text-uppercase">{{ $category->collectLocalization('name') }}
                        @if (!$loop->last)
                            ,
                        @endif
                    </a>
                @endforeach
            @endif
        </div>
        <!--product category end-->

        <!-- Product Name -->
        <a href="{{ route('products.show', $product->slug) }}"
            class="card-title fw-medium mb-2 tt-line-clamp tt-clamp-1 text-dark">{{ $product->collectLocalization('name') }}
        </a>

         <!-- Product Price -->
                            <div class="product-price d-flex-center my-3">
                                <span class="text-success text-bold fs-xxs" style="font-family: inherit; font-size: 0.6rem;">
                                    @include('frontend.default.pages.partials.products.pricing-with-tax', [
                                        'product' => $product,
                                        'cardContext' => true
                                    ])
                                </span>
                            </div>
                            <!-- End Product Price -->

        <!-- Sold Progress -->
        @isset($showSold)
            <div class="card-progressbar mb-2 mt-3 rounded-pill">
                <span class="card-progress bg-primary" data-progress="{{ sellCountPercentage($product) }}%"
                    style="width: {{ sellCountPercentage($product) }}%;"></span>
            </div>
            <p class="mb-0 fw-semibold">{{ localize('Total Sold') }}: <span
                    class="fw-bold text-secondary">{{ $product->total_sale_count }}/{{ $product->sell_target }}</span>
            </p>
        @endisset

        <!-- Add to Cart Section -->
        @php
            $isVariantProduct = 0;
            $stock = 0;
            if ($product->variations()->count() > 1) {
                $isVariantProduct = 1;
            } else {
                $stock = $product->variations[0]->product_variation_stock ? $product->variations[0]->product_variation_stock->stock_qty : 0;
            }
        @endphp

        @if ($isVariantProduct)
            <div class="d-flex align-items-center mt-3" style="gap: 5px; flex-wrap: nowrap;">
                <div class="d-flex align-items-center flex-shrink-0" style="border: 1px solid #dee2e6; border-radius: 25px; height: 40px; width: 48%; min-width: 90px;">
                    <button type="button" class="btn px-1 py-0 border-0 flex-shrink-0" style="font-size: 18px; font-weight: bold; height: 100%; min-width: 30px; width: 33%;" disabled>-</button>
                    <input type="text" class="form-control text-center border-0 px-0 flex-shrink-0" value="1" readonly style="width: 34%; height: 100%; box-shadow: none; min-width: 30px;">
                    <button type="button" class="btn px-1 py-0 border-0 flex-shrink-0" style="font-size: 18px; font-weight: bold; height: 100%; min-width: 30px; width: 33%;" disabled>+</button>
                </div>
                <a href="javascript:void(0);" class="btn fw-medium px-1 d-flex align-items-center justify-content-center" onclick="showProductDetailsModal({{ $product->id }})"
                   style="background-color: #2ECC71 !important; color: white !important; height: 40px; text-transform: uppercase; font-size: 12px; width: 48%; min-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; letter-spacing: -0.3px; border-radius: 25px; transition: background-color 0.3s ease; border: none !important; outline: none !important; box-shadow: none !important;"
                   onmouseover="this.style.backgroundColor='#27ae60' !important" onmouseout="this.style.backgroundColor='#2ECC71' !important">{{ strtoupper(localize('Add to Cart')) }}</a>
            </div>
        @else
            <form action="" class="direct-add-to-cart-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="product_variation_id" value="{{ $product->variations[0]->id }}">
                <input type="hidden" value="1" name="quantity" id="hidden-quantity-{{ $product->id }}">

                @if (!$isVariantProduct && $stock < 1)
                    <div class="d-flex align-items-center mt-3" style="gap: 5px; flex-wrap: nowrap;">
                        <div class="d-flex align-items-center flex-shrink-0" style="border: 1px solid #dee2e6; border-radius: 25px; height: 40px; width: 48%; min-width: 90px;">
                            <button type="button" class="btn px-1 py-0 border-0 flex-shrink-0" style="font-size: 18px; font-weight: bold; height: 100%; min-width: 30px; width: 33%;" disabled>-</button>
                            <input type="text" class="form-control text-center border-0 px-0 flex-shrink-0" value="1" readonly style="width: 34%; height: 100%; box-shadow: none; min-width: 30px;">
                            <button type="button" class="btn px-1 py-0 border-0 flex-shrink-0" style="font-size: 18px; font-weight: bold; height: 100%; min-width: 30px; width: 33%;" disabled>+</button>
                        </div>
                        <button type="button" class="btn fw-medium px-1 d-flex align-items-center justify-content-center" style="background-color: #CCCCCC; color: white !important; height: 40px; text-transform: uppercase; font-size: 12px; width: 48%; min-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; letter-spacing: -0.3px; border-radius: 25px; border: none !important; outline: none !important; box-shadow: none !important;" disabled>
                            {{ strtoupper(localize('Out of Stock')) }}
                        </button>
                    </div>
                @else
                    <div class="d-flex align-items-center mt-3" style="gap: 5px; flex-wrap: nowrap;">
                        <div class="d-flex align-items-center flex-shrink-0" style="border: 1px solid #dee2e6; border-radius: 25px; height: 40px; width: 48%; min-width: 90px;">
                            <button type="button" class="btn px-1 py-0 border-0 flex-shrink-0" style="font-size: 18px; font-weight: bold; height: 100%; min-width: 30px; width: 33%;" onclick="decrementQuantity(this)">-</button>
                            <input type="text" name="quantity" class="form-control text-center border-0 px-0 flex-shrink-0" value="1" readonly style="width: 34%; height: 100%; box-shadow: none; min-width: 30px;"
                                   onchange="document.getElementById('hidden-quantity-{{ $product->id }}').value = this.value;">
                            <button type="button" class="btn px-1 py-0 border-0 flex-shrink-0" style="font-size: 18px; font-weight: bold; height: 100%; min-width: 30px; width: 33%;" onclick="incrementQuantity(this)">+</button>
                        </div>
                        <button type="button" onclick="directAddToCartFormSubmit(this)" class="btn fw-medium px-1 direct-add-to-cart-btn add-to-cart-text d-flex align-items-center justify-content-center"
                                style="background-color:rgb(24, 147, 65) !important; color: white !important; height: 40px; text-transform: uppercase; font-size: 12px; width: 48%; min-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; letter-spacing: -0.3px; border-radius: 25px; transition: background-color 0.3s ease; border: none !important; outline: none !important; box-shadow: none !important;"
                                onmouseover="this.style.backgroundColor='#27ae60' !important" onmouseout="this.style.backgroundColor='#2ECC71' !important">
                            {{ strtoupper(localize('Add to Cart')) }}
                        </button>
                    </div>
                @endif
            </form>
        @endif
    </div>
</div>
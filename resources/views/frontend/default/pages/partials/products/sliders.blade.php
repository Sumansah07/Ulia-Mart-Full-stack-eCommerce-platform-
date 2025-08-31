<!-- Product Horizontal -->
<div class="product-details-img product-horizontal-style">
    @php
        if (!is_null($product->gallery_images)) {
            $galleryImages = explode(',', $product->gallery_images);
        } else {
            $product->thumbnail_image ? $galleryImages[] = $product->thumbnail_image : $galleryImages = [];
        }
    @endphp

    <!-- Product Main -->
    <div class="zoompro-wrap">
        <!-- Product Image -->
        <div class="zoompro-span">
            <img id="zoompro" class="zoompro"
                src="{{ !empty($galleryImages) ? uploadedAsset($galleryImages[0]) : noImage() }}"
                data-zoom-image="{{ !empty($galleryImages) ? uploadedAsset($galleryImages[0]) : noImage() }}"
                alt="{{ $product->collectLocalization('name') }}" />
        </div>
        <!-- End Product Image -->

        <!-- Product Label -->
        <div class="product-labels">
            @if($product->is_new == 1)
                <span class="lbl pr-label1">{{ localize('New') }}</span>
            @endif

            @if($product->is_featured == 1)
                <span class="lbl pr-label2">{{ localize('Featured') }}</span>
            @endif

            @if(discountedProductBasePrice($product) < productBasePrice($product))
                <span class="lbl on-sale">{{ localize('Sale') }}</span>
            @endif
        </div>
        <!-- End Product Label -->

        <!-- Product Buttons -->
        <div class="product-buttons">
            @if($product->vedio_link)
                <a href="#productVideo-modal" class="btn btn-primary popup-video" data-bs-toggle="modal" data-bs-target="#productVideo_modal">
                    <span class="icon-wrap d-flex-justify-center h-100 w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Watch Video') }}">
                        <i class="fa-solid fa-video"></i>
                    </span>
                </a>
            @endif
            <a href="javascript:void(0);" class="btn btn-primary prlightbox" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Zoom Image') }}">
                <i class="fa-solid fa-expand"></i>
            </a>
        </div>
        <!-- End Product Buttons -->
    </div>
    <!-- End Product Main -->

    <!-- Product Thumb -->
    <div class="product-thumb product-horizontal-thumb mt-3">
        <div id="gallery" class="product-thumb-horizontal">
            @forelse($galleryImages as $key => $galleryImage)
                <a data-image="{{ uploadedAsset($galleryImage) }}"
                   data-zoom-image="{{ uploadedAsset($galleryImage) }}"
                   class="slick-slide {{ $key == 0 ? 'active' : '' }}">
                    <img class="blur-up lazyload"
                         src="{{ uploadedAsset($galleryImage) }}"
                         alt="{{ $product->collectLocalization('name') }}" />
                </a>
            @empty
                <a data-image="{{ noImage() }}"
                   data-zoom-image="{{ noImage() }}"
                   class="slick-slide active">
                    <img class="blur-up lazyload"
                         src="{{ noImage() }}"
                         alt="No Image" />
                </a>
            @endforelse
        </div>
    </div>
    <!-- End Product Thumb -->

    <!-- Product Gallery -->
    <div class="lightboximages">
        @forelse($galleryImages as $galleryImage)
            <a href="{{ uploadedAsset($galleryImage) }}" data-size="1000x1280"></a>
        @empty
            <a href="{{ noImage() }}" data-size="1000x1280"></a>
        @endforelse
    </div>
    <!-- End Product Gallery -->
</div>
<!-- End Product Horizontal -->

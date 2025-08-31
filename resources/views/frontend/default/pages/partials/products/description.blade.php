<!--Product Tabs-->
<div class="tabs-listing section pb-0 mt-4">
    <ul class="product-tabs style2 list-unstyled d-flex-wrap d-flex-justify-center d-none d-md-flex">
        <li rel="description" class="active"><a class="tablink">{{ localize('Description') }}</a></li>
        <li rel="additionalInformation"><a class="tablink">{{ localize('Additional Information') }}</a></li>
        @if($product->vedio_link)
            <li rel="video-gallery"><a class="tablink">{{ localize('Video Gallery') }}</a></li>
        @endif
        <li rel="shipping-return"><a class="tablink">{{ localize('Shipping & Return') }}</a></li>
        <li rel="reviews"><a class="tablink">{{ localize('Reviews') }}</a></li>
    </ul>

    <div class="tab-container">
        <!--Description-->
        <h3 class="tabs-ac-style d-md-none active" rel="description">{{ localize('Description') }}</h3>
        <div id="description" class="tab-content">
            <div class="product-description">
                <div class="row">
                    <div class="col-12">
                        @if ($product->description)
                            {!! $product->collectLocalization('description') !!}
                        @else
                            <div class="text-dark text-center border py-2">{{ localize('Not Available') }}</div>
                        @endif

                        @if($product->features)
                            <h4 class="mb-3">{{ localize('Features') }}</h4>
                            <ul class="checkmark-info">
                                @foreach(explode("\n", $product->features) as $feature)
                                    @if(trim($feature) != '')
                                        <li>{{ $feature }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--End Description-->

        <!--Additional Information-->
        <h3 class="tabs-ac-style d-md-none" rel="additionalInformation">{{ localize('Additional Information') }}</h3>
        <div id="additionalInformation" class="tab-content">
            <div class="product-description">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4 mb-md-0">
                        @if ($product->additional_information)
                            <div class="mb-4">
                                {!! $product->collectLocalization('additional_information') !!}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle table-part mb-0">
                                @forelse (generateVariationOptions($product->variation_combinations) as $variation)
                                    <tr>
                                        <th>{{ $variation['name'] }}</th>
                                        <td>
                                            @foreach ($variation['values'] as $value)
                                                {{ $value['name'] }}@if (!$loop->last), @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @empty
                                    @if (!$product->additional_information)
                                        <tr>
                                            <td class="text-dark text-center" colspan="2">{{ localize('Not Available') }}</td>
                                        </tr>
                                    @endif
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Additional Information-->

        @if($product->vedio_link)
            <!--Video Gallery-->
            <h3 class="tabs-ac-style d-md-none" rel="video-gallery">{{ localize('Video Gallery') }}</h3>
            <div id="video-gallery" class="tab-content">
                <div class="product-description">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4 mb-md-0">
                            <div class="video-responsive">
                                {!! $product->vedio_link !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Video Gallery-->
        @endif

        <!--Shipping & Return-->
        <h3 class="tabs-ac-style d-md-none" rel="shipping-return">{{ localize('Shipping & Return') }}</h3>
        <div id="shipping-return" class="tab-content">
            <h4>{{ localize('Shipping & Return') }}</h4>
            <ul class="checkmark-info">
                <li>{{ localize('Dispatch: Within 24 Hours') }}</li>
                <li>{{ localize('Free shipping across all products on a minimum purchase of') }} {{ formatPrice(getSetting('free_shipping_min_amount')) }}.</li>
                <li>{{ localize('International delivery time - 7-10 business days') }}</li>
                <li>{{ localize('Cash on delivery might be available') }}</li>
                <li>{{ localize('Easy 30 days returns and exchanges') }}</li>
            </ul>

            @if(getSetting('return_policy'))
                <h4>{{ localize('Return Policy') }}</h4>
                <p>{!! getSetting('return_policy') !!}</p>
            @endif
        </div>
        <!--End Shipping & Return-->

        <!--Review-->
        <h3 class="tabs-ac-style d-md-none" rel="reviews">{{ localize('Reviews') }}</h3>
        <div id="reviews" class="tab-content">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-4">
                    <div class="ratings-main">
                        <div class="avg-rating d-flex-center mb-3">
                            @php
                                $reviews = $product->reviews()->where('status', 1)->get();
                                $average_rating = $reviews->count() > 0 ? $reviews->average('rating') : 0;
                            @endphp
                            <h4 class="avg-mark">{{ number_format($average_rating, 1) }}</h4>
                            <div class="avg-content ms-3">
                                <p class="text-rating">{{ localize('Average Rating') }}</p>
                                <div class="ratings-full product-review">
                                    <a class="reviewLink d-flex-center" href="#reviews">
                                        @for($i = 0; $i < 5; $i++)
                                            @if($i < round($average_rating))
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                        <span class="caption ms-2">{{ $reviews->count() }} {{ localize('Ratings') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="ratings-list">
                            @for($i = 5; $i >= 1; $i--)
                                @php
                                    $rating_count = $reviews->where('rating', $i)->count();
                                    $percentage = $reviews->count() > 0 ? ($rating_count / $reviews->count()) * 100 : 0;
                                @endphp
                                <div class="ratings-container d-flex align-items-center mt-1">
                                    <div class="ratings-full product-review m-0">
                                        <a class="reviewLink d-flex align-items-center" href="#reviews">
                                            @for($j = 0; $j < 5; $j++)
                                                @if($j < $i)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </a>
                                    </div>
                                    <div class="progress ms-3">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress-value ms-3">{{ $rating_count }}</div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-4">
                    <div class="spr-form">
                        <form method="post" action="{{ route('products.reviews.store') }}" class="product-review-form new-review-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <h3 class="spr-form-title">{{ localize('Write a Review') }}</h3>
                            <fieldset class="spr-form-contact">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 spr-form-contact-name form-group">
                                        <label class="spr-form-label" for="name">{{ localize('Name') }} <span class="required">*</span></label>
                                        <input class="spr-form-input" id="name" type="text" name="name" required>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 spr-form-contact-email form-group">
                                        <label class="spr-form-label" for="email">{{ localize('Email') }} <span class="required">*</span></label>
                                        <input class="spr-form-input" id="email" type="email" name="email" required>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="spr-form-review">
                                <div class="spr-form-review-rating form-group">
                                    <label class="spr-form-label">{{ localize('Rating') }}</label>
                                    <div class="product-review d-flex-center mb-3">
                                        <div class="reviewStar d-flex-center">
                                            <div class="rating-form">
                                                @for($i = 5; $i >= 1; $i--)
                                                    <input type="radio" name="rating" id="rating-{{ $i }}" value="{{ $i }}" required>
                                                    <label for="rating-{{ $i }}"><i class="far fa-star"></i></label>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="spr-form-review-title form-group">
                                    <label class="spr-form-label" for="review_title">{{ localize('Review Title') }}</label>
                                    <input class="spr-form-input" id="review_title" type="text" name="title" required>
                                </div>
                                <div class="spr-form-review-body form-group">
                                    <label class="spr-form-label" for="review_body">{{ localize('Review') }} <span class="spr-form-review-body-charactersremaining">(1500)</span></label>
                                    <div class="spr-form-input">
                                        <textarea class="spr-form-input-textarea" id="review_body" name="content" rows="5" required></textarea>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="spr-form-actions">
                                <button type="submit" class="btn btn-primary spr-button spr-button-primary">{{ localize('Submit Review') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="spr-reviews">
                        <h3 class="spr-reviews-title">{{ localize('Customer Reviews') }}</h3>
                        <div class="review-inner">
                            @forelse($reviews as $review)
                                <div class="spr-review">
                                    <div class="spr-review-header">
                                        <span class="product-review spr-starratings">
                                            @for($i = 0; $i < 5; $i++)
                                                @if($i < $review->rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </span>
                                        <h5 class="spr-review-header-title mt-1">{{ $review->title }}</h5>
                                        <span class="spr-review-header-byline">
                                            <strong>{{ $review->name }}</strong> {{ localize('on') }} <strong>{{ date('M d, Y', strtotime($review->created_at)) }}</strong>
                                        </span>
                                    </div>
                                    <div class="spr-review-content">
                                        <p class="spr-review-content-body">{{ $review->content }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center">
                                    <p>{{ localize('No reviews yet') }}</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Review-->
    </div>
</div>
<!--End Product Tabs-->

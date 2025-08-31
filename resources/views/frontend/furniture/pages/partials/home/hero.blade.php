<!-- Hero Carousel from Infinite Application -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" style="background: linear-gradient(to right, #0d3b66, #0f5aa5);">
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-md-6 text-white">
                        <div class="mb-2 small">UliaaMart</div>
                        <h1 class="display-4 fw-bold mb-4">
                            100% Organics<br>
                            Fruits &<br>
                            Vegetables
                        </h1>
                        <p class="mb-4">
                            Praesent eu tellus vitae quam fermentum facilisis at sit amet mauris. Nam ac tristique sapien. In sollicitudin tristique urna, a venenatis purus luctus non.
                        </p>
                        <a href="{{ route('home.pages.products') }}" class="btn btn-outline-light px-4 py-2">BROWSE PRODUCTS</a>
                    </div>
                    <div class="col-md-6 position-relative">
                        <img src="{{ staticAsset('frontend/default/assets/img/products/product-1.png') }}" class="img-fluid" alt="Organic Products">
                        <div class="position-absolute top-0 end-0 bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-weight: 700;">-30%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item" style="background: linear-gradient(to right, #006633, #008542);">
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-md-6 text-white">
                        <div class="mb-2 small">UliaaMart</div>
                        <h1 class="display-4 fw-bold mb-4">
                            Fresh Dairy<br>
                            Products<br>
                            Daily
                        </h1>
                        <p class="mb-4">
                            Praesent eu tellus vitae quam fermentum facilisis at sit amet mauris. Nam ac tristique sapien. In sollicitudin tristique urna, a venenatis purus luctus non.
                        </p>
                        <a href="{{ route('home.pages.products') }}" class="btn btn-outline-light px-4 py-2">BROWSE PRODUCTS</a>
                    </div>
                    <div class="col-md-6 position-relative">
                        <img src="{{ staticAsset('frontend/default/assets/img/products/product-2.png') }}" class="img-fluid" alt="Dairy Products">
                        <div class="position-absolute top-0 end-0 bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-weight: 700;">-25%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item" style="background: linear-gradient(to right, #f5b700, #f7c730);">
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-md-6 text-dark">
                        <div class="mb-2 small">UliaaMart</div>
                        <h1 class="display-4 fw-bold mb-4">
                            Household<br>
                            Essentials<br>
                            Sale
                        </h1>
                        <p class="mb-4">
                            Praesent eu tellus vitae quam fermentum facilisis at sit amet mauris. Nam ac tristique sapien. In sollicitudin tristique urna, a venenatis purus luctus non.
                        </p>
                        <a href="{{ route('home.pages.products') }}" class="btn btn-outline-dark px-4 py-2">BROWSE PRODUCTS</a>
                    </div>
                    <div class="col-md-6 position-relative">
                        <img src="{{ staticAsset('frontend/default/assets/img/products/product-3.png') }}" class="img-fluid" alt="Household Products">
                        <div class="position-absolute top-0 end-0 bg-danger text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-weight: 700;">-40%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!-- Hero Carousel End -->


{{-- Old slider here--}}
{{-- <section class="hero-7 gshop-hero pt-120 bg-white position-relative z-1 overflow-hidden">
    <img src="{{ staticAsset('frontend/default/assets/img/shapes/leaf-shadow.png') }}" alt="leaf"
        class="position-absolute leaf-shape z--1 rounded-circle d-none d-lg-inline">
    <img src="{{ staticAsset('frontend/default/assets/img/shapes/mango.png') }}" alt="mango"
        class="position-absolute mango z--1" data-parallax='{"y": -120}'>

    <img src="{{ staticAsset('frontend/default/assets/img/shapes/hero-circle-sm.png') }}" alt="circle"
        class="position-absolute hero-circle circle-sm z--1 d-none d-md-inline">

    <div class="container">
        <div class="gshop-hero-slider swiper">
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                    <div class="swiper-slide gshop-hero-single">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-xl-5 col-lg-7">
                                <div class="hero-left-content">
                                    <span
                                        class="gshop-subtitle fs-5 text-secondary mb-2 d-block">{{ $slider->sub_title }}</span>
                                    <h1 class="display-4 mb-3">{{ $slider->title }}</h1>
                                    <p class="mb-5 fs-6">{{ $slider->text }}</p>

                                    <div class="hero-btns d-flex align-items-center gap-3 gap-sm-5 flex-wrap">
                                        <a href="{{ $slider->link }}"
                                            class="btn btn-secondary">{{ localize('Explore Now') }}<span
                                                class="ms-2"><i class="fa-solid fa-arrow-right"></i></span></a>
                                        <a href="{{ route('home.pages.aboutUs') }}"
                                            class="btn btn-primary">{{ localize('About Us') }}<span class="ms-2"><i
                                                    class="fa-solid fa-arrow-right"></i></span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-5">
                                <div class="hero-right text-center position-relative z-1 mt-6 mt-xl-0">

                                    <img src="{{ uploadedAsset($slider->image) }}" alt=""
                                        class="img-fluid position-absolute end-0 top-50 hero-img">

                                    <img src="{{ staticAsset('frontend/default/assets/img/shapes/hero-circle-lg.png') }}"
                                        alt="circle shape" class="img-fluid hero-circle">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @if(getSetting('facebook_link') || getSetting('twitter_link') || getSetting('linkedin_link') || getSetting('youtube_link'))
        <div class="gs-hero-social">
            <ul class="list-unstyled">
                @if(getSetting('facebook_link'))
                    <li><a href="{{ getSetting('facebook_link') }}"><i class="fab fa-facebook-f"></i></a></li>
                @endif
                @if(getSetting('twitter_link'))
                    <li><a href="{{ getSetting('twitter_link') }}"><i class="fab fa-twitter"></i></a></li>
                @endif
                @if(getSetting('linkedin_link'))
                    <li><a href="{{ getSetting('linkedin_link') }}"><i class="fab fa-linkedin-in"></i></a></li>
                @endif
                @if(getSetting('youtube_link'))
                    <li><a href="{{ getSetting('youtube_link') }}"><i class="fab fa-youtube"></i></a></li>
                @endif

            </ul>
            <span class="title fw-medium">{{localize('Follow on')}}</span>
        </div>
    @endif

    <div class="gshop-hero-slider-pagination theme-slider-control position-absolute top-50 translate-middle-y z-5">
    </div>
</section>  --}}

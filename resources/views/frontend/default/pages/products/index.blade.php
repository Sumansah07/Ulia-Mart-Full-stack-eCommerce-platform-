@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Products') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('breadcrumb-title')
    @if(isset($category) && $category)
        {{ strtoupper($category->name) }}
    @else
        {{ strtoupper(localize('SHOP HOUSEHOLD ITEMS')) }}
    @endif
@endsection

<!-- @section('breadcrumb-active')
    @if(isset($category) && $category)
        {{ strtoupper($category->name) }}
    @else
        {{ strtoupper(localize('HOUSEHOLD ITEMS')) }}
    @endif
@endsection -->

@section('styles')
<style>
    /* ULTRA MAXIMUM PRIORITY - FORCE IMMEDIATE APPLICATION */
    * {
        box-sizing: border-box !important;
    }

    /* NUCLEAR OVERRIDE - DISABLE ALL CONFLICTING CSS FILES */
    html body .collection-slider-6items .category-item,
    html body .collection-slider-6items .category-item .zoom-scal,
    html body .collection-slider-6items .category-item img,
    html body .collection-slider-6items .category-item .category-title,
    html body .collection-slider-6items .category-item .counts {
        all: unset !important;
        display: block !important;
    }

    /* DISABLE MOBILE CATEGORY FIX CSS */
    @media (max-width: 767px) {
        html body .category-slider-section {
            padding: unset !important;
            margin-top: unset !important;
            margin-bottom: unset !important;
        }

        html body .category-card {
            height: unset !important;
            margin-bottom: unset !important;
            display: unset !important;
            flex-direction: unset !important;
        }

        html body .category-card img {
            height: unset !important;
            object-fit: unset !important;
            padding: unset !important;
            flex: unset !important;
            display: unset !important;
            margin: unset !important;
            max-width: unset !important;
        }

        html body .category-info {
            padding: unset !important;
            height: unset !important;
            display: unset !important;
            flex-direction: unset !important;
            justify-content: unset !important;
            background-color: unset !important;
        }

        html body .category-info h5 {
            font-size: unset !important;
            margin: unset !important;
            line-height: unset !important;
            font-weight: unset !important;
        }

        html body .category-info p {
            font-size: unset !important;
            margin: unset !important;
            line-height: unset !important;
        }

        html body .slider-title {
            font-size: unset !important;
            margin-bottom: unset !important;
        }
    }

    @media (max-width: 576px) {
        html body .category-card {
            height: unset !important;
        }

        html body .category-card img {
            height: unset !important;
            padding: unset !important;
        }

        html body .category-info {
            height: unset !important;
        }

        html body .category-info h5 {
            font-size: unset !important;
        }

        html body .category-info p {
            font-size: unset !important;
        }

        html body .slider-title {
            font-size: unset !important;
        }
    }
</style>
<style>
    /* ULTRA AGGRESSIVE BIGGER CARDS - MAXIMUM SIZE OVERRIDE */
    html body .category-slider-section,
    html body #category-slider-section,
    body .category-slider-section,
    body #category-slider-section,
    .category-slider-section,
    #category-slider-section,
    div.category-slider-section {
        max-height: 450px !important;
        height: 450px !important;
        min-height: 450px !important;
        padding: 40px !important;
        margin: 40px 0 !important;
        overflow: visible !important;
        background: #f8f9fa !important;
        font-size: 24px !important;
        display: block !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    html body .category-slider,
    body .category-slider,
    .category-slider,
    div.category-slider {
        max-height: 370px !important;
        height: 370px !important;
        min-height: 370px !important;
        padding: 0 50px !important;
        display: block !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    html body .swiper-wrapper,
    body .swiper-wrapper,
    .swiper-wrapper,
    div.swiper-wrapper {
        max-height: 370px !important;
        height: 370px !important;
        min-height: 370px !important;
        display: flex !important;
        align-items: center !important;
    }

    html body .swiper-slide,
    body .swiper-slide,
    .swiper-slide,
    div.swiper-slide {
        width: 280px !important;
        max-width: 280px !important;
        min-width: 280px !important;
        flex: 0 0 280px !important;
        height: 370px !important;
        margin: 0 20px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    html body .category-card,
    body .category-card,
    .category-card,
    div.category-card,
    .swiper-slide .category-card,
    .subcategory-grid-item .category-card,
    a .category-card {
        height: 300px !important;
        width: 260px !important;
        max-width: 260px !important;
        max-height: 300px !important;
        min-width: 260px !important;
        min-height: 300px !important;
        transform: scale(1) !important;
        margin: 15px auto !important;
        border-radius: 18px !important;
        box-shadow: 0 12px 35px rgba(0,0,0,0.2) !important;
        overflow: hidden !important;
        background: white !important;
        font-size: 16px !important;
        display: block !important;
        position: relative !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
    }

    html body .category-card:hover,
    body .category-card:hover,
    .category-card:hover,
    a .category-card:hover {
        transform: scale(1.08) !important;
        box-shadow: 0 18px 45px rgba(0,0,0,0.3) !important;
        z-index: 10 !important;
    }

    html body .category-card .overflow-hidden,
    body .category-card .overflow-hidden,
    .category-card .overflow-hidden,
    div.overflow-hidden {
        height: 210px !important;
        max-height: 210px !important;
        min-height: 210px !important;
        overflow: hidden !important;
        display: block !important;
        width: 100% !important;
        position: relative !important;
    }

    html body .category-card img,
    body .category-card img,
    .category-card img,
    .overflow-hidden img {
        height: 210px !important;
        width: 100% !important;
        max-width: 100% !important;
        min-height: 210px !important;
        object-fit: cover !important;
        transform: scale(1) !important;
        display: block !important;
        position: relative !important;
    }

    html body .category-info,
    body .category-info,
    .category-info,
    div.category-info {
        height: 90px !important;
        max-height: 90px !important;
        min-height: 90px !important;
        padding: 18px 12px !important;
        text-align: center !important;
        overflow: hidden !important;
        background: white !important;
        display: block !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    html body .category-info h5,
    body .category-info h5,
    .category-info h5,
    .category-info .mb-1 {
        font-size: 20px !important;
        line-height: 1.4 !important;
        margin: 0 0 6px 0 !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        white-space: nowrap !important;
        color: #333 !important;
        letter-spacing: 1px !important;
        display: block !important;
    }

    html body .category-info p,
    body .category-info p,
    .category-info p,
    .category-info .text-muted {
        font-size: 16px !important;
        margin: 0 !important;
        line-height: 1.3 !important;
        color: #666 !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        white-space: nowrap !important;
        font-weight: 600 !important;
        display: block !important;
    }

    html body .slider-title,
    body .slider-title,
    .slider-title,
    h2.slider-title,
    .category-slider-section h2 {
        font-size: 32px !important;
        margin-bottom: 30px !important;
        font-weight: 800 !important;
        text-align: center !important;
        color: #333 !important;
        letter-spacing: 1.5px !important;
        text-transform: uppercase !important;
        display: block !important;
        width: 100% !important;
    }

    /* FORCE MOBILE BIGGER - DIRECT OVERRIDE FOR VERY SMALL SCREENS */
    @media screen and (max-width: 390px) {
        * {
            box-sizing: border-box !important;
        }
        /* AGGRESSIVELY BIGGER MOBILE SECTION FOR SMALL SCREENS */
        html body .category-slider-section,
        html body #category-slider-section,
        body .category-slider-section,
        body #category-slider-section,
        .category-slider-section,
        #category-slider-section {
            max-height: 520px !important;
            height: 520px !important;
            min-height: 520px !important;
            padding: 35px 15px !important;
            margin: 35px 0 !important;
            overflow: visible !important;
        }

        /* AGGRESSIVELY BIGGER MOBILE SLIDER FOR SMALL SCREENS */
        html body .category-slider,
        body .category-slider,
        .category-slider {
            max-height: 450px !important;
            height: 450px !important;
            min-height: 450px !important;
            padding: 0 20px !important;
        }

        /* AGGRESSIVELY BIGGER MOBILE WRAPPER FOR SMALL SCREENS */
        html body .swiper-wrapper,
        body .swiper-wrapper,
        .swiper-wrapper {
            max-height: 450px !important;
            height: 450px !important;
            min-height: 450px !important;
        }

        /* MOBILE SLIDES - AGGRESSIVELY BIGGER FOR SMALL SCREENS */
        html body .swiper-slide,
        body .swiper-slide,
        .swiper-slide {
            height: 430px !important;
            margin: 0 10px !important;
            /* Remove fixed width to let slidesPerView: 2 work */
        }

        /* MOBILE CARDS - AGGRESSIVELY BIGGER FOR SMALL SCREENS */
        html body .category-card,
        body .category-card,
        .category-card {
            height: 410px !important;
            min-height: 410px !important;
            max-height: 410px !important;
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 auto !important;
            border-radius: 20px !important;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2) !important;
            transform: scale(1.1) !important;
            background: white !important;
            overflow: hidden !important;
        }

        /* MOBILE IMAGE CONTAINERS FOR SMALL SCREENS */
        html body .category-card .overflow-hidden,
        body .category-card .overflow-hidden {
            height: 320px !important;
            min-height: 320px !important;
            max-height: 320px !important;
            border-radius: 18px 18px 0 0 !important;
            overflow: hidden !important;
        }

        /* MOBILE IMAGES FOR SMALL SCREENS */
        html body .category-card img,
        body .category-card img {
            height: 320px !important;
            min-height: 320px !important;
            width: 100% !important;
            object-fit: cover !important;
            object-position: center !important;
            display: block !important;
            border-radius: 18px 18px 0 0 !important;
        }

        /* PERFECT MOBILE INFO SECTION FOR SMALL SCREENS */
        html body .category-info,
        body .category-info,
        .category-info {
            height: 90px !important;
            max-height: 90px !important;
            min-height: 90px !important;
            padding: 18px 15px !important;
        }

        /* PERFECT MOBILE TITLES FOR SMALL SCREENS */
        html body .category-info h5,
        body .category-info h5,
        .category-info h5 {
            font-size: 17px !important;
            line-height: 1.3 !important;
            margin: 0 0 8px 0 !important;
            font-weight: 700 !important;
            color: #333 !important;
        }

        /* PERFECT MOBILE DESCRIPTIONS FOR SMALL SCREENS */
        html body .category-info p,
        body .category-info p,
        .category-info p {
            font-size: 13px !important;
            line-height: 1.3 !important;
            color: #666 !important;
            font-weight: 500 !important;
        }

        /* BIGGER MOBILE SECTION TITLE FOR SMALL SCREENS */
        html body .slider-title,
        body .slider-title,
        .slider-title {
            font-size: 26px !important;
            margin-bottom: 22px !important;
            font-weight: 800 !important;
        }
    }

    /* FORCE MOBILE BIGGER - DIRECT OVERRIDE FOR REGULAR MOBILE */
    @media screen and (min-width: 391px) and (max-width: 430px) {
        * {
            box-sizing: border-box !important;
        }
        /* AGGRESSIVELY BIGGER MOBILE SECTION */
        html body .category-slider-section,
        html body #category-slider-section,
        body .category-slider-section,
        body #category-slider-section,
        .category-slider-section,
        #category-slider-section {
            max-height: 550px !important;
            height: 550px !important;
            min-height: 550px !important;
            padding: 40px 20px !important;
            margin: 40px 0 !important;
            overflow: visible !important;
        }

        /* AGGRESSIVELY BIGGER MOBILE SLIDER */
        html body .category-slider,
        body .category-slider,
        .category-slider {
            max-height: 470px !important;
            height: 470px !important;
            min-height: 470px !important;
            padding: 0 25px !important;
        }

        /* AGGRESSIVELY BIGGER MOBILE WRAPPER */
        html body .swiper-wrapper,
        body .swiper-wrapper,
        .swiper-wrapper {
            max-height: 470px !important;
            height: 470px !important;
            min-height: 470px !important;
        }

        /* MOBILE SLIDES - AGGRESSIVELY BIGGER */
        html body .swiper-slide,
        body .swiper-slide,
        .swiper-slide {
            height: 450px !important;
            margin: 0 15px !important;
            /* Remove fixed width to let slidesPerView: 3 work */
        }

        /* PERFECT MOBILE CARDS - REDUCED HEIGHT */
        .category-card {
            height: 320px !important;
            width: 100% !important;
            max-width: 100% !important;
            max-height: 320px !important;
            min-height: 320px !important;
            margin: 20px auto !important;
            border-radius: 20px !important;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2) !important;
            transform: scale(1.1) !important;
            background: white !important;
            overflow: hidden !important;
        }

        html body .category-card,
        body .category-card {
            height: 320px !important;
            width: 100% !important;
            max-width: 100% !important;
            max-height: 320px !important;
            min-height: 320px !important;
            margin: 20px auto !important;
            border-radius: 20px !important;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2) !important;
            transform: scale(1.1) !important;
            background: white !important;
            overflow: hidden !important;
        }

        /* PERFECT MOBILE IMAGE CONTAINER */
        .category-card .overflow-hidden {
            height: 240px !important;
            max-height: 240px !important;
            min-height: 240px !important;
            width: 100% !important;
            overflow: hidden !important;
        }

        html body .category-card .overflow-hidden,
        body .category-card .overflow-hidden {
            height: 240px !important;
            max-height: 240px !important;
            min-height: 240px !important;
            width: 100% !important;
            overflow: hidden !important;
        }

        /* PERFECT MOBILE IMAGES */
        .category-card img {
            height: 240px !important;
            min-height: 240px !important;
            width: 100% !important;
            object-fit: cover !important;
            display: block !important;
        }

        html body .category-card img,
        body .category-card img {
            height: 240px !important;
            min-height: 240px !important;
            width: 100% !important;
            object-fit: cover !important;
            display: block !important;
        }

        /* PERFECT MOBILE INFO SECTION */
        html body .category-info,
        body .category-info,
        .category-info {
            height: 80px !important;
            max-height: 80px !important;
            min-height: 80px !important;
            padding: 15px 12px !important;
        }

        /* PERFECT MOBILE TITLES */
        html body .category-info h5,
        body .category-info h5,
        .category-info h5 {
            font-size: 18px !important;
            line-height: 1.3 !important;
            margin: 0 0 6px 0 !important;
            font-weight: 700 !important;
            color: #333 !important;
        }

        /* PERFECT MOBILE DESCRIPTIONS */
        html body .category-info p,
        body .category-info p,
        .category-info p {
            font-size: 14px !important;
            line-height: 1.3 !important;
            color: #666 !important;
            font-weight: 500 !important;
        }

        /* BIGGER MOBILE SECTION TITLE */
        html body .slider-title,
        body .slider-title,
        .slider-title {
            font-size: 28px !important;
            margin-bottom: 25px !important;
            font-weight: 800 !important;
        }
    }

    /* TABLET SPECIFIC OVERRIDES - MEDIUM SIZE */
    @media screen and (min-width: 431px) and (max-width: 768px) {
        html body .category-slider-section,
        html body #category-slider-section {
            max-height: 400px !important;
            height: 400px !important;
            padding: 30px !important;
        }

        html body .category-card,
        body .category-card,
        .category-card {
            height: 250px !important;
            width: 200px !important;
            max-width: 200px !important;
            max-height: 250px !important;
            margin: 0 15px !important;
        }

        html body .category-card .overflow-hidden,
        body .category-card .overflow-hidden {
            height: 180px !important;
            max-height: 180px !important;
        }

        html body .category-card img,
        body .category-card img {
            height: 180px !important;
        }
    }

    /* TABLET SPECIFIC - 768*1024 RESOLUTION SUBCATEGORY CARDS */
    @media screen and (min-width: 768px) and (max-width: 1024px) {
        /* Subcategory Grid Container */
        .subcategory-grid {
            display: flex !important;
            flex-wrap: nowrap !important;
            justify-content: center !important;
            align-items: center !important;
            gap: 25px !important;
            margin: 0 auto !important;
            padding: 20px !important;
            max-width: 100% !important;
        }

        /* Subcategory Grid Items */
        .subcategory-grid-item {
            flex: 0 0 auto !important;
            margin: 0 !important;
        }

        /* Subcategory Cards - Consistent Sizing */
        .subcategory-grid-item .category-card,
        html body .subcategory-grid-item .category-card,
        body .subcategory-grid-item .category-card {
            height: 280px !important;
            width: 220px !important;
            max-width: 220px !important;
            min-width: 220px !important;
            max-height: 280px !important;
            min-height: 280px !important;
            margin: 0 !important;
            border-radius: 15px !important;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
            background: white !important;
            overflow: hidden !important;
            transition: all 0.3s ease !important;
        }

        /* Subcategory Card Image Containers */
        .subcategory-grid-item .category-card .overflow-hidden,
        html body .subcategory-grid-item .category-card .overflow-hidden,
        body .subcategory-grid-item .category-card .overflow-hidden {
            height: 200px !important;
            max-height: 200px !important;
            min-height: 200px !important;
            width: 100% !important;
            border-radius: 15px 15px 0 0 !important;
            overflow: hidden !important;
        }

        /* Subcategory Card Images */
        .subcategory-grid-item .category-card img,
        html body .subcategory-grid-item .category-card img,
        body .subcategory-grid-item .category-card img {
            height: 200px !important;
            max-height: 200px !important;
            min-height: 200px !important;
            width: 100% !important;
            object-fit: cover !important;
            transition: transform 0.3s ease !important;
        }

        /* Subcategory Card Info Section */
        .subcategory-grid-item .category-card .category-info {
            height: 80px !important;
            max-height: 80px !important;
            min-height: 80px !important;
            padding: 15px !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
            text-align: center !important;
        }

        /* Subcategory Card Titles */
        .subcategory-grid-item .category-card .category-info h5 {
            font-size: 16px !important;
            font-weight: 600 !important;
            color: #333 !important;
            margin: 0 0 5px 0 !important;
            line-height: 1.2 !important;
        }

        /* Subcategory Card Item Count */
        .subcategory-grid-item .category-card .category-info p {
            font-size: 12px !important;
            font-weight: 500 !important;
            color: #666 !important;
            margin: 0 !important;
            line-height: 1 !important;
        }

        /* Hover Effects for Subcategory Cards */
        .subcategory-grid-item .category-card:hover {
            transform: translateY(-5px) !important;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2) !important;
        }

        .subcategory-grid-item .category-card:hover img {
            transform: scale(1.1) !important;
        }
    }

    /* MOBILE SPECIFIC - 375*667 RESOLUTION SUBCATEGORY CARDS */
    @media screen and (max-width: 767px) {
        /* Subcategory Grid Container - Mobile */
        .subcategory-grid {
            display: flex !important;
            flex-wrap: nowrap !important;
            justify-content: flex-start !important;
            align-items: center !important;
            gap: 12px !important;
            margin: 0 auto !important;
            padding: 15px 10px !important;
            width: 100% !important;
            max-width: 100% !important;
            overflow-x: auto !important;
            overflow-y: hidden !important;
        }

        /* Subcategory Grid Items - Mobile */
        .subcategory-grid-item {
            flex: 0 0 auto !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 160px !important;
            max-width: 160px !important;
            min-width: 160px !important;
        }

        /* Subcategory Cards - Mobile Half-Size */
        .subcategory-grid-item .category-card,
        html body .subcategory-grid-item .category-card,
        body .subcategory-grid-item .category-card {
            height: 180px !important;
            width: 160px !important;
            max-width: 160px !important;
            min-width: 160px !important;
            max-height: 180px !important;
            min-height: 180px !important;
            margin: 0 auto !important;
            border-radius: 15px !important;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
            background: white !important;
            overflow: hidden !important;
            transition: all 0.3s ease !important;
        }

        /* Subcategory Card Image Containers - Mobile */
        .subcategory-grid-item .category-card .overflow-hidden,
        html body .subcategory-grid-item .category-card .overflow-hidden,
        body .subcategory-grid-item .category-card .overflow-hidden {
            height: 120px !important;
            max-height: 120px !important;
            min-height: 120px !important;
            width: 100% !important;
            border-radius: 15px 15px 0 0 !important;
            overflow: hidden !important;
        }

        /* Subcategory Card Images - Mobile */
        .subcategory-grid-item .category-card img,
        html body .subcategory-grid-item .category-card img,
        body .subcategory-grid-item .category-card img {
            height: 120px !important;
            max-height: 120px !important;
            min-height: 120px !important;
            width: 100% !important;
            object-fit: cover !important;
            transition: transform 0.3s ease !important;
        }

        /* Subcategory Card Info Section - Mobile */
        .subcategory-grid-item .category-card .category-info {
            height: 60px !important;
            max-height: 60px !important;
            min-height: 60px !important;
            padding: 8px 6px !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
            text-align: center !important;
        }

        /* Subcategory Card Titles - Mobile */
        .subcategory-grid-item .category-card .category-info h5 {
            font-size: 14px !important;
            font-weight: 600 !important;
            color: #333 !important;
            margin: 0 0 3px 0 !important;
            line-height: 1.1 !important;
        }

        /* Subcategory Card Item Count - Mobile */
        .subcategory-grid-item .category-card .category-info p {
            font-size: 11px !important;
            font-weight: 500 !important;
            color: #666 !important;
            margin: 0 !important;
            line-height: 1 !important;
        }
    }

    /* DESKTOP SPECIFIC OVERRIDES - PROPER SPACING */
    @media screen and (min-width: 769px) {
        html body .category-slider-section,
        html body #category-slider-section {
            padding: 40px 20px !important;
            margin: 30px 0 !important;
        }

        html body .category-card,
        body .category-card,
        .category-card {
            height: 280px !important;
            width: 220px !important;
            max-width: 220px !important;
            max-height: 280px !important;
            margin: 0 20px !important;
            transform: scale(1) !important;
            border-radius: 15px !important;
        }

        html body .category-card .overflow-hidden,
        body .category-card .overflow-hidden {
            height: 200px !important;
            max-height: 200px !important;
        }

        html body .category-card img,
        body .category-card img {
            height: 200px !important;
            min-height: 200px !important;
        }

        html body .category-info,
        body .category-info,
        .category-info {
            height: 80px !important;
            padding: 15px !important;
        }

        html body .category-info h5,
        body .category-info h5,
        .category-info h5 {
            font-size: 16px !important;
            font-weight: 600 !important;
            margin: 0 0 8px 0 !important;
        }

        html body .category-info p,
        body .category-info p,
        .category-info p {
            font-size: 13px !important;
            font-weight: 500 !important;
        }

        /* Desktop slider spacing */
        .swiper-slide {
            margin: 0 10px !important;
        }
    }

    /* Direct zoom effect styles */
    .category-card .overflow-hidden {
        overflow: hidden !important;
    }

    /* Navigation arrows visibility control */
    #category-slider-section .swiper-button-next,
    #category-slider-section .swiper-button-prev {
        display: none !important;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    #category-slider-section:hover .swiper-button-next,
    #category-slider-section:hover .swiper-button-prev {
        display: flex !important;
        opacity: 1;
    }

    /* Category Header Bar Styles */
    .category-header-bar {
        background-color: #f0f0f0 !important;
        border-bottom: 1px solid #e5e5e5;
        padding: 15px 0;
        margin-bottom: 20px;
    }

    .category-header-bar h2 {
        color: #333;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0;
        font-size: 20px;
        font-weight: 700;
    }

    .category-header-bar .breadcrumb {
        margin: 0;
        padding: 0;
        background: transparent;
    }

    .category-header-bar .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
        color: #777;
    }

    .category-header-bar .breadcrumb-item a {
        color: #777;
        text-decoration: none;
        font-size: 14px;
    }

    .category-header-bar .breadcrumb-item.active {
        color: #333;
        font-size: 14px;
    }

    .back-to-products {
        display: inline-block;
        background-color: #4CAF50;
        color: white;
        padding: 4px 10px;
        border-radius: 3px;
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.3s ease;
    }

    .back-to-products:hover {
        background-color: #45a049;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .back-to-products i {
        margin-right: 3px;
        font-size: 11px;
    }

    /* DELETED CONFLICTING LARGE STYLES */

    /* Swiper Navigation Buttons - EXACT FROM COPY FILE */
    .swiper-button-next,
    .swiper-button-prev {
        background-color: rgba(255, 255, 255, 0.95);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.12);
        transition: all 0.3s ease;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.18);
        transform: scale(1.05);
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 14px;
        color: #333;
        font-weight: bold;
    }

    /* Pagination Styles - EXACT FROM COPY FILE */
    .swiper-pagination {
        position: relative;
        margin-top: 6px;
    }

    .swiper-pagination-bullet {
        width: 6px;
        height: 6px;
        background: rgba(0, 0, 0, 0.2);
        opacity: 1;
        transition: all 0.3s ease;
    }

    .swiper-pagination-bullet-active {
        background: #4CAF50;
        width: 14px;
        border-radius: 3px;
    }

    /* DELETED MORE CONFLICTING STYLES */

    /* Loading placeholder styles - EXACT FROM COPY FILE */
    .placeholder-loading {
        width: 100%;
        height: 100%;
        background: #f5f5f5;
        position: relative;
        overflow: hidden;
        border-radius: 12px;
    }

    .placeholder-loading::after {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        width: 100%;
        height: 100%;
        transform: translateX(-100%);
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
        animation: loading 1.8s infinite ease-in-out;
    }

    @keyframes loading {
        0% {
            transform: translateX(-100%);
        }
        50% {
            transform: translateX(100%);
        }
        100% {
            transform: translateX(100%);
        }
    }

    .placeholder-img {
        width: 100%;
        height: 100%;
        background-color: #e8e8e8;
        border-radius: 12px;
    }

    /* Loading text animation - EXACT FROM COPY FILE */
    @keyframes pulse {
        0% { opacity: 0.6; }
        50% { opacity: 1; }
        100% { opacity: 0.6; }
    }

    .category-card .category-info h5.loading-text,
    .category-card .category-info p.loading-text {
        animation: pulse 1.5s infinite ease-in-out;
    }

    /* Center align subcategory cards for all screen sizes */
    .category-slider-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .category-slider {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
    }

    .swiper-wrapper {
        justify-content: center;
        align-items: center;
        margin: 0 auto;
    }

    /* Subcategory grid center alignment */
    .subcategory-grid {
        display: flex;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin: 0 auto;
        width: fit-content;
    }

    /* DELETED AGGRESSIVE MOBILE STYLES */

    /* DELETED ALL AGGRESSIVE LARGE STYLES */

    /* PRODUCT CARD - CATEGORY STYLE PROPORTIONS */
    .vertical-product-card {
        max-width: 250px !important;
        margin: 0 auto 20px auto !important;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1) !important;
        border-radius: 15px !important;
        overflow: hidden !important;
        background: white !important;
    }

    .vertical-product-card .thumbnail {
        height: 480px !important;
        min-height: 480px !important;
        max-height: 480px !important;
        padding: 15px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        overflow: hidden !important;
        background: #f8f9fa !important;
        border-radius: 12px !important;
        margin-bottom: 0 !important;
    }

    .vertical-product-card .thumbnail img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        object-position: center !important;
        border-radius: 8px !important;
        transition: transform 0.3s ease !important;
    }

    /* Mobile responsive adjustments */
    @media (max-width: 767px) {
        .vertical-product-card .thumbnail {
            height: 250px !important;
            min-height: 250px !important;
            max-height: 250px !important;
            padding: 15px !important;
        }

        .vertical-product-card .thumbnail img {
            object-fit: cover !important;
            border-radius: 12px !important;
        }
    }

    /* iPhone 14 Pro Max specific (430px) - MOBILE HEIGHT INCREASE */
    @media (max-width: 430px) {
        .vertical-product-card .thumbnail {
            height: 450px !important;
            min-height: 450px !important;
            max-height: 450px !important;
            padding: 20px !important;
        }

        .vertical-product-card .thumbnail img {
            object-fit: cover !important;
            border-radius: 18px !important;
            width: 100% !important;
            height: 100% !important;
        }

        .vertical-product-card {
            margin-bottom: 25px !important;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
            border-radius: 18px !important;
            overflow: hidden !important;
        }
    }

    /* Hover effect for product images */
    .vertical-product-card:hover .thumbnail img {
        transform: scale(1.05) !important;
    }
</style>
<script>
    // Immediate zoom effect application
    document.addEventListener('DOMContentLoaded', function() {
        // Apply zoom effect function
        function applyZoomNow() {
            // Target all category cards
            var cards = document.querySelectorAll('.category-card');
            if (cards.length > 0) {
                console.log('Found ' + cards.length + ' category cards');

                // Add hover listeners to each card
                cards.forEach(function(card) {
                    card.addEventListener('mouseenter', function() {
                        var img = this.querySelector('img');
                        if (img) {
                            img.style.transform = 'scale(1.3)';
                            img.style.filter = 'brightness(1.05) drop-shadow(0 5px 15px rgba(0,0,0,0.2))';
                        }
                    });

                    card.addEventListener('mouseleave', function() {
                        var img = this.querySelector('img');
                        if (img) {
                            img.style.transform = 'scale(1)';
                            img.style.filter = 'none';
                        }
                    });
                });
            }
        }

        // Call immediately
        applyZoomNow();

        // FORCE MOBILE CARD SIZING WITH JAVASCRIPT
        function forceMobileCardSizing() {
            if (window.innerWidth <= 430) {
                console.log('Applying AGGRESSIVE mobile card sizing for screen width:', window.innerWidth);

                // Force card sizing based on screen width
                var cards = document.querySelectorAll('.category-card');
                cards.forEach(function(card) {
                    if (window.innerWidth <= 390) {
                        // Very small screens (like Redmi 390px)
                        card.style.height = '410px';
                        card.style.minHeight = '410px';
                        card.style.maxHeight = '410px';
                        card.style.width = '100%';
                        card.style.margin = '20px auto';
                        card.style.borderRadius = '20px';
                        card.style.transform = 'scale(1.1)';
                        card.style.boxShadow = '0 15px 35px rgba(0,0,0,0.2)';
                        card.style.background = 'white';
                        card.style.overflow = 'hidden';
                    } else {
                        // Regular mobile screens (391px - 430px)
                        card.style.height = '400px';
                        card.style.minHeight = '400px';
                        card.style.maxHeight = '400px';
                        card.style.width = '100%';
                        card.style.margin = '25px auto';
                        card.style.borderRadius = '25px';
                        card.style.transform = 'scale(1.2)';
                        card.style.boxShadow = '0 20px 50px rgba(0,0,0,0.25)';
                        card.style.background = 'white';
                        card.style.overflow = 'hidden';
                    }
                });

                // Force image sizing based on screen width
                var images = document.querySelectorAll('.category-card img');
                images.forEach(function(img) {
                    if (window.innerWidth <= 390) {
                        // Very small screens (like Redmi 390px)
                        img.style.height = '320px';
                        img.style.minHeight = '320px';
                        img.style.width = '100%';
                        img.style.objectFit = 'cover';
                        img.style.display = 'block';
                    } else {
                        // Regular mobile screens (391px - 430px)
                        img.style.height = '300px';
                        img.style.minHeight = '300px';
                        img.style.width = '100%';
                        img.style.objectFit = 'cover';
                        img.style.display = 'block';
                    }
                });

                // Force image container sizing based on screen width
                var containers = document.querySelectorAll('.category-card .overflow-hidden');
                containers.forEach(function(container) {
                    if (window.innerWidth <= 390) {
                        // Very small screens (like Redmi 390px)
                        container.style.height = '320px';
                        container.style.minHeight = '320px';
                    } else {
                        // Regular mobile screens (391px - 430px)
                        container.style.height = '300px';
                        container.style.minHeight = '300px';
                    }
                    container.style.maxHeight = '300px';
                    container.style.width = '100%';
                    container.style.overflow = 'hidden';
                });

                // Force text sizing
                var titles = document.querySelectorAll('.category-info h5');
                titles.forEach(function(title) {
                    title.style.fontSize = '22px';
                    title.style.fontWeight = '800';
                    title.style.color = '#333';
                    title.style.margin = '0 0 10px 0';
                });

                var descriptions = document.querySelectorAll('.category-info p');
                descriptions.forEach(function(desc) {
                    desc.style.fontSize = '18px';
                    desc.style.fontWeight = '500';
                    desc.style.color = '#666';
                });

                console.log('AGGRESSIVE mobile sizing applied to', cards.length, 'cards');
            }
        }

        // Apply immediately and on resize
        forceMobileCardSizing();
        window.addEventListener('resize', forceMobileCardSizing);

        // Apply again after a delay to ensure it overrides any other scripts
        setTimeout(forceMobileCardSizing, 500);
        setTimeout(forceMobileCardSizing, 1000);
        setTimeout(forceMobileCardSizing, 2000);


    });
</script>
@endsection



@section('contents')

    <form class="filter-form" action="{{ Request::fullUrl() }}" method="GET">
        <!--shop grid section start-->
        <section class="gshop-gshop-grid pt-0 pb-120">
            <div class="container">
                @if(Route::is('checkout.proceed') || Route::is('checkout.success') || Route::is('checkout.failed') || Route::is('carts.index'))
                    @yield('simple-breadcrumb')
                @elseif(Route::is('products.index') || Route::is('products.category'))
                    @include('frontend.default.inc.shop-breadcrumb')
                @else
                    @yield('breadcrumb')
                @endif

                <div class="row g-4">

                    @php
                        // Check if we're on a category page or main product page
                        $isCategoryPage = request()->has('category_id');
                        $currentCategoryId = request()->get('category_id', null);
                    @endphp

                    <!-- Offcanvas for mobile filters (hidden as per client request) -->
                    <div class="offcanvas offcanvas-start d-none" tabindex="-1" id="offcanvasProductFilter"
                        aria-labelledby="offcanvasProductFilterLabel" style="display: none !important; visibility: hidden;">
                        <div class="offcanvas-body">
                            <div class="text-end">
                                <button type="button" class="btn-close text-reset text-end" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <nav class="mobile-menu-wrapper scrollbar" id="mobile_version">
                                <!-- Mobile filters will be loaded here -->
                            </nav>
                        </div>
                    </div>

                    <!-- Full-width Category Slider Section (for all pages) -->
                    <div class="col-12">
                        <div class="category-slider-section" id="category-slider-section">
                            <h6 class="slider-title" id="slider-title">
                                @if(isset($category) && $category)
                                    <!-- SHOP BY {{ strtoupper($category->name) }} -->
                                @else
                                    SHOP BY CATEGORY
                                @endif
                            </h6>
                            <div class="swiper category-slider">
                                <div class="swiper-wrapper" id="category-slider-container">
                                    <!-- Small Loading placeholders -->
                                    <div class="swiper-slide" style="padding: 0; margin: 0;">
                                        <div class="category-card" style="margin: 0 auto; height: 120px !important; width: 100px !important; border-radius: 8px !important; box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important; background: #f8f9fa !important; overflow: hidden !important;">
                                            <div class="overflow-hidden" style="width: 100%; height: 80px !important; overflow: hidden !important;">
                                                <div class="placeholder-loading" style="height: 80px !important; background: #e9ecef !important;">
                                                    <div class="placeholder-img" style="height: 80px !important; background: #dee2e6 !important;"></div>
                                                </div>
                                            </div>
                                            <div class="category-info" style="height: 40px !important; padding: 4px !important;">
                                                <h5 class="loading-text" style="text-align: center; width: 100%; font-size: 10px !important; font-weight: 500 !important; color: #6c757d !important; margin: 0 !important;">Loading...</h5>
                                                <p class="loading-text" style="text-align: center; width: 100%; font-size: 8px !important; font-weight: 400 !important; color: #adb5bd !important; margin: 0 !important;">Wait</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide" style="padding: 0; margin: 0;">
                                        <div class="category-card" style="margin: 0 auto; height: 120px !important; width: 100px !important; border-radius: 8px !important; box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important; background: #f8f9fa !important; overflow: hidden !important;">
                                            <div class="overflow-hidden" style="width: 100%; height: 80px !important; overflow: hidden !important;">
                                                <div class="placeholder-loading" style="height: 80px !important; background: #e9ecef !important;">
                                                    <div class="placeholder-img" style="height: 80px !important; background: #dee2e6 !important;"></div>
                                                </div>
                                            </div>
                                            <div class="category-info" style="height: 40px !important; padding: 4px !important;">
                                                <h5 class="loading-text" style="text-align: center; width: 100%; font-size: 10px !important; font-weight: 500 !important; color: #6c757d !important; margin: 0 !important;">Loading...</h5>
                                                <p class="loading-text" style="text-align: center; width: 100%; font-size: 8px !important; font-weight: 400 !important; color: #adb5bd !important; margin: 0 !important;">Wait</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide" style="padding: 0; margin: 0;">
                                        <div class="category-card" style="margin: 0 auto; height: 120px !important; width: 100px !important; border-radius: 8px !important; box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important; background: #f8f9fa !important; overflow: hidden !important;">
                                            <div class="overflow-hidden" style="width: 100%; height: 80px !important; overflow: hidden !important;">
                                                <div class="placeholder-loading" style="height: 80px !important; background: #e9ecef !important;">
                                                    <div class="placeholder-img" style="height: 80px !important; background: #dee2e6 !important;"></div>
                                                </div>
                                            </div>
                                            <div class="category-info" style="height: 40px !important; padding: 4px !important;">
                                                <h5 class="loading-text" style="text-align: center; width: 100%; font-size: 10px !important; font-weight: 500 !important; color: #6c757d !important; margin: 0 !important;">Loading...</h5>
                                                <p class="loading-text" style="text-align: center; width: 100%; font-size: 8px !important; font-weight: 400 !important; color: #adb5bd !important; margin: 0 !important;">Wait</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Navigation buttons -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                                <!-- Pagination dots -->
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End Full-width Category Slider Section -->
                </div>

                <!-- Visual Divider -->
                <div style="height: 1px; background-color: #ddd; margin: 30px 0;"></div>
                <!-- End Visual Divider -->

                <!-- Start new row for sidebar and content -->
                <div class="row g-4">
                    <!-- Sidebar with filters - zero width for all pages -->
                    <div class="col-xl-0" style="width: 0; padding: 0; margin: 0; overflow: hidden;">
                        <div class="d-none" id="desktop_version">
                            @include('frontend.default.pages.products.inc.productSidebar')
                        </div>
                    </div>

                    <!--main content with full width for all pages-->
                    <div class="col-xl-12">

                        <div class="shop-grid" style="margin-top: 20px; padding-top: 0;">
                            <!--filter-->
                            @if(!$isCategoryPage)
                            <div
                                class="listing-top d-flex align-items-center justify-content-between flex-wrap gap-3 bg-white rounded-2 px-4 py-4 mb-5">
                                <p class="mb-0 fw-bold">{{ localize('Showing') }}
                                    {{ $products->firstItem() }}-{{ $products->lastItem() }} {{ localize('of') }}
                                    {{ $products->total() }} {{ localize('results') }}</p>
                                <div class="listing-top-right text-end d-inline-flex align-items-center gap-3 flex-wrap">
                                    <div class="number-count-filter d-flex align-items-center gap-3">
                                        <label
                                            class="fw-bold fs-xs text-dark flex-shrink-0">{{ localize('Show') }}:</label>
                                        <input type="number"
                                            @isset($per_page)
                                        value="{{ $per_page }}"
                                        @else
                                        value="12"
                                        @endisset
                                            name="per_page" class="product-listing-pagination">
                                    </div>
                                    <div class="select-filter d-inline-flex align-items-center gap-3">
                                        <label
                                            class="fw-bold fs-xs text-dark flex-shrink-0">{{ localize('Sort by') }}:</label>
                                        <select name="sort_by"
                                            class="sort_by form-select fs-xxs fw-medium theme-select select-sm">
                                            <option value="new"
                                                @isset($sort_by)
                                                @if ($sort_by == 'new')
                                                selected
                                                @endif
                                            @endisset>
                                                {{ localize('Newest First') }}</option>
                                            <option value="best_selling"
                                                @isset($sort_by)
                                            @if ($sort_by == 'best_selling')
                                            selected
                                            @endif
                                        @endisset>
                                                {{ localize('Best Selling') }}</option>
                                        </select>
                                    </div>
                                    <a href="{{ route('products.index') }}?view=grid"
                                        class="grid-btn {{ request()->view != 'list' ? 'active' : '' }} d-none d-xl-flex">
                                        <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5.97196 0H1.37831C0.706579 0 0.160156 0.546422 0.160156 1.21815V5.8118C0.160156 6.48353 0.706579 7.02996 1.37831 7.02996H5.97196C6.64369 7.02996 7.19011 6.48353 7.19011 5.8118V1.21815C7.19 0.546422 6.64369 0 5.97196 0Z"
                                                fill="#FF7C08" />
                                            <path
                                                d="M14.9407 0H10.3471C9.67533 0 9.12891 0.546422 9.12891 1.21815V5.8118C9.12891 6.48353 9.67533 7.02996 10.3471 7.02996H14.9407C15.6124 7.02996 16.1589 6.48353 16.1589 5.8118V1.21815C16.1589 0.546422 15.6124 0 14.9407 0Z"
                                                fill="#FF7C08" />
                                            <path
                                                d="M5.97196 8.96973H1.37831C0.706579 8.96973 0.160156 9.51609 0.160156 10.1878V14.7815C0.160156 15.4532 0.706579 15.9996 1.37831 15.9996H5.97196C6.64369 15.9996 7.19011 15.4532 7.19011 14.7815V10.1878C7.19 9.51609 6.64369 8.96973 5.97196 8.96973Z"
                                                fill="#FF7C08" />
                                            <path
                                                d="M14.9407 8.96973H10.3471C9.67533 8.96973 9.12891 9.51615 9.12891 10.1879V14.7815C9.12891 15.4533 9.67533 15.9997 10.3471 15.9997H14.9407C15.6124 15.9996 16.1589 15.4532 16.1589 14.7815V10.1878C16.1589 9.51609 15.6124 8.96973 14.9407 8.96973Z"
                                                fill="#FF7C08" />
                                        </svg>
                                    </a>

                                    <!-- Filter button hidden as per client request -->
                                    <button type="button" class="grid-btn d-none" style="display: none !important;">
                                        <svg width="21" height="16" viewBox="0 0 21 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.31378 0C1.12426 0 0.160156 0.9641 0.160156 2.15359C0.160156 3.34309 1.12426 4.30722 2.31378 4.30722C3.50328 4.30722 4.46738 3.34312 4.46738 2.15359C4.46738 0.964066 3.50328 0 2.31378 0ZM2.31378 5.74293C1.12426 5.74293 0.160156 6.70706 0.160156 7.89656C0.160156 9.08608 1.12426 10.0502 2.31378 10.0502C3.50328 10.0502 4.46738 9.08608 4.46738 7.89656C4.46738 6.70706 3.50328 5.74293 2.31378 5.74293ZM2.31378 11.4859C1.12426 11.4859 0.160156 12.45 0.160156 13.6395C0.160156 14.829 1.12426 15.7931 2.31378 15.7931C3.50328 15.7931 4.46738 14.829 4.46738 13.6395C4.46738 12.45 3.50328 11.4859 2.31378 11.4859ZM8.05671 3.58933H19.5426C20.3358 3.58933 20.9783 2.94683 20.9783 2.15359C20.9783 1.36036 20.3358 0.717853 19.5426 0.717853H8.05671C7.26348 0.717853 6.62097 1.36036 6.62097 2.15359C6.62097 2.94683 7.26348 3.58933 8.05671 3.58933ZM19.5426 6.46082H8.05671C7.26348 6.46082 6.62097 7.10332 6.62097 7.89656C6.62097 8.68979 7.26348 9.3323 8.05671 9.3323H19.5426C20.3358 9.3323 20.9783 8.68979 20.9783 7.89656C20.9783 7.10332 20.3358 6.46082 19.5426 6.46082ZM19.5426 12.2038H8.05671C7.26348 12.2038 6.62097 12.8463 6.62097 13.6395C6.62097 14.4327 7.26348 15.0752 8.05671 15.0752H19.5426C20.3358 15.0752 20.9783 14.4327 20.9783 13.6395C20.9783 12.8463 20.3358 12.2038 19.5426 12.2038Z"
                                                fill="#5D6374" />
                                        </svg>
                                    </button>

                                    <a href="{{ route('products.index') }}?view=list"
                                        class="grid-btn {{ request()->view == 'list' ? 'active' : '' }} d-none d-xl-flex">
                                        <svg width="21" height="16" viewBox="0 0 21 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.31378 0C1.12426 0 0.160156 0.9641 0.160156 2.15359C0.160156 3.34309 1.12426 4.30722 2.31378 4.30722C3.50328 4.30722 4.46738 3.34312 4.46738 2.15359C4.46738 0.964066 3.50328 0 2.31378 0ZM2.31378 5.74293C1.12426 5.74293 0.160156 6.70706 0.160156 7.89656C0.160156 9.08608 1.12426 10.0502 2.31378 10.0502C3.50328 10.0502 4.46738 9.08608 4.46738 7.89656C4.46738 6.70706 3.50328 5.74293 2.31378 5.74293ZM2.31378 11.4859C1.12426 11.4859 0.160156 12.45 0.160156 13.6395C0.160156 14.829 1.12426 15.7931 2.31378 15.7931C3.50328 15.7931 4.46738 14.829 4.46738 13.6395C4.46738 12.45 3.50328 11.4859 2.31378 11.4859ZM8.05671 3.58933H19.5426C20.3358 3.58933 20.9783 2.94683 20.9783 2.15359C20.9783 1.36036 20.3358 0.717853 19.5426 0.717853H8.05671C7.26348 0.717853 6.62097 1.36036 6.62097 2.15359C6.62097 2.94683 7.26348 3.58933 8.05671 3.58933ZM19.5426 6.46082H8.05671C7.26348 6.46082 6.62097 7.10332 6.62097 7.89656C6.62097 8.68979 7.26348 9.3323 8.05671 9.3323H19.5426C20.3358 9.3323 20.9783 8.68979 20.9783 7.89656C20.9783 7.10332 20.3358 6.46082 19.5426 6.46082ZM19.5426 12.2038H8.05671C7.26348 12.2038 6.62097 12.8463 6.62097 13.6395C6.62097 14.4327 7.26348 15.0752 8.05671 15.0752H19.5426C20.3358 15.0752 20.9783 14.4327 20.9783 13.6395C20.9783 12.8463 20.3358 12.2038 19.5426 12.2038Z"
                                                fill="#5D6374" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            @endif
                            <!--filter-->

                            <!--products-->
                            <div class="row g-4">
                                @if (count($products) > 0)
                                    @if (request()->has('view') && request()->view == 'list')
                                        @foreach ($products as $product)
                                            <div class="col-xl-12">
                                                @include(
                                                    'frontend.default.pages.partials.products.product-card-list',
                                                    [
                                                        'product' => $product,
                                                    ]
                                                )
                                            </div>
                                        @endforeach
                                    @else
                                        @foreach ($products as $product)
                                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                                                @include(
                                                    'frontend.default.pages.partials.products.vertical-product-card',
                                                    [
                                                        'product' => $product,
                                                        'bgClass' => 'bg-white',
                                                    ]
                                                )
                                            </div>
                                        @endforeach
                                    @endif
                                @else
                                    <div class="col-6 mx-auto">
                                        <img src="{{ staticAsset('frontend/default/assets/img/empty-cart.svg') }}"
                                            alt="" srcset="" class="img-fluid">
                                    </div>
                                @endif

                            </div>
                            <div class="d-sm-block d-lg-flex align-items-center justify-content-between mt-7 tt-custom-pagination">
                                <span>{{ localize('Showing') }}
                                    {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}
                                    {{ localize('of') }}
                                    {{ $products->total() }} {{ localize('results') }}</span>
                                <nav>
                                    {{ $products->appends(request()->input())->onEachSide(0)->links() }}
                                </nav>
                            </div>
                            <!--products-->
                        </div>
                    </div>
                    <!--rightbar-->

                </div>
            </div>
        </section>
        <!--shop grid section end-->



    </form>
@endsection

@section('scripts')
    <script src="{{ staticAsset('frontend/default/assets/js/category-zoom.js') }}"></script>
    <script>
        "use strict";

        function loadTemplate(){
            // Sidebar is hidden, so we don't need to load the template
            // This function is kept for compatibility but doesn't do anything
            console.log("Sidebar template loading skipped - sidebar is hidden");
            return false;
        }

        $('.product-listing-pagination').on('focusout', function() {
            $('.filter-form').submit();
        });

        $('.sort_by').on('change', function() {
            $('.filter-form').submit();
        });

        // Initialize price range slider if we're on the main product page
        @if(!request()->has('category_id'))
        $(document).ready(function() {
            if ($('.price-filter-range').length > 0) {
                $(".price-filter-range").slider({
                    range: true,
                    min: 0,
                    max: {{ $max_range }},
                    values: [{{ $min_value }}, {{ $max_value }}],
                    slide: function(event, ui) {
                        $(".min_price").val(ui.values[0]);
                        $(".max_price").val(ui.values[1]);
                    }
                });
            }
        });
        @endif

        // Initialize Category Slider and fetch categories from API
        $(document).ready(function() {
            // Get current category ID if we're on a category page
            const isCategoryPage = {{ $isCategoryPage ? 'true' : 'false' }};
            const currentCategoryId = {{ $currentCategoryId ? $currentCategoryId : 'null' }};

            // Fetch categories from API
            fetchCategoriesForSlider(isCategoryPage, currentCategoryId);

            // Initialize the category slider
            let categorySlider;

            // Function to optimize slider for mobile - simplified version
            function convertToMobileGrid() {
                // This function is simplified to prevent conflicts
                console.log('Mobile optimization applied');
            }

            function initCategorySlider() {
                // Destroy existing slider if it exists
                if (categorySlider) {
                    categorySlider.destroy(true, true);
                }

                // Get the number of slides
                const slideCount = document.querySelectorAll('.category-slider .swiper-slide').length;
                console.log('Number of slides:', slideCount);

                // Always enable loop mode for continuous sliding
                const enableLoop = true;

                // Check if we're on a category page
                const isCategoryPage = {{ $isCategoryPage ? 'true' : 'false' }};

                // Adjust spacing based on whether we're on a category page
                const spaceBetween = isCategoryPage ? 20 : 20;

                // Initialize new slider
                categorySlider = new Swiper('.category-slider', {
                    slidesPerView: 5,
                    spaceBetween: spaceBetween, // Reduced space between slides for subcategories
                    loop: true, // Always enable loop for continuous sliding
                    autoplay: slideCount > 1 ? {
                        delay: 4000,
                        disableOnInteraction: false,
                    } : false, // Only enable autoplay if we have more than one slide
                    speed: 800,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                        dynamicBullets: true,
                    },
                    grabCursor: true,
                    effect: 'slide',
                    preloadImages: true,
                    lazy: {
                        loadPrevNext: true,
                    },
                    // Center the slides if we're on a category page or have few slides
                    centeredSlides: isCategoryPage || slideCount <= 5,
                    breakpoints: {
                        // iPhone 14/12 Pro width (375px) - PRIORITY BREAKPOINT
                        375: {
                            slidesPerView: 2, // Show ONLY 2 cards for iPhone 14/12 Pro
                            spaceBetween: 8, // Small spacing between slides
                            centeredSlides: false, // Don't center to show more cards
                            loop: true,
                            autoHeight: true, // Allow auto height adjustment
                            effect: 'slide', // Use slide effect for better performance
                            autoplay: {
                                delay: 2500,
                                disableOnInteraction: false,
                            },
                        },
                        // Exact breakpoints from index.blade copy 2.php
                        // when window width is <=390px (small mobile devices like Redmi)
                        390: {
                            slidesPerView: 2, // Show 2 cards to match the screenshot
                            spaceBetween: 5, // Very small spacing between slides for small screens
                            centeredSlides: false, // Don't center to show more cards
                            loop: true,
                            autoHeight: true, // Allow auto height adjustment
                            effect: 'slide', // Use slide effect for better performance
                            autoplay: {
                                delay: 2500,
                                disableOnInteraction: false,
                            },
                        },
                        // when window width is <=393px (mobile)
                        393: {
                            slidesPerView: 2, // Show 2 cards to match the screenshot
                            spaceBetween: 10, // Small spacing between slides
                            centeredSlides: false, // Don't center to show more cards
                            loop: true,
                            autoHeight: true, // Allow auto height adjustment
                            effect: 'slide', // Use slide effect for better performance
                            autoplay: {
                                delay: 2500,
                                disableOnInteraction: false,
                            },
                        },
                        // iPhone 14 Pro Max width (430px)
                        430: {
                            slidesPerView: 2, // Show 2 cards to match the screenshot
                            spaceBetween: 0, // Small spacing between slides
                            centeredSlides: false, // Don't center to show more cards
                            loop: true,
                            autoHeight: true, // Allow auto height adjustment
                            effect: 'slide', // Use slide effect for better performance
                            autoplay: {
                                delay: 2500,
                                disableOnInteraction: false,
                            },
                        },
                        // when window width is <= 768px
                        768: {
                            slidesPerView: 3.2,
                            spaceBetween: 10,
                        },
                        // when window width is <= 992px
                        992: {
                            slidesPerView: 3,
                            spaceBetween: 20,
                        },
                        // when window width is <= 1200px
                        1200: {
                            slidesPerView: 4,
                            spaceBetween: 30,
                        },
                        // when window width is > 1200px
                        1400: {
                            slidesPerView: 5,
                            spaceBetween: 40,
                        }
                    }
                });

                console.log('Swiper initialized:', categorySlider);

                // Additional adjustments for centering slides
                if (isCategoryPage || slideCount <= 5) {
                    // Force update after a short delay to ensure proper centering
                    setTimeout(() => {
                        categorySlider.update();

                        // Add CSS to center slides if we have few slides
                        if (slideCount <= 5) {
                            $('.category-slider .swiper-wrapper').css({
                                'display': 'flex',
                                'justify-content': 'center'
                            });
                        }

                        // Additional adjustments for subcategory view
                        if (isCategoryPage) {
                            // Keep full width but ensure cards are centered
                            $('.category-slider').css({
                                'max-width': '1200px',
                                'padding': '0 35px'
                            });

                            // Style the slides like in the image
                            $('.category-slider .swiper-slide').css({
                                'padding': '0',
                                'width': 'auto !important'
                            });

                            // Apply same desktop sizing to subcategory cards - FORCE IMMEDIATE APPLY
                            if (window.innerWidth >= 769) {
                                // Force hide cards first to prevent flash of wrong size
                                $('.category-slider .category-card').css('visibility', 'hidden');

                                setTimeout(() => {
                                    $('.category-slider .category-card').css({
                                        'height': '280px !important',
                                        'width': '220px !important',
                                        'max-width': '220px !important',
                                        'max-height': '280px !important',
                                        'margin': '0 20px !important',
                                        'transform': 'scale(1) !important',
                                        'border-radius': '15px !important',
                                        'visibility': 'visible !important'
                                    });

                                    $('.category-slider .category-card .overflow-hidden').css({
                                        'height': '200px !important',
                                        'max-height': '200px !important'
                                    });

                                    $('.category-slider .category-card img').css({
                                        'height': '200px !important',
                                        'min-height': '200px !important'
                                    });

                                    $('.category-slider .category-info').css({
                                        'height': '20px !important',
                                        'padding': '5px !important'
                                    });

                                    $('.category-slider .category-info h5').css({
                                        'font-size': '16px !important',
                                        'font-weight': '600 !important',
                                        'margin': '0 0 4px 0 !important'
                                    });

                                    $('.category-slider .category-info p').css({
                                        'font-size': '10px !important',
                                        'font-weight': '500 !important'
                                    });
                                }, 10);
                            }

                            // Force the wrapper to center the slides with gaps
                            $('.category-slider .swiper-wrapper').css({
                                'display': 'flex',
                                'justify-content': 'center',
                                'gap': '20px',
                                'width': 'auto',
                                'margin': '0 auto'
                            });

                            // Force update swiper to apply changes
                            setTimeout(() => {
                                categorySlider.update();
                            }, 50);
                        }
                    }, 100);
                }
            }

            // Function to fetch categories from API
            function fetchCategoriesForSlider(isCategoryPage, currentCategoryId) {
                console.log('Fetching categories for slider...');
                console.log('Is category page:', isCategoryPage);
                console.log('Current category ID:', currentCategoryId);

                // Get the base URL dynamically
                const baseUrl = window.location.origin;
                const apiUrl = `${baseUrl}/api/category/all`;
                const fallbackUrl = `${baseUrl}/api/fallback-categories`;

                console.log('API URL:', apiUrl);

                // Add current category ID to the API call if we're on a category page
                const apiUrlWithParams = isCategoryPage && currentCategoryId ?
                    `${apiUrl}?category_id=${currentCategoryId}` : apiUrl;

                $.ajax({
                    url: apiUrlWithParams,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log('API Response:', response);

                        // Check if we have a valid response with categories
                        if (response) {
                            // Pass the entire response to the populateCategorySlider function
                            populateCategorySlider(response);
                        } else {
                            // Try fallback API if no response
                            console.log('No categories found in main API, trying fallback...');
                            // Add current category ID to the fallback URL if we're on a category page
                            const fallbackUrlWithParams = isCategoryPage && currentCategoryId ?
                                `${fallbackUrl}?category_id=${currentCategoryId}` : fallbackUrl;

                            $.ajax({
                                url: fallbackUrlWithParams,
                                type: 'GET',
                                dataType: 'json',
                                success: function(fallbackResponse) {
                                    console.log('Fallback API Response:', fallbackResponse);
                                    if (fallbackResponse) {
                                        populateCategorySlider(fallbackResponse);
                                    } else {
                                        // If no categories are found, hide the section completely
                                        $('#category-slider-section').hide();
                                    }
                                },
                                error: function() {
                                    // If there's an error, hide the section completely
                                    $('#category-slider-section').hide();
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching categories:', error);
                        // Try fallback API
                        // Add current category ID to the fallback URL if we're on a category page
                        const fallbackUrlWithParams = isCategoryPage && currentCategoryId ?
                            `${fallbackUrl}?category_id=${currentCategoryId}` : fallbackUrl;

                        $.ajax({
                            url: fallbackUrlWithParams,
                            type: 'GET',
                            dataType: 'json',
                            success: function(fallbackResponse) {
                                if (fallbackResponse) {
                                    populateCategorySlider(fallbackResponse);
                                } else {
                                    // If there's an error, hide the section completely
                                    $('#category-slider-section').hide();
                                }
                            },
                            error: function() {
                                // If there's an error, hide the section completely
                                $('#category-slider-section').hide();
                            }
                        });
                    }
                });
            }

            // Function to check if an image exists
            function imageExists(url) {
                return new Promise((resolve) => {
                    const img = new Image();
                    img.onload = () => resolve(true);
                    img.onerror = () => resolve(false);
                    img.src = url;
                });
            }

            // Function to get a valid image URL
            async function getValidImageUrl(url, fallbackUrl, categoryName = '') {
                if (!url || url === null || url === '') {
                    console.log('No image URL provided, using fallback');
                    return getFruitVegetableImage(categoryName, fallbackUrl);
                }

                // Check if we should use specific images for fruits and vegetables
                if (url.includes('placeholder') || url.includes('backend/assets')) {
                    return getFruitVegetableImage(categoryName, fallbackUrl);
                }

                // If it's already a full URL, check if it exists
                if (url.startsWith('http')) {
                    const exists = await imageExists(url);
                    if (exists) {
                        console.log('Image exists at URL:', url);
                        return url;
                    } else {
                        console.log('Image does not exist at URL:', url);
                        return getFruitVegetableImage(categoryName, fallbackUrl);
                    }
                }

                // If it's a relative path, format it properly
                let formattedUrl = url;
                if (!formattedUrl.startsWith('/')) {
                    formattedUrl = '/' + formattedUrl;
                }

                // Prepend the base URL if needed
                if (!formattedUrl.includes(window.location.origin)) {
                    formattedUrl = window.location.origin + formattedUrl;
                }

                // Check if the formatted URL exists
                const exists = await imageExists(formattedUrl);
                if (exists) {
                    console.log('Image exists at formatted URL:', formattedUrl);
                    return formattedUrl;
                } else {
                    console.log('Image does not exist at formatted URL:', formattedUrl);
                    return getFruitVegetableImage(categoryName, fallbackUrl);
                }
            }

            // Helper function to get appropriate images for fruits and vegetables
            function getFruitVegetableImage(categoryName, fallbackUrl) {
                if (!categoryName) return fallbackUrl;

                const name = categoryName.toLowerCase();
                if (name.includes('fruit')) {
                    return '{{ staticAsset("frontend/default/assets/img/categories/fruits.jpg") }}';
                } else if (name.includes('vegetable')) {
                    return '{{ staticAsset("frontend/default/assets/img/categories/vegetables.jpg") }}';
                }

                return fallbackUrl;
            }

            // Function to populate category slider with data from API
            function populateCategorySlider(categories) {
                console.log('Populating slider with categories:', categories);
                const container = $('#category-slider-container');

                // Check if we're on a category page
                const isCategoryPage = {{ $isCategoryPage ? 'true' : 'false' }};
                const currentCategoryId = {{ $currentCategoryId ? $currentCategoryId : 'null' }};

                // Check if the data is wrapped in a data property
                const categoryData = Array.isArray(categories) ? categories :
                                    (categories.data && Array.isArray(categories.data) ? categories.data : []);

                let categoriesToUse = [];

                if (isCategoryPage && currentCategoryId) {
                    // If on a category page, show only subcategories of the current category
                    console.log('Filtering for subcategories of category ID:', currentCategoryId);

                    // Find subcategories (where parent_id matches currentCategoryId)
                    const subcategories = categoryData.filter(cat =>
                        cat.parent_id && (cat.parent_id == currentCategoryId || cat.parent_id === currentCategoryId)
                    );

                    // If there are subcategories, use them; otherwise try to find siblings
                    if (subcategories.length > 0) {
                        console.log('Found subcategories:', subcategories.length);
                        categoriesToUse = subcategories;
                    } else {
                        // If no subcategories, try to find the parent category to get siblings
                        const currentCategory = categoryData.find(cat => cat.id == currentCategoryId);
                        if (currentCategory && currentCategory.parent_id) {
                            // Find sibling categories (categories with the same parent)
                            const siblingCategories = categoryData.filter(cat =>
                                cat.parent_id && cat.parent_id == currentCategory.parent_id
                            );
                            console.log('No subcategories found, using sibling categories:', siblingCategories.length);
                            categoriesToUse = siblingCategories;
                        } else {
                            // If no siblings, fall back to parent categories
                            const parentCategories = categoryData.filter(cat => !cat.parent_id || cat.parent_id === 0 || cat.parent_id === '');
                            console.log('No subcategories or siblings found, using parent categories:', parentCategories.length);
                            categoriesToUse = parentCategories;
                        }
                    }
                } else {
                    // On main product page, show only parent categories
                    const parentCategories = categoryData.filter(cat => !cat.parent_id || cat.parent_id === 0 || cat.parent_id === '');
                    categoriesToUse = parentCategories.length > 0 ? parentCategories : categoryData;
                    console.log('On main page, showing parent categories:', categoriesToUse.length);
                }

                // Remove any duplicate categories by ID
                const uniqueCategories = [];
                const seenIds = new Set();

                categoriesToUse.forEach(cat => {
                    // Only add if we haven't seen this ID before
                    if (!seenIds.has(cat.id)) {
                        seenIds.add(cat.id);
                        uniqueCategories.push(cat);
                    }
                });

                console.log('Unique categories count:', uniqueCategories.length);

                // Use up to 8 categories for the grid (or fewer if that's all we have)
                const limitedCategories = uniqueCategories.slice(0, 8);

                console.log('Categories to display:', limitedCategories);

                // Process categories and generate HTML
                const processCategories = async () => {
                    // If we have no categories to display, hide the entire section
                    if (limitedCategories.length === 0) {
                        $('#category-slider-section').hide();
                        return;
                    } else {
                        $('#category-slider-section').show();
                    }

                    // Add a class to the body if we're on a category page
                    if (isCategoryPage) {
                        $('.category-slider-section').addClass('subcategory-view');
                    } else {
                        $('.category-slider-section').removeClass('subcategory-view');
                    }

                    let html = '';
                    const fallbackImageUrl = '{{ staticAsset("frontend/default/assets/img/placeholder.jpg") }}';

                    // Check if we need a grid or a slider
                    // For subcategories, we'll use a grid layout if there are few items (3 or less)
                    // If there are more than 3, we'll use a slider to prevent overflow
                    const useGridLayout = isCategoryPage && limitedCategories.length <= 3;

                    if (useGridLayout) {
                        // Create a grid container instead of swiper slides
                        html = '<div class="subcategory-grid">';
                    }

                    // Process each category
                    for (const category of limitedCategories) {
                        // Handle different API response formats
                        const categoryId = category.id;
                        const categoryName = category.name || '';

                        // Handle thumbnail image - it might be a full URL or a relative path
                        const originalImage = category.thumbnail_image || '';
                        console.log(`Original image URL for ${categoryName}:`, originalImage);

                        // Get a valid image URL
                        const thumbnailImage = await getValidImageUrl(originalImage, fallbackImageUrl, categoryName);

                        // Handle product count
                        const productCount = category.products || 0;

                        if (useGridLayout) {
                            // Create a grid item - CONSISTENT SIZING FOR ALL TABLETS
                            const screenWidth = window.innerWidth;
                            const isTablet = screenWidth >= 768 && screenWidth <= 1024;
                            const isMobile = screenWidth < 768;
                            const isDesktop = screenWidth > 1024;

                            let cardStyle, imageStyle, imgStyle, infoStyle, titleStyle, countStyle;

                            if (isTablet) {
                                // TABLET 768*1024 - CONSISTENT SIZING
                                cardStyle = 'margin: 0 !important; height: 280px !important; min-height: 280px !important; max-height: 280px !important; width: 220px !important; min-width: 220px !important; max-width: 220px !important; border-radius: 15px !important; box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important; background: white !important; overflow: hidden !important; transition: all 0.3s ease !important;';
                                imageStyle = 'width: 100% !important; height: 200px !important; min-height: 200px !important; max-height: 200px !important; overflow: hidden !important; border-radius: 15px 15px 0 0 !important;';
                                imgStyle = 'height: 200px !important; min-height: 200px !important; max-height: 200px !important; width: 100% !important; object-fit: cover !important; display: block !important; transition: transform 0.3s ease !important;';
                                infoStyle = 'height: 80px !important; min-height: 80px !important; max-height: 80px !important; padding: 15px !important; display: flex !important; flex-direction: column !important; justify-content: center !important; align-items: center !important; text-align: center !important;';
                                titleStyle = 'font-size: 16px !important; font-weight: 600 !important; color: #333 !important; margin: 0 0 5px 0 !important; line-height: 1.2 !important;';
                                countStyle = 'font-size: 12px !important; font-weight: 500 !important; color: #666 !important; margin: 0 !important; line-height: 1 !important;';
                            } else if (isMobile) {
                                // MOBILE 375*667 - SMALLER HALF-SIZE CARDS
                                cardStyle = 'margin: 0 auto !important; height: 180px !important; min-height: 180px !important; max-height: 180px !important; width: 160px !important; max-width: 160px !important; min-width: 160px !important; border-radius: 15px !important; box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important; background: white !important; overflow: hidden !important;';
                                imageStyle = 'width: 100% !important; height: 120px !important; min-height: 120px !important; max-height: 120px !important; overflow: hidden !important; border-radius: 15px 15px 0 0 !important;';
                                imgStyle = 'height: 120px !important; min-height: 120px !important; max-height: 120px !important; width: 100% !important; object-fit: cover !important; display: block !important;';
                                infoStyle = 'height: 60px !important; min-height: 60px !important; max-height: 60px !important; padding: 8px 6px !important; display: flex !important; flex-direction: column !important; justify-content: center !important; align-items: center !important; text-align: center !important;';
                                titleStyle = 'font-size: 14px !important; font-weight: 600 !important; color: #333 !important; margin: 0 0 3px 0 !important; line-height: 1.1 !important;';
                                countStyle = 'font-size: 11px !important; font-weight: 500 !important; color: #666 !important; margin: 0 !important; line-height: 1 !important;';
                            } else {
                                // DESKTOP - EXISTING DESKTOP STYLES
                                cardStyle = 'margin: 0 auto; height: 280px !important; min-height: 280px !important; max-height: 280px !important; width: 220px !important; max-width: 220px !important; border-radius: 15px !important; box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important; transform: scale(1) !important; background: white !important; overflow: hidden !important;';
                                imageStyle = 'width: 100%; height: 200px !important; min-height: 200px !important; max-height: 200px !important; overflow: hidden !important;';
                                imgStyle = 'height: 200px !important; min-height: 200px !important; width: 100% !important; object-fit: cover !important; display: block !important;';
                                infoStyle = 'height: 50px !important; padding: 8px !important;';
                                titleStyle = 'font-size: 18px !important; font-weight: 600 !important; color: #333 !important; margin: 0 0 2px 0 !important; line-height: 1.2 !important;';
                                countStyle = 'font-size: 11px !important; font-weight: 500 !important; color: #666 !important; margin: 0 !important;';
                            }

                            html += `
                                <div class="subcategory-grid-item">
                                    <a href="{{ route('products.index') }}?category_id=${categoryId}" class="text-decoration-none d-block">
                                        <div class="category-card" style="${cardStyle}">
                                            <div class="overflow-hidden" style="${imageStyle}">
                                                <img
                                                    src="${thumbnailImage}"
                                                    alt="${categoryName}"
                                                    class="img-fluid category-image"
                                                    style="${imgStyle}"
                                                    data-original-src="${originalImage}"
                                                    onerror="
                                                        if(!this.hasAttribute('data-error-handled')){
                                                            this.setAttribute('data-error-handled', 'true');
                                                            console.error('Image failed to load:', this.getAttribute('data-original-src'));
                                                            this.src='{{ staticAsset('frontend/default/assets/img/placeholder.jpg') }}';
                                                        }
                                                    "
                                                >
                                            </div>
                                            <div class="category-info text-center" style="${infoStyle}">
                                                <h5 class="mb-1" style="${titleStyle}">${categoryName}</h5>
                                                <p class="text-muted small" style="${countStyle}">${productCount} items</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            `;
                        } else {
                            // Create a swiper slide - CONSISTENT SIZING FOR ALL SCREEN SIZES
                            const screenWidth = window.innerWidth;
                            const isTablet = screenWidth >= 768 && screenWidth <= 1024;
                            const isMobile = screenWidth < 768;
                            const isDesktop = screenWidth > 1024;

                            let cardStyle, imageStyle, imgStyle, infoStyle, titleStyle, countStyle;

                            if (isTablet) {
                                // TABLET 768*1024 - CONSISTENT SIZING
                                cardStyle = 'margin: 0 auto; height: 280px !important; min-height: 280px !important; max-height: 280px !important; width: 220px !important; min-width: 220px !important; max-width: 220px !important; border-radius: 15px !important; box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important; background: white !important; overflow: hidden !important; transition: all 0.3s ease !important;';
                                imageStyle = 'width: 100% !important; height: 200px !important; min-height: 200px !important; max-height: 200px !important; overflow: hidden !important; border-radius: 15px 15px 0 0 !important;';
                                imgStyle = 'height: 200px !important; min-height: 200px !important; max-height: 200px !important; width: 100% !important; object-fit: cover !important; display: block !important; transition: transform 0.3s ease !important;';
                                infoStyle = 'height: 80px !important; min-height: 80px !important; max-height: 80px !important; padding: 15px !important; display: flex !important; flex-direction: column !important; justify-content: center !important; align-items: center !important; text-align: center !important;';
                                titleStyle = 'font-size: 16px !important; font-weight: 600 !important; color: #333 !important; margin: 0 0 5px 0 !important; line-height: 1.2 !important;';
                                countStyle = 'font-size: 12px !important; font-weight: 500 !important; color: #666 !important; margin: 0 !important; line-height: 1 !important;';
                            } else if (isMobile) {
                                // MOBILE 375*667 - SMALLER HALF-SIZE CARDS
                                cardStyle = 'margin: 0 auto !important; height: 180px !important; min-height: 180px !important; max-height: 180px !important; width: 160px !important; max-width: 160px !important; min-width: 160px !important; border-radius: 15px !important; box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important; background: white !important; overflow: hidden !important;';
                                imageStyle = 'width: 100% !important; height: 120px !important; min-height: 120px !important; max-height: 120px !important; overflow: hidden !important; border-radius: 15px 15px 0 0 !important;';
                                imgStyle = 'height: 120px !important; min-height: 120px !important; max-height: 120px !important; width: 100% !important; object-fit: cover !important; display: block !important;';
                                infoStyle = 'height: 60px !important; min-height: 60px !important; max-height: 60px !important; padding: 8px 6px !important; display: flex !important; flex-direction: column !important; justify-content: center !important; align-items: center !important; text-align: center !important;';
                                titleStyle = 'font-size: 14px !important; font-weight: 600 !important; color: #333 !important; margin: 0 0 3px 0 !important; line-height: 1.1 !important;';
                                countStyle = 'font-size: 11px !important; font-weight: 500 !important; color: #666 !important; margin: 0 !important; line-height: 1 !important;';
                            } else {
                                // DESKTOP - EXISTING DESKTOP STYLES
                                cardStyle = 'margin: 0 auto; height: 280px !important; min-height: 280px !important; max-height: 280px !important; width: 220px !important; max-width: 220px !important; border-radius: 15px !important; box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important; transform: scale(1) !important; background: white !important; overflow: hidden !important;';
                                imageStyle = 'width: 100%; height: 200px !important; min-height: 200px !important; max-height: 200px !important; overflow: hidden !important;';
                                imgStyle = 'height: 200px !important; min-height: 200px !important; width: 100% !important; object-fit: cover !important; display: block !important;';
                                infoStyle = 'height: 50px !important; padding: 8px !important;';
                                titleStyle = 'font-size: 14px !important; font-weight: 600 !important; color: #333 !important; margin: 0 0 2px 0 !important; line-height: 1.2 !important;';
                                countStyle = 'font-size: 11px !important; font-weight: 500 !important; color: #666 !important; margin: 0 !important;';
                            }

                            html += `
                                <div class="swiper-slide" style="padding: 0; margin: 0;">
                                    <a href="{{ route('products.index') }}?category_id=${categoryId}" class="text-decoration-none d-block">
                                        <div class="category-card" style="${cardStyle}">
                                            <div class="overflow-hidden" style="${imageStyle}">
                                                <img
                                                    src="${thumbnailImage}"
                                                    alt="${categoryName}"
                                                    class="img-fluid category-image"
                                                    style="${imgStyle}"
                                                    data-original-src="${originalImage}"
                                                    onerror="
                                                        if(!this.hasAttribute('data-error-handled')){
                                                            this.setAttribute('data-error-handled', 'true');
                                                            console.error('Image failed to load:', this.getAttribute('data-original-src'));
                                                            this.src='{{ staticAsset('frontend/default/assets/img/placeholder.jpg') }}';
                                                        }
                                                    "
                                                >
                                            </div>
                                            <div class="category-info text-center" style="${infoStyle}">
                                                <h5 class="mb-1" style="${titleStyle}">${categoryName}</h5>
                                                <p class="text-muted small" style="${countStyle}">${productCount} items</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            `;
                        }
                    }

                    if (useGridLayout) {
                        // Close the grid container
                        html += '</div>';
                    }

                    // Update the container with the generated HTML
                    if (html) {
                        // First destroy the existing swiper instance
                        if (categorySlider) {
                            categorySlider.destroy(true, true);
                        }

                        // Update the HTML
                        container.html(html);

                        // Check if we're using grid layout
                        if (useGridLayout) {
                            // Hide swiper navigation and pagination for grid layout
                            $('.swiper-button-next, .swiper-button-prev, .swiper-pagination').hide();

                            // Apply styles to the grid based on screen size
                            const screenWidth = window.innerWidth;
                            const isMobile = screenWidth < 768;

                            if (isMobile) {
                                // MOBILE GRID LAYOUT - SMALLER CARDS
                                $('.subcategory-grid').css({
                                    'display': 'flex',
                                    'flex-wrap': 'nowrap',
                                    'justify-content': 'flex-start',
                                    'align-items': 'center',
                                    'gap': '12px',
                                    'margin': '0 auto',
                                    'overflow-x': 'auto',
                                    'overflow-y': 'hidden',
                                    'padding': '15px 10px',
                                    'width': '100%',
                                    'max-width': '100%'
                                });
                            } else {
                                // TABLET/DESKTOP GRID LAYOUT
                                $('.subcategory-grid').css({
                                    'display': 'flex',
                                    'flex-wrap': 'nowrap',
                                    'justify-content': 'center',
                                    'align-items': 'center',
                                    'gap': '25px',
                                    'margin': '0 auto',
                                    'overflow-x': 'visible',
                                    'padding': '20px',
                                    'width': 'fit-content',
                                    'max-width': '100%'
                                });
                            }

                            // Ensure grid items have no extra margins
                            $('.subcategory-grid-item').css({
                                'flex': '0 0 auto',
                                'margin': '0',
                                'padding': '0'
                            });

                            // DELETED ALL AGGRESSIVE JAVASCRIPT SIZING

                            // Apply zoom effect to grid items
                            setTimeout(() => {
                                applyZoomEffect();
                            }, 200);
                        } else {
                            // Re-initialize the swiper for slider layout
                            setTimeout(() => {
                                initCategorySlider();
                                // Apply zoom effect after slider is initialized
                                setTimeout(applyZoomEffect, 200);
                                // FORCE MOBILE SIZING AFTER SLIDER INIT
                                setTimeout(forceMobileSizingAfterLoad, 300);
                            }, 100);
                        }
                    } else {
                        // If no categories are available, hide the section completely
                        $('#category-slider-section').hide();
                    }
                };

                // Execute the async function
                processCategories();
            }

            // Initialize slider (will be updated when data arrives)
            initCategorySlider();

            // Apply zoom effect to category images
            function applyZoomEffect() {
                // Add CSS directly using jQuery
                $('.category-card .overflow-hidden').css('overflow', 'hidden');
                $('.category-image').css('transition', 'transform 0.5s ease');

                // Add hover effect using jQuery
                $('.category-card').hover(
                    function() {
                        $(this).find('img').css({
                            'transform': 'scale(1.3)',
                            'filter': 'brightness(1.05) drop-shadow(0 5px 15px rgba(0,0,0,0.2))'
                        });
                    },
                    function() {
                        $(this).find('img').css({
                            'transform': 'scale(1)',
                            'filter': 'none'
                        });
                    }
                );

                console.log('Category zoom effect applied using jQuery');
            }

            // Apply zoom effect after slider initialization
            setTimeout(applyZoomEffect, 1000);

            // FORCE MOBILE SIZING FUNCTION AFTER API LOAD - SMALLER CARDS
            function forceMobileSizingAfterLoad() {
                if (window.innerWidth <= 430) {
                    console.log('FORCING mobile sizing after API load - SMALLER CARDS...');

                    // Force all category cards to smaller size
                    $('.category-card').each(function() {
                        $(this).css({
                            'height': '180px',
                            'min-height': '180px',
                            'max-height': '180px',
                            'width': '160px',
                            'min-width': '160px',
                            'max-width': '160px',
                            'margin': '0 auto',
                            'border-radius': '15px',
                            'box-shadow': '0 8px 20px rgba(0,0,0,0.15)',
                            'background': 'white',
                            'overflow': 'hidden'
                        });
                    });

                    // Force all images to smaller size
                    $('.category-card img').each(function() {
                        $(this).css({
                            'height': '120px',
                            'min-height': '120px',
                            'max-height': '120px',
                            'width': '100%',
                            'object-fit': 'cover',
                            'display': 'block'
                        });
                    });

                    // Force all image containers to smaller size
                    $('.category-card .overflow-hidden').each(function() {
                        $(this).css({
                            'height': '120px',
                            'min-height': '120px',
                            'max-height': '120px',
                            'width': '100%',
                            'overflow': 'hidden',
                            'border-radius': '15px 15px 0 0'
                        });
                    });

                    // Force all text to smaller size
                    $('.category-info h5').each(function() {
                        $(this).css({
                            'font-size': '14px',
                            'font-weight': '600',
                            'color': '#333',
                            'margin': '0 0 3px 0',
                            'line-height': '1.1'
                        });
                    });

                    $('.category-info p').each(function() {
                        $(this).css({
                            'font-size': '11px',
                            'font-weight': '500',
                            'color': '#666',
                            'line-height': '1'
                        });
                    });

                    // Force category info section to smaller size
                    $('.category-info').each(function() {
                        $(this).css({
                            'height': '60px',
                            'min-height': '60px',
                            'max-height': '60px',
                            'padding': '8px 6px'
                        });
                    });

                    console.log('FORCED mobile sizing applied after API load - SMALLER CARDS!');
                }
            }
        });

        // Fix for Add to Cart functionality with modified layout and prevent double-click
        $(document).ready(function() {
            // First, remove all existing onclick attributes to prevent double execution
            setTimeout(function() {
                // Remove all existing onclick attributes
                $('.vertical-product-card button[onclick*="directAddToCartFormSubmit"]').each(function() {
                    $(this).removeAttr('onclick');
                });

                // Then rebind with a single event handler
                $('.vertical-product-card').each(function(index) {
                    const form = $(this).find('.direct-add-to-cart-form');
                    if (form.length > 0) {
                        const addToCartBtn = form.find('button.direct-add-to-cart-btn');
                        if (addToCartBtn.length > 0) {
                            // Ensure only one click event is bound
                            addToCartBtn.off('click').on('click', function(e) {
                                e.preventDefault();
                                e.stopPropagation(); // Stop event propagation

                                // Add a flag to prevent multiple submissions
                                if (!$(this).data('processing')) {
                                    $(this).data('processing', true);
                                    directAddToCartFormSubmit(this);

                                    // Reset the flag after a short delay
                                    const btn = $(this);
                                    setTimeout(function() {
                                        btn.data('processing', false);
                                    }, 1000);
                                }

                                return false;
                            });
                        }
                    }
                });

                // Also fix the quantity buttons to prevent double binding
                $('.vertical-product-card button[onclick*="decrementQuantity"]').each(function() {
                    $(this).removeAttr('onclick');
                });
                $('.vertical-product-card button[onclick*="incrementQuantity"]').each(function() {
                    $(this).removeAttr('onclick');
                });

                // Rebind quantity buttons
                $('.vertical-product-card').each(function() {
                    const decrementBtn = $(this).find('button').first();
                    const incrementBtn = $(this).find('button').last();

                    if (decrementBtn.length > 0) {
                        decrementBtn.off('click').on('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            decrementQuantity(this);
                            return false;
                        });
                    }

                    if (incrementBtn.length > 0 && !incrementBtn.hasClass('direct-add-to-cart-btn')) {
                        incrementBtn.off('click').on('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            incrementQuantity(this);
                            return false;
                        });
                    }
                });
            }, 300);
        });
    </script>

    <!-- Simplified zoom effect script -->
    <script>
        // Apply zoom effect immediately after page load
        $(document).ready(function() {
            // Simplified zoom effect function
            function applyDirectZoom() {
                // Add CSS directly using jQuery
                $('.category-card .overflow-hidden').css('overflow', 'hidden');
                $('.category-image, .category-card img').css('transition', 'transform 0.5s ease');

                // Check if we're on a category page
                const isCategoryPage = {{ $isCategoryPage ? 'true' : 'false' }};

                // Add hover effect using jQuery
                $('.category-card').hover(
                    function() {
                        $(this).find('img').css({
                            'transform': 'scale(1.3)',
                            'filter': 'brightness(1.05) drop-shadow(0 5px 15px rgba(0,0,0,0.2))'
                        });
                    },
                    function() {
                        $(this).find('img').css({
                            'transform': 'scale(1)',
                            'filter': 'none'
                        });
                    }
                );

                console.log('Simplified zoom effect applied');
            }

            // Call the simplified zoom effect
            applyDirectZoom();
        });
    </script>
@endsection
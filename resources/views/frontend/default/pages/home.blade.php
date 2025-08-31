@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Home') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <!--hero section start-->
    @include('frontend.default.pages.partials.home.hero')
    <!--hero section end-->

    <!--features section start-->
    @include('frontend.default.pages.partials.home.features')
    <!--features section end-->

    <!--featured products start-->
    @include('frontend.default.pages.partials.home.featuredProductsNew')
    <!--featured products end-->
    
    @include('frontend.default.pages.partials.home.categorywise')

    <!--newsletter subscription start-->
    @include('frontend.default.pages.partials.home.newsletter-subscription')
    <!--newsletter subscription end-->

@endsection

<!-- @section('scripts')
    <script>
        "use strict";

        // runs when the document is ready
        $(document).ready(function() {
            @if (\App\Models\Location::where('is_published', 1)->count() > 1)
                notifyMe('info', '{{ localize('Select your location if not selected') }}');
            @endif
        });
    </script>
@endsection -->

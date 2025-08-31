<div class="category-header-bar py-3 mb-4" style="background-color: #f0f0f0;">
    <div class="container">
        <div class="row g-0 align-items-center">
            <div class="col-12">
                <h2 class="fs-4 fw-bold mb-0 text-uppercase">@yield('page-title')</h2>
            </div>
            <div class="col-12 mt-1">
                <div class="d-flex align-items-center flex-wrap">
                    <nav aria-label="breadcrumb" class="me-auto">
                        <ol class="breadcrumb mb-0 d-flex">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ localize('Home') }}</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ localize('Pages') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
                        </ol>
                    </nav>
                    <a href="{{ route('home') }}" class="back-to-products">
                        <i class="fas fa-arrow-left"></i> {{ localize('Back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

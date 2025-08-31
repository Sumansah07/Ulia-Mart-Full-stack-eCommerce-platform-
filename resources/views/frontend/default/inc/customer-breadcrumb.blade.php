<!-- Customer Breadcrumb -->
<div class="customer-breadcrumb">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1>{{ $title ?? localize('MY ACCOUNT') }}</h1>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb" class="text-md-end mt-2 mt-md-0">
                    <ol class="breadcrumb mb-0 justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ localize('HOME') }}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ localize('PAGES') }}</a></li>
                        <li class="breadcrumb-item active">{{ $title ?? localize('MY ACCOUNT') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- End Customer Breadcrumb -->

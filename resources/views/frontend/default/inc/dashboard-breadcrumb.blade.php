<!-- Dashboard Breadcrumb -->
<div class="dashboard-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div class="page-title">
                    <h1>{{ $title ?? localize('MY ACCOUNT') }}</h1>
                </div>
                <!--Breadcrumbs-->
                <div class="breadcrumbs">
                    <a href="{{ route('home') }}" title="Back to the home page">{{ localize('HOME') }}</a>
                    <span class="title"><i class="icon anm anm-angle-right-l"></i>{{ localize('PAGES') }}</span>
                    <span class="main-title fw-bold"><i class="icon anm anm-angle-right-l"></i>{{ $title ?? localize('MY ACCOUNT') }}</span>
                </div>
                <!--End Breadcrumbs-->
            </div>
        </div>
    </div>
</div>
<!-- End Dashboard Breadcrumb -->

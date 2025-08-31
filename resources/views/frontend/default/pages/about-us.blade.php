@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('About Us') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('page-title')
{{ localize('About Us') }}
@endsection

@section('breadcrumb')
    @include('frontend.default.inc.shop-breadcrumb')
@endsection

@section('contents')
    <div id="page-content" class="about-modern-page py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 fw-bold mb-3" style="color:#006633;">युलिया मल्टिपर्पोज ट्रेडिङ्ग प्रा.लि</h1>
                    <p class="lead mb-2" style="font-size:1.25rem;">विद्युतीय प्लेटफर्मको नामः <a href="https://www.uliaa.com.np" target="_blank" style="color:#006633;">www.uliaa.com.np</a></p>
                    <p class="mb-2"><i class="fas fa-map-marker-alt me-2 text-primary"></i>ठेगानाः टोखा–२, काठमाडौ, नेपाल</p>
                </div>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <h3 class="h5 mb-3 text-center" style="color:#006633;">कम्पनी दर्ता विवरण</h3>
                            <ul class="list-group list-group-flush text-start">
                                <li class="list-group-item"><strong>दर्ता भएको निकाय:</strong> कम्पनी रजिष्ट्रारको कार्यालय</li>
                                <li class="list-group-item"><strong>दर्ता नं:</strong> ३२५७६३</li>
                                <li class="list-group-item"><strong>मूल्य अभिवृद्धि कर दर्ता न:</strong> ६१९८३२५६०</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <h3 class="h5 mb-3 text-center" style="color:#006633;">सम्पर्क विवरण</h3>
                            <ul class="list-group list-group-flush text-start">
                                <li class="list-group-item"><i class="fas fa-phone me-2" style="color:#006633;"></i> व्यवसायीलाई सम्पर्क गर्ने मोबाइल नं: <strong>९८५१२४७९३६</strong></li>
                                <li class="list-group-item"><i class="fas fa-envelope me-2" style="color:#006633;"></i> व्यवसायीलाई सम्पर्क गर्ने इमेल: <strong>uliaamart@gmail.com</strong></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h3 class="h5 mb-3 text-center" style="color:#006633;">गुनासो सुन्ने जिम्मेवार व्यक्ति</h3>
                            <ul class="list-group list-group-flush text-start">
                                <li class="list-group-item"><strong>नाम:</strong> लिला ओली</li>
                                <li class="list-group-item"><i class="fas fa-phone me-2" style="color:#006633;"></i> सम्पर्क नम्बर: <strong>९८६०७४३२७९</strong></li>
                                <li class="list-group-item"><i class="fas fa-envelope me-2" style="color:#006633;"></i> इमेल: <strong>lilashiwakoti@gmail.com</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-8 text-center">
                    <p class="mt-4 text-muted" style="font-size:1.1rem;">हामी तपाईंलाई उत्कृष्ट सेवा र भरपर्दो अनलाइन किनमेल अनुभव प्रदान गर्न प्रतिबद्ध छौं।</p>
                </div>
            </div>
        </div>
    </div>
@endsection

 <!-- Offcanvas -->
 <div class="offcanvas offcanvas-end" id="offcanvasFonepay" tabindex="-1">
     <div class="offcanvas-header border-bottom">
         <h5 class="offcanvas-title">{{ localize('FonePay Configuration') }}</h5>
         <span
             class="btn btn-outline-danger rounded-circle btn-icon d-inline-flex align-items-center justify-content-center"
             data-bs-dismiss="offcanvas">
             <i data-feather="x"></i>
         </span>
     </div>
     <div class="offcanvas-body" data-simplebar>
         <form action="{{ route('payment-gateway-setting.store') }}" method="POST" enctype="multipart/form-data">
             @csrf
             <input type="hidden" name="payment_method" value="fonepay">
             <input type="hidden" value="1" name="is_virtual">

             <div class="mb-3">
                 <label for="FONEPAY_MERCHANT_CODE" class="form-label">{{ localize('Merchant Code') }}</label>
                 <input type="text" id="FONEPAY_MERCHANT_CODE" name="types[FONEPAY_MERCHANT_CODE]" class="form-control"
                     value="{{ paymentGatewayValue('fonepay', 'FONEPAY_MERCHANT_CODE') }}" placeholder="Enter your FonePay merchant code">
                 <small class="text-muted">{{ localize('Get this from your FonePay merchant dashboard') }}</small>
             </div>

             <div class="mb-3">
                 <label for="FONEPAY_USERNAME" class="form-label">{{ localize('Username') }}</label>
                 <input type="text" id="FONEPAY_USERNAME" name="types[FONEPAY_USERNAME]" class="form-control"
                     value="{{ paymentGatewayValue('fonepay', 'FONEPAY_USERNAME') }}" placeholder="Enter your FonePay username">
             </div>

             <div class="mb-3">
                 <label for="FONEPAY_PASSWORD" class="form-label">{{ localize('Password') }}</label>
                 <input type="password" id="FONEPAY_PASSWORD" name="types[FONEPAY_PASSWORD]" class="form-control"
                     value="{{ paymentGatewayValue('fonepay', 'FONEPAY_PASSWORD') }}" placeholder="Enter your FonePay password">
             </div>

             <div class="mb-3">
                 <label for="FONEPAY_SECRET_KEY" class="form-label">{{ localize('Secret Key') }}</label>
                 <input type="password" id="FONEPAY_SECRET_KEY" name="types[FONEPAY_SECRET_KEY]" class="form-control"
                     value="{{ paymentGatewayValue('fonepay', 'FONEPAY_SECRET_KEY') }}" placeholder="Enter your FonePay secret key">
                 <small class="text-muted">{{ localize('Used for payment verification and security') }}</small>
             </div>

             <div class="mb-3">
                 <label class="form-label">{{ localize('Success URL') }}</label>
                 <input type="text" class="form-control" value="{{ route('fonepay.success') }}" readonly>
                 <small class="text-muted">{{ localize('Copy this URL to your FonePay merchant panel') }}</small>
             </div>

             <div class="mb-3">
                 <label class="form-label">{{ localize('Failed URL') }}</label>
                 <input type="text" class="form-control" value="{{ route('fonepay.failed') }}" readonly>
                 <small class="text-muted">{{ localize('Copy this URL to your FonePay merchant panel') }}</small>
             </div>

             <div class="mb-3">
                 <label class="form-label">{{ localize('Environment') }}</label>
                 <select id="fonepay_environment" class="form-control select2" name="sandbox" data-toggle="select2">
                     <option value="1" {{ paymentGateway('fonepay')->sandbox == '1' ? 'selected' : '' }}>
                         {{ localize('Sandbox (Testing)') }}</option>
                     <option value="0" {{ paymentGateway('fonepay')->sandbox == '0' ? 'selected' : '' }}>
                         {{ localize('Live (Production)') }}</option>
                 </select>
                 <small class="text-muted">{{ localize('Use Sandbox for testing, Live for production') }}</small>
             </div>

             <div class="mb-3">
                 <label class="form-label">{{ localize('FonePay Logo') }}</label>
                 <div class="tt-image-drop rounded">
                     <span class="fw-semibold">{{ localize('Choose FonePay Logo') }}</span>
                     <!-- choose media -->
                     <div class="tt-product-thumb show-selected-files mt-3">
                         <div class="avatar avatar-xl cursor-pointer choose-media"
                             data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                             onclick="showMediaManager(this)" data-selection="single">
                             <input type="hidden" name="image"
                                 value="{{ paymentGateway('fonepay') ? paymentGateway('fonepay')->image : '' }}">
                             <div class="no-avatar rounded-circle">
                                 <span><i data-feather="plus"></i></span>
                             </div>
                         </div>
                     </div>
                     <!-- choose media -->
                 </div>
             </div>

             <div class="mb-3">
                 <label class="form-label">{{ localize('FonePay QR Code') }}</label>
                 <div class="tt-image-drop rounded">
                     <span class="fw-semibold">{{ localize('Choose FonePay QR Code Image') }}</span>
                     <!-- choose media -->
                     <div class="tt-product-thumb show-selected-files mt-3">
                         <div class="avatar avatar-xl cursor-pointer choose-media"
                             data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                             onclick="showMediaManager(this)" data-selection="single">
                             <input type="hidden" name="types[FONEPAY_QR_CODE]"
                                 value="{{ paymentGatewayValue('fonepay', 'FONEPAY_QR_CODE') }}">
                             <div class="no-avatar rounded-circle">
                                 <span><i data-feather="plus"></i></span>
                             </div>
                         </div>
                     </div>
                     <!-- choose media -->
                 </div>
                 <small class="text-muted">{{ localize('Upload the QR code image that customers will scan to make payments') }}</small>
             </div>

             <div class="mb-3">
                 <label class="form-label">{{ localize('Enable FonePay') }}</label>
                 <select id="enable_fonepay" class="form-control select2" name="is_active" data-toggle="select2">
                     <option value="0" {{ paymentGateway('fonepay')->is_active == '0' ? 'selected' : '' }}>
                         {{ localize('Disable') }}</option>
                     <option value="1" {{ paymentGateway('fonepay')->is_active == '1' ? 'selected' : '' }}>
                         {{ localize('Enable') }}</option>
                 </select>
             </div>

             <div class="alert alert-info">
                 <h6><i data-feather="info"></i> {{ localize('Integration Steps') }}</h6>
                 <ol class="mb-0" style="font-size: 13px;">
                     <li>{{ localize('Register as a merchant at fonepay.com') }}</li>
                     <li>{{ localize('Get your merchant credentials from FonePay') }}</li>
                     <li>{{ localize('Add the Success/Failed URLs to your FonePay account') }}</li>
                     <li>{{ localize('Test in Sandbox mode first') }}</li>
                     <li>{{ localize('Switch to Live mode for production') }}</li>
                 </ol>
             </div>

             <div class="mb-3">
                 <button class="btn btn-primary" type="submit">
                     <i data-feather="save" class="me-1"></i> {{ localize('Save Configuration') }}
                 </button>
             </div>
         </form>
     </div>
 </div>

 <!-- Offcanvas -->
 <div class="offcanvas offcanvas-end" id="offcanvasIMEPay" tabindex="-1">
     <div class="offcanvas-header border-bottom">
         <h5 class="offcanvas-title">{{ localize('IMEPay/FonePay Configuration') }}</h5>
         <span
             class="btn btn-outline-danger rounded-circle btn-icon d-inline-flex align-items-center justify-content-center"
             data-bs-dismiss="offcanvas">
             <i data-feather="x"></i>
         </span>
     </div>
     <div class="offcanvas-body" data-simplebar>
         <form action="{{ route('payment-gateway-setting.store') }}" method="POST" enctype="multipart/form-data">
             @csrf
             <input type="hidden" name="payment_method" value="imepay">
             <input type="hidden" value="1" name="is_virtual">
             <div class="mb-3">
                 <label for="IMEPAY_MERCHANT_CODE" class="form-label">{{ localize('Merchant Code') }}</label>
                 <input type="text" id="IMEPAY_MERCHANT_CODE" name="types[IMEPAY_MERCHANT_CODE]" class="form-control"
                     value="{{ paymentGatewayValue('imepay', 'IMEPAY_MERCHANT_CODE') }}" placeholder="Enter your merchant code">
             </div>

             <div class="mb-3">
                 <label for="IMEPAY_USERNAME" class="form-label">{{ localize('Username') }}</label>
                 <input type="text" id="IMEPAY_USERNAME" name="types[IMEPAY_USERNAME]" class="form-control"
                     value="{{ paymentGatewayValue('imepay', 'IMEPAY_USERNAME') }}" placeholder="Enter your username">
             </div>

             <div class="mb-3">
                 <label for="IMEPAY_PASSWORD" class="form-label">{{ localize('Password') }}</label>
                 <input type="password" id="IMEPAY_PASSWORD" name="types[IMEPAY_PASSWORD]" class="form-control"
                     value="{{ paymentGatewayValue('imepay', 'IMEPAY_PASSWORD') }}" placeholder="Enter your password">
             </div>

             <div class="mb-3">
                 <label for="IMEPAY_MODULE" class="form-label">{{ localize('Module') }}</label>
                 <select id="IMEPAY_MODULE" name="types[IMEPAY_MODULE]" class="form-control select2" data-toggle="select2">
                     <option value="FONEPAY" {{ paymentGatewayValue('imepay', 'IMEPAY_MODULE') == 'FONEPAY' ? 'selected' : '' }}>
                         {{ localize('FonePay') }}
                     </option>
                     <option value="IMEPAY" {{ paymentGatewayValue('imepay', 'IMEPAY_MODULE') == 'IMEPAY' ? 'selected' : '' }}>
                         {{ localize('IMEPay') }}
                     </option>
                 </select>
             </div>

             <div class="mb-3">
                 <label class="form-label">{{ localize('Success URL') }}</label>
                 <input type="text" class="form-control" value="{{ route('imepay.success') }}" readonly>
                 <small class="text-muted">{{ localize('Copy this URL to your IMEPay/FonePay merchant panel') }}</small>
             </div>

             <div class="mb-3">
                 <label class="form-label">{{ localize('Failed URL') }}</label>
                 <input type="text" class="form-control" value="{{ route('imepay.failed') }}" readonly>
                 <small class="text-muted">{{ localize('Copy this URL to your IMEPay/FonePay merchant panel') }}</small>
             </div>

             <div class="mb-3">
                 <label class="form-label">{{ localize('Enable IMEPay/FonePay') }}</label>
                 <select id="enable_imepay" class="form-control select2" name="is_active" data-toggle="select2">
                     <option value="0" {{ paymentGateway('imepay')->is_active == '0' ? 'selected' : '' }}>
                         {{ localize('Disable') }}</option>
                     <option value="1" {{ paymentGateway('imepay')->is_active == '1' ? 'selected' : '' }}>
                         {{ localize('Enable') }}</option>
                 </select>
             </div>

             <div class="mb-3">
                 <label class="form-label">{{ localize('Sandbox Mode') }}</label>
                 <select id="sandbox_imepay" class="form-control select2" name="sandbox" data-toggle="select2">
                     <option value="1" {{ paymentGateway('imepay')->sandbox == '1' ? 'selected' : '' }}>
                         {{ localize('Enable') }}</option>
                     <option value="0" {{ paymentGateway('imepay')->sandbox == '0' ? 'selected' : '' }}>
                         {{ localize('Disable') }}</option>
                 </select>
             </div>

             <div class="mb-3">
                 <button class="btn btn-primary" type="submit">
                     <i data-feather="save" class="me-1"></i> {{ localize('Save Configuration') }}
                 </button>
             </div>
         </form>
     </div>
 </div>

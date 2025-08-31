<style>
/* Professional Always-Visible Radio Buttons */
.professional-radio-button {
    width: 20px;
    height: 20px;
    border: 2px solid #000 !important;
    border-radius: 50%;
    display: inline-flex !important;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    transition: all 0.3s ease;
    background-color: #fff !important;
    position: relative;
    flex-shrink: 0;
    cursor: pointer;
    visibility: visible !important;
    opacity: 1 !important;
}

.professional-radio-button::after {
    content: '';
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: #006633;
    opacity: 0;
    transition: all 0.3s ease;
    transform: scale(0);
}

/* When radio is checked */
input[type="radio"]:checked + .professional-radio-button {
    border-color: #006633 !important;
    background-color: #fff !important;
}

input[type="radio"]:checked + .professional-radio-button::after {
    opacity: 1;
    transform: scale(1);
}

/* Hide default radio buttons but keep functionality */
.theme-radio input[type="radio"] {
    opacity: 0;
    position: absolute;
    width: 1px;
    height: 1px;
    margin: 0;
    padding: 0;
}

/* Override any existing custom-radio styles */
.theme-radio .custom-radio {
    display: none !important;
}

/* Enhanced checkout radio styling */
.checkout-radio {
    padding: 15px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    transition: all 0.3s ease;
    cursor: pointer;
    background-color: #fff;
}

.checkout-radio:hover {
    border-color: #006633;
    box-shadow: 0 2px 8px rgba(0, 102, 51, 0.1);
}

.checkout-radio.selected {
    border-color: #006633;
    background-color: #f8fdf9;
    box-shadow: 0 2px 12px rgba(0, 102, 51, 0.15);
}

.radio-left label {
    cursor: pointer;
    margin-bottom: 0;
    font-weight: 500;
    color: #333;
}

.checkout-radio.selected .radio-left label {
    color: #006633;
    font-weight: 600;
}
</style>

<div class="payment-accordion">
    <div class="accordion" id="accordionPayment">
        <!-- FonePay Direct - FIRST OPTION -->
        <div class="accordion-item card mb-2">
            <div class="card-header" id="headingFonepay">
                <button class="card-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFonepay" aria-expanded="true" aria-controls="collapseFonepay">
                    {{ localize('FonePay') }}
                </button>
            </div>
            <div id="collapseFonepay" class="accordion-collapse collapse show" aria-labelledby="headingFonepay" data-bs-parent="#accordionPayment">
                <div class="card-body">
                    <div class="checkout-radio d-flex align-items-center justify-content-between gap-3" onclick="selectPaymentMethod('fonepay')">
                        <div class="radio-left d-inline-flex align-items-center">
                            <div class="theme-radio">
                                <input type="radio" name="payment_method" id="fonepay" value="fonepay" required checked>
                                <span class="professional-radio-button"></span>
                            </div>
                            <label for="fonepay" class="ms-2 h6 mb-0">{{ localize('Pay with FonePay') }}</label>
                        </div>
                        <div class="radio-right text-end">
                            @php
                                $fonePayGateway = paymentGateway('fonepay');
                            @endphp
                            @if($fonePayGateway && $fonePayGateway->image)
                                <img src="{{ is_numeric($fonePayGateway->image) ? uploadedAsset($fonePayGateway->image) : asset($fonePayGateway->image) }}"
                                     alt="FonePay"
                                     class="img-fluid"
                                     style="max-height: 30px;">
                            @else
                                <img src="{{ staticAsset('frontend/pg/fonepay.png') }}" alt="FonePay" class="img-fluid" style="max-height: 30px;">
                            @endif
                        </div>
                    </div>

                    @if(env('FONEPAY_USE_QR_MODE', false))
                        <!-- QR Code Payment Section -->
                        <div class="fonepay-qr-section">
                            <h6>{{ localize('Scan QR Code to Pay') }}</h6>

                            <!-- QR Code Display -->
                            <div class="fonepay-qr-code">
                                @php
                                    $fonePayQrCode = paymentGatewayValue('fonepay', 'FONEPAY_QR_CODE');
                                @endphp
                                @if($fonePayQrCode)
                                    <img src="{{ is_numeric($fonePayQrCode) ? uploadedAsset($fonePayQrCode) : asset($fonePayQrCode) }}"
                                         alt="FonePay QR Code"
                                         class="img-fluid"
                                         style="max-width: 250px; height: auto; border: 1px solid #ddd; border-radius: 8px;">
                                @else
                                    <div class="alert alert-warning">
                                        <i class="fas fa-qrcode me-2"></i>
                                        {{ localize('QR Code will be displayed here. Please upload the QR code in FonePay settings.') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Payment Instructions -->
                            <div class="fonepay-instructions">
                                <h6>{{ localize('Payment Instructions:') }}</h6>
                                <ol>
                                    <li>{{ localize('Open your FonePay mobile app') }}</li>
                                    <li>{{ localize('Scan the QR code above') }}</li>
                                    <li>{{ localize('Complete the payment') }}</li>
                                    <li>{{ localize('Upload the payment receipt below') }}</li>
                                </ol>
                            </div>

                            <!-- Receipt Upload Section -->
                            <div class="fonepay-receipt-upload">
                                <label for="fonepay_receipt" class="form-label">
                                    {{ localize('Upload Payment Receipt') }} <span class="text-danger">*</span>
                                </label>
                                <input type="file"
                                       class="form-control"
                                       id="fonepay_receipt"
                                       name="fonepay_receipt"
                                       accept=".pdf"

                                <div class="form-text">
                                    {{ localize('Please upload your payment receipt in PDF format only. Maximum file size: 2MB') }}
                                    <!-- <br><small class="text-muted">{{ localize('PDF format ensures better clarity and security for receipt verification') }}</small> -->
                                </div>
                                <div class="invalid-feedback" id="fonepay_receipt_error">
                                    {{ localize('Please upload a valid PDF receipt file.') }}
                                </div>
                            </div>

                            <!-- Receipt Preview -->
                            <div id="fonepay_receipt_preview" class="fonepay-receipt-preview" style="display: none;">
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle me-2"></i>
                                    <span id="fonepay_receipt_filename"></span>
                                    <button type="button" class="btn btn-sm btn-outline-danger ms-2" onclick="clearFonePayReceipt()">
                                        {{ localize('Remove') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
          <!-- Cash On delivery -->
          <div class="accordion-item card mb-2">
            <div class="card-header" id="headingCOD">
                <button class="card-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCOD" aria-expanded="false" aria-controls="collapseCOD">
                    {{ localize('Cash on delivery') }} ({{ localize('COD') }})
                </button>
            </div>
            <div id="collapseCOD" class="accordion-collapse collapse" aria-labelledby="headingCOD" data-bs-parent="#accordionPayment">
                <div class="card-body">
                    <div class="checkout-radio d-flex align-items-center justify-content-between gap-3" onclick="selectPaymentMethod('cod')">
                        <div class="radio-left d-inline-flex align-items-center">
                            <div class="theme-radio">
                                <input type="radio" name="payment_method" id="cod" value="cod" required>
                                <span class="professional-radio-button"></span>
                            </div>
                            <label for="cod" class="ms-2 h6 mb-0">{{ localize('Pay with cash on delivery') }}</label>
                        </div>
                        <div class="radio-right text-end">
                            <img src="{{ staticAsset('frontend/pg/cod.svg') }}" alt="COD" class="img-fluid" style="max-height: 30px;">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Professional Payment Method Selection Function
    function selectPaymentMethod(method) {
        // Remove selected class from all checkout-radio elements
        document.querySelectorAll('.checkout-radio').forEach(radio => {
            radio.classList.remove('selected');
        });

        // Add selected class to clicked option
        const selectedRadio = document.querySelector(`#${method}`);
        if (selectedRadio) {
            selectedRadio.checked = true;
            const checkoutRadio = selectedRadio.closest('.checkout-radio');
            if (checkoutRadio) {
                checkoutRadio.classList.add('selected');
            }

            // Trigger change event for any existing listeners
            const event = new Event('change', { bubbles: true });
            selectedRadio.dispatchEvent(event);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize selection for checked radio
        const checkedRadio = document.querySelector('input[name="payment_method"]:checked');
        if (checkedRadio) {
            selectPaymentMethod(checkedRadio.value);
        }

        // Prevent selection of disabled payment methods
        const disabledPaymentMethods = ['esewa', 'paypal', 'credit_card'];

        // Add click handlers to disabled payment methods
        disabledPaymentMethods.forEach(function(method) {
            const radioInput = document.getElementById(method);
            if (radioInput) {
                radioInput.addEventListener('click', function(e) {
                    e.preventDefault();
                    alert('{{ localize("This payment method is not available yet. Please use FonePay, IME Pay, or Cash on Delivery.") }}');
                    return false;
                });
            }
        });

        // FonePay receipt upload handling
        const fonePayReceiptInput = document.getElementById('fonepay_receipt');
        const fonePayRadio = document.getElementById('fonepay');

        if (fonePayReceiptInput) {
            fonePayReceiptInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                const preview = document.getElementById('fonepay_receipt_preview');
                const filename = document.getElementById('fonepay_receipt_filename');
                const errorDiv = document.getElementById('fonepay_receipt_error');

                if (file) {
                    // Validate file size (5MB max)
                    if (file.size > 5 * 1024 * 1024) {
                        alert('{{ localize("File size must be less than 5MB") }}');
                        e.target.value = '';
                        preview.style.display = 'none';
                        updateOrderButtonState();
                        return;
                    }

                    // Validate file type - PDF ONLY for better clarity and security
                    const allowedTypes = ['application/pdf'];
                    if (!allowedTypes.includes(file.type)) {
                        alert('{{ localize("Please upload a valid PDF file only. PDF format ensures better clarity and security for receipt verification.") }}');
                        e.target.value = '';
                        preview.style.display = 'none';
                        updateOrderButtonState();
                        return;
                    }

                    // Show preview
                    filename.textContent = file.name;
                    preview.style.display = 'block';
                    errorDiv.style.display = 'none';
                    e.target.classList.remove('is-invalid');
                    e.target.classList.add('is-valid');
                } else {
                    preview.style.display = 'none';
                    e.target.classList.remove('is-valid');
                }

                updateOrderButtonState();
            });
        }

        // Function to clear FonePay receipt
        window.clearFonePayReceipt = function() {
            if (fonePayReceiptInput) {
                fonePayReceiptInput.value = '';
                fonePayReceiptInput.classList.remove('is-valid');
                document.getElementById('fonepay_receipt_preview').style.display = 'none';
                updateOrderButtonState();
            }
        };

        // Function to update order button state
        function updateOrderButtonState() {
            const selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');
            // VERY SPECIFIC targeting - EXCLUDE search buttons and ONLY target checkout buttons
            const orderButtons = document.querySelectorAll(`
                .checkout-sidebar button[type="submit"]:not(.search-btn),
                .order-summary button[type="submit"]:not(.search-btn),
                .payment-methods button[type="submit"]:not(.search-btn),
                button.place-order-btn,
                button.order-btn,
                button.checkout-btn,
                input.place-order-btn,
                input.order-btn,
                input.checkout-btn
            `.split(',').map(s => s.trim()).filter(s => s).join(','));

            // EXPLICITLY EXCLUDE search buttons
            const allButtons = Array.from(orderButtons).filter(button =>
                !button.classList.contains('search-btn') &&
                !button.closest('.search-container') &&
                !button.closest('.header-wrapper') &&
                !button.closest('.main-header') &&
                !button.closest('.top-bar')
            );

            if (selectedPaymentMethod && selectedPaymentMethod.value === 'fonepay') {
                @if(env('FONEPAY_USE_QR_MODE', false))
                    const receiptUploaded = fonePayReceiptInput && fonePayReceiptInput.files.length > 0;

                    allButtons.forEach(button => {
                        if (receiptUploaded) {
                            button.disabled = false;
                            button.classList.remove('btn-secondary');
                            button.classList.add('btn-success');
                            button.textContent = '{{ localize("Place Order") }}';
                        } else {
                            button.disabled = true;
                            button.classList.remove('btn-success');
                            button.classList.add('btn-secondary');
                            button.textContent = '{{ localize("Upload Receipt to Continue") }}';
                        }
                    });
                @else
                    // API mode - enable button normally
                    allButtons.forEach(button => {
                        button.disabled = false;
                        button.classList.remove('btn-secondary');
                        button.classList.add('btn-success');
                        button.textContent = '{{ localize("Place Order") }}';
                    });
                @endif
            } else {
                // Other payment methods - enable button normally
                allButtons.forEach(button => {
                    button.disabled = false;
                    button.classList.remove('btn-secondary');
                    button.classList.add('btn-success');
                    button.textContent = '{{ localize("Place Order") }}';
                });
            }
        }

        // Function to manage required attributes based on selected payment method
        function manageRequiredFields() {
            const selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');
            const fonePayReceiptInput = document.getElementById('fonepay_receipt');

            if (fonePayReceiptInput) {
                if (selectedPaymentMethod && selectedPaymentMethod.value === 'fonepay') {
                    // FonePay selected - make receipt field conditionally required (but not enforced)
                    // Remove required to prevent validation errors
                    fonePayReceiptInput.removeAttribute('required');
                } else {
                    // Other payment method selected - remove required attribute
                    fonePayReceiptInput.removeAttribute('required');
                }
            }
        }

        // Listen for payment method changes
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', function() {
                selectPaymentMethod(this.value);
                updateOrderButtonState();
                manageRequiredFields();
            });
        });

        // Initial setup
        updateOrderButtonState();
        manageRequiredFields();

        // Validate form submission
        const checkoutForm = document.querySelector('form[action*="checkout"]');
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', function(e) {
                const selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');

                if (selectedPaymentMethod && disabledPaymentMethods.includes(selectedPaymentMethod.value)) {
                    e.preventDefault();
                    alert('{{ localize("Please select an available payment method: FonePay, IME Pay, or Cash on Delivery.") }}');
                    return false;
                }

                // FonePay QR mode validation
                if (selectedPaymentMethod && selectedPaymentMethod.value === 'fonepay') {
                    @if(env('FONEPAY_USE_QR_MODE', false))
                        if (!fonePayReceiptInput || fonePayReceiptInput.files.length === 0) {
                            e.preventDefault();
                            alert('{{ localize("Please upload your payment receipt before placing the order.") }}');
                            if (fonePayReceiptInput) {
                                fonePayReceiptInput.focus();
                                fonePayReceiptInput.classList.add('is-invalid');
                                document.getElementById('fonepay_receipt_error').style.display = 'block';
                            }
                            return false;
                        }
                    @endif
                }
            });
        }

        // Handle PayPal button click
        const paypalBtn = document.getElementById('paypal_pay_btn');
        if (paypalBtn) {
            paypalBtn.addEventListener('click', function(e) {
                e.preventDefault();
                alert('{{ localize("PayPal integration is coming soon. Please use FonePay, IME Pay, or Cash on Delivery.") }}');
            });
        }

        // Handle credit card submission (disabled)
        const submitCardBtn = document.getElementById('submit_card');
        if (submitCardBtn) {
            submitCardBtn.addEventListener('click', function(e) {
                e.preventDefault();
                alert('{{ localize("Credit card processing is coming soon. Please use FonePay, IME Pay, or Cash on Delivery.") }}');
            });
        }
    });
</script>

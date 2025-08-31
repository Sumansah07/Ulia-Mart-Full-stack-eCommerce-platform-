@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Payment Policy') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('page-title')
{{ localize('Payment Policy') }}
@endsection

@section('breadcrumb')
    @include('frontend.default.inc.shop-breadcrumb')
@endsection

@section('contents')
    <div id="page-content">
        <!--Main Content-->
        <div class="container">
            <!-- CMS Content -->
            <div class="text-content">
                <h3 style="color: #006633;">{{ localize('Payment Method') }}</h3>
                <p>{{ localize('The available international credit card options are VISA, Mastercard, Maestro, American Express, Discover and Diners. The available domestic debit card options are VISA and Mastercard.') }}</p>
                <p>{{ localize('Please note that Uliaa Mart does not collect your credit/debit card number or personal information when you make a payment. For questions regarding your transactions on our site, please consult your card-issuing bank for information.') }}</p>
                <p>{{ localize('Please make sure that you enter the coupon code exactly as you received it, with no space before, within, or after it. To avoid errors, we recommend you to copy/paste the promotional code you received.') }}</p>
                <ul class="list-dot">
                    <li class="mb-1">{{ localize('Coupons cannot be combined. You can only use one coupon code per order.') }}</li>
                    <li class="mb-1">{{ localize('Coupons are subject to offer terms. This does exclude some items on our website which are not eligible for coupon discounts.') }}</li>
                    <li>{{ localize('You can pay up to 70% of your purchase with bonus points at checkout. Remember that 100 points = Rs 1.') }}</li>
                </ul>

                <h3 style="color: #006633;">{{ localize('Payment Options') }}</h3>
                <p>{{ localize('At Uliaa Mart, we offer multiple payment options to ensure a convenient shopping experience:') }}</p>
                <ul class="list-dot">
                    <li class="mb-1">{{ localize('Credit/Debit Cards: We accept all major credit and debit cards.') }}</li>
                    <li class="mb-1">{{ localize('Digital Wallets: Pay using popular digital wallets like eSewa, Khalti, and IME Pay.') }}</li>
                    <li class="mb-1">{{ localize('Cash on Delivery (COD): Pay in cash when your order is delivered.') }}</li>
                    <li>{{ localize('Bank Transfer: Make a direct transfer to our bank account.') }}</li>
                </ul>

                <h3 style="color: #006633;">{{ localize('Payment Security') }}</h3>
                <p>{{ localize('Your payment security is our priority. We use industry-standard encryption technologies to protect your payment information. Our payment gateways are PCI DSS compliant, ensuring that your card details are processed according to the highest security standards.') }}</p>

                <h3 style="color: #006633;">{{ localize('Transaction Fees') }}</h3>
                <p>{{ localize('Uliaa Mart does not charge any additional transaction fees for online payments. However, your bank or payment provider might apply their own charges. Please check with your bank or payment provider for details.') }}</p>

                <h3 style="color: #006633;">{{ localize('Failed Transactions') }}</h3>
                <p>{{ localize('In case of a failed transaction, the amount debited (if any) will be automatically refunded to your account within 5-7 business days, depending on your bank\'s policies.') }}</p>

                <h3 style="color: #006633;">{{ localize('Currency') }}</h3>
                <p>{{ localize('All transactions on Uliaa Mart are processed in Nepalese Rupees (NPR).') }}</p>

                <h3 style="color: #006633;">{{ localize('Billing Information') }}</h3>
                <p>{{ localize('The billing information you provide during checkout must match the information associated with your payment method. Incorrect billing information may result in payment failure.') }}</p>

                <h3 style="color: #006633;">{{ localize('Order Confirmation') }}</h3>
                <p>{{ localize('Once your payment is successfully processed, you will receive an order confirmation email with your order details and payment receipt.') }}</p>

                <h3 style="color: #006633;">{{ localize('Contact Us') }}</h3>
                <p>{{ localize('If you have any questions or concerns about our Payment Policy, please contact our customer service team at uliaamart@gmail.com or call us at +977 9876543210.') }}</p>
            </div>
            <!-- End CMS Content -->
        </div>
        <!--End Main Content-->
    </div>
@endsection

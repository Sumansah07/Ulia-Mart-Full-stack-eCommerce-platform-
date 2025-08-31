@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Return & Refund Policy') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('page-title')
{{ localize('Return & Refund Policy') }}
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
                <h3 style="color: #006633;">{{ localize('Returns & Exchanges') }}</h3>
                <p>{{ localize("It's bummed to us if you're not 100% satisfied with the items you received, we gladly accept returns postmarked within 45 days from the purchase date and we have made the returns so easy for you!") }}</p>
                <ol class="list-decimal">
                    <li class="mb-1">{{ localize('Sign into your account.') }}</li>
                    <li class="mb-1">{{ localize('Find the order in My Orders, click the "Return Item" button.') }}</li>
                    <li class="mb-1">{{ localize('Select the item(s) you would like to return, indicate the reasons, and submit.') }}</li>
                    <li class="mb-1">{{ localize('Select the mailing method: self-sending or pick-up service (choose the pick-up address and post office required information).') }}</li>
                    <li class="mb-1">{{ localize('The logistics company will contact you as soon as possible, please wait for the courier to pick up the package or take the sealed package to the nearby mailing point and send to the address of Uliaa Mart return center.') }}</li>
                    <li>{{ localize('We will confirm the parcel immediately after we receive the return, update the status of the return and refund within 7 working days. The refund will be returned to you Uliaa Mart wallet or to your original payment account.') }}</li>
                </ol>

                <h3 style="color: #006633;">{{ localize('Return Conditions') }}</h3>
                <p>{{ localize('We only accept returns postmarked within 45 days from the purchase date. Orders must be delivered. The address of the recipient must be in Nepal. The following items cannot be returned or exchanged: bodysuits, lingerie & sleepwear, swimwear, jewelry, and accessories (except scarves, bags, and mermaid blankets).') }}</p>
                <p>{{ localize('All items in bundling promotion is not eligible for partial cancels, exchanges, or returns. Items returned must be in their unused condition with the original packing. We do not accept a returned item that\'s worn, damaged, washed or altered in any way. We do not accept returned items that were sent back by you directly without checking with us first. We do not offer Freight To Collect (FTC) service for the packages returned to us. The returns will be made at your own cost.') }}</p>

                <h3 style="color: #006633;">{{ localize('Refunds') }}</h3>
                <p>{{ localize('Returns will be processed within 7 days upon receipt of your package. The refund will be issued to your Uliaa Mart Wallet or the original payment account per your request. If the order is free shipping, postage will not be deducted.') }}</p>
                <p>{{ localize('Pick-up service charge will be deducted from total refund and self-sending shipping fee will be at your own cost.') }}</p>
                <p><strong>{{ localize('Note') }}：</strong> {{ localize('Refunds will be initiated for items only, other fees like insurance, shipping, COD service charges are non refundable.') }}</p>
            </div>
            <!-- End CMS Content -->
        </div>
        <!--End Main Content-->
    </div>
@endsection

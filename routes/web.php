<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MediaManagerController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartsController;
use App\Http\Controllers\Frontend\WalletController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\RefundsController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\SubscribersController;
use App\Http\Controllers\Frontend\RewardPointsController;
use App\Http\Controllers\Frontend\OrderTrackingController;
use App\Http\Controllers\Backend\Payments\IyZico\IyZicoController;
use App\Http\Controllers\Backend\Payments\Paypal\PaypalController;
use App\Http\Controllers\Backend\Payments\Razorpay\RazorpayController;
use App\Http\Controllers\Backend\Payments\Paytm\PaytmPaymentController;
use App\Http\Controllers\Backend\Payments\Stripe\StripePaymentController;
use App\Http\Controllers\Backend\Payments\IMEPay\IMEPayController;
use App\Http\Controllers\Backend\Payments\FonePay\FonePayController;


// vai ami change hoise

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get("test/test", function(){

});
Route::get('test/test', [TestController::class, 'index']);
Auth::routes(['verify' => true]);

Route::controller(LoginController::class)->group(function () {
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/social-login/redirect/{provider}', 'redirectToProvider')->name('social.login');
    Route::get('/social-login/{provider}/callback', 'handleProviderCallback')->name('social.callback');
});

Route::controller(VerificationController::class)->group(function () {
    Route::get('/verify-phone', 'verifyPhone')->name('verification.phone');
    Route::get('/email/resend', 'resend')->name('verification.resend');
    Route::get('/verification-confirmation/{code}', 'verification_confirmation')->name('email.verification.confirmation');
    Route::post('/verification-confirmation', 'phone_verification_confirmation')->name('phone.verification.confirmation');
});


Route::controller(ForgotPasswordController::class)->group(function () {
    # forgot password
    Route::get('/reset-password-by-phone', 'resetByPhone')->name('forgotPw.resetByPhone');
    Route::post('/reset-password-by-phone', 'updatePw')->name('forgotPw.update');
});

Route::get('/theme/{name?}', [HomeController::class, 'theme'])->name('theme.change');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/brands', [HomeController::class, 'allBrands'])->name('home.brands');
Route::get('/categories', [HomeController::class, 'allCategories'])->name('home.categories');
Route::get('/get-categories-html', [HomeController::class, 'getCategoriesHtml'])->name('home.getCategoriesHtml');

# products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products/get-variation-info', [ProductController::class, 'getVariationInfo'])->name('products.getVariationInfo');
Route::post('/products/show-product-info', [ProductController::class, 'showInfo'])->name('products.showInfo');

# carts
Route::get('/carts', [CartsController::class, 'index'])->name('carts.index');
Route::post('/add-to-cart', [CartsController::class, 'store'])->name('carts.store');
Route::post('/update-cart', [CartsController::class, 'update'])->name('carts.update');
Route::post('/apply-coupon', [CartsController::class, 'applyCoupon'])->name('carts.applyCoupon');
Route::get('/clear-coupon', [CartsController::class, 'clearCoupon'])->name('carts.clearCoupon');
Route::get('/clear-cart', [CartsController::class, 'clearCart'])->name('carts.clear');
Route::post('/empty-cart', [App\Http\Controllers\Frontend\EmptyCartController::class, 'emptyCart'])->name('carts.empty');
Route::post('/get-cart-data', [CartsController::class, 'getCartData'])->name('carts.getData');

# blogs
Route::get('/blogs', [HomeController::class, 'allBlogs'])->name('home.blogs');
Route::get('/blogs/{slug}', [HomeController::class, 'showBlog'])->name('home.blogs.show');

# campaigns
Route::get('/campaigns', [HomeController::class, 'campaignIndex'])->name('home.campaigns');
Route::get('/campaigns/{slug}', [HomeController::class, 'showCampaign'])->name('home.campaigns.show');

# coupons
Route::get('/coupons', [HomeController::class, 'allCoupons'])->name('home.coupons');

# pages
Route::get('/pages/about-us', [HomeController::class, 'aboutUs'])->name('home.pages.aboutUs');
Route::get('/pages/contact-us', [HomeController::class, 'contactUs'])->name('home.pages.contactUs');
Route::get('/pages/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('home.pages.privacyPolicy');
Route::get('/pages/return-refund-policy', [HomeController::class, 'returnRefundPolicy'])->name('home.pages.returnRefundPolicy');
Route::get('/pages/shipping-delivery-policy', [HomeController::class, 'shippingDeliveryPolicy'])->name('home.pages.shippingDeliveryPolicy');
Route::get('/pages/payment-policy', [HomeController::class, 'paymentPolicy'])->name('home.pages.paymentPolicy');
Route::get('/pages/{slug}', [HomeController::class, 'showPage'])->name('home.pages.show');

# contact us message
Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contactUs.store');

# product reviews
Route::post('/product-reviews', [App\Http\Controllers\Frontend\ReviewController::class, 'store'])->name('products.reviews.store');

# Subscribed Users
Route::post('/subscribers', [SubscribersController::class, 'store'])->name('subscribe.store');

# addresses
Route::post('/get-states', [AddressController::class, 'getStates'])->name('address.getStates');
Route::post('/get-cities', [AddressController::class, 'getCities'])->name('address.getCities');

// load filter templates
Route::get('/filter-templates', [HomeController::class, 'filterTemplates'])->name('products.template');
# authenticated routes
Route::group(['prefix' => '', 'middleware' => ['customer', 'verified', 'isBanned']], function () {
    # customer routes
    Route::get('/customer-dashboard', [CustomerController::class, 'index'])->name('customers.dashboard');
    Route::get('/customer-order-history', [CustomerController::class, 'orderHistory'])->name('customers.orderHistory');
    Route::get('/customer-order-details/{code}', [CustomerController::class, 'orderDetails'])->name('customers.orderDetails');
    Route::get('/customer-address', [CustomerController::class, 'address'])->name('customers.address');
    Route::get('/customer-profile', [CustomerController::class, 'profile'])->name('customers.profile');
    Route::post('/customer-profile', [CustomerController::class, 'updateProfile'])->name('customers.updateProfile');
    Route::get('/customer-settings', [CustomerController::class, 'settings'])->name('customers.settings');
    Route::post('/customer-deactivate', [CustomerController::class, 'deactivateAccount'])->name('customers.deactivateAccount');
    Route::post('/customer-delete', [CustomerController::class, 'deleteAccount'])->name('customers.deleteAccount');

    # wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('customers.wishlist');
    Route::post('/add-to-wishlist', [WishlistController::class, 'store'])->name('customers.wishlist.store');
    Route::get('/delete-wishlist/{id}', [WishlistController::class, 'delete'])->name('customers.wishlist.delete');

    # address
    Route::post('/new-address', [AddressController::class, 'store'])->name('address.store');
    Route::post('/edit-address', [AddressController::class, 'edit'])->name('address.edit');
    Route::post('/update-address', [AddressController::class, 'update'])->name('address.update');
    Route::get('/delete-address/{id}', [AddressController::class, 'delete'])->name('address.delete');

    # order tracking
    Route::get('/track-order', [OrderTrackingController::class, 'index'])->name('customers.trackOrder');

    # reward points
    Route::get('/reward-points', [RewardPointsController::class, 'index'])->name('customers.rewardPoints');
    Route::get('/reward-points/convert/{id}', [RewardPointsController::class, 'convert'])->name('customers.convertRewardPoints');

    # Wallet history
    Route::get('/wallet-histories', [WalletController::class, 'index'])->name('customers.walletHistory');

    # refund request
    Route::post('/request-refund', [RefundsController::class, 'store'])->name('customers.requestRefund');
    Route::get('/refunds', [RefundsController::class, 'refunds'])->name('customers.refunds');
});

# checkout (GUEST + LOGGED-IN)
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.proceed');

# Tax calculation test route (for development/testing)
Route::get('/test-tax-calculation', function() {
    return view('frontend.default.pages.test-tax-calculation');
})->name('test.tax.calculation');

# Coupon breakdown demo route (for development/testing)
Route::get('/coupon-breakdown-demo', function() {
    return view('frontend.default.pages.coupon-breakdown-demo');
})->name('coupon.breakdown.demo');

# Coupon filtering demo route (for development/testing)
Route::get('/coupon-filtering-demo', function() {
    return view('frontend.default.pages.coupon-filtering-demo');
})->name('coupon.filtering.demo');

# Coupon backend validation test route (for development/testing)
Route::get('/coupon-backend-validation-test', function() {
    return view('frontend.default.pages.coupon-backend-validation-test');
})->name('coupon.backend.validation.test');
Route::post('/get-checkout-logistics', [CheckoutController::class, 'getLogistic'])->name('checkout.getLogistic');
Route::post('/shipping-amount', [CheckoutController::class, 'getShippingAmount'])->name('checkout.getShippingAmount');
Route::post('/checkout-complete', [CheckoutController::class, 'complete'])->name('checkout.complete');
Route::get('/checkout-complete', [CheckoutController::class, 'handleCheckoutComplete'])->name('checkout.handleComplete');
Route::get('/orders/invoice/{code}', [CheckoutController::class, 'invoice'])->name('checkout.invoice');
Route::get('/orders/{code}/success', [CheckoutController::class, 'success'])->name('checkout.success');

# media files routes
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('/media-manager/get-files', [MediaManagerController::class, 'index'])->name('uppy.index');
    Route::get('/media-manager/get-selected-files', [MediaManagerController::class, 'selectedFiles'])->name('uppy.selectedFiles');
    Route::post('/media-manager/add-files', [MediaManagerController::class, 'store'])->name('uppy.store');
    Route::get('/media-manager/delete-files/{id}', [MediaManagerController::class, 'delete'])->name('uppy.delete');
});

# payment gateways
Route::group(['prefix' => ''], function () {
    # paypal
    Route::get('/paypal/success', [PaypalController::class, 'success'])->name('paypal.success');
    Route::get('/paypal/cancel', [PaypalController::class, 'cancel'])->name('paypal.cancel');

    # stripe
    Route::any('/stripe/create-session', [StripePaymentController::class, 'checkoutSession'])->name('stripe.checkoutSession');
    Route::get('/stripe/success', [StripePaymentController::class, 'success'])->name('stripe.success');
    Route::get('/stripe/cancel', [StripePaymentController::class, 'cancel'])->name('stripe.cancel');

    # paytm
    Route::any('/paytm/callback', [PaytmPaymentController::class, 'callback'])->name('paytm.callback');

    # razorpay
    Route::post('razorpay/payment', [RazorpayController::class, 'payment'])->name('razorpay.payment');

    # iyzico
    Route::any('/iyzico/payment/callback', [IyZicoController::class, 'callback'])->name('iyzico.callback');

    # imepay
    Route::get('/imepay/success', [IMEPayController::class, 'success'])->name('imepay.success');
    Route::get('/imepay/failed', [IMEPayController::class, 'failed'])->name('imepay.failed');

    # fonepay
    Route::match(['GET', 'POST'], '/fonepay/success', [FonePayController::class, 'success'])->name('fonepay.success');
    Route::match(['GET', 'POST'], '/fonepay/failed', [FonePayController::class, 'failed'])->name('fonepay.failed');
});



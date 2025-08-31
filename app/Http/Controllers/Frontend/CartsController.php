<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Auth;

class CartsController extends Controller
{
    # all cart items
    public function index()
    {
        $carts = null;
        if (Auth::check()) {
            $carts          = Cart::where('user_id', Auth::user()->id)->where('location_id', session('stock_location_id'))->get();
        } else {
            $guestUserId = isset($_COOKIE['guest_user_id']) ? (int) $_COOKIE['guest_user_id'] : 0;
            $carts = Cart::where('guest_user_id', $guestUserId)->where('location_id', session('stock_location_id'))->get();
        }
        return view('frontend.default.pages.checkout.carts', ['carts' => $carts]);
    }

    # add to cart
    public function store(Request $request)
    {
        $productVariation = ProductVariation::where('id', $request->product_variation_id)->first();

        if (!is_null($productVariation)) {

            $cart = null;
            $message = '';

            if (Auth::check()) {
                $cart          = Cart::where('user_id', Auth::user()->id)->where('location_id', session('stock_location_id'))->where('product_variation_id', $productVariation->id)->first();
            } else {
                $guestUserId = isset($_COOKIE['guest_user_id']) ? (int) $_COOKIE['guest_user_id'] : 0;
                $cart = Cart::where('guest_user_id', $guestUserId)->where('location_id', session('stock_location_id'))->where('product_variation_id', $productVariation->id)->first();
            }

            if (is_null($cart)) {
                $product = $productVariation->product;
                $cart = new Cart;
                $cart->product_variation_id = $productVariation->id;
                if($request->quantity > $product->max_purchase_qty){
                    $cart->qty                  = (int) $product->max_purchase_qty;
                }else{
                    $cart->qty                  = (int) $request->quantity;
                }
                $cart->location_id          = session('stock_location_id');
                $cart->product_id          = $product->id;

                if (Auth::check()) {
                    $cart->user_id          = Auth::user()->id;
                } else {
                    $guestUserId = isset($_COOKIE['guest_user_id']) ? (int) $_COOKIE['guest_user_id'] : 0;
                    $cart->guest_user_id = $guestUserId;
                }
                $message =  localize('Product added to your cart');
            } else {
                $product = $cart->product_variation->product;
                if($product->max_purchase_qty > $cart->qty){
                    $cart->qty                  += (int) $request->quantity;
                    $message =  localize('Quantity has been increased');
                }else{
                    $message = localize('You have reached maximum order quantity at a time for this product');
                    return $this->getCartsInfo($message, true, '', 'warning');
                }
            }

            $cart->save();
            // remove coupon
            removeCoupon();
            return $this->getCartsInfo($message, false);
        }
    }

    # update cart
    public function update(Request $request)
    {
        try {
            $cart = Cart::where('id', $request->id)->first();
            if ($request->action == "increase") {
                $product = $cart->product_variation->product;

                if($product->max_purchase_qty > $cart->qty){
                    $productVariationStock = $cart->product_variation->product_variation_stock;
                    if ($productVariationStock->stock_qty > $cart->qty) {
                        $cart->qty += 1;
                        $cart->save();
                    }
                }else{
                    $message = localize('You have reached maximum order quantity at a time for this product');
                    return $this->getCartsInfo($message, true, '', 'warning');
                }

            } elseif ($request->action == "decrease") {
                if ($cart->qty > 1) {
                    $cart->qty -= 1;
                    $cart->save();
                }
            } else {
                $cart->delete();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        removeCoupon();
        return $this->getCartsInfo('', false);
    }

    # apply coupon
    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)->first();
        if ($coupon) {
            $date = strtotime(date('d-m-Y H:i:s'));

            # check if coupon is not expired
            if ($coupon->start_date <= $date && $coupon->end_date >= $date) {

                $carts = null;
                if (Auth::check()) {
                    $carts          = Cart::where('user_id', Auth::user()->id)->where('location_id', session('stock_location_id'))->get();
                } else {
                    $guestUserId = isset($_COOKIE['guest_user_id']) ? (int) $_COOKIE['guest_user_id'] : 0;
                    $carts = Cart::where('guest_user_id', $guestUserId)->where('location_id', session('stock_location_id'))->get();
                }

                # check min spend - using BASE PRICES (no discount badge calculations)
                $baseSubTotal = 0;
                if (count($carts) > 0) {
                    foreach ($carts as $cart) {
                        try {
                            if (isset($cart->product_variation) && isset($cart->product_variation->product)) {
                                $product = $cart->product_variation->product;
                                $basePrice = $product->base_price ?? $product->min_price ?? 0;
                                $baseSubTotal += $basePrice * $cart->qty;
                            }
                        } catch (\Exception $e) {
                            // Handle error silently
                        }
                    }
                }
                
                if ($baseSubTotal >= (float) $coupon->min_spend) {

                    # check if coupon is for categories or products
                    if ($coupon->product_ids || $coupon->category_ids) {
                        if ($carts && validateCouponForProductsAndCategories($carts, $coupon)) {
                            # SUCCESS:: can apply coupon
                            setCoupon($coupon);
                            return $this->getCartsInfo(localize('Coupon applied successfully'), true, $coupon->code);
                        }

                        # coupon not valid for your cart items
                        removeCoupon();
                        return $this->couponApplyFailed(localize('Coupon is only applicable for selected products or categories'));
                    }

                    # SUCCESS::can apply coupon - not product or category based
                    setCoupon($coupon);
                    return $this->getCartsInfo(localize('Coupon applied successfully'), true, $coupon->code);
                }

                # min spend
                removeCoupon();
                return $this->couponApplyFailed('Please shop for atleast ' . formatPrice($coupon->min_spend));
            }

            # expired
            removeCoupon();
            return $this->couponApplyFailed(localize('Coupon is expired'));
        }

        // coupon not found
        removeCoupon();
        return $this->couponApplyFailed(localize('Coupon is not valid'));
    }

    # coupon apply failed
    private function couponApplyFailed($message = '', $success = false)
    {
        $response = $this->getCartsInfo($message, false);
        $response['success'] = $success;
        return $response;
    }

    # clear coupon
    public function clearCoupon()
    {
        removeCoupon();
        return $this->couponApplyFailed(localize('Coupon has been removed'), true);
    }

    # clear cart - remove all items
    public function clearCart()
    {
        try {
            if (Auth::check()) {
                Cart::where('user_id', Auth::user()->id)->where('location_id', session('stock_location_id'))->delete();
            } else {
                $guestUserId = isset($_COOKIE['guest_user_id']) ? (int) $_COOKIE['guest_user_id'] : 0;
                Cart::where('guest_user_id', $guestUserId)->where('location_id', session('stock_location_id'))->delete();
            }

            return redirect()->route('carts.index')->with('success', localize('Your cart has been cleared'));
        } catch (\Exception $e) {
            return redirect()->route('carts.index')->with('error', localize('Could not clear cart'));
        }
    }

    # get cart information
    private function getCartsInfo($message = '', $couponDiscount = true, $couponCode = '', $alert = 'success')
    {
        $carts = null;
        if (Auth::check()) {
            $carts          = Cart::where('user_id', Auth::user()->id)->where('location_id', session('stock_location_id'))->get();
        } else {
            $guestUserId = isset($_COOKIE['guest_user_id']) ? (int) $_COOKIE['guest_user_id'] : 0;
            $carts = Cart::where('guest_user_id', $guestUserId)->where('location_id', session('stock_location_id'))->get();
        }

        // Calculate subtotal using DISCOUNTED PRICES (with admin panel discount applied)
        $baseSubTotal = 0;
        if (count($carts) > 0) {
            foreach ($carts as $cart) {
                try {
                    if (isset($cart->product_variation) && isset($cart->product_variation->product)) {
                        $product = $cart->product_variation->product;
                        // Check if product has taxes to determine which function to use
                        $hasTax = false;
                        if ($product->taxes && $product->taxes->count() > 0) {
                            foreach ($product->taxes as $tax) {
                                if (($tax->tax_type == 'percent' && $tax->tax_value > 0) ||
                                    ($tax->tax_type == 'flat' && $tax->tax_value > 0)) {
                                    $hasTax = true;
                                    break;
                                }
                            }
                        }
                        // Use appropriate discounted price function
                        $discountedPrice = $hasTax ? discountedProductBasePrice($product) : discountedProductBasePriceWithoutTax($product);
                        $baseSubTotal += $discountedPrice * $cart->qty;
                    }
                } catch (\Exception $e) {
                    // Handle error silently
                }
            }
        }

        return [
            'success'           => true,
            'message'           => $message,
            'alert'             => $alert,
            'carts'             => getRender('pages.partials.carts.cart-listing', ['carts' => $carts]),
            'navCarts'          => getRender('pages.partials.carts.cart-navbar', ['carts' => $carts]),
            'cartCount'         => count($carts),
            'subTotal'          => formatPrice($baseSubTotal),
            'couponDiscount'    => formatPrice(getCouponDiscountWithRestrictions($carts, $couponCode)),
        ];
    }

    # get current cart data for AJAX requests
    public function getCartData()
    {
        return $this->getCartsInfo('', false);
    }
}

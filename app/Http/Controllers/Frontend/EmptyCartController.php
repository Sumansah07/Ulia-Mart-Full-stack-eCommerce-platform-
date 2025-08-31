<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

class EmptyCartController extends Controller
{
    /**
     * Empty the cart for the current user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function emptyCart(Request $request)
    {
        try {
            $force = $request->input('force', false);
            $count = 0;
            
            // Log the start of cart emptying
            Log::info('=== STARTING CART EMPTYING PROCESS VIA AJAX ===', [
                'user_id' => Auth::check() ? Auth::user()->id : 'guest',
                'session_id' => session()->getId(),
                'stock_location_id' => session('stock_location_id', 'not set'),
                'force' => $force
            ]);
            
            if (Auth::check()) {
                $userId = Auth::user()->id;
                
                // Check for any existing cart items before deletion
                $existingCarts = DB::table('carts')->where('user_id', $userId)->get();
                Log::info('EXISTING CART ITEMS BEFORE DELETION VIA AJAX', [
                    'user_id' => $userId,
                    'count' => count($existingCarts),
                    'items' => $existingCarts
                ]);
                
                // Use direct DB query to ensure complete cart emptying
                if ($force) {
                    $count = DB::table('carts')->where('user_id', $userId)->delete();
                    Log::info("DIRECT DB DELETION VIA AJAX: Force deleted {$count} cart items for user ID: {$userId}", [
                        'deletion_count' => $count,
                        'user_id' => $userId
                    ]);
                } else {
                    // Use Eloquent
                    $count = Cart::where('user_id', $userId)->delete();
                    Log::info("ELOQUENT DELETION VIA AJAX: Deleted {$count} cart items for user ID: {$userId}", [
                        'deletion_count' => $count,
                        'user_id' => $userId
                    ]);
                }
                
                // Verify cart is empty after deletion
                $remainingCarts = DB::table('carts')->where('user_id', $userId)->get();
                Log::info('REMAINING CART ITEMS AFTER DELETION VIA AJAX', [
                    'user_id' => $userId,
                    'count' => count($remainingCarts),
                    'items' => $remainingCarts
                ]);
            } else if (isset($_COOKIE['guest_user_id'])) {
                $guestId = (int) $_COOKIE['guest_user_id'];
                
                // Check for any existing cart items before deletion
                $existingCarts = DB::table('carts')->where('guest_user_id', $guestId)->get();
                Log::info('EXISTING CART ITEMS BEFORE DELETION VIA AJAX (GUEST)', [
                    'guest_user_id' => $guestId,
                    'count' => count($existingCarts),
                    'items' => $existingCarts
                ]);
                
                // Use direct DB query to ensure complete cart emptying
                if ($force) {
                    $count = DB::table('carts')->where('guest_user_id', $guestId)->delete();
                    Log::info("DIRECT DB DELETION VIA AJAX (GUEST): Force deleted {$count} cart items for guest user ID: {$guestId}", [
                        'deletion_count' => $count,
                        'guest_user_id' => $guestId
                    ]);
                } else {
                    // Use Eloquent
                    $count = Cart::where('guest_user_id', $guestId)->delete();
                    Log::info("ELOQUENT DELETION VIA AJAX (GUEST): Deleted {$count} cart items for guest user ID: {$guestId}", [
                        'deletion_count' => $count,
                        'guest_user_id' => $guestId
                    ]);
                }
                
                // Verify cart is empty after deletion
                $remainingCarts = DB::table('carts')->where('guest_user_id', $guestId)->get();
                Log::info('REMAINING CART ITEMS AFTER DELETION VIA AJAX (GUEST)', [
                    'guest_user_id' => $guestId,
                    'count' => count($remainingCarts),
                    'items' => $remainingCarts
                ]);
            }
            
            Log::info('=== CART EMPTYING PROCESS VIA AJAX COMPLETED ===', [
                'user_id' => Auth::check() ? Auth::user()->id : 'guest',
                'session_id' => session()->getId(),
                'count' => $count
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Cart emptied successfully',
                'count' => $count
            ]);
        } catch (\Exception $e) {
            Log::error('ERROR EMPTYING CART VIA AJAX', [
                'user_id' => Auth::check() ? Auth::user()->id : 'guest',
                'error_message' => $e->getMessage(),
                'error_trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error emptying cart: ' . $e->getMessage()
            ], 500);
        }
    }
}

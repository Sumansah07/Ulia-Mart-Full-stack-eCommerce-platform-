<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderGroup;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    # track orders
    public function index(Request $request)
    {
        // Check if it's a mobile device using more accurate detection
        $userAgent = $request->header('User-Agent');
        $isMobile = preg_match('/Mobile|Android|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i', $userAgent) &&
                   !preg_match('/iPad|Tablet/i', $userAgent);

        // Also check screen width if available (for better mobile detection)
        $screenWidth = $request->header('X-Screen-Width');
        if ($screenWidth && $screenWidth < 768) {
            $isMobile = true;
        }

        // Temporarily disable mobile redirect for debugging
        // For mobile devices, redirect to mobile account dashboard with orders tracking tab
        // But preserve query parameters
        if (false && $isMobile) {
            $dashboardUrl = route('customers.dashboard') . '#orders-tracker';

            // Preserve query parameters for mobile redirect
            if ($request->code || $request->email) {
                $queryParams = [];
                if ($request->code) $queryParams['code'] = $request->code;
                if ($request->email) $queryParams['email'] = $request->email;
                $dashboardUrl .= '?' . http_build_query($queryParams);
            }

            return redirect($dashboardUrl);
        }

        if ($request->code != null) {
            $searchCode = $request->code;

            // Debug: Log the search attempt
            \Log::info('Order tracking search', [
                'search_code' => $searchCode,
                'user_id' => auth()->user()->id ?? 'guest',
                'email' => $request->email
            ]);

            // Debug: Show all order groups for debugging
            $allOrderGroups = \App\Models\OrderGroup::select('id', 'order_code', 'user_id')->get();
            \Log::info('All order groups in database', $allOrderGroups->toArray());

            // Try to find order group by code (try both exact match and with prefixes)
            $orderGroup = OrderGroup::where('order_code', $searchCode)
                ->orWhere('order_code', 'like', '%' . $searchCode)
                ->orWhere('order_code', 'like', $searchCode . '%')
                ->first();

            $order = null;

            if (!is_null($orderGroup)) {
                // Check if user is logged in and owns the order
                if (auth()->check()) {
                    $order = Order::where('user_id', auth()->user()->id)
                        ->where('order_group_id', $orderGroup->id)
                        ->first();
                } else {
                    // For guest users or if email provided, check by email
                    if ($request->email) {
                        $order = Order::where('order_group_id', $orderGroup->id)
                            ->whereHas('orderGroup', function($query) use ($request) {
                                $query->whereHas('user', function($subQuery) use ($request) {
                                    $subQuery->where('email', $request->email);
                                });
                            })
                            ->first();
                    } else {
                        // If no email provided, just get the order (less secure but functional)
                        $order = Order::where('order_group_id', $orderGroup->id)->first();
                    }
                }

                // Debug: Log the order search result
                \Log::info('Order search result', [
                    'order_group_found' => !is_null($orderGroup),
                    'order_group_id' => $orderGroup->id ?? null,
                    'order_found' => !is_null($order),
                    'order_id' => $order->id ?? null
                ]);
            }

            if (!is_null($order)) {
                $view = view('frontend.default.pages.users.orderTrack', ['order' => $order, 'searchCode' => $searchCode]);
            } else {
                flash(localize('No order found by this code'))->error();
                $view = view('frontend.default.pages.users.orderTrack', ['searchCode' => $searchCode]);
            }
        } else {
            $view = view('frontend.default.pages.users.orderTrack');
        }

        return $view;
    }
}

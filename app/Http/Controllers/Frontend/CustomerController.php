<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\OrderGroup;
use App\Models\MediaManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Str;

class CustomerController extends Controller
{
    # customer dashbaord
    public function index()
    {
        $user = auth()->user();
        return view('frontend.default.pages.users.dashboard', [
            'user' => $user
        ]);
    }

    # customer's order history
    public function orderHistory()
    {
        $orders = auth()->user()->orders()
            ->with(['orderItems.product_variation.product.product_localizations'])
            ->latest()
            ->paginate(10);
        return view('frontend.default.pages.users.orderHistory', ['orders' => $orders]);
    }

    # customer's order details
    public function orderDetails($code)
    {
        $orderGroup = OrderGroup::where('user_id', auth()->user()->id)->where('order_code', $code)->first();
        if (!$orderGroup) {
            flash(localize('Order not found'))->error();
            return redirect()->route('customers.orderHistory');
        }
        return view('frontend.default.pages.users.orderDetails', ['orderGroup' => $orderGroup]);
    }

    # customer's address
    public function address()
    {
        $user = auth()->user();
        $addresses = $user->addresses()->latest()->get();
        $countries = Country::isActive()->get();

        return view('frontend.default.pages.users.address', [
            'addresses' => $addresses,
            'countries' => $countries,
        ]);
    }

    # customer's profile
    public function profile()
    {
        $user = auth()->user();
        $defaultAddress = $user->addresses()->where('is_default', 1)->first();
        $countries = \App\Models\Country::isActive()->get();

        return view('frontend.default.pages.users.profile', [
            'user' => $user,
            'defaultAddress' => $defaultAddress,
            'countries' => $countries
        ]);
    }

    # customer's settings
    public function settings()
    {
        $user = auth()->user();
        return view('frontend.default.pages.users.settings', [
            'user' => $user
        ]);
    }

    # update profile
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        if ($request->type == "info") {
            # update info
            $request->validate(
                [
                    'avatar' => 'nullable|max:4000|mimes:jpeg,png,webp,jpg'
                ],
                [
                    'avatar.max' => 'Max file size is 4MB!'
                ]
            );

            if ($request->hasFile('avatar')) {
                $mediaFile = new MediaManager;
                $mediaFile->user_id = auth()->user()->id;
                $mediaFile->media_file = $request->file('avatar')->store('uploads/media');
                $mediaFile->media_size = $request->file('avatar')->getSize();
                $mediaFile->media_name = $request->file('avatar')->getClientOriginalName();
                $mediaFile->media_extension = $request->file('avatar')->getClientOriginalExtension();

                if (getFileType(Str::lower($mediaFile->media_extension)) != null) {
                    $mediaFile->media_type = getFileType(Str::lower($mediaFile->media_extension));
                } else {
                    $mediaFile->media_type = "unknown";
                }
                $mediaFile->save();
                $user->avatar = $mediaFile->id;
            }

            $user->name = $request->name;
            $user->phone = validatePhone($request->phone);
            $user->postal_code = $request->postal_code;
            $user->save();
            flash(localize('Profile updated successfully'))->success();
            return back();
        }
        else {
            # update password
            $request->validate(
                [
                    'password' => 'required|confirmed|min:6'
                ]
            );
            $user->password = Hash::make($request->password);
            $user->save();
            flash(localize('Password updated successfully'))->success();
            return back();
        }
    }

    # deactivate account
    public function deactivateAccount(Request $request)
    {
        $user = auth()->user();

        // Log the reason for deactivation
        \Log::info('User ' . $user->id . ' requested account deactivation. Reason: ' . $request->reason);

        // Set the user as inactive
        $user->is_active = 0;
        $user->save();

        // Log the user out
        auth()->logout();

        flash(localize('Your account has been deactivated. You can contact support to reactivate it.'))->success();
        return redirect()->route('home');
    }

    # delete account
    public function deleteAccount(Request $request)
    {
        $user = auth()->user();

        // Log the reason for deletion
        \Log::info('User ' . $user->id . ' requested account deletion. Reason: ' . $request->reason);

        // Log the user out first
        auth()->logout();

        // Soft delete the user account
        $user->delete();

        flash(localize('Your account has been deleted. We\'re sorry to see you go.'))->success();
        return redirect()->route('home');
    }
}

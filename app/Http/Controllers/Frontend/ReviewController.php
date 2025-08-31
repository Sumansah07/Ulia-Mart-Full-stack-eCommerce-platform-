<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:1500',
        ]);

        $review = new Review();
        $review->product_id = $request->product_id;
        $review->user_id = Auth::check() ? Auth::user()->id : null;
        $review->name = $request->name;
        $review->email = $request->email;
        $review->rating = $request->rating;
        $review->title = $request->title;
        $review->content = $request->content;
        $review->status = 0; // Pending approval
        $review->save();

        flash(localize('Your review has been submitted and is pending approval'))->success();
        return back();
    }
}

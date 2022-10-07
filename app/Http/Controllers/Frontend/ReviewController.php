<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index($prod_slug)
    {
        $product = Product::where('slug', $prod_slug)->first();
        if ($product) {
            $review = Review::where('user_id', Auth::id())->where('prod_id', $product->id)->first();
            if ($review) {
                return view('frontend.review.user-review-edit', compact('review'));
            } else {
                $verify_check = Order::where('user_id', Auth::id())
                    ->join('order_items', 'orders.id', 'order_items.id')
                    ->where('order_items.prod_id', $product->id)->get();

                return view('frontend.review.user-review-index', compact('verify_check', 'product'));
            }
        } else {
            return redirect()->back()->with('status', 'The link you followed was broken');
        }
    }

    public function postReview(Request $request)
    {
        $product_id = $request->product_id;
        $user_review = $request->user_review;

        $product = Product::where('id', $product_id)->first();
        if ($product) {
            $new_review = Review::create([
                'user_id' => Auth::id(),
                'prod_id' => $product_id,
                'user_review' => $user_review,
            ]);
            if ($new_review) {
                $catSlug = $product->category->slug;
                $prodSlug = $product->slug;
                return redirect('category/' . $catSlug . '/' . $prodSlug)->with('status', 'Thanks for giving review');
            }
        } else {
            return redirect()->back()->with('status', 'The link you followed was broken');
        }
    }

    public function editReview($prod_slug)
    {
        $product = Product::where('slug', $prod_slug)->first();

        if ($product) {
            $review = Review::where('prod_id', $product->id)->where('user_id', Auth::id())->first();
            return view('frontend.review.user-review-edit', compact('review'));
        } else {
            return redirect()->back()->with('status', 'The link you followed was broken');
        }
    }

    public function updateReview(Request $request)
    {
        $review_id = $request->review_id;
        $user_review = $request->user_review;

        $review = Review::where('id', $review_id)->where('user_id', Auth::id())->first();
        if ($review != '') {
            $review->update([
                'user_review' => $user_review,
            ]);
            return redirect('category/' . $review->products->category->slug . '/' . $review->products->slug)->with('status', 'Review updated success');
        } else {
            return redirect()->back()->with('status', 'Cannot submit the empty value');
        }
    }
}

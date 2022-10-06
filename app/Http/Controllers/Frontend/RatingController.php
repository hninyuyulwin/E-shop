<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function add(Request $request)
    {
        $stars_rated = $request->product_rating;
        $product_id = $request->prod_id;

        //$prod_check = Product::where('id', $product_id)->where('status', 0)->first();
        $prod_check = Product::where('id', $product_id)->first();
        if ($prod_check) {
            $verify_checked = Order::where('orders.user_id', Auth::id())
                ->join('order_items', 'orders.id', 'order_items.order_id')
                ->where('order_items.prod_id', $product_id)
                ->get();
            if ($verify_checked->count() > 0) {
                $rate_check = Rating::where('user_id', Auth::id())->where('prod_id', $product_id)->first();
                if ($rate_check) {
                    $rate_check->update([
                        'stars_rated' => $stars_rated,
                    ]);
                } else {
                    Rating::create([
                        'user_id' => Auth::id(),
                        'prod_id' => $product_id,
                        'stars_rated' => $stars_rated,
                    ]);
                }
                return redirect()->back()->with('status', "Thanks for your feedback");
            } else {
                return redirect()->back()->with('status', "You cannot rate a product without purchased!");
            }
        } else {
            return redirect()->back()->with('status', "The link you followed was broken");
        }
    }
}

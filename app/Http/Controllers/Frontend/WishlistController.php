<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('frontend.wishlist', compact('wishlist'));
    }

    public function addToWishlist(Request $request)
    {
        $product_id = $request->product_id;

        if (Auth::check()) {
            $prod = Product::where('id', $product_id);
            if ($prod->exists()) {
                $product = $prod->first();
                if (Wishlist::where('user_id', Auth::id())->where('prod_id', $product_id)->exists()) {
                    return response()->json(['status' => $product->name . ' already Added!']);
                } else {
                    Wishlist::create([
                        'user_id' => Auth::id(),
                        'prod_id' => $product_id
                    ]);
                    return response()->json(['status' => $product->name . ' added to Wishlist']);
                }
            } else {
                return response()->json(['status' => 'Product does not exit']);
            }
        } else {
            return response()->json(['status' => 'Login Required to add wishlist']);
        }
    }

    public function wishlistDelete(Request $request)
    {
        $product_id = $request->id;

        if (Auth::check()) {
            $whish_item = Wishlist::where('user_id', Auth::id())->where('prod_id', $product_id);
            if ($whish_item->exists()) {
                $wish = $whish_item->first();
                $wish->delete();
                return response()->json(['status' => 'Product removed from Wishlist']);
            }
        } else {
            return response()->json(['status' => 'Login Required']);
        }
    }

    public function wishlistCount()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->count();
        return response()->json(['count' => $wishlist]);
    }
}

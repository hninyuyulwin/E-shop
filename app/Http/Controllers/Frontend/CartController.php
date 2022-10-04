<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product_id = $request->product_id;
        $product_qty = $request->product_qty;

        if (Auth::check()) {
            $prod_check = Product::where('id', $product_id)->first();
            if ($prod_check) {
                if (Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->exists()) {
                    return response()->json(['status' => $prod_check->name . ' Already Added Success!']);
                } else {
                    Cart::create([
                        'user_id' => Auth::user()->id,
                        'prod_id' => $product_id,
                        'prod_qty' => $product_qty
                    ]);
                    return response()->json(['status' => $prod_check->name . ' Added Success!']);
                }
            }
        } else {
            return response()->json(['status' => 'Please Login First!!']);
        }
    }

    public function viewCart()
    {
        $cartItem = Cart::where('user_id', Auth::user()->id)->get();
        return view('frontend.cart', compact('cartItem'));
    }

    public function deleteProduct(Request $request)
    {
        $product_id = $request->product_id;
        if (Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->exists()) {
            Cart::where('prod_id', $product_id)->delete();
            return response()->json(['status' => 'Product Deleted Success!']);
        } else {
            return response()->json(['status' => 'Login Required!']);
        }
    }

    public function updateQtyCalc(Request $request)
    {
        $product_id = $request->product_id;
        $product_qty = $request->product_qty;

        if (Auth::check()) {
            $cart = Cart::where('prod_id', $product_id)->where('user_id', Auth::user()->id);
            if ($cart->exists()) {
                $cart = $cart->first();
                $cart->prod_qty = $product_qty;
                $cart->update();
                return response()->json(['status' => 'Product Quantity Updated!']);
            }
        } else {
            return response()->json(['status' => 'Login Required!']);
        }
    }

    public function cartCount()
    {
        $cartCount = Cart::where('user_id', Auth::id())->count();
        return response()->json(['count' => $cartCount]);
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $old_cartItems = Cart::where('user_id', Auth::user()->id)->get();
        foreach ($old_cartItems as $item) {
            if (!(Product::where('id', $item->prod_id)->where('qty', '>=', $item->prod_qty)->exists())) {
                $cart = Cart::where('user_id', Auth::id())->where('prod_id', $item->prod_id)->first();
                $cart->delete();
            }
        }
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.checkout', compact('cartItems'));
    }

    public function placeOrder(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['tracking_no'] = 'kiwi' . rand(1111, 9999);

        $data['payment_mode'] = $request->payment_mode;
        $data['payment_id'] = $request->payment_id;

        //to calculate the total price
        $total = 0;
        $total_cartItem = Cart::where('user_id', Auth::id())->get();
        foreach ($total_cartItem as $prod) {
            $total += $prod->products->selling_price * $prod->prod_qty;
        }
        $data['total_price'] = $total;
        $order = Order::create($data);

        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'qty' => $item->prod_qty,
                'price' => $item->products->selling_price * $item->prod_qty,
            ]);
            // Subtract the quantity from product
            $product = Product::where('id', $item->prod_id)->first();
            $product->qty = $product->qty - $item->prod_qty;
            $product->update();
        }
        if (Auth::user()->address1 == NULL) {
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->fname;
            $user->lname = $request->lname;
            $user->phone = $request->phone;
            $user->address1 = $request->address1;
            $user->address2 = $request->address2;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->pincode = $request->pincode;
            $user->update();
        }

        $cartItems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartItems);

        if ($request->payment_mode == "Paid by Razor Pay" || $request->payment_mode == "Paid By Paypal") {
            return response()->json(['status' => "Order Placed Success"]);
        }
        return redirect()->route('index')->with('status', 'Order Placed Submited');
    }

    public function razorPayCheck(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $total_price = 0;
        foreach ($cartItems as $item) {
            $total_price += $item->products->selling_price * $item->prod_qty;
        }
        $data = $request->all();
        return response()->json([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address1' => $data['address1'],
            'address2' => $data['address2'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'pincode' => $data['pincode'],
            'total_price' => $total_price,
        ]);
    }
}

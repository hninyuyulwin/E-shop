@extends('layouts.frontend')

@section('title', 'Products Checkout')

@section('content')
    <div class="py-3 mt-5 mb-4 shadow-sm border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ route('index') }}" style="text-decoration: none;color: inherit;">
                    Home /
                </a>
                <a href="{{ route('checkout') }}" style="text-decoration: none;color: inherit;">
                    Checkout
                </a>
            </h6>
        </div>
    </div>
    <form action="{{ route('place-order') }}" method="post">
        @csrf
        <div class="row my-5">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h5>Basic Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row checkout-form">
                            <div class="col-md-6 mb-3">
                                <label for="">First Name :</label>
                                <input type="text" name="fname" value="{{ Auth::user()->name }}"
                                    class="form-control mt-2" placeholder="Enter First Name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Last Name :</label>
                                <input type="text" name="lname" value="{{ Auth::user()->lname }}"
                                    class="form-control mt-2" placeholder="Enter Last Name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Email :</label>
                                <input type="email" name="email" value="{{ Auth::user()->email }}"
                                    class="form-control mt-2" placeholder="example@example.com">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Phone :</label>
                                <input type="text" name="phone" value="{{ Auth::user()->phone }}"
                                    class="form-control mt-2" placeholder="09656265659">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Address 1 :</label>
                                <input type="text" name="address1" value="{{ Auth::user()->address1 }}"
                                    class="form-control mt-2" placeholder="Address 1">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Address 2 :</label>
                                <input type="text" name="address2" value="{{ Auth::user()->address2 }}"
                                    class="form-control mt-2" placeholder="Address 2">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">City :</label>
                                <input type="text" name="city" value="{{ Auth::user()->city }}"
                                    class="form-control mt-2" placeholder="Enter City Name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">State :</label>
                                <input type="text" name="state" value="{{ Auth::user()->state }}"
                                    class="form-control mt-2" placeholder="Enter State Name">
                            </div>
                            <div class="col-md-6">
                                <label for="">Country :</label>
                                <input type="text" name="country" value="{{ Auth::user()->country }}"
                                    class="form-control mt-2" placeholder="Enter Country Name">
                            </div>
                            <div class="col-md-6">
                                <label for="">Pin Code :</label>
                                <input type="text" name="pincode" value="{{ Auth::user()->pincode }}"
                                    class="form-control mt-2" placeholder="Enter Pin Code">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Order Details</h5>
                    </div>
                    @if ($cartItems->count() > 0)
                        <div class="card-body">
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($cartItems as $item)
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="{{ asset('assets/uploads/product/' . $item->products->image) }}"
                                            width="100">
                                    </div>
                                    <div class="col-md-3">
                                        <h6>{{ $item->products->name }}</h6>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Qty : {{ $item->prod_qty }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>{{ number_format($item->products->selling_price * $item->prod_qty) }} MMK</p>
                                    </div>
                                </div>
                                <hr>
                                @php
                                    $total += $item->products->selling_price * $item->prod_qty;
                                @endphp
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <h6 class="text-primary">Total Price : <span class="float-end">{{ number_format($total) }}
                                    MMK</span>
                            </h6>
                            <button type="submit" class="btn btn-success float-end mt-3">Place Order</button>
                        </div>
                    @else
                        <div class="card-body text-center">
                            <h3>No products in cart <i class="fa fa-shopping-cart"></i></h3>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </form>
@endsection

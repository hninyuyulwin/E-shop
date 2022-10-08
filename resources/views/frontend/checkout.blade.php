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
                                    class="form-control firstname mt-2" placeholder="Enter First Name">
                                <span id="fname_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Last Name :</label>
                                <input type="text" name="lname" value="{{ Auth::user()->lname }}"
                                    class="form-control lastname mt-2" placeholder="Enter Last Name">
                                <span id="lname_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Email :</label>
                                <input type="email" name="email" value="{{ Auth::user()->email }}"
                                    class="form-control email mt-2" placeholder="example@example.com">
                                <span id="email_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Phone :</label>
                                <input type="text" name="phone" value="{{ Auth::user()->phone }}"
                                    class="form-control phone mt-2" placeholder="09656265659">
                                <span id="phone_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Address 1 :</label>
                                <input type="text" name="address1" value="{{ Auth::user()->address1 }}"
                                    class="form-control address1 mt-2" placeholder="Address 1">
                                <span id="address1_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Address 2 :</label>
                                <input type="text" name="address2" value="{{ Auth::user()->address2 }}"
                                    class="form-control address2 mt-2" placeholder="Address 2">
                                <span id="address2_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">City :</label>
                                <input type="text" name="city" value="{{ Auth::user()->city }}"
                                    class="form-control city mt-2" placeholder="Enter City Name">
                                <span id="city_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">State :</label>
                                <input type="text" name="state" value="{{ Auth::user()->state }}"
                                    class="form-control state mt-2" placeholder="Enter State Name">
                                <span id="state_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Country :</label>
                                <input type="text" name="country" value="{{ Auth::user()->country }}"
                                    class="form-control country mt-2" placeholder="Enter Country Name">
                                <span id="country_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Pin Code :</label>
                                <input type="text" name="pincode" value="{{ Auth::user()->pincode }}"
                                    class="form-control pincode mt-2" placeholder="Enter Pin Code">
                                <span id="pincode_error" class="text-danger"></span>
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
                            <input type="hidden" name="payment_mode" value="COD">
                            <button type="submit" class="btn btn-block btn-success w-100 mt-3">Place Order |
                                COD</button>
                            <button type="button" class="btn btn-primary w-100 my-3 razorpay_btn">Pay with Razor</button>
                            <div id="paypal-button-container"></div>
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
@section('scripts')
    <script src="https://www.paypal.com/sdk/js?client-id=AWxELts5XRoe4bUB0jLCkdJvdDI-Y7J_CPijRZjmAeccoG8UFxUPYZs33LzuTc55WBgGWdpXCT542ZDM
                                                                                    "></script>

    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $total }}'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    // This function shows a transaction success message to your buyer.
                    //alert('Transaction completed by ' + details.payer.name.given_name);

                    var firstname = $(".firstname").val();
                    var lastname = $(".lastname").val();
                    var email = $(".email").val();
                    var phone = $(".phone").val();
                    var address1 = $(".address1").val();
                    var address2 = $(".address2").val();
                    var city = $(".city").val();
                    var state = $(".state").val();
                    var country = $(".country").val();
                    var pincode = $(".pincode").val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        method: 'POST',
                        url: '/place-order',
                        data: {
                            'fname': firstname,
                            'lname': lastname,
                            'email': email,
                            'phone': phone,
                            'address1': address1,
                            'address2': address2,
                            'city': city,
                            'state': state,
                            'country': country,
                            'pincode': pincode,
                            'payment_mode': 'Paid By Paypal',
                            'payment_id': details.id,
                        },
                        success: function(response) {
                            swal(response.status)
                                .then((value) => {
                                    window.location.href = "{{ route('my-orders') }}";
                                });
                        }
                    });
                });
            }
        }).render('#paypal-button-container');
        //This function displays payment buttons on your web page.
    </script>
@endsection

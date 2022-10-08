@extends('layouts.frontend')

@section('title', 'My Cart')

@section('content')
    <div class="py-3 mt-5 mb-4 shadow-sm border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ route('index') }}" style="text-decoration: none;color: inherit;">
                    Home /
                </a>
                <a href="{{ route('cart') }}" style="text-decoration: none;color: inherit;">
                    Cart
                </a>
            </h6>
        </div>
    </div>
    <div class="container my-5">

        <div class="card shadow cartitems">
            @if ($cartItem->count() > 0)
                <div class="card-body">
                    @php
                        $total = 0;
                    @endphp
                    @forelse ($cartItem as $item)
                        <div class="row my-3 product_data">
                            <input type="hidden" value="{{ $item->prod_id }}" class="prod_id">
                            <div class="col-md-3">
                                <img src="{{ asset('assets/uploads/product/' . $item->products->image) }}"
                                    alt="Product-Image" width="250">
                            </div>
                            <div class="col-md-4">
                                <h6>{{ $item->products->name }}
                                    <span class="float-end">Price : <b>{{ number_format($item->products->selling_price) }}
                                            MMK</b>
                                    </span>
                                </h6>
                            </div>
                            <div class="col-md-3">
                                <input type="hidden" value="" class="prod_id">
                                @if ($item->products->qty >= $item->prod_qty)
                                    <label>Quantity</label>
                                    <div class="input-group text-center my-2">
                                        <button class="input-group-text decrement-btn productQty">-</button>
                                        <input type="text" class="form-control text-center qty-input" readonly="readonly"
                                            name="quantity" value="{{ $item->prod_qty }}">
                                        <button class="input-group-text increment-btn productQty">+</button>
                                    </div>
                                    @php
                                        $total += $item->products->selling_price * $item->prod_qty;
                                    @endphp
                                @else
                                    <div class="badge bg-danger text-center">Out of Stock</div>
                                @endif

                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-danger mt-4 delete-cart-item"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>

                        <hr>
                    @empty
                        <div class="alert alert-danger text-center">
                            <h4>No Products Here!!Please Buy Something</h4>
                        </div>
                    @endforelse
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-7">
                                <h6>
                                    Total Price :
                                    <b class="float-end">{{ number_format($total) }} MMK</b>
                                </h6>
                            </div>
                            <div class="col-md-5">
                                <a href="{{ route('checkout') }}" class="btn btn-info float-end">Proceed to Checkout</a>
                            </div>
                        </div>


                    </div>
                </div>
            @else
                <div class="card-body text-center">
                    <h2>Your <i class="fa fa-shopping-cart"></i> Cart is Empty</h2>
                    <a href="{{ route('category') }}" class="btn btn-info float-end">Continue Shopping</a>
                </div>
            @endif

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            //increment Button
            //$(".increment-btn").click(function(e) {
            $(document).on('click', '.increment-btn', function(e) {
                e.preventDefault();

                var quantity = "{{ $item->products->qty }}";
                var inc_val = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(inc_val);
                value = isNaN(value) ? 0 : value;
                if (value < quantity) {
                    value++;
                    //$(".qty-input").val(value);
                    $(this).closest('.product_data').find('.qty-input').val(value);
                }
            });

            //Decrement Button
            //$(".decrement-btn").click(function(e) {
            $(document).on('click', '.decrement-btn', function(e) {
                e.preventDefault();
                var quantity = "{{ $item->products->qty }}";
                var dec_val = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(dec_val);
                value = isNaN(value) ? 0 : value;
                if (value > 1) {
                    value--;
                    $(this).closest('.product_data').find('.qty-input').val(value);
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //delete
            //$('.delete-cart-item').click(function(e) {
            $(document).on('click', '.delete-cart-item', function(e) {
                e.preventDefault();

                var product_id = $(this).closest('.product_data').find('.prod_id').val();

                $.ajax({
                    method: 'DELETE',
                    url: "{{ route('delete-cart-item') }}",
                    data: {
                        'product_id': product_id,
                    },
                    success: function(response) {
                        //window.location.reload();
                        $('.cartitems').load(location.href + " .cartitems");
                        swal("", response.status, "success");
                    }
                });
            });

            //quantityCalculate
            //$(".productQty").click(function(e) {
            $(document).on('click', '.productQty', function(e) {
                e.preventDefault();

                var product_id = $(this).closest('.product_data').find('.prod_id').val();
                var product_qty = $(this).closest('.product_data').find('.qty-input').val();

                $.ajax({
                    method: "PUT",
                    url: "{{ route('updateQtyCalc') }}",
                    data: {
                        "product_id": product_id,
                        "product_qty": product_qty
                    },
                    success: function(response) {
                        //window.location.reload();
                        $('.cartitems').load(location.href + " .cartitems");
                    }
                })
            });
        });
    </script>
@endsection

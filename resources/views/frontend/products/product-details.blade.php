@extends('layouts.frontend')

@section('title', 'KIWI | Product_Details')

@section('content')
    <div class="py-3 mt-5 mb-4 shadow-sm border-top">
        <div class="container">
            <h6 class="mb-0">
                Collections /
                <a href="{{ route('fetch_product_byCat', $products->category->slug) }}"
                    style="text-decoration: none;color: inherit;">
                    {{ $products->category->name }}
                </a>
                / {{ $products->name }}
            </h6>
        </div>
    </div>

    <div class="container">

        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <img src="{{ asset('assets/uploads/product/' . $products->image) }}" alt="Product-Image"
                            width="350">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0">
                            {{ $products->name }}
                            @if ($products->trending == '1')
                                <label style="font-size: 16px;"
                                    class="float-end badge bg-danger trending_tag">Trending</label>
                            @endif
                        </h2>
                        <hr>
                        <label class="me-3 mb-3">Original Price :
                            <s class="text-danger">{{ number_format($products->original_price) }} MMK</s>
                        </label><br>
                        <label class="fw-bold">Selling Price : {{ number_format($products->selling_price) }} MMK</label>
                        <p class="text-primary mt-3">Stock Quantity : {{ $products->qty }}</p>
                        <p class="mt-3">
                            {{ $products->description }}
                        </p>
                        <hr>
                        @if ($products->qty > 0)
                            <label class="badge bg-success">In Stock</label>
                            <div class="row mt-2">
                                <div class="col-md-2">
                                    <input type="hidden" value="{{ $products->id }}" class="prod_id">
                                    <label>Quantity</label>
                                    <div class="input-group text-center mb-3">
                                        <button class="input-group-text decrement-btn">-</button>
                                        <input type="text" class="form-control text-center qty-input" readonly="readonly"
                                            name="quantity" value="1">
                                        <button class="input-group-text increment-btn">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <button type="button" class="addToCartBtn btn btn-primary me-3 float-start">
                                    <i class="fa fa-shopping-cart mr-2"></i>
                                    Add to cart
                                </button>
                            </div>
                        @else
                            <div class="badge bg-danger mb-4">Out of stock</div>
                        @endif

                        <div class="col-md-10">
                            <button type="button" class="btn btn-success me-3 float-start">
                                <i class="fa fa-heart mr-2"></i>
                                Add to wish list
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            //AddToCart
            $(".addToCartBtn").click(function(e) {
                e.preventDefault();

                var product_id = $(this).closest('.product_data').find('.prod_id').val();
                var product_qty = $(this).closest('.product_data').find('.qty-input').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    url: "{{ route('addToCart') }}",
                    data: {
                        'product_id': product_id,
                        'product_qty': product_qty
                    },
                    success: function(response) {
                        swal(response.status);
                    }
                })
            })

            //increment Button
            $(".increment-btn").click(function(e) {
                e.preventDefault();

                var quantity = "{{ $products->qty }}";
                var inc_val = $(".qty-input").val();
                var value = parseInt(inc_val);
                value = isNaN(value) ? 0 : value;
                if (value < quantity) {
                    value++;
                    $(".qty-input").val(value);
                }
            });

            //Decrement Button
            $(".decrement-btn").click(function(e) {
                e.preventDefault();
                var quantity = "{{ $products->qty }}";
                var dec_inp = $(".qty-input").val();
                var value = parseInt(dec_inp);
                value = isNaN(value) ? 0 : value;
                if (value > 1) {
                    value--;
                    $(".qty-input").val(value);
                }
            });

        });
    </script>
@endsection

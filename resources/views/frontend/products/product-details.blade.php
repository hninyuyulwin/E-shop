@extends('layouts.frontend')

@section('title', 'KIWI | Product_Details')
@section('styles')
    <style>
        /* rating */
        .rating-css div {
            padding: 20px 0;
            color: #ffe400;
            font-family: sans-serif;
            font-size: 30px;
            font-weight: 800;
            text-align: center;
            text-transform: uppercase;
        }

        .rating-css input {
            display: none;
        }

        .rating-css input+label {
            font-size: 60px;
            cursor: pointer;
            text-shadow: 1px 1px 0 #8f8420;
        }

        .rating-css input:checked+label~label {
            color: #b4afaf;
        }

        .rating-css label:active {
            transform: scale(0.8);
            transition: 0.3s ease;
        }

        .checked {
            color: #ffe400;
        }

        /* End of Star Rating */
    </style>
@endsection
@section('content')

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('add-rating') }}" method="POST">
                    @csrf
                    <input type="hidden" name="prod_id" value="{{ $products->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rate {{ $products->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">
                                @if ($user_rating)
                                    @for ($i = 1; $i <= $user_rating->stars_rated; $i++)
                                        <input type="radio" value="{{ $i }}" name="product_rating" checked
                                            id="rating{{ $i }}">
                                        <label for="rating{{ $i }}" class="fa fa-star"></label>
                                    @endfor
                                    @for ($j = $user_rating->stars_rated + 1; $j <= 5; $j++)
                                        <input type="radio" value="{{ $j }}" name="product_rating"
                                            id="rating{{ $j }}">
                                        <label for="rating{{ $j }}" class="fa fa-star"></label>
                                    @endfor
                                @else
                                    <input type="radio" value="1" name="product_rating" checked id="rating1">
                                    <label for="rating1" class="fa fa-star"></label>
                                    <input type="radio" value="2" name="product_rating" id="rating2">
                                    <label for="rating2" class="fa fa-star"></label>
                                    <input type="radio" value="3" name="product_rating" id="rating3">
                                    <label for="rating3" class="fa fa-star"></label>
                                    <input type="radio" value="4" name="product_rating" id="rating4">
                                    <label for="rating4" class="fa fa-star"></label>
                                    <input type="radio" value="5" name="product_rating" id="rating5">
                                    <label for="rating5" class="fa fa-star"></label>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

        <div class="card my-5 shadow product_data">
            <div class="card-body mt-3">
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
                        <label class="fw-bold mb-2">Selling Price : {{ number_format($products->selling_price) }}
                            MMK</label>
                        @php
                            $rateNumber = number_format($rating_value);
                        @endphp
                        <div class="rating border-top border-bottom p-2">
                            @for ($i = 1; $i <= $rateNumber; $i++)
                                <i class="fa fa-star checked"></i>
                            @endfor
                            @for ($j = $rateNumber + 1; $j <= 5; $j++)
                                <i class="fa fa-star"></i>
                            @endfor
                            <span>
                                @if ($ratings->count() > 0)
                                    {{ number_format($rating_value) }} ratings
                                @else
                                    No rating
                                @endif
                            </span>
                        </div>

                        <p class="text-primary mt-3">Stock Quantity : {{ $products->qty }}</p>
                        <p class="mt-3">
                            {{ $products->small_description }}
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
                                        <input type="text" class="form-control text-center qty-input"
                                            readonly="readonly" name="quantity" value="1">
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
                            <button type="button" class="btn btn-success me-3 float-start addToWishlist">
                                <i class="fa fa-heart mr-2"></i>
                                Add to wish list
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-md-8 offset-md-2 mb-3">
                    <h5>Description</h5>
                    <p class="mt-3">{{ $products->description }}</p>
                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Rating this product
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //AddToCart
            $(".addToCartBtn").click(function(e) {
                e.preventDefault();

                var product_id = $(this).closest('.product_data').find('.prod_id').val();
                var product_qty = $(this).closest('.product_data').find('.qty-input').val();


                $.ajax({
                    method: 'POST',
                    url: "{{ route('addToCart') }}",
                    data: {
                        'product_id': product_id,
                        'product_qty': product_qty
                    },
                    success: function(response) {
                        swal(response.status);
                        loadCount();
                    }
                })
            })

            //AddToWishlist
            $(".addToWishlist").click(function(e) {
                e.preventDefault();

                var product_id = $(this).closest('.product_data').find('.prod_id').val();

                $.ajax({
                    method: 'POST',
                    url: "{{ route('addToWishlist') }}",
                    data: {
                        'product_id': product_id,
                    },
                    success: function(response) {
                        swal(response.status);
                        loadWishlist();
                    }
                });
            });

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

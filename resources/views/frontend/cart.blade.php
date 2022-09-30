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

        <div class="card shadow ">
            <div class="card-body">
                @forelse ($cartItem as $item)
                    <div class="row my-3 product_data">
                        <input type="hidden" value="{{ $item->prod_id }}" class="prod_id">
                        <div class="col-md-3">
                            <img src="{{ asset('assets/uploads/product/' . $item->products->image) }}" alt="Product-Image"
                                width="250">
                        </div>
                        <div class="col-md-4">
                            <h5>{{ $item->products->name }}</h5>
                            <p>Price : <b>{{ number_format($item->products->selling_price) }} MMK</b></p>
                        </div>
                        <div class="col-md-3">
                            <input type="hidden" value="" class="prod_id">
                            <label>Quantity</label>
                            <div class="input-group text-center my-2">
                                <button class="input-group-text decrement-btn">-</button>
                                <input type="text" class="form-control text-center qty-input" readonly="readonly"
                                    name="quantity" value="{{ $item->prod_qty }}">
                                <button class="input-group-text increment-btn">+</button>
                            </div>
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

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            //increment Button
            $(".increment-btn").click(function(e) {
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
            $(".decrement-btn").click(function(e) {
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

            //delete
            $('.delete-cart-item').click(function(e) {
                e.preventDefault();

                var product_id = $(this).closest('.product_data').find('.prod_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'DELETE',
                    url: "{{ route('delete-cart-item') }}",
                    data: {
                        'product_id': product_id,
                    },
                    success: function(response) {
                        window.location.reload();
                        swal("", response.status, "success");
                    }
                });
            });
        });
    </script>
@endsection

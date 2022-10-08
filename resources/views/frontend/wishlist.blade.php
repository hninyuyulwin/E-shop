@extends('layouts.frontend')

@section('title', 'Wishlist')

@section('content')
    <div class="py-3 mt-5 mb-4 shadow-sm border-top">
        <div class="container">
            <div class="mb-0">
                <a href="{{ route('index') }}" style="color: inherit;text-decoration: none;">Home / </a>
                <a href="{{ route('wishlist') }}" style="color: inherit;text-decoration: none;">Wishlist </a>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="card shadow wishlistitems">
            <div class="card-header">
                <h4>My Wishlist</h4>
            </div>
            <div class="card-body">
                @if ($wishlist->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wishlist as $item)
                                <tr class="product_data">
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <img src="{{ asset('assets/uploads/product/' . $item->products->image) }}"
                                            width="100" alt="">
                                    </td>
                                    <td>{{ $item->products->name }}</td>
                                    <td>{{ number_format($item->products->selling_price) }} MMK</td>
                                    <td>
                                        <input type="hidden" value="{{ $item->prod_id }}" class="prod_id">
                                        @if ($item->products->qty > 0)
                                            <div class="badge bg-success">In Stock {{ $item->products->qty }} Qty</div>
                                        @else
                                            <div class="badge bg-danger">Out of Stock</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void" class="btn btn-primary addToCart"><i
                                                class="fa fa-shopping-cart me-1"></i>Add
                                            to Cart</a>
                                        <a href="javascript:void" class="btn btn-danger remove-whislist"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger text-center">No Products in Your Wishlist</div>
                @endif
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
            $(".addToCart").click(function(e) {
                e.preventDefault();

                var product_id = $(this).closest('.product_data').find('.prod_id').val();

                $.ajax({
                    method: 'POST',
                    url: "{{ route('addToCart') }}",
                    data: {
                        'product_id': product_id,
                        'product_qty': 1
                    },
                    success: function(response) {
                        swal(response.status);
                        loadWishlist();
                    }
                });
            });

            //$(".remove-whislist").click(function(e) {
            $(document).on('click', '.remove-whislist', function(e) {
                e.preventDefault();

                var product_id = $(this).closest('.product_data').find('.prod_id').val();
                $.ajax({
                    method: "DELETE",
                    url: "{{ route('wishlistDelete') }}",
                    data: {
                        'id': product_id,
                    },
                    success: function(response) {
                        //window.location.reload();
                        $('.wishlistitems').load(location.href + " .wishlistitems");
                        swal(response.status);
                    }
                })
            });
        });
    </script>
@endsection

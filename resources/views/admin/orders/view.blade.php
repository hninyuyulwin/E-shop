@extends('layouts.admin')

@section('title', 'Kiwi | User-View-Orders')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Order Details View
                    <a href="{{ route('orders') }}" class="btn btn-info float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Shipping Details</h4>
                        <hr>
                        <label for="">First Name</label>
                        <div class="border p-2">{{ $orders->fname }}</div><br>
                        <label for="">Last Name</label>
                        <div class="border p-2">{{ $orders->lname }}</div><br>
                        <label for="">E-mail</label>
                        <div class="border p-2">{{ $orders->email }}</div><br>
                        <label for="">Contact Number</label>
                        <div class="border p-2">{{ $orders->phone }}</div><br>
                        <label for="">Shipping Address</label>
                        <div class="border p-2">
                            {{ $orders->address1 }},
                            {{ $orders->address2 }},
                            {{ $orders->city }},
                            {{ $orders->state }},
                            {{ $orders->country }}
                        </div><br>
                        <label for="">Zip Code</label>
                        <div class="border p-2">{{ $orders->pincode }}</div><br>
                    </div>
                    <div class="col-md-6">
                        <h4>Order Details</h4>
                        <hr>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders->orderitems as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('assets/uploads/product/' . $item->products->image) }}"
                                                alt="Product-Image" width="100">
                                        </td>
                                        <td>{{ $item->products->name }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>
                                            {{ number_format($item->price) }} MMK
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h6>Grand Total : <span class="float-end">{{ number_format($orders->total_price) }} MMK</span>
                        </h6>
                        <hr>
                        <form action="{{ route('update-order-status', $orders->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <label for="" class="mt-3 fw-bold">User's Order Status</label>
                            <select class="form-select p-2" name="status">
                                <option>Chosse User's Orders Status</option>
                                <option value="0" {{ $orders->status == '0' ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option value="1" {{ $orders->status == '1' ? 'selected' : '' }}>
                                    Delivered
                                </option>
                            </select>
                            <button type="submit" class="btn btn-success mt-3">Submit</button>
                        </form>

                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection


@extends('layouts.frontend')

@section('title', 'My Orders')

@section('content')
    <div class="row my-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>My Orders</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>Tracking Number</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                <tr>
                                    <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                    <td>{{ $item->tracking_no }}</td>
                                    <td>{{ number_format($item->total_price) }} MMK</td>
                                    <td>
                                        @if ($item->status == 0)
                                            <div class="badge bg-warning">Pending</div>
                                        @else
                                            <div class="badge bg-success">Delivered</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('view-order', $item->id) }}" class="btn btn-primary">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

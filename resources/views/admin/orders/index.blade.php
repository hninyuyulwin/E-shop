@extends('layouts.admin')

@section('title', 'Kiwi | User-Orders')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>User's New Orders
                    <a href="{{ route('order-histroy') }}" class="btn btn-success float-end">Order History</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Order Date</th>
                            <th>Tracking Number</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $id = 1;
                        @endphp
                        @foreach ($orders as $item)
                            <tr>
                                <td>{{ $id }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                <td>{{ $item->tracking_no }}</td>
                                <td>{{ number_format($item->total_price) }} MMK</td>
                                <td>
                                    @if ($item->status == '0')
                                        <div class="badge bg-warning">Pending</div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('view-order', $item->id) }}" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                            @php
                                $id++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

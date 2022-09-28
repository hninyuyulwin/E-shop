@extends('layouts.admin')

@section('content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3>Product List</h3>
        <a href="{{ route('addProduct') }}" class="btn btn-success" style="float: right;">Create Product</a>
      </div>
      <div class="card-body">
        {{--@if (session('status'))
          <div class="alert alert-success text-white">{{ session('status') }}</div>
        @endif--}}
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Category</th>
              <th>Name</th>
              <th>Selling Price</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product)
            <tr>
              <td>{{ $product->id }}</td>
              <td>{{ $product->category->name }}</td>
              <td>{{ $product->name }}</td>
              <td>{{ $product->selling_price }}</td>
              <td>
                <img src="{{ asset('assets/uploads/product/'.$product->image) }}" width="150">
              </td>
              <td>
                <a href="{{ route('editProduct',$product) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('deleteProduct',$product) }}" class="btn btn-danger">Delete</a>
              </td>
            </tr>
              
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
@endsection
@extends('layouts.frontend')

@section('title')
  {{ $category->name }}
@endsection
@section('content')
  @include('layouts.inc.slider')

  
  <div class="py-5">
    <div class="container">
      <h2 class="text-success mb-5">{{  $category->name  }} Related Products</h2>
      <div class="row">
          @forelse ($products as $product)
          <div class="col-md-4 mb-3">z
            <div class="card">
              <img src="{{ asset('assets/uploads/product/'.$product->image) }}" height="200">
            </div>
            <div class="card-body">
              <h5>{{ $product->name }}</h5>
              <p class="float-end text-danger">
                <s>{{ number_format($product->original_price) }} MMK</s>
              </p> 
              <p class="float-start">{{ number_format($product->selling_price) }} MMK</p> 
              <br><br>
              <p>{{ $product->description }}</p>
            </div>
          </div>
          @empty
          <div class="alert alert-danger text-center"><h3>No Related Products Available!!</h3> </div>
          @endforelse
      </div>
      <hr>
    </div>
  </div>

@endsection
@extends('layouts.frontend')

@section('title','KIWI | E-commerce')

@section('content')
  @include('layouts.inc.slider')
  
  <div class="py-5">
    <div class="container">
      <h2 class="text-success mb-5">Featured Products</h2>
      <div class="row">
        <div class="owl-carousel owl-theme">
          @foreach ($feature_products as $fp)
          <div class="item">
            <div class="card">
              <img src="{{ asset('assets/uploads/product/'.$fp->image) }}" height="200">
            </div>
            <div class="card-body">
              <h5>{{ $fp->name }}</h5>
              <p class="float-end text-danger">
                <s>{{ number_format($fp->original_price) }} MMK</s>
              </p> 
              <p class="float-start">{{ number_format($fp->selling_price) }} MMK</p> 
            </div>
          </div>
          @endforeach
        </div>
        
      </div>
      <hr>
    </div>
  </div>

  
  <div class="pb-5">
    <div class="container">
      <h2 class="text-success mb-5">Trending Categories</h2>
      <div class="row">
        <div class="owl-carousel owl-theme">
          @foreach ($trending_cat as $tc)
          <a href="{{ route('fetch_product_byCat',$tc) }}" class="text-dark" style="text-decoration: none;">
            <div class="item">
              <div class="card">
                <img src="{{ asset('assets/uploads/category/'.$tc->image) }}" height="200">
              </div>
              <div class="card-body">
                <h5>{{ $tc->name }}</h5>
                <p>{{ Str::limit($tc->description,80,'...') }}</p>
              </div>
            </div>
          </a>
          @endforeach
        </div>
        
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script>
    $('.owl-carousel').owlCarousel({
      loop:true,
      margin:10,
      nav:true,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:3
          }
      }
    });
  </script>
@endsection
@extends('layouts.frontend')

@section('title','KIWI | Categories')

@section('content')
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="mb-4">All Categories</h2>
          <div class="row">
            @foreach ($category as $cat)
              <div class="col-md-4 mb-3">
                <a href="{{ route('fetch_product_byCat',$cat->slug) }}" style="text-decoration: none;color: #000;">
                  <div class="card">
                    <img src="{{ asset('assets/uploads/category/'.$cat->image) }}" alt="Category Image" height="250">
                    <div class="card-body">
                      <h5>{{ $cat->name }}</h5>
                      <p>{{ Str::limit($cat->description, '150', '...') }}</p>
                    </div>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
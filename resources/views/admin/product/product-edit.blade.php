@extends('layouts.admin')

@section('content')
  <div class="card">
    <div class="card-header">
      <h3>Edit Prducts</h3>
      <a href="{{ route('products') }}" class="btn btn-info" style="float: right;">Back</a>   
    </div>
    <div class="card-body">
      <form action="{{ route('updateProduct',$products) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
        <div class="col-md-12 mb-3">
          <label for="">Select Categories</label>
          <select name="cate_id" class="form-select">
            <option value="">Choose Categories</option>
            @foreach ($categories as $cat)
              <option value="{{ $cat->id }}" {{ $cat->id == $products->cate_id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach            
          </select>
        </div>
        <div class="col-md-12 mb-3">
          <label for="name">Product Name</label>
          <input type="text" name="name" id="name" value="{{ $products->name }}" class="form-control" placeholder="Enter category name">
        </div>
        <div class="col-md-6 mb-3">
          <label for="small_description">Small Description</label>
          <textarea name="small_description" id="small_description" class="form-control bordered" rows="5">{{ $products->small_description }}</textarea>
        </div>
        <div class="col-md-6 mb-3">
          <label for="description">Description</label>
          <textarea name="description" id="description" class="form-control bordered" rows="5">{{ $products->description }}</textarea>
        </div>
        <div class="col-md-6 mb-3">
          <label for="original_price">Original Price</label>
          <input type="number" name="original_price" value="{{ $products->original_price }}" id="original_price" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
          <label for="selling_price">Selling Price</label>
          <input type="number" name="selling_price" value="{{ $products->selling_price }}" id="selling_price" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
          <label for="tax">Tax</label>
          <input type="number" name="tax"  value="{{ $products->tax }}"  id="tax" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
          <label for="qty">Quantity</label>
          <input type="number" name="qty" value="{{ $products->qty }}"  id="qty" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
          <label for="status">Status</label><br>
          <input type="checkbox" {{ $products->status == '1' ? 'checked' : '' }} name="status" id="status">
        </div>
        <div class="col-md-6 mb-3">
          <label for="trending">Trending</label><br>
          <input type="checkbox" {{ $products->trending == '1' ? 'checked' : '' }} name="trending" id="trending">
        </div>
        <div class="col-md-12 mb-3">
          <label for="meta_title">Meta Title</label>
          <input type="text" name="meta_title" value="{{ $products->meta_title }}" id="meta_title" class="form-control">
        </div>
        <div class="col-md-12 mb-3">
          <label for="meta_keywords">Meta Keywords</label>
          <textarea name="meta_keywords" id="meta_keywords" class="form-control bordered" rows="5">{{ $products->meta_keywords }}</textarea>
        </div>
        <div class="col-md-12 mb-3">
          <label for="meta_description">Meta Description</label>
          <textarea name="meta_description" id="meta_description" class="form-control bordered" rows="5">{{ $products->meta_description }}</textarea>
        </div>
        <div class="col-md-12 mb-3">
          <label for="image">Image</label><br>
          @if ($products->image)
            <img src="{{ asset('assets/uploads/product/'.$products->image) }}" alt="Products Image" width="150"><br><br>
          @endif
          <input type="file" name="image" id="image" >
        </div>
      </div>
        <hr>
        <button type="submit" class="btn btn-warning mt-3">Update</button>
      </form>
    </div>
  </div>
@endsection
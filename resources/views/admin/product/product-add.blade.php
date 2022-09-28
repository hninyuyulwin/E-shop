@extends('layouts.admin')

@section('content')
  <div class="card">
    <div class="card-header">
      <h3>Add Prducts</h3>
      <a href="{{ route('products') }}" class="btn btn-info" style="float: right;">Back</a>   
    </div>
    <div class="card-body">
      <form action="{{ route('storeProduct') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
        <div class="col-md-12 mb-3">
          <label for="">Select Categories</label>
          <select name="cate_id" class="form-select">
            <option value="">Choose Categories</option>
            @foreach ($categories as $cat)
              <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach            
          </select>
        </div>
        <div class="col-md-12 mb-3">
          <label for="name">Product Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name">
        </div>
        <div class="col-md-6 mb-3">
          <label for="small_description">Small Description</label>
          <textarea name="small_description" id="small_description" class="form-control bordered" rows="5"></textarea>
        </div>
        <div class="col-md-6 mb-3">
          <label for="description">Description</label>
          <textarea name="description" id="description" class="form-control bordered" rows="5"></textarea>
        </div>
        <div class="col-md-6 mb-3">
          <label for="original_price">Original Price</label>
          <input type="number" name="original_price" id="original_price" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
          <label for="selling_price">Selling Price</label>
          <input type="number" name="selling_price" id="selling_price" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
          <label for="tax">Tax</label>
          <input type="number" name="tax" id="tax" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
          <label for="qty">Quantity</label>
          <input type="number" name="qty" id="qty" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
          <label for="status">Status</label><br>
          <input type="checkbox" name="status" id="status">
        </div>
        <div class="col-md-6 mb-3">
          <label for="trending">Trending</label><br>
          <input type="checkbox" name="trending" id="trending">
        </div>
        <div class="col-md-12 mb-3">
          <label for="meta_title">Meta Title</label>
          <input type="text" name="meta_title" id="meta_title" class="form-control">
        </div>
        <div class="col-md-12 mb-3">
          <label for="meta_keywords">Meta Keywords</label>
          <textarea name="meta_keywords" id="meta_keywords" class="form-control bordered" rows="5"></textarea>
        </div>
        <div class="col-md-12 mb-3">
          <label for="meta_description">Meta Description</label>
          <textarea name="meta_description" id="meta_description" class="form-control bordered" rows="5"></textarea>
        </div>
        <div class="col-md-12 mb-3">
          <label for="image">Image</label><br>
          <input type="file" name="image" id="image" >
        </div>
      </div>
        <hr>
        <button type="submit" class="btn btn-primary mt-3">Create</button>
      </form>
    </div>
  </div>
@endsection
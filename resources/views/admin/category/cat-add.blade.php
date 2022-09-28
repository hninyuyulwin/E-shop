@extends('layouts.admin')

@section('content')
  <div class="card">
    <div class="card-header">
      <h3>Fill Categories</h3>
      <a href="{{ route('categories') }}" class="btn btn-info" style="float: right;">Back</a>   
    </div>
    <div class="card-body">
      <form action="{{ route('storeCat') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
        <div class="col-md-12">
          <label for="name">Cateogry Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name">
        </div>
        <div class="col-md-12">
          <label for="description">Description</label>
          <textarea name="description" id="description" class="form-control bordered" rows="5"></textarea>
        </div>
        <div class="col-md-6">
          <label for="status">Status</label><br>
          <input type="checkbox" name="status" id="status">
        </div>
        <div class="col-md-6">
          <label for="popular">Popular</label><br>
          <input type="checkbox" name="popular" id="popular">
        </div>
        <div class="col-md-12">
          <label for="meta_title">Meta Title</label>
          <input type="text" name="meta_title" id="meta_title" class="form-control">
        </div>
        <div class="col-md-12">
          <label for="meta_keywords">Meta Keywords</label>
          <textarea name="meta_keywords" id="meta_keywords" class="form-control bordered" rows="5"></textarea>
        </div>
        <div class="col-md-12">
          <label for="meta_description">Meta Description</label>
          <textarea name="meta_description" id="meta_description" class="form-control bordered" rows="5"></textarea>
        </div>
        <div class="col-md-12">
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
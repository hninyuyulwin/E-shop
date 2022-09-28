@extends('layouts.admin')

@section('content')
  <div class="card">
    <div class="card-header">
      <h3>Update Categories Data</h3>
      <a href="{{ route('categories') }}" class="btn btn-info" style="float: right;">Back</a> 
    </div>
    <div class="card-body">
      <form action="{{ route('updateCart',$categories) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
        <div class="col-md-12">
          <label for="name">Cateogry Name</label>
          <input type="text" name="name" id="name" value="{{ old('name',$categories->name) }}" class="form-control" placeholder="Enter category name">
        </div>
        <div class="col-md-12">
          <label for="description">Description</label>
          <textarea name="description" id="description" class="form-control bordered" rows="5">{{ old('description',$categories->description) }}</textarea>
        </div>
        <div class="col-md-6">
          <label for="status">Status</label><br>
          <input type="checkbox" {{ $categories->status == '1' ? 'checked' : '' }} name="status" id="status">
        </div>
        <div class="col-md-6">
          <label for="popular">Popular</label><br>
          <input type="checkbox" {{ $categories->popular == '1' ? 'checked' : '' }} name="popular" id="popular">
        </div>
        <div class="col-md-12">
          <label for="meta_title">Meta Title</label>
          <input type="text" name="meta_title" value="{{ old('meta_title',$categories->meta_title) }}" id="meta_title" class="form-control">
        </div>
        <div class="col-md-12">
          <label for="meta_keywords">Meta Keywords</label>
          <textarea name="meta_keywords" id="meta_keywords" class="form-control bordered" rows="5">{{ old('meta_keywords',$categories->meta_keywords) }}</textarea>
        </div>
        <div class="col-md-12">
          <label for="meta_description">Meta Description</label>
          <textarea name="meta_description" id="meta_description" class="form-control bordered" rows="5">{{ old('meta_description',$categories->meta_descrip) }}</textarea>
        </div>
        <div class="col-md-12">
          <label for="image">Image</label><br>
          @if ($categories->image)
            <img src="{{ asset('assets/uploads/category/'.$categories->image) }}" width="150" alt=""><br><br>
          @endif
          <input type="file" name="image" id="image" >
        </div>
      </div>
        <hr>
        <button type="submit" class="btn btn-secondary mt-3">Update</button>
      </form>
    </div>
  </div>
@endsection
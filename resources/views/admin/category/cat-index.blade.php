@extends('layouts.admin')

@section('content')
  <div class="card">
    <div class="card-header">
      <h3>Product Categories List</h3>
      <a href="{{ route('addCat') }}" class="btn btn-success" style="float: right;">Create Category</a>
    </div>
    <div class="card-body">
      {{--@if (session('status'))
        <div class="alert alert-success text-white">{{ session('status') }}</div>
      @endif--}}
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $cat)
          <tr>
            <td>{{ $cat->id }}</td>
            <td>{{ $cat->name }}</td>
            <td>{{ Str::limit($cat->description,80) }}</td>
            <td>
              <img src="{{ asset('assets/uploads/category/'.$cat->image) }}" width="150">
            </td>
            <td>
              <a href="{{ route('editCart',$cat) }}" class="btn btn-warning">Edit</a>
              <a href="{{ route('deleteCart',$cat) }}" class="btn btn-danger">Delete</a>
            </td>
          </tr>
            
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
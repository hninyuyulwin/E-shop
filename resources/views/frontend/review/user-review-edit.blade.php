@extends('layouts.frontend')

@section('title', 'Edit Review Page')

@section('content')
    <div class="row my-5 py-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>You are writing a review for {{ $review->products->name }}</h5>
                    <form action="{{ route('update-review') }}" method="post" class="mt-3">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="review_id" value="{{ $review->id }}">
                        <textarea name="user_review" class="form-control" rows="5">{{ $review->user_review }}</textarea>
                        <button type="submit" class="btn btn-success mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

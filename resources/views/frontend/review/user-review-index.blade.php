@extends('layouts.frontend')

@section('title', 'User Review Page')

@section('content')
    <div class="row my-5 py-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if ($verify_check->count() > 0)
                        <h5>You are writing a review for {{ $product->name }}</h5>
                        <form action="{{ route('post-review') }}" method="post" class="mt-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <textarea name="user_review" class="form-control" rows="5" placeholder="Write a review"></textarea>
                            <button type="submit" class="btn btn-info mt-3">Post</button>
                        </form>
                    @else
                        <div class="alert alert-primary text-center">
                            <h5>Cannot review a product without buying</h5>
                            <p>For the trustworthness, only customers who pruchased a product can give review about the
                                product.</p>
                            <a href="{{ route('index') }}"><i class="fas fa-arrow-left me-2"></i>Go and continue
                                shopping</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('title', 'Kiwi | User Detail View')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>User Details View
                    <a href="{{ route('users') }}" class="btn btn-outline-info float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="fw-bold">Role</label>
                        <div class="p-2 border text-primary">{{ $user->role_as == 1 ? 'Admin' : 'User' }}</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="p-2 border">{{ $user->name }}</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="p-2 border">{{ $user->lname }}</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="p-2 border">{{ $user->email }}</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="p-2 border">{{ $user->phone }}</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="p-2 border">{{ $user->address1 }}</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="p-2 border">{{ $user->address2 }}</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="p-2 border">{{ $user->city }}</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="p-2 border">{{ $user->state }}</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="p-2 border">{{ $user->country }}</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="p-2 border">{{ $user->pincode }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

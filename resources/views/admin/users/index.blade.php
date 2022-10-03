@extends('layouts.admin')

@section('title', 'Kiwi | Registered Users')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Registered Users</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $id = 1;
                        @endphp
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $id }}</td>
                                <td>{{ $user->name . ' ' . $user->lname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    @if ($user->role_as == 1)
                                        <div class="badge bg-info">Admin</div>
                                    @else
                                        <div class="badge bg-success">User</div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('view-user', $user->id) }}" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                            @php
                                $id++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

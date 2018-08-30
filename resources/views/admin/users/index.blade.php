@extends('layouts.admin')

@section('content')
    @if(Session::has('user_crud'))
        <div class="alert alert-{{session('user_crud')['status']}}">
            <strong>{{session('user_crud')['message']}}</strong>
        </div>
    @endif

    <h1 class="text-center">Users</h1>

    @if(!empty($users))
        <div class="options">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create user</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>User Id</th>
                    <th>Photo</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><img src="{{ $user->photo ? $user->photo->file : 'http://placehold.it/400x400' }}" height="50" alt=""></td>
                            <td>
                                <a href="{{ route('admin.users.edit', [$user->id]) }}">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>{!! $user->is_active ? 'Active' : 'Blocked' !!}</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>{{ $user->updated_at->diffForHumans() }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Options
                                        <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('admin.users.edit', [$user->id]) }}">Edit</a></li>
                                        <li><a href="{{ route('admin.user.delete', [$user->id]) }}">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                    @endforeach

            </tbody>
        </table>
    @else
        <p class="text-center">Please create at leas one <b><a href="{{ route('admin.users.create') }}">user</a></b></p>
    @endif
@endsection
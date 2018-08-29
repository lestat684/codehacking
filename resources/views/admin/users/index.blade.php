@extends('layouts.admin')

@section('content')
    <h1>Users</h1>
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
            @endforeach
        </tbody>
    </table>
@endsection
@extends('layouts.admin')

@section('content')

    @if(Session::has('message'))
        <div class="alert alert-{{session('message')['status']}}">
            <strong>{{session('message')['message']}}</strong>
        </div>
    @endif

    <h1 class="text-center">Posts</h1>

    <div class="options">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Create post</a>
    </div>


    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Image</th>
            <th>Title</th>
            <th>Content</th>
            <th>Author</th>
            <th>Category</th>
            <th>Created</th>
            <th>Updated</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @if($posts)
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td><img src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/400x400' }}" height="50" alt=""></td>
                        <td>{{ $post->title }}</td>
                        <td>{{ str_limit($post->body, 20) }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Options
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('admin.posts.edit', [$post->id]) }}">Edit</a></li>
                                    <li><a href="{{ route('admin.post.delete', [$post->id]) }}">Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <p class="text-center">No posts has been found</p>
            @endif
    </table>

@endsection
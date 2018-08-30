@extends('layouts.admin')

@section('content')
    <h1 class="text-center">Posts</h1>

    <div class="container">
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
            </tr>
            </thead>
            <tbody>
                @if($posts)
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td><img src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/400x400' }}" height="50" alt=""></td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->body }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->category_id }}</td>
                            <td>{{ $post->created_at->diffForHumans() }}</td>
                            <td>{{ $post->updated_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                @endif
        </table>
    </div>
@endsection
@extends('layouts.admin')

@section('content')
    @if(empty($post))
        <h1>Comments</h1>
    @else
        <h1>Comments for <a href="{{ route('home.post', [$post->slug]) }}">{{ $post->title }}</a> post</h1>
    @endif

    @if(!empty($comments))
        <div class="row">
        <div class="col-sm-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Author</th>
                    <th>body</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Post link</th>
                    <th></th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if($comments)
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->author }}</td>
                            <td>{{ $comment->body }}</td>
                            <td>{{ $comment->created_at->diffForHumans() }}</td>
                            <td>{{ $comment->updated_at->diffForHumans() }}</td>
                            <td><a href="{{ route('home.post', [$comment->post->slug]) }}">{{ $comment->post->title }}</a></td>
                            <td><a href="{{ route('admin.replies.show', [$comment->id]) }}">View replies</a></td>
                            <td>
                                {!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id]]) !!}
                                    {!! Form::hidden('is_active', !$comment->is_active) !!}

                                    <div class="form-group">
                                        {!! Form::submit($comment->is_active ? 'Un-publish' : 'Publish', ['class' => $comment->is_active ? 'btn btn-success' : 'btn btn-primary']) !!}
                                        <a href="{{ route('admin.comment.delete', [$comment->id]) }}" class="btn btn-danger">Delete</a>
                                    </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <p class="text-center">No commnets has been found</p>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    @else
        <p class="text-center">No comments has been found</p>
    @endif
@endsection
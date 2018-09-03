@extends('layouts.admin')

@section('content')
    <h1>Replies</h1>
    @if(!empty($replies))
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
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($replies)
                        @foreach($replies as $reply)
                            <tr>
                                <td>{{ $reply->id }}</td>
                                <td>{{ $reply->author }}</td>
                                <td>{{ $reply->body }}</td>
                                <td>{{ $reply->created_at->diffForHumans() }}</td>
                                <td>{{ $reply->updated_at->diffForHumans() }}</td>
                                <td><a href="{{ route('home.post', [$reply->comment->post->id]) }}">{{ $reply->comment->post->title }}</a></td>
                                <td>
                                    {!! Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}
                                    {!! Form::hidden('is_active', !$reply->is_active) !!}

                                    <div class="form-group">
                                        {!! Form::submit($reply->is_active ? 'Un-publish' : 'Publish', ['class' => $reply->is_active ? 'btn btn-success' : 'btn btn-primary']) !!}
                                        <a href="{{ route('comment.reply.delete', [$reply->id]) }}" class="btn btn-danger">Delete</a>
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
        <p class="text-center">No replies has been found</p>
    @endif
@endsection
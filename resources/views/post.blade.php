@extends('layouts.app')

@section('content')
    <!-- Blog Post Content Column -->
    <div class="col-md-8">
        @include('includes.status-message')

        <!-- Blog Post -->

        <!-- Title -->
        <h1>{{ $post->title }}</h1>

        <!-- Author -->
        <p class="lead">
            by <a href="#">{{ $post->user->name }}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at }}</p>

        <hr>

        <!-- Preview Image -->
        {{--<img class="img-responsive" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/900x300'}}" alt="">--}}

        <hr>

        <!-- Post Content -->
        <p>{!! $post->body !!}</p>
        <hr>

        <!-- Blog Comments -->

        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>

            {!! Form::open(['method' => 'post', 'action' => 'PostCommentsController@store']) !!}

                {!! Form::hidden('post_id', $post->id) !!}
                <div class="form-group">
                    {!! Form::textarea('body', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Enter comment...',
                            'rows' => 3.
                        ])
                    !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Post comment', ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>

        <hr>
        @if(Auth::check())
            <!-- Posted Comments -->
            @foreach($post->comments as $comment)
                @if(!empty($comment->is_active))
                    <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="{{ $comment->photo ? $comment->photo : 'http://placehold.it/64x64'}}" height="64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Created by {{ $comment->author }} <small>{{ $comment->created_at->diffForHumans() }}</small>
                            </h4>
                            <p>{{ $comment->body }}</p>

                            <div class="comment-meta">
                                <span><a href="{{ route('admin.comment.delete', [$comment->id]) }}">delete</a></span>
                                <span>
                                    <a class="" role="button" data-toggle="collapse" href="#replyCommentT{{$comment->id}}" aria-expanded="false" aria-controls="collapseExample">reply</a>
                                </span>
                                <div class="collapse" id="replyCommentT{{ $comment->id }}">

                                {!! Form::open(['method' => 'post', 'route' => ['comment.reply', $comment->id]]) !!}
                                    <div class="form-group">
                                        {!! Form::textarea('body', null, [
                                                'class' => 'form-control',
                                                'placeholder' => 'Enter comment...',
                                                'rows' => 3.
                                            ])
                                        !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::submit('Comment reply', ['class' => 'btn btn-primary']) !!}
                                    </div>
                                {!! Form::close() !!}
                                </div>
                                @if(!empty($comment->replies))
                                    @foreach($comment->replies as $reply)
                                        @if(!$reply->is_active)
                                            @continue;
                                        @endif

                                        <!-- Nested Comment -->
                                        <div class="media">
                                            <a class="pull-left" href="#">
                                                <img height="64" class="media-object" src="{{$reply->photo ? $reply->photo : 'http://placehold.it/64x64'}}" alt="">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">Created by {{ $reply->author}} <small>{{ $reply->created_at->diffForHumans() }}</small>
                                                </h4>
                                                {{ $reply->body }}

                                                <div class="comment-meta">
                                                    <span><a href="{{ route('comment.reply.delete', [$reply->id]) }}">delete</a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Nested Comment -->
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>

    @include('includes.post-sidebar')
@endsection
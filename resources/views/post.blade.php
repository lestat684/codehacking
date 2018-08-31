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
        <img class="img-responsive" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/900x300'}}" alt="">

        <hr>

        <!-- Post Content -->
        <p>{{ $post->body }}</p>
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

        <!-- Posted Comments -->
        @foreach($comments_data as $comment)
            @if(!empty($comment['status']))
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="{{ $comment['photo'] ? $comment['photo'] : 'http://placehold.it/64x64'}}" width="64" height="80" alt="">
                        {{--<img class="media-object" src="http://placehold.it/64x64" alt="">--}}
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Created by {{ $comment['author'] }} <small>{{ $comment['created_at'] }}</small>
                        </h4>
                        {{ $comment['body'] }}
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    @include('includes.post-sidebar')
@endsection
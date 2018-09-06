@extends('home')

@section('content')
    <div class="col-md-8">

        <h1 class="page-header">
            Simple blog Codehacking
            <small>Blog wich is implemented on laravel</small>
        </h1>

        <!-- First Blog Post -->

        @foreach($posts as $post)
            <h2>
                <a href="{{ route('home.post', [$post->slug]) }}">{{ $post->title }}</a>
            </h2>
            <p class="lead">
                by <a href="index.php">{{ $post->user->name }}</a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted {{ $post->created_at->diffForHumans() }}</p>
            <hr>
            <img class="img-responsive" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/900x300' }}"
                 alt="">
            <hr>
            <p>{!! str_limit($post->body, 300) !!}</p>
            <a class="btn btn-primary" href="{{ route('home.post', [$post->slug]) }}">Read More <span
                        class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>
        @endforeach

        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{$posts->render()}}
            </div>
        </div>
    </div>
@endsection

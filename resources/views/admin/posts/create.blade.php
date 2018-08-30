@extends('layouts.admin')

@section('content')
    <h1 class="text-center">Create post</h1>

    @if(Session::has('message'))
        <div class="alert alert-{{session('message')['status']}}">
            <strong>{{session('message')['message']}}</strong>
        </div>
    @endif

    <div class="col-sm-2 form-group">
        <img src="http://placehold.it/400x400" alt='' class='img-responsive img-rounded profileavatar'>
    </div>
    <div class="col-sm-10 form-group">
        @include('includes.form-errors')

        {!! Form::open(['method' => 'post', 'action' => 'AdminPostsController@store', 'files' => true]) !!}
        <div class="form-group">
            {!! Form::label('photo_id', 'Post image:') !!}
            {!! Form::file('photo_id', ['id' => 'avatar']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter title']) !!}
        </div>


        <div class="form-group">
            {!! Form::label('body', 'Body:') !!}
            {!! Form::textarea('body', null,
                [
                    'class' => 'form-control',
                    'placeholder' => 'Post content',
                ])
            !!}
        </div>

        <div class="form-group">
            {!! Form::label('category_id', 'Category:') !!}
            {!! Form::select('category_id', ['' => 'Choose category'] + $categories, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create post', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
@endsection
@extends('layouts.admin')

@section('content')
    @include('includes.tinyeditor')
    <h1 class="text-center">Update post</h1>

    <div class="col-sm-2 form-group">
        <img src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400x400'}}" alt='' class='img-responsive img-rounded profileavatar'>
    </div>
    <div class="col-sm-10 form-group">
        @include('includes.form-errors')

        {!! Form::model($post, ['method' => 'patch', 'action' => ['AdminPostsController@update', $post->id], 'files' => true]) !!}
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
            {!! Form::submit('Update post', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('admin.post.delete', [$post->id]) }}" class="btn btn-danger">Delete</a>
            <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a>
        </div>
    {!! Form::close() !!}
@endsection
@extends('layouts.admin')

@section('content')
    <h1>Edit category</h1>

    <div class="col-sm-4 form-group">
        @include('includes.form-errors')

        {!! Form::model($category, ['method' => 'PATCH', 'action' => ['AdminCategoriesController@update', $category->id]]) !!}

        <div class="form-group">
            {!! Form::label('name', 'Category name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter category name']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Edit category', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('admin.category.delete', [$category->id]) }}" class="btn btn-danger">Delete</a>
            <a href="{!! URL::previous() !!}" class="btn btn-default">Cancel</a>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
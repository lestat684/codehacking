@extends('layouts.admin')

@section('content')
    <h1>Categories</h1>

    <div class="row">
        <div class="col-sm-4 form-group">
            @include('includes.form-errors')

            {!! Form::open(['method' => 'post', 'action' => 'AdminCategoriesController@store']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Category name:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter category name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Add category', ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
        <div class="col-sm-8">
            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if($categories)
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td><a href="{{ route('admin.categories.edit', [$category->id]) }}">{{ $category->name }}</a></td>
                            <td>{{ $category->created_at->diffForHumans() }}</td>
                            <td>{{ $category->updated_at->diffForHumans() }}</td>
                            <td><a href="{{ route('admin.category.delete', [$category->id]) }}" class="btn btn-danger">Delete</a></td>
                        </tr>
                     @endforeach
                @else
                    <p class="text-center">No categories has been found</p>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
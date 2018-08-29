@extends('layouts.admin')

@section('content')
    <h1>Create user</h1>

    <div class="col-sm-2 form-group">
        <img src="http://placehold.it/400x400" alt='' class='img-responsive img-rounded profileavatar'>
    </div>
    <div class="col-9 form-group">
        @include('includes.form-errors')

        {!! Form::open(['method' => 'post', 'action' => 'AdminUsersController@store', 'files' => true, 'class' => 'col-sm-6 col-md-4']) !!}
            <div class="form-group">
                {!! Form::label('photo', 'Users photo:') !!}
                {!! Form::file('photo', ['id' => 'avatar']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name', 'User name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter title']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'example@example.com']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('role_id', 'Role:') !!}
                {!! Form::select('role_id', ['' => 'Choose options'] + $roles, null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('is_active', 'Status:') !!}
                {!! Form::select('is_active', [1 => 'Active', 0 => 'Blocked'], 1, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'Password:') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Create user', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection
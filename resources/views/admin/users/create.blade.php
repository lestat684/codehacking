@extends('layouts.admin')

@section('content')
    <h1>Create user</h1>

    @include('includes.form-errors')

    {!! Form::open(['method' => 'post', 'action' => 'AdminUsersController@store', 'files' => true, 'class' => 'col-sm-6 col-md-4']) !!}
        <div class="form-group avatarposition">
            <div class="form-group">
                <img src="" alt='' width="500" class='profileavatar'>
            </div>
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
@endsection
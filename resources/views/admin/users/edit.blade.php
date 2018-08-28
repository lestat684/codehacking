@extends('layouts.admin')

@section('content')
    <h1>Edit <strong>{{ $user->name }}</strong></h1>

    @include('includes.form-errors')

    {!! Form::open(['method' => 'post', 'action' => 'AdminUsersController@store', 'files' => true, 'class' => 'col-sm-6 col-md-4']) !!}
    <div class="form-group avatarposition">
        <div class="form-group">
             <img src="{{ $user->photo ? $user->photo->file : '' }}" alt='' width="500" class='profileavatar'>
        </div>

        {!! Form::label('photo', 'Users photo:') !!}
        {!! Form::file('photo', ['id' => 'avatar']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('name', 'User name:') !!}
        {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Enter title']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'example@example.com']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('role_id', 'Role:') !!}
        {!! Form::select('role_id', ['' => 'Choose options'] + $roles, $user->role_id, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('is_active', 'Status:') !!}
        {!! Form::select('is_active', [1 => 'Active', 0 => 'Blocked'], $user->is_active, ['class' => 'form-control']) !!}
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
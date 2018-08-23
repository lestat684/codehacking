@extends('layouts.admin')

@section('content')
    <h1>Create user</h1>

    {!! Form::open(['method' => 'post', 'action' => 'AdminUsersController@store']) !!}
        <div class="form-group">
            {!! Form::label('name', 'User name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter title']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'example@example.com']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('role', 'Role:') !!}
            {!! Form::select('role', ['' => 'Choose options'] + $roles, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}
            {!! Form::select('status', [1 => 'Active', 0 => 'Blocked'], 1, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create post', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
@endsection
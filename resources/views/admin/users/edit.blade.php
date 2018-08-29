@extends('layouts.admin')

@section('content')
    <div class="col-sm-6">
        <div class="row"><a href="{{ URL::previous() }}" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a></div>

        <h1>Edit <strong>{{ $user->name }}</strong></h1>

        <div class="col-sm-2">
            <img src="{{ $user->photo ? $user->photo->file : 'http://placehold.it/400x400' }}" class="img-responsive img-rounded" alt="">
        </div>

        <div class="col-sm-10">
            @include('includes.form-errors')

            {!! Form::model($user, ['method' => 'PATCH', 'action' => ['AdminUsersController@update', $user->id], 'files' => true]) !!}
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
                    {!! Form::select('is_active', [1 => 'Active', 0 => 'Blocked'], null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password:') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Update user', ['class' => 'btn btn-primary']) !!}
                    <a class="btn btn-danger" href="{{ route('admin.user.delete', [$user->id]) }}">Delete</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
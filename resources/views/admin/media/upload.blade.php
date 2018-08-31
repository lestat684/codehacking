@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
@endsection

@section('content')
    <div class="col-sm-12">
        <h1 class="text-center">Upload media</h1>
        {!! Form::open([
                'method' => 'post',
                'action' => 'AdminMediaController@store',
                //'files' => true,
                'class' => 'dropzone'
                ]) !!}
        {!! Form::close() !!}
    </div>
@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
@endsection
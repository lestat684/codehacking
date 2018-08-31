@extends('layouts.admin')

@section('content')

    <h1 class="text-center">Media</h1>

    @include('includes.status-message')

    <div class="container">
        <div class="row row-eq-height">
            @if(!empty($media))
                @foreach($media as $item)
                    <div class="col-lg-3 col-md-3 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                           data-image="{{ $item->file }}"
                           data-target="#image-gallery">
                            <img class="img-thumbnail"
                                 src="{{ $item->file }}"
                                 alt="Another alt text">
                        </a>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminMediaController@destroy', $item->id], 'files' => true]) !!}
                            <div class="form-group">
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger pull-right']) !!}
                            </div>
                        {!! Form::close() !!}

                    </div>
                @endforeach
            @endif
        </div>

        @include('admin.media.modal')

    </div>
@endsection
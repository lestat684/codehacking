@extends('layouts.admin')

@section('content')

    <h1 class="text-center">Media</h1>

    <div class="container">
        <div class="row">
            @if(!empty($media))
                @foreach($media as $item)
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                           data-image="{{ $item->file }}"
                           data-target="#image-gallery">
                            <img class="img-thumbnail"
                                 src="{{ $item->file }}"
                                 alt="Another alt text">
                        </a>
                    </div>
                @endforeach
            @endif
        </div>

        @include('admin.media.modal')

    </div>
@endsection
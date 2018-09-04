@extends('layouts.admin')

@section('content')
    <h1 class="text-center">Posts</h1>

    @if(count($posts) > 0)


        {!! Form::open(['method' => 'post', 'action' => 'AdminPostsController@bulkDelete']) !!}
                <div class="row col-sm-12 form-group">
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Create post</a>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-2">
                            {!! Form::select('options', [
                           '' => 'Choose operation',
                           'delete' => 'Delete',
                        ], null, ['class' => 'form-control inline-sm']); !!}
                        </div>
                        <div class="col-sm-2">
                            {!! Form::submit('Submit', ['class' => 'btn btn-primary delete-submit']) !!}
                        </div>
                    </div>
                </div>

            <table class="table">
            <thead>
            <tr>
                <th>{!! Form::checkbox('all', 'value', false, ['id' => 'options']); !!}</th>
                <th>Id</th>
                <th>Image</th>
                <th>Title</th>
                <th>Content</th>
                <th>Author</th>
                <th>Category</th>
                <th>Comments</th>
                <th>Created</th>
                <th>Updated</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <th>{!! Form::checkbox('checkboxBoxArray[]', $post->id, false, ['class' => 'post-item']); !!}</th>
                        <td>{{ $post->id }}</td>
                        <td><img src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/400x400' }}" height="50" alt=""></td>
                        <td><a href="{{ route('home.post', [$post->slug]) }}">{{ $post->title }}</a></td>
                        <td>{{ str_limit($post->body, 20) }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td><a href="{{ route('admin.comments.show', [$post->id]) }}">View comments</a></td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Options
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('admin.posts.edit', [$post->id]) }}">Edit</a></li>
                                    <li><a href="{{ route('admin.post.delete', [$post->id]) }}">Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
        </table>
        {!! Form::close() !!}

        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{ $posts->render() }}
            </div>
        </div>
    @else
        <p class="text-center">No posts has been found</p>
    @endif

@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            selectCheck();

            $('select[name=options]').change(function () {
                selectCheck();
            });

            $('#options').click(function (event) {
                if (this.checked) {
                    $('.post-item').each(function () { //loop through each checkbox
                        $(this).prop('checked', true); //check
                    });
                } else {
                    $('.post-item').each(function () { //loop through each checkbox
                        $(this).prop('checked', false); //uncheck
                    });
                }
            });

            function selectCheck () {
                if ($('select[name=options] option:selected').val() === '') {
                    $('.delete-submit').prop('disabled', true);
                }
                else {
                    $('.delete-submit').removeAttr('disabled');
                }
            }
        });
    </script>
@endsection
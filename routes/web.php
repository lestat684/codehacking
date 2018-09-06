<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'HomeController@index');

Route::get('/post/{id}', ['uses' => 'AdminPostsController@post', 'as' => 'home.post']);

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', 'AdminController@index');

    Route::resource('admin/users', 'AdminUsersController', ['names' => [
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
    ]]);

    Route::resource('admin/posts', 'AdminPostsController', ['names' => [
        'index' => 'admin.posts.index',
        'create' => 'admin.posts.create',
        'store' => 'admin.posts.store',
        'edit' => 'admin.posts.edit',
        'update' => 'admin.posts.update',
    ]]);

    Route::post('admin/posts/delete/multiple', 'AdminPostsController@bulkDelete');

    Route::resource('admin/comments', 'PostCommentsController', ['names' => [
        'index' => 'admin.comments.index',
        'create' => 'admin.comments.create',
        'store' => 'admin.comments.store',
        'edit' => 'admin.comments.edit',
        'show' => 'admin.comments.show',
    ]]);

    Route::resource('admin/categories', 'AdminCategoriesController', ['names' => [
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
    ]]);

    Route::resource('admin/media', 'AdminMediaController', ['names' => [
        'index' => 'admin.media.index',
        'create' => 'admin.media.create',
        'store' => 'admin.media.store',
        'destroy' => 'admin.media.edit',
    ]]);

    Route::resource('admin/comment/replies', 'CommentRepliesController', ['names' => [
        'create' => 'admin.comment.replies.create',
        'store' => 'admin.comment.replies.store',
        'show' => 'admin.comment.replies.show',
    ]]);


    Route::get('/admin/users/{id}/delete', ['uses' => 'AdminUsersController@destroy', 'as' => 'admin.user.delete']);
    Route::get('/admin/posts/{id}/delete', ['uses' => 'AdminPostsController@destroy', 'as' => 'admin.post.delete']);
    Route::get('/admin/categories/{id}/delete', ['uses' => 'AdminCategoriesController@destroy', 'as' => 'admin.category.delete']);
    Route::get('/admin/comment/{id}/delete', ['uses' => 'PostCommentsController@destroy', 'as' => 'admin.comment.delete']);
    Route::get('/admin/replies', ['uses' => 'CommentRepliesController@index', 'as' => 'admin.replies.index']);
    Route::get('/admin/comment/{id}/replies', ['uses' => 'CommentRepliesController@show', 'as' => 'admin.replies.show']);
});

Route::group(['middleware' => 'auth'], function() {
    Route::post('comment/{id}/reply', ['uses' => 'CommentRepliesController@create', 'as' => 'comment.reply']);
    Route::get('/reply/{rid}/delete', ['uses' => 'CommentRepliesController@delete', 'as' => 'comment.reply.delete']);
//    Route::get('/reply/{rid}/edit', ['uses' => 'CommentRepliesController@edit', 'as' => 'comment.reply.edit']);

});
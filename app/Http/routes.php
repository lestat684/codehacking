<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/post/{id}', ['uses' => 'AdminPostsController@post', 'as' => 'home.post']);

Route::group(
    ['middleware' => 'admin'], function() {


    Route::get('/admin', function() {
        return view('admin.index');
    })->middleware(['admin']);


    Route::resources([
        '/admin/users' => 'AdminUsersController',
        '/admin/posts' => 'AdminPostsController',
        '/admin/categories' => 'AdminCategoriesController',
        '/admin/media' => 'AdminMediaController',
        '/admin/comments' => 'PostCommentsController',
        '/admin/comment/replies' => 'CommentRepliesController',
    ]);

    Route::get('/admin/users/{id}/delete', ['uses' => 'AdminUsersController@destroy', 'as' => 'admin.user.delete']);
    Route::get('/admin/posts/{id}/delete', ['uses' => 'AdminPostsController@destroy', 'as' => 'admin.post.delete']);
    Route::get('/admin/categories/{id}/delete', ['uses' => 'AdminCategoriesController@destroy', 'as' => 'admin.category.delete']);
    Route::get('/admin/comment/{id}/delete', ['uses' => 'PostCommentsController@destroy', 'as' => 'admin.comment.delete']);
});
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Post\PostController@index');

Auth::routes();

Route::get('/posts', 'Post\PostController@index') -> name('posts');

Route::post('/posts/search', 'Post\PostController@search') -> name('posts.search');

Route::get('/posts/addpost', 'Post\PostController@create') -> name('posts.addPost') -> middleware('auth');

Route::post('/posts/confirmcreate', 'Post\PostController@confirmCreate') -> name('posts.confirmCreate') -> middleware('auth');

Route::post('/posts/store', 'Post\PostController@store') -> name('posts.store') -> middleware('auth');

Route::get('/posts/{id}/edit', 'Post\PostController@edit') -> name('posts.editPost') -> middleware('auth');

Route::any('/posts/{id}/confirmedit', 'Post\PostController@confirmEdit') -> name('posts.confirmEdit') -> middleware('auth');

Route::post('/posts/{id}/update', 'Post\PostController@update') -> name('posts.update') -> middleware('auth');

Route::get('/users', 'User\UserController@index') -> name('users') -> middleware('auth');

Route::post('/users/search', 'User\UserController@search') -> name('users.search');

Route::post('/users/confirmcreate', 'User\UserController@confirmCreate') -> name('users.confirmCreate') -> middleware('auth');

Route::post('/users/register', 'User\UserController@store') -> name('users.register') -> middleware('auth');

Route::get('/users/{id}/edit', 'User\UserController@edit') -> name('users.editUser') -> middleware('auth');

Route::post('/users/{id}/confirmedit', 'User\UserController@confirmEdit') -> name('users.confirmEdit') -> middleware('auth');

?>
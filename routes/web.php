<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/posts', 'Post\PostController@index');

Route::post('/posts/search', 'Post\PostController@search') -> name('posts.search');

Route::get('/posts/addpost', 'Post\PostController@create') -> name('posts.addPost') -> middleware('auth');;

Route::post('/posts/addpost', 'Post\PostController@store') -> name('posts.addPost');

Route::get('/posts/confirmcreate','Post\PostController@showConfirm') -> name('posts.confirmCreate');


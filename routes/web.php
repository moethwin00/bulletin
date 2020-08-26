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

Route::group(['prefix' => 'posts'], function() {
    Route::get('/', 'Post\PostController@index')->name('posts#index');
    Route::post('search', 'Post\PostController@search')->name('posts#search');
    Route::get('addpost', 'Post\PostController@create')->name('posts#create')->middleware('auth');
    Route::post('confirmcreate', 'Post\PostController@confirmCreate')->name('posts#confirmCreate')->middleware('auth');
    Route::post('store', 'Post\PostController@store')->name('posts#store')->middleware('auth');
    Route::get('{id}/edit', 'Post\PostController@edit')->name('posts#edit')->middleware('auth');
    Route::get('{id}/confirmedit', 'Post\PostController@confirmEdit')->name('posts#confirmEdit')->middleware('auth');
    Route::post('{id}/confirmedit', 'Post\PostController@confirmEdit')->name('posts#confirmEdit')->middleware('auth');
    Route::post('{id}/update', 'Post\PostController@update')->name('posts#update')->middleware('auth');
    Route::get('{id}/delete', 'Post\PostController@delete')->name('posts#delete')->middleware('auth');
    Route::get('uploadcsv', 'Post\PostController@showUpload')->name('posts#showUpload')->middleware('auth');
    Route::get('download', 'Post\PostController@download')->name('posts#download')->middleware('auth');
    Route::get('upload', 'Post\PostController@upload')->name('posts#upload')->middleware('auth');
    Route::post('upload', 'Post\PostController@upload')->name('posts#upload')->middleware('auth');
});

//User and Admin Only
Route::middleware('can:isAdmin')->prefix('users')->group(function () {
    // Mention all admin routes
    Route::get('/', 'User\UserController@index') -> name('users#index') -> middleware('auth');
    Route::post('search', 'User\UserController@search') -> name('users#search');
    Route::post('confirmcreate', 'User\UserController@confirmCreate') -> name('users#confirmCreate') -> middleware('auth');
    Route::post('register', 'User\UserController@store') -> name('users#store') -> middleware('auth');
    Route::get('{id}/delete', 'User\UserController@delete') -> name('users#delete') -> middleware('auth');
});

Route::group(['prefix' => 'users'], function() {
    Route::get('{id}/edit', 'User\UserController@edit') -> name('users#edit') -> middleware('auth');
    Route::get('{id}/confirmedit', 'User\UserController@confirmEdit') -> name('users#confirmEdit') -> middleware('auth');
    Route::post('{id}/confirmedit', 'User\UserController@confirmEdit') -> name('users#confirmEdit') -> middleware('auth');
    Route::post('{id}/update', 'User\UserController@update') -> name('users#update') -> middleware('auth');
    Route::get('profile', 'User\UserController@showProfile') -> name('users#showProfile') -> middleware('auth');
});

Route::group(['prefix' => 'password'], function() {
    Route::get('{id}/reset', 'Auth\PasswordController@edit')->name('password#edit')->middleware('auth');
    Route::get('{id}/update', 'Auth\PasswordController@update')->name('password#update')->middleware('auth');
    Route::post('{id}/update', 'Auth\PasswordController@update')->name('password#update')->middleware('auth');
});

?>
<?php
use Illuminate\Support\Facades\Route;
//Public Routes
Route::resource('posts', 'PostController')->only(['index','show']);
Route::resource('categories', 'CategoryController')->only(['index','show']);
Route::get('posts/{post}/comments','CommentController@index');
Route::get('comments/{comment}','CommentController@show');
// Private Routes
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('likes/{post}','LikeController@getPostLikes');
    Route::post('likes/{post}','LikeController@toggleLike');
    Route::get('search','SearchController@search');
    Route::post('comments','CommentController@store');
    Route::patch('comments/{comment}','CommentController@update')->middleware('owner');
    Route::delete('comments/{comment}','CommentController@destroy')->middleware('owner');
});
// Auth Routes
Route::group(['prefix' => 'auth'], function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout')->middleware('auth:api');
    Route::post('refresh', 'AuthController@refresh')->middleware('auth:api');
    Route::post('me', 'AuthController@me')->middleware('auth:api');
});

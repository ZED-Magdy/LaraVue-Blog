<?php
use Illuminate\Support\Facades\Route;
Route::resource('posts', 'PostController')->only(['index','show']);
Route::resource('categories', 'CategoryController')->only(['index','show']);
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('posts','PostController@store');
    Route::group(['middleware' => 'owner'], function () {
        Route::resource('posts', 'PostController')->only('update','destroy');
    });
});
Route::group([
    'prefix' => 'auth'

], function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout')->middleware('auth:api');
    Route::post('refresh', 'AuthController@refresh')->middleware('auth:api');
    Route::post('me', 'AuthController@me')->middleware('auth:api');

});
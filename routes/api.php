<?php
use Illuminate\Support\Facades\Route;
Route::resource('posts', 'PostController')->only(['index','show']);
Route::resource('categories', 'CategoryController')->only(['index','show']);
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('likes/{post}','LikeController@getPostLikes');
    Route::post('likes/{post}','LikeController@toggleLike');
});
Route::group(['prefix' => 'auth'], function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout')->middleware('auth:api');
    Route::post('refresh', 'AuthController@refresh')->middleware('auth:api');
    Route::post('me', 'AuthController@me')->middleware('auth:api');
});
Route::group(['prefix' => 'admin','middleware' => 'role:admin'], function () {
    Route::resource('users', 'UserController')->only(['index','show','update','destroy']);
    Route::resource('roles', 'RoleController')->except(['create','edit']);
    Route::post('users/{user}/role','RoleController@assignRole');
    Route::delete('users/{user}/role','RoleController@removeRole');
    Route::resource('categories', 'CategoryController')->except(['index','show','create','edit']);
    Route::resource('posts', 'PostController')->except(['show','create','edit']);
    Route::group(['prefix' => 'datatable'], function () {
        Route::get('users','UserController@datatable');
        Route::get('posts','PostController@datatable');
        Route::get('categories','CategoryController@datatable');
        Route::get('roles','RoleController@datatable');
    });
});
<?php

use Illuminate\Support\Facades\Route;

Route::resource('users', 'UserController')->only(['show','update','destroy']);
Route::resource('roles', 'RoleController')->except(['create','edit']);
Route::post('users/{user}/role','RoleController@assignRole');
Route::delete('users/{user}/role','RoleController@removeRole');
Route::resource('categories', 'CategoryController')->except(['index','show','create','edit']);
Route::resource('posts', 'PostController')->except(['create','edit']);
Route::group(['prefix' => 'datatable'], function () {
    Route::get('users','UserController@datatable');
    Route::get('posts','PostController@datatable');
    Route::get('categories','CategoryController@datatable');
    Route::get('roles','RoleController@datatable');
});
Route::group(['prefix' => 'dashboard'],function(){
    Route::get('count/posts','DashboardController@postsCount');
    Route::get('count/users','DashboardController@usersCount');
    Route::get('count/comments','DashboardController@commentsCount');
    Route::get('count/likes','DashboardController@likesCount');
    Route::get('/posts','DashboardController@posts');
    Route::get('/comments','DashboardController@comments');
});

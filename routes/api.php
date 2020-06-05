<?php
use Illuminate\Support\Facades\Route;
auth()->loginUsingId(1);
Route::resource('posts', 'PostController')->except(['create','edit','update','destroy']);

Route::group(['middleware' => 'owner'], function () {
    Route::resource('posts', 'PostController')->only('update','destroy');
});

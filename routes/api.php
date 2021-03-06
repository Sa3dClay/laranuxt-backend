<?php

use Illuminate\Support\Facades\Route;

Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::post('logout', 'App\Http\Controllers\AuthController@logout');
Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::get('user', 'App\Http\Controllers\AuthController@user');

// Topics
Route::prefix('topics')->group(function () {
    Route::get('/', 'App\Http\Controllers\TopicController@index');
    Route::get('/{topic}', 'App\Http\Controllers\TopicController@show');
    Route::post('/', 'App\Http\Controllers\TopicController@store')->middleware('auth:api');
    Route::patch('/{topic}', 'App\Http\Controllers\TopicController@update')->middleware('auth:api');
    Route::delete('/{topic}', 'App\Http\Controllers\TopicController@destroy')->middleware('auth:api');

    // Posts
    Route::prefix('/{topic}/posts')->group(function () {
        Route::post('/', 'App\Http\Controllers\PostController@store')->middleware('auth:api');
        Route::patch('/{post}', 'App\Http\Controllers\PostController@update')->middleware('auth:api');
        Route::delete('/{post}', 'App\Http\Controllers\PostController@destroy')->middleware('auth:api');

        // Likes
        Route::prefix('/{post}/likes')->group(function () {
            Route::post('/', 'App\Http\Controllers\PostLikeController@store')->middleware('auth:api');
            Route::delete('/', 'App\Http\Controllers\PostLikeController@dislike')->middleware('auth:api');
        });
    });
});

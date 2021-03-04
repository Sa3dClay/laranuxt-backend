<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::post('logout', 'App\Http\Controllers\AuthController@logout');
Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::get('user', 'App\Http\Controllers\AuthController@user');

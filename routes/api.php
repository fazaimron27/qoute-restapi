<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'Api\RegisterController@action');
Route::post('login', 'Api\LoginController@action');
Route::get('user', 'Api\UserController@user')->middleware('auth:api');
Route::post('quote', 'Api\QuoteController@store')->middleware('auth:api');
Route::get('quote', 'Api\QuoteController@index')->middleware('auth:api');
Route::get('quote/{quote}', 'Api\QuoteController@show')->middleware('auth:api');

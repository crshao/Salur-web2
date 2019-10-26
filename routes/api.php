<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login','AuthController@login'); //localhost/api/login
Route::post('register','AuthController@register');
Route::post('refresh','AuthController@refresh');
Route::post('post', 'DataController@post');

Route::get('getData','DataController@getApa');
Route::get('getHome', 'DataController@getHome');
Route::get('getUser', 'DataController@getUser');
Route::get('getPostData', 'DataController@getPostData');
Route::get('getPanti', 'DataController@getPanti');
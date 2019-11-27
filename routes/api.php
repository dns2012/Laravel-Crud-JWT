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

Route::group(['prefix' => 'auth', 'middleware' => 'api'], function() {
    Route::post('/login', 'AuthController@login');
});

Route::group(['prefix' => 'product', 'middleware' => 'auth_middleware'], function() {
    Route::get('/', 'ProductController@index');
    Route::post('/store', 'ProductController@store');
    Route::get('/show/{id}', 'ProductController@show');
    Route::put('/update/{id}', 'ProductController@update');
    Route::delete('/destroy/{id}', 'ProductController@destroy');
});

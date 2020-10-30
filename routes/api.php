<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('products', 'Api\ProductController@index');

Route::prefix('ext/user')->group(function(){
    Route::post('login', 'ExtensionController@login');
    Route::get('refresh', 'ExtensionController@refresh');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('test', 'ExtensionController@test');
        Route::get('check', 'ExtensionController@check');
        Route::post('testpost','ExtensionController@postdata');
        Route::post('upload','ExtensionController@uploadImage');
        Route::post('logout','ExtensionController@logout');

    });

});
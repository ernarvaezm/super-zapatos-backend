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


Route::get('services/stores', 'StoreController@index');
Route::get('services/stores/{id}', 'StoreController@show');
Route::post('services/stores', 'StoreController@store');
Route::put('services/stores/{id}', 'StoreController@update');
Route::delete('services/stores/{id}', 'StoreController@destroy');

//Articles routes
Route::get('services/articles', 'ArticleController@index');
Route::get('services/articles/store/{id}', 'ArticleController@indexById');
Route::get('services/articles/{id}', 'ArticleController@show');
Route::post('services/articles', 'ArticleController@store');
Route::put('services/articles/{id}', 'ArticleController@update');
Route::delete('services/articles/{id}', 'ArticleController@destroy');

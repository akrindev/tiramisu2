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

Route::get('/forum', 'Api\ForumController@feed');
Route::get('/forum/{id}', 'Api\ForumController@show');
Route::get('/fill/{type}/{plus}', 'Api\FillController@show');

Route::get('/map', 'Api\MonsterController@showMap');
Route::get('/map/{id}', 'Api\MonsterController@showByMap');
Route::get('/mons/{id}', 'Api\MonsterController@showMonsByMap');
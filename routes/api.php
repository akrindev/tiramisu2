<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\Api\v1\PubicAPIController;


Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    // items
    Route::get('/items', [PubicAPIController::class, 'getItems']);
    Route::get('/items/type', [PubicAPIController::class, 'itemsType']);
    Route::get('/items/search/{query}', [PubicAPIController::class, 'searchItems']);
    Route::get('/items/{items}', [PubicAPIController::class, 'itemsByType']);
    Route::get('/item/{item}', [PubicAPIController::class, 'getItem']);

    // monster
    Route::get('/monsters', [PubicAPIController::class, 'getMonsters']);
    Route::get('/monsters/{type}', [PubicAPIController::class, 'getMonstersByType']);
    Route::get('/monsters/search/{query}', [PubicAPIController::class, 'searchMonsters']);
    Route::get('/monster/{monster}', [PubicAPIController::class, 'getMonster']);
});
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/forum', 'Api\ForumController@feed');
Route::get('/forum/{id}', 'Api\ForumController@show');
Route::get('/fill/{type}/{plus}', 'Api\FillController@show');

Route::get('/map', 'Api\MonsterController@showMap');
Route::get('/map/{id}', 'Api\MonsterController@showByMap');
Route::get('/mons/{id}', 'Api\MonsterController@showMonsByMap');
*/

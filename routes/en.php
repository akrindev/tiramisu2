<?php

/*
| ------
| --- English Routes
| ------
*/

Route::view('/', 'toram');
Route::get('/search', 'SearchController@search');


// items english

Route::get('/items', 'ItemController@showAllItems');
Route::get('/items/{id}', 'ItemController@showItems');

Route::get('/item/{id}', 'ItemController@showItem');


// monster in english

// Monster routes
Route::prefix('monster')->group(function() {
    Route::get('/', 'MonsterController@index');
    Route::get('/{id}', 'MonsterController@showMons');
    Route::get('/type/{name}', 'MonsterController@showMonsType');
    Route::get('/unsur/{type}', 'MonsterController@showMonsEl');
});
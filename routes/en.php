<?php

/*
| ------
| --- English Routes
| ------
*/

Route::view('/', 'toram');
Route::get('/search', 'SearchController@search');

/**
* Appearance
*/
Route::prefix('appearance')->group(function() {
    Route::get('/', 'AppearanceController@show');
    Route::get('/{type}', 'AppearanceController@type');
});

// items english

Route::get('/items', 'ItemController@showAllItems');
Route::get('/items/{id}', 'ItemController@showItems');

Route::get('/', 'ItemController@showThem');
Route::get('/item/{id}', 'ItemController@showItem');


// monster in english

// Monster routes
Route::prefix('monster')->group(function() {
    Route::get('/', 'MonsterController@index');
    Route::get('/{id}', 'MonsterController@showMons');
    Route::get('/type/{name}', 'MonsterController@showMonsType');
    Route::get('/unsur/{type}', 'MonsterController@showMonsEl');
});

// map

Route::get('/peta', 'MonsterController@index');
Route::get('/peta/{id}', 'MonsterController@peta');


Route::get('/latest_search', 'SitemapController@show');

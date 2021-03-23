<?php

// create drop / item
Route::view('/drop/create', 'temp.drop.create');
Route::post('/drop/store', 'TempDropController@store');
Route::post('/drop/edit/update', 'TempDropController@update');
Route::get('/drop/edit/{id}', 'TempDropController@edit');



// ------------------------------ //

// create monster
Route::view('/monster/create', 'temp.monster.create');
Route::post('/monster/store', 'TempMonsterController@store');
Route::get('/monster/dl', 'TempMonsterController@getList');
Route::get('/monster/fetch/{id}', 'TempMonsterController@fetchItem');
Route::post('/monster/edit/update', 'TempMonsterController@update');
Route::get('/monster/edit/{id}', 'TempMonsterController@edit');



// ------------------------------ //
Route::middleware('admin')->group(function() {
    Route::view('review', 'temp.admin.review');
});

<?php

// Monster routes
Route::get('/', 'MonsterController@index');
Route::get('/{id}', 'MonsterController@showMons');
Route::get('/type/{name}', 'MonsterController@showMonsType');
Route::get('/unsur/{type}', 'MonsterController@showMonsEl');

// admin route
Route::middleware('admin')->group(function () {
    Route::get('/{id}/edit', 'MonsterController@editMons');
    Route::post('/{id}/edit', 'MonsterController@editMobPost');
    Route::delete('/{id}/hapus', 'MonsterController@monsHapus');
});

<?php

// Emblem / prestasi routes
Route::middleware('admin')->group(function () {
    Route::view('/add', 'emblem.add');
    Route::post('/add', 'EmblemController@store');
    Route::get('/{id}/edit', 'EmblemController@edit');
    Route::put('/{id}/edit', 'EmblemController@editPost');
    Route::delete('/{id}/hapus', 'EmblemController@hapus');
});

Route::get('/', 'EmblemController@index');
Route::get('/{id}', 'EmblemController@show');
Route::get('/reward/{name}', 'EmblemController@byReward');

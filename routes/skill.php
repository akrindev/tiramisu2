<?php

// Skills routes

Route::get('/', 'SkillController@index');
Route::get('/{name}', 'SkillController@show')->where('name', '[a-zA-Z\-]+');
Route::get('/{id}', 'SkillController@showId')->where('id', '[0-9]+');
Route::get('/child/{id}', 'SkillController@singleChild');

Route::get('/{parent}/{child}', 'SkillController@single');

Route::middleware('auth')->group(function () {
    Route::post('/child/{id}', 'SkillController@comment');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/e/{id}/edit', 'SkillController@edit');
    Route::post('/e/{id}/save', 'SkillController@save');
    Route::delete('/skill-delete-comment', 'SkillController@deleteComment');
});

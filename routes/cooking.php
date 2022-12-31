<?php

// Cooking Routes
Route::redirect('/', '/cooking/berteman');
Route::view('/berteman', 'cooking.tukar');
Route::get('buff', 'CookingController@buff');

Route::middleware('admin')->group(function () {
    Route::view('/store', 'cooking.store');
    Route::post('/store', 'CookingController@store');
    Route::delete('/delete/{id}', 'CookingController@delete');
});

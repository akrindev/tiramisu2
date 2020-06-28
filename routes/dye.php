<?php

// Dye routes
Route::get('/', 'DyeController@home');

Route::middleware('admin')->group(function() {
  Route::get('store', 'DyeController@store');
  Route::post('store', 'DyeController@storeDye');
  Route::delete('delete', 'DyeController@delete');
});
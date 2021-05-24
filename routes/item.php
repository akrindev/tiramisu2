<?php

// Item routes
Route::get('/', 'ItemController@showThem');
Route::get('/{id}', 'ItemController@showItem');

// admin route
Route::middleware('admin')->group(function() {
  Route::match(['get', 'post'], '/drop/store', 'ItemController@storeDrop');
  Route::get('/drop/see', 'ItemController@see');
  Route::get('/{id}/edit', 'ItemController@editItem');
  Route::post('/{id}/edit', 'ItemController@editItemPost');
  Route::delete('/{id}/hapus', 'ItemController@hapusItem');
});

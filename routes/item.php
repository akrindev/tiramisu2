<?php

// Item routes
Route::get('/{id}', 'ItemController@showItem');

// admin route
Route::middleware('admin')->group(function() {
  Route::match(['get', 'post'], '/drop/store', 'ItemController@storeDrop');
  Route::get('/{id}/edit', 'ItemController@editItem');
  Route::put('/{id}/edit', 'ItemController@editItemPost');
  Route::delete('/{id}/hapus', 'ItemController@hapusItem');
});
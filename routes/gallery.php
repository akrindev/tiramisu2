<?php

// Gallery routes

Route::get('/', 'GalleryController@index');
Route::get('/{id}', 'GalleryController@single');

Route::middleware('auth')->group(function() {
  Route::post('/', 'GalleryController@upload');
  Route::post('/{id}', 'GalleryController@comment');
  Route::get('/mygallery', 'GalleryController@myGallery');

  Route::get('/{id}/edit', 'GalleryController@edit');
  Route::post('/{id}/edit', 'GalleryController@editSubmit');
  Route::delete('/destroy', 'GalleryController@destroy');
  Route::delete('/destroy/comment', 'GalleryController@destroyComment');
});

Route::get('/tag/{tag}', 'GalleryController@getByTag');
Route::get('/by/{provider_id}', 'GalleryController@getUserGallery');
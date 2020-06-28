<?php

// Forum Routes

Route::get('/', 'ForumController@feed');
Route::get('/tag/{nya}', 'ForumController@byTag');
Route::get('/cari', 'ForumController@feed');
Route::post('/cari', 'ForumController@cari');

// For auth user
Route::middleware('auth')->group(function() {
Route::get('/baru', 'ForumController@buat');
Route::post('/baru', 'ForumController@buatSubmit');
Route::post('/like', 'ForumController@postLike');
Route::post('/likereply', 'ForumController@postLikeReply');

// komentar forum
Route::post('/{slug}', 'ForumController@comment');
Route::post('/{slug}/c', 'ForumController@commentReply');
Route::delete('/{slug}/delete', 'ForumController@deleteByUser');

// the user thread can edit his/her thread
Route::get('/{slug}/edit', 'ForumController@edit');
Route::post('/{slug}/edit', 'ForumController@editSubmit');

// Admin routes
Route::middleware('admin')->group(function(){

	// admin can delete the pinned the thread
	Route::post('/{slug}/pin', 'ForumController@pinned');
	Route::delete('/{slug}/del', 'ForumController@delete');
	Route::delete('/delete-comment', 'ForumController@deleteComment');
});

});

Route::get('/{slug}', 'ForumController@baca');
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('toram');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/exp', 'XpController@index');

Route::get('/fb-login', 'Auth\LoginController@redirect');
Route::get('/facebook/callback', 'Auth\LoginController@callback');

Route::get('/profile/notifikasi', 'UserController@notifikasi');

Route::get('/profile', 'UserController@profileku')->middleware('auth');

Route::get('/profile/{provider_id}', 'UserController@profile');
/**
*
* Setting
*/
Route::get('/setting/profile', 'UserController@settingProfile');
Route::post('/setting/profile', 'UserController@settingProfileSubmit');


Route::get('/equips/{slug}', 'EquipController@equips');
Route::get('/equip/{slug}', 'EquipController@equip');
Route::get('/edit/{id}/equip', 'EquipController@edit');
Route::post('/edit/{id}/equip', 'EquipController@editPost');
Route::delete('/edit/equip/delete', 'EquipController@destroy');

Route::get('/store-equip', 'EquipController@tambah');

Route::post('/store-equip', 'EquipController@tambahPost');



Route::get('/crystas/{slug}', 'CrystaController@crystas');
Route::get('/crysta/{slug}', 'CrystaController@crysta');

Route::get('/edit/{id}/crysta', 'CrystaController@edit');
Route::post('/edit/{id}/crysta', 'CrystaController@editPost');
Route::delete('/edit/crysta/delete', 'CrystaController@destroy');

Route::get('/store-crysta', 'CrystaController@tambah');

Route::post('/store-crysta', 'CrystaController@tambahPost');

Route::get('/fill_stats', 'FillController@index');
Route::get('/fill_stats/add', 'FillController@add');
Route::post('/fill_stats/add', 'FillController@addPost');
Route::get('/fill_stats/{type}', 'FillController@single');
Route::get('/fill_stats/{type}/{plus}', 'FillController@single');
Route::get('/edit/{id}/fillstats', 'FillController@edit');
Route::post('/edit/{id}/fillstats', 'FillController@editPost');
Route::delete('/delete/fillstats', 'FillController@destroy');

/**
* Monster routes
*/
Route::get('/monster', 'MobController@index');
Route::get('/monster/{slug}', 'MobController@single');
Route::get('/peta/{slug}', 'MobController@peta');

Route::get('/store-mob', 'MobController@add');
Route::post('/store-mob', 'MobController@addPost');
Route::get('/edit/{id}/mobs', 'MobController@edit');
Route::post('/edit/{id}/mobs', 'MobController@editPost');
Route::delete('/edit/mob/delete', 'MobController@destroy');


Route::get('/cari', function(){
	return view('toram');
});
Route::post('/cari', 'CariController@cari');


/**
* Forum Routes
*/
Route::get('/forum', 'ForumController@feed');
Route::get('/forum/baru', 'ForumController@buat')->middleware('auth');
Route::post('/forum/baru', 'ForumController@buatSubmit')->middleware('auth');
Route::get('/forum/tag/{nya}', 'ForumController@byTag');
Route::get('/forum/cari', 'ForumController@feed');
Route::post('/forum/cari', 'ForumController@cari');
Route::get('/forum/{slug}', 'ForumController@baca');
// komentar forum
Route::post('/forum/{slug}', 'ForumController@comment')->middleware('auth');
Route::post('/forum/{slug}/c', 'ForumController@commentReply')->middleware('auth');

// forum function

// admin can delete the pinned the thread
Route::post('/forum/{slug}/pin', 'ForumController@pinned')->middleware('auth');
// admin can delete thread
Route::delete('/forum/{slug}/del', 'ForumController@delete')->middleware('auth');

Route::delete('/forum/{slug}/delete', 'ForumController@deleteByUser')->middleware('auth');

// the user thread can edit his/her thread
Route::get('/forum/{slug}/edit', 'ForumController@edit')->middleware('auth');
Route::post('/forum/{slug}/edit', 'ForumController@editSubmit')->middleware('auth');

// admin can delete comment and replied comment
Route::delete('/forum/delete-comment', 'ForumController@deleteComment');
<?php

use Illuminate\Support\Facades\Route;

// Admin Routes
Route::get('/', 'AdminController@home');
Route::get('/users', 'AdminController@users');
Route::get('/last-login', 'AdminController@lastLogin');
Route::get('/searches', 'AdminController@logSearches');
Route::get('/last_forum_posts', 'AdminController@lastThread');

Route::put('/change-user', 'AdminController@changeUser');
Route::post('/tagforum', 'AdminController@tagForum');
Route::get('/tagedit/{i}', 'AdminController@fetchTag');
Route::post('/editforum', 'AdminController@editTag');
Route::post('/taghapus', 'AdminController@tagHapus');

Route::post('/catscam', 'AdminController@addKategoriScam');
Route::get('/scamedit/{i}', 'AdminController@fetchScam');
Route::post('/editscam', 'AdminController@editScam');
Route::post('/scamhapus', 'AdminController@hapusScam');

Route::get('/setting', 'SettingController@badword');
Route::post('/setting/badword', 'SettingController@updateBadword');

// skill
Route::get('/skill', 'SkillController@showEdit');
Route::post('/skill/store', 'SkillController@store');
Route::get('/skill/store/child', 'SkillController@storeChild');
Route::post('/skill/store/child', 'SkillController@storeChildPost');
Route::post('/skill/save', 'SkillController@skillSave');
Route::get('/skill/child', 'SkillController@showChild');
Route::delete('/skill/child/delete', 'SkillController@deleteChild');

//forum
Route::get('/forum/kategori', 'ForumController@editKategori');
Route::post('/forum/kategori', 'ForumController@storeKategori');
Route::post('/forum/kategori/save', 'ForumController@postEditKategori');

// registled

Route::view('/registled', 'registled.admin.edit');

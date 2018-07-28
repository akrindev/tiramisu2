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
Route::get('/sitemap.xml', 'SitemapController@index');

/**
*
* Background Music
*/
Route::get('/bgm', 'BgmController@show');
Route::get('/bgm/{slug}', 'BgmController@single');
Route::post('/bgm/{slug}', 'BgmController@postComment')->middleware('auth');
Route::delete('/bgm/destroy', 'BgmController@destroy')->middleware('auth');
/**
* About Us
*/
Route::get('/kebijakan-privasi', 'AboutController@kebijakanPrivasi');
Route::get('/rules', 'AboutController@rules');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/uploader', 'ForumController@uploader');

Route::get('/exp', 'XpController@index');

Route::get('/fb-login', 'Auth\LoginController@redirect');
Route::get('/facebook/callback', 'Auth\LoginController@callback');

Route::get('/profile/notifikasi', 'UserController@notifikasi')->middleware('auth');

Route::get('/profile', 'UserController@profileku')->middleware('auth');

Route::get('/profile/{provider_id}', 'UserController@profile');

Route::post('/save/contact', 'UserController@saveContact');
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
Route::post('/edit/{id}/crysta', 'CrystaController@editPost')->middleware('auth');
Route::delete('/edit/crysta/delete', 'CrystaController@destroy')->middleware('auth');

Route::get('/store-crysta', 'CrystaController@tambah')->middleware('auth');

Route::post('/store-crysta', 'CrystaController@tambahPost')->middleware('auth');

Route::get('/fill_stats', 'FillController@index');
Route::get('/fill_stats/calculator', 'FillController@calculator');
Route::get('/fill_stats/add', 'FillController@add');
Route::post('/fill_stats/add', 'FillController@addPost');
Route::get('/fill_stats/{type}', 'FillController@single');
Route::get('/fill_stats/{type}/{plus}', 'FillController@single');
Route::get('/edit/{id}/fillstats', 'FillController@edit')->middleware('auth');
Route::post('/edit/{id}/fillstats', 'FillController@editPost')->middleware('auth');
Route::delete('/delete/fillstats', 'FillController@destroy')->middleware('auth');
/**
* Monster routes
*/
Route::get('/monster', 'MobController@index');
Route::get('/monster/{slug}', 'MobController@single');
Route::get('/peta/{slug}', 'MobController@peta');

Route::get('/store-mob', 'MobController@add')->middleware('auth');
Route::post('/store-mob', 'MobController@addPost')->middleware('auth');
Route::get('/edit/{id}/mobs', 'MobController@edit')->middleware('auth');
Route::post('/edit/{id}/mobs', 'MobController@editPost')->middleware('auth');
Route::delete('/edit/mob/delete', 'MobController@destroy')->middleware('auth');


Route::get('/cari', 'CariController@cari');
Route::post('/cari', 'CariController@cari');

/*
*
* Admin page
*/
Route::get('/admin', 'AdminController@home')->middleware(['admin']);

Route::get('/admin/users', 'AdminController@users')->middleware(['admin']);
Route::put('/admin/change-user', 'AdminController@changeUser')->middleware('admin');
Route::post('/admin/tagforum', 'AdminController@tagForum')->middleware('admin');
Route::get('/admin/tagedit/{i}', 'AdminController@fetchTag')->middleware('admin');
Route::post('/admin/editforum', 'AdminController@editTag')->middleware('admin');
Route::post('/admin/taghapus', 'AdminController@tagHapus')->middleware('admin');
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
Route::delete('/forum/delete-comment', 'ForumController@deleteComment')->middleware('auth');


/**
*
*
* Gallery
*/
Route::get('/gallery', 'GalleryController@index');
Route::post('/gallery', 'GalleryController@upload')->middleware('auth');
Route::get('/gallery/tag/{tag}', 'GalleryController@getByTag');
Route::get('/gallery/by/{provider_id}', 'GalleryController@getUserGallery');

Route::get('/gallery/{id}', 'GalleryController@single');
Route::post('/gallery/{id}', 'GalleryController@comment');
Route::get('/mygallery', 'GalleryController@myGallery')->middleware('auth');

Route::get('/gallery/{id}/edit', 'GalleryController@edit')->middleware('auth');
Route::post('/gallery/{id}/edit', 'GalleryController@editSubmit')->middleware('auth');

Route::delete('/gallery/destroy', 'GalleryController@destroy')->middleware('auth');
Route::delete('/gallery/destroy/comment', 'GalleryController@destroyComment')->middleware('auth');


/**
*
*
* Shop
*/
Route::get('/shop', 'ShopController@discover');
Route::get('/shop/show/{slug}', 'ShopController@show');
Route::get('/shop/edit/{slug}', 'ShopController@edit')->middleware('auth');
Route::post('/shop/edit/{slug}', 'ShopController@editSubmit')->middleware('auth');
Route::get('/shop/jual', 'ShopController@jual')->middleware('auth');
Route::post('/shop/jual', 'ShopController@jualSubmit')->middleware('auth');
Route::post('/ya/laku', 'ShopController@laku')->middleware('auth');
Route::delete('/shop/delete', 'ShopController@delete')->middleware('auth');


/**
*
* Quiz Toram
*/
Route::get('/quiz', 'QuizController@show');
Route::get('/quiz/score', 'QuizController@allScores');
Route::get('/quiz/mulai', 'QuizController@mulaiQuiz')->middleware('auth');
Route::get('/quiz/begin', 'QuizController@kerjakan')->middleware('auth');

Route::get('/quiz/i/{id}', 'QuizController@ajax')->middleware('auth');
Route::post('/quiz/save', 'QuizController@saveAnswer')->middleware('auth');
Route::get('/ajax/terjawab', 'QuizController@ajaxTerjawab')->middleware('auth');
Route::get('/quiz/koreksi', 'QuizController@koreksi')->middleware('auth');
Route::get('/quiz/profile', 'QuizController@myProfile')->middleware('auth');
Route::get('/quiz/edit/{id}', 'QuizController@edit')->middleware('auth');
Route::post('/quiz/edit/{id}', 'QuizController@editSubmit')->middleware('auth');
Route::post('/quiz/destroy', 'QuizController@destroy')->middleware('auth');

Route::get('/quiz/admin', 'QuizController@admin')->middleware('auth');

Route::get('/quiz/buat', 'QuizController@tambah');
Route::post('/quiz/buat', 'QuizController@tambahSubmit')->middleware('auth');
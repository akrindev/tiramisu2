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

Route::view('/', 'toram');

/*
| -- English Route
|---
*/
Route::prefix('en')->middleware('locale:en')->group(base_path('routes/en.php'));


// Registled
Route::view('/registlet', 'registled.show');


Route::view('/cb', 'cb');

// main quest simulator
Route::view('mq_exp', 'mq_exp');

// dye routes
Route::prefix('dye')->group(base_path('routes/dye.php'));

// avatar
Route::prefix('avatar')->group(base_path('routes/avatar.php'));

// cooking routes
Route::prefix('/cooking')->group(base_path('routes/cooking.php'));

Route::get('/latest_search', 'SitemapController@show');

/**
* Refine
*/
Route::view('/refine', 'refine.index');
Route::view('/refine/simulasi', 'refine.simulasi');


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
Route::get('/tentang-kami', 'AboutController@about');

Route::match(['get','post'], '/edit-tentang','AboutController@editAbout')->middleware('admin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/uploader', 'ForumController@uploader');

Route::get('/exp', 'XpController@index');
Route::view('/potensi/kalkulator', 'potensi_kalkulator');

// LOGIN
Route::get('/logindev', 'Auth\LoginController@devLogin');
Route::get('/fb-login', 'Auth\LoginController@redirect');
Route::get('/facebook/callback', 'Auth\LoginController@callback');

Route::get('/profile/{provider_id}', 'UserController@profile');

/**
*
* Setting
*/
Route::middleware('auth')->group(function() {
  Route::get('/setting/profile', 'UserController@settingProfile');
  Route::post('/setting/profile', 'UserController@settingProfileSubmit');
  Route::get('/profile/notifikasi', 'UserController@notifikasi');
  Route::get('/profile', 'UserController@profileku');
  Route::post('/save/contact', 'UserController@saveContact');
  Route::post('/send-token/fcm', 'UserController@sendToken');
});

// fill stats
Route::prefix('fill_stats')->group(base_path('routes/fill.php'));

/**
* skills
*/
Route::prefix('skill')->group(base_path('routes/skill.php'));

// Searching

Route::get('/search', 'SearchController@search');

/**
* Monster routes
*/
Route::get('/leveling', 'LevelingController@show');
Route::get('/peta', 'MonsterController@index');
Route::get('/peta/{id}', 'MonsterController@peta');

Route::get('/monsters', 'MonsterController@showAllMons');
Route::prefix('monster')->group(base_path('routes/monster.php'));


/**
* Item(s) routes
*/

Route::get('/items', 'ItemController@showAllItems');
Route::get('/items/{id}', 'ItemController@showItems');

Route::prefix('item')->group(base_path('routes/item.php'));


/**
* Contribution routes
*
Route::middleware(['auth'])->group(function() {
	Route::get('/contribution/show', 'ContributionController@show');
  	Route::post('/contribution/edit', 'ContributionController@edit');
  	Route::get('/contribution/fetch/{id}', 'ContributionController@fetch');
  	Route::get('/contribution/submit', 'ContributionController@mySubmition');

  	Route::middleware(['admin'])->group(function() {
    	Route::get('/contribution/sudo', 'ContributionController@moderasi');
    	Route::post('/contribution/sudo', 'ContributionController@sudoModerasi');
    });
});
**/

// CRUD
Route::get('/mons/fetch/{id}', 'MonsterController@fetchI')->middleware('admin');
Route::match(['get', 'post'], '/mons/store/resep', 'MonsterController@storeResep')->middleware('admin');
Route::delete('/mons/hapus/resep/{id}', 'MonsterController@hapusResep')->middleware('admin');
Route::get('/mons/data/drop', 'MonsterController@dataDrop')->middleware('admin');
Route::post('/mons/store/mobs', 'MonsterController@storeMob')->middleware('admin');
Route::match(['get', 'post'], '/mons/store', 'MonsterController@storeMons')->middleware('admin');
Route::match(['get', 'post'], '/store/peta', 'MonsterController@editMap')->middleware('admin');
Route::post('/save/new-map', 'MonsterController@addMap')->middleware('admin');
// -- CRUD

// NPC
Route::get('/npc', 'NpcController@show');
Route::get('/npc/npc-{id}', 'NpcController@quest');
Route::get('/npc/quest/{id}', 'NpcController@singleQuest');

Route::middleware(['admin'])->group(function(){
  Route::match(['get', 'post'], '/npc/store', 'NpcController@store');
  Route::match(['get', 'post'], '/npc/store/quest', 'NpcController@storeQuest');

  Route::get('/npc/edit/{id}', 'NpcController@editNpc');
  Route::put('/npc/edit', 'NpcController@editNpcSubmit');
  Route::delete('/npc/delete-quest/{id}', 'NpcController@deleteQuest');
  Route::delete('/npc/delete-npc/{id}', 'NpcController@deleteNpc');
});
// --NPC

/*
*
* Admin routes
*/
Route::prefix('admin')->middleware('admin')->group(base_path('routes/admin.php'));

/**
* Forum Routes
*/

Route::prefix('forum')->group(base_path('routes/forum.php'));

// short forum link
Route::get('f/{id}', 'ForumController@bacaId');

/**
*
*
* Gallery
*/
Route::prefix('gallery')->group(base_path('routes/gallery.php'));

/**
* Shop
*
Route::get('/shop', 'ShopController@discover');
Route::get('/shop/show/{slug}', 'ShopController@show');
Route::get('/shop/edit/{slug}', 'ShopController@edit')->middleware('auth');
Route::post('/shop/edit/{slug}', 'ShopController@editSubmit')->middleware('auth');
Route::get('/shop/jual', 'ShopController@jual')->middleware('auth');
Route::post('/shop/jual', 'ShopController@jualSubmit')->middleware('auth');
Route::post('/ya/laku', 'ShopController@laku')->middleware('auth');
Route::delete('/shop/delete', 'ShopController@delete')->middleware('auth');
*/

/**
*
* Quiz routes
*/
Route::prefix('quiz')->group(base_path('routes/quiz.php'));


/**
*
* Scammer route
*
Route::get('/scammer', 'ScammerController@show');
Route::get('/scammer/cari', 'ScammerController@cari');
Route::get('/scammer/kategori/{id}', 'ScammerController@kategori');
Route::get('/scammer/{slug}/edit', 'ScammerController@edit')->middleware('auth');
Route::post('/scammer/{slug}/edit', 'ScammerController@editPost')->middleware('auth');

Route::post('/scammer/img', 'ScammerController@editImg')->middleware('auth');
Route::delete('/scammer/delete', 'ScammerController@scammerDelete')->middleware('auth');
Route::delete('/scammer/delete-by-admin', 'ScammerController@deleteByAdmin')->middleware('admin');

Route::get('/scammer/tambah', 'ScammerController@add')->middleware('auth');
Route::post('/scammer/tambah', 'ScammerController@addPost')->middleware('auth');
//Read
Route::get('/scammer/r/{slug}', 'ScammerController@read');
Route::post('/scammer/r/{slug}', 'ScammerController@comment')->middleware('auth');
Route::post('/scammer/r/{slug}/c', 'ScammerController@commentReply')->middleware('auth');
Route::delete('/scammer/delete-comment', 'ScammerController@deleteComment')->middleware('admin');

*/

/**
* Emblem Route
*/
Route::prefix('prestasi')->group(base_path('routes/prestasi.php'));

Route::prefix('webview')->group(function() {
  	Route::view('/eq', 'webview.monster.menu_eq');
  	Route::view('/exp', 'webview.xp_calculator');

	Route::get('/item/{id}', 'WebView\MonsterController@showItem');
	Route::get('/items/{id}', 'WebView\MonsterController@showItems');

  	Route::get('/leveling', 'WebView\MonsterController@leveling');

  	Route::view('/fill/calculator', 'webview.fill_calculator');


    Route::get('/prestasi', 'WebView\EmblemController@index');
    Route::get('/prestasi/{id}', 'WebView\EmblemController@show');


    Route::get('/monster', 'WebView\MonsterController@index');
    Route::get('/monster/{id}', 'WebView\MonsterController@showMons');
    Route::get('/monster/type/{name}', 'WebView\MonsterController@showMonsType');
    Route::get('/monster/unsur/{type}', 'WebView\MonsterController@showMonsEl');


    Route::get('/peta', 'WebView\MonsterController@index');
    Route::get('/peta/{id}', 'WebView\MonsterController@peta');


    Route::get('/search', 'WebView\MonsterController@search');
});


// Mails
Route::prefix('email')->middleware('admin')->group(function(){
	Route::view('write', 'emails.write');
  	// send email to specific user
  	Route::post('send', 'SendMailController@mailToUser');
 	// send to all users
  	Route::post('sendtoall', 'SendMailController@mailToAllUser');

  	Route::get('user_emails', 'SendMailController@hasEmail');
  	Route::view('history', 'emails.history');
  	Route::get('baca/{id}', 'SendMailController@getLog');
  	Route::get('log', 'SendMailController@logMail');
});
<?php

use Illuminate\Support\Facades\Route;
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

// secrets message
Route::prefix('secrets')->group(function () {
    Route::get('/{user:username}', 'SecretMessageController@show');
    Route::post('/{user:username}/post', 'SecretMessageController@store');
    Route::post('/{user:username}/reply', 'SecretMessageController@reply');
});

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

Route::match(['get', 'post'], '/edit-tentang', 'AboutController@editAbout')->middleware('admin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/uploader', 'ForumController@uploader');

Route::get('/exp', 'XpController@index');
Route::view('/potensi/kalkulator', 'potensi_kalkulator');

// LOGIN
Route::get('/logindev', 'Auth\LoginController@devLogin');
Route::get('/fb-login', 'Auth\LoginController@redirect');
Route::get('/tw-login', 'Auth\LoginController@redirectTwitter');

Route::get('/facebook/callback', 'Auth\LoginController@callback');
Route::get('/twitter/callback', 'Auth\LoginController@callbackTwitter');

Route::get('/profile/{provider_id}', 'UserController@profile');

/**
 *
 * Setting
 */
Route::middleware('auth')->group(function () {
    Route::get('/setting/profile', 'UserController@settingProfile');
    Route::put('/setting/profile', 'UserController@settingProfileSubmit');
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
 * Appearance
 */
Route::prefix('appearance')->group(function () {
    Route::get('/', 'AppearanceController@show');
    Route::get('/{type}', 'AppearanceController@type');
});

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

Route::middleware(['admin'])->group(function () {
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

// temp routes
Route::prefix('temp')->group(base_path('routes/temp.php'));

/**
 *
 * Quiz routes
 */
Route::prefix('quiz')->group(base_path('routes/quiz.php'));

/**
 * Emblem Route
 */
Route::prefix('prestasi')->group(base_path('routes/prestasi.php'));

// Mails
Route::prefix('email')->middleware('admin')->group(function () {
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

Route::resource('guilds', 'GuildController');

Route::middleware('auth')->group(function () {
    Route::post('guilds/{id}/p', 'GuildController@addMember')->name('guilds.member');
    Route::post('guilds/{id}', 'GuildController@pindahKetuaSerikat')->name('guilds.ketua');
    Route::delete('guilds/{id}/r', 'GuildController@removeMember')->name('guilds.remove.member');
    Route::get('guilds/{id}/a', 'GuildController@accepting')->name('guilds.accept');
});

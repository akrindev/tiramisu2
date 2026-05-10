<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AppearanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BgmController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\GuildController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LevelingController;
use App\Http\Controllers\MonsterController;
use App\Http\Controllers\NpcController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SecretMessageController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\XpController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

/*
| -- English Route
|---
*/
Route::prefix('en')->middleware('locale:en')->group(base_path('routes/en.php'));

// Registled
Route::view('/registlet', 'registled.show');

// developer documentation api
Route::view('developer', 'developer.api');

// secrets message
Route::prefix('secrets')->group(function () {
    Route::get('/{user:username}', [SecretMessageController::class, 'show']);
    Route::post('/{user:username}/post', [SecretMessageController::class, 'store']);
    Route::post('/{user:username}/reply', [SecretMessageController::class, 'reply']);
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

Route::get('/latest_search', [SitemapController::class, 'show']);

/**
 * Refine
 */
Route::view('/refine', 'refine.index');
Route::view('/refine/simulasi', 'refine.simulasi');

/**
 * Background Music
 */
Route::get('/bgm', [BgmController::class, 'show']);
Route::get('/bgm/{slug}', [BgmController::class, 'single']);
Route::post('/bgm/{slug}', [BgmController::class, 'postComment'])->middleware('auth');
Route::delete('/bgm/destroy', [BgmController::class, 'destroy'])->middleware('auth');

/**
 * About Us
 */
Route::get('/kebijakan-privasi', [AboutController::class, 'kebijakanPrivasi']);
Route::get('/rules', [AboutController::class, 'rules']);
Route::get('/tentang-kami', [AboutController::class, 'about']);

Route::match(['get', 'post'], '/edit-tentang', [AboutController::class, 'editAbout'])->middleware('admin');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/uploader', [ForumController::class, 'uploader']);

Route::get('/exp', [XpController::class, 'index']);
Route::view('/potensi/kalkulator', 'potensi_kalkulator');

// LOGIN
Route::get('/logindev', [LoginController::class, 'devLogin']);

Route::match(['get', 'post'], '/fb-login', [LoginController::class, 'redirect']);
Route::match(['get', 'post'], '/tw-login', [LoginController::class, 'redirectTwitter']);
Route::match(['get', 'post'], '/google-login', [LoginController::class, 'redirectGoogle']);

Route::get('/facebook/callback', [LoginController::class, 'callback']);
Route::get('/twitter/callback', [LoginController::class, 'callbackTwitter']);
Route::get('/google/callback', [LoginController::class, 'callbackGoogle']);

Route::post('/google/one-tap', [LoginController::class, 'handleGoogleOneTap'])->name('auth.google.onetap');

Route::get('/profile/{provider_id}', [UserController::class, 'profile']);

/**
 * Setting
 */
Route::middleware('auth')->group(function () {
    Route::get('/setting/profile', [UserController::class, 'settingProfile']);
    Route::put('/setting/profile', [UserController::class, 'settingProfileSubmit']);
    Route::get('/profile/notifikasi', [UserController::class, 'notifikasi']);
    Route::get('/profile', [UserController::class, 'profileku']);
    Route::post('/save/contact', [UserController::class, 'saveContact']);
    Route::post('/send-token/fcm', [UserController::class, 'sendToken']);

    // account deletion
    Route::delete('/setting/user/delete', [UserController::class, 'deleteAccount'])->name('user.delete');
});
Route::get('/account-deletion/details/{code}', [UserController::class, 'confirmDeletionAccount'])->name('user.delete.request');
Route::post('/account-deletion/request', [UserController::class, 'requestDeletionAccount']);

// fill stats
Route::prefix('fill_stats')->group(base_path('routes/fill.php'));

/**
 * skills
 */
Route::prefix('skill')->group(base_path('routes/skill.php'));

// Searching
Route::get('/search', [SearchController::class, 'search']);

/**
 * Monster routes
 */
Route::get('/leveling', [LevelingController::class, 'show']);
Route::get('/peta', [MonsterController::class, 'index']);
Route::get('/peta/{id}', [MonsterController::class, 'peta']);

Route::get('/monsters', [MonsterController::class, 'showAllMons']);
Route::prefix('monster')->group(base_path('routes/monster.php'));

/**
 * Item(s) routes
 */
Route::get('/items', [ItemController::class, 'showAllItems']);
Route::get('/items/{id}', [ItemController::class, 'showItems']);

Route::prefix('item')->group(base_path('routes/item.php'));

/**
 * Appearance
 */
Route::prefix('appearance')->group(function () {
    Route::get('/', [AppearanceController::class, 'show']);
    Route::get('/{type}', [AppearanceController::class, 'type']);
});

// CRUD
Route::get('/mons/fetch/{id}', [MonsterController::class, 'fetchI'])->middleware('admin');
Route::match(['get', 'post'], '/mons/store/resep', [MonsterController::class, 'storeResep'])->middleware('admin');
Route::delete('/mons/hapus/resep/{id}', [MonsterController::class, 'hapusResep'])->middleware('admin');
Route::get('/mons/data/drop', [MonsterController::class, 'dataDrop'])->middleware('admin');
Route::post('/mons/store/mobs', [MonsterController::class, 'storeMob'])->middleware('admin');
Route::match(['get', 'post'], '/mons/store', [MonsterController::class, 'storeMons'])->middleware('admin');
Route::match(['get', 'post'], '/store/peta', [MonsterController::class, 'editMap'])->middleware('admin');
Route::post('/save/new-map', [MonsterController::class, 'addMap'])->middleware('admin');
// -- CRUD

// NPC
Route::get('/npc', [NpcController::class, 'show']);
Route::get('/npc/npc-{id}', [NpcController::class, 'quest']);
Route::get('/npc/quest/{id}', [NpcController::class, 'singleQuest']);

Route::middleware(['admin'])->group(function () {
    Route::match(['get', 'post'], '/npc/store', [NpcController::class, 'store']);
    Route::match(['get', 'post'], '/npc/store/quest', [NpcController::class, 'storeQuest']);

    Route::get('/npc/edit/{id}', [NpcController::class, 'editNpc']);
    Route::put('/npc/edit', [NpcController::class, 'editNpcSubmit']);
    Route::delete('/npc/delete-quest/{id}', [NpcController::class, 'deleteQuest']);
    Route::delete('/npc/delete-npc/{id}', [NpcController::class, 'deleteNpc']);
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
Route::get('f/{id}', [ForumController::class, 'bacaId']);

/**
 * Gallery
 */
Route::prefix('gallery')->group(base_path('routes/gallery.php'));

// temp routes
Route::prefix('temp')->group(base_path('routes/temp.php'));

/**
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
    Route::post('send', [SendMailController::class, 'mailToUser']);
    // send to all users
    Route::post('sendtoall', [SendMailController::class, 'mailToAllUser']);

    Route::get('user_emails', [SendMailController::class, 'hasEmail']);
    Route::view('history', 'emails.history');
    Route::get('baca/{id}', [SendMailController::class, 'getLog']);
    Route::get('log', [SendMailController::class, 'logMail']);
});

Route::resource('guilds', GuildController::class);

Route::middleware('auth')->group(function () {
    Route::post('guilds/{id}/p', [GuildController::class, 'addMember'])->name('guilds.member');
    Route::post('guilds/{id}', [GuildController::class, 'pindahKetuaSerikat'])->name('guilds.ketua');
    Route::delete('guilds/{id}/r', [GuildController::class, 'removeMember'])->name('guilds.remove.member');
    Route::get('guilds/{id}/a', [GuildController::class, 'accepting'])->name('guilds.accept');
});

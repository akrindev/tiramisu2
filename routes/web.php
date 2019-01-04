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

Route::prefix('/cooking')->group(function () {
  Route::get('/', 'CookingController@index');

  Route::middleware('admin')->group(function() {
  	Route::view('/store', 'cooking.store');
    Route::post('/store', 'CookingController@store');

    Route::delete('/delete/{id}', 'CookingController@delete');
  });
});

Route::get('/sitemap.xml', 'SitemapController@index');
Route::post('/send-token/fcm', 'UserController@sendToken');

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

// fill stats
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
* skills
*/
Route::get('/skill', 'SkillController@index');
Route::get('/skill/{name}', 'SkillController@show');
Route::get('/skill/{parent}/{child}', 'SkillController@single');
Route::post('/skill/{parent}/{child}', 'SkillController@comment');
Route::middleware(['admin'])->group(function() {
	Route::get('/skill/e/{id}/edit', 'SkillController@edit');
  	Route::post('/skill/e/{id}/save', 'SkillController@save');
  	Route::delete('/skill-delete-comment', 'SkillController@deleteComment');
});

/**
* Monster routes
*/
Route::get('/search', 'MonsterController@search');
Route::get('/leveling', 'MonsterController@leveling');
Route::get('/monster', 'MonsterController@index');
Route::get('/monster/{id}', 'MonsterController@showMons');
Route::get('/monster/type/{name}', 'MonsterController@showMonsType');
Route::get('/monster/unsur/{type}', 'MonsterController@showMonsEl');
Route::get('/item/{id}', 'MonsterController@showItem');
Route::get('/items/{id}', 'MonsterController@showItems');
Route::get('/peta', 'MonsterController@index');
Route::get('/peta/{id}', 'MonsterController@peta');

Route::get('/monster/{id}/edit', 'MonsterController@editMons')->middleware('admin');
Route::post('/monster/{id}/edit', 'MonsterController@editMobPost')->middleware('admin');
Route::delete('/monster/{id}/hapus', 'MonsterController@monsHapus')->middleware('admin');
Route::get('/item/{id}/edit', 'MonsterController@editItem')->middleware('admin');
Route::post('/item/{id}/edit', 'MonsterController@editItemPost')->middleware('admin');
Route::delete('/item/{id}/hapus', 'MonsterController@hapusItem')->middleware('admin');

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

// CRUD
Route::get('/mons/fetch/{id}', 'MonsterController@fetchI')->middleware('admin');
Route::match(['get', 'post'], '/mons/store/resep', 'MonsterController@storeResep')->middleware('admin');
Route::delete('/mons/hapus/resep/{id}', 'MonsterController@hapusResep')->middleware('admin');
Route::get('/mons/data/drop', 'MonsterController@dataDrop')->middleware('admin');
Route::post('/mons/store/mobs', 'MonsterController@storeMob')->middleware('admin');
Route::match(['get', 'post'], '/mons/drop/store', 'MonsterController@storeDrop')->middleware('admin');
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
* Admin page
*/
Route::get('/admin', 'AdminController@home')->middleware(['admin']);

Route::get('/admin/users', 'AdminController@users')->middleware(['admin']);
Route::get('/admin/searches', 'AdminController@logSearches')->middleware(['admin']);
Route::put('/admin/change-user', 'AdminController@changeUser')->middleware('admin');
Route::post('/admin/tagforum', 'AdminController@tagForum')->middleware('admin');
Route::get('/admin/tagedit/{i}', 'AdminController@fetchTag')->middleware('admin');
Route::post('/admin/editforum', 'AdminController@editTag')->middleware('admin');
Route::post('/admin/taghapus', 'AdminController@tagHapus')->middleware('admin');

Route::post('/admin/catscam', 'AdminController@addKategoriScam')->middleware('admin');
Route::get('/admin/scamedit/{i}', 'AdminController@fetchScam')->middleware('admin');
Route::post('/admin/editscam', 'AdminController@editScam')->middleware('admin');
Route::post('/admin/scamhapus', 'AdminController@hapusScam')->middleware('admin');

/**
* Forum Routes
*/
Route::get('/forum', 'ForumController@feed');
Route::get('/forum/baru', 'ForumController@buat')->middleware('auth');
Route::post('/forum/baru', 'ForumController@buatSubmit')->middleware('auth');
Route::get('/forum/tag/{nya}', 'ForumController@byTag');
Route::get('/forum/cari', 'ForumController@feed');
Route::post('/forum/cari', 'ForumController@cari');
Route::post('/forum/like', 'ForumController@postLike');
Route::post('/forum/likereply', 'ForumController@postLikeReply');

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
// quiz with code
Route::get('/quiz/buat-kode', 'QuizController@buatKode')->middleware('auth');
Route::post('/quiz/buat-kode', 'QuizController@buatKodePost')->middleware('auth');
Route::post('/quiz/cek-kode', 'QuizController@cekKode');
Route::get('/quiz/kode/{code}', 'QuizController@lihatKode');
Route::get('/quiz/kode/{code}/mulai', 'QuizController@ambilQuiz')->middleware('auth');
Route::get('/quiz/code/begin', 'QuizController@kerjakanByCode')->middleware('auth');
Route::get('/quiz/code/koreksi', 'QuizController@koreksiByCode')->middleware('auth');

/**
*
* Scammer route
*/
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


/**
* Emblem Route
*/
Route::middleware('admin')->group(function() {
  Route::view('/prestasi/add', 'emblem.add');
  Route::post('/prestasi/add', 'EmblemController@store');
  Route::get('/prestasi/{id}/edit', 'EmblemController@edit');
  Route::put('/prestasi/{id}/edit', 'EmblemController@editPost');
});
Route::get('/prestasi', 'EmblemController@index');
Route::get('/prestasi/{id}', 'EmblemController@show');

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
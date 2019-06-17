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
Route::view('/cb', 'cb');

// dye routes
Route::prefix('dye')->group(function() {
	Route::get('/', 'DyeController@home');

  	Route::middleware('admin')->group(function() {
    	Route::get('store', 'DyeController@store');
    	Route::post('store', 'DyeController@storeDye');
      	Route::delete('delete', 'DyeController@delete');
    });
});

Route::prefix('/cooking')->group(function () {
  Route::redirect('/', '/cooking/berteman');
  Route::view('/berteman', 'cooking.tukar');
  Route::get('buff', 'CookingController@buff');

  Route::middleware('admin')->group(function() {
  	Route::view('/store', 'cooking.store');
    Route::post('/store', 'CookingController@store');

    Route::delete('/delete/{id}', 'CookingController@delete');
  });
});

Route::get('/latest_search', 'SitemapController@show');
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

// LOGIN
Route::get('/logindev', 'Auth\LoginController@devLogin');
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
Route::get('/leveling', 'LevelingController@show');
Route::get('/peta', 'MonsterController@index');
Route::get('/peta/{id}', 'MonsterController@peta');

Route::prefix('monster')->group(function() {
	Route::get('/', 'MonsterController@index');
	Route::get('/{id}', 'MonsterController@showMons');
	Route::get('/type/{name}', 'MonsterController@showMonsType');
	Route::get('/unsur/{type}', 'MonsterController@showMonsEl');

  	// admin route
  	Route::middleware('admin')->group(function() {
		Route::get('/{id}/edit', 'MonsterController@editMons');
		Route::post('/{id}/edit', 'MonsterController@editMobPost');
		Route::delete('/{id}/hapus', 'MonsterController@monsHapus');
    });
});


/**
* Item(s) routes
*/

Route::get('/items/{id}', 'MonsterController@showItems');

Route::prefix('item')->group(function() {
	Route::get('/{id}', 'MonsterController@showItem');

  	// admin route
  	Route::middleware('admin')->group(function() {
		Route::get('/{id}/edit', 'MonsterController@editItem');
		Route::post('/{id}/edit', 'MonsterController@editItemPost');
		Route::delete('/{id}/hapus', 'MonsterController@hapusItem');
    });
});


/**
* Contribution routes
*/
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
* Admin routes
*/
Route::prefix('admin')->middleware('admin')->group(function(){
    Route::get('/', 'AdminController@home');
    Route::get('/users', 'AdminController@users');
    Route::get('/last-login', 'AdminController@lastLogin');
    Route::get('/searches', 'AdminController@logSearches');
    Route::put('/change-user', 'AdminController@changeUser');
    Route::post('/tagforum', 'AdminController@tagForum');
    Route::get('/tagedit/{i}', 'AdminController@fetchTag');
    Route::post('/editforum', 'AdminController@editTag');
    Route::post('/taghapus', 'AdminController@tagHapus');

    Route::post('/catscam', 'AdminController@addKategoriScam');
    Route::get('/scamedit/{i}', 'AdminController@fetchScam');
    Route::post('/editscam', 'AdminController@editScam');
    Route::post('/scamhapus', 'AdminController@hapusScam');
});

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
* Quiz routes
*/
Route::prefix('quiz')->group(function() {
	Route::get('/', 'QuizController@show');
	Route::get('/score', 'QuizController@allScores');
	Route::get('/buat', 'QuizController@tambah');
	Route::post('/cek-kode', 'QuizController@cekKode');
	Route::get('/kode/{code}', 'QuizController@lihatKode');

  	// must be login
  	Route::middleware('auth')->group(function() {
    	Route::get('/mulai', 'QuizController@mulaiQuiz');
		Route::get('/begin', 'QuizController@kerjakan');

      	Route::get('/kode/{code}/mulai', 'QuizController@ambilQuiz');
        Route::get('/code/begin', 'QuizController@kerjakanByCode');
        Route::get('/code/koreksi', 'QuizController@koreksiByCode');

		Route::get('/i/{id}', 'QuizController@ajax');
        Route::post('/save', 'QuizController@saveAnswer');
        Route::get('/ajax/terjawab', 'QuizController@ajaxTerjawab');
        Route::get('/koreksi', 'QuizController@koreksi');
        Route::get('/profile', 'QuizController@myProfile');
		Route::post('/buat', 'QuizController@tambahSubmit');
        Route::get('/edit/{id}', 'QuizController@edit');
        Route::post('/edit/{id}', 'QuizController@editSubmit');


        Route::get('/buat-kode', 'QuizController@buatKode');
        Route::post('/buat-kode', 'QuizController@buatKodePost');
    });

  	// admin
  	Route::middleware('admin')->group(function() {
      Route::post('/destroy', 'QuizController@destroy');
	  Route::get('/admin', 'QuizController@admin');
    });
});


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
  Route::delete('/prestasi/{id}/hapus', 'EmblemController@hapus');
});

Route::get('/prestasi', 'EmblemController@index');
Route::get('/prestasi/{id}', 'EmblemController@show');
Route::get('/prestasi/reward/{name}', 'EmblemController@byReward');


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
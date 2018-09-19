<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

Route::get('/', 'HomeController@index');

Auth::routes();
Route::post('userlogin','Auth\\LoginController@authenticate');
Route::get('password/change','Auth\\ChangePasswordController@changeform');
Route::post('password/change','Auth\\ChangePasswordController@change');

Route::get('/home', 'HomeController@index');
Route::get('/redirect/{provider}', 'SocialAuthController@redirect');
Route::get('/callback/{provider}', 'SocialAuthController@callback');

Route::get('karir', function () {
    return redirect('page/karir');
});

Route::group(array('prefix' => 'admin', 'middleware' => 'AuthAdmin'), function() {
    // main page for the admin section (app/views/admin/dashboard.blade.php)
//    Route::get('/', function() {
//        return View::make('admin.index');
//    });
    Route::get('/', 'Admin\\AnalyticsController@index');
    Route::get('/pendingposts', 'PostsController@pendingposts');
    Route::get('/publishposts', 'PostsController@publishposts');
    Route::get('/publishposts/data', 'PostsController@publishpostsData');
    Route::resource('/banners', 'Admin\\BannersController');
    Route::resource('/categories', 'Admin\\CategoriesController');
    Route::resource('/featured_categories', 'Admin\\Featured_categoriesController');
    Route::resource('/competitions', 'Admin\\CompetitionsController');
    Route::get('/competition_posts/data/{a}', 'Admin\\Competition_postsController@indexdata');
    Route::post('/competition_posts/like', 'Admin\\Competition_postsController@like');
    Route::post('/competition_posts/unlike', 'Admin\\Competition_postsController@unlike');
    //Route::get('/competition_posts/like/{a}/{b}', 'Admin\\Competition_postsController@likeget');
    Route::get('/competition_posts/{a}', 'Admin\\Competition_postsController@index');
    Route::get('/workshop_posts/{a}', 'Admin\\Workshop_postsController@index');
    Route::resource('/workshop_posts', 'Admin\\Workshop_postsController');
    Route::resource('/workshops', 'Admin\\WorkshopController');
    Route::get('/workshops/peserta/{a}', 'Admin\\WorkshopController@peserta');
    Route::get('/workshops_posts/{a}/{b}', 'Admin\\Workshop_postsController@files');
    Route::resource('/competition_posts', 'Admin\\Competition_postsController');
    Route::resource('/pages', 'Admin\\PagesController');
    Route::get('/users/search', 'Admin\\UsersController@search');
    Route::get('/users/changepassword/{a}', 'Admin\\UsersController@changeform');
    Route::post('/users/changepass', 'Admin\\UsersController@changepassword');
    Route::resource('/users/data', 'Admin\\UsersController@indexdata');
    Route::resource('/users', 'Admin\\UsersController');
    Route::resource('/statistics/search', 'Admin\\StatisticsController@search');
    Route::resource('/statistics', 'Admin\\StatisticsController');
    Route::resource('/newsflash', 'Admin\\NewsflashesController');
    Route::resource('/shops/data', 'Admin\\ShopsController@indexdata');
    Route::resource('/shops', 'Admin\\ShopsController');
    Route::get('/emailresetblastv3/{a}/{b}', 'Auth\\BlastResetPasswordController@resetrange');
    Route::get('/emailresetblastv3', 'Auth\\BlastResetPasswordController@resetall');
    Route::get('/hiddenposts', 'PostsController@hiddenposts');
    Route::get('/lockedposts', 'PostsController@lockedposts');
    Route::get('/emailfillprofession','ProfileController@EmailFillProfession');
    Route::get('/analytics', 'Admin\\AnalyticsController@index');
});

     Route::resource('messages', 'MessagesController');
     Route::get('messageautocomplete',array('as'=>'messageautocomplete','uses'=>'MessagesController@autoComplete'));
     Route::get('userautocomplete',array('as'=>'userautocomplete','uses'=>'UserController@autoComplete'));
     Route::get('postwauthorautocomplete',array('as'=>'postwauthorautocomplete','uses'=>'PostsController@postwauthorautocomplete'));
     Route::get('compostautocomplete/{competitionid}',array('as'=>'compostautocomplete','uses'=>'Admin\\Competition_postsController@autocomplete'));

Route::get('/kirim-tulisan', 'PostsController@kirimtulisan')->middleware('auth');
Route::get('/kirim-tulisan/lomba/{a}', 'PostsController@kirimtulisanlomba')->middleware('auth');
Route::get('/kirim-tulisan/workshop/{a}', 'PostsController@kirimtulisanworkshop')->middleware('auth');
Route::get('/edit-workshop/{a}/{b}', 'WorkshopController@edit');
Route::get('/edit-tulisan/{a}', 'PostsController@edittulisan')->middleware('auth');
Route::get('/profile', 'ProfileController@profil');
Route::get('/profile/edit', 'ProfileController@edit')->middleware('auth');
Route::get('/profile/edit/{a}', 'ProfileController@edit')->middleware('auth');
Route::patch('/profile/update', 'ProfileController@update')->middleware('auth');
Route::get('/profile/tulisan/{a}', 'ProfileController@tulisan');
Route::get('/profile/buqu/{a}', 'ProfileController@buqu');
Route::get('/profile/{a}', 'ProfileController@profil');
Route::get('/penulis', 'ProfileController@populer');
Route::get('/penulis-favorit', 'ProfileController@favorit');
Route::get('/penulis-terbaru', 'ProfileController@terbaru');
Route::get('/penulis-populer', 'ProfileController@populer');
Route::get('/penulis-produktif', 'ProfileController@produktif');
Route::post('/user/follow', 'UserController@follow');
Route::post('/user/unfollow', 'UserController@unfollow');
Route::get('/cari', 'QueryController@search');
Route::get('/post', 'PostsController@terbaru');
Route::get('/artikel-terbaru', 'PostsController@terbaru');
Route::get('/artikel-populer', 'PostsController@populer');
Route::get('/rekam', 'PostsController@rekam')->middleware('auth');
Route::get('/shop', 'ShopsController@index');
Route::get('/shop/{a}', 'ShopsController@indexcategory');
Route::post('/post/bookmark', 'PostsController@bookmark');
Route::post('/post/unbookmark', 'PostsController@unbookmark');
Route::post('/post/ajaximageupload','PostsController@ajaximageupload');
Route::get('/jejak', 'PostsController@jejak');
Route::post('/post/incrementviewcounter', 'PostsController@incrementviewcounter');
Route::post('/post/incrementsharecounter', 'PostsController@incrementsharecounter');
Route::post('/post/incrementlikecounter', 'PostsController@incrementlikecounter');
Route::post('/post/decrementlikecounter', 'PostsController@decrementlikecounter');
Route::post('/post/autosave', 'PostsController@autosave');
Route::post('/post/like', 'PostsController@like');
Route::post('/post/unlike', 'PostsController@unlike');
Route::get('/tulisanku', 'PostsController@tulisanku');
Route::get('/tulisanku/{a}', 'PostsController@tulisanku');
Route::get('buqu', 'BuqusController@terbaru');
Route::get('rakbuqu', 'BuqusController@rakbuqu');
Route::get('buqu-pilihan', 'BuqusController@pilihan');
Route::get('buqu-terbaru', 'BuqusController@terbaru');
Route::get('buqu-populer', 'BuqusController@populer');
Route::post('buqu/deletepost', 'Buqu_postsController@deletepost');
Route::post('/buqu/like', 'BuqusController@like')->middleware('auth');
Route::post('/buqu/unlike', 'BuqusController@unlike')->middleware('auth');
Route::post('/buqu/incrementsharecounter', 'BuqusController@incrementsharecounter');
Route::post('/buqu/incrementlikecounter', 'BuqusController@incrementlikecounter');
Route::post('/buqu/decrementlikecounter', 'BuqusController@decrementlikecounter');
Route::get('buqu/{a}', 'BuqusController@showpermalink');
Route::post('/buqu/feature', 'BuqusController@feature');
Route::post('/buqu/unfeature', 'BuqusController@unfeature');
Route::resource('buqus', 'BuqusController');
Route::get('buqu_posts/create/{a}', 'Buqu_postsController@create');
Route::post('buqu_posts/createajax', 'Buqu_postsController@createajax');
Route::get('buqu_posts/createajax', 'Buqu_postsController@createajax');
Route::resource('buqu_posts', 'Buqu_postsController');
Route::resource('posts', 'PostsController');

Route::get('postsautocomplete',array('as'=>'postsautocomplete','uses'=>'PostsController@autoComplete'));
Route::get('/setArtikelTerkait', array('as'=>'setArtikelTerkait','uses'=>'PostsController@setArtikelTerkait'));

Route::resource('profiles', 'ProfilesController');
Route::get('/lomba-esai', 'LombaController@index');
Route::resource('workshop', 'WorkshopController');
Route::get('workshop/peserta/{a}', 'WorkshopController@peserta');
Route::get('/page/{a}', 'Admin\\PagesController@showpermalink');
Route::get('/topik-redaksi/{a}', 'PostsController@showfcategoryposts');
Route::get('/topik/{a}', 'PostsController@showcategoryposts');
Route::get('/semua-topik', 'PostsController@showsemuatopik');
Route::get('/post/{a}', 'PostsController@showpermalink');
Route::get('/user/ddjson', 'UserController@ddjson');
Route::post('/user/marknotifasread', 'UserController@marknotifasread');
Route::post('/froala/upload_image', 'FroalaController@upload_image');
Route::get('/peserta-lomba-esai', 'LombaController@peserta');
Route::get('/peserta-lomba-esai/{a}', 'LombaController@post_peserta');
Route::resource('admin/competition_winner', 'Admin\\Competition_winnerController');
Route::get('/hometest', 'HomeController@hometest');

//Route::post('/api/save-subscription', 'PushSubscriptionController@save_subscription');

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/save-subscription', 'PushSubscriptionController@save_subscription');
Route::post('/send-notification', 'PushSubscriptionController@send_notification');

/* API for Qureta App */
Route::get('/userLogin', 'ApiControllers\\AuthController@login');
Route::get('/socialLogin', 'ApiControllers\\AuthController@socialLogin');
Route::get('/userRegister', 'ApiControllers\\AuthController@userRegister');

Route::get('/randomToken', 'ApiControllers\\UserController@randomToken');
Route::get('/checkToken', 'ApiControllers\\UserController@checkToken');
Route::get('/getUsername', 'ApiControllers\\UserController@getUsername');
Route::get('/getEmail', 'ApiControllers\\UserController@getEmail');
Route::get('/getUserNameFull', 'ApiControllers\\UserController@getUserNameFull');
Route::get('/getId', 'ApiControllers\\UserController@getId');
Route::get('/getName', 'ApiControllers\\UserController@getName');
Route::get('/getRole', 'ApiControllers\\UserController@getRole');
Route::get('/getUserImage', 'ApiControllers\\UserController@getUserImage');
Route::get('/getPostCount', 'ApiControllers\\UserController@getPostCount');
Route::get('/getKota', 'ApiControllers\\UserController@getKota');
Route::get('/getLinkedIn', 'ApiControllers\\UserController@getLinkedIn');
Route::get('/getMinat', 'ApiControllers\\UserController@getMinat');
Route::get('/getPendidikan', 'ApiControllers\\UserController@getPendidikan');
Route::get('/getProfesi', 'ApiControllers\\UserController@getProfesi');
Route::get('/getShortBio', 'ApiControllers\\UserController@getShortBio');
Route::get('/getTanggalLahir', 'ApiControllers\\UserController@getTanggalLahir');
Route::get('/getTempatLahir', 'ApiControllers\\UserController@getTempatLahir');
Route::get('/getTwitter', 'ApiControllers\\UserController@getTwitter');
Route::get('/getWebsite', 'ApiControllers\\UserController@getWebsite');
Route::get('/getFollowerCount', 'ApiControllers\\UserController@getFollowerCount');
Route::get('/getFollowingCount', 'ApiControllers\\UserController@getFollowingCount');
Route::get('/getProfile', 'ApiControllers\\UserController@getProfile');
Route::get('/getMetaProfile', 'ApiControllers\\UserController@getMetaProfile');
Route::get('/follow', 'ApiControllers\\UserController@follow');
Route::get('/unfollow', 'ApiControllers\\UserController@unfollow');
Route::get('/checkFollow', 'ApiControllers\\UserController@checkFollow');
Route::get('/getQuretans', 'ApiControllers\\UserController@getQuretans');
Route::get('/getSearchUser', 'ApiControllers\\UserController@getSearchUser');
Route::get('/getSuggestSearchUser', 'ApiControllers\\UserController@getSuggestSearchUser');
Route::get('/setUsername', 'ApiControllers\\UserController@setUsername');
Route::get('/setName', 'ApiControllers\\UserController@setName');
Route::get('/setEmail', 'ApiControllers\\UserController@setEmail');
Route::get('/setPhone_number', 'ApiControllers\\UserController@setPhone_number');
Route::get('/setUserImage', 'ApiControllers\\UserController@setUserImage');
Route::get('/setKota', 'ApiControllers\\UserController@setKota');
Route::get('/setLinkedin', 'ApiControllers\\UserController@setLinkedin');
Route::get('/setMinat', 'ApiControllers\\UserController@setMinat');
Route::get('/setPendidikan', 'ApiControllers\\UserController@setPendidikan');
Route::get('/setProfesi', 'ApiControllers\\UserController@setProfesi');
Route::get('/setShortBio', 'ApiControllers\\UserController@setShortBio');
Route::get('/setTanggalLahir', 'ApiControllers\\UserController@setTanggalLahir');
Route::get('/setTempatLahir', 'ApiControllers\\UserController@setTempatLahir');
Route::get('/setTwitter', 'ApiControllers\\UserController@setTwitter');
Route::get('/setWebsite', 'ApiControllers\\UserController@setWebsite');

Route::get('/getPostId', 'ApiControllers\\PostsController@getPostId');
Route::get('/getPostAuthor', 'ApiControllers\\PostsController@getPostAuthor');
Route::get('/getPostTitle', 'ApiControllers\\PostsController@getPostTitle');
Route::get('/getPostSubtitle', 'ApiControllers\\PostsController@getPostSubtitle');
Route::get('/getPostContent', 'ApiControllers\\PostsController@getPostContent');
Route::get('/getPostSlug', 'ApiControllers\\PostsController@getPostSlug');
Route::get('/getPostImage', 'ApiControllers\\PostsController@getPostImage');
Route::get('/getPostImageCredit', 'ApiControllers\\PostsController@getPostImageCredit');
Route::get('/getPostViewCount', 'ApiControllers\\PostsController@getPostViewCount');
Route::get('/getPostShareCount', 'ApiControllers\\PostsController@getPostShareCount');
Route::get('/getPostLikeCount', 'ApiControllers\\PostsController@getPostLikeCount');
Route::get('/getPostPublish', 'ApiControllers\\PostsController@getPostPublish');
Route::get('/getPostCategory', 'ApiControllers\\PostsController@getPostCategory');
Route::get('/getPostUpdate', 'ApiControllers\\PostsController@getPostUpdate');
Route::get('/getPostReadTime', 'ApiControllers\\PostsController@getPostReadTime');
Route::get('/getArtikelDraft', 'ApiControllers\\PostsController@getArtikelDraft');
Route::get('/getArtikelUser', 'ApiControllers\\PostsController@getArtikelUser');
Route::get('/getArtikelAktual', 'ApiControllers\\PostsController@getArtikelAktual');
Route::get('/getArtikelFiksi', 'ApiControllers\\PostsController@getArtikelFiksi');
Route::get('/getArtikelInspiratif', 'ApiControllers\\PostsController@getArtikelInspiratif');
Route::get('/getArtikelJenaka', 'ApiControllers\\PostsController@getArtikelJenaka');
Route::get('/getArtikelKiat', 'ApiControllers\\PostsController@getArtikelKiat');
Route::get('/getArtikelLombaEsai', 'ApiControllers\\PostsController@getArtikelLombaEsai');
Route::get('/getArtikelPremium', 'ApiControllers\\PostsController@getArtikelPremium');
Route::get('/getArtikelTerpopuler', 'ApiControllers\\PostsController@getArtikelTerpopuler');
Route::get('/getArtikelSlide', 'ApiControllers\\PostsController@getArtikelSlide');
Route::get('/getArtikelWorkshop', 'ApiControllers\\PostsController@getArtikelWorkshop');
Route::get('/getArtikelSticky', 'ApiControllers\\PostsController@getArtikelSticky');
Route::get('/artikelTerbaca', 'ApiControllers\\PostsController@artikelTerbaca');
Route::get('/artikelTerbacaSlug', 'ApiControllers\\PostsController@artikelTerbacaSlug');
Route::get('/bacaArtikel', 'ApiControllers\\PostsController@bacaArtikel');
Route::get('/bacaArtikelBySlug', 'ApiControllers\\PostsController@bacaArtikelBySlug');
Route::get('/getSearchArtikel', 'ApiControllers\\PostsController@getSearchArtikel');
Route::get('/checkLike', 'ApiControllers\\PostsController@checkLike');
Route::get('/newArtikel', 'ApiControllers\\PostsController@newArtikel');
Route::get('/setArtikel', 'ApiControllers\\PostsController@setArtikel');
Route::get('/delArtikel', 'ApiControllers\\PostsController@delArtikel');
Route::get('/setArtikelImage', 'ApiControllers\\PostsController@setArtikelImage');
Route::get('/getCategoryList', 'ApiControllers\\PostsController@getCategoryList');
Route::get('/getSuggestSearchArtikel', 'ApiControllers\\PostsController@getSuggestSearchArtikel');
Route::get('/getShortContent', 'ApiControllers\\PostsController@getShortContent');
/*
Route::get('/getNotifCount', 'ApiControllers\\NotificationsController@getNotifCount');
Route::get('/getNotif', 'ApiControllers\\NotificationsController@getNotif');

Route::get('/getThreadInfo', 'ApiControllers\\MessagesController@getThreadInfo');
Route::get('/getThread', 'ApiControllers\\MessagesController@getThread');
Route::get('/getLastMessage', 'ApiControllers\\MessagesController@getLastMessage');
Route::get('/getAnotherUser', 'ApiControllers\\MessagesController@getAnotherUser');
Route::get('/getNotifThreadCount', 'ApiControllers\\MessagesController@getNotifThreadCount');
Route::get('/getThreadList', 'ApiControllers\\MessagesController@getThreadList');
Route::get('/getSearchThread', 'ApiControllers\\MessagesController@getSearchThread');
Route::get('/getMessage', 'ApiControllers\\MessagesController@getMessage');
Route::get('/setNewThread', 'ApiControllers\\MessagesController@setNewThread');
Route::get('/newMesseges', 'ApiControllers\\MessagesController@newMesseges');
Route::get('/delThread', 'ApiControllers\\MessagesController@delThread');
Route::get('/getNotifMessageCount', 'ApiControllers\\MessagesController@getNotifMessageCount');
*/

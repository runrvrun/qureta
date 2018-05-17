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

Route::any('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/save-subscription', 'PushSubscriptionController@save_subscription');
Route::post('/send-notification', 'PushSubscriptionController@send_notification');

/* API for Qureta App */
Route::any('/userLogin', 'ApiControllers\\AuthController@login');
Route::any('/socialLogin', 'ApiControllers\\AuthController@socialLogin');
Route::any('/userRegis', 'ApiControllers\\AuthController@userRegister');
Route::any('/refreshToken', 'ApiControllers\\AuthController@refreshToken');

Route::any('/randomToken', 'ApiControllers\\UserController@randomToken');
Route::any('/checkToken', 'ApiControllers\\UserController@checkToken');
Route::any('/getUsername', 'ApiControllers\\UserController@getUsername');
Route::any('/getEmail', 'ApiControllers\\UserController@getEmail');
Route::any('/getUserNameFull', 'ApiControllers\\UserController@getUserNameFull');
Route::any('/getId', 'ApiControllers\\UserController@getId');
Route::any('/getName', 'ApiControllers\\UserController@getName');
Route::any('/getRole', 'ApiControllers\\UserController@getRole');
Route::any('/getUserImage', 'ApiControllers\\UserController@getUserImage');
Route::any('/getPostCount', 'ApiControllers\\UserController@getPostCount');
Route::any('/getKota', 'ApiControllers\\UserController@getKota');
Route::any('/getLinkedIn', 'ApiControllers\\UserController@getLinkedIn');
Route::any('/getMinat', 'ApiControllers\\UserController@getMinat');
Route::any('/getPendidikan', 'ApiControllers\\UserController@getPendidikan');
Route::any('/getProfesi', 'ApiControllers\\UserController@getProfesi');
Route::any('/getShortBio', 'ApiControllers\\UserController@getShortBio');
Route::any('/getTanggalLahir', 'ApiControllers\\UserController@getTanggalLahir');
Route::any('/getTempatLahir', 'ApiControllers\\UserController@getTempatLahir');
Route::any('/getTwitter', 'ApiControllers\\UserController@getTwitter');
Route::any('/getWebsite', 'ApiControllers\\UserController@getWebsite');
Route::any('/getFollowerCount', 'ApiControllers\\UserController@getFollowerCount');
Route::any('/getFollowingCount', 'ApiControllers\\UserController@getFollowingCount');
Route::any('/getProfile', 'ApiControllers\\UserController@getProfile');
Route::any('/getMetaProfile', 'ApiControllers\\UserController@getMetaProfile');
Route::any('/follow', 'ApiControllers\\UserController@follow');
Route::any('/checkFollow', 'ApiControllers\\UserController@checkFollow');
Route::any('/getQuretans', 'ApiControllers\\UserController@getQuretans');
Route::any('/getSearchUser', 'ApiControllers\\UserController@getSearchUser');
Route::any('/getSuggestSearchUser', 'ApiControllers\\UserController@getSuggestSearchUser');
Route::any('/setUsername', 'ApiControllers\\UserController@setUsername');
Route::any('/setName', 'ApiControllers\\UserController@setName');
Route::any('/setEmail', 'ApiControllers\\UserController@setEmail');
Route::any('/setPhone_number', 'ApiControllers\\UserController@setPhone_number');
Route::any('/setUserImage', 'ApiControllers\\UserController@setUserImage');
Route::any('/setKota', 'ApiControllers\\UserController@setKota');
Route::any('/setLinkedin', 'ApiControllers\\UserController@setLinkedin');
Route::any('/setMinat', 'ApiControllers\\UserController@setMinat');
Route::any('/setPendidikan', 'ApiControllers\\UserController@setPendidikan');
Route::any('/setProfesi', 'ApiControllers\\UserController@setProfesi');
Route::any('/setShortBio', 'ApiControllers\\UserController@setShortBio');
Route::any('/setTanggalLahir', 'ApiControllers\\UserController@setTanggalLahir');
Route::any('/setTempatLahir', 'ApiControllers\\UserController@setTempatLahir');
Route::any('/setTwitter', 'ApiControllers\\UserController@setTwitter');
Route::any('/setWebsite', 'ApiControllers\\UserController@setWebsite');
Route::any('/editProfile', 'ApiControllers\\UserController@editProfile');

Route::any('/getPostId', 'ApiControllers\\PostsController@getPostId');
Route::any('/getPostAuthor', 'ApiControllers\\PostsController@getPostAuthor');
Route::any('/getPostTitle', 'ApiControllers\\PostsController@getPostTitle');
Route::any('/getPostSubtitle', 'ApiControllers\\PostsController@getPostSubtitle');
Route::any('/getPostContent', 'ApiControllers\\PostsController@getPostContent');
Route::any('/getPostSlug', 'ApiControllers\\PostsController@getPostSlug');
Route::any('/getPostImage', 'ApiControllers\\PostsController@getPostImage');
Route::any('/getPostImageCredit', 'ApiControllers\\PostsController@getPostImageCredit');
Route::any('/getPostViewCount', 'ApiControllers\\PostsController@getPostViewCount');
Route::any('/getPostShareCount', 'ApiControllers\\PostsController@getPostShareCount');
Route::any('/getPostLikeCount', 'ApiControllers\\PostsController@getPostLikeCount');
Route::any('/getPostPublish', 'ApiControllers\\PostsController@getPostPublish');
Route::any('/getPostCategory', 'ApiControllers\\PostsController@getPostCategory');
Route::any('/getPostUpdate', 'ApiControllers\\PostsController@getPostUpdate');
Route::any('/getPostReadTime', 'ApiControllers\\PostsController@getPostReadTime');
Route::any('/getArtikelDraft', 'ApiControllers\\PostsController@getArtikelDraft');
Route::any('/getArtikelUser', 'ApiControllers\\PostsController@getArtikelUser');
Route::any('/getArtikelAktual', 'ApiControllers\\PostsController@getArtikelAktual');
Route::any('/getArtikelFiksi', 'ApiControllers\\PostsController@getArtikelFiksi');
Route::any('/getArtikelInspiratif', 'ApiControllers\\PostsController@getArtikelInspiratif');
Route::any('/getArtikelJenaka', 'ApiControllers\\PostsController@getArtikelJenaka');
Route::any('/getArtikelKiat', 'ApiControllers\\PostsController@getArtikelKiat');
Route::any('/getArtikelLombaEsai', 'ApiControllers\\PostsController@getArtikelLombaEsai');
Route::any('/getArtikelPremium', 'ApiControllers\\PostsController@getArtikelPremium');
Route::any('/getArtikelTerpopuler', 'ApiControllers\\PostsController@getArtikelTerpopuler');
Route::any('/getArtikelSlide', 'ApiControllers\\PostsController@getArtikelSlide');
Route::any('/getArtikelWorkshop', 'ApiControllers\\PostsController@getArtikelWorkshop');
Route::any('/getArtikelSticky', 'ApiControllers\\PostsController@getArtikelSticky');
Route::any('/artikelTerbaca', 'ApiControllers\\PostsController@artikelTerbaca');
Route::any('/artikelTerbacaSlug', 'ApiControllers\\PostsController@artikelTerbacaSlug');
Route::any('/bacaArtikel', 'ApiControllers\\PostsController@bacaArtikel');
Route::any('/bacaArtikelBySlug', 'ApiControllers\\PostsController@bacaArtikelBySlug');
Route::any('/getSearchArtikel', 'ApiControllers\\PostsController@getSearchArtikel');
Route::any('/checkLike', 'ApiControllers\\PostsController@checkLike');
Route::any('/newArtikel', 'ApiControllers\\PostsController@newArtikel');
Route::any('/setArtikel', 'ApiControllers\\PostsController@setArtikel');
Route::any('/delArtikel', 'ApiControllers\\PostsController@delArtikel');
Route::any('/setImageArtikel', 'ApiControllers\\PostsController@setArtikelImage');
Route::any('/getCategoryList', 'ApiControllers\\PostsController@getCategoryList');
Route::any('/getSuggestSearchArtikel', 'ApiControllers\\PostsController@getSuggestSearchArtikel');
Route::any('/getShortContent', 'ApiControllers\\PostsController@getShortContent');

Route::any('/getNotifCount', 'ApiControllers\\NotificationsController@getNotifCount');
Route::any('/getNotif', 'ApiControllers\\NotificationsController@getNotif');
Route::any('/getNotifThreadCount', 'ApiControllers\\NotificationsController@getNotifThreadCount');

Route::any('/getThreadList', 'ApiControllers\\MessagesController@getThreadList');
/*Route::any('/getLastMessage', 'ApiControllers\\MessagesController@getLastMessage');
Route::any('/getAnotherUser', 'ApiControllers\\MessagesController@getAnotherUser');
Route::any('/getNotifThreadCount', 'ApiControllers\\MessagesController@getNotifThreadCount');
Route::any('/getThreadList', 'ApiControllers\\MessagesController@getThreadList');
Route::any('/getSearchThread', 'ApiControllers\\MessagesController@getSearchThread');
Route::any('/getMessage', 'ApiControllers\\MessagesController@getMessage');
Route::any('/setNewThread', 'ApiControllers\\MessagesController@setNewThread');
Route::any('/newMesseges', 'ApiControllers\\MessagesController@newMesseges');
Route::any('/delThread', 'ApiControllers\\MessagesController@delThread');
Route::any('/getNotifMessageCount', 'ApiControllers\\MessagesController@getNotifMessageCount');
*/

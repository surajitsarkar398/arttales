<?php

use App\Http\Controllers\apiController;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

	// Register Related Route
	Route::group(['middleware' => 'api'], function (){

	//********Login/Register Api's********
	Route::post('register','apiController@register');
	Route::post('login','apiController@login');
	Route::post('save_token','apiController@save_token');
	Route::get('logout','apiController@logout');
	Route::post('delete_account','apiController@delete_account');
	Route::post('changePassword','apiController@changePassword');
	
	//********Preference Api's**********
	Route::post('preferencesubcategory','apiController@preferenceSubcategory');
	Route::post('preferenceUserListing','apiController@preferenceUserListing');
	Route::get('prference','apiController@prference');
	Route::get('preferencemaincategory','apiController@preferencelisting');
	Route::get('preferenceShow','apiController@preferenceShow');
	Route::post('review','apiController@review');
	Route::post('reviewlist','apiController@reviewlist');
	
	//********Dashboard Api's*********
	Route::post('notificationListing','apiController@notificationListing');
	Route::get('searchUserListing','apiController@searchUserListing');
	Route::post('request','apiController@request');
	Route::post('sendAndAcceptRequest','apiController@sendAndAcceptRequest');
	Route::post('following','apiController@following');
	Route::post('requestListing','apiController@requestListing');
    Route::post('followingListing','apiController@followingListing');
    Route::post('blockListing','apiController@blockListing');
	Route::post('follow','apiController@follow');
    Route::post('unfollow','apiController@unfollow');
	Route::post('block','apiController@block');
    Route::post('unblock','apiController@unblock');
	Route::post('tagListing','apiController@tagListing');
	Route::post('dashboardListing','apiController@dashboardListing');
	Route::post('postComment','apiController@postComment');
	Route::post('commentListing','apiController@commentListing');
	Route::Post('comment_like','apiController@comment_like');
	Route::post('comment_unlike','apiController@comment_unlike');
	Route::post('edittag','apiController@edittag');
	Route::post('visitnow','apiController@visitnow');
	Route::post('search_tag','apiController@search_tag');
	Route::post('delete_tag','apiController@delete_tag');
	
	

	//********Profile Api's*********
	Route::post('fetchUser','apiController@fetchUser');
	Route::post('fetchfreindprofile','apiController@fetchfreindprofile');
    Route::post('update_profile','apiController@updateProfile');
	Route::post('update_profileImage','apiController@updateProfileImage');
	Route::post('update_vistingImage','apiController@updateVisitingImage');
	Route::post('privateAccount','apiController@privateAccount');
	Route::post('Public_Account','apiController@PublicAccount');
	Route::get('deleteAccount','apiController@deleteAccount');
	Route::delete('deleteAccount/{userId}','apiController@deleteAccount');
	
	//********ContactUs Api's*********
	Route::post('contactus','apiController@contactUs');
	
	//********Post Api's*********
	Route::post('postmodule','apiController@postModule');
	Route::post('postvideo','apiController@postvideo');
	Route::post('savepost','apiController@savepost');
	Route::post('post_unsave','apiController@post_unsave');
	Route::post('savepostlisting','apiController@savepostlisting');
	Route::Post('post_like','apiController@post_like');
	Route::post('post_unlike','apiController@post_unlike');
	Route::post('favorite_post','apiController@favorite_post');
	Route::post('favorite_post_listing','apiController@favorite_post_listing');
	Route::post('mypost','apiController@mypost');
	Route::post('sharepost','apiController@sharepost');
	Route::get('sharepostlisting','apiController@sharepostlisting');
	Route::post('inapropriatepost','apiController@inapropriatepost');
	
	//********Artist Lover's*********
	Route:: post('artist_favorite','apiController@artist_favorite');
	Route::post('artist_favorite_list','apiController@artist_favorite_list');
	Route::post('search_artist','apiController@search_artist');
	
	//********Faq Api's*********
	Route::get('faq','apiController@faqListing');
	
	//********Extra Api's*********
	Route::get('storylisting','apiController@storyListing');
	
	//********RegisterStore Api's*********
	Route::post('registerStore','apiController@registerStore');
	Route::get('storlisting','apiController@storlisting');
	
	//********************Cart Api's ***********************
	
	Route::post('cart','apiController@cart');
	Route::post('delete_cart','apiController@delete_cart');
	Route::post('cartlist','apiController@cartlist');
	Route::post('buy_now','apiController@buy_now');
	Route::post('track_order','apiController@track_order');
	Route::post('return_order','apiController@return_order');
	Route::post('current_order','apiController@current_order');
	Route::post('past_order','apiController@past_order');
	//********************** **************************
	Route::post('donotdisturb','apiController@donotdisturb');
	Route::post('promotion','apiController@promotion');
	Route::post('report_user','apiController@report_user');

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\LoginController;
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
/*
Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/do-login', [App\Http\Controllers\LoginController::class, 'doLogin'])->name('doLogin');
Route::get('/do-logout', [App\Http\Controllers\LoginController::class, 'Logout'])->name('Logout');




Route::middleware('auth')->group(function () {


   Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


   //Artist Relate route 

   Route::name('artist.')->prefix('artist')->group(function () {
      Route::get('/', [App\Http\Controllers\ArtistController::class, 'index'])->name('index');
      Route::get('add', [App\Http\Controllers\ArtistController::class, 'create'])->name('create');
      Route::post('store', [App\Http\Controllers\ArtistController::class, 'store'])->name('store');
      Route::get('edit/{id}', [App\Http\Controllers\ArtistController::class, 'edit'])->name('edit');

      Route::post('saveedit', [App\Http\Controllers\ArtistController::class, 'saveEdit'])->name('update');

      Route::get('delete/{id}', [App\Http\Controllers\ArtistController::class, 'destroy'])->name('destroy');

      Route::get('detail/{id}', [App\Http\Controllers\ArtistController::class, 'detail'])->name('detail');

      Route::get('ChangeStatus/{id}/{status}', [App\Http\Controllers\ArtistController::class, 'ChangeStatus'])->name('ChangeStatus');

      Route::post('fetchSubCategory', [App\Http\Controllers\ArtistController::class, 'fetchSubCategory'])->name('fetchSubCategory');

      Route::get('search', [App\Http\Controllers\ArtistController::class, 'search'])->name('search');
   });


   //Artist Lover Relate route 

   Route::name('artist-lover.')->prefix('artist-lover')->group(function () {
      Route::get('/', [App\Http\Controllers\ArtistLoverController::class, 'index'])->name('index');
      Route::get('add', [App\Http\Controllers\ArtistLoverController::class, 'create'])->name('create');
      Route::post('store', [App\Http\Controllers\ArtistLoverController::class, 'store'])->name('store');
      Route::get('edit/{id}', [App\Http\Controllers\ArtistLoverController::class, 'edit'])->name('edit');

      Route::post('saveedit', [App\Http\Controllers\ArtistLoverController::class, 'saveEdit'])->name('update');

      Route::get('delete/{id}', [App\Http\Controllers\ArtistLoverController::class, 'destroy'])->name('destroy');

      Route::get('detail/{id}', [App\Http\Controllers\ArtistLoverController::class, 'detail'])->name('detail');

      Route::get('ChangeStatus/{id}/{status}', [App\Http\Controllers\ArtistLoverController::class, 'ChangeStatus'])->name('ChangeStatus');

      Route::get('search', [App\Http\Controllers\ArtistLoverController::class, 'search'])->name('search');
   });


   //Preference Relate route 

   Route::name('prefrence.')->prefix('prefrence')->group(function () {

      Route::get('/', [App\Http\Controllers\PrefrenceController::class, 'index'])->name('index');

      Route::post('store', [App\Http\Controllers\PrefrenceController::class, 'store'])->name('store');

      Route::get('edit/{id}', [App\Http\Controllers\PrefrenceController::class, 'edit'])->name('edit');

      Route::post('saveedit', [App\Http\Controllers\PrefrenceController::class, 'saveEdit'])->name('update');

      Route::get('delete/{id}', [App\Http\Controllers\PrefrenceController::class, 'destroy'])->name('destroy');

      Route::get('search', [App\Http\Controllers\PrefrenceController::class, 'search'])->name('search');
   });


   //Sub Preference Relate route 

   Route::name('sub-prefrence.')->prefix('sub-prefrence')->group(function () {
      Route::get('/', [App\Http\Controllers\SubPrefrenceController::class, 'index'])->name('index');


      Route::post('store', [App\Http\Controllers\SubPrefrenceController::class, 'store'])->name('store');


      Route::get('edit/{id}', [App\Http\Controllers\SubPrefrenceController::class, 'edit'])->name('edit');

      Route::post('saveedit', [App\Http\Controllers\SubPrefrenceController::class, 'saveEdit'])->name('update');

      Route::get('delete/{id}', [App\Http\Controllers\SubPrefrenceController::class, 'destroy'])->name('destroy');


      Route::get('search', [App\Http\Controllers\SubPrefrenceController::class, 'search'])->name('search');
   });


   //Product Relate route 

   Route::name('product.')->prefix('product')->group(function () {

      Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('index');


      Route::get('add', [App\Http\Controllers\ProductController::class, 'create'])->name('create');


      Route::post('store', [App\Http\Controllers\ProductController::class, 'store'])->name('store');


      Route::get('edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('edit');

      Route::post('saveedit', [App\Http\Controllers\ProductController::class, 'saveEdit'])->name('update');

      Route::get('delete/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('destroy');


      Route::get('search', [App\Http\Controllers\ProductController::class, 'search'])->name('search');
   });

   //Store Relate route

   Route::name('store.')->prefix('store')->group(function () {

      // Route::get('/store/viewstore','StoreController@index');
      Route::get('/', [App\Http\Controllers\StoreController::class, 'index'])->name('index');
      Route::post('store', [App\Http\Controllers\StoreController::class, 'store'])->name('store');
      Route::get('edit/{id}', [App\Http\Controllers\StoreController::class, 'edit'])->name('edit');
      Route::post('saveedit', [App\Http\Controllers\StoreController::class, 'saveEdit'])->name('saveEdit');
      Route::get('detail/{id}', [App\Http\Controllers\StoreController::class, 'detail'])->name('detail');
      Route::get('delete/{id}', [App\Http\Controllers\StoreController::class, 'destroy'])->name('destroy');
      Route::get('/store/viewstoredetails/{id}', 'StoreController@viewstoredetails');
   });

   Route::name('order.')->prefix('order')->group(function () {

      Route::get('/', [App\Http\Controllers\OrderController::class, 'index'])->name('index');
      Route::get('/approveorder', [App\Http\Controllers\OrderController::class, 'approve'])->name('approve');
      Route::get('/cancelorder', [App\Http\Controllers\OrderController::class, 'cancel'])->name('cancel');
      Route::get('/order_approve/{id}', [App\Http\Controllers\OrderController::class, 'order_approve'])->name('order_approve');
      Route::get('/order_cancel/{id}', [App\Http\Controllers\OrderController::class, 'order_cancel'])->name('order_cancel');
      Route::get('/currentorder', [App\Http\Controllers\OrderController::class, 'currentorder'])->name('currentorder');
      Route::get('/pastorder', [App\Http\Controllers\OrderController::class, 'pastorder'])->name('pastorder');
      Route::get('/monthly_report', [App\Http\Controllers\OrderController::class, 'monthly_report'])->name('monthly_report');
      Route::get('/quatarly_report', [App\Http\Controllers\OrderController::class, 'quatarly_report'])->name('quatarly_report');
      Route::get('/product_report', [App\Http\Controllers\OrderController::class, 'product_report'])->name('product_report');
      

     
   });

   //Post  Relate route 
   Route::get('/post/viewpost', 'PostController@index');
   Route::delete('/post/viewpost/destroy/{id}', 'PostController@destroy');
   Route::get('/post/viewpost/show/{id}', 'PostController@show');

   // 
   Route::name('seller_user.')->prefix('seller_user')->group(function () {
      Route::get('/', [App\Http\Controllers\sellerController::class, 'index'])->name('index');
      Route::get('add', [App\Http\Controllers\sellerController::class, 'create'])->name('create');
   });

   //currentads
   Route::get('/advertisment/currentproductads', 'AdvertismentController@currentproductads');
   Route::get('/advertisment/currentpostads', 'AdvertismentController@currentpostads');
   Route::get('/advertisment/currentprofileads', 'AdvertismentController@currentprofileads');
   Route::get('/advertisment/currentstoreads', 'AdvertismentController@currentstoreads');

   //
   Route::get('/advertisment/pendingstores', 'AdvertismentController@pendingstores');
   Route::get('/advertisment/pendingstoreads', 'AdvertismentController@pendingstore');
   Route::get('/advertisment/pendingproductads', 'AdvertismentController@pendingproduct');
   Route::get('/advertisment/pendingprofileads', 'AdvertismentController@pendingprofile');
   Route::get('/advertisment/pendingpostads', 'AdvertismentController@pendingpost');

   //
   Route::get('/advertisment/viewstores/{id}', 'AdvertismentController@viewstores');
   Route::get('/advertisment/viewprofiledetails/{id}', 'AdvertismentController@viewprofilestores');
   Route::get('/advertisment/viewpostdetails/{id}', 'AdvertismentController@viewpoststores');
   Route::get('/advertisment/viewproductdetails/{id}', 'AdvertismentController@viewproductstores');


   Route::get('/advertisment/ChangeStatus/{id}', 'AdvertismentController@ChangeStatus');
   Route::get('/advertisment/ChangeStatusStore/{id}', 'AdvertismentController@ChangeStatusStore');
   Route::get('/advertisment/ChangeStatusProfile/{id}', 'AdvertismentController@ChangeStatusProfile');
   Route::get('/advertisment/ChangeStatusPost/{id}', 'AdvertismentController@ChangeStatusPost');

   // Route::get('/product/viewproduct','ProductController@index');
   // Route::get('/product/addproduct','ProductController@create');
   // Route::post('/product/addproduct/store','ProductController@store');
   // Route::get('/product/editproduct/edit/{id}', 'ProductController@edit');
    Route::post('/product/saveEdit', 'ProductController@saveEdit');
    Route::get('/product/destroy/{id}', 'ProductController@destroy');
    Route::get('/order/orderStatusUpdate','OrderController@orderStatusUpdate');

   /*   //Route::get('/   ','UserController@index');
    Route::get('/user/addartist','UserController@create');
    Route::post('/user/addartist/store','UserController@store');
    Route::delete('/user/viewartist/destroy/{id}', 'UserController@destroy');
    Route::get('/users/ChangeStatus/{id}/{status}','UserController@ChangeStatus');
*/


   /* Route::get('/user/viewartistlist','ArtistController@index');
    Route::get('/user/artist','ArtistController@create');
    Route::post('/user/artist/store','ArtistController@store');
    Route::delete('/user/viewartistlist/destroy/{id}', 'ArtistController@destroy');
    Route::get('/users/ChangeStatus/{id}/{status}','ArtistController@ChangeStatus');
    Route::get('/user/viewartistlist/search','ArtistController@search');
*/
   /*   //Prefrence Relate route 
    Route::get('/prefrence/prefrenceview','PrefrenceController@index');
    Route::get('/prefrence/prefrenceadd','PrefrenceController@create');
    Route::post('/prefrence/prefrenceadd/store','PrefrenceController@store');
    Route::get('/prefrence/prefrenceedit/edit/{id}', 'PrefrenceController@edit');
    Route::post('/prefrence/prefrenceedit/saveEdit', 'PrefrenceController@saveEdit');
    Route::delete('/prefrence/prefrenceview/destroy/{id}', 'PrefrenceController@destroy');
*/

   /* //Prefrence Subcategory Relate route 
    Route::get('/prefrence/preferencesubview','PreferencesubcategoriesController@index');
    Route::get('/prefrence/preferencesubadd','PreferencesubcategoriesController@create');
    Route::post('/prefrence/preferencesubadd/store','PreferencesubcategoriesController@store');
    Route::get('/prefrence/preferencesubedit/edit/{id}', 'PreferencesubcategoriesController@edit');
    Route::post('/prefrence/preferencesubedit/saveEdit', 'PreferencesubcategoriesController@saveEdit');
    Route::delete('/prefrence/preferencesubview/destroy/{id}', 'PreferencesubcategoriesController@destroy');
    Route::get('/prefrence/preferencesubview/search','PreferencesubcategoriesController@search');
    Route::get('/prefrence/preferencesubview/searchsub','PreferencesubcategoriesController@searchsub');

   */ //Product  Relate route 
   /*Route::get('/product/viewproduct','ProductController@index');
    Route::get('/product/addproduct','ProductController@create');
    Route::post('/product/addproduct/store','ProductController@store');
    Route::get('/product/editproduct/edit/{id}', 'ProductController@edit');
    Route::post('/product/editproduct/saveEdit', 'ProductController@saveEdit');
    Route::delete('/product/viewproduct/destroy/{id}', 'ProductController@destroy');

    //Sell product list
    Route::get('/product/sellproduct','ProductController@sellproduct');

    //Post  Relate route 
    Route::get('/post/viewpost','PostController@index');
    Route::delete('/post/viewpost/destroy/{id}', 'PostController@destroy');

    //Store  Relate route 
    Route::get('/store/viewstore','StoreController@index');
    Route::get('/store/addstore','StoreController@create');
    Route::post('/store/addstore/store','StoreController@store');
    Route::get('/store/editstore/edit/{id}', 'StoreController@edit');
    Route::post('/store/editstore/saveEdit', 'StoreController@saveEdit');
    Route::delete('/store/viewstore/destroy/{id}', 'StoreController@destroy');
    Route::get('/store/Block/{id}/{status}','StoreController@Block');
    Route::get('/store/viewstoredetails/{id}', 'StoreController@viewstoredetails');

    //pending store list
    Route::get('/store/pendingstore','StoreController@pending');
    Route::delete('/store/viewstore/decline/{id}', 'StoreController@decline');
    Route::get('/store/ChangeStatus/{id}/{status}','StoreController@ChangeStatus');
    Route::get('/store/download/{file}','StoreController@download');
    Route::get('/store/Blockpending/{id}/{status}','StoreController@Blockpending');

    //approve store list
    Route::get('/store/approvestore','StoreController@approve');
    Route::get('/store/Blockapproval/{id}/{status}','StoreController@Blockapproval');


    //order list
    //pending
    Route::get('/order/pendingorder','OrderController@index');
    Route::get('/order/pendingorder/productsearch','OrderController@productsearch');
    Route::get('/order/pendingorder/searchstore','OrderController@searchstore');
    //approval
    Route::get('/order/approveorder','OrderController@approve');


    //cancel
    Route::get('/order/cancelorder','OrderController@cancel');

    //advertisment
    Route::get('/advertisment/viewstores/{id}', 'AdvertismentController@viewstores');
    Route::get('/advertisment/viewprofiledetails/{id}', 'AdvertismentController@viewprofilestores');
    Route::get('/advertisment/viewpostdetails/{id}', 'AdvertismentController@viewpoststores');
    Route::get('/advertisment/viewproductdetails/{id}', 'AdvertismentController@viewproductstores');


    Route::get('/advertisment/ChangeStatus/{id}','AdvertismentController@ChangeStatus');
    Route::get('/advertisment/ChangeStatusStore/{id}','AdvertismentController@ChangeStatusStore');
    Route::get('/advertisment/ChangeStatusProfile/{id}','AdvertismentController@ChangeStatusProfile');
    Route::get('/advertisment/ChangeStatusPost/{id}','AdvertismentController@ChangeStatusPost');
    //pendig
    

   
    
*/
});

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/do-login', [App\Http\Controllers\LoginController::class, 'doLogin'])->name('doLogin');
Route::get('/do-logout', [App\Http\Controllers\LoginController::class, 'Logout'])->name('Logout');
Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


//Product Relate route 

Route::name('product.')->prefix('product')->group(function () {
   Route::get('/', [App\Http\Controllers\ProdectController::class, 'index'])->name('index');
   Route::get('add', [App\Http\Controllers\ProdectController::class, 'create'])->name('create');
   Route::post('store', [App\Http\Controllers\ProdectController::class, 'store'])->name('store');
   Route::get('edit/{id}', [App\Http\Controllers\ProdectController::class, 'edit'])->name('edit');
   Route::post('delete/{id}', [App\Http\Controllers\ProdectController::class, 'destroy'])->name('destroy');
   Route::get('search', [App\Http\Controllers\ProdectController::class, 'search'])->name('search');
});

//Store Relate route
Route::post('/product/saveEdit', [App\Http\Controllers\ProdectController::class, 'saveEdit'])->name('product.saveEdit');
Route::get('/product_list', [App\Http\Controllers\ProdectController::class, 'adminindex'])->name('adminindex');
Route::get('/product/seller_edit/{id}', [App\Http\Controllers\ProdectController::class, 'seller_edit'])->name('product.seller_edit');


Route::name('order.')->prefix('order')->group(function () {

   Route::get('/', [App\Http\Controllers\OrderController::class, 'index'])->name('index');
   //  Route::get('/pendingorder',[App\Http\Controllers\OrderController::class,'pendingorder'])->name('pendingorder');
   Route::get('/approveorder', [App\Http\Controllers\OrderController::class, 'approve'])->name('approve');
   Route::get('/cancelorder', [App\Http\Controllers\OrderController::class, 'cancel'])->name('cancel');
});



//  //Post  Relate route 
//  Route::get('/post/viewpost', 'PostController@index');
//  Route::delete('/post/viewpost/destroy/{id}', 'PostController@destroy');



//currentads
Route::name('advertisment.')->prefix('advertisment')->group(function () {

   Route::get('/', [App\Http\Controllers\AdvertismentController::class, 'index'])->name('index');
   Route::get('add', [App\Http\Controllers\AdvertismentController::class, 'create'])->name('create');
   Route::post('store', [App\Http\Controllers\AdvertismentController::class, 'store'])->name('store');
});

Route::get('profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('index');

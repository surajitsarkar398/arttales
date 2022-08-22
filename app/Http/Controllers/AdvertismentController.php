<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Post;
use App\Models\Advertisment;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Utility\CustomVerfication;
use Carbon\Carbon;



class AdvertismentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function viewstores(Request $request)
  {
    //  $adslist = Advertisment::where('ads_id',$request->id)->first();
    // return view('advertisment.viewstores', compact('adslist'));

    $adslists = DB::table('promotionals')
      ->join('users', 'promotionals.register_id', '=', 'users.register_id')
      ->join('stores', 'promotionals.store_id', '=', 'stores.store_id')
      ->select('promotionals.*', 'users.*', 'stores.*')
      ->where('promotionals.is_approve', '0')
      ->where('promotionals.ads_type', 'store')
      ->where('promotionals.ads_id', '=', $request->id)
      ->get();

    foreach ($adslists as $adslist) {
      return view('advertisment.viewstores', compact('adslist'));
    }
  }
  public function viewprofilestores(Request $request)
  {

    //   $adslist = Advertisment::where('ads_id',$request->id)->first();
    // return view('advertisment.viewprofiledetails', compact('adslist'));

    $adslists = DB::table('promotionals')
      ->join('users', 'advertisments.register_id', '=', 'users.register_id')
      ->select('promotionals.*', 'users.*')
      ->where('promotionals.is_approve', '0')
      ->where('promotionals.ads_type', 'profile')
      ->where('promotionals.ads_id', '=', $request->id)
      ->get();

    foreach ($adslists as $adslist) {
      return view('advertisment.viewprofiledetails', compact('adslist'));
    }
  }


  public function viewpoststores(Request $request)
  {

    //   $adslist = Advertisment::where('ads_id',$request->id)->first();
    // return view('advertisment.viewpostdetails', compact('adslist'));

    $adslists = DB::table('promotionals')
      ->join('users', 'promotionals.register_id', '=', 'users.register_id')
      ->join('posts', 'promotionals.post_id', '=', 'posts.post_id')
      ->select('promotionals.*', 'users.*')
      ->where('promotionals.is_approve', '0')
      ->where('promotionals.ads_type', 'post')
      ->where('promotionals.ads_id', '=', $request->id)
      ->get();

    foreach ($adslists as $adslist) {
      return view('advertisment.viewpostdetails', compact('adslist'));
    }
  }

  public function viewproductstores(Request $request)
  {

    //   $adslist = Advertisment::where('ads_id',$request->id)->first();
    // return view('advertisment.viewproductdetails', compact('adslist'));

    $adslists = DB::table('promotionals')
      ->join('users', 'advertisments.register_id', '=', 'users.register_id')
      ->join('products', 'advertisments.product_id', '=', 'products.product_id')
      ->select('promotionals.*', 'users.*', 'products.*')
      ->where('promotionals.is_approve', '0')
      ->where('promotionals.ads_type', 'product')
      ->where('promotionals.ads_id', '=', $request->id)
      ->get();

    foreach ($adslists as $adslist) {
      return view('advertisment.viewproductdetails', compact('adslist'));
    }
  }


  public function pendingstores()
  {
    $adslist = DB::table('promotionals')
      ->join('users', 'promotionals.register_id', '=', 'users.register_id')
      ->join('stores', 'promotionals.store_id', '=', 'stores.store_id')
      ->select('promotionals.*', 'users.*', 'stores.*')
      ->where('promotionals.is_approve', '0')
      ->where('promotionals.ads_type', 'store')
      ->get();


    return view('advertisment.pendingstores', compact('adslist'));
  }



  public function pendingstore()
  {

    $adslist = DB::table('promotionals')
    ->join('users', 'promotionals.register_id', '=', 'users.register_id')
    ->join('products', 'promotionals.product_id', '=', 'products.product_id')
    ->select('promotionals.*', 'users.*', 'products.*')
    ->where('promotionals.is_aprove', '1')
    ->where('promotionals.ads_type', 'post')
      ->get();


    return view('advertisment.pendingstoreads', compact('adslist'));
  }

  public function pendingproduct()
  {

    $adslist = DB::table('promotionals')
    ->join('users', 'promotionals.register_id', '=', 'users.register_id')
    ->join('products', 'promotionals.product_id', '=', 'products.product_id')
    ->select('promotionals.*', 'users.*', 'products.*')
    ->where('promotionals.is_aprove', '0')
    ->where('promotionals.ads_type', 'product')
      ->get();


    return view('advertisment.pendingproductads', compact('adslist'));
  }

  public function pendingprofile()
  {

    $adslist = DB::table('promotionals')
    ->join('users', 'promotionals.register_id', '=', 'users.register_id')
    ->join('products', 'promotionals.product_id', '=', 'products.product_id')
    ->select('promotionals.*', 'users.*', 'products.*')
    ->where('promotionals.is_aprove', '0')
    ->where('promotionals.ads_type', 'profile')
      ->get();


    return view('advertisment.pendingprofileads', compact('adslist'));
  }


  public function pendingpost()
  {

    $adslist = DB::table('promotionals')
    ->join('users', 'promotionals.register_id', '=', 'users.register_id')
    ->join('products', 'promotionals.product_id', '=', 'products.product_id')
    ->select('promotionals.*', 'users.*', 'products.*')
    ->where('promotionals.is_aprove', '0')
    ->where('promotionals.ads_type', 'post')
      ->get();


    return view('advertisment.pendingpostads', compact('adslist'));
  }

  public function ChangeStatus(Request $request)
  {

    $time = Carbon::now('Asia/Kolkata');
    // $time=$time->toDateTimeString();

    $Courses = Advertisment::where('ads_id', '=', $request->id)->first();

    $Courses->is_approval = 1;
    $Courses->start_date = $time->toDateTimeString();
    $trialExpires = $time->addDays($Courses->duration);
    $trialExpires = $trialExpires->toDateTimeString();
    $Courses->end_date = $trialExpires;
    $Courses->save();

    $adslist = DB::table('promotionals')
    ->join('users', 'promotionals.register_id', '=', 'users.register_id')
    ->join('products', 'promotionals.product_id', '=', 'products.product_id')
    ->select('promotionals.*', 'users.*', 'products.*')
    ->where('promotionals.is_aprove', '1')
    ->where('promotionals.ads_type', 'product')
      ->get();


    return view('advertisment.pendingproductads', compact('adslist'));
  }



  public function ChangeStatusStore(Request $request)
  {

    $time = Carbon::now('Asia/Kolkata');
    // $time=$time->toDateTimeString();

    $Courses = Advertisment::where('ads_id', '=', $request->id)->first();

    $Courses->is_approval = 1;
    $Courses->start_date = $time->toDateTimeString();
    $trialExpires = $time->addDays($Courses->duration);
    $trialExpires = $trialExpires->toDateTimeString();
    $Courses->end_date = $trialExpires;
    $Courses->save();

    $adslist = DB::table('promotionals')
    ->join('users', 'promotionals.register_id', '=', 'users.register_id')
    ->join('products', 'promotionals.product_id', '=', 'products.product_id')
    ->select('promotionals.*', 'users.*', 'products.*')
    ->where('promotionals.is_aprove', '1')
    ->where('promotionals.ads_type', 'store')
      ->get();


    return view('advertisment.pendingstoreads', compact('adslist'));
  }

  public function ChangeStatusProfile(Request $request)
  {


    $time = Carbon::now('Asia/Kolkata');
    // $time=$time->toDateTimeString();

    $Courses = Advertisment::where('ads_id', '=', $request->id)->first();

    $Courses->is_approval = 1;
    $Courses->start_date = $time->toDateTimeString();
    $trialExpires = $time->addDays($Courses->duration);
    $trialExpires = $trialExpires->toDateTimeString();
    $Courses->end_date = $trialExpires;
    $Courses->save();

    $adslist = DB::table('promotionals')
      ->join('users', 'advertisments.register_id', '=', 'users.register_id')
      ->select('advertisments.*', 'users.*')
      ->where('advertisments.is_approval', '0')
      ->where('advertisments.ads_type', 'profile')
      ->get();


    return view('advertisment.pendingprofileads', compact('adslist'));
  }
  public function ChangeStatusPost(Request $request)
  {

    $time = Carbon::now('Asia/Kolkata');
    $time = $time->toDateTimeString();
    $Courses = Advertisment::where('ads_id', '=', $request->id)->first();
    $Courses->is_approval = 1;
    $Courses->start_date = $time;
    $Courses->save();

    $adslist = DB::table('promotionals')
      ->join('users', 'advertisments.register_id', '=', 'users.register_id')
      ->join('posts', 'advertisments.post_id', '=', 'posts.post_id')
      ->select('advertisments.*', 'users.*')
      ->where('advertisments.is_approval', '0')
      ->where('advertisments.ads_type', 'post')
      ->get();


    return view('advertisment.pendingpostads', compact('adslist'));
  }


  public function currentproductads()
  {
    $time = Carbon::now('Asia/Kolkata');
    $time = $time->toDateTimeString();
    //  $Courses->ads_date = $time;

    $adslist = DB::table('promotionals')
      ->join('users', 'promotionals.register_id', '=', 'users.register_id')
      ->join('products', 'promotionals.product_id', '=', 'products.product_id')
      ->select('promotionals.*', 'users.*', 'products.*')
      ->where('promotionals.is_aprove', '1')
      ->where('promotionals.ads_type', 'product')
      ->get();


    return view('advertisment.currentproductads', compact('adslist'));
  }

  public function currentpostads()
  {
    $time = Carbon::now('Asia/Kolkata');
    $time = $time->toDateTimeString();
    //  $Courses->ads_date = $time;



    $adslist = DB::table('promotionals')
    ->join('users', 'promotionals.register_id', '=', 'users.register_id')
    ->join('products', 'promotionals.product_id', '=', 'products.product_id')
    ->select('promotionals.*', 'users.*', 'products.*')
    ->where('promotionals.is_aprove', '1')
    ->where('promotionals.ads_type', 'post')
      ->get();


    return view('advertisment.currentpostads', compact('adslist'));
  }
  public function currentprofileads()
  {
    $time = Carbon::now('Asia/Kolkata');
    $time = $time->toDateTimeString();
    //  $Courses->ads_date = $time;

    $adslist = DB::table('promotionals')
    ->join('users', 'promotionals.register_id', '=', 'users.register_id')
    ->join('products', 'promotionals.product_id', '=', 'products.product_id')
    ->select('promotionals.*', 'users.*', 'products.*')
    ->where('promotionals.is_aprove', '1')
    ->where('promotionals.ads_type', 'profile')
      ->get();


    return view('advertisment.currentprofileads', compact('adslist'));
  }
  public function currentstoreads()
  {
    $time = Carbon::now('Asia/Kolkata');
    $time = $time->toDateTimeString();
    //  $Courses->ads_date = $time;

    $adslist = DB::table('promotionals')
    ->join('users', 'promotionals.register_id', '=', 'users.register_id')
    ->join('products', 'promotionals.product_id', '=', 'products.product_id')
    ->select('promotionals.*', 'users.*', 'products.*')
    ->where('promotionals.is_aprove', '1')
    ->where('promotionals.ads_type', 'store')
      ->get();


    return view('advertisment.currentstoreads', compact('adslist'));
  }



  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}

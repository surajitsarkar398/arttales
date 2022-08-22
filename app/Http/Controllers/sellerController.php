<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use App\Http\Utility\CustomVerfication;
use Illuminate\Support\Facades\Hash;

class sellerController extends Controller
{
    // public function index()
    // {
    //     $users =  User::orderBy('register_id', 'DESC')
    //     ->paginate(10);
    //     return view('seller_user.view', compact('users'));
    // }
    public function index()
    {
        $users =  User::where('role', 'Seller')
                  ->where('updated_at','=',NULL)
                  ->where('user_type','=','seller')
                  ->orderBy('register_id', 'DESC')
                  ->Paginate(2);  
        return view('seller_user.view',compact('users'));
    }
    public function create()
    {
        return view('seller_user.addseller');
    }
    public function store(Request $request)
    { 
     
       

            $path = "artistLover";
            $CustomVerfication = new CustomVerfication;
            $saveImage= $CustomVerfication->imageUpload($request->image,$path);
            if($saveImage){
              $artist = new User;
              $artist->name = $request->name;
              $artist->email = $request->email;
              $artist->country_code = $request->country_code;
              $artist->mobile = $request->mobile;
              $artist->website = $request->website;
              $artist->dob = $request->dob;
              $artist->image = $saveImage;
              $artist->password = Hash::make($request->password);
              $artist->role="Seller";
              $artist->type="seller";
              $artist->user_type = "seller";
              $artist->save();
              
              return redirect('/seller_user')->with('success','Seller Lover Added successfully.');
            }else{
  
              return redirect('/seller_user/add')->with('error','something went wrong.');
  
            }
            
  
  
          

     }  
     public function detail(Request $request)
    {
       $artist = User::where("register_id",$request->id)->first();
       return view('seller_user.detail',compact('artist'));
    }
    public function edit(Request $request)
    {
        $artist = User::where("register_id",$request->id)->first();
        return view('seller_user.updateseller',compact('artist'));
    }
     public function destroy($id)
    {
         User::where('register_id','=',$id)->delete();
        return redirect('/user/viewartist/')->with('success','Seller Has Deleted');
    }
    public function saveEdit(Request $request)
    {
        
      $path = "artistLover";
      $CustomVerfication = new CustomVerfication;
      if(! empty($request->image)){
        $saveImage = $CustomVerfication->imageUpload($request->image,$path);
      
      }else{
        $saveImage = null;
      }
      
        $artist = User::findorfail($request->register_id);  
        
        $artist->name = $request->name;
        $artist->email = $request->email;
        $artist->country_code = $request->country_code;
        $artist->mobile = $request->mobile;
        $artist->website = $request->website;
        $artist->dob = $request->dob;
        $saveImage ? $artist->image = $saveImage : null;
        $artist->password = Hash::make($request->password);
        $artist->role="Seller";
        $artist->type="seller";
        $artist->user_type = "seller";
        $artist->save();
        return redirect('/seller_user')->with('success','Seller Edited successfully'); ;
    }
}

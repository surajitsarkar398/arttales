<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use App\Http\Utility\CustomVerfication;
use DB;
use App\Models\Preference;
use App\Models\Preference_subcategory;
use App\Http\Request\ArtistLover\ArtistLoverFormRequest;
use Illuminate\Support\Facades\Hash;


class ArtistLoverController extends Controller
{
   
    public function index()
    {
        $users =  User::where('role', 'ArtistLover')
                  ->where('updated_at','=',NULL)
                  ->where('user_type','=','artist_lover')
                  ->orderBy('register_id', 'DESC')
                  ->Paginate(10);  

        return view('artist_lover.view',compact('users'));


    }

    public function create()
    {
      $artistLover = null;
      return view('artist_lover.add', compact('artistLover') );
       
    }

   
    public function store(ArtistLoverFormRequest $request)
    {
        if($request->validated()){

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
            $artist->role = $request->role;
            $artist->description = $request->description;
            $artist->user_type = "artist_lover";
            $artist->save();
          
            return redirect('/artist-lover')->with('success','Artist Lover Added successfully.');
          }else{

            return redirect('/artist-lover/add')->with('error','something went wrong.');

          }
          


        }

    }

    public function ChangeStatus(Request $request){
    
      $users = User::where('register_id','=',$request->id)->first();
      $users->status = $request->status;
      $users->save();
    }


    public function edit(Request $request)
    {
       $artistLover = User::where("register_id",$request->id)->first();
       return view('artist_lover.add',compact('artistLover'));
    }

  

    public function saveEdit(Request $request)
    {

        
        $path = "artistLover";
        $CustomVerfication = new CustomVerfication;
        if(! empty($request->image)){
         $saveImage= $CustomVerfication->imageUpload($request->image,$path);
        
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
        $artist->role = $request->role;
        $artist->description = $request->description;
        $artist->user_type = "artist_lover";
        $artist->save();
      
        return redirect('/artist-lover')->with('success','Artist Lover Edited successfully.');
          
    }


    public function fetchSubCategory(Request $request){
      $prefrencesublist = Preference_subcategory::where('id',$request->categoryId)->get();
      return view('artist.fetch_sub_category',compact('prefrencesublist'));
    }



    public function destroy(Request $request)
    {
      
      $user =  User::findorfail($request->id);
      $user->updated_at = date('Y-m-d H:i:s');
      $user->save();
      return redirect('/artist-lover')->with('success','Artist Lover Deleted successfully');
    }


    public function detail(Request $request)
    {
       $artist = User::where("register_id",$request->id)->first();
       return view('artist_lover.detail',compact('artist'));
    }
    

    public function search(Request $request){

       
      if($request->ajax()){

      
        $keyword = $request->keyword;

        if(empty($keyword)){

          $users =  User::where('role', 'ArtistLover')
                  ->where('updated_at','=',NULL)
                  ->where('user_type','=','artist_lover')
                  ->orderBy('register_id', 'DESC')
                  ->Paginate(10);  
        }else{

          $users = User::where(function ($query) use ($keyword) {
              $query->where('name','like', "%".$keyword ."%")
                    ->orwhere('mobile','like',"%".$keyword ."%")
                    ->orwhere('email','like',"%".$keyword ."%");

          })->where(function ($query) {
              $query->where('user_type','=','artist_lover')
                    ->where('updated_at','=',NULL);
          })->Paginate(10);  
        }


         
        return view('artist_lover.search',compact('users'));
      }


  
    }
       
}






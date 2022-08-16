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
use App\Http\Request\Artist\ArtistFormRequest;
use Illuminate\Support\Facades\Hash;


class ArtistController extends Controller
{
    public function index()
    {
        $users =  User::where('role', 'Artist')
                  ->where('updated_at','=',NULL)
                  ->where('user_type','=','artist')
                  ->orderBy('register_id', 'DESC')
                  ->Paginate(2);  
        return view('artist.view',compact('users'));
    }

    public function create()
    {
      $prefrencelist = Preference::all();
      $prefrencesublist = Preference_subcategory::all();
      $artist = null;
      return view('artist.add', compact('prefrencelist','prefrencesublist','artist') );
       
    }
    public function store(ArtistFormRequest $request)
    {
        if($request->validated()){

          $path = "register";
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
            $artist->genres = $request->genres;
            $artist->major_achivement = $request->major_achivement;
            $artist->work_at = $request->work_at;
            $artist->performance = $request->performance;
            $artist->main_category_name = $request->category;
            $artist->sub_category_name = $request->subcategory;
            $artist->role = $request->role;
            $artist->description = $request->description;
            $artist->user_type = "artist";
            $artist->save();
          
            return redirect('/artist')->with('success','Artist Added successfully.');
          }else{

            return redirect('/artist/add')->with('error','something went wrong.');

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
       $artist = User::where("register_id",$request->id)->first();
       $prefrencelist = Preference::all();
       $prefrencesublist = Preference_subcategory::all();
       return view('artist.add',compact('artist','prefrencelist','prefrencesublist'));
    }

  

    public function saveEdit(Request $request)
    {
        
      $path = "artist";
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
        $artist->genres = $request->genres;
        $artist->major_achivement = $request->major_achivement;
        $artist->work_at = $request->work_at;
        $artist->performance = $request->performance;
        $artist->main_category_name = $request->category;
        $artist->sub_category_name = $request->subcategory;
        $artist->role = $request->role;
        $artist->description = $request->description;
        $artist->save();

        return redirect('/artist')->with('success','Artist Edited successfully'); ;
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
      return redirect('/artist')->with('success','Artist Deleted successfully');
    }


    public function detail(Request $request)
    {
       $artist = User::where("register_id",$request->id)->first();
       $prefrencelist = Preference::all();
       $prefrencesublist = Preference_subcategory::all();
       return view('artist.detail',compact('artist','prefrencelist','prefrencesublist'));
    }
    

    public function search(Request $request){

      if($request->ajax()){

        $keyword = $request->keyword;

        if(empty($keyword)){

          $users =  User::where('role', 'Artist')
                  ->where('updated_at','=',NULL)
                  ->where('user_type','=','artist')
                  ->orderBy('register_id', 'DESC')
                  ->Paginate(10);  
        }else{

          $users = User::where(function ($query) use ($keyword) {
              $query->where('name','like', "%".$keyword ."%")
                    ->orwhere('mobile','like',"%".$keyword ."%")
                    ->orwhere('email','like',"%".$keyword ."%");

          })->where(function ($query) {
              $query->where('user_type','=','artist')
                    ->where('updated_at','=',NULL);
          })->Paginate(10);  
        }
         
          
        return view('artist.search',compact('users'));
      }


  
    }
       
}






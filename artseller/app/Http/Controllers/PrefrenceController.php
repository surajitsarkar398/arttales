<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Preference;
use App\Http\Request\Preference\PreferenceFormRequest;
use Validator;
use DB;



class PrefrenceController extends Controller
{
   
    public function index(Request $request)
    {

        $prefrencelist = Preference::orderBy('id', 'DESC')
                        ->where('updated_at','=',NULL)
                        ->Paginate(10);
        return view('prefrence.view', compact('prefrencelist'));
    }

   
    public function store(PreferenceFormRequest $request)
    {
  
      if($request->validated()){

        $preference = new Preference();
        $preference->preferences_name = $request->preferences_name;
        $preference->save();

        return redirect('/prefrence/')->with('success','Prefrence Added successfully.');
      }

    }


 
    public function edit(Request $request)
    {

       $editPreference = Preference::where('id',$request->id)->first();
       $prefrencelist = Preference::orderBy('id', 'DESC')->Paginate(10);
       return view('prefrence.view', compact('editPreference','prefrencelist'));
    }

  
    public function saveEdit(Request $request){

        $prefrence = Preference::where('id', $request->preferences_id)->first();

        $prefrence->preferences_name = $request->preferences_name;
        $prefrence->save();   

        return redirect('/prefrence/')->with('success','Prefrence Edited successfully'); 
                
    }


    public function destroy(Request $request)
    {
        $prefrence = Preference::where('id','=',$request->id)->first();
        $prefrence->updated_at = date('Y-m-d H:i:s');
        $prefrence->save();
        return redirect('/prefrence/')->with('success','Preference  Deleted sucessfully');
    }



    public function search(Request $request){

        if($request->ajax()){

            $keyword = $request->keyword;

            if(empty($keyword)){

              $prefrencelist = Preference::orderBy('id', 'DESC')
                            ->where('updated_at','=',NULL)
                            ->Paginate(10);
            }else{

              $prefrencelist = Preference::where(function ($query) use ($keyword) {
                  $query->where('preferences_name','like', "%".$keyword ."%");
              })->where(function ($query) {
                  $query->where('updated_at','=',NULL);
              })->Paginate(10);  
            }
         
        }
          
        return view('prefrence.search',compact('prefrencelist'));
    }
}

<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Preference;
use App\Models\Preference_subcategory;
use App\Http\Request\SubPreference\SubPreferenceFormRequest;
use Validator;
use DB;



class SubPrefrenceController extends Controller
{
   
    public function index(Request $request)
    {

        $subPreferenceList = Preference_subcategory::leftjoin('preferences','preferences.id','preference_subcategories.id' )
            ->where('preference_subcategories.updated_at','=',NULL)
            ->orderBy('preference_subcategories_id', 'DESC')
            ->Paginate(10);

        $preference = Preference::orderBy('id', 'DESC')
                        ->where('updated_at','=',NULL)->get();
        return view('sub_prefrence.view', compact('subPreferenceList','preference'));
    }

   
    public function store(SubPreferenceFormRequest $request)
    {
  
     
      if($request->validated()){

        $subPreference = new Preference_subcategory();
        $subPreference->preference_subcategories_name = $request->preference_subcategories_name;
        $subPreference->id = $request->preferences_name;
        $subPreference->save();

        return redirect('/sub-prefrence/')->with('success','Sub-Prefrence Added successfully.');
      }

    }


 
    public function edit(Request $request)
    {

        $editSubPreference = Preference_subcategory::where('preference_subcategories_id',$request->id)->first();

        $preference = Preference::orderBy('id', 'DESC')
                        ->where('updated_at','=',NULL)->get();
        $subPreferenceList = Preference_subcategory::leftjoin('preferences','preferences.id','preference_subcategories.id' )
            ->where('preference_subcategories.updated_at','=',NULL)
            ->orderBy('preference_subcategories_id', 'DESC')
            ->Paginate(10);


       return view('sub_prefrence.view', compact('editSubPreference','preference','subPreferenceList'));
    }

  
    public function saveEdit(Request $request){

        $subPreference = Preference_subcategory::
                        where('preference_subcategories_id', $request->sub_preferences_id)
                        ->first();
        $subPreference->preference_subcategories_name = $request->sub_preferences_name;
        $subPreference->id = $request->preferences_name;
        $subPreference->save();

        return redirect('/sub-prefrence/')->with('success','Sub Prefrence Edited successfully'); 
                
    }


    public function destroy(Request $request)
    {
        $subPreference = Preference_subcategory::
                        where('preference_subcategories_id', $request->id)
                        ->first();
        $subPreference->updated_at = date('Y-m-d H:i:s');
        $subPreference->save();
        return redirect('/sub-prefrence/')->with('success','Sub Preference  Deleted sucessfully');
    }



    public function search(Request $request){

        if($request->ajax()){

            $keyword = $request->keyword;

            if(empty($keyword)){

                $subPreferenceList = Preference_subcategory::leftjoin('preferences','preferences.id','preference_subcategories.id' )
                    ->where('preference_subcategories.updated_at','=',NULL)
                    ->orderBy('preference_subcategories_id', 'DESC')
                    ->Paginate(10);
            }else{

              $subPreferenceList = Preference_subcategory::leftjoin('preferences',
                'preferences.id','preference_subcategories.id' )
                ->where(function ($query) use ($keyword) {
                    $query->where('preference_subcategories_name','like', "%".$keyword ."%")
                    ->orWhere('preferences.preferences_name','like', "%".$keyword ."%");
                })->where(function ($query) {
                  $query->where('preference_subcategories.updated_at','=',NULL);
                })->Paginate(10);  
            }
         
        }
          
        return view('sub_prefrence.search',compact('subPreferenceList'));
    }
}

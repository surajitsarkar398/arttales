<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Preference_subcategory;
use App\Models\Preference;
use Validator;
use DB;
use App\VSE;

class PreferencesubcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
         $prefrencesublist = Preference_subcategory::join('preferences','preference_subcategories.id','=','preferences.id')
        ->select('preference_subcategories.*','preferences.preferences_name')
        ->orderBy('id', 'DESC')
        ->get();
        return view('prefrence.preferencesubview', compact('prefrencesublist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $prefrencelist = Preference::all();
         return view('prefrence.preferencesubadd', compact('prefrencelist') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $data = $request->all();
       
        $rules = array(
            'preference_subcategories_name' => 'required',
            'language' => 'required',
             'id'=>'required'
        );

        //print_r($data);die;
        $validation = Validator::make($data,$rules);
        if($validation->fails()){ 
           // print_r($validation->errors()->all());
            return redirect()->back()->withInput()->withErrors($validation); 

        
        }else{
        
         
            Preference_subcategory::create($data);  
            return redirect('/prefrence/preferencesubview/')->with('success','Prefrence Subcategory Added successfully.');
            /*return redirect()->route('/user/addartist/')
                            ->with('success','User Add successfully.');*/
                          

           
        }
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
    public function edit(Request $request)
    {
         $prefrencesublist = Preference_subcategory::where('preference_subcategories_id',$request->id)->first();
         $prefrencelist = Preference::all();
       return view('prefrence.preferencesubedit', compact('prefrencesublist','prefrencelist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveEdit(Request $request)
    {
       // print_r($request->all()); die;
        $prefrencesublist = Preference_subcategory::where('preference_subcategories_id', $request->preference_subcategories_id)->first();
        
        $prefrencesublist->preference_subcategories_name = $request->preference_subcategories_name ?? $prefrencesublist->preference_subcategories_name;

          $prefrencesublist->language = $request->language ?? $prefrencesublist->language;

        $prefrencesublist->id = $request->prence_id ?? $prefrencelist->preferences_name;





        $prefrencesublist->save();   

        return redirect('/prefrence/preferencesubview')->with('success','Prefrence Has Been Updated'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Preference_subcategory::where('preference_subcategories_id','=',$id)->delete();
        return redirect('/prefrence/preferencesubview/')->with('success','Preference Has Deleted');
    }


     public function search(Request $request){
        // return view('hello');
         // print_r($request->all());die;


        $search = $request->get('search');
      
         // $userslist = User::where('performance','LIKE','%',$search,'%')->get();
         $userslist = DB::table('preferences')->where('preferences_name','LIKE',"%{$search}%")->get();
  
         foreach ($userslist as $key => $id) {
            $prefid = $id->id;
             
         }
           
           $prefrencesublist = Preference_subcategory::join('preferences','preference_subcategories.id','=','preferences.id')
        ->select('preference_subcategories.*','preferences.preferences_name')
        ->where('preferences.id','=',$prefid )
        ->orderBy('id', 'DESC')
        ->get();

        return view('prefrence.preferencesubview', compact('prefrencesublist'));

       // return $userslist;
     // return view('user.viewartistlist',compact('userslist'));
    }
    public function searchsub(Request $request){
     
        $search = $request->get('search');

        $prefrencesublist = DB::table('preference_subcategories')->where('preference_subcategories_name','LIKE',"%{$search}%")->get();
       // return $prefrencesublist;
     return view('prefrence.preferencesubview',compact('prefrencesublist'));
    }




}

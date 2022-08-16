<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use App\Http\Utility\CustomVerfication;
use DB;




class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userslist =  User::where('role', 'ArtistLover')
         ->orderBy('register_id', 'DESC')
        ->get();


        return view('user.viewartist',compact('userslist'));
    }

    // public function index(Request $request)
    // {
    //     $userslist = User::
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         return view('user.addartist');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 

     $CustomVerfication = new CustomVerfication;
     
        $data = $request->all();
       
        $rules = array(
            'name' => 'required',
            'country_code'  => 'required',
            'dob' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'password' => 'required',
            'repasswprd' => 'required',
            'role'       => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        );

        //print_r($data);die;
        $validation = Validator::make($data,$rules);
        if($validation->fails()){ 
           // print_r($validation->errors()->all());
            return redirect()->back()->withInput()->withErrors($validation); 

        
        }else{
            $path = "register";
            $image= $CustomVerfication->imageUpload($data['image'],$path);
            $data['image'] = $image;
           // print_r($data['image']);die;
         
            User::create($data);  
            return redirect('/user/addartist/')->with('success','Artist Lover Added successfully.');
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
         User::where('register_id','=',$id)->delete();
        return redirect('/user/viewartist/')->with('success','Artist Lover Has Deleted');
    }

    public function ChangeStatus(Request $request){
        dd("dd");
      $Courses = User::where('register_id','=',$request->id)->first();
      $Courses->isban = $request->status;
      $Courses->save();
    }


   


    
}

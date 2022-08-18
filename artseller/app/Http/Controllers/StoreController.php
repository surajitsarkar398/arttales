<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Validator;
use App\Http\Utility\CustomVerfication;
use DB;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storelist = Store::orderBy('store_id', 'DESC')->where('register_id','=',Auth::user()->register_id)
                    ->get();
                 
        return view('store.viewstore', compact('storelist'));

    }
      public function pending()
    {
        $storelist = Store::orderBy('store_id', 'DESC')
        ->where('is_approval', '0')->where('register_id','=',Auth::user()->register_id)
        ->get();
        return view('store.pendingstore', compact('storelist'));

    }
      public function approve()
    {
        $storelist = Store::orderBy('store_id', 'DESC')
        ->where('is_approval', '1')->where('register_id','=',Auth::user()->register_id)
        ->get();
        return view('store.approvestore', compact('storelist'));

    }

    public function viewstoredetails(Request $request)
    {
    
    
        $storelist = Store::where('store_id',$request->id)->first();
               return view('store.viewstoredetails', compact('storelist'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('store.addstore');
    }
      public function download($file)
    {
         //return response->download('uploads/'.$file);
         //return response(download('uploads/'.$file));
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
            'store_name' => 'required',
            'category'  => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'website' => 'required',
            'address' => 'required',
            'store_image' => 'required',
            'attachment' => 'required',
            'detail'    =>'required',
          
        );
      
     
        $validation = Validator::make($data,$rules);
       
        if($validation->fails()){ 
           // print_r($validation->errors()->all());
            return redirect()->back()->withInput()->withErrors($validation); 

        
        }else{
                $file =  $request->file('attachment');     
                $filename = time().'.'.$file->getclientOriginalExtension();
                $request->attachment->move(public_path('uploads'),$filename);
                $data['attachment']= $filename;

               
      
            // $path = "store";
            // $image= $CustomVerfication->imageUpload($data['store_image'],$path);
            // $data['store_image'] = $image;
           // print_r($data['image']);die;        $files =  $request->file('product_image'); 

        $files =  $request->file('store_image');     
        $images=array();
      
        $path = "store";
        foreach($files as $file){

          $image = $file ?? null;
          if($image !=null){                                                       
            $images[]= $CustomVerfication->imageUpload($image,$path);
          }else{
            $images = null;
          }
          }
       
            $data['store_image'] = implode(',', $images); 
            $data['register_id'] = Auth::user()->register_id;
            

          
            $id=Store::create($data)->store_id; 
            
            $store_edit = Store::where('store_id', $id)->first();
            $store_edit->store_code  = strtoupper(substr($request->store_name,0,3)).'-'.$id;
            $store_edit->save();   
           
            return redirect('store')->with('success','Store Added successfully.');
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
        $storelist = Store::where('store_id',$request->id)->first();
       
       return view('store.editstore', compact('storelist'));
    }


    public function detail(Request $request)
    {
        $storelist = Store::where('store_id',$request->id)->first();
       return view('store.viewstoredetails', compact('storelist'));
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

        $CustomVerfication = new CustomVerfication;
        $storelist = Store::where('store_id', $request->stores_id)->first();

        $storelist->store_name = $request->store_name ?? $storelist->store_name;
        $storelist->detail = $request->detail ?? $storelist->detail;

        $storelist->category = $request->category ?? $storelist->category;

        $storelist->mobile = $request->mobile ?? $storelist->mobile;

        $storelist->email  = $request->email ?? $storelist->email;

        $storelist->website  = $request->website  ?? $storelist->website;

      
        $file =  $request->file('attachment');  
      
        if($request->file('attachment')!=""){
          $file =  $request->file('attachment');
        $filename1 = time().'.'.$file->getclientOriginalExtension();
        $request->attachment->move(public_path('uploads'),$filename1);
        $storelist->attachment= $filename1;
        }
        if($request->file('store_image')!=""){
          $file =  $request->file('store_image');
          $filename2 = time().'.'.$file->getclientOriginalExtension();
          $request->store_image->move(public_path('images/store'),$filename2);
          $storelist->store_image= $filename2;
          }
        
       $storelist->save();   


        return redirect('/store')->with('success','store Has Been Updated'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          Store::where('store_id','=',$id)->delete();
        return redirect('/store')->with('success','Store Has Deleted');
    }

        public function decline($id)
    {
          Store::where('store_id','=',$id)->delete();
        return redirect('/store/pendingstore/')->with('success','Store Has Deleted');
    }

        public function approval(Request $request){
        //print_r($request->all());die;
      $Courses = Store::where('store_id','=',$request->id)->first();
      $Courses->is_approval = $request->status;
      $Courses->save();
    }


    public function ChangeStatus(Request $request){
        //print_r($request->all());die;
      $Courses = Store::where('store_id','=',$request->id)->first();
      $Courses->is_approval = $request->status;
      $Courses->save();
    }

       public function Block(Request $request){
        //print_r($request->all());die;
      $Blocks = Store::where('store_id','=',$request->id)->first();
      $Blocks->isban = $request->status;
      $Blocks->save();
    }

       public function Blockpending(Request $request){
        //print_r($request->all());die;
      $Blockspending = Store::where('store_id','=',$request->id)->first();
      $Blockspending->isban = $request->status;
      $Blockspending->save();
    }

       public function Blockapproval(Request $request){
        //print_r($request->all());die;
      $Blocksapproval = Store::where('store_id','=',$request->id)->first();
      $Blocksapproval->isban = $request->status;
       $Blocksapproval->save();
    }





}

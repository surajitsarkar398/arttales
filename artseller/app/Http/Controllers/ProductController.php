<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Store;
use Validator;
use App\Http\Utility\CustomVerfication;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productlist = Product::orderBy('product_id', 'DESC')->where('register_id','=',Auth::user()->register_id)
        ->Paginate(10);

        return view('product.view', compact('productlist'));
    }

    public function sellproduct()
    {
        $productlist = DB::table('products')
            ->join('users', 'products.register_id', '=', 'users.register_id')
            ->join('stores', 'products.store_id', '=', 'stores.store_id')
            ->select('products.*', 'users.name', 'stores.store_name')
            ->where('sell_product', '1')
            ->get();


        return view('product.sellproduct', compact('productlist'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $storelist = Store::where('register_id','=',Auth::user()->register_id)
                    ->get();
        return view('product.addproduct',compact('storelist'));
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
            'product_name1' => 'required',
            'price1'  => 'required',
            'discount1' => 'required',
            'offer_price1' => 'required',
            'product_description1' => 'required',
            'product_image1' => 'required',
            'limited_stock1' => 'required',
            'store1' => 'required',
        );
 
        //print_r($data);die;
        $validation = Validator::make($data,$rules);
        if($validation->fails()){ 
           // print_r($validation->errors()->all());
            return redirect()->back()->withInput()->withErrors($validation); 

        
        }else{
            // $path = "product";
            // $image= $CustomVerfication->imageUpload($data['product_image'],$path);
            

           // print_r($data['image']);die;
          $tot_div=$data['tot_div'];
          for ($i=1; $i <=$tot_div; $i++) { 
          $product = new Product;
          $product->product_name=$data['product_name'.$i];
          $product->price=$data['price'.$i];
          $product->discount=$data['discount'.$i];
          $product->offer_price=$data['offer_price'.$i];
          $product->store_id=$data['store'.$i];
          $product->register_id=Auth::user()->register_id;
          $files =  $request->file('product_image'.$i);    
          $images=array();
          $path = "product";
          foreach($files as $file){

          $image = $file ?? null;
          if($image !=null){                                                       
            $images[]= $CustomVerfication->imageUpload($image,$path);
          }else{
            $images = null;
          }
          }
          $product['product_image'] = implode(',', $images); 
          $product->product_description=$data['product_description'.$i];
          $product->product_description=$data['limited_stock'.$i];
          $product->save();   
          }
         
          return redirect('product/add')->with('success','Products Added successfully.');
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
        $productlist = Product::where('product_id',$request->id)->first();
       return view('product.editproduct', compact('productlist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function saveEdit(Request $request){
    
        $productlist = Product::where('product_id', $request->products_id)->first();

        $productlist->product_name = $request->product_name ?? $productlist->product_name;

        $productlist->price = $request->price ?? $productlist->price;

        $productlist->offer_price = $request->offer_price ?? $productlist->offer_price;

        $productlist->discount  = $request->discount  ?? $productlist->discount;

        $productlist->product_description  = $request->product_description  ?? $productlist->product_description;

         $productlist->limited_stock  = $request->limited_stock  ?? $productlist->limited_stock;

         $CustomVerfication = new CustomVerfication;

        $files =  $request->file('product_image');    
        $images=array();
        $path = "product";
         if(!empty($files)){
        foreach($files as $file){

            $image = $file ?? null;
            if($image !=null){                                                       
              $images[]= $CustomVerfication->imageUpload($image,$path);
            }else{
              $images = null;
            }
            }
        }
        $imagep = $request->images;


           if(!empty($images) && !empty($imagep)){
            $result = array_merge($images,$imagep);
             $productlist = implode(',',$result);
         }
         elseif(!empty($images) && empty($imagep)){
            $result = $images;
             $productlist= implode(',',$result);
         }
         elseif(empty($images) && !empty($imagep)){
            $result = $imagep;
             $productlist = implode(',',$result);
         }
         else{ 
         $result= ""; 
         } 
        $productlist->save();   
        
        return redirect('/product')->with('success','Product Has Been Updated'); 
                
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          Product::where('product_id','=',$id)->delete();
        return redirect('/product')->with('success','Product Has Deleted');
    }
}

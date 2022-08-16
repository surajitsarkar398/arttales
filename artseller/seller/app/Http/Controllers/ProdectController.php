<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Facades\Validator;
use App\Http\Utility\CustomVerfication;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class ProdectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productlist = Product::orderBy('product_id', 'DESC')->where('added_by','seller')
        ->Paginate(10);

        return view('product.view', compact('productlist'));
    }

    public function adminindex()
    {
        $productlist = Product::orderBy('product_id', 'DESC')->where('added_by','admin')
        ->Paginate(10);

        return view('product.product_list', compact('productlist'));
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
        return view('product.addproduct');
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
            'product_name' => 'required',
            'price'  => 'required',
            'discount' => 'required',
            'offer_price' => 'required',
            'product_description' => 'required',
            'product_image' => 'required',
            'limited_stock' => 'required',
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

        $files =  $request->file('product_image');    
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
            $data['product_image'] = implode(',', $images); 
            Product::create($data);  
            return redirect('/product/addproduct/')->with('success','Product Added successfully.');
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
        $productlist = Product::where('product_id',$request->product_id)->first();
       return view('product.seller_edit', compact('productlist'));
    }
    
    Public function seller_edit(Request $request ,  $product_id)
    {
        $productlist = Product::findOrFail($product_id);
        // dd($productlist);
        // $productlist = Product::where('product_id', $request->product_id)->first();

            $productlist->product_name = $request->product_name; 

            $productlist->price = $request->price; 

            $productlist->offer_price = $request->offer_price;

            $productlist->discount  = $request->discount; 

            $productlist->product_description  = $request->product_description; 

            $productlist->limited_stock  = $request->limited_stock;

            $productlist->save();

            return redirect('/product')->with('success','Product Has Been Updated'); 

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
        $product_name = $productlist->product_name;
        $product_image = $productlist->product_image;
        $price = $productlist->price;
        $discount = $productlist->discount;
        $offer_price = $productlist->offer_price;
        $product_description = $productlist->product_description;
        $limited_stock = $productlist->limited_stock;
        $insertProduct = new Product;
        $insertProduct->product_name = $product_name;
        $insertProduct->product_image = $product_image;
        $insertProduct->price = $request->price;
        $insertProduct->discount = $request->discount;
        $insertProduct->offer_price = $request->offer_price;
        $insertProduct->product_description = $request->product_description;
        $insertProduct->limited_stock = $request->limited_stock;
        $insertProduct->added_by = "seller";
        $insertProduct->save();   
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

<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Validator;
use DB;
use App\Http\Utility\CustomVerfication;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $orderlist = DB::table('orders')
                    ->join('users', 'orders.register_id', '=', 'users.register_id')
                    ->join('products', 'orders.product_id', '=', 'products.product_id')
                    ->join('stores', 'orders.store_id', '=', 'stores.store_id')
                     ->select('orders.*', 'users.*','products.*','stores.*')
                    ->where('orders.is_approval', '0')
                    ->get();
        return view('order.pendingorder', compact('orderlist'));
        // return view('order.pendingorder');
    }


     public function ChangeStatus(Request $request){
        //print_r($request->all());die;
      $Courses = Order::where('order_id','=',$request->id)->first();
      $Courses->is_approval = $request->status;
      $Courses->save();
    }

    public function approve()
    {
        $orderlist = DB::table('orders')
                    ->join('users', 'orders.register_id', '=', 'users.register_id')
                    ->join('products', 'orders.product_id', '=', 'products.product_id')
                    ->join('stores', 'orders.store_id', '=', 'stores.store_id')
                     ->select('orders.*', 'users.*','products.*','stores.*')
                    ->where('orders.is_approval', '1')
                    ->get();
                  
        return view('order.approveorder', compact('orderlist'));

    }

        public function cancel()
    {
        $orderlist = DB::table('orders')
                    ->join('users', 'orders.register_id', '=', 'users.register_id')
                    ->join('products', 'orders.product_id', '=', 'products.product_id')
                    ->join('stores', 'orders.store_id', '=', 'stores.store_id')
                     ->select('orders.*', 'users.*','products.*','stores.*')
                    ->where('orders.is_cancelled', '1')
                    ->get();
                   
        return view('order.cancelorder', compact('orderlist'));

    }

    public function approval(Request $request){
        //print_r($request->all());die;
      $Courses = Store::where('store_id','=',$request->id)->first();
      $Courses->is_approval = $request->status;
      $Courses->save();
    }

      public function productsearch(Request $request){
        
        $search = $request->get('search');
      
         // $userslist = DB::table('products')->where('product_name','LIKE',"%{$search}%")
         // ->get();
           
           $orderlist = DB::table('orders')
           ->join('users', 'orders.register_id', '=', 'users.register_id')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->join('stores', 'orders.store_id', '=', 'stores.store_id')
            ->select('orders.*', 'users.*','products.*','stores.*')
            ->orderBy('order_id', 'DESC')
            ->where('products.product_name','LIKE',"%{$search}%")
            ->get();


        return view('order.pendingorder', compact('orderlist'));

    }

        public function searchstore(Request $request){
        
        $search = $request->get('search');
      

           $orderlist = DB::table('orders')
           ->join('users', 'orders.register_id', '=', 'users.register_id')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->join('stores', 'orders.store_id', '=', 'stores.store_id')
            ->select('orders.*', 'users.*','products.*','stores.*')
            ->orderBy('order_id', 'DESC')
            ->where('stores.store_name','LIKE',"%{$search}%")
            ->orWhere('stores.category','LIKE',"%{$search}%")
            ->get();


        return view('order.pendingorder', compact('orderlist'));

       // return $userslist;
     // return view('user.viewartistlist',compact('userslist'));
    }

  public function orderStatusUpdate(Request $request){
           
        if(isset($request->order_id) && isset($request->order_status)){
          //save order status
          $uptStatus =DB::table('orders')->where('order_id',$request->order_id)
          ->update(['status' => $request->order_status]);

          if($uptStatus){
            echo "Order " . $request->order_status;
          }
          else{
            echo "error";
          }
        }
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}

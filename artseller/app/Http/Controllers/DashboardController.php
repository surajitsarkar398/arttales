<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __consturct(){
        $this->middleware('auth');

    }
    
    public function index()
    {
        $register_id=Auth::user()->register_id;
        $count = User::where('role', 'Artist')->count();
        $data=array();
        
        $data['total_sale']=Order::where('user_id',$register_id)->where('date',date('Y-m-d'))->sum('grand_total');

        if(isset($_GET['sale_type']) && $_GET['sale_type']=='monthly'){

        $data['total_sale']=Order::where('user_id',$register_id)->whereMonth("date",'=',date('m'))->sum('grand_total');

        }else if(isset($_GET['sale_type']) && $_GET['sale_type']=='yearly'){

        $data['total_sale']=Order::where('user_id',$register_id)->whereYear('date',date('Y'))->sum('grand_total');

        }


        $data['total_order']=Order::where('user_id',$register_id)->where('is_approval',1)->count();

        if(isset($_GET['order_type']) && $_GET['order_type']=='cancelled'){   
        $data['total_order']=Order::where('user_id',$register_id)->where('is_cancelled',1)->count();
        }else if(isset($_GET['order_type']) && $_GET['order_type']=='pending'){
        $data['total_order']=Order::where('user_id',$register_id)->where('is_cancelled',0)->where('is_approval',0)->count();
        }



        $data['total_product']=Product::where('seller_id',$register_id)->Paginate(4);
     
        
        return view('dashboard',compact('data'));
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

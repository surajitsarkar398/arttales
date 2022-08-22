<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class sellerController extends Controller
{
    // public function index()
    // {
    //     $users =  User::orderBy('register_id', 'DESC')
    //     ->paginate(10);
    //     return view('seller_user.view', compact('users'));
    // }
    public function index()
    {
        $users =  User::where('role', 'Artist')
                  ->where('updated_at','=',NULL)
                  ->where('type','=','seller')
                  ->orderBy('register_id', 'DESC')
                  ->Paginate(2);  
        return view('seller_user.view',compact('users'));
    }
    public function update_seller()
    {
       
    }
}

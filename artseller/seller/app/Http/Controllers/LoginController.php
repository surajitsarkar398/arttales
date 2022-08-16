<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Request\LoginFormRequest;
use App\Http\Controllers\Repository\LoginRepository;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use Route;
use Redirect;


use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
   public function login(){
      return view('login');
   }

   public function dologin(LoginFormRequest $request, LoginRepository $loginRepository){

   	if($request->validated()){
    		
    		$userCredential =  $loginRepository->doLogin($request->email,$request->password);
    		if($userCredential !== 0){
    			return redirect()->route('dashboard')->with('success', 'Login successful');
    		}else{
    			return redirect()->back()->with('error', 'Invalid email or password');
    		}

    	}
   	
	}

   public function Logout(){

      Auth::logout();
      return redirect()->route('login');
   }

  
}

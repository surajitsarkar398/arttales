<?php

namespace App\Http\Controllers\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginRepository extends User{

	public function doLogin($email,$password){

		$auth = Auth::attempt(['email' => $email, 'password' => $password, 'type' => 'seller']);
	    if($auth == true){
            $user = Auth::user();
            
        }else{
	        $user = 0;
        }
        return $user;
    }

}

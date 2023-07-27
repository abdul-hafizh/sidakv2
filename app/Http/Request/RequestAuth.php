<?php

namespace App\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Auth;


class RequestAuth
{

    public static function requestHash($username,$password)
    {   

    	$user = User::where('username',$username)->first(); 
    	if ($user !=null)
        {
           if (!Hash::check($password, $user->password)) {
             if($password == $user->password)
             {
                  User::where('username',$username)->update(['password'=> Hash::make($password)]);
             } 
            
           }
        }
       
		

    } 



   

   


}
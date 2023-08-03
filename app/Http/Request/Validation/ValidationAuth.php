<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class ValidationAuth
{
   public static function validation($request){

        $err = array(); 
         
        $fields = [
            'username'  => 'Username',  
            'password'  => 'Password',
        ];

        $validator =  Validator::make($request->all(), 
        [
            'username'  => 'required|exists:users,username',
            'password' => ['required', new ValidationPassword($request->username)]
               
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();

            return $errors;
       }
  }

}

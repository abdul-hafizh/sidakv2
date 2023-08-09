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
            'username'  => 'Nama Pengguna',  
            'password'  => 'Kata Sandi',
        ];

        $validator =  Validator::make($request->all(), 
        [
            'username'  => 'required|exists:users,username',
            'password' =>  'required',
               
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            if($errors->has('username'))
            {
                $err['messages']['username'] = $errors->first('username');
            }           
            
            if($errors->has('password'))
            {
                $err['messages']['password'] = $errors->first('password');
            }

            return $err;
       }
  }

}
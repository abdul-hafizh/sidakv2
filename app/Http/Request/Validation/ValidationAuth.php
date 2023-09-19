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

  public static function validationForgot($request)
  {
        $err = array(); 
        $fields = [
            'email'  => 'Email Pengguna' 
           
        ];

        $validator =  Validator::make($request->all(), 
        [
            'email'  => 'required|exists:users,email',
           
               
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            if($errors->has('email'))
            {
                $err['messages']['email'] = $errors->first('email');
            }           
            
          

            return $err;
       }


  }

  public static function validationToken($request)
  {
        $err = array(); 
        $fields = [
            'token'  => 'Token Validasi' 
           
        ];

        $validator =  Validator::make($request->all(), 
        [
            'token'  => 'required|exists:users,token',
           
               
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            if($errors->has('token'))
            {
                $err['messages']['token'] = $errors->first('token');
            }           
            
          

            return $err;
       }
  }


  public static function validationPassword($request){
        $err = array(); 
        
        $fields = [
          
            'email'  => 'Email',
            'password'  => 'Password',
            'password_confirmation'  => 'Password Konfirmasi',
        ];

        $validator =  Validator::make($request->all(), 
        [
           
            'email'  => 'required|exists:users,email',
            'password'  => 'required|confirmed|min:6',
            'password_confirmation'  => 'required',
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
           
            if($errors->has('email')){
                $err['messages']['email'] = $errors->first('email');
            }

            
            
            if($errors->has('password')){
                $err['messages']['password'] = $errors->first('password');
            }

            if($errors->has('password_confirmation')){
                $err['messages']['password_confirmation'] = $errors->first('password_confirmation');
            } 
            return $err;
       }
    }

}
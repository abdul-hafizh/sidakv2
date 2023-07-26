<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;

class ValidationKeys
{
   public static function validation($request){
        $err = array(); 

        $fields = [
            'password'  => 'Password',
        ];

        $validator =  Validator::make($request->all(), 
        [
            'password'  => 'required|max:255',
           
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
            if($errors->has('password')){
                $err['messages']['password'] = $errors->first('password');
            }
            return $err;
       }
  }

}

<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;

class ValidationMobil
{
    public static function validation($request){
        $err = array(); 
        
        $fields = [
            'name'  => 'Name',
            
        ];

        $validator =  Validator::make($request->all(), 
        [
            'name'  => 'required|max:255',
            
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

           
            

            return $err;
       }
    }


   
}

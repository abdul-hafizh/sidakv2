<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;

class ValidationMenus
{
   public static function validation($request){
        $err = array(); 
        
       
        $fields = [
            'name'  => 'Name',  
            'icon'  => 'Icon',
            
           
        ];

        $validator =  Validator::make($request->all(), 
        [
            'name'  => 'required|max:255',
            'icon'  => 'required',
          
            
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

            if($errors->has('icon')){
                $err['messages']['icon'] = $errors->first('icon');
            }


            return $err;
       }
  }

}

<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ValidationMenus
{
   public static function validationInsert($request){
        $err = array(); 
        
       
        $fields = [
            'name'  => 'Name',  
            'icon'  => 'Icon',
            
           
        ];

        $validator =  Validator::make($request->all(), 
        [
            'name'  => 'required|unique:menus,name',
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

  public static function validationUpdate($request,$id){
        $err = array(); 
        
       
        $fields = [
            'name'  => 'Name',  
            'icon'  => 'Icon',
            
           
        ];

        $validator =  Validator::make($request->all(), 
        [
            'name' => [
                'required',
                Rule::unique('menus')->ignore($id),
            ],
           
          
            
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

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
            'parent'  => 'Pilihan Menu',    
            'icon'  => 'Icon',
            'icon_hover'  => 'Icon Hover',
           
        ];

        $validator =  Validator::make($request->all(), 
        [
            'name'  => 'required|unique:menus,name',
            'parent'  => 'required',
            'icon'  => 'required',
            'icon_hover'  => 'required',
            
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

            if($errors->has('parent')){
                $err['messages']['parent'] = $errors->first('parent');
            }
            if($errors->has('icon')){
                $err['messages']['icon'] = $errors->first('icon');
            }
           
              if($errors->has('icon_hover')){
                $err['messages']['icon_hover'] = $errors->first('icon_hover');
            }

            return $err;
       }
  }

  public static function validationUpdate($request,$id){
        $err = array(); 
        
       
        $fields = [
            'name'  => 'Name',  
            'parent'  => 'Pilihan Menu',
            
           
        ];

        $validator =  Validator::make($request->all(), 
        [
            'name' => [
                'required',
                Rule::unique('menus')->ignore($id),
            ],
             'parent'  => 'required',
           
          
            
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

             if($errors->has('parent')){
                $err['messages']['parent'] = $errors->first('parent');
            }


            return $err;
       }
  }

}

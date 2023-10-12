<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ValidationMenus
{
   public static function validationInsert($request){
        $err = array(); 
        
       
        $fields = [
            'name'  => 'Nama',
            'slug'  => 'Koneksi Optional',
            'parent'  => 'Pilihan Menu',
            // 'path_web' => 'URL',
            'icon'  => 'Icon',
            'icon_hover'  => 'Icon Hover',
           
        ];

        $validator =  Validator::make($request->all(), 
        [
            'name'  => 'required',
            'slug'  => 'required',
            'parent'  => 'required',
            // 'path_web' =>'required_if:parent,sub',
            'icon'  => 'required',
            'icon_hover'  => 'required',
            
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

            if($errors->has('slug')){
                $err['messages']['slug'] = $errors->first('slug');
            }

            if($errors->has('parent')){
                $err['messages']['parent'] = $errors->first('parent');
            }
            // if($errors->has('path_web')){
            //     $err['messages']['path_web'] = $errors->first('path_web');
            // }
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
            'slug'  => 'Koneksi Optional',
            'parent'  => 'Pilihan Menu',
            // 'path_web'=>'URL',
            
        ];

        $validator =  Validator::make($request->all(), 
        [
            'name' => 'required',
            'slug'  => 'required',
            'parent'  => 'required',
            // 'path_web' => [
            //     'required_if:parent,sub',
            //     Rule::unique('menus')->ignore($id),
            // ],
             
          
           
          
            
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

            if($errors->has('slug')){
                $err['messages']['slug'] = $errors->first('slug');
            }

            if($errors->has('parent')){
                $err['messages']['parent'] = $errors->first('parent');
            }


            // if($errors->has('path_web')){
            //     $err['messages']['path_web'] = $errors->first('path_web');
            // }


            return $err;
       }
  }

}

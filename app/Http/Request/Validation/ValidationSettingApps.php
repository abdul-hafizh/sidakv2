<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;

class ValidationSettingApps
{
   public static function validation($request){
        $err = array(); 
        
        $fields = [
            'title'  => 'Name',
            'description'  => 'Description',
            'logo_lg'  => 'Logo',
        ];

        $validator =  Validator::make($request->all(), 
        [
            'title'  => 'required|max:255',
            'description'  => 'required',
            'logo_lg'  => 'required',
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
            if($errors->has('title')){
                $err['messages']['title'] = $errors->first('title');
            }

            if($errors->has('description')){
                $err['messages']['description'] = $errors->first('title');
            }

            if($errors->has('logo_lg')){
                $err['messages']['logo_lg'] = $errors->first('logo_lg');
            }

            return $err;
       }
  }

}

<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;

class ValidationForum
{
    public static function validation($request){
        $err = array(); 
        
        $fields = [
            'category'  => 'Kategori',
            'description'=>'Keterangan',
            'status'=>'Status',
        ];

        $validator =  Validator::make($request->all(), 
        [
            'category'  => 'required',
            'description'  => 'required',
            'status'  => 'required',
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
            if($errors->has('category')){
                $err['messages']['category'] = $errors->first('category');
            }

            if($errors->has('description')){
                $err['messages']['description'] = $errors->first('description');
            }

            if($errors->has('status')){
                $err['messages']['status'] = $errors->first('status');
            }

            

            return $err;
       }
    }


    


   
}

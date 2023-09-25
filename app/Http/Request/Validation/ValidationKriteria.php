<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;

class ValidationKriteria
{
    public static function validation($request){
        $err = array(); 
        
        $fields = [
            'category'  => 'Kategori',
            'description'=>'Keterangan',
            
        ];

        $validator =  Validator::make($request->all(), 
        [
            'category'  => 'required|max:255',
             'description'  => 'required',
           
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

          

            

            return $err;
       }
    }


   
}

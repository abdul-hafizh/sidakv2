<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;

class ValidationKriteria
{
    public static function validation($request){
        $err = array(); 
        
        $fields = [
            'name'  => 'Nama',
            'status'=>'Status',
        ];

        $validator =  Validator::make($request->all(), 
        [
            'name'  => 'required|max:255',
            'status'  => 'required',
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

            if($errors->has('status')){
                $err['messages']['status'] = $errors->first('status');
            }

            

            return $err;
       }
    }


   
}

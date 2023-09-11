<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ValidationRoles
{
    public static function validationInsert($request){
        $err = array(); 
        
        $fields = [
            'name'  => 'Nama',
            'status'=>'Status',
        ];

        $validator =  Validator::make($request->all(), 
        [
            'name' => 'required|unique:role,name',
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


    public static function validationUpdate($request,$id){
        $err = array(); 
        
        $fields = [
            'name'  => 'Nama',
            'status'=>'Status',
        ];

        $validator =  Validator::make($request->all(), 
        [
            'name' => [
                'required',
                Rule::unique('role')->ignore($id),
            ], 
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

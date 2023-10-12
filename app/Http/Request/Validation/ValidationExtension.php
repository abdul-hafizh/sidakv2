<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ValidationExtension
{
   public static function validationInsert($request){
        $err = array(); 
        
        $fields = [
           
            'semester'  => 'Semester',
            'year'  => 'Tahun',
            'extensiondate'  => 'Tanggal Pengajuan',
            'description'  => 'Alasan Pengajuan',
            
           
        ];

        $validator =  Validator::make($request->all(), 
        [
           
            'semester'  => 'required|max:2',
            'year'  => 'required|max:4',
            'extensiondate'  => 'required',
            'description'  => 'required',  
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
           

            if($errors->has('semester')){
                $err['messages']['semester'] = $errors->first('semester');
            }

            if($errors->has('year')){
                $err['messages']['year'] = $errors->first('year');
            }

            if($errors->has('extensiondate')){
                $err['messages']['extensiondate'] = $errors->first('extensiondate');
            }

             if($errors->has('description')){
                $err['messages']['description'] = $errors->first('description');
            }

            return $err;
       }
  }


  public static function validationUpdate($request,$id){
        $err = array(); 
        
        $fields = [
           
            'semester'  => 'Semester',
            'year'  => 'Tahun',
            'extensiondate'  => 'Tanggal Pengajuan',
            'description'  => 'Alasan Pengajuan',
            
           
        ];

        $validator =  Validator::make($request->all(), 
        [
            'semester'  => 'required|max:2',
            'year'  => 'required|max:4',
            'extensiondate'  => 'required',
            'description'  => 'required',  
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
           

            if($errors->has('semester')){
                $err['messages']['semester'] = $errors->first('semester');
            }

            if($errors->has('year')){
                $err['messages']['year'] = $errors->first('year');
            }

            if($errors->has('extensiondate')){
                $err['messages']['extensiondate'] = $errors->first('extensiondate');
            }

             if($errors->has('description')){
                $err['messages']['description'] = $errors->first('description');
            }

            return $err;
       }
  }

 

}

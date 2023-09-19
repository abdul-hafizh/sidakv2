<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ValidationPeriode
{
   public static function validationInsert($request){
        $err = array(); 
        
        $fields = [
           
            'semester'  => 'Semester',
            'year'  => 'Tahun',
            'startdate'  => 'Tanggal Mulai',
            'enddate'  => 'Tanggal Berahir',
            
           
        ];

        $validator =  Validator::make($request->all(), 
        [
           
            'semester'  => 'required|max:2',
            'year'  => 'required|max:4',
            'startdate'  => 'required',
            'enddate'  => 'required',  
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

            if($errors->has('startdate')){
                $err['messages']['startdate'] = $errors->first('startdate');
            }

             if($errors->has('enddate')){
                $err['messages']['enddate'] = $errors->first('enddate');
            }

            return $err;
       }
  }


  public static function validationUpdate($request,$id){
        $err = array(); 
        
        $fields = [
           
            'semester'  => 'Semester',
            'year'  => 'Tahun',
            'startdate'  => 'Tanggal Mulai',
            'enddate'  => 'Tanggal Berahir',
            
           
        ];

        $validator =  Validator::make($request->all(), 
        [
            'semester'  => 'required|max:2',
            'year' => [
                'required',
                Rule::unique('periode')->ignore($id),
            ], 
            'startdate'  => 'required',
            'enddate'  => 'required',  
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

            if($errors->has('startdate')){
                $err['messages']['startdate'] = $errors->first('startdate');
            }

             if($errors->has('enddate')){
                $err['messages']['enddate'] = $errors->first('enddate');
            }

            return $err;
       }
  }

}

<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;

class ValidationPeriode
{
   public static function validation($request){
        $err = array(); 
        
        $fields = [
            'name'  => 'Nama',
            'semester'  => 'Semester',
            'year'  => 'Tahun',
            'startdate'  => 'Tanggal Mulai',
            'enddate'  => 'Tanggal Berahir',
           
        ];

        $validator =  Validator::make($request->all(), 
        [
            'name'  => 'required|max:255',
            'semester'  => 'required|max:10',
            'year'  => 'required|max:10',
            'startdate'  => 'required',
            'enddate'  => 'required',  
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

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

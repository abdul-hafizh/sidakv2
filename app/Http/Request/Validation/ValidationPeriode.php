<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;

class ValidationPeriode
{
   public static function validation($request){
        $err = array(); 
        
        $fields = [
            'name'  => 'Name',
            'slug'  => 'Slug',
            'semester'  => 'Semester',
            'year'  => 'Tahun',
           
        ];

        $validator =  Validator::make($request->all(), 
        [
            'name'  => 'required|max:255',
            'slug'  => 'required|max:255',
            'semester'  => 'required|max:10',
            'year'  => 'required|max:10',
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

            if($errors->has('semester')){
                $err['messages']['semester'] = $errors->first('semester');
            }

            if($errors->has('year')){
                $err['messages']['year'] = $errors->first('year');
            }

            return $err;
       }
  }

}

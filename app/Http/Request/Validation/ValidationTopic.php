<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;

class ValidationTopic
{
    public static function validation($request){
        $err = array(); 
        
        $fields = [
            'name'  => 'Nama Topik',
            'comment'=>'Komentar',
           
        ];

        $validator =  Validator::make($request->all(), 
        [
            'name'  => 'required',
            'comment'  => 'required',
           
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

            if($errors->has('comment')){
                $err['messages']['comment'] = $errors->first('comment');
            }


            

            return $err;
       }
    }


    public static function validationComment($request){
        $err = array(); 
        
        $fields = [
            'comment'=>'Komentar'
        ];

        $validator =  Validator::make($request->all(), 
        [ 
            'comment'  => 'required'
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            if($errors->has('comment')){
                $err['messages']['comment'] = $errors->first('comment');
            }
            return $err;
       }
    }


    


   
}

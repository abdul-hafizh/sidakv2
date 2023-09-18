<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;

class ValidationKendala
{
    public static function validation($request){
        $err = array(); 
        
        $fields = [
            'permasalahan'  => 'Permasalahan',
            'messages'=>'Pesan',
           
        ];

        $validator =  Validator::make($request->all(), 
        [
            'permasalahan'  => 'required',
            'messages'  => 'required',
           
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
            if($errors->has('permasalahan')){
                $err['messages']['permasalahan'] = $errors->first('permasalahan');
            }

            if($errors->has('messages')){
                $err['messages']['messages'] = $errors->first('messages');
            }


            

            return $err;
       }
    }


    public static function validationComment($request){
        $err = array(); 
        
        $fields = [
            'messages'=>'Pesan'
        ];

        $validator =  Validator::make($request->all(), 
        [ 
            'messages'  => 'required'
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            if($errors->has('messages')){
                $err['messages']['messages'] = $errors->first('messages');
            }
            return $err;
       }
    }


    


   
}

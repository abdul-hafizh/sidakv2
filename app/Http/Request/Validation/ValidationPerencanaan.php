<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;

class ValidationPerencanaan
{
    public static function validation($request){
        $err = array(); 
        
        $fields = [
            'lokasi'  => 'Lokasi',
            'nama_pejabat'  => 'Nama Pejabat'
        ];

        $validator =  Validator::make($request->all(), 
        [
            'lokasi'  => 'required',
            'nama_pejabat'  => 'required_if:lokasi,Kabupaten Sambas'
        ]);

        $validator->setAttributeNames($fields); 

        if ($validator->fails()) {
         
            $errors = $validator->errors();

            return $errors;
       }
    }


   
}

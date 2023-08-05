<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;

class ValidationPerencanaan
{
    public static function validation($request){
        $err = array(); 
        
        $fields = [
            //'lokasi'  => 'Lokasi',
            'pengawas_analisa_target'  => 'pengawas_analisa_target',
            //'nama_pejabat'  => 'Nama Pejabat'
        ];

        $validator =  Validator::make($request->all(), 
        [
            //'lokasi'  => 'required',
            'pengawas_analisa_target'  => 'required',
            //'nama_pejabat'  => 'required_if:lokasi,Kabupaten Sambas'
        ]);

        $validator->setAttributeNames($fields); 

        if ($validator->fails()) {
         
            $errors = $validator->errors();

            return $errors;
       }
    }


   
}

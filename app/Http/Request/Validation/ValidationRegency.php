<?php

namespace App\Http\Request\Validation;

use Illuminate\Support\Facades\Validator;

class ValidationRegency
{
    public static function validation($request)
    {
        $err = array();

        $fields = [
            'name'  => 'Nama',
            'province_id'  => 'Provinsi',
           
        ];

        $validator =  Validator::make(
            $request->all(),
            [
                'name'  => 'required',
                'province_id'  => 'required'
                
            ]
        );

        $validator->setAttributeNames($fields);
        if ($validator->fails()) {

            $errors = $validator->errors();

            if ($errors->has('name')) {
                $err['messages']['name'] = $errors->first('name');
            }

            if ($errors->has('province_id')) {
                $err['messages']['province_id'] = $errors->first('province_id');
            } 


            return $err;
        }
    }
}

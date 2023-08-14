<?php

namespace App\Http\Request\Validation;

use Illuminate\Support\Facades\Validator;

class ValidationProvinces
{
    public static function validation($request)
    {
        $err = array();

        $fields = [
            'name'  => 'Nama',
           
        ];

        $validator =  Validator::make(
            $request->all(),
            [
                'name'  => 'required'
                
            ]
        );

        $validator->setAttributeNames($fields);
        if ($validator->fails()) {

            $errors = $validator->errors();

            if ($errors->has('name')) {
                $err['messages']['name'] = $errors->first('name');
            }

            


            return $err;
        }
    }
}

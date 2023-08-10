<?php

namespace App\Http\Request\Validation;

use Illuminate\Support\Facades\Validator;

class ValidationMobil
{
    public static function validation($request)
    {
        $err = array();

        $fields = [
            'merk'  => 'Merk',
            'type' => 'Type',
        ];

        $validator =  Validator::make(
            $request->all(),
            [
                'merk'  => 'required|max:255',
                'type'  => 'required',
            ]
        );

        $validator->setAttributeNames($fields);
        if ($validator->fails()) {

            $errors = $validator->errors();

            if ($errors->has('merk')) {
                $err['messages']['merk'] = $errors->first('merk');
            }

            if ($errors->has('type')) {
                $err['messages']['type'] = $errors->first('type');
            }



            return $err;
        }
    }
}

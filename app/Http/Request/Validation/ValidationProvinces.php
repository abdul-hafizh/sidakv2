<?php

namespace App\Http\Request\Validation;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ValidationProvinces
{
    public static function validationInsert($request)
    {
        $err = array();

        $fields = [
            'id'=>'Kode Provinsi',
            'name'  => 'Nama Provinsi',
           
        ];

        $validator =  Validator::make(
            $request->all(),
            [
                'id'  => 'required|unique:provinces,id|max:2',
                'name'  => 'required'
                
            ]
        );

        $validator->setAttributeNames($fields);
        if ($validator->fails()) {

            $errors = $validator->errors();

            if ($errors->has('id')) {
                $err['messages']['id'] = $errors->first('id');
            }

            if ($errors->has('name')) {
                $err['messages']['name'] = $errors->first('name');
            }

            return $err;
        }
    }

    public static function validationUpdate($request,$id)
    {
        $err = array();

        $fields = [
            'id'=>'Kode Provinsi',
            'name'  => 'Nama Provinsi',
           
        ];

        $validator =  Validator::make(
            $request->all(),
            [
                'id' => [
                'required',
                'max:2',
                    Rule::unique('provinces')->ignore($id),
                  
                ],

                'name'  => 'required'
                
            ]
        );

        $validator->setAttributeNames($fields);
        if ($validator->fails()) {

            $errors = $validator->errors();

            if ($errors->has('id')) {
                $err['messages']['id'] = $errors->first('id');
            }

            if ($errors->has('name')) {
                $err['messages']['name'] = $errors->first('name');
            }

            


            return $err;
        }
    }
}

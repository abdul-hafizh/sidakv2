<?php

namespace App\Http\Request\Validation;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ValidationRegency
{
    public static function validationInsert($request)
    {
        $err = array();

        $fields = [
            'id'  => 'Kode Kabupaten',
            'name'  => 'Nama Kabupaten',
            'province_id'  => 'Nama Provinsi',
           
        ];

        $validator =  Validator::make(
            $request->all(),
            [
                'id'  => 'required|unique:regencies,id|max:4',
                'name'  => 'required',
                'province_id'  => 'required'
                
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

            if ($errors->has('province_id')) {
                $err['messages']['province_id'] = $errors->first('province_id');
            } 


            return $err;
        }
    }

    public static function validationUpdate($request,$id)
    {
        $err = array();

        $fields = [
            'id'  => 'Kode Kabupaten',
            'name'  => 'Nama Kabupaten',
            'province_id'  => 'Nama Provinsi',
           
        ];

        $validator =  Validator::make(
            $request->all(),
            [
                'id' => [
                'required',
                'max:4',
                    Rule::unique('regencies')->ignore($id),
                ],
                'name'  => 'required',
                'province_id'  => 'required'
                
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

            if ($errors->has('province_id')) {
                $err['messages']['province_id'] = $errors->first('province_id');
            } 


            return $err;
        }
    }
}

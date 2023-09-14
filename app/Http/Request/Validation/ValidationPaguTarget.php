<?php

namespace App\Http\Request\Validation;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ValidationPaguTarget
{
    public static function validation($request)
    {
        $err = array();

        $fields = [
            'periode_id'  => 'Periode',
            'daerah_id'  => 'Daerah',
            'pagu_apbn'  => 'Pagu APBN',
            'pagu_promosi'  => 'Pagu Promosi',
            'type_daerah'  => 'Tipe Daerah',
            'target_pengawasan' => 'Target Pengawasan',
            'target_penyelesaian_permasalahan'  => 'Target Penyelesaian Permasalahan',
            'target_bimbingan_teknis'  => 'Target Bimbingan Teknis',
        ];

        $validator =  Validator::make(
            $request->all(),
            [
                'periode_id'  => [
                    'required',
                    Rule::unique('pagu_target', 'periode_id')->where('daerah_id', $request->daerah_id),
                ],
                'daerah_id'  => 'required',
                'pagu_apbn'  => 'required|integer',
                'pagu_promosi'  => 'required|integer',
                'type_daerah'  => 'required',
                'target_pengawasan'  => 'required|integer',
                'target_penyelesaian_permasalahan'  => 'required|integer',
                'target_bimbingan_teknis'  => 'required|integer',
            ]
        );

        $validator->setAttributeNames($fields);
        if ($validator->fails()) {

            $errors = $validator->errors();

            foreach ($fields as $x => $val) {
                if ($errors->has($x)) {
                    $err['messages'][$x] = $errors->first($x);
                }
            }
            return $err;
        }
    }

    public static function validationUpdate($request, $id)
    {
        $err = array();

        $fields = [
            'periode_id'  => 'Periode',
            'daerah_id'  => 'Daerah',
            'pagu_apbn'  => 'Pagu APBN',
            'pagu_promosi'  => 'Pagu Promosi',
            'type_daerah'  => 'Tipe Daerah',
            'target_pengawasan' => 'Target Pengawasan',
            'target_penyelesaian_permasalahan'  => 'Target Penyelesaian Permasalahan',
            'target_bimbingan_teknis'  => 'Target Bimbingan Teknis',

        ];

        $validator =  Validator::make(
            $request->all(),
            [
                'periode_id' => [
                    'required',
                    Rule::unique('pagu_target', 'periode_id')->where('daerah_id', $request->daerah_id)->ignore($id),
                ],

                'daerah_id'  => 'required',
                'pagu_apbn'  => 'required|integer',
                'pagu_promosi'  => 'required|integer',
                'type_daerah'  => 'required',
                'target_pengawasan'  => 'required|integer',
                'target_penyelesaian_permasalahan'  => 'required|integer',
                'target_bimbingan_teknis'  => 'required|integer',
            ]
        );

        $validator->setAttributeNames($fields);
        if ($validator->fails()) {

            $errors = $validator->errors();

            foreach ($fields as $x => $val) {
                if ($errors->has($x)) {
                    $err['messages'][$x] = $errors->first($x);
                }
            }
            return $err;
        }
    }
}

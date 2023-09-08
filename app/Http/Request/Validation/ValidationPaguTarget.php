<?php

namespace App\Http\Request\Validation;

use Illuminate\Support\Facades\Validator;

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
            'target_video_promosi'  => 'Target Video Promosi',
        ];

        $validator =  Validator::make(
            $request->all(),
            [
                'periode_id'  => 'required',
                'daerah_id'  => 'required',
                'pagu_apbn'  => 'required',
                'pagu_promosi'  => 'required',
                'type_daerah'  => 'required',
                'target_pengawasan'  => 'required',
                'target_penyelesaian_permasalahan'  => 'required',
                'target_bimbingan_teknis'  => 'required',
                'target_video_promosi'  => 'required',
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

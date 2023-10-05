<?php

namespace App\Http\Request\Validation;

use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ValidationPenyelesaian
{
    public static function validation($request)
    {
        $err = array();

        $fields = [
            'periode_id_mdl'  => 'Periode',
            'daerah_id'  => 'Daerah',
            'sub_menu_slug' => 'Jenis',
            'nama_kegiatan' => 'Nama Kegiatan',
            'tgl_kegiatan' => 'Tanggal',
            'lokasi' => 'Lokasi',
            'biaya' => 'Biaya',
            'jml_perusahaan' => 'Jumlah Peserta',
            'ringkasan_kegiatan' => 'Ringkasan Kegiatan',
        ];

        $validator =  Validator::make(
            $request->all(),
            [                
                'periode_id_mdl'  => 'required',
                'sub_menu_slug'  => 'required',
                'nama_kegiatan'  => 'required',
                'tgl_kegiatan'  => 'required',
                'lokasi'  => 'required',
                'jml_perusahaan'  => 'required_if:sub_menu_slug,is_bimtek_ipbbr|nullable|integer',
                'biaya'  => 'required|integer',
                'ringkasan_kegiatan'  => 'required'
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
            'periode_id_mdl'  => 'Periode',
            'sub_menu_slug' => 'Jenis',
            'nama_kegiatan' => 'Nama Kegiatan',
            'tgl_kegiatan' => 'Tanggal',
            'lokasi' => 'Lokasi',
            'biaya' => 'Biaya',
            'jml_perusahaan' => 'Jumlah Peserta',
            'ringkasan_kegiatan' => 'Ringkasan Kegiatan',

        ];

        $validator =  Validator::make(
            $request->all(),
            [                
                'periode_id_mdl'  => 'required',
                'sub_menu_slug'  => 'required',
                'nama_kegiatan'  => 'required',
                'tgl_kegiatan'  => 'required',
                'lokasi'  => 'required',
                'jml_perusahaan'  => 'required_if:sub_menu_slug,is_bimtek_ipbbr|nullable|integer',
                'biaya'  => 'required|integer',
                'ringkasan_kegiatan'  => 'required'
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
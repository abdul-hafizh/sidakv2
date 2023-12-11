<?php

namespace App\Http\Request\Validation;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;

class ValidationPengawasan
{
    public static function validation($request)
    {
        $err = array();

        $fields = [
            'periode_id_mdl'  => 'Periode',
            'sub_menu_slug' => 'Jenis',
            'nama_kegiatan' => 'Nama Kegiatan',
            'hasil_analisa' => 'Hasil analisa',
            'tanggal_kegiatan' => 'Tanggal Kegiatan',
            'biaya' => 'Biaya',
            'lokasi' => 'Lokasi',

        ];

        $validator =  Validator::make(
            $request->all(),
            [
                'periode_id_mdl'  => 'required',
                'sub_menu_slug'  => 'required',
                'nama_kegiatan'  => 'required',
                'hasil_analisa'  => 'required',
                'tanggal_kegiatan'  => 'required',
                //    'jml_peserta'  => 'required_if:sub_menu_slug,is_bimtek_ipbbr|nullable|integer',
                'biaya'  => 'required|integer',
                'lokasi'  => 'required_if:sub_menu_slug,analisa|required_if:sub_menu_slug,evaluasi'
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

    public static function validationPerusahaan($request)
    {
        $err = array();

        $request->validate([
            "nib"    => "required|array|min:1",
            "nib.*"  => "required|string|distinct|min:3",
        ]);


        // $fields = [
        //     'nib.*'  => 'NIB',

        // ];

        // $validator =  Validator::make(
        //     $request->validate([
        //         "nib"    => "required|array|min:1",
        //         "nib.*"  => "required|string|distinct|min:3",
        //     ])
        // );
        // $validator->setAttributeNames($fields);
        // if ($validator->fails()) {

        //     $errors = $validator->errors();

        //     // foreach ($fields as $x => $val) {
        //     //     if ($errors->has($x)) {
        //     //         $err['messages'][$x] = $errors->first($x);
        //     //     }
        //     // }
        //     return $errors;
        // }
    }

    public static function validationFile($request)
    {
        $err = array();

        $fields = [
            'lap_hadir'  => 'Laporan hadir',
            'lap_pendamping'  => 'Laporan tenaga pendamping',
            'lap_notula' => 'Notula Kegiatan',
            'lap_survey' => 'Hasil Survey',
            'lap_narasumber' => 'Daftar Narasumber',
            'lap_materi' => 'Materi',
            'lap_document' => 'Laporan Dokumentasi',
        ];

        if ($request->sub_menu_slug == 'is_tenaga_pendamping') {
            $validator =  Validator::make(
                $request->all(),
                [
                    'lap_hadir'  =>  ['required', 'file', 'mimes:pdf',  'max:2056'],
                    'lap_pendamping'  => ['required', 'file', 'mimes:pdf',  'max:2056']
                ]
            );
        } else if ($request->sub_menu_slug == 'is_bimtek_ipbbr' || $request->sub_menu_slug == 'is_bimtek_ippbbr') {
            $validator =  Validator::make(
                $request->all(),
                [

                    'lap_hadir'  =>  ['required', 'file', 'mimes:pdf',  'max:2056'],
                    'lap_notula'  => ['required', 'file', 'mimes:pdf',  'max:2056'],
                    'lap_survey'  => ['required', 'file', 'mimes:pdf',  'max:2056'],
                    'lap_narasumber'  => ['required', 'file', 'mimes:pdf',  'max:2056'],
                    'lap_materi'  => ['required', 'file', 'mimes:pdf',  'max:2056'],
                    'lap_document'  => ['required', 'file', 'mimes:pdf',  'max:2056']
                ]
            );
        }

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

    public static function validationUpdateFile($request, $id)
    {
        $err = array();

        $fields = [
            'lap_kegiatan'  => 'Laporan kegiatan',
            'nib.*'  => 'NIB',

        ];

        if ($request->sub_menu_slug == 'inspeksi') {
            $validator =  Validator::make(
                $request->all(),
                [
                    "nib.*"  => "required",
                ]
            );
        } else if ($request->sub_menu_slug == 'analisa' || $request->sub_menu_slug == 'evaluasi') {
            $validator =  Validator::make(
                $request->all(),
                [

                    'lap_kegiatan'  =>  ['required_without:lap_kegiatan_file', 'file', 'mimes:pdf',  'max:2056']
                ]
            );
        }

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
            'hasil_analisa' => 'Hasil analisa',
            'tanggal_kegiatan' => 'Tanggal Kegiatan',
            'biaya' => 'Biaya',
            'lokasi' => 'Lokasi',
            // 'nib.*' => 'NIB',


        ];

        $validator =  Validator::make(
            $request->all(),
            [
                'periode_id_mdl'  => 'required',
                'sub_menu_slug'  => 'required',
                'nama_kegiatan'  => 'required',
                'hasil_analisa'  => 'required',
                'tanggal_kegiatan'  => 'required',
                //    'jml_peserta'  => 'required_if:sub_menu_slug,is_bimtek_ipbbr|nullable|integer',
                'biaya'  => 'required|integer',
                'lokasi'  => 'required_if:sub_menu_slug,analisa|required_if:sub_menu_slug,evaluasi',
                //  "nib"    => "required|array|min:1",
                // "nib.*"  => "required",
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

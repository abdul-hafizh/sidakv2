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
            'periode_id_mdl' => 'Periode',
            'sub_menu_slug' => 'Jenis Kegiatan',
            'nama_kegiatan' => 'Nama Kegiatan',
            'tgl_kegiatan' => 'Tanggal Kegiatan',
            'lokasi' => 'Lokasi Kegiatan',
            'biaya' => 'Biaya Kegiatan',
            'jml_perusahaan' => 'Jumlah Peserta'
        ];

        $validator =  Validator::make(
            $request->all(),
            [                
                'periode_id_mdl' => 'required',
                'sub_menu_slug' => 'required',
                'nama_kegiatan' => 'required',
                'tgl_kegiatan' => 'required',
                'lokasi' => 'required',
                'jml_perusahaan' => 'required|integer',
                'biaya' => 'required|integer'
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
            'periode_id_mdl' => 'Periode',
            'sub_menu_slug' => 'Jenis',
            'nama_kegiatan' => 'Nama Kegiatan',
            'tgl_kegiatan' => 'Tanggal',
            'lokasi' => 'Lokasi',
            'biaya' => 'Biaya',
            'jml_perusahaan' => 'Jumlah Peserta'
        ];

        $validator =  Validator::make(
            $request->all(),
            [                
                'periode_id_mdl' => 'required',
                'sub_menu_slug' => 'required',
                'nama_kegiatan' => 'required',
                'tgl_kegiatan' => 'required',
                'lokasi' => 'required',
                'jml_perusahaan' => 'required|integer',
                'biaya' => 'required|integer'
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

    public static function validationFile($request)
    {
        $err = array();

        $fields = [
            'lap_peserta'  => 'Laporan Daftar Hadir',
            'lap_profile'  => 'Laporan Profile',
            'lap_profile2'  => 'Laporan Profile',
            'lap_notula' => 'Notula Kegiatan',
            'lap_notula2' => 'Notula Kegiatan',
            'lap_narasumber' => 'Daftar Narasumber',
            'lap_lkpm' => 'Laporan LKPM',
            'lap_document' => 'Laporan Dokumentasi',
            'lap_evaluasi' => 'Laporan Evaluasi',
        ];

        if ($request->sub_menu_slug == 'identifikasi') {
            $validator =  Validator::make(
                $request->all(),
                [
                    'lap_profile'  =>  ['required', 'file', 'mimes:pdf', 'max:2056']
                ]
            );
        } else if ($request->sub_menu_slug == 'penyelesaian') {
            $validator =  Validator::make(
                $request->all(),
                [
                    'lap_peserta'  =>  ['required', 'file', 'mimes:pdf', 'max:2056'],
                    'lap_notula2'  => ['required', 'file', 'mimes:pdf', 'max:2056'],
                    'lap_profile2'  => ['required', 'file', 'mimes:pdf', 'max:2056'],
                    'lap_narasumber'  => ['required', 'file', 'mimes:pdf', 'max:2056'],
                    'lap_lkpm'  => ['required', 'file', 'mimes:pdf', 'max:2056'],
                    'lap_document'  => ['required', 'file', 'mimes:pdf', 'max:2056']
                ]
            );
        } else if ($request->sub_menu_slug == 'evaluasi') {
            $validator =  Validator::make(
                $request->all(),
                [
                    'lap_notula'  =>  ['required', 'file', 'mimes:pdf', 'max:2056'],
                    'lap_evaluasi'  => ['required', 'file', 'mimes:pdf', 'max:2056']
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
            'lap_profile'  => 'Laporan Profile',
            'lap_peserta'  => 'Laporan Daftar Hadir',
            'lap_profile2'  => 'Laporan Daftar Hadir',
            'lap_notula' => 'Notula Kegiatan',
            'lap_notula2' => 'Notula Kegiatan',
            'lap_narasumber' => 'Daftar Narasumber',
            'lap_lkpm' => 'Laporan LKPM',
            'lap_document' => 'Laporan Dokumentasi',
            'lap_evaluasi' => 'Laporan Evaluasi',
        ];

        if ($request->sub_menu_slug == 'identifikasi') {
            $validator =  Validator::make(
                $request->all(),
                [
                    'lap_profile'  =>  ['required_without:lap_profile_file', 'file', 'mimes:pdf', 'max:2056']
                ]
            );
        } else if ($request->sub_menu_slug == 'penyelesaian') {
            $validator =  Validator::make(
                $request->all(),
                [
                    'lap_peserta'  =>  ['required_without:lap_peserta_file', 'file', 'mimes:pdf', 'max:2056'],
                    'lap_notula2'  => ['required_without:lap_notula2_file', 'file', 'mimes:pdf', 'max:2056'],
                    'lap_profile2'  => ['required_without:lap_profile2_file', 'file', 'mimes:pdf', 'max:2056'],
                    'lap_narasumber'  => ['required_without:lap_narasumber_file', 'file', 'mimes:pdf', 'max:2056'],
                    'lap_lkpm'  => ['required_without:lap_lkpm_file', 'file', 'mimes:pdf', 'max:2056'],
                    'lap_document'  => ['required_without:lap_document_file', 'file', 'mimes:pdf', 'max:2056']
                ]
            );
        } else if ($request->sub_menu_slug == 'evaluasi') {
            $validator =  Validator::make(
                $request->all(),
                [
                    'lap_notula'  => ['required_without:lap_notula_file', 'file', 'mimes:pdf', 'max:2056'],
                    'lap_evaluasi'  => ['required_without:lap_evaluasi_file', 'file', 'mimes:pdf', 'max:2056']
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
}

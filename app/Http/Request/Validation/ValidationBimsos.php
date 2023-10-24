<?php

namespace App\Http\Request\Validation;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;

class ValidationBimsos
{
    public static function validation($request)
    {
        $err = array();

        $fields = [
            'periode_id_mdl'  => 'Periode',
            'daerah_id'  => 'Daerah',
            'sub_menu_slug' => 'Jenis',
            'nama_kegiatan' => 'Nama Kegiatan',
            'tgl_bimtek' => 'Tanggal',
            'lokasi_bimtek' => 'Lokasi',
            'biaya_kegiatan' => 'Biaya',
            'jml_peserta' => 'Jumlah Peserta',
            'ringkasan_kegiatan' => 'Ringkasan Kegiatan',
        ];

        $validator =  Validator::make(
            $request->all(),
            [
                // 'periode_id_mdl' => [
                //     'required',
                //     Rule::unique('bimsos', 'periode_id')->where('daerah_id', Auth::User()->daerah_id)->where('sub_menu_slug', $request->sub_menu_slug),
                // ],
                'periode_id_mdl'  => 'required',
                'sub_menu_slug'  => 'required',
                'nama_kegiatan'  => 'required',
                'tgl_bimtek'  => 'required',
                'lokasi_bimtek'  => 'required',
                'jml_peserta'  => 'required_if:sub_menu_slug,is_bimtek_ipbbr|nullable|integer',
                'biaya_kegiatan'  => 'required|integer',
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
                    'lap_hadir'  =>  ['required_without:lap_hadir_file', 'file', 'mimes:pdf',  'max:2056'],
                    'lap_pendamping'  => ['required_without:lap_pendamping_file', 'file', 'mimes:pdf',  'max:2056']
                ]
            );
        } else if ($request->sub_menu_slug == 'is_bimtek_ipbbr' || $request->sub_menu_slug == 'is_bimtek_ippbbr') {
            $validator =  Validator::make(
                $request->all(),
                [

                    'lap_hadir'  =>  ['required_without:lap_hadir_file', 'file', 'mimes:pdf',  'max:2056'],
                    'lap_notula'  => ['required_without:lap_notula_file', 'file', 'mimes:pdf',  'max:2056'],
                    'lap_survey'  => ['required_without:lap_survey_file', 'file', 'mimes:pdf',  'max:2056'],
                    'lap_narasumber'  => ['required_without:lap_narasumber_file', 'file', 'mimes:pdf',  'max:2056'],
                    'lap_materi'  => ['required_without:lap_materi_file', 'file', 'mimes:pdf',  'max:2056'],
                    'lap_document'  => ['required_without:lap_document_file', 'file', 'mimes:pdf',  'max:2056']
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
            'tgl_bimtek' => 'Tanggal',
            'lokasi_bimtek' => 'Lokasi',
            'biaya_kegiatan' => 'Biaya',
            'jml_peserta' => 'Jumlah Peserta',
            'ringkasan_kegiatan' => 'Ringkasan Kegiatan',

        ];

        $validator =  Validator::make(
            $request->all(),
            [
                // 'periode_id_mdl' => [
                //     'required',
                //     Rule::unique('bimsos', 'periode_id')->where('daerah_id', Auth::User()->daerah_id)->where('sub_menu_slug', $request->sub_menu_slug)->ignore($id),
                // ],

                'periode_id_mdl'  => 'required',
                'sub_menu_slug'  => 'required',
                'nama_kegiatan'  => 'required',
                'tgl_bimtek'  => 'required',
                'lokasi_bimtek'  => 'required',
                'jml_peserta'  => 'required_if:sub_menu_slug,is_bimtek_ipbbr|nullable|integer',
                'biaya_kegiatan'  => 'required|integer',
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

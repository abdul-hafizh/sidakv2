<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;

class ValidationPerencanaan
{
    public static function validation($request){
        $err = array(); 
        
        $fields = [
             'pengawas_analisa_target'  => 'Pengawas Analisa Target',
             'pengawas_analisa_pagu'  => 'Pengawas Analisa Pagu',
             'pengawas_inspeksi_target'  => 'Pengawas Inspeksi Target',
             'pengawas_inspeksi_pagu'  => 'Pengawas Inspeksi Pagu',
             'pengawas_evaluasi_target'  => 'Pengawas Evaluasi Target',
             'pengawas_evaluasi_pagu'  => 'Pengawas Evaluasi Pagu',


             'bimtek_perizinan_target'  => 'Bimtek Perizinan Target',
             'bimtek_perizinan_pagu'  => 'Bimtek Perizinan Pagu',
             'bimtek_pengawasan_target'  => 'Bimtek Pengawasan Target',
             'bimtek_perizinan_pagu'  => 'Bimtek Pengawasan Pagu',

             'penyelesaian_identifikasi_target'  => 'Penyelesain Indentifikasi Target',
             'penyelesaian_identifikasi_pagu'  => 'Penyelesain Indentifikasi Pagu',
             'penyelesaian_realisasi_target'  => 'Penyelesain Realisasi Target',
             'penyelesaian_realisasi_pagu'  => 'Penyelesain Realisasi Pagu',
             'penyelesaian_evaluasi_target'  => 'Penyelesain Evaluasi Target',
             'penyelesaian_evaluasi_pagu'  => 'Penyelesain Evaluasi Pagu',

             'periode_id'  => 'Periode',
             'nama_pejabat'  => 'Nama Pejabat',
             'nip_pejabat'  => 'NIP Pejabat',
             'tgl_tandatangan'  => 'Tgl Ditandatangani',
             'lokasi'  => 'Lokasi',
        ];

        $validator =  Validator::make($request->all(), 
        [
           
             'pengawas_analisa_target'  => 'required',
             'pengawas_analisa_pagu'  => 'required',
             'pengawas_inspeksi_target'  => 'required',
             'pengawas_inspeksi_pagu'  => 'required',
             'pengawas_evaluasi_target'  => 'required',
             'pengawas_evaluasi_pagu'  => 'required',


             'bimtek_perizinan_target'  => 'required',
             'bimtek_perizinan_pagu'  => 'required',
             'bimtek_pengawasan_target'  => 'required',
             'bimtek_pengawasan_pagu'  => 'required',

             'penyelesaian_identifikasi_target'  => 'required',
             'penyelesaian_identifikasi_pagu'  => 'required',
             'penyelesaian_realisasi_target'  => 'required',
             'penyelesaian_realisasi_pagu'  => 'required',
             'penyelesaian_evaluasi_target'  => 'required',
             'penyelesaian_evaluasi_pagu'  => 'required',

             'periode_id'  => 'required',
             'nama_pejabat'  => 'required',
             'nip_pejabat'  => 'required',
             'tgl_tandatangan'  => 'required',
             'lokasi'  => 'required',
        ]);

        $validator->setAttributeNames($fields); 

        if ($validator->fails()) {
         
            $errors = $validator->errors();

            if($errors->has('pengawas_analisa_target')){
                $err['messages']['pengawas_analisa_target'] = $errors->first('pengawas_analisa_target');
            }
            if($errors->has('pengawas_analisa_pagu')){
                $err['messages']['pengawas_analisa_pagu'] = $errors->first('pengawas_analisa_pagu');
            }
            if($errors->has('pengawas_inspeksi_target')){
                $err['messages']['pengawas_inspeksi_target'] = $errors->first('pengawas_inspeksi_target');
            }
            if($errors->has('pengawas_inspeksi_pagu')){
                $err['messages']['pengawas_inspeksi_pagu'] = $errors->first('pengawas_inspeksi_pagu');
            }
            if($errors->has('pengawas_evaluasi_target')){
                $err['messages']['pengawas_evaluasi_target'] = $errors->first('pengawas_evaluasi_target');
            }
            if($errors->has('pengawas_evaluasi_pagu')){
                $err['messages']['pengawas_evaluasi_pagu'] = $errors->first('pengawas_evaluasi_pagu');
            }

            
            if($errors->has('bimtek_perizinan_target')){
                $err['messages']['bimtek_perizinan_target'] = $errors->first('bimtek_perizinan_target');
            }

            if($errors->has('bimtek_perizinan_pagu')){
                $err['messages']['bimtek_perizinan_pagu'] = $errors->first('bimtek_perizinan_pagu');
            }

            if($errors->has('bimtek_pengawasan_target')){
                $err['messages']['bimtek_pengawasan_target'] = $errors->first('bimtek_pengawasan_target');
            }

            if($errors->has('bimtek_pengawasan_pagu')){
                $err['messages']['bimtek_pengawasan_pagu'] = $errors->first('bimtek_pengawasan_pagu');
            }



            if($errors->has('penyelesaian_identifikasi_target')){
                $err['messages']['penyelesaian_identifikasi_target'] = $errors->first('penyelesaian_identifikasi_target');
            }
            if($errors->has('penyelesaian_identifikasi_pagu')){
                $err['messages']['penyelesaian_identifikasi_pagu'] = $errors->first('penyelesaian_identifikasi_pagu');
            }
            if($errors->has('penyelesaian_realisasi_target')){
                $err['messages']['penyelesaian_realisasi_target'] = $errors->first('penyelesaian_realisasi_target');
            }
            if($errors->has('penyelesaian_realisasi_pagu')){
                $err['messages']['penyelesaian_realisasi_pagu'] = $errors->first('penyelesaian_realisasi_pagu');
            }
            if($errors->has('penyelesaian_evaluasi_target')){
                $err['messages']['penyelesaian_evaluasi_target'] = $errors->first('penyelesaian_evaluasi_target');
            }
            if($errors->has('penyelesaian_evaluasi_pagu')){
                $err['messages']['penyelesaian_evaluasi_pagu'] = $errors->first('penyelesaian_evaluasi_pagu');
            }


            if($errors->has('periode_id')){
                $err['messages']['periode_id'] = $errors->first('periode_id');
            }

            if($errors->has('nama_pejabat')){
                $err['messages']['nama_pejabat'] = $errors->first('nama_pejabat');
            }

            if($errors->has('nip_pejabat')){
                $err['messages']['nip_pejabat'] = $errors->first('nip_pejabat');
            }

             if($errors->has('tgl_tandatangan')){
                $err['messages']['tgl_tandatangan'] = $errors->first('tgl_tandatangan');
            }

            if($errors->has('lokasi')){
                $err['messages']['lokasi'] = $errors->first('lokasi');
            }


            return $err;
       }
    }


   
}

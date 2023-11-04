<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ValidationPemetaan
{
   public static function validation($request){
        $err = array(); 
        
        $fields = [

         'periode_id' => 'Periode',
         'tgl_awal_rencana_kerja' => 'Tanggal Awal Rencana Kerja',
         'tgl_ahir_rencana_kerja' => 'Tanggal Ahir Rencana Kerja',
         'budget_rencana_kerja' =>   'Budget Rencana Kerja',
         'keterangan_rencana_kerja' => 'Keterangan Rencana Kerja',

         'tgl_awal_studi_literatur' => 'Tanggal Awal Studi Literatur',
         'tgl_ahir_studi_literatur' => 'Tanggal Ahir Studi Literatur',
         'budget_studi_literatur' => 'Budget Studi Literatur',
         'keterangan_studi_literatur' =>'Keterangan Studi Literatur',

         'tgl_awal_rapat_kordinasi' => 'Tanggal Awal Rapat Kordinasi',
         'tgl_ahir_rapat_kordinasi' => 'Tanggal Ahir Rapat Kordinasi',
         'budget_rapat_kordinasi' => 'Budget Rapat Kordinasi',
         'keterangan_rapat_kordinasi' => 'Keterangan Rapat Kordinasi',

         

         'tgl_awal_data_sekunder' => 'Tanggal Awal Data Sekunder',
         'tgl_ahir_data_sekunder' => 'Tanggal Ahir Data Sekunder',
         'budget_data_sekunder' => 'Budget Data Sekunder',
         'keterangan_data_sekunder' => 'Keterangan Data Sekunder',

         

         'tgl_awal_fgd_persiapan' => 'Tanggal Awal FGD Persiapan',
         'tgl_ahir_fgd_persiapan' => 'Tanggal Ahir FGD Persiapan',
         'budget_fgd_persiapan' => 'Budget FGD Persiapan',
         'keterangan_fgd_persiapan' => 'Keterangan FGD Persiapan',

         'tgl_awal_fgd_identifikasi' => 'Tanggal Awal FGD Identifikasi',
         'tgl_ahir_fgd_identifikasi' => 'Tanggal Ahir FGD Identifikasi',
         'budget_fgd_identifikasi' => 'Budget FGD Identifikasi',
         'keterangan_fgd_identifikasi' => 'Keterangan FGD Identifikasi',

         'tgl_awal_lq' => 'Tanggal Awal LQ',
         'tgl_ahir_lq' => 'Tanggal Ahir LQ',
         'budget_lq' => 'Budget LQ',
         'keterangan_lq' => 'Keterangan LQ',

         'tgl_awal_shift_share' => 'Tanggal Awal Shift Share',
         'tgl_ahir_shift_share' => 'Tanggal Ahir Shift Share',
         'budget_shift_share' => 'Budget Shift Share',
         'keterangan_shift_share' => 'Keterangan Shift Share',


         'tgl_awal_tipologi_sektor' => 'Tanggal Awal Tipologi Sektor',
         'tgl_ahir_tipologi_sektor' =>'Tanggal Ahir Tipologi Sektor',
         'budget_tipologi_sektor' => 'Budget Tipologi Sektor',
         'keterangan_tipologi_sektor' => 'Keterangan Tipologi Sektor',

         'tgl_awal_klassen' => 'Tanggal Awal Klassen',
         'tgl_ahir_klassen' => 'Tanggal Ahir Klassen',
         'budget_klassen' => 'Budget Klassen',
         'keterangan_klassen' => 'Keterangan Klassen',

         'tgl_awal_fgd_klarifikasi' => 'Tanggal Awal FGD Klarifikasi',
         'tgl_ahir_fgd_klarifikasi' => 'Tanggal Ahir FGD Klarifikasi',
         'budget_fgd_klarifikasi' => 'Budget FGD Klarifikasi',
         'keterangan_fgd_klarifikasi' => 'Keterangan FGD Klarifikasi',

         'tgl_awal_finalisasi' => 'Tanggal Awal Finalisasi',
         'tgl_ahir_finalisasi' => 'Tanggal Ahir Finalisasi',
         'budget_finalisasi' => 'Budget Finalisasi',
         'keterangan_finalisasi' => 'Keterangan Finalisasi',


         'tgl_awal_summary_sektor_unggulan' => 'Tanggal Awal Summary Sektor Unggulan',
         'tgl_ahir_summary_sektor_unggulan' => 'Tanggal Ahir Summary Sektor Unggulan',
         'budget_summary_sektor_unggulan' => 'Budget Summary Sektor Unggulan',
         'keterangan_summary_sektor_unggulan' => 'Keterangan Summary Sektor Unggulan',


         'tgl_awal_sektor_unggulan' => 'Tanggal Awal Sektor Unggulan',
         'tgl_ahir_sektor_unggulan' => 'Tanggal Ahir Sektor Unggulan',
         'budget_sektor_unggulan' => 'Budget Sektor Unggulan',
         'keterangan_sektor_unggulan' => 'Keterangan Sektor Unggulan',

         'tgl_awal_potensi_pasar' => 'Tanggal Awal Potensi Pasar',
         'tgl_ahir_potensi_pasar' => 'Tanggal Ahir Potensi Pasar',
         'budget_potensi_pasar' => 'Budget Potensi Pasar',
         'keterangan_potensi_pasar' => 'Keterangan Potensi Pasar',

         'tgl_awal_parameter_sektor_unggulan' => 'Tanggal Awal Parameter Sektor Unggulan',
         'tgl_ahir_parameter_sektor_unggulan' => 'Tanggal Ahir Parameter Sektor Unggulan',
         'budget_parameter_sektor_unggulan' => 'Budget Parameter Sektor Unggulan',
         'keterangan_parameter_sektor_unggulan' => 'Keterangan Parameter Sektor Unggulan',


         'tgl_awal_subsektor_unggulan' => 'Tanggal Awal Subsektor Unggulan',
         'tgl_ahir_subsektor_unggulan' => 'Tanggal Ahir Subsektor Unggulan',
         'budget_subsektor_unggulan' => 'Budget Subsektor Unggulan',
         'keterangan_subsektor_unggulan' => 'Keterangan Subsektor Unggulan',


         'tgl_awal_intensif_daerah' => 'Tanggal Awal Intensif Daerah',
         'tgl_ahir_intensif_daerah' => 'Tanggal Ahir Intensif Daerah',
         'budget_intensif_daerah' => 'Budget Intensif Daerah',
         'keterangan_intensif_daerah' => 'Keterangan Intensif Daerah',


         'tgl_awal_potensi_lanjutan' => 'Tanggal Awal Potensi Lanjutan',
         'tgl_ahir_potensi_lanjutan' => 'Tanggal Ahir Potensi Lanjutan',
         'budget_potensi_lanjutan' => 'Budget Potensi Lanjutan',
         'keterangan_potensi_lanjutan' => 'Keterangan Potensi Lanjutan',

         'tgl_awal_info_grafis' => 'Tanggal Awal Info Grafis',
         'tgl_ahir_info_grafis' => 'Tanggal Ahir Info Grafis',
         'budget_info_grafis' => 'Budget Info Grafis',
         'keterangan_info_grafis' => 'Keterangan Info Grafis',


         'tgl_awal_dokumentasi' => 'Tanggal Awal Dokumentasi',
         'tgl_ahir_dokumentasi' => 'Tanggal Ahir Dokumentasi',
         'budget_dokumentasi' => 'Budget Dokumentasi',
         'keterangan_dokumentasi' => 'Keterangan Dokumentasi',
            
           
        ];

        $validator =  Validator::make($request->all(), 
        [
           
         'periode_id' => 'required',
         'tgl_awal_rencana_kerja' => 'required',
         'tgl_ahir_rencana_kerja' => 'required',
         'budget_rencana_kerja' =>   'required',
         'keterangan_rencana_kerja' => 'required',

         'tgl_awal_studi_literatur' => 'required',
         'tgl_ahir_studi_literatur' => 'required',
         'budget_studi_literatur' => 'required',
         'keterangan_studi_literatur' =>'required',

         'tgl_awal_rapat_kordinasi' => 'required',
         'tgl_ahir_rapat_kordinasi' => 'required',
         'budget_rapat_kordinasi' => 'required',
         'keterangan_rapat_kordinasi' => 'required',

         'tgl_awal_data_sekunder' => 'required',
         'tgl_ahir_data_sekunder' => 'required',
         'budget_data_sekunder' => 'required',
         'keterangan_data_sekunder' => 'required',

         'tgl_awal_fgd_persiapan' => 'required',
         'tgl_ahir_fgd_persiapan' => 'required',
         'budget_fgd_persiapan' => 'required',
         'keterangan_fgd_persiapan' => 'required',

         'tgl_awal_fgd_identifikasi' =>'required',
         'tgl_ahir_fgd_identifikasi' => 'required',
         'budget_fgd_identifikasi' => 'required',
         'keterangan_fgd_identifikasi' => 'required',

         'tgl_awal_lq' => 'required',
         'tgl_ahir_lq' => 'required',
         'budget_lq' => 'required',
         'keterangan_lq' => 'required',

         'tgl_awal_shift_share' => 'required',
         'tgl_ahir_shift_share' => 'required',
         'budget_shift_share' => 'required',
         'keterangan_shift_share' => 'required',

         'tgl_awal_tipologi_sektor' => 'required',
         'tgl_ahir_tipologi_sektor' => 'required',
         'budget_tipologi_sektor' => 'required',
         'keterangan_tipologi_sektor' => 'required',

         'tgl_awal_klassen' => 'required',
         'tgl_ahir_klassen' => 'required',
         'budget_klassen' => 'required',
         'keterangan_klassen' => 'required',

         'tgl_awal_fgd_klarifikasi' => 'required',
         'tgl_ahir_fgd_klarifikasi' =>'required',
         'budget_fgd_klarifikasi' => 'required',
         'keterangan_fgd_klarifikasi' => 'required',

         'tgl_awal_finalisasi' => 'required',
         'tgl_ahir_finalisasi' => 'required',
         'budget_finalisasi' => 'required',
         'keterangan_finalisasi' => 'required',


         'tgl_awal_summary_sektor_unggulan' => 'required',
         'tgl_ahir_summary_sektor_unggulan' => 'required',
         'budget_summary_sektor_unggulan' => 'required',
         'keterangan_summary_sektor_unggulan' => 'required',

         'tgl_awal_sektor_unggulan' => 'required',
         'tgl_ahir_sektor_unggulan' => 'required',
         'budget_budget_sektor_unggulan' => 'required',
         'keterangan_sektor_unggulan' => 'required',

         'tgl_awal_parameter_sektor_unggulan' => 'required',
         'tgl_ahir_parameter_sektor_unggulan' => 'required',
         'budget_parameter_sektor_unggulan' => 'required',
         'keterangan_parameter_sektor_unggulan' => 'required',

         'tgl_awal_subsektor_unggulan' => 'required',
         'tgl_ahir_subsektor_unggulan' => 'required',
         'budget_subsektor_unggulan' => 'required',
         'keterangan_subsektor_unggulan' => 'required',

         'tgl_awal_intensif_daerah' => 'required',
         'tgl_ahir_intensif_daerah' => 'required',
         'budget_intensif_daerah' => 'required',
         'keterangan_intensif_daerah' => 'required',

         'tgl_awal_potensi_lanjutan' => 'required',
         'tgl_ahir_potensi_lanjutan' => 'required',
         'budget_potensi_lanjutan' => 'required',
         'keterangan_potensi_lanjutan' => 'required',

         'tgl_awal_info_grafis' => 'required',
         'tgl_ahir_info_grafis' => 'required',
         'budget_info_grafis' => 'required',
         'keterangan_info_grafis' => 'required',


         'tgl_awal_dokumentasi' => 'required',
         'tgl_ahir_dokumentasi' => 'required',
         'budget_dokumentasi' => 'required',
         'keterangan_dokumentasi' => 'required',

         
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
           

            if($errors->has('periode_id')){
                $err['messages']['periode_id'] = $errors->first('periode_id');
            }

            if($errors->has('tgl_awal_rencana_kerja')){
                $err['messages']['tgl_awal_rencana_kerja'] = $errors->first('tgl_awal_rencana_kerja');
            }

            if($errors->has('tgl_ahir_rencana_kerja')){
                $err['messages']['tgl_ahir_rencana_kerja'] = $errors->first('tgl_ahir_rencana_kerja');
            }

             if($errors->has('budget_rencana_kerja')){
                $err['messages']['budget_rencana_kerja'] = $errors->first('budget_rencana_kerja');
            }

            if($errors->has('keterangan_rencana_kerja')){
                $err['messages']['keterangan_rencana_kerja'] = $errors->first('keterangan_rencana_kerja');
            }


            if($errors->has('tgl_awal_studi_literatur')){
                $err['messages']['tgl_awal_studi_literatur'] = $errors->first('tgl_awal_studi_literatur');
            }

            if($errors->has('tgl_ahir_studi_literatur')){
                $err['messages']['tgl_ahir_studi_literatur'] = $errors->first('tgl_ahir_studi_literatur');
            }

             if($errors->has('budget_studi_literatur')){
                $err['messages']['budget_studi_literatur'] = $errors->first('budget_studi_literatur');
            }

            if($errors->has('keterangan_studi_literatur')){
                $err['messages']['keterangan_studi_literatur'] = $errors->first('keterangan_studi_literatur');
            }


            if($errors->has('tgl_awal_rapat_kordinasi')){
                $err['messages']['tgl_awal_rapat_kordinasi'] = $errors->first('tgl_awal_rapat_kordinasi');
            }

            if($errors->has('tgl_ahir_rapat_kordinasi')){
                $err['messages']['tgl_ahir_rapat_kordinasi'] = $errors->first('tgl_ahir_rapat_kordinasi');
            }

             if($errors->has('budget_rapat_kordinasi')){
                $err['messages']['budget_rapat_kordinasi'] = $errors->first('budget_rapat_kordinasi');
            }

            if($errors->has('keterangan_rapat_kordinasi')){
                $err['messages']['keterangan_rapat_kordinasi'] = $errors->first('keterangan_rapat_kordinasi');
            }



            if($errors->has('tgl_awal_data_sekunder')){
                $err['messages']['tgl_awal_data_sekunder'] = $errors->first('tgl_awal_data_sekunder');
            }

            if($errors->has('tgl_ahir_data_sekunder')){
                $err['messages']['tgl_ahir_data_sekunder'] = $errors->first('tgl_ahir_data_sekunder');
            }

             if($errors->has('budget_data_sekunder')){
                $err['messages']['budget_data_sekunder'] = $errors->first('budget_data_sekunder');
            }

            if($errors->has('keterangan_data_sekunder')){
                $err['messages']['keterangan_data_sekunder'] = $errors->first('keterangan_data_sekunder');
            }


            if($errors->has('tgl_awal_fgd_persiapan')){
                $err['messages']['tgl_awal_fgd_persiapan'] = $errors->first('tgl_awal_fgd_persiapan');
            }

            if($errors->has('tgl_ahir_fgd_persiapan')){
                $err['messages']['tgl_ahir_fgd_persiapan'] = $errors->first('tgl_ahir_fgd_persiapan');
            }

             if($errors->has('budget_fgd_persiapan')){
                $err['messages']['budget_fgd_persiapan'] = $errors->first('budget_fgd_persiapan');
            }

            if($errors->has('keterangan_fgd_persiapan')){
                $err['messages']['keterangan_fgd_persiapan'] = $errors->first('keterangan_fgd_persiapan');
            }


            if($errors->has('tgl_awal_fgd_identifikasi')){
                $err['messages']['tgl_awal_fgd_identifikasi'] = $errors->first('tgl_awal_fgd_identifikasi');
            }

            if($errors->has('tgl_ahir_fgd_identifikasi')){
                $err['messages']['tgl_ahir_fgd_identifikasi'] = $errors->first('tgl_ahir_fgd_identifikasi');
            }

            if($errors->has('budget_fgd_identifikasi')){
                $err['messages']['budget_fgd_identifikasi'] = $errors->first('budget_fgd_identifikasi');
            }

            if($errors->has('keterangan_fgd_identifikasi')){
                $err['messages']['keterangan_fgd_identifikasi'] = $errors->first('keterangan_fgd_identifikasi');
            }


            if($errors->has('tgl_awal_lq')){
                $err['messages']['tgl_awal_lq'] = $errors->first('tgl_awal_lq');
            }

            if($errors->has('tgl_ahir_lq')){
                $err['messages']['tgl_ahir_lq'] = $errors->first('tgl_ahir_lq');
            }

            if($errors->has('budget_lq')){
                $err['messages']['budget_lq'] = $errors->first('budget_lq');
            }

            if($errors->has('keterangan_lq')){
                $err['messages']['keterangan_lq'] = $errors->first('keterangan_lq');
            }

            if($errors->has('tgl_awal_shift_share')){
                $err['messages']['tgl_awal_shift_share'] = $errors->first('tgl_awal_shift_share');
            }

            if($errors->has('tgl_ahir_shift_share')){
                $err['messages']['tgl_ahir_shift_share'] = $errors->first('tgl_ahir_shift_share');
            }

            if($errors->has('budget_shift_share')){
                $err['messages']['budget_shift_share'] = $errors->first('budget_shift_share');
            }

            if($errors->has('keterangan_shift_share')){
                $err['messages']['keterangan_shift_share'] = $errors->first('keterangan_shift_share');
            }


            if($errors->has('tgl_awal_tipologi_sektor')){
                $err['messages']['tgl_awal_tipologi_sektor'] = $errors->first('tgl_awal_tipologi_sektor');
            }

            if($errors->has('tgl_ahir_tipologi_sektor')){
                $err['messages']['tgl_ahir_tipologi_sektor'] = $errors->first('tgl_ahir_tipologi_sektor');
            }

            if($errors->has('budget_tipologi_sektor')){
                $err['messages']['budget_tipologi_sektor'] = $errors->first('budget_tipologi_sektor');
            }

            if($errors->has('keterangan_tipologi_sektor')){
                $err['messages']['keterangan_tipologi_sektor'] = $errors->first('keterangan_tipologi_sektor');
            }


            if($errors->has('tgl_awal_klassen')){
                $err['messages']['tgl_awal_klassen'] = $errors->first('tgl_awal_klassen');
            }

            if($errors->has('tgl_ahir_klassen')){
                $err['messages']['tgl_ahir_klassen'] = $errors->first('tgl_ahir_klassen');
            }

            if($errors->has('budget_klassen')){
                $err['messages']['budget_klassen'] = $errors->first('budget_klassen');
            }

            if($errors->has('keterangan_klassen')){
                $err['messages']['keterangan_klassen'] = $errors->first('keterangan_klassen');
            }


            if($errors->has('tgl_awal_fgd_klarifikasi')){
                $err['messages']['tgl_awal_fgd_klarifikasi'] = $errors->first('tgl_awal_fgd_klarifikasi');
            }

            if($errors->has('tgl_ahir_fgd_klarifikasi')){
                $err['messages']['tgl_ahir_fgd_klarifikasi'] = $errors->first('tgl_ahir_fgd_klarifikasi');
            }

            if($errors->has('budget_fgd_klarifikasi')){
                $err['messages']['budget_fgd_klarifikasi'] = $errors->first('budget_fgd_klarifikasi');
            }

            if($errors->has('keterangan_fgd_klarifikasi')){
                $err['messages']['keterangan_fgd_klarifikasi'] = $errors->first('keterangan_fgd_klarifikasi');
            }



            if($errors->has('tgl_awal_finalisasi')){
                $err['messages']['tgl_awal_finalisasi'] = $errors->first('tgl_awal_finalisasi');
            }

            if($errors->has('tgl_ahir_finalisasi')){
                $err['messages']['tgl_ahir_finalisasi'] = $errors->first('tgl_ahir_finalisasi');
            }

            if($errors->has('budget_finalisasi')){
                $err['messages']['budget_finalisasi'] = $errors->first('budget_finalisasi');
            }

            if($errors->has('keterangan_finalisasi')){
                $err['messages']['keterangan_finalisasi'] = $errors->first('keterangan_finalisasi');
            }

            
            if($errors->has('tgl_awal_summary_sektor_unggulan')){
                $err['messages']['tgl_awal_summary_sektor_unggulan'] = $errors->first('tgl_awal_summary_sektor_unggulan');
            }

            if($errors->has('tgl_ahir_summary_sektor_unggulan')){
                $err['messages']['tgl_ahir_summary_sektor_unggulan'] = $errors->first('tgl_ahir_summary_sektor_unggulan');
            }

            if($errors->has('budget_summary_sektor_unggulan')){
                $err['messages']['budget_summary_sektor_unggulan'] = $errors->first('budget_summary_sektor_unggulan');
            }

            if($errors->has('keterangan_summary_sektor_unggulan')){
                $err['messages']['keterangan_summary_sektor_unggulan'] = $errors->first('keterangan_summary_sektor_unggulan');
            }


            if($errors->has('tgl_awal_sektor_unggulan')){
                $err['messages']['tgl_awal_sektor_unggulan'] = $errors->first('tgl_awal_sektor_unggulan');
            }

            if($errors->has('tgl_ahir_sektor_unggulan')){
                $err['messages']['tgl_ahir_sektor_unggulan'] = $errors->first('tgl_ahir_sektor_unggulan');
            }

            if($errors->has('budget_sektor_unggulan')){
                $err['messages']['budget_sektor_unggulan'] = $errors->first('budget_sektor_unggulan');
            }

            if($errors->has('keterangan_sektor_unggulan')){
                $err['messages']['keterangan_sektor_unggulan'] = $errors->first('keterangan_sektor_unggulan');
            }


            if($errors->has('tgl_awal_potensi_pasar')){
                $err['messages']['tgl_awal_potensi_pasar'] = $errors->first('tgl_awal_potensi_pasar');
            }

            if($errors->has('tgl_ahir_potensi_pasar')){
                $err['messages']['tgl_ahir_potensi_pasar'] = $errors->first('tgl_ahir_potensi_pasar');
            }

            if($errors->has('budget_potensi_pasar')){
                $err['messages']['budget_potensi_pasar'] = $errors->first('budget_potensi_pasar');
            }

            if($errors->has('keterangan_potensi_pasar')){
                $err['messages']['keterangan_potensi_pasar'] = $errors->first('keterangan_potensi_pasar');
            }

            if($errors->has('tgl_awal_parameter_sektor_unggulan')){
                $err['messages']['tgl_awal_parameter_sektor_unggulan'] = $errors->first('tgl_awal_parameter_sektor_unggulan');
            }

            if($errors->has('tgl_ahir_parameter_sektor_unggulan')){
                $err['messages']['tgl_ahir_parameter_sektor_unggulan'] = $errors->first('tgl_ahir_parameter_sektor_unggulan');
            }

            if($errors->has('budget_parameter_sektor_unggulan')){
                $err['messages']['budget_parameter_sektor_unggulan'] = $errors->first('budget_parameter_sektor_unggulan');
            }

            if($errors->has('keterangan_parameter_sektor_unggulan')){
                $err['messages']['keterangan_parameter_sektor_unggulan'] = $errors->first('keterangan_parameter_sektor_unggulan');
            }


             if($errors->has('tgl_awal_subsektor_unggulan')){
                $err['messages']['tgl_awal_subsektor_unggulan'] = $errors->first('tgl_awal_subsektor_unggulan');
            }

            if($errors->has('tgl_ahir_subsektor_unggulan')){
                $err['messages']['tgl_ahir_subsektor_unggulan'] = $errors->first('tgl_ahir_subsektor_unggulan');
            }

            if($errors->has('budget_subsektor_unggulan')){
                $err['messages']['budget_subsektor_unggulan'] = $errors->first('budget_subsektor_unggulan');
            }

            if($errors->has('keterangan_subsektor_unggulan')){
                $err['messages']['keterangan_subsektor_unggulan'] = $errors->first('keterangan_subsektor_unggulan');
            }

            if($errors->has('tgl_awal_intensif_daerah')){
                $err['messages']['tgl_awal_intensif_daerah'] = $errors->first('tgl_awal_intensif_daerah');
            }

            if($errors->has('tgl_ahir_intensif_daerah')){
                $err['messages']['tgl_ahir_intensif_daerah'] = $errors->first('tgl_ahir_intensif_daerah');
            }

            if($errors->has('budget_intensif_daerah')){
                $err['messages']['budget_intensif_daerah'] = $errors->first('budget_intensif_daerah');
            }

            if($errors->has('keterangan_intensif_daerah')){
                $err['messages']['keterangan_intensif_daerah'] = $errors->first('keterangan_intensif_daerah');
            }

            if($errors->has('tgl_awal_potensi_lanjutan')){
                $err['messages']['tgl_awal_potensi_lanjutan'] = $errors->first('tgl_awal_potensi_lanjutan');
            }

            if($errors->has('tgl_ahir_potensi_lanjutan')){
                $err['messages']['tgl_ahir_potensi_lanjutan'] = $errors->first('tgl_ahir_potensi_lanjutan');
            }

            if($errors->has('budget_potensi_lanjutan')){
                $err['messages']['budget_potensi_lanjutan'] = $errors->first('budget_potensi_lanjutan');
            }

            if($errors->has('keterangan_potensi_lanjutan')){
                $err['messages']['keterangan_potensi_lanjutan'] = $errors->first('keterangan_potensi_lanjutan');
            }


             if($errors->has('tgl_awal_info_grafis')){
                $err['messages']['tgl_awal_info_grafis'] = $errors->first('tgl_awal_info_grafis');
            }

            if($errors->has('tgl_ahir_info_grafis')){
                $err['messages']['tgl_ahir_info_grafis'] = $errors->first('tgl_ahir_info_grafis');
            }

            if($errors->has('budget_info_grafis')){
                $err['messages']['budget_info_grafis'] = $errors->first('budget_info_grafis');
            }

            if($errors->has('keterangan_info_grafis')){
                $err['messages']['keterangan_info_grafis'] = $errors->first('keterangan_info_grafis');
            }


            if($errors->has('tgl_awal_dokumentasi')){
                $err['messages']['tgl_awal_dokumentasi'] = $errors->first('tgl_awal_dokumentasi');
            }

            if($errors->has('tgl_ahir_dokumentasi')){
                $err['messages']['tgl_ahir_dokumentasi'] = $errors->first('tgl_ahir_dokumentasi');
            }

            if($errors->has('budget_dokumentasi')){
                $err['messages']['budget_dokumentasi'] = $errors->first('budget_dokumentasi');
            }

            if($errors->has('keterangan_dokumentasi')){
                $err['messages']['keterangan_dokumentasi'] = $errors->first('keterangan_dokumentasi');
            }
           


            return $err;
       }
  }


  

 

}

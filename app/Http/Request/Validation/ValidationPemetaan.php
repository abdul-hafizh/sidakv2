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

         'tgl_awal_potensi' => 'Tanggal Awal Potensi',
         'tgl_ahir_potensi' => 'Tanggal Ahir Potensi',
         'budget_potensi' =>   'Budget Potensi',
         'realisasi_potensi' => 'Realisasi Potensi',
         'keterangan_potensi' => 'Keterangan Potensi',

         'tgl_awal_fgd_persiapan' => 'Tanggal Awal FGD Persiapan',
         'tgl_ahir_fgd_persiapan' => 'Tanggal Ahir FGD Persiapan',
         'budget_fgd_persiapan' => 'Budget FGD Persiapan',
         'realisasi_fgd_persiapan' => 'Realisasi FGD Persiapan',
         'keterangan_fgd_persiapan' => 'Keterangan FGD Persiapan',

         'tgl_awal_fgd_identifikasi' => 'Tanggal Awal FGD Identifikasi',
         'tgl_ahir_fgd_identifikasi' => 'Tanggal Ahir FGD Identifikasi',
         'budget_fgd_identifikasi' => 'Budget FGD Identifikasi',
         'realisasi_fgd_identifikasi' => 'Realisasi FGD Identifikasi',
         'keterangan_fgd_identifikasi' => 'Keterangan FGD Identifikasi',

         'tgl_awal_sektor' => 'Tanggal Awal Sektor',
         'tgl_ahir_sektor' => 'Tanggal Ahir Sektor',
         'budget_sektor' => 'Budget Sektor',
         'realisasi_sektor' => 'Realisasi Sektor',
         'keterangan_sektor' => 'Keterangan Sektor',
        

         'tgl_awal_fgd_klarifikasi' => 'Tanggal Awal FGD Klarifikasi',
         'tgl_ahir_fgd_klarifikasi' => 'Tanggal Ahir FGD Klarifikasi',
         'budget_fgd_klarifikasi' => 'Budget FGD Klarifikasi',
         'realisasi_fgd_klarifikasi' => 'Realisasi FGD Klarifikasi',
         'keterangan_fgd_klarifikasi' => 'Keterangan FGD Klarifikasi',

         'tgl_awal_finalisasi' => 'Tanggal Awal Finalisasi',
         'tgl_ahir_finalisasi' => 'Tanggal Ahir Finalisasi',
         'budget_finalisasi' => 'Budget Finalisasi',
         'realisasi_finalisasi' => 'Realisasi Finalisasi',
         'keterangan_finalisasi' => 'Keterangan Finalisasi',



         'tgl_awal_penyusunan' => 'Tanggal Awal Penyusunan',
         'tgl_ahir_penyusunan' => 'Tanggal Ahir Penyusunan',
         'budget_penyusunan' => 'Budget Penyusunan',
         'realisasi_penyusunan' => 'Realisasi Penyusunan',
         'keterangan_penyusunan' => 'Keterangan Penyusunan',

         

         'tgl_awal_info_grafis' => 'Tanggal Awal Info Grafis',
         'tgl_ahir_info_grafis' => 'Tanggal Ahir Info Grafis',
         'budget_info_grafis' => 'Budget Info Grafis',
         'realisasi_info_grafis' => 'Realisasi Info Grafis',
         'keterangan_info_grafis' => 'Keterangan Info Grafis',


         'tgl_awal_dokumentasi' => 'Tanggal Awal Dokumentasi',
         'tgl_ahir_dokumentasi' => 'Tanggal Ahir Dokumentasi',
         'budget_dokumentasi' => 'Budget Dokumentasi',
         'realisasi_dokumentasi' => 'Realisasi Dokumentasi',
         'keterangan_dokumentasi' => 'Keterangan Dokumentasi',
            
        
           
        ];

        $validator =  Validator::make($request->all(), 
        [
           
         'periode_id' => 'required',

         'tgl_awal_potensi' => 'required',
         'tgl_ahir_potensi' => 'required',
         'budget_potensi' =>   'required|numeric|gt:0',
         'realisasi_potensi' => 'required|numeric|gt:0',
         'keterangan_potensi' => 'required_if:status_laporan_id,14',
         

         'tgl_awal_fgd_persiapan' => 'required',
         'tgl_ahir_fgd_persiapan' => 'required',
         'budget_fgd_persiapan' => 'required|numeric|gt:0',
         'realisasi_fgd_persiapan' => 'required|numeric|gt:0',
         'keterangan_fgd_persiapan' => 'required_if:status_laporan_id,14',

         'tgl_awal_fgd_identifikasi' =>'required',
         'tgl_ahir_fgd_identifikasi' => 'required',
         'budget_fgd_identifikasi' => 'required|numeric|gt:0',
         'realisasi_fgd_identifikasi' => 'required|numeric|gt:0',
         'keterangan_fgd_identifikasi' => 'required_if:status_laporan_id,14',

         'tgl_awal_sektor' => 'required',
         'tgl_ahir_sektor' => 'required',
         'budget_sektor' => 'required|numeric|gt:0',
         'realisasi_sektor' => 'required|numeric|gt:0',
         'keterangan_sektor' => 'required_if:status_laporan_id,14',


         'tgl_awal_fgd_klarifikasi' => 'required',
         'tgl_ahir_fgd_klarifikasi' =>'required',
         'budget_fgd_klarifikasi' => 'required|numeric|gt:0',
         'realisasi_fgd_klarifikasi' => 'required|numeric|gt:0',
         'keterangan_fgd_klarifikasi' => 'required_if:status_laporan_id,14',

         'tgl_awal_finalisasi' => 'required',
         'tgl_ahir_finalisasi' => 'required',
         'budget_finalisasi' => 'required|numeric|gt:0',
         'realisasi_finalisasi' => 'required|numeric|gt:0',
         'keterangan_finalisasi' => 'required_if:status_laporan_id,14',


         'tgl_awal_penyusunan' => 'required',
         'tgl_ahir_penyusunan' => 'required',
         'budget_penyusunan' => 'required|numeric|gt:0',
         'realisasi_penyusunan' => 'required|numeric|gt:0',
         'keterangan_penyusunan' => 'required_if:status_laporan_id,14',

         

         'tgl_awal_info_grafis' => 'required',
         'tgl_ahir_info_grafis' => 'required',
         'budget_info_grafis' => 'required|numeric|gt:0',
         'realisasi_info_grafis' => 'required|numeric|gt:0',
         'keterangan_info_grafis' => 'required_if:status_laporan_id,14',


         'tgl_awal_dokumentasi' => 'required',
         'tgl_ahir_dokumentasi' => 'required',
         'budget_dokumentasi' => 'required|numeric|gt:0',
         'realisasi_dokumentasi' => 'required|numeric|gt:0',
         'keterangan_dokumentasi' => 'required_if:status_laporan_id,14',

         
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
           

            if($errors->has('periode_id')){
                $err['messages']['periode_id'] = $errors->first('periode_id');
            }

            if($errors->has('tgl_awal_potensi')){
                $err['messages']['tgl_awal_potensi'] = $errors->first('tgl_awal_potensi');
            }

            if($errors->has('tgl_ahir_potensi')){
                $err['messages']['tgl_ahir_potensi'] = $errors->first('tgl_ahir_potensi');
            }

             if($errors->has('budget_potensi')){
                $err['messages']['budget_potensi'] = $errors->first('budget_potensi');
            }

            if($errors->has('realisasi_potensi')){
                $err['messages']['realisasi_potensi'] = $errors->first('realisasi_potensi');
            }


            if($errors->has('keterangan_potensi')){
                $err['messages']['keterangan_potensi'] = $errors->first('keterangan_potensi');
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

            if($errors->has('realisasi_fgd_persiapan')){
                $err['messages']['realisasi_fgd_persiapan'] = $errors->first('realisasi_fgd_persiapan');
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

            if($errors->has('realisasi_fgd_identifikasi')){
                $err['messages']['realisasi_fgd_identifikasi'] = $errors->first('realisasi_fgd_identifikasi');
            }

            if($errors->has('keterangan_fgd_identifikasi')){
                $err['messages']['keterangan_fgd_identifikasi'] = $errors->first('keterangan_fgd_identifikasi');
            }

           

            if($errors->has('tgl_awal_sektor')){
                $err['messages']['tgl_awal_sektor'] = $errors->first('tgl_awal_sektor');
            }

            if($errors->has('tgl_ahir_sektor')){
                $err['messages']['tgl_ahir_sektor'] = $errors->first('tgl_ahir_sektor');
            }

            if($errors->has('budget_sektor')){
                $err['messages']['budget_sektor'] = $errors->first('budget_sektor');
            }

           
            if($errors->has('realisasi_sektor')){
                $err['messages']['realisasi_sektor'] = $errors->first('realisasi_sektor');
            }

            if($errors->has('keterangan_sektor')){
                $err['messages']['keterangan_sektor'] = $errors->first('keterangan_sektor');
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

             if($errors->has('realisasi_fgd_klarifikasi')){
                $err['messages']['realisasi_fgd_klarifikasi'] = $errors->first('realisasi_fgd_klarifikasi');
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

             if($errors->has('realisasi_finalisasi')){
                $err['messages']['realisasi_finalisasi'] = $errors->first('realisasi_finalisasi');
            }

            if($errors->has('keterangan_finalisasi')){
                $err['messages']['keterangan_finalisasi'] = $errors->first('keterangan_finalisasi');
            }

            
            if($errors->has('tgl_awal_penyusunan')){
                $err['messages']['tgl_awal_penyusunan'] = $errors->first('tgl_awal_penyusunan');
            }

            if($errors->has('tgl_ahir_penyusunan')){
                $err['messages']['tgl_ahir_penyusunan'] = $errors->first('tgl_ahir_penyusunan');
            }

            if($errors->has('budget_penyusunan')){
                $err['messages']['budget_penyusunan'] = $errors->first('budget_penyusunan');
            }

            if($errors->has('realisasi_penyusunan')){
                $err['messages']['realisasi_penyusunan'] = $errors->first('realisasi_penyusunan');
            }

            if($errors->has('keterangan_penyusunan')){
                $err['messages']['keterangan_penyusunan'] = $errors->first('keterangan_penyusunan');
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

             if($errors->has('realisasi_info_grafis')){
                $err['messages']['realisasi_info_grafis'] = $errors->first('realisasi_info_grafis');
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

            if($errors->has('realisasi_dokumentasi')){
                $err['messages']['realisasi_dokumentasi'] = $errors->first('realisasi_dokumentasi');
            }

            if($errors->has('keterangan_dokumentasi')){
                $err['messages']['keterangan_dokumentasi'] = $errors->first('keterangan_dokumentasi');
            }

            if($request->checklist_lq == 'false' && $request->checklist_shift_share =='false' &&  $request->checklist_tipologi_sektor =='false' && $request->checklist_klassen =='false'){

                $err['messages']['pengolahan'] = 'Maksimal 1 pilihan analisis!';
                
            }

            if($request->checklist_summary_sektor_unggulan == 'false' && $request->checklist_sektor_unggulan =='false' &&  $request->checklist_potensi_pasar =='false' && $request->checklist_parameter_sektor_unggulan =='false' && $request->checklist_subsektor_unggulan =='false' &&  $request->checklist_intensif_daerah =='false' && $request->checklist_potensi_lanjutan =='false')
            {

                $err['messages']['penyusunan'] = 'Maksimal 1 pilihan hasil identifikasi!';
               
            }
           


            return $err;
       }
  }

 
}

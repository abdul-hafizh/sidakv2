<?php

namespace App\Http\Request;

use DB;
use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\PaguTarget;
use App\Models\Pemetaan;
use App\Http\Request\RequestDaerah;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestMenuRoles;
use App\Http\Request\RequestPaguTarget;
use File;

class RequestPemetaan
{
   public static function GetDataAll($data, $perPage, $request)
   {
      $temp = array();
      $getRequest = $request->all();
      $year = $request->periode_id;
      $page = isset($getRequest['page']) ? $getRequest['page'] : 1;

      if ($perPage != 'all') {
         $numberNext = (($page * $perPage) - ($perPage - 1));
      } else {
         $numberNext = (($page * $data->count()) - ($data->count() - 1));
      }

      $access = RequestAuth::Access();

      foreach ($data as $key => $val) {
         if ($val->status_laporan_id == '14') {
            $status = 'Terkirim';
         }else{
           $status = 'Draft';
         
         };

         $description =  $val->alasan;
         if (strlen($description) > 30) {
             $description = substr($description, 0, 30) . "...";
         }

         if($val->checklist =='not_approved')
         {
            $checklist = 'proses';
         }else if($val->checklist =='approved'){
            $checklist = 'approved';
         }else{
            $checklist = '';
         }   
         

        

         $temp[$key]['number'] = $numberNext++;
         $temp[$key]['id'] = $val->id;
       
         $temp[$key]['daerah_name'] = RequestDaerah::GetDaerahWhereName($val->daerah_id);
         $temp[$key]['access'] = $access;
         $temp[$key]['checklist'] = $checklist;
         $temp[$key]['periode_id'] = $val->periode_id;
         $temp[$key]['daerah_id'] = $val->daerah_id;



         $temp[$key]['tgl_awal_rencana_kerja'] = $val->tgl_awal_rencana_kerja;
         $temp[$key]['tgl_ahir_rencana_kerja'] = $val->tgl_ahir_rencana_kerja;
         $temp[$key]['budget_rencana_kerja'] = $val->budget_rencana_kerja;
         $temp[$key]['keterangan_rencana_kerja'] = $val->keterangan_rencana_kerja;

         $temp[$key]['tgl_awal_studi_literatur'] = $val->tgl_awal_studi_literatur;
         $temp[$key]['tgl_ahir_studi_literatur'] = $val->tgl_ahir_studi_literatur;
         $temp[$key]['budget_studi_literatur'] = $val->budget_studi_literatur;
         $temp[$key]['keterangan_studi_literatur'] = $val->keterangan_studi_literatur;

         $temp[$key]['tgl_awal_rapat_kordinasi'] = $val->tgl_awal_rapat_kordinasi;
         $temp[$key]['tgl_ahir_rapat_kordinasi'] = $val->tgl_ahir_rapat_kordinasi;
         $temp[$key]['budget_rapat_kordinasi'] = $val->budget_rapat_kordinasi;
         $temp[$key]['keterangan_rapat_kordinasi'] = $val->keterangan_rapat_kordinasi;

         $temp[$key]['tgl_awal_data_sekunder'] = $val->tgl_awal_data_sekunder;
         $temp[$key]['tgl_ahir_data_sekunder'] = $val->tgl_ahir_data_sekunder;
         $temp[$key]['budget_data_sekunder'] = $val->budget_data_sekunder;
         $temp[$key]['keterangan_data_sekunder'] = $val->keterangan_data_sekunder;

         $temp[$key]['total_identifikasi'] = GeneralHelpers::formatRupiah($val->budget_rencana_kerja + $val->budget_studi_literatur + $val->budget_rapat_kordinasi + $val->budget_data_sekunder);




         $temp[$key]['tgl_awal_fgd_persiapan'] = $val->tgl_awal_fgd_persiapan;
         $temp[$key]['tgl_ahir_fgd_persiapan'] = $val->tgl_ahir_fgd_persiapan;
         $temp[$key]['budget_fgd_persiapan'] = $val->budget_fgd_persiapan;
         $temp[$key]['keterangan_fgd_persiapan'] = $val->keterangan_fgd_persiapan;

         $temp[$key]['tgl_awal_fgd_identifikasi'] = $val->tgl_awal_fgd_identifikasi;
         $temp[$key]['tgl_ahir_fgd_identifikasi'] = $val->tgl_ahir_fgd_identifikasi;
         $temp[$key]['budget_fgd_identifikasi'] = $val->budget_fgd_identifikasi;
         $temp[$key]['keterangan_fgd_identifikasi'] = $val->keterangan_fgd_identifikasi;



         $temp[$key]['checklist_lq'] = $val->checklist_lq;
         $temp[$key]['tgl_awal_lq'] = $val->tgl_awal_lq;
         $temp[$key]['tgl_ahir_lq'] = $val->tgl_ahir_lq;
         $temp[$key]['budget_lq'] = $val->budget_lq;
         // $temp[$key]['keterangan_lq'] = $val->keterangan_lq;

         $temp[$key]['checklist_shift_share'] = $val->checklist_shift_share;
         $temp[$key]['tgl_awal_shift_share'] = $val->tgl_awal_shift_share;
         $temp[$key]['tgl_ahir_shift_share'] = $val->tgl_ahir_shift_share;
         $temp[$key]['budget_shift_share'] = $val->budget_shift_share;
         // $temp[$key]['keterangan_shift_share'] = $val->keterangan_shift_share;

       

         $temp[$key]['checklist_tipologi_sektor'] = $val->checklist_tipologi_sektor;
         $temp[$key]['tgl_awal_tipologi_sektor'] = $val->tgl_awal_tipologi_sektor;
         $temp[$key]['tgl_ahir_tipologi_sektor'] = $val->tgl_ahir_tipologi_sektor;
         $temp[$key]['budget_tipologi_sektor'] = $val->budget_tipologi_sektor;
         // $temp[$key]['keterangan_tipologi_sektor'] = $val->keterangan_tipologi_sektor;

         $temp[$key]['checklist_klassen'] = $val->checklist_klassen;
         $temp[$key]['tgl_awal_klassen'] = $val->tgl_awal_klassen;
         $temp[$key]['tgl_ahir_klassen'] = $val->tgl_ahir_klassen;
         $temp[$key]['budget_klassen'] = $val->budget_klassen;
         // $temp[$key]['keterangan_klassen'] = $val->keterangan_klassen;
         $temp[$key]['keterangan_pengolahan'] = $val->keterangan_pengolahan;

         $temp[$key]['total_analisis'] =  GeneralHelpers::formatRupiah($val->budget_lq + $val->budget_shift_share + $val->budget_tipologi_sektor + $val->budget_klassen);

         $temp[$key]['tgl_awal_fgd_klarifikasi'] = $val->tgl_awal_fgd_klarifikasi;
         $temp[$key]['tgl_ahir_fgd_klarifikasi'] = $val->tgl_ahir_fgd_klarifikasi;
         $temp[$key]['budget_fgd_klarifikasi'] = $val->budget_fgd_klarifikasi;
         $temp[$key]['keterangan_fgd_klarifikasi'] = $val->keterangan_fgd_klarifikasi;


         $temp[$key]['tgl_awal_finalisasi'] = $val->tgl_awal_finalisasi;
         $temp[$key]['tgl_ahir_finalisasi'] = $val->tgl_ahir_finalisasi;
         $temp[$key]['budget_finalisasi'] = $val->budget_finalisasi;
         $temp[$key]['keterangan_finalisasi'] = $val->keterangan_finalisasi;
        


         $temp[$key]['total_pelaksanaan'] = GeneralHelpers::formatRupiah($val->budget_fgd_persiapan + $val->budget_fgd_identifikasi + $val->budget_lq + $val->budget_shift_share + $val->budget_tipologi_sektor + $val->budget_klassen + $val->budget_fgd_klarifikasi + $val->budget_finalisasi); 

         $temp[$key]['checklist_summary_sektor_unggulan'] = $val->checklist_summary_sektor_unggulan;
         $temp[$key]['tgl_awal_summary_sektor_unggulan'] = $val->tgl_awal_summary_sektor_unggulan;
         $temp[$key]['tgl_ahir_summary_sektor_unggulan'] = $val->tgl_ahir_summary_sektor_unggulan;
         $temp[$key]['budget_summary_sektor_unggulan'] = $val->budget_summary_sektor_unggulan;
         // $temp[$key]['keterangan_summary_sektor_unggulan'] = $val->keterangan_summary_sektor_unggulan;

         $temp[$key]['checklist_sektor_unggulan'] = $val->checklist_sektor_unggulan;
         $temp[$key]['tgl_awal_sektor_unggulan'] = $val->tgl_awal_sektor_unggulan;
         $temp[$key]['tgl_ahir_sektor_unggulan'] = $val->tgl_ahir_sektor_unggulan;
         $temp[$key]['budget_sektor_unggulan'] = $val->budget_sektor_unggulan;
         // $temp[$key]['keterangan_sektor_unggulan'] = $val->keterangan_sektor_unggulan;
     
         $temp[$key]['checklist_potensi_pasar'] = $val->checklist_potensi_pasar;
         $temp[$key]['tgl_awal_potensi_pasar'] = $val->tgl_awal_potensi_pasar;
         $temp[$key]['tgl_ahir_potensi_pasar'] = $val->tgl_ahir_potensi_pasar;
         $temp[$key]['budget_potensi_pasar'] = $val->budget_potensi_pasar;
         // $temp[$key]['keterangan_potensi_pasar'] = $val->keterangan_potensi_pasar;

         $temp[$key]['checklist_parameter_sektor_unggulan'] = $val->checklist_parameter_sektor_unggulan;
         $temp[$key]['tgl_awal_parameter_sektor_unggulan'] = $val->tgl_awal_parameter_sektor_unggulan;
         $temp[$key]['tgl_ahir_parameter_sektor_unggulan'] = $val->tgl_ahir_parameter_sektor_unggulan;
         $temp[$key]['budget_parameter_sektor_unggulan'] = $val->budget_parameter_sektor_unggulan;
         // $temp[$key]['keterangan_parameter_sektor_unggulan'] = $val->keterangan_parameter_sektor_unggulan;

         $temp[$key]['checklist_subsektor_unggulan'] = $val->checklist_subsektor_unggulan;
         $temp[$key]['tgl_awal_subsektor_unggulan'] = $val->tgl_awal_subsektor_unggulan;
         $temp[$key]['tgl_ahir_subsektor_unggulan'] = $val->tgl_ahir_subsektor_unggulan;
         $temp[$key]['budget_subsektor_unggulan'] = $val->budget_subsektor_unggulan;
         // $temp[$key]['keterangan_subsektor_unggulan'] = $val->keterangan_subsektor_unggulan;

         $temp[$key]['checklist_intensif_daerah'] = $val->checklist_intensif_daerah;
         $temp[$key]['tgl_awal_intensif_daerah'] = $val->tgl_awal_intensif_daerah;
         $temp[$key]['tgl_ahir_intensif_daerah'] = $val->tgl_ahir_intensif_daerah;
         $temp[$key]['budget_intensif_daerah'] = $val->budget_intensif_daerah;
         // $temp[$key]['keterangan_intensif_daerah'] = $val->keterangan_intensif_daerah;
      
         $temp[$key]['checklist_potensi_lanjutan'] = $val->checklist_potensi_lanjutan;
         $temp[$key]['tgl_awal_potensi_lanjutan'] = $val->tgl_awal_potensi_lanjutan;
         $temp[$key]['tgl_ahir_potensi_lanjutan'] = $val->tgl_ahir_potensi_lanjutan;
         $temp[$key]['budget_potensi_lanjutan'] = $val->budget_potensi_lanjutan;
         // $temp[$key]['keterangan_potensi_lanjutan'] = $val->keterangan_potensi_lanjutan;
         $temp[$key]['keterangan_penyusunan'] = $val->keterangan_penyusunan;


         $temp[$key]['total_analisis_doc'] = GeneralHelpers::formatRupiah($val->budget_summary_sektor_unggulan +  $val->budget_sektor_unggulan + $val->budget_potensi_pasar + $val->budget_parameter_sektor_unggulan + $val->budget_subsektor_unggulan + $val->budget_intensif_daerah + $val->budget_potensi_lanjutan);

          $temp[$key]['total_penyusunan'] = GeneralHelpers::formatRupiah($val->budget_summary_sektor_unggulan +  $val->budget_sektor_unggulan + $val->budget_potensi_pasar + $val->budget_parameter_sektor_unggulan + $val->budget_subsektor_unggulan + $val->budget_intensif_daerah + $val->budget_potensi_lanjutan + $val->budget_info_grafis + $val->budget_dokumentasi);

         $temp[$key]['tgl_awal_info_grafis'] = $val->tgl_awal_info_grafis;
         $temp[$key]['tgl_ahir_info_grafis'] = $val->tgl_ahir_info_grafis;
         $temp[$key]['budget_info_grafis'] = $val->budget_info_grafis;
         $temp[$key]['keterangan_info_grafis'] = $val->keterangan_info_grafis;

         $temp[$key]['tgl_awal_dokumentasi'] = $val->tgl_awal_dokumentasi;
         $temp[$key]['tgl_ahir_dokumentasi'] = $val->tgl_ahir_dokumentasi;
         $temp[$key]['budget_dokumentasi'] = $val->budget_dokumentasi;
         $temp[$key]['keterangan_dokumentasi'] = $val->keterangan_dokumentasi;



           
         $temp[$key]['total_budget'] = GeneralHelpers::formatRupiah($val->budget_rencana_kerja + $val->budget_studi_literatur + $val->budget_rapat_kordinasi + $val->budget_data_sekunder + $val->budget_fgd_persiapan + $val->budget_fgd_identifikasi + $val->budget_lq + $val->budget_shift_share + $val->budget_tipologi_sektor + $val->budget_klassen + $val->budget_fgd_klarifikasi + $val->budget_finalisasi + $val->budget_summary_sektor_unggulan +  $val->budget_sektor_unggulan + $val->budget_potensi_pasar + $val->budget_parameter_sektor_unggulan + $val->budget_subsektor_unggulan + $val->budget_intensif_daerah + $val->budget_potensi_lanjutan + $val->budget_info_grafis +  $val->budget_dokumentasi);  

         $temp[$key]['created_by'] = $val->created_by;
         $temp[$key]['request_edit'] = $val->request_edit;
         $temp[$key]['status_laporan_id'] = $val->status_laporan_id;
         $temp[$key]['alasan'] = $description;

      
         $temp[$key]['status'] = array('status_db' => $val->status_laporan_id, 'status_convert' => $status);
         $temp[$key]['created_at'] = GeneralHelpers::dates($val->created_at);
         $temp[$key]['created_at_format'] = GeneralHelpers::formatExcel($val->created_at);
      }

      $result['data'] = $temp;
      if($data->count() > 0){
           $result['periode_id'] = $year;

           if($access =='pusat')
           {
                $result['pagu_pemetaan'] = 'Rp 0';
                $result['total_pemetaan'] = GeneralHelpers::formatRupiah(RequestPemetaan::TotalPemetaan($year,Auth::User()->daerah_id));
           }else{
               $result['pagu_pemetaan'] = GeneralHelpers::formatRupiah(RequestPerencanaan::PaguPromosi($year,Auth::User()->daerah_id));

               $result['total_pemetaan'] = GeneralHelpers::formatRupiah(RequestPemetaan::TotalPemetaan($year,Auth::User()->daerah_id));
           } 
         
      }else{
          $result['periode_id'] = '';
          $result['pagu_pemetaan'] = 'Rp 0';
          $result['total_pemetaan'] =  'Rp 0'; 
      }

      $result['total_daerah'] = Pemetaan::groupBy('daerah_id')->count();
      $result['total_requestedit'] = Pemetaan::where(['request_edit'=>'true'])->count();
      $result['options'] = RequestMenuRoles::ActionPage('promosi');
      if ($perPage != 'all') {
         $result['current_page'] = $data->currentPage();
         $result['last_page'] = $data->lastPage();
         $result['total'] = $data->total();
      } else {
         $result['current_page'] = 1;
         $result['last_page'] = 1;
         $result['total'] = $data->count();
      }

      return $result;
   }

   public static function TotalPemetaan($year,$daerah_id){

     $access = RequestAuth::Access();  
     if($access =='province')
     {
        $data = Pemetaan::select(DB::raw('SUM(budget_rencana_kerja + budget_studi_literatur + budget_rapat_kordinasi + budget_data_sekunder + budget_fgd_persiapan + budget_fgd_identifikasi + budget_lq + budget_shift_share +budget_tipologi_sektor + budget_klassen + budget_fgd_klarifikasi + budget_finalisasi + budget_summary_sektor_unggulan +  budget_sektor_unggulan + budget_potensi_pasar + budget_parameter_sektor_unggulan + budget_subsektor_unggulan + budget_intensif_daerah + budget_potensi_lanjutan + budget_info_grafis +  budget_dokumentasi) as total '))->where(['periode_id'=>$year,'daerah_id'=>$daerah_id])->first()->total;

       
     }else if($access =='pusat'){

         $data = Pemetaan::select(DB::raw('SUM(budget_rencana_kerja + budget_studi_literatur + budget_rapat_kordinasi + budget_data_sekunder + budget_fgd_persiapan + budget_fgd_identifikasi + budget_lq + budget_shift_share +budget_tipologi_sektor + budget_klassen + budget_fgd_klarifikasi + budget_finalisasi + budget_summary_sektor_unggulan +  budget_sektor_unggulan + budget_potensi_pasar + budget_parameter_sektor_unggulan + budget_subsektor_unggulan + budget_intensif_daerah + budget_potensi_lanjutan + budget_info_grafis +  budget_dokumentasi) as total '))->where(['periode_id'=>$year])->first()->total;

       

     } 
 
         return $data;
   }


   public static function GetDetail($val)
   {

         $temp = array();

         if ($val->status_laporan_id == '14') {
            $status = 'Terkirim';
         }else{
           $status = 'Draft';
         
         };
         $temp['id'] = $val->id;
         $temp['periode_id'] = $val->periode_id;
         $temp['daerah_id'] = $val->daerah_id;
         $temp['daerah_name'] = RequestDaerah::GetDaerahWhereID($val->daerah_id);
         
         $temp['tgl_awal_rencana_kerja'] = $val->tgl_awal_rencana_kerja;
         $temp['tgl_ahir_rencana_kerja'] = $val->tgl_ahir_rencana_kerja;
         $temp['budget_rencana_kerja'] = $val->budget_rencana_kerja;
         $temp['keterangan_rencana_kerja'] = url('laporan/pemetaan/'.$val->keterangan_rencana_kerja);


         $temp['tgl_awal_studi_literatur'] = $val->tgl_awal_studi_literatur;
         $temp['tgl_ahir_studi_literatur'] = $val->tgl_ahir_studi_literatur;
         $temp['budget_studi_literatur'] = $val->budget_studi_literatur;
         $temp['keterangan_studi_literatur'] = url('laporan/pemetaan/'.$val->keterangan_studi_literatur);

         $temp['tgl_awal_rapat_kordinasi'] = $val->tgl_awal_rapat_kordinasi;
         $temp['tgl_ahir_rapat_kordinasi'] = $val->tgl_ahir_rapat_kordinasi;
         $temp['budget_rapat_kordinasi'] = $val->budget_rapat_kordinasi; 
         $temp['keterangan_rapat_kordinasi'] = url('laporan/pemetaan/'.$val->keterangan_rapat_kordinasi);

         $temp['tgl_awal_data_sekunder'] = $val->tgl_awal_data_sekunder;
         $temp['tgl_ahir_data_sekunder'] = $val->tgl_ahir_data_sekunder;
         $temp['budget_data_sekunder'] = $val->budget_data_sekunder; 
         $temp['keterangan_data_sekunder'] =  url('laporan/pemetaan/'.$val->keterangan_data_sekunder);

            $temp['total_identifikasi'] = GeneralHelpers::formatRupiah($val->budget_rencana_kerja + $val->budget_studi_literatur + $val->budget_rapat_kordinasi + $val->budget_data_sekunder);



         $temp['tgl_awal_fgd_persiapan'] = $val->tgl_awal_fgd_persiapan;
         $temp['tgl_ahir_fgd_persiapan'] = $val->tgl_ahir_fgd_persiapan;
         $temp['budget_fgd_persiapan'] =  $val->budget_fgd_persiapan;
         $temp['keterangan_fgd_persiapan'] =  url('laporan/pemetaan/'.$val->keterangan_fgd_persiapan);

         $temp['tgl_awal_fgd_identifikasi'] = $val->tgl_awal_fgd_identifikasi;
         $temp['tgl_ahir_fgd_identifikasi'] = $val->tgl_ahir_fgd_identifikasi;
         $temp['budget_fgd_identifikasi'] = $val->budget_fgd_identifikasi;
         $temp['keterangan_fgd_identifikasi'] =  url('laporan/pemetaan/'.$val->keterangan_fgd_identifikasi);
      
         $temp['checklist_lq'] = $val->checklist_lq;
         $temp['tgl_awal_lq'] = $val->tgl_awal_lq;
         $temp['tgl_ahir_lq'] = $val->tgl_ahir_lq;
         $temp['budget_lq'] = $val->budget_lq;
         // $temp['keterangan_lq'] = $val->keterangan_lq;

         $temp['checklist_shift_share'] = $val->checklist_shift_share;
         $temp['tgl_awal_shift_share'] = $val->tgl_awal_shift_share;
         $temp['tgl_ahir_shift_share'] = $val->tgl_ahir_shift_share;
         $temp['budget_shift_share'] = $val->budget_shift_share;
         // $temp['keterangan_shift_share'] = $val->keterangan_shift_share;
     
         $temp['checklist_tipologi_sektor'] = $val->checklist_tipologi_sektor;
         $temp['tgl_awal_tipologi_sektor'] = $val->tgl_awal_tipologi_sektor;
         $temp['tgl_ahir_tipologi_sektor'] = $val->tgl_ahir_tipologi_sektor;
         $temp['budget_tipologi_sektor'] = $val->budget_tipologi_sektor;
         // $temp['keterangan_tipologi_sektor'] = $val->keterangan_tipologi_sektor;
        
         $temp['checklist_klassen'] = $val->checklist_klassen;
         $temp['tgl_awal_klassen'] = $val->tgl_awal_klassen;
         $temp['tgl_ahir_klassen'] = $val->tgl_ahir_klassen;
         $temp['budget_klassen'] = $val->budget_klassen;
         // $temp['keterangan_klassen'] = $val->keterangan_klassen;
         $temp['keterangan_pengolahan'] =  url('laporan/pemetaan/'.$val->keterangan_pengolahan);

        

         // $temp['total_produksi'] =  GeneralHelpers::formatRupiah($val->budget_gambar + $val->budget_video);

         $temp['tgl_awal_fgd_klarifikasi'] = $val->tgl_awal_fgd_klarifikasi;
         $temp['tgl_ahir_fgd_klarifikasi'] = $val->tgl_ahir_fgd_klarifikasi;
         $temp['budget_fgd_klarifikasi'] =$val->budget_fgd_klarifikasi;
         $temp['keterangan_fgd_klarifikasi'] =  url('laporan/pemetaan/'.$val->keterangan_fgd_klarifikasi);

         $temp['tgl_awal_finalisasi'] = $val->tgl_awal_finalisasi;
         $temp['tgl_ahir_finalisasi'] = $val->tgl_ahir_finalisasi;
         $temp['budget_finalisasi'] = $val->budget_finalisasi;
         $temp['keterangan_finalisasi'] =  url('laporan/pemetaan/'.$val->keterangan_finalisasi);

         $temp['total_pelaksanaan'] = GeneralHelpers::formatRupiah($val->budget_fgd_persiapan + $val->budget_fgd_identifikasi + $val->budget_lq + $val->budget_shift_share + $val->budget_tipologi_sektor + $val->budget_klassen + $val->budget_fgd_klarifikasi + $val->budget_finalisasi);

         $temp['checklist_summary_sektor_unggulan'] = $val->checklist_summary_sektor_unggulan;
         $temp['tgl_awal_summary_sektor_unggulan'] = $val->tgl_awal_summary_sektor_unggulan;
         $temp['tgl_ahir_summary_sektor_unggulan'] = $val->tgl_ahir_summary_sektor_unggulan;
         $temp['budget_summary_sektor_unggulan'] = $val->budget_summary_sektor_unggulan;
         // $temp['keterangan_summary_sektor_unggulan'] = $val->keterangan_summary_sektor_unggulan;
       
         $temp['checklist_sektor_unggulan'] = $val->checklist_sektor_unggulan;
         $temp['tgl_awal_sektor_unggulan'] = $val->tgl_awal_sektor_unggulan;
         $temp['tgl_ahir_sektor_unggulan'] = $val->tgl_ahir_sektor_unggulan;
         $temp['budget_sektor_unggulan'] = $val->budget_sektor_unggulan;
         // $temp['keterangan_sektor_unggulan'] = $val->keterangan_sektor_unggulan;
     
         $temp['checklist_potensi_pasar'] = $val->checklist_potensi_pasar;
         $temp['tgl_awal_potensi_pasar'] = $val->tgl_awal_potensi_pasar;
         $temp['tgl_ahir_potensi_pasar'] = $val->tgl_ahir_potensi_pasar;
         $temp['budget_potensi_pasar'] =  $val->budget_potensi_pasar;
         // $temp['keterangan_potensi_pasar'] = $val->keterangan_potensi_pasar;
       
         $temp['checklist_parameter_sektor_unggulan'] = $val->checklist_parameter_sektor_unggulan;
         $temp['tgl_awal_parameter_sektor_unggulan'] = $val->tgl_awal_parameter_sektor_unggulan;
         $temp['tgl_ahir_parameter_sektor_unggulan'] = $val->tgl_ahir_parameter_sektor_unggulan;
         $temp['budget_parameter_sektor_unggulan'] =  $val->budget_parameter_sektor_unggulan;
         // $temp['keterangan_parameter_sektor_unggulan'] = $val->keterangan_parameter_sektor_unggulan;

         $temp['checklist_subsektor_unggulan'] = $val->checklist_subsektor_unggulan;
         $temp['tgl_awal_subsektor_unggulan'] = $val->tgl_awal_subsektor_unggulan;
         $temp['tgl_ahir_subsektor_unggulan'] = $val->tgl_ahir_subsektor_unggulan;
         $temp['budget_subsektor_unggulan'] =  $val->budget_subsektor_unggulan;
         // $temp['keterangan_subsektor_unggulan'] = $val->keterangan_subsektor_unggulan;

         $temp['checklist_intensif_daerah'] = $val->checklist_intensif_daerah;
         $temp['tgl_awal_intensif_daerah'] = $val->tgl_awal_intensif_daerah;
         $temp['tgl_ahir_intensif_daerah'] = $val->tgl_ahir_intensif_daerah;
         $temp['budget_intensif_daerah'] = $val->budget_intensif_daerah;
         // $temp['keterangan_intensif_daerah'] = $val->keterangan_intensif_daerah;
       
         $temp['checklist_potensi_lanjutan'] = $val->checklist_potensi_lanjutan;
         $temp['tgl_awal_potensi_lanjutan'] = $val->tgl_awal_potensi_lanjutan;
         $temp['tgl_ahir_potensi_lanjutan'] = $val->tgl_ahir_potensi_lanjutan;
         $temp['budget_potensi_lanjutan'] =  $val->budget_potensi_lanjutan;
         // $temp['keterangan_potensi_lanjutan'] = $val->keterangan_potensi_lanjutan;
         $temp['keterangan_penyusunan'] =  url('laporan/pemetaan/'.$val->keterangan_penyusunan);

         $temp['tgl_awal_info_grafis'] = $val->tgl_awal_info_grafis;
         $temp['tgl_ahir_info_grafis'] = $val->tgl_ahir_info_grafis;
         $temp['budget_info_grafis'] =  $val->budget_info_grafis;
         $temp['keterangan_info_grafis'] =  url('laporan/pemetaan/'.$val->keterangan_info_grafis);
        
         $temp['tgl_awal_dokumentasi'] = $val->tgl_awal_dokumentasi;
         $temp['tgl_ahir_dokumentasi'] = $val->tgl_ahir_dokumentasi;
         $temp['budget_dokumentasi'] = $val->budget_dokumentasi;
         $temp['keterangan_dokumentasi'] =  url('laporan/pemetaan/'.$val->keterangan_dokumentasi);  

         $temp['total_penyusunan'] = GeneralHelpers::formatRupiah($val->budget_summary_sektor_unggulan + $val->budget_sektor_unggulan + $val->budget_potensi_pasar + $val->budget_parameter_sektor_unggulan + $val->budget_subsektor_unggulan + $val->budget_intensif_daerah + $val->budget_potensi_lanjutan + $val->budget_info_grafis + $val->budget_dokumentasi); 


         $temp['created_by'] = $val->created_by;
         $temp['request_edit'] = $val->request_edit;
         $temp['checklist'] = $val->checklist;
         $temp['access'] = RequestAuth::Access();
         $temp['alasan'] = $val->alasan;
         $temp['status'] = array('status_db' => $val->status_laporan_id, 'status_convert' => $status);

         $temp['pagu_promosi_convert'] =  GeneralHelpers::formatRupiah(RequestPerencanaan::PaguPromosi($val->periode_id,$val->daerah_id));
         $temp['total_promosi_convert'] = GeneralHelpers::formatRupiah($val->budget_rencana_kerja + $val->budget_studi_literatur + $val->budget_rapat_kordinasi + $val->budget_data_sekunder + $val->budget_fgd_persiapan + $val->budget_fgd_identifikasi + $val->budget_lq + $val->budget_shift_share + $val->budget_tipologi_sektor + $val->budget_klassen + $val->budget_fgd_klarifikasi + $val->budget_finalisasi + $val->budget_summary_sektor_unggulan + $val->budget_sektor_unggulan + $val->budget_potensi_pasar + $val->budget_parameter_sektor_unggulan + $val->budget_subsektor_unggulan + $val->budget_intensif_daerah + $val->budget_potensi_lanjutan + $val->budget_info_grafis + $val->budget_dokumentasi);
         $temp['pagu_promosi'] =  RequestPerencanaan::PaguPromosi($val->periode_id,$val->daerah_id);
         // $temp['total_promosi'] = $val->budget_peluang + $val->budget_storyline + $val->budget_storyboard + $val->budget_lokasi + $val->budget_talent +  $val->budget_testimoni + $val->budget_audio + $val->budget_editing + $val->budget_gambar + $val->budget_video + $val->budget_editvideo + $val->budget_grafik + $val->budget_mixing + $val->budget_voice + $val->budget_subtitle;  
         return $temp;

   }

   public static function GetPrint($val)
   {

         $temp = array();

         if ($val->status_laporan_id == '14') {
            $status = 'Terkirim';
         }else{
           $status = 'Draft';
         
         };
         $temp['id'] = $val->id;
         $temp['periode_id'] = $val->periode_id;
         $temp['daerah_id'] = $val->daerah_id;
         $temp['daerah_name'] = RequestDaerah::GetDaerahWhereID($val->daerah_id);
         
         $temp['tgl_awal_rencana_kerja'] = $val->tgl_awal_rencana_kerja;
         $temp['tgl_ahir_rencana_kerja'] = $val->tgl_ahir_rencana_kerja;
         $temp['budget_rencana_kerja'] = GeneralHelpers::formatRupiah($val->budget_rencana_kerja);
         $temp['keterangan_rencana_kerja'] = $val->keterangan_rencana_kerja;


         $temp['tgl_awal_studi_literatur'] = $val->tgl_awal_studi_literatur;
         $temp['tgl_ahir_studi_literatur'] = $val->tgl_ahir_studi_literatur;
         $temp['budget_studi_literatur'] = GeneralHelpers::formatRupiah($val->budget_studi_literatur);
         $temp['keterangan_studi_literatur'] = $val->keterangan_studi_literatur;

         $temp['tgl_awal_rapat_kordinasi'] = $val->tgl_awal_rapat_kordinasi;
         $temp['tgl_ahir_rapat_kordinasi'] = $val->tgl_ahir_rapat_kordinasi;
         $temp['budget_rapat_kordinasi'] = GeneralHelpers::formatRupiah($val->budget_rapat_kordinasi);
         $temp['keterangan_rapat_kordinasi'] = $val->keterangan_rapat_kordinasi;

         $temp['tgl_awal_data_sekunder'] = $val->tgl_awal_data_sekunder;
         $temp['tgl_ahir_data_sekunder'] = $val->tgl_ahir_data_sekunder;
         $temp['budget_data_sekunder'] = GeneralHelpers::formatRupiah($val->budget_data_sekunder);
         $temp['keterangan_data_sekunder'] = $val->keterangan_data_sekunder;

            $temp['total_identifikasi'] = GeneralHelpers::formatRupiah($val->budget_rencana_kerja + $val->budget_studi_literatur + $val->budget_rapat_kordinasi + $val->budget_data_sekunder);



         $temp['tgl_awal_fgd_persiapan'] = $val->tgl_awal_fgd_persiapan;
         $temp['tgl_ahir_fgd_persiapan'] = $val->tgl_ahir_fgd_persiapan;
         $temp['budget_fgd_persiapan'] =  GeneralHelpers::formatRupiah($val->budget_fgd_persiapan);
         $temp['keterangan_fgd_persiapan'] = $val->keterangan_fgd_persiapan;

         $temp['tgl_awal_fgd_identifikasi'] = $val->tgl_awal_fgd_identifikasi;
         $temp['tgl_ahir_fgd_identifikasi'] = $val->tgl_ahir_fgd_identifikasi;
         $temp['budget_fgd_identifikasi'] = GeneralHelpers::formatRupiah($val->budget_fgd_identifikasi);
         $temp['keterangan_fgd_identifikasi'] = $val->keterangan_fgd_identifikasi;
      
         $temp['checklist_lq'] = $val->checklist_lq;
         $temp['tgl_awal_lq'] = $val->tgl_awal_lq;
         $temp['tgl_ahir_lq'] = $val->tgl_ahir_lq;
         $temp['budget_lq'] = GeneralHelpers::formatRupiah($val->budget_lq);
         // $temp['keterangan_lq'] = $val->keterangan_lq;

         $temp['checklist_shift_share'] = $val->checklist_shift_share;
         $temp['tgl_awal_shift_share'] = $val->tgl_awal_shift_share;
         $temp['tgl_ahir_shift_share'] = $val->tgl_ahir_shift_share;
         $temp['budget_shift_share'] = GeneralHelpers::formatRupiah($val->budget_shift_share);
         // $temp['keterangan_shift_share'] = $val->keterangan_shift_share;
     
         $temp['checklist_tipologi_sektor'] = $val->checklist_tipologi_sektor;
         $temp['tgl_awal_tipologi_sektor'] = $val->tgl_awal_tipologi_sektor;
         $temp['tgl_ahir_tipologi_sektor'] = $val->tgl_ahir_tipologi_sektor;
         $temp['budget_tipologi_sektor'] = GeneralHelpers::formatRupiah($val->budget_tipologi_sektor);
         // $temp['keterangan_tipologi_sektor'] = $val->keterangan_tipologi_sektor;
        
         $temp['checklist_klassen'] = $val->checklist_klassen;
         $temp['tgl_awal_klassen'] = $val->tgl_awal_klassen;
         $temp['tgl_ahir_klassen'] = $val->tgl_ahir_klassen;
         $temp['budget_klassen'] = GeneralHelpers::formatRupiah($val->budget_klassen);
         // $temp['keterangan_klassen'] = $val->keterangan_klassen;
         $temp['keterangan_pengolahan'] = $val->keterangan_pengolahan;

        

         // $temp['total_produksi'] =  GeneralHelpers::formatRupiah($val->budget_gambar + $val->budget_video);

         $temp['tgl_awal_fgd_klarifikasi'] = $val->tgl_awal_fgd_klarifikasi;
         $temp['tgl_ahir_fgd_klarifikasi'] = $val->tgl_ahir_fgd_klarifikasi;
         $temp['budget_fgd_klarifikasi'] = GeneralHelpers::formatRupiah($val->budget_fgd_klarifikasi);
         $temp['keterangan_fgd_klarifikasi'] = $val->keterangan_fgd_klarifikasi;

         $temp['tgl_awal_finalisasi'] = $val->tgl_awal_finalisasi;
         $temp['tgl_ahir_finalisasi'] = $val->tgl_ahir_finalisasi;
         $temp['budget_finalisasi'] = GeneralHelpers::formatRupiah($val->budget_finalisasi);
         $temp['keterangan_finalisasi'] = $val->keterangan_finalisasi;

         $temp['total_pelaksanaan'] = GeneralHelpers::formatRupiah($val->budget_fgd_persiapan + $val->budget_fgd_identifikasi + $val->budget_lq + $val->budget_shift_share + $val->budget_tipologi_sektor + $val->budget_klassen + $val->budget_fgd_klarifikasi + $val->budget_finalisasi);

         $temp['checklist_summary_sektor_unggulan'] = $val->checklist_summary_sektor_unggulan;
         $temp['tgl_awal_summary_sektor_unggulan'] = $val->tgl_awal_summary_sektor_unggulan;
         $temp['tgl_ahir_summary_sektor_unggulan'] = $val->tgl_ahir_summary_sektor_unggulan;
         $temp['budget_summary_sektor_unggulan'] =  GeneralHelpers::formatRupiah($val->budget_summary_sektor_unggulan);
         // $temp['keterangan_summary_sektor_unggulan'] = $val->keterangan_summary_sektor_unggulan;
       
         $temp['checklist_sektor_unggulan'] = $val->checklist_sektor_unggulan;
         $temp['tgl_awal_sektor_unggulan'] = $val->tgl_awal_sektor_unggulan;
         $temp['tgl_ahir_sektor_unggulan'] = $val->tgl_ahir_sektor_unggulan;
         $temp['budget_sektor_unggulan'] =  GeneralHelpers::formatRupiah($val->budget_sektor_unggulan);
         // $temp['keterangan_sektor_unggulan'] = $val->keterangan_sektor_unggulan;
     
         $temp['checklist_potensi_pasar'] = $val->checklist_potensi_pasar;
         $temp['tgl_awal_potensi_pasar'] = $val->tgl_awal_potensi_pasar;
         $temp['tgl_ahir_potensi_pasar'] = $val->tgl_ahir_potensi_pasar;
         $temp['budget_potensi_pasar'] =  GeneralHelpers::formatRupiah($val->budget_potensi_pasar);
         // $temp['keterangan_potensi_pasar'] = $val->keterangan_potensi_pasar;
       
         $temp['checklist_parameter_sektor_unggulan'] = $val->checklist_parameter_sektor_unggulan;
         $temp['tgl_awal_parameter_sektor_unggulan'] = $val->tgl_awal_parameter_sektor_unggulan;
         $temp['tgl_ahir_parameter_sektor_unggulan'] = $val->tgl_ahir_parameter_sektor_unggulan;
         $temp['budget_parameter_sektor_unggulan'] =  GeneralHelpers::formatRupiah($val->budget_parameter_sektor_unggulan);
         // $temp['keterangan_parameter_sektor_unggulan'] = $val->keterangan_parameter_sektor_unggulan;

         $temp['checklist_subsektor_unggulan'] = $val->checklist_subsektor_unggulan;
         $temp['tgl_awal_subsektor_unggulan'] = $val->tgl_awal_subsektor_unggulan;
         $temp['tgl_ahir_subsektor_unggulan'] = $val->tgl_ahir_subsektor_unggulan;
         $temp['budget_subsektor_unggulan'] =  GeneralHelpers::formatRupiah($val->budget_subsektor_unggulan);
         // $temp['keterangan_subsektor_unggulan'] = $val->keterangan_subsektor_unggulan;

         $temp['checklist_intensif_daerah'] = $val->checklist_intensif_daerah;
         $temp['tgl_awal_intensif_daerah'] = $val->tgl_awal_intensif_daerah;
         $temp['tgl_ahir_intensif_daerah'] = $val->tgl_ahir_intensif_daerah;
         $temp['budget_intensif_daerah'] =  GeneralHelpers::formatRupiah($val->budget_intensif_daerah);
         // $temp['keterangan_intensif_daerah'] = $val->keterangan_intensif_daerah;
       
         $temp['checklist_potensi_lanjutan'] = $val->checklist_potensi_lanjutan;
         $temp['tgl_awal_potensi_lanjutan'] = $val->tgl_awal_potensi_lanjutan;
         $temp['tgl_ahir_potensi_lanjutan'] = $val->tgl_ahir_potensi_lanjutan;
         $temp['budget_potensi_lanjutan'] =  GeneralHelpers::formatRupiah($val->budget_potensi_lanjutan);
         // $temp['keterangan_potensi_lanjutan'] = $val->keterangan_potensi_lanjutan;
         $temp['keterangan_penyusunan'] = $val->keterangan_penyusunan;

         $temp['tgl_awal_info_grafis'] = $val->tgl_awal_info_grafis;
         $temp['tgl_ahir_info_grafis'] = $val->tgl_ahir_info_grafis;
         $temp['budget_info_grafis'] =  GeneralHelpers::formatRupiah($val->budget_info_grafis);
         $temp['keterangan_info_grafis'] = $val->keterangan_info_grafis;
        
         $temp['tgl_awal_dokumentasi'] = $val->tgl_awal_dokumentasi;
         $temp['tgl_ahir_dokumentasi'] = $val->tgl_ahir_dokumentasi;
         $temp['budget_dokumentasi'] =  GeneralHelpers::formatRupiah($val->budget_dokumentasi);
         $temp['keterangan_dokumentasi'] = $val->keterangan_dokumentasi;  

         $temp['total_penyusunan'] = GeneralHelpers::formatRupiah($val->budget_summary_sektor_unggulan + $val->budget_sektor_unggulan + $val->budget_potensi_pasar + $val->budget_parameter_sektor_unggulan + $val->budget_subsektor_unggulan + $val->budget_intensif_daerah + $val->budget_potensi_lanjutan + $val->budget_info_grafis + $val->budget_dokumentasi); 


         $temp['created_by'] = $val->created_by;
         $temp['request_edit'] = $val->request_edit;
         $temp['checklist'] = $val->checklist;
         $temp['access'] = RequestAuth::Access();
         $temp['alasan'] = $val->alasan;
         $temp['status'] = array('status_db' => $val->status_laporan_id, 'status_convert' => $status);

         $temp['pagu_promosi_convert'] =  GeneralHelpers::formatRupiah(RequestPerencanaan::PaguPromosi($val->periode_id,$val->daerah_id));
         // $temp['total_promosi_convert'] = GeneralHelpers::formatRupiah($val->budget_peluang + $val->budget_storyline + $val->budget_storyboard + $val->budget_lokasi + $val->budget_talent +  $val->budget_testimoni + $val->budget_audio + $val->budget_editing + $val->budget_gambar + $val->budget_video + $val->budget_editvideo + $val->budget_grafik + $val->budget_mixing + $val->budget_voice + $val->budget_subtitle);
         $temp['pagu_promosi'] =  RequestPerencanaan::PaguPromosi($val->periode_id,$val->daerah_id);
         // $temp['total_promosi'] = $val->budget_peluang + $val->budget_storyline + $val->budget_storyboard + $val->budget_lokasi + $val->budget_talent +  $val->budget_testimoni + $val->budget_audio + $val->budget_editing + $val->budget_gambar + $val->budget_video + $val->budget_editvideo + $val->budget_grafik + $val->budget_mixing + $val->budget_voice + $val->budget_subtitle;  
         return $temp;

   }





   public static function checkValidate($status){
       
       if($status == 'Y')
       {
          $result = false;
       }else{
         $result = true;
       }  
       return $result;

   }

   public static function UploadFile($data,$id)
   {
      
      $fileDir = '/laporan/pemetaan/';
      // if($id)
      // {
      //     $data = Pemetaan::find($id);
      //     if($data->keterangan_rencana_kerja)
      //     { 
      //        File::delete(public_path() .$fileDir.$data->keterangan_rencana_kerja);
      //     } 

      //     if($data->keterangan_studi_literatur)
      //     { 
      //        File::delete(public_path() .$fileDir.$data->keterangan_studi_literatur);
      //     } 

      //      if($data->keterangan_rapat_kordinasi)
      //     { 
      //        File::delete(public_path() .$fileDir.$data->keterangan_rapat_kordinasi);
      //     } 

      //      if($data->keterangan_data_sekunder)
      //     { 
      //        File::delete(public_path() .$fileDir.$data->keterangan_data_sekunder);
      //     } 

      //     if($data->keterangan_fgd_persiapan)
      //     { 
      //        File::delete(public_path() .$fileDir.$data->keterangan_fgd_persiapan);
      //     } 

      //     if($data->keterangan_fgd_identifikasi)
      //     { 
      //        File::delete(public_path() .$fileDir.$data->keterangan_fgd_identifikasi);
      //     } 

      //     if($data->keterangan_pengolahan)
      //     { 
      //        File::delete(public_path() .$fileDir.$data->keterangan_pengolahan);
      //     } 

      //     if($data->keterangan_fgd_klarifikasi)
      //     { 
      //        File::delete(public_path() .$fileDir.$data->keterangan_fgd_klarifikasi);
      //     } 
          
      //     if($data->keterangan_finalisasi)
      //     { 
      //        File::delete(public_path() .$fileDir.$data->keterangan_finalisasi);
      //     } 

      //     if($data->keterangan_penyusunan)
      //     { 
      //        File::delete(public_path() .$fileDir.$data->keterangan_penyusunan);
      //     } 
 
      //     if($data->keterangan_info_grafis)
      //     { 
      //        File::delete(public_path() .$fileDir.$data->keterangan_info_grafis);
      //     } 

      //     if($data->keterangan_dokumentasi)
      //     { 
      //        File::delete(public_path() .$fileDir.$data->keterangan_dokumentasi);
      //     } 

          
      // }   

       $randomNumber = rand(1000, 9999); 
       $source = explode(";base64,", $data);
       $image = base64_decode($source[1]);
       $filePath = public_path() .$fileDir;
       $file =  $randomNumber . '-' . time().'.pdf';
       $success = file_put_contents($filePath.$file, $image);

       return $file;

   }

  

   public static function fieldsData($request,$id)
   {
      

      $fields = [
         'daerah_id'  =>  Auth::User()->daerah_id,
         'periode_id' => $request->periode_id,

         'tgl_awal_rencana_kerja' => $request->tgl_awal_rencana_kerja,
         'tgl_ahir_rencana_kerja' => $request->tgl_ahir_rencana_kerja,
         'budget_rencana_kerja' => $request->budget_rencana_kerja,
         'keterangan_rencana_kerja' => RequestPemetaan::UploadFile($request->keterangan_rencana_kerja,$id),

         'tgl_awal_studi_literatur' => $request->tgl_awal_studi_literatur,
         'tgl_ahir_studi_literatur' => $request->tgl_ahir_studi_literatur,
         'budget_studi_literatur' => $request->budget_studi_literatur,
         'keterangan_studi_literatur' => RequestPemetaan::UploadFile($request->keterangan_studi_literatur,$id),

         'tgl_awal_rapat_kordinasi' => $request->tgl_awal_rapat_kordinasi,
         'tgl_ahir_rapat_kordinasi' => $request->tgl_ahir_rapat_kordinasi,
         'budget_rapat_kordinasi' => $request->budget_rapat_kordinasi,
         'keterangan_rapat_kordinasi' => RequestPemetaan::UploadFile($request->keterangan_rapat_kordinasi,$id),

         'tgl_awal_data_sekunder' => $request->tgl_awal_data_sekunder,
         'tgl_ahir_data_sekunder' => $request->tgl_ahir_data_sekunder,
         'budget_data_sekunder' => $request->budget_data_sekunder,
         'keterangan_data_sekunder' => RequestPemetaan::UploadFile($request->keterangan_data_sekunder,$id),

         'tgl_awal_fgd_persiapan' => $request->tgl_awal_fgd_persiapan,
         'tgl_ahir_fgd_persiapan' => $request->tgl_ahir_fgd_persiapan,
         'budget_fgd_persiapan' => $request->budget_fgd_persiapan,
         'keterangan_fgd_persiapan' => RequestPemetaan::UploadFile($request->keterangan_fgd_persiapan,$id),

         'tgl_awal_fgd_identifikasi' => $request->tgl_awal_fgd_identifikasi,
         'tgl_ahir_fgd_identifikasi' => $request->tgl_ahir_fgd_identifikasi,
         'budget_fgd_identifikasi' => $request->budget_fgd_identifikasi,
         'keterangan_fgd_identifikasi' => RequestPemetaan::UploadFile($request->keterangan_fgd_identifikasi,$id),

      
         'checklist_lq' => $request->checklist_lq,   
         'tgl_awal_lq' => $request->tgl_awal_lq,
         'tgl_ahir_lq' => $request->tgl_ahir_lq,
         'budget_lq' => $request->budget_lq,
         // 'keterangan_lq' => $request->keterangan_lq,

         'checklist_shift_share' => $request->checklist_shift_share, 
         'tgl_awal_shift_share' => $request->tgl_awal_shift_share,
         'tgl_ahir_shift_share' => $request->tgl_ahir_shift_share,
         'budget_shift_share' => $request->budget_shift_share,
         // 'keterangan_shift_share' => $request->keterangan_shift_share,
    
         'checklist_tipologi_sektor' => $request->checklist_tipologi_sektor, 
         'tgl_awal_tipologi_sektor' => $request->tgl_awal_tipologi_sektor,
         'tgl_ahir_tipologi_sektor' => $request->tgl_ahir_tipologi_sektor,
         'budget_tipologi_sektor' => $request->budget_tipologi_sektor,
         // 'keterangan_tipologi_sektor' => $request->keterangan_tipologi_sektor,
         
         'checklist_klassen' => $request->checklist_klassen,
         'tgl_awal_klassen' => $request->tgl_awal_klassen,
         'tgl_ahir_editvideo' => $request->tgl_ahir_klassen,
         'budget_klassen' => $request->budget_klassen,
         // 'keterangan_klassen' => $request->keterangan_klassen,
         'keterangan_pengolahan' => RequestPemetaan::UploadFile($request->keterangan_pengolahan,$id),
         

         'tgl_awal_fgd_klarifikasi' => $request->tgl_awal_fgd_klarifikasi,
         'tgl_ahir_fgd_klarifikasi' => $request->tgl_ahir_fgd_klarifikasi,
         'budget_fgd_klarifikasi' => $request->budget_fgd_klarifikasi,
         'keterangan_fgd_klarifikasi' => RequestPemetaan::UploadFile($request->keterangan_fgd_klarifikasi,$id),

         'tgl_awal_finalisasi' => $request->tgl_awal_finalisasi,
         'tgl_ahir_finalisasi' => $request->tgl_ahir_finalisasi,
         'budget_finalisasi' => $request->budget_finalisasi,
         'keterangan_finalisasi' => RequestPemetaan::UploadFile($request->keterangan_finalisasi,$id),


         'checklist_summary_sektor_unggulan' => $request->checklist_summary_sektor_unggulan, 
         'tgl_awal_summary_sektor_unggulan' => $request->tgl_awal_summary_sektor_unggulan,
         'tgl_ahir_summary_sektor_unggulan' => $request->tgl_ahir_summary_sektor_unggulan,
         'budget_summary_sektor_unggulan' => $request->budget_summary_sektor_unggulan,
         // 'keterangan_summary_sektor_unggulan' => $request->keterangan_summary_sektor_unggulan,
        
         'checklist_sektor_unggulan' => $request->checklist_sektor_unggulan, 
         'tgl_awal_sektor_unggulan' => $request->tgl_awal_sektor_unggulan,
         'tgl_ahir_sektor_unggulan' => $request->tgl_ahir_sektor_unggulan,
         'budget_sektor_unggulan' => $request->budget_sektor_unggulan,
         // 'keterangan_sektor_unggulan' => $request->keterangan_sektor_unggulan,
     
         'checklist_potensi_pasar' => $request->checklist_potensi_pasar, 
         'tgl_awal_potensi_pasar' => $request->tgl_awal_potensi_pasar,
         'tgl_ahir_potensi_pasar' => $request->tgl_ahir_potensi_pasar,
         'budget_potensi_pasar' => $request->budget_potensi_pasar,
         // 'keterangan_potensi_pasar' => $request->keterangan_potensi_pasar,
       
         'checklist_parameter_sektor_unggulan' => $request->checklist_parameter_sektor_unggulan,
         'tgl_awal_parameter_sektor_unggulan' => $request->tgl_awal_parameter_sektor_unggulan,
         'tgl_ahir_parameter_sektor_unggulan' => $request->tgl_ahir_parameter_sektor_unggulan,
         'budget_parameter_sektor_unggulan' => $request->budget_parameter_sektor_unggulan,
         // 'keterangan_parameter_sektor_unggulan' => $request->keterangan_parameter_sektor_unggulan,
         
         'checklist_subsektor_unggulan' => $request->checklist_subsektor_unggulan,
         'tgl_awal_subsektor_unggulan' => $request->tgl_awal_subsektor_unggulan,
         'tgl_ahir_subsektor_unggulan' => $request->tgl_ahir_subsektor_unggulan,
         'budget_subsektor_unggulan' => $request->budget_subsektor_unggulan,
         // 'keterangan_subsektor_unggulan' => $request->keterangan_subsektor_unggulan,
 
         'checklist_intensif_daerah' => $request->checklist_intensif_daerah,
         'tgl_awal_intensif_daerah' => $request->tgl_awal_intensif_daerah,
         'tgl_ahir_intensif_daerah' => $request->tgl_ahir_intensif_daerah,
         'budget_intensif_daerah' => $request->budget_intensif_daerah,
         // 'keterangan_intensif_daerah' => $request->keterangan_intensif_daerah,
         
         'checklist_potensi_lanjutan' => $request->checklist_potensi_lanjutan,
         'tgl_awal_potensi_lanjutan' => $request->tgl_awal_potensi_lanjutan,
         'tgl_ahir_potensi_lanjutan' => $request->tgl_ahir_potensi_lanjutan,
         'budget_potensi_lanjutan' => $request->budget_potensi_lanjutan,
         // 'keterangan_potensi_lanjutan' => $request->keterangan_potensi_lanjutan
         'keterangan_penyusunan' => RequestPemetaan::UploadFile($request->keterangan_penyusunan,$id),

         
         'tgl_awal_info_grafis' => $request->tgl_awal_info_grafis,
         'tgl_ahir_info_grafis' => $request->tgl_ahir_info_grafis,
         'budget_info_grafis' => $request->budget_info_grafis,
         'keterangan_info_grafis' => RequestPemetaan::UploadFile($request->keterangan_info_grafis,$id),

         'tgl_awal_dokumentasi' => $request->tgl_awal_dokumentasi,
         'tgl_ahir_dokumentasi' => $request->tgl_ahir_dokumentasi,
         'budget_dokumentasi' => $request->budget_dokumentasi,
         'keterangan_dokumentasi' => RequestPemetaan::UploadFile($request->keterangan_dokumentasi,$id),




         'status_laporan_id' => $request->status_laporan_id,
         'request_edit'=>'false',
         'created_by' => Auth::User()->username,
         'created_at' => date('Y-m-d H:i:s'),
      ];

      return $fields;
   }

   
}

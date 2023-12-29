<?php

namespace App\Http\Request;

use DB;
use Auth;
use App\Helpers\GeneralHelpers;
use App\Helpers\ConfigFile;
use App\Models\PaguTarget;
use App\Models\Pemetaan;
use App\Http\Request\RequestDaerah;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestMenuRoles;
use App\Http\Request\RequestPaguTarget;
use File;
use Illuminate\Support\Str;
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

         // $description =  $val->alasan;
         // if (strlen($description) > 30) {
         //     $description = substr($description, 0, 30) . "...";
         // }

         if($val->checklist =='not_approved')
         {
            $checklist = 'proses';
         }else if($val->checklist =='approved'){
            $checklist = 'approved';
         }else{
            $checklist = '';
         }   


         $default = '';
         $daerah_id = $val->daerah_id;
         $periode_id = $val->periode_id;
         if($val->keterangan_potensi)
         {
             $potensi = url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_potensi);
            
         }else{
             $potensi  = $default;
           
         }

         if($val->keterangan_fgd_persiapan)
         {
             $fgd_persiapan = url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_fgd_persiapan);
            
         }else{
             $fgd_persiapan  = $default;
              
         }

         if($val->keterangan_fgd_identifikasi)
         {
             $fgd_identifikasi = url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_fgd_identifikasi); 
         }else{
             $fgd_identifikasi  = $default;
             
         } 


         if($val->keterangan_sektor)
         {
             $keterangan_sektor = url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_sektor); 
         }else{
             $keterangan_sektor  = $default;
             
         } 


         if($val->keterangan_fgd_klarifikasi)
         {
             $keterangan_fgd_klarifikasi = url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_fgd_klarifikasi); 
         }else{
             $keterangan_fgd_klarifikasi  = $default;
             
         }  

          if($val->keterangan_finalisasi)
         {
             $keterangan_finalisasi = url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_finalisasi); 
         }else{
             $keterangan_finalisasi  = $default;
             
         }  

          if($val->keterangan_penyusunan)
         {
             $keterangan_penyusunan = url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_penyusunan); 
         }else{
             $keterangan_penyusunan  = $default;
             
         }  

         if($val->keterangan_info_grafis)
         {
             $keterangan_info_grafis = url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_info_grafis); 
         }else{
             $keterangan_info_grafis  = $default;
             
         }  

         if($val->keterangan_dokumentasi)
         {
             $keterangan_dokumentasi = url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_dokumentasi); 
         }else{
             $keterangan_dokumentasi  = $default;
             
         }  
         

        

         $temp[$key]['number'] = $numberNext++;
         $temp[$key]['id'] = $val->id;
       
         $temp[$key]['daerah_name'] = RequestDaerah::GetDaerahWhereID($val->daerah_id);
         $temp[$key]['access'] = $access;
         $temp[$key]['checklist'] = $checklist;
         $temp[$key]['periode_id'] = $val->periode_id;
         $temp[$key]['daerah_id'] = $val->daerah_id;
         


         $temp[$key]['checklist_rk'] = $val->checklist_rk;
         $temp[$key]['checklist_sl'] = $val->checklist_sl;
         $temp[$key]['checklist_kor'] = $val->checklist_kor;
         $temp[$key]['checklist_ds'] = $val->checklist_ds;
         
         $temp[$key]['tgl_awal_potensi'] = $val->tgl_awal_potensi;
         $temp[$key]['tgl_ahir_potensi'] = $val->tgl_ahir_potensi;
         $temp[$key]['budget_potensi'] = $val->budget_potensi;
         $temp[$key]['realisasi_potensi'] = $val->realisasi_potensi;
         $temp[$key]['keterangan_potensi'] =$potensi;  

         $temp[$key]['total_budget_potensi'] = ['original'=>$val->budget_potensi,'convert'=>GeneralHelpers::formatRupiah($val->budget_potensi)];
         $temp[$key]['total_realisasi_potensi'] = GeneralHelpers::formatRupiah($val->realisasi_potensi);





         $temp[$key]['tgl_awal_fgd_persiapan'] = $val->tgl_awal_fgd_persiapan;
         $temp[$key]['tgl_ahir_fgd_persiapan'] = $val->tgl_ahir_fgd_persiapan;
         $temp[$key]['budget_fgd_persiapan'] = $val->budget_fgd_persiapan;
         $temp[$key]['realisasi_fgd_persiapan'] = $val->realisasi_fgd_persiapan;
         $temp[$key]['keterangan_fgd_persiapan'] = $fgd_persiapan;

         $temp[$key]['tgl_awal_fgd_identifikasi'] = $val->tgl_awal_fgd_identifikasi;
         $temp[$key]['tgl_ahir_fgd_identifikasi'] = $val->tgl_ahir_fgd_identifikasi;
         $temp[$key]['budget_fgd_identifikasi'] = $val->budget_fgd_identifikasi;
         $temp[$key]['realisasi_fgd_identifikasi'] = $val->realisasi_fgd_identifikasi;
         $temp[$key]['keterangan_fgd_identifikasi'] = $fgd_identifikasi;



         $temp[$key]['checklist_lq'] = $val->checklist_lq;
         $temp[$key]['checklist_shift_share'] = $val->checklist_shift_share;
         $temp[$key]['checklist_tipologi_sektor'] = $val->checklist_tipologi_sektor;
         $temp[$key]['checklist_klassen'] = $val->checklist_klassen;

         
         $temp[$key]['tgl_awal_sektor'] = $val->tgl_awal_sektor;
         $temp[$key]['tgl_ahir_sektor'] = $val->tgl_ahir_sektor;
         $temp[$key]['budget_sektor'] = $val->budget_sektor;
         $temp[$key]['realisasi_sektor'] = $val->realisasi_sektor;
         $temp[$key]['keterangan_sektor'] = $keterangan_sektor;
         
         $temp[$key]['total_budget_analisis'] =  GeneralHelpers::formatRupiah($val->budget_sektor);
         $temp[$key]['total_realisasi_analisis'] = GeneralHelpers::formatRupiah($val->realisasi_sektor);



         $temp[$key]['tgl_awal_fgd_klarifikasi'] = $val->tgl_awal_fgd_klarifikasi;
         $temp[$key]['tgl_ahir_fgd_klarifikasi'] = $val->tgl_ahir_fgd_klarifikasi;
         $temp[$key]['budget_fgd_klarifikasi'] = $val->budget_fgd_klarifikasi;
         $temp[$key]['realisasi_fgd_klarifikasi'] = $val->realisasi_fgd_klarifikasi;
         $temp[$key]['keterangan_fgd_klarifikasi'] = $keterangan_fgd_klarifikasi;


         $temp[$key]['tgl_awal_finalisasi'] = $val->tgl_awal_finalisasi;
         $temp[$key]['tgl_ahir_finalisasi'] = $val->tgl_ahir_finalisasi;
         $temp[$key]['budget_finalisasi'] = $val->budget_finalisasi;
         $temp[$key]['realisasi_finalisasi'] = $val->realisasi_finalisasi;
         $temp[$key]['keterangan_finalisasi'] = $keterangan_finalisasi;
        


         $temp[$key]['total_budget_pelaksanaan'] = ['original'=>$val->budget_fgd_persiapan + $val->budget_fgd_identifikasi + $val->budget_sektor + $val->budget_fgd_klarifikasi + $val->budget_finalisasi,'convert'=>GeneralHelpers::formatRupiah($val->budget_fgd_persiapan + $val->budget_fgd_identifikasi + $val->budget_sektor + $val->budget_fgd_klarifikasi + $val->budget_finalisasi)]; 

          $temp[$key]['total_realisasi_pelaksanaan'] = GeneralHelpers::formatRupiah($val->realisasi_fgd_persiapan + $val->realisasi_fgd_identifikasi + $val->realisasi_sektor + $val->realisasi_fgd_klarifikasi + $val->realisasi_finalisasi); 

         $temp[$key]['checklist_summary_sektor_unggulan'] = $val->checklist_summary_sektor_unggulan;
         $temp[$key]['checklist_sektor_unggulan'] = $val->checklist_sektor_unggulan;
         $temp[$key]['checklist_potensi_pasar'] = $val->checklist_potensi_pasar;
         $temp[$key]['checklist_parameter_sektor_unggulan'] = $val->checklist_parameter_sektor_unggulan;
         $temp[$key]['checklist_subsektor_unggulan'] = $val->checklist_subsektor_unggulan;
         $temp[$key]['checklist_intensif_daerah'] = $val->checklist_intensif_daerah;
         $temp[$key]['checklist_potensi_lanjutan'] = $val->checklist_potensi_lanjutan;


         $temp[$key]['tgl_awal_penyusunan'] = $val->tgl_awal_penyusunan;
         $temp[$key]['tgl_ahir_penyusunan'] = $val->tgl_ahir_penyusunan;
         $temp[$key]['budget_penyusunan'] = $val->budget_penyusunan;
         $temp[$key]['realisasi_penyusunan'] = $val->realisasi_penyusunan;
         $temp[$key]['keterangan_penyusunan'] = $keterangan_penyusunan;

         $temp[$key]['total_analisis_doc'] = GeneralHelpers::formatRupiah($val->budget_penyusunan);

         $temp[$key]['total_budget_penyusunan'] = ['original'=>$val->budget_penyusunan + $val->budget_info_grafis + $val->budget_dokumentasi,'convert'=>GeneralHelpers::formatRupiah($val->budget_penyusunan + $val->budget_info_grafis + $val->budget_dokumentasi)];

         $temp[$key]['total_realisasi_penyusunan'] = GeneralHelpers::formatRupiah($val->realisasi_penyusunan + $val->realisasi_info_grafis + $val->realisasi_dokumentasi);

         $temp[$key]['tgl_awal_info_grafis'] = $val->tgl_awal_info_grafis;
         $temp[$key]['tgl_ahir_info_grafis'] = $val->tgl_ahir_info_grafis;
         $temp[$key]['budget_info_grafis'] = $val->budget_info_grafis;
          $temp[$key]['realisasi_info_grafis'] = $val->realisasi_info_grafis;
         $temp[$key]['keterangan_info_grafis'] = $keterangan_info_grafis;

         $temp[$key]['tgl_awal_dokumentasi'] = $val->tgl_awal_dokumentasi;
         $temp[$key]['tgl_ahir_dokumentasi'] = $val->tgl_ahir_dokumentasi;
         $temp[$key]['budget_dokumentasi'] = $val->budget_dokumentasi;
          $temp[$key]['realisasi_dokumentasi'] = $val->realisasi_dokumentasi;
         $temp[$key]['keterangan_dokumentasi'] = $keterangan_dokumentasi;



           
         $temp[$key]['total_budget'] = GeneralHelpers::formatRupiah($val->budget_potensi + $val->budget_fgd_persiapan + $val->budget_fgd_identifikasi + $val->budget_sektor + $val->budget_fgd_klarifikasi + $val->budget_finalisasi + $val->budget_penyusunan + $val->budget_info_grafis +  $val->budget_dokumentasi);  

         $temp[$key]['created_by'] = $val->created_by;
         $temp[$key]['request_edit'] = $val->request_edit;
         $temp[$key]['status_laporan_id'] = $val->status_laporan_id;
         $temp[$key]['alasan'] = $val->alasan;

      
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
               
                    $result['total_budget_pemetaan'] = GeneralHelpers::formatRupiah(RequestPemetaan::TotalBudgetPemetaan($year,Auth::User()->daerah_id));
                     $result['total_realisasi_pemetaan'] = GeneralHelpers::formatRupiah(RequestPemetaan::TotalRealisasiPemetaan($year,Auth::User()->daerah_id));
              
           }else{


               $result['pagu_pemetaan'] = GeneralHelpers::formatRupiah(RequestPerencanaan::PaguPromosi($year,Auth::User()->daerah_id));

                   $result['total_budget_pemetaan'] = GeneralHelpers::formatRupiah(RequestPemetaan::TotalBudgetPemetaan($year,Auth::User()->daerah_id));
                   $result['total_realisasi_pemetaan'] = GeneralHelpers::formatRupiah(RequestPemetaan::TotalRealisasiPemetaan($year,Auth::User()->daerah_id));
              

               
           } 
         
      }else{
          $result['periode_id'] = $year;
          $result['pagu_pemetaan'] = 'Rp 0';
          $result['total_budget_pemetaan'] =  'Rp 0';
          $result['total_realisasi_pemetaan'] = 'Rp 0'; 
      }

      if($access =="pusat" || $access =="admin")
      {  

      $result['total_daerah'] = Pemetaan::where('periode_id',$year)->groupBy('daerah_id')->count();
      $result['total_requestedit'] = Pemetaan::where(['request_edit'=>'true','periode_id'=>$year])->count();
      $result['total_draft'] = Pemetaan::where(['status_laporan_id'=>'13','periode_id'=>$year])->count();
      $result['total_terkirim'] = Pemetaan::where(['status_laporan_id'=>'14','periode_id'=>$year])->count();
      }

      $result['options'] = RequestMenuRoles::ActionPage('peta-potensi');
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

   public static function TotalBudgetPemetaan($year,$daerah_id){

     $access = RequestAuth::Access();  
     if($access =='province')
     {
        $data = Pemetaan::select(DB::raw('SUM(budget_potensi + budget_fgd_persiapan + budget_fgd_identifikasi + budget_sektor + budget_fgd_klarifikasi + budget_finalisasi + budget_penyusunan + budget_info_grafis +  budget_dokumentasi) as total '))->where(['periode_id'=>$year,'daerah_id'=>$daerah_id])->first()->total;

       
     }else if($access =='pusat'){

         $data = Pemetaan::select(DB::raw('SUM(budget_potensi  + budget_fgd_persiapan + budget_fgd_identifikasi + budget_sektor  + budget_fgd_klarifikasi + budget_finalisasi + budget_penyusunan + budget_info_grafis +  budget_dokumentasi) as total '))->where(['periode_id'=>$year])->first()->total;

       

     } 
 
         return $data;
   }

    public static function TotalRealisasiPemetaan($year,$daerah_id){

     $access = RequestAuth::Access();  
     if($access =='province')
     {
        $data = Pemetaan::select(DB::raw('SUM(realisasi_potensi + realisasi_fgd_persiapan + realisasi_fgd_identifikasi + realisasi_sektor + realisasi_fgd_klarifikasi + realisasi_finalisasi + realisasi_penyusunan + realisasi_info_grafis +  realisasi_dokumentasi) as total '))->where(['periode_id'=>$year,'daerah_id'=>$daerah_id])->first()->total;

       
     }else if($access =='pusat'){

         $data = Pemetaan::select(DB::raw('SUM(realisasi_potensi + realisasi_fgd_persiapan + realisasi_fgd_identifikasi + realisasi_sektor + realisasi_fgd_klarifikasi + realisasi_finalisasi + realisasi_penyusunan + realisasi_info_grafis +  realisasi_dokumentasi) as total '))->where(['periode_id'=>$year])->first()->total;

       

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
         $default = '';
         $daerah_id = $val->daerah_id;
         $periode_id = $val->periode_id;
         if($val->keterangan_potensi)
         {
             $potensi = url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_potensi);
             $temp['btn_potensi'] = 'true';
         }else{
            $potensi  = $default;
            $temp['btn_potensi'] =  'false'; 
         }  

         


         if($val->keterangan_fgd_persiapan)
         {
             $fgd_persiapan = url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_fgd_persiapan);
             $temp['btn_fgd_persiapan'] = 'true';
         }else{
             $fgd_persiapan  = $default;
             $temp['btn_fgd_persiapan'] =  'false';  
         }    

         if($val->keterangan_fgd_identifikasi)
         {
             $fgd_identifikasi = url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_fgd_identifikasi);
             $temp['btn_fgd_identifikasi'] = 'true';
         }else{
             $fgd_identifikasi  = $default;
             $temp['btn_fgd_identifikasi'] =  'false';  
         }

         if($val->keterangan_sektor)
         {
             $sektor = url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_sektor);
             $temp['btn_sektor'] = 'true';
         }else{
             $sektor  = $default;
             $temp['btn_sektor'] =  'false'; 
         }        

         if($val->keterangan_fgd_klarifikasi)
         {
             $fgd_klarifikasi = url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_fgd_klarifikasi);
             $temp['btn_fgd_klarifikasi'] = 'true';
         }else{
             $fgd_klarifikasi  = $default;
             $temp['btn_fgd_klarifikasi'] =  'false'; 
         }  
        
         if($val->keterangan_finalisasi)
         {
             $finalisasi = url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_finalisasi);
             $temp['btn_finalisasi'] = 'true';
         }else{
             $finalisasi  = $default;
             $temp['btn_finalisasi'] =  'false';
         }  
         
         if($val->keterangan_penyusunan)
         {
             $penyusunan = url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_penyusunan);
             $temp['btn_penyusunan'] = 'true';
         }else{
             $penyusunan  = $default;
             $temp['btn_penyusunan'] =  'false';
         }

         if($val->keterangan_info_grafis)
         {
             $info_grafis =  url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_info_grafis);
             $temp['btn_info_grafis'] = 'true';
         }else{
             $info_grafis  = $default;
             $temp['btn_info_grafis'] =  'false';
         }
         
         if($val->keterangan_dokumentasi)
         {
             $dokumentasi =  url('laporan/pemetaan/'. $periode_id.'/'.$daerah_id.'/'.$val->keterangan_dokumentasi);
             $temp['btn_dokumentasi'] = 'true';

         }else{
             $dokumentasi  = $default;
             $temp['btn_dokumentasi'] =  'false';
         }
         
        
      

         $temp['id'] = $val->id;
         $temp['periode_id'] = $val->periode_id;
         $temp['daerah_id'] = $val->daerah_id;
         $temp['daerah_name'] = RequestDaerah::GetDaerahWhereID($val->daerah_id);

         $temp['checklist_rk'] = $val->checklist_rk;
         $temp['checklist_sl'] = $val->checklist_sl;
         $temp['checklist_kor'] = $val->checklist_kor;
         $temp['checklist_ds'] = $val->checklist_ds;
        
         $temp['tgl_awal_potensi'] = $val->tgl_awal_potensi;
         $temp['tgl_ahir_potensi'] = $val->tgl_ahir_potensi;
         $temp['budget_potensi'] =  $val->budget_potensi;
         $temp['realisasi_potensi'] =  $val->realisasi_potensi;
         $temp['keterangan_potensi'] = $potensi;
         $temp['total_budget_potensi'] = GeneralHelpers::formatRupiah($val->budget_potensi);
         $temp['total_realisasi_potensi'] = GeneralHelpers::formatRupiah($val->realisasi_potensi);



         $temp['tgl_awal_fgd_persiapan'] = $val->tgl_awal_fgd_persiapan;
         $temp['tgl_ahir_fgd_persiapan'] = $val->tgl_ahir_fgd_persiapan;
         $temp['budget_fgd_persiapan'] =  $val->budget_fgd_persiapan;
         $temp['realisasi_fgd_persiapan'] =  $val->realisasi_fgd_persiapan;
         $temp['keterangan_fgd_persiapan'] =$fgd_persiapan;  

         $temp['tgl_awal_fgd_identifikasi'] = $val->tgl_awal_fgd_identifikasi;
         $temp['tgl_ahir_fgd_identifikasi'] = $val->tgl_ahir_fgd_identifikasi;
         $temp['budget_fgd_identifikasi'] = $val->budget_fgd_identifikasi;
         $temp['realisasi_fgd_identifikasi'] = $val->realisasi_fgd_identifikasi;
         $temp['keterangan_fgd_identifikasi'] = $fgd_identifikasi;
      
         $temp['checklist_lq'] = $val->checklist_lq;
         $temp['checklist_shift_share'] = $val->checklist_shift_share;
         $temp['checklist_tipologi_sektor'] = $val->checklist_tipologi_sektor;
         $temp['checklist_klassen'] = $val->checklist_klassen;
         


         $temp['tgl_awal_sektor'] = $val->tgl_awal_sektor;
         $temp['tgl_ahir_sektor'] = $val->tgl_ahir_sektor;
         $temp['budget_sektor'] = $val->budget_sektor;
         $temp['realisasi_sektor'] = $val->realisasi_sektor;
         $temp['keterangan_sektor'] = $sektor;

    
        

         $temp['tgl_awal_fgd_klarifikasi'] = $val->tgl_awal_fgd_klarifikasi;
         $temp['tgl_ahir_fgd_klarifikasi'] = $val->tgl_ahir_fgd_klarifikasi;
         $temp['budget_fgd_klarifikasi'] =$val->budget_fgd_klarifikasi;
         $temp['realisasi_fgd_klarifikasi'] =$val->realisasi_fgd_klarifikasi;
         $temp['keterangan_fgd_klarifikasi'] = $fgd_klarifikasi;  

         $temp['tgl_awal_finalisasi'] = $val->tgl_awal_finalisasi;
         $temp['tgl_ahir_finalisasi'] = $val->tgl_ahir_finalisasi;
         $temp['budget_finalisasi'] = $val->budget_finalisasi;
         $temp['realisasi_finalisasi'] = $val->realisasi_finalisasi;
         $temp['keterangan_finalisasi'] = $finalisasi; 

         $temp['total_budget_pelaksanaan'] = GeneralHelpers::formatRupiah($val->budget_fgd_persiapan + $val->budget_fgd_identifikasi + $val->budget_sektor + $val->budget_fgd_klarifikasi + $val->budget_finalisasi);

          $temp['total_realisasi_pelaksanaan'] = GeneralHelpers::formatRupiah($val->realisasi_fgd_persiapan + $val->realisasi_fgd_identifikasi + $val->realisasi_sektor + $val->realisasi_fgd_klarifikasi + $val->realisasi_finalisasi);

         $temp['checklist_summary_sektor_unggulan'] = $val->checklist_summary_sektor_unggulan;
         $temp['checklist_sektor_unggulan'] = $val->checklist_sektor_unggulan;
         $temp['checklist_potensi_pasar'] = $val->checklist_potensi_pasar;        
         $temp['checklist_parameter_sektor_unggulan'] = $val->checklist_parameter_sektor_unggulan;
         $temp['checklist_subsektor_unggulan'] = $val->checklist_subsektor_unggulan;
         $temp['checklist_intensif_daerah'] = $val->checklist_intensif_daerah;
         $temp['checklist_potensi_lanjutan'] = $val->checklist_potensi_lanjutan;
       
         $temp['tgl_awal_penyusunan'] = $val->tgl_awal_penyusunan;
         $temp['tgl_ahir_penyusunan'] = $val->tgl_ahir_penyusunan; 
         $temp['budget_penyusunan'] = $val->budget_penyusunan;
         $temp['realisasi_penyusunan'] = $val->realisasi_penyusunan; 
         $temp['keterangan_penyusunan'] = $penyusunan; 

         $temp['tgl_awal_info_grafis'] = $val->tgl_awal_info_grafis;
         $temp['tgl_ahir_info_grafis'] = $val->tgl_ahir_info_grafis;
         $temp['budget_info_grafis'] =  $val->budget_info_grafis;
         $temp['realisasi_info_grafis'] =  $val->realisasi_info_grafis;
         $temp['keterangan_info_grafis'] = $info_grafis;
        
         $temp['tgl_awal_dokumentasi'] = $val->tgl_awal_dokumentasi;
         $temp['tgl_ahir_dokumentasi'] = $val->tgl_ahir_dokumentasi;
         $temp['budget_dokumentasi'] = $val->budget_dokumentasi;
         $temp['realisasi_dokumentasi'] = $val->realisasi_dokumentasi;
         $temp['keterangan_dokumentasi'] = $dokumentasi;   

         $temp['total_budget_penyusunan'] = GeneralHelpers::formatRupiah($val->budget_penyusunan + $val->budget_info_grafis + $val->budget_dokumentasi); 

         $temp['total_realisasi_penyusunan'] = GeneralHelpers::formatRupiah($val->realisasi_penyusunan + $val->realisasi_info_grafis + $val->realisasi_dokumentasi); 


         $temp['created_by'] = $val->created_by;
         $temp['request_edit'] = $val->request_edit;
         $temp['checklist'] = $val->checklist;
         $temp['access'] = RequestAuth::Access();
         $temp['alasan'] = $val->alasan;
         $temp['status'] = array('status_db' => $val->status_laporan_id, 'status_convert' => $status);

       
        
       
        
         $temp['pagu_pemetaan'] =  [
                        'original'=>RequestPerencanaan::PaguPromosi($val->periode_id,$val->daerah_id),
                        'convert'=> GeneralHelpers::formatRupiah(RequestPerencanaan::PaguPromosi($val->periode_id,$val->daerah_id))];
         $temp['total_budget_pemetaan'] = [
            'original'=>$val->budget_potensi + $val->budget_fgd_persiapan + $val->budget_fgd_identifikasi + $val->budget_sektor + $val->budget_fgd_klarifikasi + $val->budget_finalisasi + $val->budget_penyusunan + $val->budget_info_grafis + $val->budget_dokumentasi,
            'convert'=> GeneralHelpers::formatRupiah($val->budget_potensi + $val->budget_fgd_persiapan + $val->budget_fgd_identifikasi + $val->budget_sektor + $val->budget_fgd_klarifikasi + $val->budget_finalisasi + $val->budget_penyusunan + $val->budget_info_grafis + $val->budget_dokumentasi
                )]; 

         $temp['total_realisasi_pemetaan'] = [
            'original'=>$val->realisasi_potensi + $val->realisasi_fgd_persiapan + $val->realisasi_fgd_identifikasi + $val->realisasi_sektor + $val->realisasi_fgd_klarifikasi + $val->realisasi_finalisasi + $val->realisasi_penyusunan + $val->realisasi_info_grafis + $val->realisasi_dokumentasi,
            'convert'=> GeneralHelpers::formatRupiah($val->realisasi_potensi + $val->realisasi_fgd_persiapan + $val->realisasi_fgd_identifikasi + $val->realisasi_sektor + $val->realisasi_fgd_klarifikasi + $val->realisasi_finalisasi + $val->realisasi_penyusunan + $val->realisasi_info_grafis + $val->realisasi_dokumentasi)];  
 



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

         $temp['checklist_rk'] = $val->checklist_rk;
         $temp['checklist_sl'] = $val->checklist_sl;
         $temp['checklist_kor'] = $val->checklist_kor;
         $temp['checklist_ds'] = $val->checklist_ds;
         
         
         $temp['tgl_awal_potensi'] = $val->tgl_awal_potensi;
         $temp['tgl_ahir_potensi'] = $val->tgl_ahir_potensi;
         $temp['budget_potensi'] = GeneralHelpers::formatRupiah($val->budget_potensi);
         $temp['realisasi_potensi'] = GeneralHelpers::formatRupiah($val->realisasi_potensi);
         $temp['keterangan_rencana_kerja'] = $val->keterangan_potensi;


         $temp['total_budget_identifikasi'] = GeneralHelpers::formatRupiah($val->budget_potensi);
         $temp['total_realisasi_identifikasi'] = GeneralHelpers::formatRupiah($val->realisasi_potensi);

         $temp['tgl_awal_fgd_persiapan'] = $val->tgl_awal_fgd_persiapan;
         $temp['tgl_ahir_fgd_persiapan'] = $val->tgl_ahir_fgd_persiapan;
         $temp['budget_fgd_persiapan'] =  GeneralHelpers::formatRupiah($val->budget_fgd_persiapan);
         $temp['realisasi_fgd_persiapan'] =  GeneralHelpers::formatRupiah($val->realisasi_fgd_persiapan);
         $temp['keterangan_fgd_persiapan'] = $val->keterangan_fgd_persiapan;

         $temp['tgl_awal_fgd_identifikasi'] = $val->tgl_awal_fgd_identifikasi;
         $temp['tgl_ahir_fgd_identifikasi'] = $val->tgl_ahir_fgd_identifikasi;
         $temp['budget_fgd_identifikasi'] = GeneralHelpers::formatRupiah($val->budget_fgd_identifikasi);
         $temp['realisasi_fgd_identifikasi'] = GeneralHelpers::formatRupiah($val->realisasi_fgd_identifikasi);
         $temp['keterangan_fgd_identifikasi'] = $val->keterangan_fgd_identifikasi;
      
         $temp['checklist_lq'] = $val->checklist_lq;
         $temp['checklist_shift_share'] = $val->checklist_shift_share;         
         $temp['checklist_tipologi_sektor'] = $val->checklist_tipologi_sektor;
         $temp['checklist_klassen'] = $val->checklist_klassen;


         $temp['tgl_awal_sektor'] = $val->tgl_awal_sektor;
         $temp['tgl_ahir_sektor'] = $val->tgl_ahir_sektor;
         $temp['budget_sektor'] = GeneralHelpers::formatRupiah($val->budget_sektor);
         $temp['realisasi_sektor'] = GeneralHelpers::formatRupiah($val->realisasi_sektor);
         $temp['keterangan_sektor'] = $val->keterangan_sektor;

        



         $temp['tgl_awal_fgd_klarifikasi'] = $val->tgl_awal_fgd_klarifikasi;
         $temp['tgl_ahir_fgd_klarifikasi'] = $val->tgl_ahir_fgd_klarifikasi;
         $temp['budget_fgd_klarifikasi'] = GeneralHelpers::formatRupiah($val->budget_fgd_klarifikasi);
         $temp['realisasi_fgd_klarifikasi'] = GeneralHelpers::formatRupiah($val->realisasi_fgd_klarifikasi);
         $temp['keterangan_fgd_klarifikasi'] = $val->keterangan_fgd_klarifikasi;

         $temp['tgl_awal_finalisasi'] = $val->tgl_awal_finalisasi;
         $temp['tgl_ahir_finalisasi'] = $val->tgl_ahir_finalisasi;
         $temp['budget_finalisasi'] = GeneralHelpers::formatRupiah($val->budget_finalisasi);
         $temp['realisasi_finalisasi'] = GeneralHelpers::formatRupiah($val->realisasi_finalisasi);
         $temp['keterangan_finalisasi'] = $val->keterangan_finalisasi;

         $temp['total_budget_pelaksanaan'] = GeneralHelpers::formatRupiah($val->budget_fgd_persiapan + $val->budget_fgd_identifikasi + $val->budget_sektor + $val->budget_fgd_klarifikasi + $val->budget_finalisasi);

        $temp['total_realisasi_pelaksanaan'] = GeneralHelpers::formatRupiah($val->realisasi_fgd_persiapan + $val->realisasi_fgd_identifikasi + $val->realisasi_sektor + $val->realisasi_fgd_klarifikasi + $val->realisasi_finalisasi);

         $temp['checklist_summary_sektor_unggulan'] = $val->checklist_summary_sektor_unggulan;
         $temp['checklist_sektor_unggulan'] = $val->checklist_sektor_unggulan;
         $temp['checklist_potensi_pasar'] = $val->checklist_potensi_pasar;
         $temp['checklist_parameter_sektor_unggulan'] = $val->checklist_parameter_sektor_unggulan;
         $temp['checklist_subsektor_unggulan'] = $val->checklist_subsektor_unggulan;
         $temp['checklist_intensif_daerah'] = $val->checklist_intensif_daerah;
         $temp['checklist_potensi_lanjutan'] = $val->checklist_potensi_lanjutan;

         $temp['tgl_awal_penyusunan'] = $val->tgl_awal_penyusunan;
         $temp['tgl_ahir_penyusunan'] = $val->tgl_ahir_penyusunan;
         $temp['budget_penyusunan'] =  GeneralHelpers::formatRupiah($val->budget_penyusunan);
         $temp['realisasi_penyusunan'] =  GeneralHelpers::formatRupiah($val->realisasi_penyusunan);
         $temp['keterangan_penyusunan'] = $val->keterangan_penyusunan;
         

         $temp['tgl_awal_info_grafis'] = $val->tgl_awal_info_grafis;
         $temp['tgl_ahir_info_grafis'] = $val->tgl_ahir_info_grafis;
         $temp['budget_info_grafis'] =  GeneralHelpers::formatRupiah($val->budget_info_grafis);
         $temp['realisasi_info_grafis'] =  GeneralHelpers::formatRupiah($val->realisasi_info_grafis);
         $temp['keterangan_info_grafis'] = $val->keterangan_info_grafis;
        
         $temp['tgl_awal_dokumentasi'] = $val->tgl_awal_dokumentasi;
         $temp['tgl_ahir_dokumentasi'] = $val->tgl_ahir_dokumentasi;
         $temp['budget_dokumentasi'] =  GeneralHelpers::formatRupiah($val->budget_dokumentasi);
         $temp['realisasi_dokumentasi'] =  GeneralHelpers::formatRupiah($val->realisasi_dokumentasi);
         $temp['keterangan_dokumentasi'] = $val->keterangan_dokumentasi;  

         $temp['total_budget_penyusunan'] = GeneralHelpers::formatRupiah($val->budget_penyusunan + $val->budget_info_grafis + $val->budget_dokumentasi); 

          $temp['total_realisasi_penyusunan'] = GeneralHelpers::formatRupiah($val->realisasi_penyusunan + $val->realisasi_info_grafis + $val->realisasi_dokumentasi); 


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
        $temp['total_budget'] = GeneralHelpers::formatRupiah($val->budget_potensi + $val->budget_fgd_persiapan + $val->budget_fgd_identifikasi + $val->budget_sektor + $val->budget_fgd_klarifikasi + $val->budget_finalisasi + $val->budget_penyusunan + $val->budget_info_grafis +  $val->budget_dokumentasi);
        $temp['total_realisasi'] = GeneralHelpers::formatRupiah($val->realisasi_potensi + $val->realisasi_fgd_persiapan + $val->realisasi_fgd_identifikasi + $val->realisasi_sektor + $val->realisasi_fgd_klarifikasi + $val->realisasi_finalisasi + $val->realisasi_penyusunan + $val->realisasi_info_grafis +  $val->realisasi_dokumentasi);  
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

   public static function UploadFile($periode_id,$data,$filename)
   {
       $daerah_id = Auth::User()->daerah_id;
      
       ConfigFile::CreateFilePeriode($periode_id,$daerah_id,'pemetaan');
       $dataCon = json_decode($data);
       $fileDir = '/laporan/pemetaan/'.$periode_id.'/'.$daerah_id.'/';
       $numRand = rand(10000,99999);
       $source = explode(";base64,",  $dataCon->file);
       $image = base64_decode($source[1]);
       $filePath = public_path() .$fileDir;
       $file =  $filename.'-'. $numRand. '-' .$dataCon->name.'.pdf';
       $success = file_put_contents($filePath.$file, $image);

       return $file;

   }


   public static function fieldsGroup($request,$id)
   {
        
         $insert = RequestPemetaan::fieldsData($request);
         $fileDir = '/laporan/pemetaan/'.$request->periode_id.'/'.Auth::User()->daerah_id.'/';
         $data = array();
          if($id)
          {
             $data = Pemetaan::find($id);
          }  

         if($request->keterangan_potensi)
         {    
            
            if($data)
            {
                if($data->keterangan_potensi)
                { 
                   File::delete(public_path() .$fileDir.$data->keterangan_potensi);
                }

            }   

            $file_potensi = RequestPemetaan::UploadFile($request->periode_id,$request->keterangan_potensi,'potensi');
            $fields_potensi = [ "keterangan_potensi" => $file_potensi];
            $merge1 = array_merge($insert,$fields_potensi);
         }else{
             $merge1 = $insert;
         }  


         


         if($request->keterangan_fgd_persiapan)
         {   
             if($data)
             {  
                $keterangan_fgd_persiapan = json_decode($request->keterangan_fgd_persiapan);
                if($data->keterangan_fgd_persiapan)
                { 
                   File::delete(public_path() .$fileDir.$keterangan_fgd_persiapan->file);
                }

             }   
             $fgd_persiapan = RequestPemetaan::UploadFile($request->periode_id,$request->keterangan_fgd_persiapan,'fgd-persiapan');
             $fields_persiapan = [ "keterangan_fgd_persiapan" => $fgd_persiapan];
             $merge2 = array_merge($merge1,$fields_persiapan);
         }else{
             $merge2 = $merge1;
         } 

         if($request->keterangan_fgd_identifikasi)
         {   
             if($data)
             {
                if($data->keterangan_fgd_identifikasi)
                { 
                   File::delete(public_path() .$fileDir.$data->keterangan_fgd_identifikasi);
                }

             }     
             $fgd_identifikasi = RequestPemetaan::UploadFile($request->periode_id,$request->keterangan_fgd_identifikasi,'fgd-identifikasi');
             $fields_identifikasi = [ "keterangan_fgd_identifikasi" => $fgd_identifikasi];
             $merge3 = array_merge($merge2,$fields_identifikasi);
         }else{
             $merge3 = $merge2;
         }

         if($request->keterangan_sektor)
         { 
             if($data)
             {
                if($data->keterangan_sektor)
                { 
                   File::delete(public_path() .$fileDir.$data->keterangan_sektor);
                }

             }  

             $file_sektor = RequestPemetaan::UploadFile($request->periode_id,$request->keterangan_sektor,'sektor');
             $fields_sektor= [ "keterangan_sektor" => $file_sektor];
             $merge4 = array_merge($merge3,$fields_sektor);
         }else{
             $merge4 = $merge3;
         }

         if($request->keterangan_fgd_klarifikasi)
         {   
             if($data)
             {
                if($data->keterangan_fgd_klarifikasi)
                { 
                   File::delete(public_path() .$fileDir.$data->keterangan_fgd_klarifikasi);
                }

             }  

             $fgd_klarifikasi = RequestPemetaan::UploadFile($request->periode_id,$request->keterangan_fgd_klarifikasi,'fgd-klarifikasi');
             $fields_klarifikasi = [ "keterangan_fgd_klarifikasi" => $fgd_klarifikasi];
             $merge5 = array_merge($merge4,$fields_klarifikasi);
         }else{
             $merge5 = $merge4;
         }


         if($request->keterangan_finalisasi)
         {   
             if($data)
             {
                if($data->keterangan_finalisasi)
                { 
                   File::delete(public_path() .$fileDir.$data->keterangan_finalisasi);
                }

             } 

             $finalisasi = RequestPemetaan::UploadFile($request->periode_id,$request->keterangan_finalisasi,'finalisasi');
             $fields_finalisasi = [ "keterangan_finalisasi" => $finalisasi];
             $merge6 = array_merge($merge5,$fields_finalisasi);
         }else{
             $merge6 = $merge5;
         }

         if($request->keterangan_penyusunan)
         {   
             if($data)
             {
                if($data->keterangan_penyusunan)
                { 
                   File::delete(public_path() .$fileDir.$data->keterangan_penyusunan);
                }

             } 

             $penyusunan = RequestPemetaan::UploadFile($request->periode_id,$request->keterangan_penyusunan,'penyusunan');
             $fields_penyusunan = [ "keterangan_penyusunan" => $penyusunan];
             $merge7 = array_merge($merge6,$fields_penyusunan);
         }else{
             $merge7 = $merge6;
         }

         if($request->keterangan_info_grafis)
         {   

             if($data)
             {
                if($data->keterangan_info_grafis)
                { 
                   File::delete(public_path() .$fileDir.$data->keterangan_info_grafis);
                }

             }

             $info_grafis = RequestPemetaan::UploadFile($request->periode_id,$request->keterangan_info_grafis,'info-grafis');
             $fields_info_grafis = [ "keterangan_info_grafis" => $info_grafis];
             $merge8 = array_merge($merge7,$fields_info_grafis);
         }else{
             $merge8 = $merge7;
         }

         if($request->keterangan_dokumentasi)
         {   
             if($data)
             {
                if($data->keterangan_dokumentasi)
                { 
                   File::delete(public_path() .$fileDir.$data->keterangan_dokumentasi);
                }

             }

             $dokumentasi = RequestPemetaan::UploadFile($request->periode_id,$request->keterangan_dokumentasi,'dokumentasi');
             $fields_dokumentasi = [ "keterangan_dokumentasi" => $dokumentasi];
             $merge9 = array_merge($merge8,$fields_dokumentasi);
         }else{
             $merge9 = $merge8;
         }

         return $merge9;




   }

  

   public static function fieldsData($request)
   {
      
         

      $fields = [
         'daerah_id'  =>  Auth::User()->daerah_id,
         'periode_id' => $request->periode_id,
        


         'checklist_rk' => $request->checklist_rk,
         'checklist_sl' => $request->checklist_sl,
         'checklist_kor' => $request->checklist_kor,
         'checklist_ds' => $request->checklist_ds,
         'type_potensi'=>$request->type_potensi,
         'tgl_awal_potensi' => $request->tgl_awal_potensi,
         'tgl_ahir_potensi' => $request->tgl_ahir_potensi,
         'budget_potensi' => $request->budget_potensi,
         'realisasi_potensi' => $request->realisasi_potensi,
         // 'keterangan_potensi' => $request->keterangan_potensi,
         'type_fgd_persiapan'=>$request->type_fgd_persiapan,
         'tgl_awal_fgd_persiapan' => $request->tgl_awal_fgd_persiapan,
         'tgl_ahir_fgd_persiapan' => $request->tgl_ahir_fgd_persiapan,
         'budget_fgd_persiapan' => $request->budget_fgd_persiapan,
         'realisasi_fgd_persiapan' => $request->realisasi_fgd_persiapan,
         
         'type_fgd_identifikasi'=> $request->type_fgd_identifikasi, 
         'tgl_awal_fgd_identifikasi' => $request->tgl_awal_fgd_identifikasi,
         'tgl_ahir_fgd_identifikasi' => $request->tgl_ahir_fgd_identifikasi,
         'budget_fgd_identifikasi' => $request->budget_fgd_identifikasi,
         'realisasi_fgd_identifikasi' => $request->realisasi_fgd_identifikasi, 

      
         'checklist_lq' => $request->checklist_lq,   
         'checklist_shift_share' => $request->checklist_shift_share, 
         'checklist_tipologi_sektor' => $request->checklist_tipologi_sektor, 
         'checklist_klassen' => $request->checklist_klassen,
         
         'type_sektor'=>$request->type_sektor, 
         'tgl_awal_sektor' => $request->tgl_awal_sektor,
         'tgl_ahir_sektor' => $request->tgl_ahir_sektor,
         'budget_sektor' => $request->budget_sektor,
         'realisasi_sektor' => $request->realisasi_sektor,
         // 'keterangan_sektor' => $request->keterangan_sektor,

         'type_fgd_klarifikasi'=>$request->type_fgd_klarifikasi,
         'tgl_awal_fgd_klarifikasi' => $request->tgl_awal_fgd_klarifikasi,
         'tgl_ahir_fgd_klarifikasi' => $request->tgl_ahir_fgd_klarifikasi,
         'budget_fgd_klarifikasi' => $request->budget_fgd_klarifikasi,
         'realisasi_fgd_klarifikasi' => $request->realisasi_fgd_klarifikasi,
   
         'type_finalisasi'=>$request->type_finalisasi,
         'tgl_awal_finalisasi' => $request->tgl_awal_finalisasi,
         'tgl_ahir_finalisasi' => $request->tgl_ahir_finalisasi,
         'budget_finalisasi' => $request->budget_finalisasi,
         'realisasi_finalisasi' => $request->realisasi_finalisasi,

         'checklist_summary_sektor_unggulan' => $request->checklist_summary_sektor_unggulan, 
         'checklist_sektor_unggulan' => $request->checklist_sektor_unggulan, 
         'checklist_potensi_pasar' => $request->checklist_potensi_pasar, 
         'checklist_parameter_sektor_unggulan' => $request->checklist_parameter_sektor_unggulan,
         'checklist_subsektor_unggulan' => $request->checklist_subsektor_unggulan,
         'checklist_intensif_daerah' => $request->checklist_intensif_daerah, 
         'checklist_potensi_lanjutan' => $request->checklist_potensi_lanjutan,
           
         'type_penyusunan'=>$request->type_penyusunan,  
         'tgl_awal_penyusunan' => $request->tgl_awal_penyusunan,
         'tgl_ahir_penyusunan' => $request->tgl_ahir_penyusunan,
         'budget_penyusunan' => $request->budget_penyusunan,
         'realisasi_penyusunan' => $request->realisasi_penyusunan,
         // 'keterangan_penyusunan' => $request->keterangan_penyusunan,
         
         
         'type_info_grafis'=>$request->type_info_grafis, 
         'tgl_awal_info_grafis' => $request->tgl_awal_info_grafis,
         'tgl_ahir_info_grafis' => $request->tgl_ahir_info_grafis,
         'budget_info_grafis' => $request->budget_info_grafis,
         'realisasi_info_grafis' => $request->realisasi_info_grafis,
        
         'type_dokumentasi'=>$request->type_dokumentasi,
         'tgl_awal_dokumentasi' => $request->tgl_awal_dokumentasi,
         'tgl_ahir_dokumentasi' => $request->tgl_ahir_dokumentasi,
         'budget_dokumentasi' => $request->budget_dokumentasi,
         'realisasi_dokumentasi' => $request->realisasi_dokumentasi,



         'status_laporan_id' => $request->status_laporan_id,
         'request_edit'=>'false',
         'created_by' => Auth::User()->username,
         'created_at' => date('Y-m-d H:i:s'),
      ];

      return $fields;
   }


   public static function DeletePDF($data){

          $fileDir = '/laporan/pemetaan/';
          if($data->keterangan_potensi)
          { 
             File::delete(public_path() .$fileDir.$data->keterangan_potensi);
          } 

          

          if($data->keterangan_fgd_persiapan)
          { 
             File::delete(public_path() .$fileDir.$data->keterangan_fgd_persiapan);
          } 

          if($data->keterangan_fgd_identifikasi)
          { 
             File::delete(public_path() .$fileDir.$data->keterangan_fgd_identifikasi);
          } 

          if($data->keterangan_sektor)
          { 
             File::delete(public_path() .$fileDir.$data->keterangan_sektor);
          } 

          if($data->keterangan_fgd_klarifikasi)
          { 
             File::delete(public_path() .$fileDir.$data->keterangan_fgd_klarifikasi);
          } 
          
          if($data->keterangan_finalisasi)
          { 
             File::delete(public_path() .$fileDir.$data->keterangan_finalisasi);
          } 

          if($data->keterangan_penyusunan)
          { 
             File::delete(public_path() .$fileDir.$data->keterangan_penyusunan);
          } 
 
          if($data->keterangan_info_grafis)
          { 
             File::delete(public_path() .$fileDir.$data->keterangan_info_grafis);
          } 

          if($data->keterangan_dokumentasi)
          { 
             File::delete(public_path() .$fileDir.$data->keterangan_dokumentasi);
          } 

          
         

   }

   
}

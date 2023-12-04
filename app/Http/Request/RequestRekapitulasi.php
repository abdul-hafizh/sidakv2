<?php

namespace App\Http\Request;
use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\PaguTarget;
use App\Models\Perencanaan;
use App\Models\Bimsos;
use App\Models\Pengawasan;
use App\Models\Penyelesaian;
use App\Models\Promosi;
use App\Models\Pemetaan;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestDashboard;

use App\Http\Request\RequestDaerah;
use DB;

class RequestRekapitulasi 
{
   
  
  public static function Header($data, $perPage, $request)
  {       
              $daerah_id = "";
              $periode = $request->periode_id.$request->semester_id;
           
              $perencanaan = RequestRekapitulasi::Rencana($request->periode_id);
          
              $arr[0] = RequestRekapitulasi::Pengawasan($perencanaan,$periode,$daerah_id);
              $arr[1] = RequestRekapitulasi::Bimsos($perencanaan,$periode,$daerah_id);
              $arr[2] = RequestRekapitulasi::Penyelesaian($perencanaan,$periode,$daerah_id); 
              if($request->periode_id < 2024)
              {
                 $arr[3] = RequestRekapitulasi::Promosi($perencanaan,$periode,$daerah_id);  
              }else{
                 $arr[3] = RequestRekapitulasi::Pemetaan($perencanaan,$periode,$daerah_id);  
              }  

              $arr[4] = RequestRekapitulasi::TotalHeader($arr[0],$arr[1],$arr[2],$arr[3]); 
              
            return $arr; 
  }



    public static function GetDataAll($data, $perPage, $request)
  {
    $temp = array();
    $getRequest = $request->all();
    $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
    if($perPage !='all')
    {
         $numberNext = (($page * $perPage) - ($perPage - 1));
    }else{
         $numberNext = (($page * $data->count()) - ($data->count() - 1));
    }  

    $periode = $request->periode_id.$request->semester_id;
    $perencanaan = RequestDashboard::Perencanaan($request->periode_id,'null');
    foreach ($data as $key => $val) 
    {

              
              $temp[$key]['number'] = $numberNext++;
              $temp[$key]['id'] = $val->id;
              $temp[$key]['username'] = $val->username;
              $temp[$key]['fullname'] = $val->name;
              $temp[$key]['daerah_id'] = $val->daerah_id;
              $temp[$key]['daerah_name'] = RequestDaerah::GetDaerahWhereID($val->daerah_id);
              
              $temp[$key]['pengawas_target'] =  $perencanaan->pengawas_inspeksi_target;
              $temp[$key]['pengawas_pagu'] = $perencanaan->pengawas_analisa_pagu + $perencanaan->pengawas_inspeksi_pagu + $perencanaan->pengawas_evaluasi_pagu;

               $temp[$key]['pengawas_pagu_convert'] =  GeneralHelpers::formatRupiah($perencanaan->pengawas_analisa_pagu + $perencanaan->pengawas_inspeksi_pagu + $perencanaan->pengawas_evaluasi_pagu);

              $temp[$key]['pengawas_realisasi_target'] = RequestDashboard::PengawasanRealisasiTarget($periode,$val->daerah_id,'analisa') + RequestDashboard::PengawasanRealisasiTarget($periode,$val->daerah_id,'inspeksi') + RequestDashboard::PengawasanRealisasiTarget($periode,$val->daerah_id,'evaluasi');

              $temp[$key]['pengawas_realisasi_apbn'] = RequestDashboard::PengawasanRealisasiAPBN($periode,$val->daerah_id,'analisa') + RequestDashboard::PengawasanRealisasiAPBN($periode,$val->daerah_id,'inspeksi') + RequestDashboard::PengawasanRealisasiAPBN($periode,$val->daerah_id,'evaluasi');

               $temp[$key]['pengawas_realisasi_apbn_convert'] = GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode,$val->daerah_id,'analisa') + RequestDashboard::PengawasanRealisasiAPBN($periode,$val->daerah_id,'inspeksi') + RequestDashboard::PengawasanRealisasiAPBN($periode,$val->daerah_id,'evaluasi'));



              $temp[$key]['bimsos_target'] =  $perencanaan->bimtek_perizinan_target + $perencanaan->bimtek_pengawasan_target;
              $temp[$key]['bimsos_pagu'] =  $perencanaan->bimtek_perizinan_pagu + $perencanaan->bimtek_pengawasan_pagu;
              $temp[$key]['bimsos_pagu_convert'] =  GeneralHelpers::formatRupiah($perencanaan->bimtek_perizinan_pagu + $perencanaan->bimtek_pengawasan_pagu);

              $temp[$key]['bimsos_realisasi_target'] =  RequestDashboard::BimsosRealisasiTarget($periode,$val->daerah_id,'perizinan') + RequestDashboard::BimsosRealisasiTarget($periode,$val->daerah_id,'pengawasan');

              $temp[$key]['bimsos_realisasi_apbn'] = RequestDashboard::BimsosRealisasiAPBN($periode,$val->daerah_id,'perizinan') + RequestDashboard::BimsosRealisasiAPBN($periode,$val->daerah_id,'pengawasan');
              $temp[$key]['bimsos_realisasi_apbn_convert'] = GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode,$val->daerah_id,'perizinan') + RequestDashboard::BimsosRealisasiAPBN($periode,$val->daerah_id,'pengawasan'));

            
              $temp[$key]['penyelesain_target'] =  $perencanaan->penyelesaian_realisasi_target;
              $temp[$key]['penyelesain_pagu'] = $perencanaan->penyelesaian_identifikasi_pagu + $perencanaan->penyelesaian_realisasi_pagu + $perencanaan->penyelesaian_evaluasi_pagu;
              $temp[$key]['penyelesain_pagu_convert'] =  GeneralHelpers::formatRupiah($perencanaan->penyelesaian_identifikasi_pagu + $perencanaan->penyelesaian_realisasi_pagu + $perencanaan->penyelesaian_evaluasi_pagu);
              $temp[$key]['penyelesain_realisasi_target'] = RequestDashboard::PenyelesaianRealisasiTarget($periode,$val->daerah_id,'identifikasi') + RequestDashboard::PenyelesaianRealisasiTarget($periode,$val->daerah_id,'penyelesaian') + RequestDashboard::PenyelesaianRealisasiTarget($periode,$val->daerah_id,'evaluasi');

              $temp[$key]['penyelesain_realisasi_apbn'] = RequestDashboard::PenyelesaianRealisasiAPBN($periode,$val->daerah_id,'identifikasi') + RequestDashboard::PenyelesaianRealisasiAPBN($periode,$val->daerah_id,'penyelesaian') + RequestDashboard::PenyelesaianRealisasiAPBN($periode,$val->daerah_id,'evaluasi');

               $temp[$key]['penyelesain_realisasi_apbn_convert'] = GeneralHelpers::formatRupiah(RequestDashboard::PenyelesaianRealisasiAPBN($periode,$val->daerah_id,'identifikasi') + RequestDashboard::PenyelesaianRealisasiAPBN($periode,$val->daerah_id,'penyelesaian') + RequestDashboard::PenyelesaianRealisasiAPBN($periode,$val->daerah_id,'evaluasi'));


              $temp[$key]['promosi_target'] =  $perencanaan->promosi_pengadaan_target;
              $temp[$key]['promosi_pagu'] =  $perencanaan->promosi_pengadaan_pagu;
               $temp[$key]['promosi_pagu_convert'] =  GeneralHelpers::formatRupiah($perencanaan->promosi_pengadaan_pagu);
              $temp[$key]['promosi_realisasi_target'] =  RequestDashboard::PromosiRealisasiTarget($request->periode_id,$val->daerah_id);

              $temp[$key]['promosi_realisasi_apbn'] = RequestDashboard::PromosiRealisasiAPBN($request->periode_id,$val->daerah_id);
               $temp[$key]['promosi_realisasi_apbn_convert'] = GeneralHelpers::formatRupiah(RequestDashboard::PromosiRealisasiAPBN($request->periode_id,$val->daerah_id));

              $temp[$key]['total_target'] =  $temp[$key]['pengawas_realisasi_target'] +  $temp[$key]['bimsos_realisasi_target'] +  $temp[$key]['penyelesain_realisasi_target'] + $temp[$key]['promosi_realisasi_target'];


               $temp[$key]['total_pagu'] =  RequestDashboard::PengawasanRealisasiAPBN($periode,$val->daerah_id,'analisa') + RequestDashboard::PengawasanRealisasiAPBN($periode,$val->daerah_id,'inspeksi') + RequestDashboard::PengawasanRealisasiAPBN($periode,$val->daerah_id,'evaluasi') + RequestDashboard::BimsosRealisasiAPBN($periode,$val->daerah_id,'perizinan') + RequestDashboard::BimsosRealisasiAPBN($periode,$val->daerah_id,'pengawasan') + RequestDashboard::PenyelesaianRealisasiAPBN($periode,$val->daerah_id,'identifikasi') + RequestDashboard::PenyelesaianRealisasiAPBN($periode,$val->daerah_id,'penyelesaian') + RequestDashboard::PenyelesaianRealisasiAPBN($periode,$val->daerah_id,'evaluasi') + RequestDashboard::PromosiRealisasiAPBN($periode,$val->daerah_id) + RequestDashboard::PromosiRealisasiAPBN($request->periode_id,$val->daerah_id);

                $temp[$key]['total_pagu_convert'] =  GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode,$val->daerah_id,'analisa') + RequestDashboard::PengawasanRealisasiAPBN($periode,$val->daerah_id,'inspeksi') + RequestDashboard::PengawasanRealisasiAPBN($periode,$val->daerah_id,'evaluasi') + RequestDashboard::BimsosRealisasiAPBN($periode,$val->daerah_id,'perizinan') + RequestDashboard::BimsosRealisasiAPBN($periode,$val->daerah_id,'pengawasan') + RequestDashboard::PenyelesaianRealisasiAPBN($periode,$val->daerah_id,'identifikasi') + RequestDashboard::PenyelesaianRealisasiAPBN($periode,$val->daerah_id,'penyelesaian') + RequestDashboard::PenyelesaianRealisasiAPBN($periode,$val->daerah_id,'evaluasi') + RequestDashboard::PromosiRealisasiAPBN($periode,$val->daerah_id) + RequestDashboard::PromosiRealisasiAPBN($request->periode_id,$val->daerah_id));
              // $temp[$key]['pengawasan'] = RequestRekapitulasi::Pengawasan($request->periode_id,$request->semester_id,$val->daerah_id);
             
              $temp[$key]['created_at_format'] = GeneralHelpers::formatExcel($val->created_at);
       
     
    }
       
       $result['data'] = $temp;
     
       if($perPage !='all')
       {
           $result['current_page'] = $data->currentPage();
           $result['last_page'] = $data->lastPage();
           $result['total'] = $data->total(); 
       }else{
           $result['current_page'] = 1;
           $result['last_page'] = 1;
           $result['total'] = $data->count(); 
       } 
   
    return $result;
  }


  public static function Rencana($periode_id){


      $perencanaan = Perencanaan::select(
             DB::raw('SUM(pengawas_analisa_target + pengawas_inspeksi_target + pengawas_evaluasi_target) as pengawas_target'),
             DB::raw('SUM(pengawas_analisa_pagu + pengawas_inspeksi_pagu + pengawas_evaluasi_pagu) as pengawas_pagu'),

             DB::raw('SUM(bimtek_perizinan_target + bimtek_pengawasan_target) as bimsos_target'),
             DB::raw('SUM(bimtek_perizinan_pagu + bimtek_pengawasan_pagu) as bimsos_pagu'),

             DB::raw('SUM(penyelesaian_identifikasi_target + penyelesaian_realisasi_target + penyelesaian_evaluasi_target) as penyelesaian_target'),
             DB::raw('SUM(penyelesaian_identifikasi_pagu + penyelesaian_realisasi_pagu + penyelesaian_evaluasi_pagu) as penyelesaian_pagu'),

            DB::raw('SUM(promosi_pengadaan_target ) as promosi_target'),
             DB::raw('SUM(promosi_pengadaan_pagu) as promosi_pagu')
        )->where(['status'=>'14','periode_id'=>$periode_id])->get();

      return $perencanaan;

  }


  public static function Pengawasan($perencanaan,$periode,$daerah_id){

      $pengawasan = Pengawasan::select(
              DB::raw('COUNT(id) as realisasi_target'),
              DB::raw('SUM(biaya_kegiatan) as realisasi_pagu')
        )->where(['status_laporan_id'=>'14','periode_id'=>$periode])->get();

            if($pengawasan[0]->realisasi_target ==NULL){ 
               $pengawasan_target = 0;
             }else{ 
               $pengawasan_target =  (int)$pengawasan[0]->realisasi_target; 
             }

             if($pengawasan[0]->realisasi_pagu ==NULL)
             {
                 $pengawasan_pagu = 0;
             }else{
                 $pengawasan_pagu = $pengawasan[0]->realisasi_pagu;
             } 

            $data = [
               "sub_menu" =>"Pengawasan",
               "target"=> (int)$perencanaan[0]->pengawas_target,
               "pagu"=> ['original'=>$perencanaan[0]->pengawas_pagu,'convert'=>GeneralHelpers::formatRupiah($perencanaan[0]->pengawas_pagu)] ,
               "realisasi_target"=> $pengawasan_target,
               "realisasi_apbn"=> ['original'=> $pengawasan_pagu,'convert'=>GeneralHelpers::formatRupiah($pengawasan[0]->realisasi_pagu)],
                     
           ];

      return $data;     
  }  


  public static function Bimsos($perencanaan,$periode,$daerah_id){
           
           $bimsos = Bimsos::select(
              DB::raw('SUM(jml_peserta) as realisasi_target'),
              DB::raw('SUM(biaya_kegiatan) as realisasi_pagu')
        )->where(['status_laporan_id'=>'14','periode_id'=>$periode])->get();
            if($bimsos[0]->realisasi_target ==NULL){ 
               $bimsos_target = 0;
             }else{ 
               $bimsos_target =  (int)$bimsos[0]->realisasi_target; 
             }


             if($bimsos[0]->realisasi_pagu ==NULL)
             {
                 $bimsos_pagu = 0;
             }else{
                 $bimsos_pagu = $bimsos[0]->realisasi_pagu;
             } 

             $pendamping = Bimsos::select(
              DB::raw('count(id) as realisasi_target')
        )->where(['status_laporan_id'=>'14','sub_menu_slug'=>'is_tenaga_pendamping','periode_id'=>$periode])->get();

            $data = [
               "sub_menu" =>"Bimsos",
               "target"=> (int)$perencanaan[0]->bimsos_target,
               "pagu"=> ['original'=>$perencanaan[0]->bimsos_pagu,'convert'=>GeneralHelpers::formatRupiah($perencanaan[0]->bimsos_pagu)] ,
               "realisasi_target"=> $bimsos_target,
               "realisasi_apbn"=> ['original'=>$bimsos_pagu,'convert'=>GeneralHelpers::formatRupiah($bimsos[0]->realisasi_pagu)],
                       
           ];

      return $data;     
  }  


   public static function Penyelesaian($perencanaan,$periode,$daerah_id){
           
           $penyelesaian = Penyelesaian::select(
              DB::raw('SUM(jml_perusahaan) as realisasi_target'),
              DB::raw('SUM(biaya) as realisasi_pagu')
        )->where(['status_laporan_id'=>'14','periode_id'=>$periode])->get();
            if($penyelesaian[0]->realisasi_target ==NULL){ 
               $penyelesaian_target = 0;
             }else{ 
               $penyelesaian_target =  (int)$penyelesaian[0]->realisasi_target; 
             }

             if($penyelesaian[0]->realisasi_pagu ==NULL)
             {
                 $penyelesaian_pagu = 0;
             }else{
                 $penyelesaian_pagu = $penyelesaian[0]->realisasi_pagu;
             } 

             if($perencanaan[0]->penyelesaian_target ==Null)
             {
                $penyelesaian_target = 0;
             }else{
                 $penyelesaian_target = (int)$perencanaan[0]->penyelesaian_target;
             }   

            $data = [
               "sub_menu" =>"Penyelesaian",
               "target"=>  $penyelesaian_target ,
               "pagu"=> ['original'=>$perencanaan[0]->penyelesaian_pagu,'convert'=>GeneralHelpers::formatRupiah($perencanaan[0]->penyelesaian_pagu)] ,
               "realisasi_target"=> $penyelesaian_target,
               "realisasi_apbn"=> ['original'=>$penyelesaian_pagu,'convert'=>GeneralHelpers::formatRupiah($penyelesaian[0]->realisasi_pagu)], 
                      
           ];

      return $data;     
  } 


  public static function promosi($perencanaan,$periode,$daerah_id){
           
           $promosi = Promosi::select(
              DB::raw('COUNT(id) as realisasi_target'),
              DB::raw('SUM(budget_peluang + budget_storyline + budget_storyboard + budget_lokasi + budget_talent + budget_testimoni + budget_audio + budget_editing + budget_gambar + budget_video + budget_editvideo + budget_grafik + budget_mixing + budget_voice + budget_subtitle) as realisasi_pagu')
        )->where(['status_laporan_id'=>'14','periode_id'=>$periode])->get();
            if($promosi[0]->realisasi_target ==NULL){ 
               $promosi_target = 0;
             }else{ 
               $promosi_target =  (int)$promosi[0]->realisasi_target; 
             }

              if($promosi[0]->realisasi_pagu ==NULL)
             {
                 $promosi_pagu = 0;
             }else{
                 $promosi_pagu = $promosi[0]->realisasi_pagu;
             }

             if($perencanaan[0]->promosi_target ==Null)
             {
                $promosi_target = 0;
             }else{
                $promosi_target = $perencanaan[0]->promosi_target;
             } 

             $data = [
               "sub_menu" =>"Promosi",
               "target"=> $promosi_target,
               "pagu"=> ['original'=>$perencanaan[0]->promosi_pagu,'convert'=>GeneralHelpers::formatRupiah($perencanaan[0]->promosi_pagu)] ,
               "realisasi_target"=> $promosi_target,
               "realisasi_apbn"=> ['original'=>$promosi_pagu,'convert'=>GeneralHelpers::formatRupiah($promosi[0]->realisasi_pagu)], 
                      
            ];
 
      return $data;     
  }  


  public static function pemetaan($perencanaan,$periode,$daerah_id){
           
           $pemetaan = Pemetaan::select(
              DB::raw('COUNT(id) as realisasi_target'),
              DB::raw('SUM(budget_rencana_kerja + budget_studi_literatur + budget_rapat_kordinasi + budget_data_sekunder + budget_fgd_persiapan + budget_fgd_identifikasi + budget_lq + budget_shift_share + budget_tipologi_sektor + budget_klassen + budget_fgd_klarifikasi + budget_finalisasi + budget_summary_sektor_unggulan + budget_sektor_unggulan + budget_potensi_pasar + budget_parameter_sektor_unggulan + budget_subsektor_unggulan + budget_intensif_daerah + budget_potensi_lanjutan + budget_info_grafis + budget_dokumentasi) as realisasi_pagu')
        )->where(['status_laporan_id'=>'16','periode_id'=>$periode])->get();
            if($pemetaan[0]->realisasi_target ==NULL){ 
               $pemetaan_target = 0;
             }else{ 
               $pemetaan_target =  (int)$pemetaan[0]->realisasi_target; 
             }

            

            $data = [
               "sub_menu" =>"Pemetaan",
               "target"=> (int)$perencanaan[0]->promosi_target,
               "pagu"=> ['original'=>$perencanaan[0]->promosi_pagu,'convert'=>GeneralHelpers::formatRupiah($perencanaan[0]->promosi_pagu)] ,
               "realisasi_target"=> $pemetaan_target,
               "realisasi_apbn"=> ['original'=>$promosi[0]->realisasi_pagu,'convert'=>GeneralHelpers::formatRupiah($promosi[0]->realisasi_pagu)],          
           ];

      return $data;     
  }  


  public static function TotalHeader($pengawasan,$bimsos,$penyelesaian,$promosi)
  {

          $data = [
               "sub_menu" =>"Total",
               "target"=> $pengawasan['target'] + $bimsos['target'] + $penyelesaian['target'] + $promosi['target'],

                "pagu"=> ['convert'=>GeneralHelpers::formatRupiah($pengawasan['pagu']['original'] + $bimsos['pagu']['original'] + $penyelesaian['pagu']['original'] + $promosi['pagu']['original'])] ,

              
               "realisasi_target"=> $pengawasan['realisasi_target'] + $bimsos['realisasi_target'] + $penyelesaian['realisasi_target'] + $promosi['realisasi_target'],
               "realisasi_apbn"=>['convert'=> GeneralHelpers::formatRupiah($pengawasan['realisasi_apbn']['original'] + $bimsos['realisasi_apbn']['original'] + $penyelesaian['realisasi_apbn']['original'] + $promosi['realisasi_apbn']['original'])],         
           ];
       return $data; 
  } 

}
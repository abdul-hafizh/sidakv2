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


class RequestDashboard 
{
   
   public static function TotalKegiatan($periode_id,$semester_id,$daerah_id)
   {
     $access = RequestAuth::Access();
     if($access == 'province' || $access =='daerah')
     {
           $PaguApbn = PaguTarget::where(['periode_id'=>$periode_id,'daerah_id'=>$daerah_id])->sum('pagu_apbn');
           $Perencanaan = Perencanaan::where(['status'=>'14','periode_id'=>$periode_id,'daerah_id'=>$daerah_id])
            ->sum(\DB::raw('pengawas_analisa_pagu + pengawas_inspeksi_pagu + pengawas_evaluasi_pagu + bimtek_perizinan_pagu + bimtek_pengawasan_pagu + penyelesaian_identifikasi_pagu + penyelesaian_realisasi_pagu + penyelesaian_evaluasi_pagu'));

           
           $periode = $periode_id.$semester_id;
           
           $Pengawasan = Pengawasan::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id])->sum('biaya_kegiatan');
           $Bimsos = Bimsos::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id])->sum('biaya_kegiatan');
           $Penyelesaian = Penyelesaian::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id])->sum('biaya');



            $Promosi = Promosi::where(['status_laporan_id'=>'14','periode_id'=>$periode_id,'daerah_id'=>$daerah_id])
                     ->sum(\DB::raw('budget_peluang + budget_storyline + budget_storyboard + budget_lokasi + budget_talent + budget_testimoni + budget_audio + budget_editing + budget_gambar + budget_video + budget_editvideo + budget_grafik + budget_mixing + budget_voice + budget_subtitle'));

            $petaPotensi = Pemetaan::where(['status_laporan_id'=>'14','periode_id'=>$periode_id,'daerah_id'=>$daerah_id])
                     ->sum(\DB::raw('budget_rencana_kerja + budget_studi_literatur + budget_rapat_kordinasi + budget_data_sekunder + budget_fgd_persiapan + budget_fgd_identifikasi + budget_lq + budget_shift_share + budget_tipologi_sektor + budget_klassen + budget_fgd_klarifikasi + budget_finalisasi + budget_summary_sektor_unggulan + budget_sektor_unggulan + budget_potensi_pasar + budget_parameter_sektor_unggulan + budget_subsektor_unggulan + budget_intensif_daerah + budget_potensi_lanjutan + budget_info_grafis + budget_dokumentasi'));           
         
        }else{

           $PaguApbn = PaguTarget::where(['periode_id'=>$periode_id])->sum('pagu_apbn');
           $Perencanaan = Perencanaan::where(['status'=>'14','periode_id'=>$periode_id])
            ->sum(\DB::raw('pengawas_analisa_pagu + pengawas_inspeksi_pagu + pengawas_evaluasi_pagu + bimtek_perizinan_pagu + bimtek_pengawasan_pagu + penyelesaian_identifikasi_pagu + penyelesaian_realisasi_pagu + penyelesaian_evaluasi_pagu'));

           
           $periode = $periode_id.$semester_id;
           
           $Pengawasan = Pengawasan::where(['status_laporan_id'=>'14','periode_id'=>$periode])->sum('biaya_kegiatan');
           $Bimsos = Bimsos::where(['status_laporan_id'=>'14','periode_id'=>$periode])->sum('biaya_kegiatan');
           $Penyelesaian = Penyelesaian::where(['status_laporan_id'=>'14','periode_id'=>$periode])->sum('biaya');



           $Promosi = Promosi::where(['status_laporan_id'=>'14','periode_id'=>$periode_id])
                     ->sum(\DB::raw('budget_peluang + budget_storyline + budget_storyboard + budget_lokasi + budget_talent + budget_testimoni + budget_audio + budget_editing + budget_gambar + budget_video + budget_editvideo + budget_grafik + budget_mixing + budget_voice + budget_subtitle'));

           $petaPotensi = Pemetaan::where(['status_laporan_id'=>'14','periode_id'=>$periode_id])
                     ->sum(\DB::raw('budget_rencana_kerja + budget_studi_literatur + budget_rapat_kordinasi + budget_data_sekunder + budget_fgd_persiapan + budget_fgd_identifikasi + budget_lq + budget_shift_share + budget_tipologi_sektor + budget_klassen + budget_fgd_klarifikasi + budget_finalisasi + budget_summary_sektor_unggulan + budget_sektor_unggulan + budget_potensi_pasar + budget_parameter_sektor_unggulan + budget_subsektor_unggulan + budget_intensif_daerah + budget_potensi_lanjutan + budget_info_grafis + budget_dokumentasi'));          
         

        }
       $total = [
           "pagu_apbn"=> GeneralHelpers::formatRupiah($PaguApbn),
           "perencanaan"=> GeneralHelpers::formatRupiah($Perencanaan),
           "pengawasan"=> GeneralHelpers::formatRupiah($Pengawasan),
           "bimsos"=> GeneralHelpers::formatRupiah($Bimsos),
           "penyelesaian"=> GeneralHelpers::formatRupiah($Penyelesaian),
           "promosi" => GeneralHelpers::formatRupiah($Promosi),
           "peta_potensi" => GeneralHelpers::formatRupiah($petaPotensi),
       ];



       return $total;
   }


   public static function Pengawasan($periode_id,$semester_id,$daerah_id){
              
         $perencanaan = RequestDashboard::Perencanaan($periode_id,$daerah_id);

         $data[0] = RequestDashboard::PengawasanAnalisa($perencanaan,$periode_id,$semester_id,$daerah_id);
         $data[1] = RequestDashboard::PengawasanInspeksi($perencanaan,$periode_id,$semester_id,$daerah_id);
         $data[2] = RequestDashboard::PengawasanEvaluasi($perencanaan,$periode_id,$semester_id,$daerah_id);
         $data[3] = RequestDashboard::PengawasanTotalHeader($perencanaan,$periode_id,$semester_id,$daerah_id);

         return $data;

   }


    public static function Bimsos($periode_id,$semester_id,$daerah_id){
              
         $perencanaan = RequestDashboard::Perencanaan($periode_id,$daerah_id);
         $data[0] = RequestDashboard::BimsosPendamping($perencanaan,$periode_id,$semester_id,$daerah_id);
         $data[1] = RequestDashboard::BimsosPerizinan($perencanaan,$periode_id,$semester_id,$daerah_id);
         $data[2] = RequestDashboard::BimsosPengawasan($perencanaan,$periode_id,$semester_id,$daerah_id);
         $data[3] = RequestDashboard::BimsosTotalHeader($perencanaan,$periode_id,$semester_id,$daerah_id);

         return $data;

   }


   public static function Penyelesaian($periode_id,$semester_id,$daerah_id){
              
         $perencanaan = RequestDashboard::Perencanaan($periode_id,$daerah_id);

         $data[0] = RequestDashboard::PenyelesaianIdentifikasi($perencanaan,$periode_id,$semester_id,$daerah_id);
         $data[1] = RequestDashboard::PenyelesaianRealisasi($perencanaan,$periode_id,$semester_id,$daerah_id);
         $data[2] = RequestDashboard::PenyelesaianEvaluasi($perencanaan,$periode_id,$semester_id,$daerah_id);
         $data[3] = RequestDashboard::PenyelesaianTotalHeader($perencanaan,$periode_id,$semester_id,$daerah_id);

         return $data;

   }


   public static function Perencanaan($periode_id,$daerah_id)
   {
     $access = RequestAuth::Access();
     if($access == 'province' || $access =='daerah')
     {
        $perencanaan = Perencanaan::select('pengawas_analisa_target','pengawas_analisa_pagu','pengawas_inspeksi_target','pengawas_inspeksi_pagu','pengawas_evaluasi_target','pengawas_evaluasi_pagu','bimtek_perizinan_target','bimtek_perizinan_pagu','bimtek_pengawasan_target','bimtek_pengawasan_pagu','penyelesaian_identifikasi_target','penyelesaian_identifikasi_pagu','penyelesaian_realisasi_target','penyelesaian_realisasi_pagu','penyelesaian_evaluasi_target','penyelesaian_evaluasi_pagu')->where(['periode_id'=>$periode_id,'daerah_id'=>$daerah_id])->first();
     }else{

          $perencanaan = Perencanaan::select('pengawas_analisa_target','pengawas_analisa_pagu','pengawas_inspeksi_target','pengawas_inspeksi_pagu','pengawas_evaluasi_target','pengawas_evaluasi_pagu','bimtek_perizinan_target','bimtek_perizinan_pagu','bimtek_pengawasan_target','bimtek_pengawasan_pagu','penyelesaian_identifikasi_target','penyelesaian_identifikasi_pagu','penyelesaian_realisasi_target','penyelesaian_realisasi_pagu','penyelesaian_evaluasi_target','penyelesaian_evaluasi_pagu')->where(['periode_id'=>$periode_id])->first();

     }   
        return $perencanaan;

   }


   


   public static function PengawasanAnalisa($perencanaan,$periode_id,$semester_id,$daerah_id){

       if($semester_id =="01")
       {
           $periode_01 = $periode_id.$semester_id; 
           $semester1 = [
               "sub_menu" =>"Analisa",
               "target"=> $perencanaan->pengawas_analisa_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->pengawas_analisa_pagu),
               "realisasi_target_sem_1"=> RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'analisa'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'analisa'))        
           ];

            $data = $semester1;

       }else{

           $periode_01 = $periode_id.'01'; 
           $periode_02 = $periode_id.'02';

           $semester1 = [
               "sub_menu" =>"Analisa",
               "target"=> $perencanaan->pengawas_analisa_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->pengawas_analisa_pagu),
               "realisasi_target_sem_1"=> RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'analisa'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'analisa'))        
           ];


            $semester2 = [
          
               
               "realisasi_target_sem_2"=> RequestDashboard::PengawasanRealisasiTarget($periode_02,$daerah_id,'analisa'),
               "realisasi_apbn_sem_2"=> GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode_02,$daerah_id,'analisa')),
               "realisasi_target"=> RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'analisa') + RequestDashboard::PengawasanRealisasiTarget($periode_02,$daerah_id,'analisa'),
                "realisasi_apbn"=> GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'analisa') + RequestDashboard::PengawasanRealisasiAPBN($periode_02,$daerah_id,'analisa')),
            ];

            $data = array_merge($semester1,$semester2);
       } 

       
        return $data;
   }


   public static function PengawasanInspeksi($perencanaan,$periode_id,$semester_id,$daerah_id){

       if($semester_id =="01")
       {
           $periode_01 = $periode_id.$semester_id; 
           $semester1 = [
               "sub_menu" =>"Inspeksi",
               "target"=> $perencanaan->pengawas_inspeksi_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->pengawas_inspeksi_pagu),
               "realisasi_target_sem_1"=> RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'inspeksi'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'inspeksi'))        
           ];

            $data = $semester1;

       }else{

           $periode_01 = $periode_id.'01'; 
           $periode_02 = $periode_id.'02';

           $semester1 = [
               "sub_menu" =>"Inspeksi",
               "target"=> $perencanaan->pengawas_inspeksi_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->pengawas_inspeksi_pagu),
               "realisasi_target_sem_1"=> RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'inspeksi'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'inspeksi'))        
           ];


            $semester2 = [
          
              
               "realisasi_target_sem_2"=> RequestDashboard::PengawasanRealisasiTarget($periode_02,$daerah_id,'inspeksi'),
               "realisasi_apbn_sem_2"=> GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode_02,$daerah_id,'inspeksi')),
               "realisasi_target"=> RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'inspeksi') + RequestDashboard::PengawasanRealisasiTarget($periode_02,$daerah_id,'inspeksi'),
                "realisasi_apbn"=> GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'inspeksi') + RequestDashboard::PengawasanRealisasiAPBN($periode_02,$daerah_id,'inspeksi')),
            ];

            $data = array_merge($semester1,$semester2);
       } 

       
        return $data;
   }


    public static function PengawasanEvaluasi($perencanaan,$periode_id,$semester_id,$daerah_id){

       if($semester_id =="01")
       {
           $periode_01 = $periode_id.$semester_id; 
           $semester1 = [
               "sub_menu" =>"Evaluasi",
               "target"=> $perencanaan->pengawas_evaluasi_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->pengawas_evaluasi_pagu),
               "realisasi_target_sem_1"=> RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'evaluasi'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'evaluasi'))        
           ];

            $data = $semester1;

       }else{

           $periode_01 = $periode_id.'01'; 
           $periode_02 = $periode_id.'02';

           $semester1 = [
               "sub_menu" =>"Evaluasi",
               "target"=> $perencanaan->pengawas_evaluasi_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->pengawas_evaluasi_pagu),
               "realisasi_target_sem_1"=> RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'evaluasi'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'evaluasi'))        
           ];


            $semester2 = [
          
              
               "realisasi_target_sem_2"=> RequestDashboard::PengawasanRealisasiTarget($periode_02,$daerah_id,'evaluasi'),
               "realisasi_apbn_sem_2"=> GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode_02,$daerah_id,'evaluasi')),
               "realisasi_target"=> RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'evaluasi') + RequestDashboard::PengawasanRealisasiTarget($periode_02,$daerah_id,'evaluasi'),
                "realisasi_apbn"=> GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'evaluasi') + RequestDashboard::PengawasanRealisasiAPBN($periode_02,$daerah_id,'evaluasi')),
            ];

            $data = array_merge($semester1,$semester2);
       } 

       
        return $data;
   }



    public static function BimsosPendamping($perencanaan,$periode_id,$semester_id,$daerah_id){

       if($semester_id =="01")
       {
           $periode_01 = $periode_id.$semester_id; 
           $semester1 = [
               "sub_menu" =>"Honor/Gaji Tenaga Pendamping",
               "target"=> 0,
               "pagu"=> 'Rp 0',
               "realisasi_target_sem_1"=> RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_tenaga_pendamping'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'is_tenaga_pendamping'))        
           ];

            $data = $semester1;

       }else{

           $periode_01 = $periode_id.'01'; 
           $periode_02 = $periode_id.'02';

           $semester1 = [
               "sub_menu" =>"Honor/Gaji Tenaga Pendamping",
               "target"=> 0,
               "pagu"=> 'Rp 0',
               "realisasi_target_sem_1"=> RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_tenaga_pendamping'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'is_tenaga_pendamping'))        
           ];


            $semester2 = [
          
               
               "realisasi_target_sem_2"=> RequestDashboard::BimsosRealisasiTarget($periode_02,$daerah_id,'is_tenaga_pendamping'),
               "realisasi_apbn_sem_2"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'is_tenaga_pendamping')),
               "realisasi_target"=> RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_tenaga_pendamping') + RequestDashboard::BimsosRealisasiTarget($periode_02,$daerah_id,'is_tenaga_pendamping'),
                "realisasi_apbn"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'is_tenaga_pendamping') + RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'is_tenaga_pendamping')),
            ];

            $data = array_merge($semester1,$semester2);
       } 

       
        return $data;
   }


    public static function BimsosPerizinan($perencanaan,$periode_id,$semester_id,$daerah_id){

       if($semester_id =="01")
       {
           $periode_01 = $periode_id.$semester_id; 
           $semester1 = [
               "sub_menu" =>"Bimtek Perizinan Usaha",
               "target"=> $perencanaan->bimtek_perizinan_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->bimtek_perizinan_pagu),
               "realisasi_target_sem_1"=> RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_bimtek_ipbbr'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'is_bimtek_ipbbr'))        
           ];

            $data = $semester1;

       }else{

           $periode_01 = $periode_id.'01'; 
           $periode_02 = $periode_id.'02';

           $semester1 = [
               "sub_menu" =>"Bimtek Perizinan Usaha",
               "target"=> $perencanaan->bimtek_perizinan_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->bimtek_perizinan_pagu),
               "realisasi_target_sem_1"=> RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_bimtek_ipbbr'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'is_bimtek_ipbbr'))        
           ];


            $semester2 = [
          
               
               "realisasi_target_sem_2"=> RequestDashboard::BimsosRealisasiTarget($periode_02,$daerah_id,'is_bimtek_ipbbr'),
               "realisasi_apbn_sem_2"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'is_bimtek_ipbbr')),
               "realisasi_target"=> RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_bimtek_ipbbr') + RequestDashboard::BimsosRealisasiTarget($periode_02,$daerah_id,'is_bimtek_ipbbr'),
                "realisasi_apbn"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'is_bimtek_ipbbr') + RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'is_bimtek_ipbbr')),
            ];

            $data = array_merge($semester1,$semester2);
       } 

       
        return $data;
   }


    public static function BimsosPengawasan($perencanaan,$periode_id,$semester_id,$daerah_id){

       if($semester_id =="01")
       {
           $periode_01 = $periode_id.$semester_id; 
           $semester1 = [
               "sub_menu" =>"Bimtek Pengawasan Perizinan Usaha",
               "target"=> $perencanaan->bimtek_pengawasan_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->bimtek_pengawasan_pagu),
               "realisasi_target_sem_1"=> RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_bimtek_ippbbr'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'is_bimtek_ippbbr'))        
           ];

            $data = $semester1;

       }else{

           $periode_01 = $periode_id.'01'; 
           $periode_02 = $periode_id.'02';

           $semester1 = [
               "sub_menu" =>"Bimtek Pengawasan Perizinan Usaha",
               "target"=> $perencanaan->bimtek_pengawasan_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->bimtek_pengawasan_pagu),
               "realisasi_target_sem_1"=> RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_bimtek_ippbbr'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'is_bimtek_ippbbr'))        
           ];


            $semester2 = [
          
               
               "realisasi_target_sem_2"=> RequestDashboard::BimsosRealisasiTarget($periode_02,$daerah_id,'is_bimtek_ippbbr'),
               "realisasi_apbn_sem_2"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'is_bimtek_ippbbr')),
               "realisasi_target"=> RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_bimtek_ippbbr') + RequestDashboard::BimsosRealisasiTarget($periode_02,$daerah_id,'is_bimtek_ippbbr'),
                "realisasi_apbn"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'is_bimtek_ippbbr') + RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'is_bimtek_ippbbr')),
            ];

            $data = array_merge($semester1,$semester2);
       } 

       
        return $data;
   }



   public static function PenyelesaianIdentifikasi($perencanaan,$periode_id,$semester_id,$daerah_id){

       if($semester_id =="01")
       {
           $periode_01 = $periode_id.$semester_id; 
           $semester1 = [
               "sub_menu" =>"Identifikasi",
               "target"=> $perencanaan->penyelesaian_identifikasi_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->penyelesaian_identifikasi_pagu),
               "realisasi_target_sem_1"=> RequestDashboard::PenyelesaianRealisasiTarget($periode_01,$daerah_id,'identifikasi'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::PenyelesaianRealisasiAPBN($periode_01,$daerah_id,'identifikasi'))        
           ];

            $data = $semester1;

       }else{

           $periode_01 = $periode_id.'01'; 
           $periode_02 = $periode_id.'02';

           $semester1 = [
               "sub_menu" =>"Identifikasi",
               "target"=> $perencanaan->penyelesaian_identifikasi_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->penyelesaian_identifikasi_pagu),
               "realisasi_target_sem_1"=> RequestDashboard::PenyelesaianRealisasiTarget($periode_01,$daerah_id,'identifikasi'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::PenyelesaianRealisasiAPBN($periode_01,$daerah_id,'identifikasi'))        
           ];


            $semester2 = [
          
               
               "realisasi_target_sem_2"=> RequestDashboard::PenyelesaianRealisasiTarget($periode_02,$daerah_id,'identifikasi'),
               "realisasi_apbn_sem_2"=> GeneralHelpers::formatRupiah(RequestDashboard::PenyelesaianRealisasiAPBN($periode_02,$daerah_id,'identifikasi')),
               "realisasi_target"=> RequestDashboard::PenyelesaianRealisasiTarget($periode_01,$daerah_id,'identifikasi') + RequestDashboard::PenyelesaianRealisasiTarget($periode_02,$daerah_id,'identifikasi'),
                "realisasi_apbn"=> GeneralHelpers::formatRupiah(RequestDashboard::PenyelesaianRealisasiAPBN($periode_01,$daerah_id,'identifikasi') + RequestDashboard::PenyelesaianRealisasiAPBN($periode_02,$daerah_id,'identifikasi')),
            ];

            $data = array_merge($semester1,$semester2);
       } 

       
        return $data;
   }

   public static function PenyelesaianRealisasi($perencanaan,$periode_id,$semester_id,$daerah_id){

       if($semester_id =="01")
       {
           $periode_01 = $periode_id.$semester_id; 
           $semester1 = [
               "sub_menu" =>"Realisasi",
               "target"=> $perencanaan->penyelesaian_realisasi_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->penyelesaian_realisasi_pagu),
               "realisasi_target_sem_1"=> RequestDashboard::PenyelesaianRealisasiTarget($periode_01,$daerah_id,'penyelesaian'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::PenyelesaianRealisasiAPBN($periode_01,$daerah_id,'penyelesaian'))        
           ];

            $data = $semester1;

       }else{

           $periode_01 = $periode_id.'01'; 
           $periode_02 = $periode_id.'02';

           $semester1 = [
               "sub_menu" =>"Realisasi",
               "target"=> $perencanaan->penyelesaian_realisasi_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->penyelesaian_realisasi_pagu),
               "realisasi_target_sem_1"=> RequestDashboard::PenyelesaianRealisasiTarget($periode_01,$daerah_id,'penyelesaian'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::PenyelesaianRealisasiAPBN($periode_01,$daerah_id,'penyelesaian'))        
           ];


            $semester2 = [
          
               
               "realisasi_target_sem_2"=> RequestDashboard::PenyelesaianRealisasiTarget($periode_02,$daerah_id,'penyelesaian'),
               "realisasi_apbn_sem_2"=> GeneralHelpers::formatRupiah(RequestDashboard::PenyelesaianRealisasiAPBN($periode_02,$daerah_id,'penyelesaian')),
               "realisasi_target"=> RequestDashboard::PenyelesaianRealisasiTarget($periode_01,$daerah_id,'penyelesaian') + RequestDashboard::PenyelesaianRealisasiTarget($periode_02,$daerah_id,'penyelesaian'),
                "realisasi_apbn"=> GeneralHelpers::formatRupiah(RequestDashboard::PenyelesaianRealisasiAPBN($periode_01,$daerah_id,'penyelesaian') + RequestDashboard::PenyelesaianRealisasiAPBN($periode_02,$daerah_id,'penyelesaian')),
            ];

            $data = array_merge($semester1,$semester2);
       } 

       
        return $data;
   }


   public static function PenyelesaianEvaluasi($perencanaan,$periode_id,$semester_id,$daerah_id){

       if($semester_id =="01")
       {
           $periode_01 = $periode_id.$semester_id; 
           $semester1 = [
               "sub_menu" =>"Evaluasi",
               "target"=> $perencanaan->penyelesaian_evaluasi_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->penyelesaian_evaluasi_pagu),
               "realisasi_target_sem_1"=> RequestDashboard::PenyelesaianRealisasiTarget($periode_01,$daerah_id,'evaluasi'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::PenyelesaianRealisasiAPBN($periode_01,$daerah_id,'evaluasi'))        
           ];

            $data = $semester1;

       }else{

           $periode_01 = $periode_id.'01'; 
           $periode_02 = $periode_id.'02';

           $semester1 = [
               "sub_menu" =>"Evaluasi",
               "target"=> $perencanaan->penyelesaian_evaluasi_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->penyelesaian_evaluasi_pagu),
               "realisasi_target_sem_1"=> RequestDashboard::PenyelesaianRealisasiTarget($periode_01,$daerah_id,'evaluasi'),
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::PenyelesaianRealisasiAPBN($periode_01,$daerah_id,'evaluasi'))        
           ];


            $semester2 = [
          
               
               "realisasi_target_sem_2"=> RequestDashboard::PenyelesaianRealisasiTarget($periode_02,$daerah_id,'evaluasi'),
               "realisasi_apbn_sem_2"=> GeneralHelpers::formatRupiah(RequestDashboard::PenyelesaianRealisasiAPBN($periode_02,$daerah_id,'evaluasi')),
               "realisasi_target"=> RequestDashboard::PenyelesaianRealisasiTarget($periode_01,$daerah_id,'evaluasi') + RequestDashboard::PenyelesaianRealisasiTarget($periode_02,$daerah_id,'evaluasi'),
                "realisasi_apbn"=> GeneralHelpers::formatRupiah(RequestDashboard::PenyelesaianRealisasiAPBN($periode_01,$daerah_id,'evaluasi') + RequestDashboard::PenyelesaianRealisasiAPBN($periode_02,$daerah_id,'evaluasi')),
            ];

            $data = array_merge($semester1,$semester2);
       } 

       
        return $data;
   }

   
    public static function PengawasanTotalHeader($perencanaan,$periode_id,$semester_id,$daerah_id){

        if($semester_id =="01")
       {
           $periode_01 = $periode_id.$semester_id; 

           $data = [
               "sub_menu" =>"Total",
               "target"=> $perencanaan->pengawas_analisa_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->pengawas_analisa_pagu + $perencanaan->pengawas_inspeksi_pagu + $perencanaan->pengawas_evaluasi_pagu) ,


               "realisasi_target_sem_1"=> RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'analisa') + RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'inspeksi') + RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'evaluasi'),
               


               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'analisa') + RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'inspeksi') + RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'evaluasi')),
           ];
         }else{

           $periode_01 = $periode_id.'01'; 
           $periode_02 = $periode_id.'02';

            $semester1 = [
               "sub_menu" =>"Total",
               "target"=> $perencanaan->pengawas_analisa_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->pengawas_analisa_pagu + $perencanaan->pengawas_inspeksi_pagu + $perencanaan->pengawas_evaluasi_pagu) ,
              
               "realisasi_target_sem_1"=> RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'analisa') + RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'inspeksi') + RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'evaluasi'),


               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'analisa') + RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'inspeksi') + RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'evaluasi')),
           ];

            $semester2 = [
          
              
               "realisasi_target_sem_2"=> RequestDashboard::PengawasanRealisasiTarget($periode_02,$daerah_id,'analisa') + RequestDashboard::PengawasanRealisasiTarget($periode_02,$daerah_id,'inspeksi') + RequestDashboard::PengawasanRealisasiTarget($periode_02,$daerah_id,'evaluasi'),

               
               "realisasi_apbn_sem_2"=> GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode_02,$daerah_id,'analisa') + RequestDashboard::PengawasanRealisasiAPBN($periode_02,$daerah_id,'inspeksi') + RequestDashboard::PengawasanRealisasiAPBN($periode_02,$daerah_id,'evaluasi')),


               "realisasi_target"=> RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'analisa') + RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'inspeksi') + RequestDashboard::PengawasanRealisasiTarget($periode_01,$daerah_id,'evaluasi') + RequestDashboard::PengawasanRealisasiTarget($periode_02,$daerah_id,'analisa') + RequestDashboard::PengawasanRealisasiTarget($periode_02,$daerah_id,'inspeksi') + RequestDashboard::PengawasanRealisasiTarget($periode_02,$daerah_id,'evaluasi'),



                "realisasi_apbn"=> GeneralHelpers::formatRupiah(RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'analisa') + RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'inspeksi') + RequestDashboard::PengawasanRealisasiAPBN($periode_01,$daerah_id,'evaluasi') + RequestDashboard::PengawasanRealisasiAPBN($periode_02,$daerah_id,'analisa') + RequestDashboard::PengawasanRealisasiAPBN($periode_02,$daerah_id,'inspeksi') + RequestDashboard::PengawasanRealisasiAPBN($periode_02,$daerah_id,'evaluasi')),
            ];

            $data = array_merge($semester1,$semester2);
           

        }      

       return $data;

   }

   
   public static function BimsosTotalHeader($perencanaan,$periode_id,$semester_id,$daerah_id){

        if($semester_id =="01")
       {
           $periode_01 = $periode_id.$semester_id; 

           $data = [
               "sub_menu" =>"Total",
               "target"=> $perencanaan->bimtek_perizinan_target + $perencanaan->bimtek_pengawasan_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->bimtek_perizinan_pagu + $perencanaan->bimtek_pengawasan_pagu) ,


               "realisasi_target_sem_1"=> RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_tenaga_pendamping') +RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_bimtek_ipbbr') + RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_bimtek_ippbbr'),
               


               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'is_bimtek_ipbbr') + RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'is_bimtek_ippbbr')),
           ];
         }else{

           $periode_01 = $periode_id.'01'; 
           $periode_02 = $periode_id.'02';

            $semester1 = [
               "sub_menu" =>"Total",
               "target"=> $perencanaan->bimtek_perizinan_target + $perencanaan->bimtek_pengawasan_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->bimtek_perizinan_pagu + $perencanaan->bimtek_pengawasan_pagu) ,
              
               "realisasi_target_sem_1"=> RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_tenaga_pendamping') +RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_bimtek_ipbbr') + RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_bimtek_ippbbr'),
               
               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'is_tenaga_pendamping') + 
RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'is_bimtek_ipbbr') + RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'is_bimtek_ippbbr'))
           ];

            $semester2 = [
          
              
                "realisasi_target_sem_2"=> RequestDashboard::BimsosRealisasiTarget($periode_02,$daerah_id,'is_tenaga_pendamping') +RequestDashboard::BimsosRealisasiTarget($periode_02,$daerah_id,'is_bimtek_ipbbr') + RequestDashboard::BimsosRealisasiTarget($periode_02,$daerah_id,'is_bimtek_ippbbr'),

               
                "realisasi_apbn_sem_2"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'is_tenaga_pendamping') + RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'is_bimtek_ipbbr') + RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'is_bimtek_ippbbr')),

               "realisasi_target"=> RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_tenaga_pendamping') + RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_bimtek_ipbbr') + RequestDashboard::BimsosRealisasiTarget($periode_01,$daerah_id,'is_bimtek_ippbbr') + RequestDashboard::BimsosRealisasiTarget($periode_02,$daerah_id,'is_tenaga_pendamping')  + RequestDashboard::BimsosRealisasiTarget($periode_02,$daerah_id,'is_bimtek_ipbbr') + RequestDashboard::BimsosRealisasiTarget($periode_02,$daerah_id,'is_bimtek_ippbbr'),

                 
               "realisasi_apbn"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'is_tenaga_pendamping') + RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'is_bimtek_ipbbr') + RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'is_bimtek_ippbbr') + RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'is_tenaga_pendamping') + RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'is_bimtek_ipbbr') + RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'is_bimtek_ippbbr')),
            
            ];

            $data = array_merge($semester1,$semester2);
           

        }      

       return $data;

   }


     public static function PenyelesaianTotalHeader($perencanaan,$periode_id,$semester_id,$daerah_id){

        if($semester_id =="01")
       {
           $periode_01 = $periode_id.$semester_id; 

           $data = [
               "sub_menu" =>"Total",
               "target"=> $perencanaan->penyelesaian_realisasi_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->penyelesaian_identifikasi_pagu + $perencanaan->penyelesaian_realisasi_pagu + $perencanaan->penyelesaian_evaluasi_pagu) ,


               "realisasi_target_sem_1"=>  RequestDashboard::PenyelesaianRealisasiTarget($periode_01,$daerah_id,'identifikasi') + RequestDashboard::PenyelesaianRealisasiTarget($periode_01,$daerah_id,'penyelesaian') +  RequestDashboard::PenyelesaianRealisasiTarget($periode_01,$daerah_id,'evaluasi'),
               


               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'identifikasi') + RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'penyelesaian') +  RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'evaluasi')),
           ];
         }else{

           $periode_01 = $periode_id.'01'; 
           $periode_02 = $periode_id.'02';

            $semester1 = [
               "sub_menu" =>"Total",
               "target"=>  $perencanaan->penyelesaian_realisasi_target,
               "pagu"=> GeneralHelpers::formatRupiah($perencanaan->penyelesaian_identifikasi_pagu + $perencanaan->penyelesaian_realisasi_pagu + $perencanaan->penyelesaian_evaluasi_pagu) ,
              
               "realisasi_target_sem_1"=>  RequestDashboard::PenyelesaianRealisasiTarget($periode_01,$daerah_id,'penyelesaian') ,
               


               "realisasi_apbn_sem_1"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'identifikasi') + RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'penyelesaian') +  RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'evaluasi')),
           ];

            $semester2 = [
          
              
                "realisasi_target_sem_2"=>  RequestDashboard::PenyelesaianRealisasiTarget($periode_02,$daerah_id,'penyelesaian'),
               


               "realisasi_apbn_sem_2"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'identifikasi') + RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'penyelesaian') +  RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'evaluasi')),

               "realisasi_target"=>  RequestDashboard::PenyelesaianRealisasiTarget($periode_01,$daerah_id,'penyelesaian') +   RequestDashboard::PenyelesaianRealisasiTarget($periode_02,$daerah_id,'penyelesaian'),

                 
               "realisasi_apbn"=> GeneralHelpers::formatRupiah(RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'identifikasi') + RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'penyelesaian') +  RequestDashboard::BimsosRealisasiAPBN($periode_01,$daerah_id,'evaluasi') + RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'identifikasi') + RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'penyelesaian') +  RequestDashboard::BimsosRealisasiAPBN($periode_02,$daerah_id,'evaluasi')),
            
            ];

            $data = array_merge($semester1,$semester2);
           

        }      

       return $data;

   }


   public static function PengawasanRealisasiTarget($periode,$daerah_id,$type){

     $access = RequestAuth::Access();
     if($access == 'province' || $access =='daerah')
     {
        $data = Pengawasan::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id,'sub_menu_slug'=>$type])->count();
     }else{
        if($daerah_id =="")
        {
            $data = Pengawasan::where(['status_laporan_id'=>'14','periode_id'=>$periode,'sub_menu_slug'=>$type])->count();
        }else{
            $data = Pengawasan::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id,'sub_menu_slug'=>$type])->count();
        }    
      

     } 
      return $data;
       

   }


   public static function PengawasanRealisasiAPBN($periode,$daerah_id,$type)
   {
     
     $access = RequestAuth::Access();
     if($access == 'province' || $access =='daerah')
     {
       $data = Pengawasan::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id,'sub_menu_slug'=>$type])->sum('biaya_kegiatan');

      }else{
      
        if($daerah_id =="")
        {

           $data = Pengawasan::where(['status_laporan_id'=>'14','periode_id'=>$periode,'sub_menu_slug'=>$type])->sum('biaya_kegiatan');
        }else{

            $data = Pengawasan::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id,'sub_menu_slug'=>$type])->sum('biaya_kegiatan');
        }    

      }  
       return $data;

   }


   public static function BimsosRealisasiTarget($periode,$daerah_id,$type){

     $access = RequestAuth::Access();
     if($access == 'province' || $access =='daerah')
     {
        if($type == 'is_tenaga_pendamping')
        {
              $data = Bimsos::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id,'sub_menu_slug'=>$type])->count(); 
        }else{
              $data = Bimsos::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id,'sub_menu_slug'=>$type])->sum('jml_peserta');  
        }    
    
     }else{
        
        if($daerah_id =="")
        {
           if($type == 'is_tenaga_pendamping')
           {
                $data = Bimsos::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id,'sub_menu_slug'=>$type])->count(); 
           }else{
                $data = Bimsos::where(['status_laporan_id'=>'14','periode_id'=>$periode,'sub_menu_slug'=>$type])->sum('jml_peserta');
           } 

         
        }else{

            if($type == 'is_tenaga_pendamping')
           {
                $data = Bimsos::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id,'sub_menu_slug'=>$type])->count(); 

           }else{

               $data = Bimsos::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id,'sub_menu_slug'=>$type])->sum('jml_peserta');
           } 

          
        }    

     }  
      return $data;
       

   }


   public static function BimsosRealisasiAPBN($periode,$daerah_id,$type)
   {

     $access = RequestAuth::Access();
     if($access == 'province' || $access =='daerah')
     {

       $data = Bimsos::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id,'sub_menu_slug'=>$type])->sum('biaya_kegiatan');

     }else{
        
        if($daerah_id =="")
        {
            $data = Bimsos::where(['status_laporan_id'=>'14','periode_id'=>$periode,'sub_menu_slug'=>$type])->sum('biaya_kegiatan');
        }else{

            $data = Bimsos::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id,'sub_menu_slug'=>$type])->sum('biaya_kegiatan');
        } 

     }  
       return $data;

   }


   public static function PenyelesaianRealisasiTarget($periode,$daerah_id,$type){

     $access = RequestAuth::Access();
     if($access == 'province' || $access =='daerah')
     {
        $data = Penyelesaian::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id,'sub_menu_slug'=>$type])->sum('jml_perusahaan');
     }else{

        if($daerah_id =="")
        {
            $data = Penyelesaian::where(['status_laporan_id'=>'14','periode_id'=>$periode,'sub_menu_slug'=>$type])->sum('jml_perusahaan');
        }else{

             $data = Penyelesaian::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id,'sub_menu_slug'=>$type])->sum('jml_perusahaan');
        }    
     } 
      return $data;
       

   }


   public static function PenyelesaianRealisasiAPBN($periode,$daerah_id,$type)
   {
     $access = RequestAuth::Access();
     if($access == 'province' || $access =='daerah')
     {  
       $data = Penyelesaian::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id,'sub_menu_slug'=>$type])->sum('biaya');
     }else{
       
        if($daerah_id =="")
        {
             $data = Penyelesaian::where(['status_laporan_id'=>'14','periode_id'=>$periode,'sub_menu_slug'=>$type])->sum('biaya');
        }else{
              $data = Penyelesaian::where(['status_laporan_id'=>'14','periode_id'=>$periode,'daerah_id'=>$daerah_id,'sub_menu_slug'=>$type])->sum('biaya');

        }    

     }  
       return $data;

   }

  
   

  

   

}
<?php

namespace App\Http\Request;

use DB;
use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\PaguTarget;
use App\Models\Promosi;
use App\Http\Request\RequestDaerah;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestMenuRoles;
use App\Http\Request\RequestPaguTarget;


class RequestPromosi
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
         $temp[$key]['tgl_awal_peluang'] = $val->tgl_awal_peluang;
         $temp[$key]['tgl_ahir_peluang'] = $val->tgl_ahir_peluang;
         $temp[$key]['budget_peluang'] = $val->budget_peluang;
         $temp[$key]['keterangan_peluang'] = $val->keterangan_peluang;
         $temp[$key]['tgl_awal_storyline'] = $val->tgl_awal_storyline;
         $temp[$key]['tgl_ahir_storyline'] = $val->tgl_ahir_storyline;
         $temp[$key]['budget_storyline'] = $val->budget_storyline;
         $temp[$key]['keterangan_storyline'] = $val->keterangan_storyline;
         $temp[$key]['tgl_awal_storyboard'] = $val->tgl_awal_storyboard;
         $temp[$key]['tgl_ahir_storyboard'] = $val->tgl_ahir_storyboard;
         $temp[$key]['budget_storyboard'] = $val->budget_storyboard;
         $temp[$key]['keterangan_storyboard'] = $val->keterangan_storyboard;
         $temp[$key]['tgl_awal_lokasi'] = $val->tgl_awal_lokasi;
         $temp[$key]['tgl_ahir_lokasi'] = $val->tgl_ahir_lokasi;
         $temp[$key]['budget_lokasi'] = $val->budget_lokasi;
         $temp[$key]['keterangan_lokasi'] = $val->keterangan_lokasi;
         $temp[$key]['tgl_awal_talent'] = $val->tgl_awal_talent;
         $temp[$key]['tgl_ahir_talent'] = $val->tgl_ahir_talent;
         $temp[$key]['budget_talent'] = $val->budget_talent;
         $temp[$key]['keterangan_talent'] = $val->keterangan_talent;
         $temp[$key]['tgl_awal_testimoni'] = $val->tgl_awal_testimoni;
         $temp[$key]['tgl_ahir_testimoni'] = $val->tgl_ahir_testimoni;
         $temp[$key]['budget_testimoni'] = $val->budget_testimoni;
         $temp[$key]['keterangan_testimoni'] = $val->keterangan_testimoni;
         $temp[$key]['tgl_awal_audio'] = $val->tgl_awal_audio;
         $temp[$key]['tgl_ahir_audio'] = $val->tgl_ahir_audio;
         $temp[$key]['budget_audio'] = $val->budget_audio;
         $temp[$key]['keterangan_audio'] = $val->keterangan_audio;
         $temp[$key]['tgl_awal_editing'] = $val->tgl_awal_editing;
         $temp[$key]['tgl_ahir_editing'] = $val->tgl_ahir_editing;
         $temp[$key]['budget_editing'] = $val->budget_editing;
         $temp[$key]['keterangan_editing'] = $val->keterangan_editing;
         $temp[$key]['total_pra_produksi'] = GeneralHelpers::formatRupiah($val->budget_peluang + $val->budget_storyline + $val->budget_storyboard + $val->budget_lokasi + $val->budget_talent +  $val->budget_testimoni + $val->budget_audio + $val->budget_editing);


         $temp[$key]['tgl_awal_gambar'] = $val->tgl_awal_gambar;
         $temp[$key]['tgl_ahir_gambar'] = $val->tgl_ahir_gambar;
         $temp[$key]['budget_gambar'] = $val->budget_gambar;
         $temp[$key]['keterangan_gambar'] = $val->keterangan_gambar;
         $temp[$key]['tgl_awal_video'] = $val->tgl_awal_video;
         $temp[$key]['tgl_ahir_video'] = $val->tgl_ahir_video;
         $temp[$key]['budget_video'] = $val->budget_video;
         $temp[$key]['keterangan_video'] = $val->keterangan_video;
         $temp[$key]['total_produksi'] =  GeneralHelpers::formatRupiah($val->budget_gambar + $val->budget_video);

         $temp[$key]['tgl_awal_editvideo'] = $val->tgl_awal_editvideo;
         $temp[$key]['tgl_ahir_editvideo'] = $val->tgl_ahir_editvideo;
         $temp[$key]['budget_editvideo'] = $val->budget_editvideo;
         $temp[$key]['keterangan_editvideo'] = $val->keterangan_editvideo;
         $temp[$key]['tgl_awal_grafik'] = $val->tgl_awal_grafik;
         $temp[$key]['tgl_ahir_grafik'] = $val->tgl_ahir_grafik;
         $temp[$key]['budget_grafik'] = $val->budget_grafik;
         $temp[$key]['keterangan_grafik'] = $val->keterangan_grafik;
         $temp[$key]['tgl_awal_mixing'] = $val->tgl_awal_mixing;
         $temp[$key]['tgl_ahir_mixing'] = $val->tgl_ahir_mixing;
         $temp[$key]['budget_mixing'] = $val->budget_mixing;
         $temp[$key]['keterangan_mixing'] = $val->keterangan_mixing;
         $temp[$key]['tgl_awal_voice'] = $val->tgl_awal_voice;
         $temp[$key]['tgl_ahir_voice'] = $val->tgl_ahir_voice;
         $temp[$key]['budget_voice'] = $val->budget_voice;
         $temp[$key]['keterangan_voice'] = $val->keterangan_voice;
         $temp[$key]['tgl_awal_subtitle'] = $val->tgl_awal_subtitle;
         $temp[$key]['tgl_ahir_subtitle'] = $val->tgl_ahir_subtitle;
         $temp[$key]['budget_subtitle'] = $val->budget_subtitle;
         $temp[$key]['keterangan_subtitle'] = $val->keterangan_subtitle;
         $temp[$key]['total_pasca_produksi'] = GeneralHelpers::formatRupiah($val->budget_editvideo + $val->budget_grafik + $val->budget_mixing + $val->budget_voice + $val->budget_subtitle); 
           
         $temp[$key]['total_budget'] = GeneralHelpers::formatRupiah($val->budget_peluang + $val->budget_storyline + $val->budget_storyboard + $val->budget_lokasi + $val->budget_talent +  $val->budget_testimoni + $val->budget_audio + $val->budget_editing + $val->budget_gambar + $val->budget_video + $val->budget_editvideo + $val->budget_grafik + $val->budget_mixing + $val->budget_voice + $val->budget_subtitle);  

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
                $result['pagu_promosi'] = 'Rp 0';
                $result['total_promosi'] = GeneralHelpers::formatRupiah(RequestPromosi::TotalPromosi($year,Auth::User()->daerah_id));
           }else{
               $result['pagu_promosi'] = GeneralHelpers::formatRupiah(RequestPaguTarget::PaguPromosi($year,Auth::User()->daerah_id));

               $result['total_promosi'] = GeneralHelpers::formatRupiah(RequestPromosi::TotalPromosi($year,Auth::User()->daerah_id));
           } 
         
      }else{
          $result['periode_id'] = '';
          $result['pagu_promosi'] = 'Rp 0';
          $result['total_promosi'] =  'Rp 0'; 
      }

      $result['total_daerah'] = Promosi::groupBy('daerah_id')->count();
      $result['total_requestedit'] = Promosi::where(['request_edit'=>'true'])->count();
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

   public static function TotalPromosi($year,$daerah_id){

     $access = RequestAuth::Access();  
     if($access =='province')
     {
        $data = Promosi::select(DB::raw('SUM(budget_peluang + budget_storyline + budget_storyboard + budget_lokasi + budget_talent + budget_testimoni + budget_audio + budget_editing + budget_gambar + budget_video + budget_editvideo + budget_grafik + budget_mixing + budget_voice + budget_subtitle) as total '))->where(['periode_id'=>$year,'daerah_id'=>$daerah_id])->first()->total;

       
     }else if($access =='pusat'){

         $data = Promosi::select(DB::raw('SUM(budget_peluang + budget_storyline + budget_storyboard + budget_lokasi + budget_talent + budget_testimoni + budget_audio + budget_editing + budget_gambar + budget_video + budget_editvideo + budget_grafik + budget_mixing + budget_voice + budget_subtitle) as total '))->where(['periode_id'=>$year])->first()->total;

       

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
         
         $temp['tgl_awal_peluang'] = $val->tgl_awal_peluang;
         $temp['tgl_ahir_peluang'] = $val->tgl_ahir_peluang;
         $temp['budget_peluang'] = $val->budget_peluang;
         $temp['keterangan_peluang'] = $val->keterangan_peluang;
         $temp['tgl_awal_storyline'] = $val->tgl_awal_storyline;
         $temp['tgl_ahir_storyline'] = $val->tgl_ahir_storyline;
         $temp['budget_storyline'] = $val->budget_storyline;
         $temp['keterangan_storyline'] = $val->keterangan_storyline;
         $temp['tgl_awal_storyboard'] = $val->tgl_awal_storyboard;
         $temp['tgl_ahir_storyboard'] = $val->tgl_ahir_storyboard;
         $temp['budget_storyboard'] = $val->budget_storyboard;
         $temp['keterangan_storyboard'] = $val->keterangan_storyboard;
         $temp['tgl_awal_lokasi'] = $val->tgl_awal_lokasi;
         $temp['tgl_ahir_lokasi'] = $val->tgl_ahir_lokasi;
         $temp['budget_lokasi'] = $val->budget_lokasi;
         $temp['keterangan_lokasi'] = $val->keterangan_lokasi;
         $temp['tgl_awal_talent'] = $val->tgl_awal_talent;
         $temp['tgl_ahir_talent'] = $val->tgl_ahir_talent;
         $temp['budget_talent'] = $val->budget_talent;
         $temp['keterangan_talent'] = $val->keterangan_talent;
         $temp['tgl_awal_testimoni'] = $val->tgl_awal_testimoni;
         $temp['tgl_ahir_testimoni'] = $val->tgl_ahir_testimoni;
         $temp['budget_testimoni'] = $val->budget_testimoni;
         $temp['keterangan_testimoni'] = $val->keterangan_testimoni;
         $temp['tgl_awal_audio'] = $val->tgl_awal_audio;
         $temp['tgl_ahir_audio'] = $val->tgl_ahir_audio;
         $temp['budget_audio'] = $val->budget_audio;
         $temp['keterangan_audio'] = $val->keterangan_audio;
         $temp['tgl_awal_editing'] = $val->tgl_awal_editing;
         $temp['tgl_ahir_editing'] = $val->tgl_ahir_editing;
         $temp['budget_editing'] = $val->budget_editing;
         $temp['keterangan_editing'] = $val->keterangan_editing;
         $temp['total_pra_produksi'] = GeneralHelpers::formatRupiah($val->budget_peluang + $val->budget_storyline + $val->budget_storyboard + $val->budget_lokasi + $val->budget_talent +  $val->budget_testimoni + $val->budget_audio + $val->budget_editing);


         $temp['tgl_awal_gambar'] = $val->tgl_awal_gambar;
         $temp['tgl_ahir_gambar'] = $val->tgl_ahir_gambar;
         $temp['budget_gambar'] = $val->budget_gambar;
         $temp['keterangan_gambar'] = $val->keterangan_gambar;
         $temp['tgl_awal_video'] = $val->tgl_awal_video;
         $temp['tgl_ahir_video'] = $val->tgl_ahir_video;
         $temp['budget_video'] = $val->budget_video;
         $temp['keterangan_video'] = $val->keterangan_video;
         $temp['total_produksi'] =  GeneralHelpers::formatRupiah($val->budget_gambar + $val->budget_video);

         $temp['tgl_awal_editvideo'] = $val->tgl_awal_editvideo;
         $temp['tgl_ahir_editvideo'] = $val->tgl_ahir_editvideo;
         $temp['budget_editvideo'] = $val->budget_editvideo;
         $temp['keterangan_editvideo'] = $val->keterangan_editvideo;
         $temp['tgl_awal_grafik'] = $val->tgl_awal_grafik;
         $temp['tgl_ahir_grafik'] = $val->tgl_ahir_grafik;
         $temp['budget_grafik'] = $val->budget_grafik;
         $temp['keterangan_grafik'] = $val->keterangan_grafik;
         $temp['tgl_awal_mixing'] = $val->tgl_awal_mixing;
         $temp['tgl_ahir_mixing'] = $val->tgl_ahir_mixing;
         $temp['budget_mixing'] = $val->budget_mixing;
         $temp['keterangan_mixing'] = $val->keterangan_mixing;
         $temp['tgl_awal_voice'] = $val->tgl_awal_voice;
         $temp['tgl_ahir_voice'] = $val->tgl_ahir_voice;
         $temp['budget_voice'] = $val->budget_voice;
         $temp['keterangan_voice'] = $val->keterangan_voice;
         $temp['tgl_awal_subtitle'] = $val->tgl_awal_subtitle;
         $temp['tgl_ahir_subtitle'] = $val->tgl_ahir_subtitle;
         $temp['budget_subtitle'] = $val->budget_subtitle;
         $temp['keterangan_subtitle'] = $val->keterangan_subtitle;
         
         $temp['total_pasca_produksi'] = GeneralHelpers::formatRupiah($val->budget_editvideo + $val->budget_grafik + $val->budget_mixing + $val->budget_voice + $val->budget_subtitle); 
         $temp['created_by'] = $val->created_by;
         $temp['request_edit'] = $val->request_edit;
         $temp['checklist'] = $val->checklist;
         $temp['access'] = RequestAuth::Access();
         $temp['alasan'] = $val->alasan;
         $temp['status'] = array('status_db' => $val->status_laporan_id, 'status_convert' => $status);

         $temp['pagu_promosi_convert'] =  GeneralHelpers::formatRupiah(RequestPaguTarget::PaguPromosi($val->periode_id,$val->daerah_id));
         $temp['total_promosi_convert'] = GeneralHelpers::formatRupiah($val->budget_peluang + $val->budget_storyline + $val->budget_storyboard + $val->budget_lokasi + $val->budget_talent +  $val->budget_testimoni + $val->budget_audio + $val->budget_editing + $val->budget_gambar + $val->budget_video + $val->budget_editvideo + $val->budget_grafik + $val->budget_mixing + $val->budget_voice + $val->budget_subtitle);
         $temp['pagu_promosi'] =  RequestPaguTarget::PaguPromosi($val->periode_id,$val->daerah_id);
         $temp['total_promosi'] = $val->budget_peluang + $val->budget_storyline + $val->budget_storyboard + $val->budget_lokasi + $val->budget_talent +  $val->budget_testimoni + $val->budget_audio + $val->budget_editing + $val->budget_gambar + $val->budget_video + $val->budget_editvideo + $val->budget_grafik + $val->budget_mixing + $val->budget_voice + $val->budget_subtitle;  
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

  

   public static function fieldsData($request)
   {
      

      $fields = [
         'daerah_id'  =>  Auth::User()->daerah_id,
         'periode_id' => $request->periode_id,

         'tgl_awal_peluang' => $request->tgl_awal_peluang,
         'tgl_ahir_peluang' => $request->tgl_ahir_peluang,
         'budget_peluang' => $request->budget_peluang,
         'keterangan_peluang' => $request->keterangan_peluang,

         'tgl_awal_storyline' => $request->tgl_awal_storyline,
         'tgl_ahir_storyline' => $request->tgl_ahir_storyline,
         'budget_storyline' => $request->budget_storyline,
         'keterangan_storyline' => $request->keterangan_storyline,

         'tgl_awal_storyboard' => $request->tgl_awal_storyboard,
         'tgl_ahir_storyboard' => $request->tgl_ahir_storyboard,
         'budget_storyboard' => $request->budget_storyboard,
         'keterangan_storyboard' => $request->keterangan_storyboard,

         'tgl_awal_lokasi' => $request->tgl_awal_lokasi,
         'tgl_ahir_lokasi' => $request->tgl_ahir_lokasi,
         'budget_lokasi' => $request->budget_lokasi,
         'keterangan_lokasi' => $request->keterangan_lokasi,

         'tgl_awal_talent' => $request->tgl_awal_talent,
         'tgl_ahir_talent' => $request->tgl_ahir_talent,
         'budget_talent' => $request->budget_talent,
         'keterangan_talent' => $request->keterangan_talent,

         'tgl_awal_testimoni' => $request->tgl_awal_testimoni,
         'tgl_ahir_testimoni' => $request->tgl_ahir_testimoni,
         'budget_testimoni' => $request->budget_testimoni,
         'keterangan_testimoni' => $request->keterangan_testimoni,

      

         'tgl_awal_audio' => $request->tgl_awal_audio,
         'tgl_ahir_audio' => $request->tgl_ahir_audio,
         'budget_audio' => $request->budget_audio,
         'keterangan_audio' => $request->keterangan_audio,

         'tgl_awal_editing' => $request->tgl_awal_editing,
         'tgl_ahir_editing' => $request->tgl_ahir_editing,
         'budget_editing' => $request->budget_editing,
         'keterangan_editing' => $request->keterangan_editing,

         'tgl_awal_gambar' => $request->tgl_awal_gambar,
         'tgl_ahir_gambar' => $request->tgl_ahir_gambar,
         'budget_gambar' => $request->budget_gambar,
         'keterangan_gambar' => $request->keterangan_gambar,

         'tgl_awal_video' => $request->tgl_awal_video,
         'tgl_ahir_video' => $request->tgl_ahir_video,
         'budget_video' => $request->budget_video,
         'keterangan_video' => $request->keterangan_video,

         'tgl_awal_editvideo' => $request->tgl_awal_editvideo,
         'tgl_ahir_editvideo' => $request->tgl_ahir_editvideo,
         'budget_editvideo' => $request->budget_editvideo,
         'keterangan_editvideo' => $request->keterangan_editvideo,

         'tgl_awal_grafik' => $request->tgl_awal_grafik,
         'tgl_ahir_grafik' => $request->tgl_ahir_grafik,
         'budget_grafik' => $request->budget_grafik,
         'keterangan_grafik' => $request->keterangan_grafik,

         'tgl_awal_mixing' => $request->tgl_awal_mixing,
         'tgl_ahir_mixing' => $request->tgl_ahir_mixing,
         'budget_mixing' => $request->budget_mixing,
         'keterangan_mixing' => $request->keterangan_mixing,


         'tgl_awal_voice' => $request->tgl_awal_voice,
         'tgl_ahir_voice' => $request->tgl_ahir_voice,
         'budget_voice' => $request->budget_voice,
         'keterangan_voice' => $request->keterangan_voice,

         'tgl_awal_subtitle' => $request->tgl_awal_subtitle,
         'tgl_ahir_subtitle' => $request->tgl_ahir_subtitle,
         'budget_subtitle' => $request->budget_subtitle,
         'keterangan_subtitle' => $request->keterangan_subtitle,


         'status_laporan_id' => $request->status_laporan_id,
         'request_edit'=>'false',
         'created_by' => Auth::User()->username,
         'created_at' => date('Y-m-d H:i:s'),
      ];

      return $fields;
   }

   
}

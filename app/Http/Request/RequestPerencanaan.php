<?php

namespace App\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Models\Perencanaan;
use App\Models\Roles;
use App\Models\Periode;
use App\Http\Request\RequestSettingApps;

class RequestPerencanaan 
{

   public static function GetDataAll($data,$perPage,$request)
   {
      $temp = array();
         
        $getRequest = $request->all();
        $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
        $numberNext = (($page*$perPage) - ($perPage-1));
        
        foreach ($data as $key => $val)
        {
           
            $periode = RequestPerencanaan::GetPeriodeYear($val->periode_id);
            if($periode !="")
            {   

                if($val->status =="13"){ $status = 'Draft';}else{ $status = 'Terkirim';  } 
                $temp[$key]['number'] = $numberNext++;
                $temp[$key]['id'] = $val->id;
                $temp[$key]['periode'] =  $periode;
                $temp[$key]['status'] = $status;
                $temp[$key]['created_at'] = GeneralHelpers::dates($val->created_at);
            }
            
        }   
         

            
       
         $result['data'] = $temp;
         $result['current_page'] = $data->currentPage();
         $result['last_page'] = $data->lastPage(); 
        return $result;

   }


   public static function GetPeriodeYear($periode_id){

    $periode = Periode::where('slug',$periode_id)->first();
    if($periode)
    {
        $result = $periode->year;
    }else{
        $result = '';
    }    

      return $result;
   }

   

   public static function GetDaerahID($daerah_id)
    {
       
        $province = DB::table('provinces')->select('id as value','name as text');
        $regency = DB::table('regencies')->select('id as value','name')->where('id', $daerah_id)->union($province)->orderBy('value','ASC')->first();

        return $regency->name;
    }
   
   public static function GetDataID($data)
   {         
           
            $__temp_['id'] = $data->id;
            $__temp_['name'] = $data->name; 
            $__temp_['category'] = $data->category; 
            $__temp_['price'] = $data->price;           
            return $__temp_;
   }

  

   public static function fieldsData($request)
   {
       if($request->type =="draft")
       {
        $status = 13;
       }else{
        $status = 14;
       } 
    
        $fields = [  
                'pengawas_analisa_target'  =>  $request->pengawas_analisa_target,
                'pengawas_analisa_pagu'    =>  $request->pengawas_analisa_pagu,
                'pengawas_inspeksi_target'  =>  $request->pengawas_inspeksi_target,
                'pengawas_inspeksi_pagu'  =>  $request->pengawas_inspeksi_pagu,
                'pengawas_evaluasi_target'  =>  $request->pengawas_evaluasi_target,
                'pengawas_evaluasi_pagu'  =>  $request->pengawas_evaluasi_pagu,

                'bimtek_perizinan_target'  =>  $request->bimtek_perizinan_target,
                'bimtek_perizinan_pagu'    =>  $request->bimtek_perizinan_pagu,
                'bimtek_pengawasan_target'  =>  $request->bimtek_pengawasan_target,
                'bimtek_pengawasan_pagu'  =>  $request->bimtek_pengawasan_pagu,


                'penyelesaian_identifikasi_target'  =>  $request->penyelesaian_identifikasi_target,
                'penyelesaian_identifikasi_pagu'    =>  $request->penyelesaian_identifikasi_pagu,
                'penyelesaian_realisasi_target'  =>  $request->penyelesaian_realisasi_target,
                'penyelesaian_realisasi_pagu'  =>  $request->penyelesaian_realisasi_pagu,
                'penyelesaian_evaluasi_target'  =>  $request->penyelesaian_evaluasi_target,
                'penyelesaian_evaluasi_pagu'  =>  $request->penyelesaian_evaluasi_pagu,
                'periode_id'  =>  $request->periode_id,
                'nama_pejabat'  =>  $request->nama_pejabat,
                'nip_pejabat'  =>  $request->nip_pejabat,
                'tgl_tandatangan'  =>  $request->tgl_tandatangan,
                'lokasi'  =>  $request->lokasi,
                'request_edit' =>'false',
                'status' => $status,
                'periode_id' => $request->periode_id,
                'created_by' => Auth::User()->username,
                'daerah_id' => Auth::User()->daerah_id,
                'created_at' => date('Y-m-d H:i:s'),
        ];
  
        return $fields;

   }

    public static function Rupiah($angka){
    
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
 
  }

   

}
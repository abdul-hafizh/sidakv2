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
use App\Http\Request\RequestPeriode;

class RequestPerencanaan 
{
    
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
        
        foreach ($data as $key => $val)
        {           
            $periode = RequestPerencanaan::GetPeriodeYear($val->periode_id);
            if($periode !="")
            {   
                $status = ($val->status == "13") ? 'Draft' : 'Terkirim';
                $temp[$key]['number'] = $numberNext++;
                $temp[$key]['id'] = $val->id;
                $temp[$key]['periode'] =  $periode;
                $temp[$key]['status'] = $status;
                $temp[$key]['action_status'] = RequestPerencanaan::CheckStatus($val->status);

                $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val->created_at);
            }
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

    public static function CheckStatus($status){

       
        if($status == '13')
        {
           $result =  false;
        }else{
           $result =  true;
        } 

        return  $result;   

    }

    public static function GetDetailID($data){
       $temp = array();
       $temp['id'] = $data->id;
       $temp['periode_id'] = $data->periode_id;
       $temp['periode_name'] = RequestPeriode::GetPeriodeName($data->periode_id);
       $temp['pagu_apbn'] = RequestPeriode::getDetailPagu($data->periode_id,'APBN');
       $temp['pagu_promosi'] = RequestPeriode::getDetailPagu($data->periode_id,'promosi');

       $temp['target_pengawasan'] = RequestPeriode::getDetailPagu($data->periode_id,'pengawasan');
       $temp['target_bimtek'] = RequestPeriode::getDetailPagu($data->periode_id,'bimtek');
       $temp['target_penyelesaian'] = RequestPeriode::getDetailPagu($data->periode_id,'penyelesaian');

       $temp['pengawas_analisa_target'] = $data->pengawas_analisa_target;
       $temp['pengawas_analisa_pagu'] = $data->pengawas_analisa_pagu;
       $temp['pengawas_inspeksi_target'] = $data->pengawas_inspeksi_target;
       $temp['pengawas_inspeksi_pagu'] = $data->pengawas_inspeksi_pagu;
       $temp['pengawas_evaluasi_target'] = $data->pengawas_evaluasi_target;
       $temp['pengawas_evaluasi_pagu'] = $data->pengawas_evaluasi_pagu;
       
       $temp['total_target_pengawasan'] = $data->pengawas_analisa_target + $data->pengawas_inspeksi_target + $data->pengawas_evaluasi_target;
       
       $temp['total_pagu_pengawasan'] = $data->pengawas_analisa_pagu + $data->pengawas_inspeksi_pagu+$data->pengawas_evaluasi_pagu;
       $temp['total_pagu_pengawasan_convert'] = GeneralHelpers::formatRupiah($data->pengawas_analisa_pagu + $data->pengawas_inspeksi_pagu+$data->pengawas_evaluasi_pagu);


       
       $temp['bimtek_perizinan_target'] = $data->bimtek_perizinan_target;
       $temp['bimtek_perizinan_pagu'] = $data->bimtek_perizinan_pagu;
       $temp['bimtek_pengawasan_target'] = $data->bimtek_pengawasan_target;
       $temp['bimtek_pengawasan_pagu'] = $data->bimtek_pengawasan_pagu;

       $temp['total_target_bimtek'] = $data->bimtek_perizinan_target + $data->bimtek_pengawasan_target;
       $temp['total_pagu_bimtek'] = $data->bimtek_perizinan_pagu + $data->bimtek_pengawasan_pagu;
       $temp['total_pagu_bimtek_convert'] = GeneralHelpers::formatRupiah($data->bimtek_perizinan_pagu + $data->bimtek_pengawasan_pagu);



       $temp['penyelesaian_identifikasi_target'] = $data->penyelesaian_identifikasi_target;
       $temp['penyelesaian_identifikasi_pagu'] = $data->penyelesaian_identifikasi_pagu;
       $temp['penyelesaian_realisasi_target'] = $data->penyelesaian_realisasi_target;
       $temp['penyelesaian_realisasi_pagu'] = $data->penyelesaian_realisasi_pagu;
       $temp['penyelesaian_evaluasi_target'] = $data->penyelesaian_evaluasi_target;
       $temp['penyelesaian_evaluasi_pagu'] = $data->penyelesaian_evaluasi_pagu;
       
       $temp['total_target_penyelesaian'] = $data->penyelesaian_identifikasi_target + $data->penyelesaian_realisasi_target + $data->penyelesaian_evaluasi_target;
        $temp['total_pagu_penyelesaian'] = $data->penyelesaian_identifikasi_pagu + $data->penyelesaian_realisasi_pagu + $data->penyelesaian_evaluasi_pagu;
       $temp['total_pagu_penyelesaian_convert'] = GeneralHelpers::formatRupiah($data->penyelesaian_identifikasi_pagu + $data->penyelesaian_realisasi_pagu + $data->penyelesaian_evaluasi_pagu);
       
       
        $temp['total_rencana'] =  GeneralHelpers::formatRupiah($data->pengawas_analisa_pagu + $data->pengawas_inspeksi_pagu+$data->pengawas_evaluasi_pagu + $data->bimtek_perizinan_pagu + $data->bimtek_pengawasan_pagu + $data->penyelesaian_identifikasi_pagu + $data->penyelesaian_realisasi_pagu + $data->penyelesaian_evaluasi_pagu); 

       
       $temp['lokasi'] = $data->lokasi;
       $temp['tgl_tandatangan'] = $data->tgl_tandatangan;
       $temp['nama_pejabat'] = $data->nama_pejabat;
       $temp['nip_pejabat'] = $data->nip_pejabat;

      return $temp; 

    }

    public static function GetPeriodeYear($periode_id){

        $periode = Periode::where('slug',$periode_id)->first();

        if($periode)
        {
            $result = $periode->year;

        } else {

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
        $status = ($request->type == "draft") ? 13 : 14;
    
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
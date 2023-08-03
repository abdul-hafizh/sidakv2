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
        $template = RequestSettingApps::AppsTemplate();
   	    foreach ($data as $key => $val)
        {         

            if($val->status =="13") { $status = 'Terkirim'; } else { $status = 'Draft';  } 

            $temp[$key]['id'] = $val->id;
            $temp[$key]['lokasi'] = $val->lokasi;
            $temp[$key]['nama_pejabat'] = $val->nama_pejabat;
            $temp[$key]['number'] = $numberNext++;
            $temp[$key]['periode_id'] = Periode::where('slug', $val->periode_id)->first()->year;
            $temp[$key]['daerah_id'] = RequestPerencanaan::GetDaerahID($val->daerah_id);
            $temp[$key]['status'] = $status;
            $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val['created_at']);
        }

        return json_decode(json_encode($temp),FALSE);
       

   }

   public function GetDaerahID($daerah_id)
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
    
        $fields = [  
                'lokasi'  =>  $request->lokasi,
                'nama_pejabat'  =>  $request->nama_pejabat,
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
        ];
  
        return $fields;

   }

    public static function Rupiah($angka){
    
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
 
  }

   

}
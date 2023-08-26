<?php

namespace App\Http\Request;

use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\PaguTarget;
use App\Models\Periode;
use App\Models\Perencanaan;
use DB;

class RequestPeriode
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
         if ($val->status == 'A') {
            $status = 'Aktif';
         } else {
            $status = 'Non Aktif';
         };

         $temp[$key]['number'] = $numberNext++;
         $temp[$key]['id'] = $val->id;
         $temp[$key]['name'] = $val->name;
         $temp[$key]['semester'] = $val->semester;
         $temp[$key]['year'] = $val->year;
         $temp[$key]['slug'] = $val->slug;
         $temp[$key]['deleted'] = RequestPeriode::checkValidate($val->slug);
         $temp[$key]['status'] = array('status_db' => $val->status, 'status_convert' => $status);

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

   public static function SelectAll($data)
   {
         $temp = array();
       

         foreach ($data as $key => $val) {

            $temp[$key]['value'] = (string)$val->slug;
            $temp[$key]['text'] = 'Periode '.$val->year;
            $temp[$key]['pagu_apbn'] = RequestPeriode::Pagu('APBN', substr((string)$val->slug, 0, 4));
            $temp[$key]['pagu_promosi'] = RequestPeriode::Pagu('promosi', substr((string)$val->slug, 0, 4));
         }
       


      return  $temp;
   }

   public static function checkValidate($slug){

       $data = Perencanaan::where('periode_id',$slug)->first();
       if($data)
       {
          $result = 'disabled';
       }else{
          $result = '';
       } 

       return $result;
  }

   public static function Pagu($type, $periode_id)
   {
      $pagu = PaguTarget::where(DB::raw("LEFT(periode_id,4)"), $periode_id)->first();
      if ($pagu) {
         if ($type == 'APBN') {
            if ($pagu->pagu_apbn != 0) {
               $result =  GeneralHelpers::formatRupiah($pagu->pagu_apbn);
            } else {
               $result = 'Rp 0';
            }
         } else {
            if ($pagu->pagu_promosi != 0) {
               $result = GeneralHelpers::formatRupiah($pagu->pagu_promosi);
            } else {
               $result = 'Rp 0';
            }
         }
      } else {
         $result = 'Rp 0';
      }
      return $result;
   }

   public static function GetDataID($data)
   {

      $__temp_['id'] = $data->id;
      $__temp_['name'] = $data->name;
      $__temp_['slug'] = $data->slug;
      $__temp_['semester'] = $data->semester;
      $__temp_['year'] = $data->year;
      $__temp_['status'] = $data->status;
      return $__temp_;
   }



   public static function fieldsData($request)
   {

      $fields = [
         'name'  =>  $request->name,
         'slug' =>  $request->year.$request->semester,
         'semester' => $request->semester,
         'year' => $request->year,
         'status' => $request->status,
         'created_by' => Auth::User()->username,
         'created_at' => date('Y-m-d H:i:s'),
      ];

      return $fields;
   }


   public function GetPeriodeID()
   {

      $periode = Periode::select('id as value', 'name as text', 'slug')->orderBy('slug', 'ASC')->get();

      return $periode;
   }
}

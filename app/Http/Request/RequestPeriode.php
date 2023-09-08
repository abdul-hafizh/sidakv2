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
      if ($perPage != 'all') {
         $numberNext = (($page * $perPage) - ($perPage - 1));
      } else {
         $numberNext = (($page * $data->count()) - ($data->count() - 1));
      }
      foreach ($data as $key => $val) {
         if ($val->status == 'Y') {
            $status = 'Aktif';
         } else {
            $status = 'Non Aktif';
         };

         $temp[$key]['number'] = $numberNext++;
         $temp[$key]['id'] = $val->id;
         $temp[$key]['name'] = $val->name;
         $temp[$key]['semester'] = $val->semester;
         $temp[$key]['year'] = $val->year;
         $temp[$key]['startdate'] = $val->startdate;
         $temp[$key]['enddate'] = $val->enddate;

         $temp[$key]['startdate_convert'] = GeneralHelpers::formatDate($val->startdate);
         $temp[$key]['enddate_convert'] = GeneralHelpers::formatDate($val->enddate);
         $temp[$key]['slug'] = $val->slug;
         $temp[$key]['deleted'] = RequestPeriode::checkValidate($val->year);
         $temp[$key]['status'] = array('status_db' => $val->status, 'status_convert' => $status);
      }
      $result['data'] = $temp;
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

   public static function GetDataPrint($data)
   {



      $i = 1;
      foreach ($data as $key => $val) {
         if ($val->status == "Y") {
            $status = "Aktif";
         } else {
            $status = "NonAktif";
         }
         $temp[$key]['number'] = $i;

         $temp[$key]['id'] = $val->id;
         $temp[$key]['name'] = $val->name;
         $temp[$key]['slug'] = $val->slug;
         $temp[$key]['semester'] = $val->semester;
         $temp[$key]['year'] = $val->year;
         $temp[$key]['startdate'] = GeneralHelpers::formatExcel($val->startdate);
         $temp[$key]['enddate'] = GeneralHelpers::formatExcel($val->enddate);
         $temp[$key]['status'] = $status;
         $temp[$key]['created_at'] = GeneralHelpers::formatExcel($val->created_at);

         $i++;
      }

      return json_decode(json_encode($temp), FALSE);
   }

   public static function SelectAll($data, $type)
   {
      $temp = array();

      foreach ($data as $key => $val) {

         $temp[$key]['value'] = $val->slug;
         $temp[$key]['text'] = 'Periode ' . $val->year;
         if ($type == "POST") {
            $temp[$key]['pagu_apbn'] = GeneralHelpers::formatRupiah($val->pagu_apbn);
            $temp[$key]['pagu_promosi'] = GeneralHelpers::formatRupiah($val->pagu_promosi);
            $temp[$key]['target_pengawasan'] = $val->target_pengawasan;
            $temp[$key]['target_bimtek'] = $val->target_bimbingan_teknis;
            $temp[$key]['target_penyelesaian'] = $val->target_penyelesaian_permasalahan;
         }
      }



      return  $temp;
   }

   public static function getDetailPagu($slug, $type)
   {

      $pagu = RequestPeriode::Pagu($type, substr((string)$slug, 0, 4));
      return $pagu;
   }



   public static function checkValidate($slug)
   {

      $data = Perencanaan::where(DB::raw("LEFT(periode_id,4)"), $slug)->first();
      if ($data) {
         $result = false;
      } else {
         $result = true;
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
         } else if ($type == 'promosi') {
            if ($pagu->pagu_promosi != 0) {
               $result = GeneralHelpers::formatRupiah($pagu->pagu_promosi);
            } else {
               $result = 'Rp 0';
            }
         } else if ($type == 'pengawasan') {
            if ($pagu->target_pengawasan != 0) {
               $result = $pagu->target_pengawasan;
            } else {
               $result = '0';
            }
         } else if ($type == 'bimtek') {
            if ($pagu->target_bimbingan_teknis != 0) {
               $result = $pagu->target_bimbingan_teknis;
            } else {
               $result = '0';
            }
         } else if ($type == 'penyelesaian') {
            if ($pagu->target_penyelesaian_permasalahan != 0) {
               $result = $pagu->target_penyelesaian_permasalahan;
            } else {
               $result = '0';
            }
         }
      } else {
         $result = null;
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
         'slug' =>  $request->year . $request->semester,
         'semester' => $request->semester,
         'year' => $request->year,
         'startdate' => $request->startdate,
         'enddate' => $request->enddate,
         'status' => $request->status,
         'created_by' => Auth::User()->username,
         'created_at' => date('Y-m-d H:i:s'),
      ];

      return $fields;
   }

   public static function GetPeriodeName($slug)
   {

      $periode = Periode::where('slug', $slug)->first();
      if ($periode) {
         $result = 'Periode ' . $periode->year;
      } else {
         $result = Null;
      }
      return $result;
   }


   public static function GetPeriodeID()
   {

      $periode = Periode::select('id as value', 'name as text', 'slug')->orderBy('slug', 'ASC')->get();

      return $periode;
   }

   public static function SelectAll2($data)
   {
      $temp = array();

      foreach ($data as $key => $val) {

         $temp[$key]['value'] = $val->year;
         $temp[$key]['text'] = 'Periode ' . $val->year;
      }
      return  $temp;
   }
}

<?php

namespace App\Http\Request;

use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\PaguTarget;
use App\Models\Periode;
use DB;

class RequestPeriode
{

   public static function GetDataAll($data, $perPage, $request, $description)
   {
      $__temp_ = array();
      $getRequest = $request->all();
      $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
      $numberNext = (($page * $perPage) - ($perPage - 1));
      foreach ($data as $key => $val) {
         if ($val->status == 'A') {
            $status = 'Aktif';
         } else {
            $status = 'Non Aktif';
         };
         $__temp_[$key]['number'] = $numberNext++;
         $__temp_[$key]['id'] = $val->id;
         $__temp_[$key]['name'] = $val->name;
         $__temp_[$key]['semester'] = $val->semester;
         $__temp_[$key]['year'] = $val->year;
         $__temp_[$key]['slug'] = $val->slug;
         $__temp_[$key]['status'] = array('status_db' => $val->status, 'status_convert' => $status);

         $__temp_[$key]['created_at'] = GeneralHelpers::tanggal_indo($val['created_at']);
      }


      $results['result'] = $__temp_;
      if ($description != "") {
         if ($data->total() != 0) {
            $results['cari'] = 'Pencarian "' . $description . '" berhasil ditemukan';
         } else {
            $results['cari'] = 'Pencarian tidak ditemukan "' . $description . '" ';
         }
      } else {
         $results['cari'] = '';
      }
      $results['total'] = $data->total();
      $results['lastPage'] = $data->lastPage();
      $results['perPage'] = $data->perPage();
      $results['currentPage'] = $data->currentPage();
      $results['nextPageUrl'] = $data->nextPageUrl();
      return $results;
   }


   public static function SelectAll($data, $request)
   {
      $__temp_ = array();

      if ($request->type == 'perencanaan') {


         $periode =  DB::table('periode')->whereNotIn('slug', DB::table('perencanaan')->select('periode_id')->where('daerah_id', Auth::User()->daerah_id))->select('slug', 'name')->get();

         foreach ($periode as $key => $val) {

            $temp[$key]['value'] = (string)$val->slug;
            $temp[$key]['text'] = $val->name;
            $temp[$key]['pagu_apbn'] = RequestPeriode::Pagu('APBN', substr((string)$val->slug, 0, 4));
            $temp[$key]['pagu_promosi'] = RequestPeriode::Pagu('promosi', substr((string)$val->slug, 0, 4));
         }
      } else {
         foreach ($data as $key => $val) {
            $temp[$key]['value'] = (string)$val->slug;
            $temp[$key]['text'] = $val->name;
         }
      }


      return  $temp;
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
         'slug' =>  $request->slug,
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

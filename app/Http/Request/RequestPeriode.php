<?php

namespace App\Http\Request;

use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\PaguTarget;
use App\Models\Periode;
use DB;

class RequestPeriode
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
            if($val->status =="Y") { $status = "Aktif";  }else{ $status = "Non Aktif"; }

            if($val->semester =="01") { $semester = "Semester 01";  }else{ $semester = "Semester 02"; }
           
            $temp[$key]['number'] = $numberNext++;
            $temp[$key]['id'] = $val->id;
            $temp[$key]['name'] = $val->name;
            $temp[$key]['slug'] = $val->slug;
            $temp[$key]['semester_text'] = $semester;
            $temp[$key]['semester_value'] = $val->semester;
            $temp[$key]['year'] = $val->year;
            $temp[$key]['status'] = $status;
            $temp[$key]['status_ori'] = $val->status;
            $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val['created_at']);
        }

         $result['data'] = $temp;
         $result['current_page'] = $data->currentPage();
         $result['last_page'] = $data->lastPage(); 
        return $result;

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

   
  

   public static function fieldsData($request)
   {
        
        $fields = [  
                'name'  =>  $request->name,
                'slug' => $request->year.$request->semester,
                'semester' =>$request->semester,
                'year' =>$request->year,
                'status' =>$request->status,
                'created_by' =>Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
        ];
  
        return $fields;

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

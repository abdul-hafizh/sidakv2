<?php

namespace App\Http\Request;

use DB;
use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\PaguTarget;
use App\Models\Extension;
use App\Models\Perencanaan;
use App\Http\Request\RequestMenuRoles;

class RequestExtension
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
            $status = 'Terkirim';
         }else if ($val->status == 'A') {
           $status = 'Approved';
         }else{
           $status = 'Draft';
         
         };

         $temp[$key]['number'] = $numberNext++;
         $temp[$key]['id'] = $val->id;
         $temp[$key]['daerah_id'] = $val->name;
         $temp[$key]['semester'] = $val->semester;
         $temp[$key]['year'] = $val->year;
         $temp[$key]['expireddate'] = $val->expireddate;
         $temp[$key]['extensiondate'] = $val->extensiondate;
         $temp[$key]['description'] = $val->description;
         $temp[$key]['expireddate_convert'] = GeneralHelpers::formatDate($val->startdate);
         $temp[$key]['extensiondate_convert'] = GeneralHelpers::formatDate($val->enddate);
        
         $temp[$key]['deleted'] = RequestExtension::checkValidate($val->status);
         $temp[$key]['status'] = array('status_db' => $val->status, 'status_convert' => $status);
         $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val->created_at);

         $temp[$key]['startdate_format'] = GeneralHelpers::formatExcel($val->startdate);
         $temp[$key]['enddate_format'] = GeneralHelpers::formatExcel($val->enddate);
         $temp[$key]['created_at_format'] = GeneralHelpers::formatExcel($val->created_at);
      }

      $result['data'] = $temp;
      $result['options'] = RequestMenuRoles::ActionPage('extension');
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

  

   public static function fieldsData($request)
   {
      if ($request->semester == '01') {
         $name = 'Semester 1 Tahun ' . $request->year;
      } else {
         $name = 'Semester 2 Tahun ' . $request->year;
      }

      $fields = [
         'name'  =>  $name,
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

   
}

<?php

namespace App\Http\Request;

use DB;
use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\PaguTarget;
use App\Models\Extension;
use App\Http\Request\RequestDaerah;
use App\Http\Request\RequestAuth;
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
         }else{
           $status = 'Draft';
         
         };

         if($val->checklist =='not_approved')
         {
            $checklist = 'Proses';
         }else{
            $checklist = 'Approved';
         }   

         $description =  $val->description;
         if (strlen($description) > 30) {
             $description = substr($description, 0, 30) . "...";
         } 

         $temp[$key]['number'] = $numberNext++;
         $temp[$key]['id'] = $val->id;
         $temp[$key]['daerah_id'] = $val->daerah_id;
         $temp[$key]['daerah_name'] = RequestDaerah::GetDaerahWhereName($val->daerah_id);
         $temp[$key]['semester'] = $val->semester;
         $temp[$key]['year'] = $val->year;
         $temp[$key]['access'] = RequestAuth::Access();
         $temp[$key]['expireddate'] = array('expired_db' => $val->expireddate, 'expired_convert' => GeneralHelpers::formatDate($val->expireddate));
         $temp[$key]['extensiondate'] = array('extension_db' => $val->extensiondate, 'extension_convert' => GeneralHelpers::formatDate($val->extensiondate));
         $temp[$key]['description'] = array('desc_db' => $val->description, 'desc_convert' => $description);
      
         $temp[$key]['deleted'] = RequestExtension::checkValidate($val->status);
         $temp[$key]['checklist'] = $checklist;
         $temp[$key]['status'] = array('status_db' => $val->status, 'status_convert' => $status);
         $temp[$key]['created_at'] = GeneralHelpers::dates($val->created_at);

         // $temp[$key]['startdate_format'] = GeneralHelpers::formatExcel($val->startdate);
         // $temp[$key]['enddate_format'] = GeneralHelpers::formatExcel($val->enddate);
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
         'semester' => $request->semester,
         'year' => $request->year,
         'expireddate' => $request->expireddate,
         'extensiondate' => $request->extensiondate,
         'description' => $request->description,
         'status' => $request->status,
         'checklist'=>'not_approved',
         'created_by' => Auth::User()->username,
         'created_at' => date('Y-m-d H:i:s'),
      ];

      return $fields;
   }

   
}

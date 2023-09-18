<?php

namespace App\Http\Request;
use App\Helpers\GeneralHelpers;
use App\Models\AuditLog;
use Auth;
use Illuminate\Support\Str;
use App\Http\Request\RequestAuth;

class RequestAuditLog
{

    
     public static function GetDataAll($data,$perPage,$request)
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
            $description = $val->json_field;
            if (strlen($description) > 70) {
                $description = substr($description, 0, 70) . "...";
            } 

            $temp[$key]['number'] = $numberNext++;
            $temp[$key]['id'] = $val->id;
            $temp[$key]['name'] = RequestAuth::fullname($val->created_by);
            $temp[$key]['action'] = $val->action;
            $temp[$key]['json_data_convert'] = $description;
            $temp[$key]['json_data'] = $val->json_field;

            // $temp[$key]['last_update'] = RequestAuditLog::LastUpdate($val->created_by);
            $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val->created_at);
            $temp[$key]['created_at_format'] = GeneralHelpers::formatExcel($val->created_at);
        }

         $result['data'] = $temp;
         $result['options'] = RequestMenuRoles::ActionPage('audit-log');
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

   
  
   
    public static function fieldsData($request)
    {
       
        $uuid = Str::uuid()->toString(); 
        $username = array('id'=>$uuid,'created_by'=> Auth::User()->username);
        $input = array_merge($request,$username);
        $data = AuditLog::create($input);
        return $data;
    }

     

   

   


}
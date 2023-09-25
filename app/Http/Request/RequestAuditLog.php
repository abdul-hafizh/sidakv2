<?php

namespace App\Http\Request;
use App\Helpers\GeneralHelpers;
use App\Models\AuditLog;
use App\Models\User;
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
            $temp[$key]['created_by'] = RequestAuth::fullname($val->created_by);
            $temp[$key]['client_ip'] = $val->client_ip;
            $temp[$key]['category'] = $val->category;
            $temp[$key]['user_agent'] = $val->user_agent;
            $temp[$key]['description'] = $val->description;
            $temp[$key]['role_user'] = $val->role_user;
            $temp[$key]['group_menu'] = $val->group_menu;
            
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
        $clientIP = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $role_user =  RequestAuth::Access();
        $username = array('id'=>$uuid,'role_user'=>$role_user,'client_ip'=>$clientIP,'user_agent'=>$userAgent,'created_by'=> Auth::User()->username);
        $input = array_merge($request,$username);
        $data = AuditLog::create($input);
        return $data;
    }

     

   

   


}
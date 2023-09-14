<?php

namespace App\Http\Request;
use App\Helpers\GeneralHelpers;
use App\Models\AuditLog;
use Auth;
use Illuminate\Support\Str;

class RequestAuditLog
{

    
     public static function GetDataAll($data,$perPage,$request)
   {
        $temp = array();
         
        $getRequest = $request->all();
        $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
        $numberNext = (($page*$perPage) - ($perPage-1));
       
        foreach ($data as $key => $val)
        {
            $description = $val->json_field;
            if (strlen($description) > 70) {
                $description = substr($description, 0, 70) . "...";
            } 

            $temp[$key]['number'] = $numberNext++;
            $temp[$key]['id'] = $val->id;
            $temp[$key]['username'] = $val->created_by;
            $temp[$key]['action'] = $val->action;
            $temp[$key]['json_data'] = $description;
            $temp[$key]['last_update'] = RequestAuditLog::LastUpdate($val->created_by);
        }

         $result['data'] = $temp;
         $result['current_page'] = $data->currentPage();
         $result['last_page'] = $data->lastPage(); 
        return $result;

   }

    public static function LastUpdate($username)
   {
       $last = AuditLog::where('created_by',$username)->first()->updated_at;
       return GeneralHelpers::tanggal_indo($last);
   }

  
   
    public static function fieldsData($request)
    {
       
        $uuid = Str::uuid()->toString(); 
        $username = array(['id'=>$uuid,'created_by'=> Auth::User()->username]);
        $input = array_merge($request,$username);
        $data = AuditLog::create($input);
        return $data;
    }

     

   

   


}
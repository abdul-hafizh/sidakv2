<?php

namespace App\Http\Request;
use App\Helpers\GeneralHelpers;
use App\Models\SystemLog;
use Auth;

class RequestSystemLog
{

    
     public static function GetDataAll($data,$perPage,$request)
   {
        $temp = array();
         
        $getRequest = $request->all();
        $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
        $numberNext = (($page*$perPage) - ($perPage-1));
       
        foreach ($data as $key => $val)
        {
            
            $temp[$key]['number'] = $numberNext++;
            $temp[$key]['id'] = $val->id;
            $temp[$key]['username'] = $val->created_by;
            $temp[$key]['total_activity'] = RequestSystemLog::TotalActivity($val->created_by);
            $temp[$key]['last_update'] = RequestSystemLog::LastUpdate($val->created_by);
        }

         $result['data'] = $temp;
         $result['current_page'] = $data->currentPage();
         $result['last_page'] = $data->lastPage(); 
        return $result;

   }

   public static function TotalActivity($username)
   {
       $total = SystemLog::where('created_by',$username)->count();
       return $total;
   }

   public static function LastUpdate($username)
   {
       $last = SystemLog::where('created_by',$username)->first()->updated_at;
       return GeneralHelpers::tanggal_indo($last);
   }
   
    public static function CreateLog($request)
    {
        $username = array('created_by'=> Auth::User()->username);
        $input = array_merge($request,$username);
        $data = SystemLog::create($input);
        return $data;
    }

     

   

   


}
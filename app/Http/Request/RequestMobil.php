<?php

namespace App\Http\Request;
use App\Helpers\GeneralHelpers;
use Illuminate\Support\Str;

class RequestMobil
{
   
   public static function GetDataAll($data,$perPage,$request,$description)
   {
        $__temp_ = array();
        $getRequest = $request->all();
        $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
        $numberNext = (($page*$perPage) - ($perPage-1));
   	    foreach ($data as $key => $val)
        {
           

            $__temp_[$key]['number'] = $numberNext++;
            $__temp_[$key]['id'] = $val->id;
            $__temp_[$key]['name'] = $val->name;
         
            $__temp_[$key]['created_at'] = GeneralHelpers::tanggal_indo($val['created_at']);
        }
       
        
        $results['result'] = $__temp_;
        if($description !="")
        {  if($data->total() !=0)
           {
             $results['cari'] = 'Pencarian "'.$description.'" berhasil ditemukan'; 
           }else{
             $results['cari'] = 'Pencarian tidak ditemukan "'.$description.'" '; 
           } 
            
        }else{
            $results['cari'] = ''; 
        }   
        $results['total'] = $data->total();
        $results['lastPage'] = $data->lastPage();
        $results['perPage'] = $data->perPage();
        $results['currentPage'] = $data->currentPage();
        $results['nextPageUrl'] = $data->nextPageUrl();
        return $results;

   }

   
   public static function fieldsData($request)
   {
        $uuid = Str::uuid()->toString();
        $fields = [ 
                'id'=> $uuid,
                'name'  =>  $request->name,
                'created_at' => date('Y-m-d H:i:s'),
        ];
        return $fields;
   }
  

   

}
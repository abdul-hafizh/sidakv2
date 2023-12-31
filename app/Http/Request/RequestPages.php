<?php

namespace App\Http\Request;
use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\Roles;
use App\Models\RoleUser;
use Illuminate\Support\Str;

class RequestPages 
{
   
   public static function GetDataAll($data,$perPage,$request,$description)
   {
        $__temp_ = array();
        $getRequest = $request->all();
        $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
        $numberNext = (($page*$perPage) - ($perPage-1));
   	    foreach ($data as $key => $val)
        {
            if($val->status =='Y'){ $status = 'Aktif'; }else{ $status = 'Tidak Aktif';}

            $__temp_[$key]['number'] = $numberNext++;
            $__temp_[$key]['id'] = $val->id;
            $__temp_[$key]['name'] = $val->name;
            $__temp_[$key]['status'] = $status;
            $__temp_[$key]['slug'] = $val->slug;  
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

   public static function GetDataID($data)
   {         
           
            $__temp_['id'] = $data->id;
            $__temp_['name'] = $data->name;
            $__temp_['status'] = $data->status;
                
            return $__temp_;
   }

  

   public static function fieldsData($request)
   {
        $uuid = Str::uuid()->toString();
        $fields = [ 
                'id'=> $uuid,
                'name'  =>  $request->name,
                'status'  =>  $request->status,
                'slug' =>  strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name))),
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
        ];
        return $fields;
   }

   

  

   

}
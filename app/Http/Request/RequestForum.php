<?php

namespace App\Http\Request;
use Auth;
use App\Helpers\GeneralHelpers;
use Illuminate\Support\Str;


class RequestForum 
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
            if($val->status =="Y") { 
                $status = "Publish";
            }else{ 
                $status = "Draft";
            }

            
            $description =  $val->description;
            if (strlen($description) > 70) {
                $description = substr($description, 0, 70) . "...";
            } 

            $temp[$key]['number'] = $numberNext++;
            $temp[$key]['id'] = $val->id;
            $temp[$key]['category'] = $val->category;
            $temp[$key]['description'] = $description;
            $temp[$key]['status'] = array('status_db' => $val->status, 'status_convert' => $status);
            $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val['created_at']);
        }

       $result['data'] = $temp;
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
        

        $fields = [ 
                'id'=> $uuid,
                'category'  =>  $request->category,
                'description'  =>  $request->description,
                'status'  =>  $request->status,
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
        ];
        return $fields;
   }


   

   

  

   

}
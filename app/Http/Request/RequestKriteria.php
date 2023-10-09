<?php

namespace App\Http\Request;
use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\Kendala;
use Illuminate\Support\Str;
use App\Http\Request\RequestMenuRoles;

class RequestKriteria 
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
            if($val->status =="Y") { $status = "Publish";  }else{ $status = "Draft"; }

            $temp[$key]['number'] = $numberNext++;
            $temp[$key]['id'] = $val->id;
            $temp[$key]['category'] = $val->category;
            $temp[$key]['slug'] = $val->slug;
            $temp[$key]['description'] = $val->description;
            $temp[$key]['total'] = RequestKriteria::Total($val->id);
            // $temp[$key]['deleted'] = RequestKriteria::checkValidate($val->id);
            $temp[$key]['status'] = $status;
            $temp[$key]['status_ori'] = $val->status;
            $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val['created_at']);
            $temp[$key]['created_at_format'] = GeneralHelpers::formatExcel($val->created_at);
        }

       $result['data'] = $temp;
       $result['options'] = RequestMenuRoles::ActionPage('kriteria');
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

   public static function Total($id)
   {
       $data = Kendala::where('kriteria_id',$id)->count();
       return $data;
   }


   public static function checkValidate($id){

       $data = Kendala::where('kriteria_id',$id)->count();
       if($data > 0)
       {
          $result = false;
       }else{
          $result = true;
       } 

       return $result;
  }

  
  public static function GetKriteria($data){
        $temp = array();
        foreach ($data as $key => $val)
        {
            if($val->status =="Y") { $status = "Aktif";  }else{ $status = "Non Aktif"; }
            $temp[$key]['id'] = $val->id;
            $temp[$key]['text'] = $val->text;
            $temp[$key]['value'] = $val->value;
            $temp[$key]['status'] = $status;
            $temp[$key]['status_ori'] = $val->status;
        }
        return $temp; 
  }

  
  

   public static function fieldsData($request)
   {
        $uuid = Str::uuid()->toString();
        $fields = [ 
                'id'=> $uuid,
                'category'  =>  $request->category,
                'status'  =>  $request->status,
                'description'=> $request->description,
                'slug' =>  strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->category))),
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
        ];
        return $fields;
   }

   

  

   

}
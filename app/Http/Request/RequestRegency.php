<?php

namespace App\Http\Request;

use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\Regencies;
use App\Models\Provinces;
use Illuminate\Support\Str;
use App\Http\Request\RequestDaerah;
use App\Http\Request\RequestMenuRoles;

class RequestRegency
{

  public static function GetDataAll($data, $perPage, $request)
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

        $temp[$key]['number'] = $numberNext++;
        $temp[$key]['id'] = $val->id;
        $temp[$key]['name'] = $val->name;
        $temp[$key]['province_id'] = $val->province_id;
        $temp[$key]['province_name'] = RequestRegency::GetProvinsiName($val->province_id);
        $temp[$key]['deleted'] = RequestDaerah::checkValidate($val->id);
        $temp[$key]['created_by'] = $val->created_by;
        $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val->created_at);
        $temp[$key]['created_at_format'] = GeneralHelpers::formatExcel($val->created_at);
      }

       $result['data'] = $temp;
       $result['options'] = RequestMenuRoles::ActionPage('kabupaten');
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

 


 public static function GetProvinsiName($province_id)
 {
   
  
      $dataProv = Provinces::where('id',$province_id)->first();
      if($dataProv)
      { 
         return  $dataProv->name; 
      }
    
   
      

  
   
    
 } 



  public static function fieldsData($request)
  {
    // $uuid = Str::uuid()->toString();
    $fields = [
      'id' => $request->id,
      'name'  =>  $request->name,
      'province_id'  =>  $request->province_id,
      'created_by' => Auth::User()->username,
      'created_at' => date('Y-m-d H:i:s'),
    ];
    return $fields;
  }

  
}

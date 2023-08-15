<?php

namespace App\Http\Request;

use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\Provinces;
use Illuminate\Support\Str;
use App\Http\Request\RequestDaerah;


class RequestProvinces
{

  public static function GetDataAll($data, $perPage, $request)
  {
    $temp = array();
    $getRequest = $request->all();
    $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
    $numberNext = (($page * $perPage) - ($perPage - 1));
    foreach ($data as $key => $val) {

      $temp[$key]['number'] = $numberNext++;
      $temp[$key]['id'] = $val->id;
      $temp[$key]['name'] = $val->name;
      $temp[$key]['deleted'] = RequestDaerah::checkValidate($val->id);
      $temp[$key]['created_by'] = $val->created_by;
      $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val['created_at']);
    }

       $result['data'] = $temp;
       $result['current_page'] = $data->currentPage();
       $result['last_page'] = $data->lastPage(); 
   
    return $result;
  }

  




  public static function fieldsData($request)
  {
    $uuid = Str::uuid()->toString();
    $fields = [
      'id' => $uuid,
      'name'  =>  $request->name,
      'created_by' => Auth::User()->username,
      'created_at' => date('Y-m-d H:i:s'),
    ];
    return $fields;
  }

  
}

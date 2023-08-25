<?php

namespace App\Http\Request;
use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\Roles;
use App\Models\RoleUser;
use Illuminate\Support\Str;

class RequestRoles 
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
            if($val->status =="Y") { $status = "Aktif";  }else{ $status = "Non Aktif"; }

            $temp[$key]['number'] = $numberNext++;
            $temp[$key]['id'] = $val->id;
            $temp[$key]['name'] = $val->name;
            $temp[$key]['slug'] = $val->slug;
            $temp[$key]['deleted'] = RequestRoles::checkValidate($val->id);
            $temp[$key]['status'] = $status;
            $temp[$key]['status_ori'] = $val->status;
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

  
  public static function GetRoles(){

    $data = Roles::select('slug as value','name as text')->get();
    return $data; 
  }


  public static function GetRoleWhere($id,$type){

    $data = RoleUser::where('user_id',$id)->first();
    if($data)
    {
       if($type =='id')
       {
          $result = $data->role->id;
       }else{
          $result = $data->role->slug;
       }  
      
    }else{
       $result = null;
    }    
    return $result; 
  }

   public static function checkValidate($role_id){

       $data = RoleUser::where('role_id',$role_id)->count();
       if($data > 0)
       {
          $result = 'disabled';
       }else{
          $result = '';
       } 

       return $result;
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
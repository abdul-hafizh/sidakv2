<?php

namespace App\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Models\User;
use App\Models\Roles;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestRoles;
use App\Http\Request\RequestDaerah;
class RequestUser 
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
        $template = RequestSettingApps::AppsTemplate();
        foreach ($data as $key => $val)
        {
            if($val->status =="Y") { $status = "Aktif";  }else{ $status = "NonAktif"; }

            if($val->photo =="")
            {
                $photo = url('/template/'.$template.'/img/user.png');
            }else{
                $photo = url('/images/profile/'.$val->photo);
            }  

         

            $temp[$key]['number'] = $numberNext++;
          
            $temp[$key]['id'] = $val->id;
            $temp[$key]['name'] = $val->name;
            $temp[$key]['daerah_id'] = $val->daerah_id;
            $temp[$key]['daerah_name'] = RequestDaerah::GetDaerahWhereName($val->daerah_id);
            $temp[$key]['role_id'] = RequestRoles::GetRoleWhere($val->id,'name');
            
            $temp[$key]['username'] = $val->username;
            $temp[$key]['email'] = $val->email;
            $temp[$key]['phone'] = $val->phone;
            $temp[$key]['nip'] = $val->nip;
            $temp[$key]['leader_nip'] = $val->leader_nip;
            $temp[$key]['leader_name'] = $val->leader_name;
            $temp[$key]['status'] = $status;
            $temp[$key]['photo'] = $photo;
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

   
   

   public static function fieldsData($request,$type)
   {
       
       if($request->daerah_id)
       {
        $daerah_id = $request->daerah_id;
       }else{
        $daerah_id = 0;
       } 
    
        $fields = 
        [  
            
            'name'  => $request->name,
            'nip'  => $request->nip,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'leader_name'     => $request->leader_name,
            'leader_nip'     => $request->leader_nip,
            'daerah_id'     => $daerah_id,
            'status' =>'Y',
            'created_by' => $request->username,
            'created_at' => date('Y-m-d H:i:s'),
        ];

       if($type =="insert")
       {
            $fieldsPassword = ['username'  => $request->username,'password'  => bcrypt($request->password),];
            return array_merge($fields,$fieldsPassword);
       }else{
            return $fields;
       } 

   }

  

   
   

     
}
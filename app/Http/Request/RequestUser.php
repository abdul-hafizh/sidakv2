<?php

namespace App\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Models\User;
use App\Models\Roles;


class RequestUser 
{
   
   public static function GetDataAll($data,$perPage,$request,$description)
   {
        $__temp_ = array();
        $UploadFolder = GeneralPaginate::uploadPhotoFolder(); 
        $getRequest = $request->all();
        $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
        $numberNext = (($page*$perPage) - ($perPage-1));
        $template = env("TEMPLATE",TRUE);
   	    foreach ($data as $key => $val)
        {
            if($val->status =="A") { $status = "Aktif";  }else{ $status = "NonAktif"; }

            if($val->photo =="")
            {
                $photo = url('/template/'.$template.'/img/user.png');
            }else{
                $photo = url('/images/profile/'.$val->photo);
            }  

         

            $__temp_[$key]['number'] = $numberNext++;
          
            $__temp_[$key]['id'] = $val->id;
            $__temp_[$key]['name'] = $val->name;
            $__temp_[$key]['daerah_id'] = $val->daerah_id;
            $__temp_[$key]['username'] = $val->username;
            $__temp_[$key]['email'] = $val->email;
            $__temp_[$key]['phone'] = $val->phone;
            $__temp_[$key]['status'] = $status;
            $__temp_[$key]['photo'] = $photo;
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

   
   

   public static function fieldsData($type,$request)
   {
    
        $fields = 
        [  
            'username'  => $request->username,
            'name'  => $request->name,
            'nip'  => $request->nip,
            'password'  => bcrypt($request->password),
            'email'     => $request->email,
            'phone'     => $request->phone,
            'leader_name'     => $request->leader_name,
            'leader_nip'     => $request->leader_nip,
            'daerah_id'     => $request->daerah_id,
            'created_by' => '',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        return $fields;

   }

   public static function GetFilter($semester_id,$class_id,$academic_id){
     $Semester = Semester::where('id',$semester_id)->first()->name;
     $Class = ClassRoom::where('id',$class_id)->first()->name;
     $Academic = Academic::where('id',$academic_id)->first()->name;

     return 'Update '.$Class.', '.$Semester.', Tahun Akademik '.$Academic;

   }

   
   public static function GetHistoryLevel($data,$perPage,$request,$description){
         $__temp_ = array();
        $UploadFolder = GeneralPaginate::uploadPhotoFolder(); 
        $getRequest = $request->all();
        $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
        $numberNext = (($page*$perPage) - ($perPage-1));
        foreach ($data as $key => $val)
        {
            
            $__temp_[$key]['number'] = $numberNext++;
          
            $__temp_[$key]['id'] = $val->id;
            $__temp_[$key]['description'] = $val->description;
            $__temp_[$key]['created_by'] = $val->created_by;
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

     
}
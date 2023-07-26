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
    
     

    if($request->status =="A"){ $st_account ="A"; }else if($request->status =="C"){ $st_account ="A";  }else{ $st_account ="B"; } 

    if($type =="insert")
    {
        if($request->password ==""){ $password = bcrypt($request->username);}else{$password = bcrypt($request->password);}
        $username = $request->username;
        $photo = "";
    }else{
        $user = User::find($request->id);
        $username =  $user->username;
        $UploadFolder = GeneralPaginate::uploadPhotoFolder();
        $photo =  $user->photo;
        $password = $user->password;
    }  

    $fieldsAccess = [  
            'username'  => $username,
            'password'  => $password,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'status'  => $st_account,
            'created_by' => Auth::User()->username,
            'remember_token'=>'',
            'created_at' => date('Y-m-d H:i:s'),
    ];

     $fieldsUser = [
            'first_name' => $request->first_name,
            'last_name' =>  $request->last_name,
            'address'  => $request->address,
            'gender'  => $request->gender,
            'brithday' => $request->brithday,
            'class_id'  => (int)$request->class_id,
            'semester_id'  => (int)$request->semester_id,
            'academic_id'  => (int)$request->academic_id,
            'generation_id'  => (int)$request->generation_id,
            'prodi_id'  => (int)$request->prodi_id,
            'created_at' => date('Y-m-d H:i:s'),

     ];   
         
    $fieldsStatus = ['status'=>$request->status ];
    $fields = array_merge($fieldsUser,$fieldsStatus);
    $merge = array('account'=>$fieldsAccess,'attribut'=>$fields,'photo'=>$photo);    
    return $merge;

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
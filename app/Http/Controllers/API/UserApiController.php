<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Roles;
use App\Models\Provinces;
use App\Models\Regencies;
use App\Models\AuditLog;
use App\Http\Request\RequestUser;
use App\Http\Request\RequestAuditLog;
use App\Helpers\GeneralPaginate;
use App\Http\Request\Validation\ValidationUser;
// use Yajra\DataTables\DataTables;
use App\Http\Request\RequestAuth;
use File;
use Auth;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\forgotPassword;

class UserApiController extends Controller
{

   
    public function __construct()
    {   

        $this->UploadFolder = GeneralPaginate::uploadPhotoFolder();
       
    }

    public function index(Request $request)
    {
         // $_res = array();
         $query = User::orderBy('created_at', 'DESC');
         if($request->per_page !='all')
         {
           $data = $query->paginate($request->per_page);
         }else{   
           $data = $query->get(); 
         }   
        
         $result = RequestUser::GetDataAll($data,$request->per_page,$request);
         return response()->json($result);
    }

    


     public function register(Request $request)
    {
        $validation = ValidationUser::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{

            

           $insert = RequestUser::fieldsData($request);  
            //create menu
           $saveData = User::create($insert);
            //result
            return response()->json(['status'=>true,'id'=>$saveData,'message'=>'Insert data sucessfully']);  
             

            
             
            
        } 

    }

    public function GetUserID(){
        $user = User::select('id','username','daerah_id','name','email','phone','nip','leader_name','leader_nip','photo')->where('id',Auth::User()->id)->first();
        
        $data = RequestUser::getProfile($user);
        return response()->json(['status'=>true,'data'=>$data,'message'=>'Get data user ID sucessfully']);
    }

    public function sendMail(Request $request){
       
             $req = RequestAuth::CreateCode('encrypt',$request->email);
             $find = User::where(['email'=>$request->email])->first();
             $url = url("forgot?req=$req");
             Mail::to($find->email)->send(new forgotPassword($find->username,$url));
             return response()->json(['status'=>true,'messages'=>'Harap segera check email '.$find->email]);
         

        
    }

    public function updateProfile(Request $request)
    {
        $photo = '';
        $validation = ValidationUser::validationProfile($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{
              $update = RequestUser::fieldsProfile($request);
             if($request->photo)
             {   
                $slug = Auth::User()->username;
                $source = explode(";base64,", $request->photo);
                $extFile = explode("image/", $source[0]);
                $extentions = $extFile[1];
                $fileDir = '/images/profile/';
                $image = base64_decode($source[1]);
                $filePath = public_path() .$fileDir;
                $photo = time() . '-' . $slug.'.'.$extentions;
                $success = file_put_contents($filePath.$photo, $image);
                
                $check = User::where('username',Auth::User()->username)->first();
                if($check)
                { 
                   File::delete(public_path() .$fileDir.Auth::User()->photo);
                } 
                $user_photo = ['photo'=> $photo];
                $merge = array_merge($update,$user_photo);

               
            }else{
                $merge = $update;

            }

                $log = array(             
                    'category'=> 'LOG_DATA_USER',
                    'group_menu'=>'mengubah_data_profile',
                    'description'=>'Mengubah data profile <b>'.Auth::User()->username.'</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);
                //Audit Log
                
               if($request->password !='' && $request->password_confirmation !='')
               {
                  $validation = ValidationUser::validationPassword($request);
                  if($validation)
                  {
                    return response()->json($validation,400);
                  }else{
                      $password = ['password'=> $request->password];
                      $profile = array_merge($merge,$password);
                  } 

               }else{
                    $profile = $merge;
                
               } 
           
            $UpdateData = User::where('id',Auth::User()->id)->update($profile);

            $data = User::select('id','username','daerah_id','name','status','photo')->where('username',$request->username)->first();
            $userSidebar = RequestAuth::requestSidebar($data); 
           
            return response()->json(['status'=>true,'user_sidebar'=>$userSidebar,'message'=>'Update data sucessfully']);
       } 

        
        
         


    }    

    
    public function store(Request $request)
    {
        $validation = ValidationUser::validationInsert($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{
              $insert = RequestUser::fieldsData($request,'insert');  
            if($request->photo)
            {   
                $slug = $request->username;
                $source = explode(";base64,", $request->photo);
                $extFile = explode("image/", $source[0]);
                $extentions = $extFile[1];
                $fileDir = '/images/profile/';
                $image = base64_decode($source[1]);
                $filePath = public_path() .$fileDir;
                $photo = time() . '-' . $slug.'.'.$extentions;
                $success = file_put_contents($filePath.$photo, $image);
             
                $user_photo = ["photo"=>$photo];
                $merge = array_merge($insert,$user_photo);
            }else{
                $merge = $insert;
            }

            
            $log = array(             
            'category'=> 'LOG_DATA_USER',
            'group_menu'=>'upload_data_user',
            'description'=>'Menambahkan data user <b>'.$request->username.'</b>',
            );
            $datalog = RequestAuditLog::fieldsData($log);
         
            //create menu
           $saveData = User::create($merge);
           $role = Roles::where('slug',$request->role_id)->first();
           if(!$role)
           {
              return response()->json('Role tidak valid',400);  
           }else{
             $RoleUser = RoleUser::create(['user_id'=>$saveData->id,'role_id'=>$role->id,'status'=>'Y']);  
             //result
             return response()->json(['status'=>true,'id'=>$saveData,'message'=>'Insert data sucessfully']);     
           } 
           
            
        } 

    }

     public function update($id,Request $request){
     
        $validation = ValidationUser::validationUpdate($request,$id);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{
           
           
              
                $update = RequestUser::fieldsData($request,'update');  
                 if($request->photo)
                 {   
                    $slug = $request->username;
                    $source = explode(";base64,", $request->photo);
                    $extFile = explode("image/", $source[0]);
                    $extentions = $extFile[1];
                    $fileDir = '/images/profile/';
                    $image = base64_decode($source[1]);
                    $filePath = public_path() .$fileDir;
                    $photo = time() . '-' . $slug.'.'.$extentions;
                    $success = file_put_contents($filePath.$photo, $image);
                    
                    $check = User::where('username',$request->username)->first();
                    if($check)
                    { 
                       File::delete(public_path() .$fileDir.$check->photo);
                    } 

                    $user_photo = ["photo"=>$photo];
                    $merge = array_merge($update,$user_photo);
                    
                }else{
                    $merge = $update; 
                }
                
                $log = array(             
                'category'=> 'LOG_DATA_USER',
                'group_menu'=>'mengubah_data_user',
                'description'=>'Mengubah data user <b>'.$request->username.'</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);
                //Audit Log

                if($request->password !='' && $request->password_confirmation !='')
               {
                  $validation = ValidationUser::validationPassword($request);
                  if($validation)
                  {
                    return response()->json($validation,400);
                  }else{
                      $password = ['password'=> $request->password];
                      $profile = array_merge($merge,$password);
                  } 

               }else{
                    $profile = $merge;
                
               } 
               
                //update account
               $UpdateData = User::where('id',$id)->update($profile);
               $role = Roles::where('slug',$request->role_id)->first();
               if(!$role)
               {
                  return response()->json('Role tidak valid',400);  
               }else{

                   $RoleUser = RoleUser::where(['user_id'=>$id,'role_id'=>$role->role_id])->first();
                   if(!$RoleUser)
                   {
                    RoleUser::where(['user_id'=>$id])->update(['role_id'=>$role->id]);
                   } 

                    //result
                   return response()->json(['status'=>true,'message'=>'Update data sucessfully']);
               }

                
            
            
               
          
        }   

    }

     public function search(Request $request){
        $search = $request->search;
        $search_daerah = $request->daerah_id;
        $_res = array();
        $column_search  = array('username', 'name','email','phone');
        
        $province = Provinces::select('id')->where('id',$search_daerah);
        $daerah_id = Regencies::select('id')->union($province)->where('province_id',$search_daerah)->get();

        if($search == '')
        {
             $query  = User::whereIn('daerah_id',$daerah_id)->orderBy('id','DESC');
        }else{

            $i = 0;
            $query  = User::orderBy('id','DESC');
            foreach ($column_search as $item)
            {
                if ($search) 
                {    if($search_daerah)
                     {
                        if ($i === 0) {   
                           $query->where($item,'LIKE','%'.$search.'%')->whereIn('daerah_id',$daerah_id);
                        } else {
                           $query->orWhere($item,'LIKE','%'.$search.'%')->whereIn('daerah_id',$daerah_id);
                        } 
                    }else{

                        if ($i === 0) {   
                           $query->where($item,'LIKE','%'.$search.'%');
                        } else {
                           $query->orWhere($item,'LIKE','%'.$search.'%');
                        } 

                    }      
                }
                $i++;
            }   
             



        } 

        
       
        if($request->per_page !='all')
        {
           $data = $query->paginate($request->per_page);
        }else{   
           $data = $query->get(); 
        } 
        $description = $search;
        $result = RequestUser::GetDataAll($data,$request->per_page,$request);
        return response()->json($result);

    }

    public function deleteSelected(Request $request){
        $messages['messages'] = false;
        foreach($request->data as $key)
        {

            $find = User::where('id',$key)->first();
            $log = array(             
                'category'=> 'LOG_DATA_USER',
                'group_menu'=>'menghapus_data_user',
                'description'=> '<b>'.$find->username.'</b> telah dihapus',
                );
            $datalog = RequestAuditLog::fieldsData($log);
            $roleuser = RoleUser::where('user_id',(int)$key)->delete(); 
            $results = User::where('id',(int)$key)->delete();
        }

        if($results){
            $messages['messages'] = true;
        }

        return response()->json($messages);
    
    }

     public function StatusConfirm(Request $request){

       $messages['messages'] = false;
       $data = User::find($request->id);

       if(empty($data)){
            return response()->json(['messages' => false]);
       }else{

        if($request->status =='true')
        {

                $log = array(             
                'category'=> 'LOG_DATA_USER',
                'group_menu'=>'mengaktifkan_data_user',
                'description'=>'Mengubah status menjadi aktif untuk user <b>'.$data->username.'</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);

            User::where('id',$request->id)->update(['status'=>'Y']);

        }else{

                $log = array(             
                'category'=> 'LOG_DATA_USER',
                'group_menu'=>'menonaktifkan_data_user',
                'description'=>'Mengubah status menjadi nonaktif untuk user <b>'.$data->username.'</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);
            User::where('id',$request->id)->update(['status'=>'N']);



        }    
        
           
           
            $messages['messages'] = true;

        }

        return response()->json($messages);
    }
    
    
     public function delete($id){

       $messages['messages'] = false;
        $_res = User::find($id);
        
        $log = array(             
            'category'=> 'LOG_DATA_USER',
            'group_menu'=>'menghapus_data_user',
            'description'=> '<b>'.$_res->username.'</b> telah dihapus',
            );
        $datalog = RequestAuditLog::fieldsData($log);

       

        if(empty($_res)){
            return response()->json(['messages' => false]);
        }else{

            $fileDir = '/images/profile/';
            if(file_exists(public_path() .$fileDir.$_res->photo)) {
                File::delete(public_path() .$fileDir.$_res->photo);
            } 
        }
        $roleuser = RoleUser::where('user_id',$id)->delete();
        $results = $_res->delete();
        if($results){
            $messages['messages'] = true;
        }
        return response()->json($messages);
    }

    
    

    


}    
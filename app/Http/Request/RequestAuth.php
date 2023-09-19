<?php

namespace App\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Request\RequestSettingApps;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuthEmailVerified;
use App\Models\User;
use App\Models\RoleUser;
use JWTAuth;
use Auth;
use DB;
class RequestAuth
{

    public static function requestHash($username,$password)
    {   

    	$user = User::where('username',$username)->first(); 
    	if ($user !=null)
        {
           if (!Hash::check($password, $user->password)) {
             if($password == $user->password)
             {
                  User::where('username',$username)->update(['password'=> Hash::make($password)]);
             } 
            
           }
        }

    } 

     public static function CreateAuthToken($request)
   {
         $fourRandomDigit = rand(1000,9999);
         $find = User::where(['email'=>$request->email])->first();
         if($find)
         {

           $update = User::where(['username'=>$find->username])->update(['token'=>$fourRandomDigit]);
           Mail::to($find->email)->send(new AuthEmailVerified($find->username,$fourRandomDigit)); 
         }   
         

         return $find;
           
   }

    public static function CheckToken($request)
   {
        
         $data = User::where(['token'=>$request->token,'email'=>$request->email])->first();
         if($data)
         {
            $result = true;
            
         }else{
            $result = false;
         }

         return $result;   
           
   }

    public static function Access()
    {
      
        $RoleUser = RoleUser::where('user_id',Auth::User()->id)->first();
        $access =  $RoleUser->role->slug;
        return $access;
    }

     public static function AccessID()
    {

        $RoleUser = RoleUser::where('user_id',Auth::User()->id)->first();
        $access =  $RoleUser->role_id;
        return $access;
    }

    public static function requestUserSidebar()
    {
       

        $template = RequestSettingApps::AppsTemplate();
        if(Auth::User()->photo =="")
        {
            $photo = url('/template/'.$template.'/img/user.png');
        }else{
            $photo = url('/images/profile/'.Auth::User()->photo);
        }

        if(Auth::User()->status =="Y")
        {
            $status = 'Aktif';
        }else{
            $status = 'Non Aktif';
        }

        if(Auth::User()->name !="")
        {
           $name = Auth::User()->name;
        }else{
           $name = 'Default'; 
        }    

        $province = DB::table('provinces')->select('id as daerah_id','name as daerah_name')->where('id',Auth::User()->daerah_id);
        $regency = DB::table('regencies')->select('id as daerah_id','name as daerah_name')->union($province)->where('id',Auth::User()->daerah_id)->orderBy('daerah_id','ASC')->first();

        
        if(Auth::User()->daerah_id !=0)
        {
             $user = array('id'=>Auth::User()->id,'username'=>Auth::User()->username,'fullname'=>$name,'daerah_name'=>$regency->daerah_name,'status'=>$status,'photo'=>$photo);
        }else{
             $user = array('id'=>Auth::User()->id,'username'=>Auth::User()->username,'fullname'=>$name,'daerah_name'=>'Admin','status'=>$status,'photo'=>$photo);
        } 

        

        return  $user ;     

    }


    public static function requestSidebar($data)
    {
       

        $template = RequestSettingApps::AppsTemplate();
        if($data->photo =="")
        {
            $photo = url('/template/'.$template.'/img/user.png');
        }else{
            $photo = url('/images/profile/'.$data->photo);
        }

        if($data->status =="Y")
        {
            $status = 'Aktif';
        }

        if($data->name !="")
        {
           $name = $data->name;
        }else{
           $name = 'Default'; 
        }    

        $province = DB::table('provinces')->select('id as daerah_id','name as daerah_name')->where('id',$data->daerah_id);
        $regency = DB::table('regencies')->select('id as daerah_id','name as daerah_name')->union($province)->where('id',$data->daerah_id)->orderBy('daerah_id','ASC')->first();

        
        if($data->daerah_id !=0)
        {
             $user = array('id'=>$data->id,'username'=>$data->username,'fullname'=>$name,'daerah_name'=>$regency->daerah_name,'status'=>$status,'photo'=>$photo);
        }else{
             $user = array('id'=>$data->id,'username'=>$data->username,'fullname'=>$name,'daerah_name'=>'Admin','status'=>$status,'photo'=>$photo);
        } 

        

        return  $user ;     

    }

   

    public static function UpdateUserSidebar($file)
    {
       

        $template = RequestSettingApps::AppsTemplate();
        if(Auth::User()->photo =="")
        {
            $photo = url('/template/'.$template.'/img/user.png');
        }else{
            $photo = url('/images/profile/'.$file);
        }

        if(Auth::User()->status =="Y")
        {
            $status = 'Aktif';
        }

        if(Auth::User()->name !="")
        {
           $name = Auth::User()->name;
        }else{
           $name = 'Default'; 
        }    

        $province = DB::table('provinces')->select('id as daerah_id','name as daerah_name')->where('id',Auth::User()->daerah_id);
        $regency = DB::table('regencies')->select('id as daerah_id','name as daerah_name')->union($province)->where('id',Auth::User()->daerah_id)->orderBy('daerah_id','ASC')->first();

        
        if(Auth::User()->daerah_id !=0)
        {
             $user = array('id'=>Auth::User()->id,'username'=>Auth::User()->username,'fullname'=>$name,'daerah_name'=>$regency->daerah_name,'status'=>$status,'photo'=>$photo);
        }else{
             $user = array('id'=>Auth::User()->id,'username'=>Auth::User()->username,'fullname'=>$name,'daerah_name'=>'Admin','status'=>$status,'photo'=>$photo);
        } 

        

        return  $user ;     

    }

    public static function fullname($username)
    {
      
        $user = User::where('username',$username)->first();
        if($user)
        {
            $fullname = $user->name;
        }else{
            $fullname = $username;
        }

        return $fullname;

    }


    public static function photoUser($username)
    {
        $template = RequestSettingApps::AppsTemplate();
        $user = User::where('username',$username)->first();
        if($user)
        {
            $photo = url('/template/'.$template.'/img/user.png');
        }else{
            $photo = url('/images/profile/'.$user->photo);
        }

        return $photo;

    }



   

   


}
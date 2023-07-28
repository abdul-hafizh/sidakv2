<?php

namespace App\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Request\RequestSettingApps;
use App\Models\User;
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

        

        return $user;     

    }



   

   


}
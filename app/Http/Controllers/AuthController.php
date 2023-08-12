<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\Validation\ValidationAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Request\RequestAuth;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\SettingApps;


use JWTAuth;


class AuthController extends Controller
{


  public function __construct()
  {
    $this->title = 'Login';
    $this->template = RequestSettingApps::AppsTemplate();
  }

  public function index(Request $request)
  {

    // Auth::logout();
    // setcookie('token', '', -1, '/');
    // setcookie('access', '', -1, '/');

    return view('template/' . $this->template . '.auth.login')
      ->with(
        [
          'title' => $this->title,
          'template' => 'template/' . $this->template
        ]
      );
  }


    public function store(Request $request)
    {

        $credentials = $request->only('username', 'password');
        RequestAuth::requestHash($request->username,$request->password); 
        $validation = ValidationAuth::validation($request);
       
        if($validation)
        {

            return response()->json($validation,400); 

        }else{
         
            // Authentication successful
              
                try
                {
                    //access login api
                    if (! $token = JWTAuth::attempt($credentials)){
                        $messages1 = array('username'=>'Nama Pengguna tidak valid');
                        $messages2 = array('password'=>'Kata Sandi tidak valid');
                        $user = User::where('username',$credentials['username'])->first();
                        if ($user ==null)
                        {
                            return response()->json(['status'=>false,'messages' => $messages1],400);
                        }
                         
                        if (!Hash::check($credentials['password'], $user->password))
                        {
                            return response()->json(['status'=>false, 'messages' => $messages2],400); 
                        }
 
                    }
                    //access login web
                    if (Auth::attempt($credentials)) {}


                } catch (JWTException $e) {
                   return response()->json(['error' => 'validasi tidak valid'], 500);
                } 

               $auth = Auth::User();
               $RoleUser = RoleUser::where('user_id',$auth->id)->first();
               $access =  $RoleUser->role->slug; 
               $userSidebar = RequestAuth::requestUserSidebar();

               $token = compact('token');
               setcookie('access', $access, time() + (86400 * 30), "/"); // 86400 = 1 day
               setcookie('token', $token['token'], time() + (86400 * 30), "/"); // 86400 = 1 day
               $apps = SettingApps::first();
               $template = RequestSettingApps::GetDataApps($apps);

              return response()->json(['status'=>true,'template'=>$template,'user_sidebar'=>$userSidebar,'access'=>$access,'token'=>$token['token']],200);  
               
               

        
        
        }    

      
    }


       
  
  
}

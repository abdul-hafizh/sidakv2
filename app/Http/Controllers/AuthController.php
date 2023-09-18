<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\Validation\ValidationAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestSystemLog;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\SettingApps;
use App\Models\SystemLog;
use App\Http\Request\RequestMenuRoles;
use JWTAuth;


class AuthController extends Controller
{


  public function __construct()
  {
    $this->template = RequestSettingApps::AppsTemplate();
  }

  public function index(Request $request)
  {
       
 

    if (Auth::check()) {
        // User is authenticated
        $log = SystemLog::where('created_by',Auth::user()->username)->first();
        if($log)
        {
          return redirect($log->url);  
      }else{
          return redirect('dashboard');  
      }
        

    }else{
        
         return view('template/' . $this->template . '.auth.login')
          ->with(
            [
              'title' => 'Login',
              'template' => 'template/' . $this->template
            ]
          );

    } 

   
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

               $log = array(
                            'menu'=>'Login',
                            'slug'=>'login',
                            'url'=>'login'
                           );
               RequestSystemLog::CreateLog($log);

               if($access =='admin')
               {
                    $sidebar = RequestMenuRoles::MenuSidebarAdmin();
               }else if($access =='pusat'){
                   $sidebar = RequestMenuRoles::MenuSidebarPusat();
               }else if($access =='province'){
                    $sidebar = RequestMenuRoles::MenuSidebarProvinsi();
               }else if($access =='daerah'){
                   $sidebar = RequestMenuRoles::MenuSidebarKabupaten();
               } 

            

              return response()->json(['status'=>true,'menu_sidebar'=>$sidebar,'template'=>$template,'user_sidebar'=>$userSidebar,'access'=>$access,'token'=>$token['token']],200);  
               
               

        
        
        }    

      
    }


       
  
  
}

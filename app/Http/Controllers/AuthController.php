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
use App\Http\Request\RequestAuditLog;
use JWTAuth;
use App\Helpers\ConfigMenu;

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
           $user = User::where('username',$credentials['username'])->first();
           if($user)
           {

                if ($user->status == 'N')
                {  
                    $messages3 = array('status'=>'Akun anda ditangguhkan admin');
                    return response()->json(['status'=>false,'messages' => $messages3],400);
                }else{
            
                    // Authentication successful
                      
                        try
                        {
                            //access login api
                            if (! $token = JWTAuth::attempt($credentials)){
                                $messages1 = array('username'=>'Nama Pengguna tidak valid');
                                $messages2 = array('password'=>'Kata Sandi tidak valid');
                               
                               
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

                       $role = RequestMenuRoles::Roles($RoleUser->role->id);
                       $dataMenu = json_decode($role);
                       $sidebar = RequestMenuRoles::MenuSidebar($dataMenu);


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

                       // if($access =='admin')
                       // {
                       //      $sidebar = ConfigMenu::MenuSidebarAdmin();
                       // }else if($access =='pusat'){
                       //     $sidebar = ConfigMenu::MenuSidebarPusat();
                       // }else if($access =='province'){
                       //      $sidebar = ConfigMenu::MenuSidebarProvinsi();
                       // }else if($access =='daerah'){
                       //     $sidebar = ConfigMenu::MenuSidebarKabupaten();
                       // } 

                       

                       $log = array(             
                        'category'=> 'LOG_DATA_LOGIN',
                        'group_menu'=>'access_data_user',
                        'description'=> '<b class="text-capitalize"> '.$auth->username.' </b> berhasil melakukan login',
                        );
                        $datalog = RequestAuditLog::fieldsData($log);

                      return response()->json(['status'=>true,'menu_sidebar'=>$sidebar,'template'=>$template,'user_sidebar'=>$userSidebar,'access'=>$access,'token'=>$token['token']],200);  
                }
               
            }
        
        
        }    

      
    }

    public function GetFormForgot(Request $request){

         return view('template/' . $this->template . '.auth.forgot')
          ->with(
            [
              'title' => 'Lupa Password',
              'template' => 'template/' . $this->template
            ]
          );
          

    }

    public function ForgotPassword(Request $request){
      
       
        $validation = ValidationAuth::validationForgot($request);
        if($validation)
        {

            return response()->json($validation,400); 

        }else{

             $req = RequestAuth::CreateAuthToken($request);
             $data = array('forgot'=>true,'token'=>false,'email'=>$req->email);
             $email =  $req->email;
             if (strlen($email) > 8) {
                $email = substr($email, 0, 8) . "@xxx";
             } 

             return response()->json(['status'=>true,'data'=>$data,'messages'=>'Harap segera check email anda '.$email]);

        }    

    } 

    public function CheckToken(Request $request){
         
        $validation = ValidationAuth::validationToken($request);
        if($validation)
        {
            return response()->json($validation,400); 
        }else{

             $req = RequestAuth::CheckToken($request);
             if($req ==true)
             {
                $data = array('forgot'=>true,'token'=>true,'email'=>$request->email);
                return response()->json(['status'=>true,'data'=>$data,'messages'=>'Token berhasil divalidasi']);
             }else{
                $data = array('forgot'=>true,'token'=>false,'email'=>$request->email);
                return response()->json(['status'=>false,'data'=>$data,'messages'=>'Gagal token tidak valid']);
             }   
            

        }    

    } 

    public function CheckEncrypt(Request $request){

        $decrypt = RequestAuth::CreateCode('decrypt',$request->token);
        if($decrypt ==false)
        {
            return response()->json(['status'=>false,'messages'=>'Sesi ubah password telah berahir harap hubungi admin!'],400);  
        }else{
          return response()->json(['status'=>true,'data'=>$decrypt,'messages'=>'Token berhasil divalidasi']);  
        }    
       
        
    }

    public function UpdatePassword(Request $request){

        $validation = ValidationAuth::validationPassword($request);
        if($validation)
        {
            return response()->json($validation,400); 
        }else{

          $update = User::where(['email'=>$request->email])->update(['token'=>'','password'=> Hash::make($request->password)]);
          return response()->json(['status'=>true,'messages'=>'Password Berhasil diperbaharui']);
        }    

    }



       
  
  
}

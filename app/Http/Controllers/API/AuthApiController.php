<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Menus;
use App\Models\RoleMenu;
use App\Models\RoleUser;
use App\Models\User;


use App\Http\Request\RequestMenuRoles;
use App\Http\Request\RequestMenus;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\Validation\ValidationAuth;
use App\Helpers\GeneralPaginate;
use JWTAuth;
use Auth;
use DB;

class AuthApiController extends Controller
{

   
    public function __construct(){
       
   
    }

  

       
   

     public function Login(Request $request){

        $credentials = $request->only('username', 'password');
        $validation = ValidationAuth::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{
            RequestAuth::requestHash($credentials['username'],$credentials['password']);
          
         if (Auth::attempt($credentials)) 
         {
            try
            {
                if (! $token = JWTAuth::attempt($credentials))
                { 
                   
                    $messages1 = array('username'=>'Nama pengguna tidak valid');
                    $messages2 = array('password'=>'Kata sandi tidak valid');
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

            } catch (JWTException $e) {
               return response()->json(['error' => 'validasi tidak valid'], 500);
            }   

           
            $auth = Auth::User();
            $RoleUser = RoleUser::where('user_id',$auth->id)->first();
          
           
            if($RoleUser)
            {    
                 $access =  $RoleUser->role->slug;
                 $token = compact('token');
                 setcookie('access', $access, time() + (86400 * 30), "/"); // 86400 = 1 day
                 setcookie('token', $token['token'], time() + (86400 * 30), "/"); // 86400 = 1 day
                 $userSidebar = RequestAuth::requestUserSidebar();
              
            } 
            

            return response()->json(['status'=>true,'user_sidebar'=>$userSidebar,'access'=>$access,'token'=>$token['token']],200);  

         } else {
            // Authentication failed
              return response()->json(['status'=>false,'user_sidebar'=>[],'access'=>'','token'=>''],404);  
        }    

        }    




     
     }

     public function getAuthUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }
        
        $data = compact('user');

        return $data['user']->id;
    }

    public function sidebar()
    {

        $RoleUser = RoleUser::where('user_id',Auth::User()->id)->first()->role_id;
        // $role = RequestMenuRoles::Roles($RoleUser);
        // $res = array();
        if($RoleUser)
        {
            //$dataMenu = json_decode($role);
            $userSidebar = RequestAuth::requestUserSidebar();
           // $sidebar = RequestMenuRoles::MenuSidebar($dataMenu);
        } 
        return response()->json(['status'=>true,'user_sidebar'=>$userSidebar],200);

    }



     public function updateSingle($id,Request $request)
    {
        
        $check = ValidationGlobalUser::validationCheck($request);
        if(count($check) !=null || count($check) !=0 )
        {
            return response()->json($check,400);  
        }else{
            $update = RequestGlobalUser::fieldsSingle($request);
            $UpdateAccount = User::where('id',$id)->update($update);
            return response()->json(['status'=>true,'id'=>$UpdateAccount,'message'=>'Update data sucessfully']);
        }
    }

    
   
    


}    
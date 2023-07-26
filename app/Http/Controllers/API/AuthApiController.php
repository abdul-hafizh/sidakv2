<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Auth;
use App\Models\Menus;
use App\Models\RoleMenu;
use App\Models\RoleUser;

use App\Http\Request\RequestGlobalUser;
use App\Http\Request\RequestMenuRoles;
use App\Http\Request\RequestMenus;
use App\Http\Request\RequestAuth;
use App\Http\Request\Validation\ValidationGlobalUser;
use DB;
use App\Helpers\GeneralPaginate;
class AuthApiController extends Controller
{

   
    public function __construct(){
       
   
    }

  

       
   

     public function Login(Request $request){

        $credentials = $request->only('username', 'password');
            
        try {
            if (! $token = JWTAuth::attempt($credentials))
            {   
                $messages1 = array('identity'=>'Kode identitas tidak valid');
                $messages2 = array('password'=>'Password tidak valid');
                $messages3 = array('identity'=>'Kode identitas masih kosong');
                $messages4 = array('password'=>'Password masih kosong');

                if($credentials['username'] !="" && $credentials['password'] !="")
                {
                    $user = User::where('username',$credentials['username'])->first();
                    if ($user ==null) {
                        
                        return response()->json(['status'=>false,'messages' => $messages1],400);
                    }


                    if (!Hash::check($credentials['password'], $user->password)) {
                         if($credentials['password'] == $user->password)
                         {
                              User::where('username',$credentials['username'])->update(['password'=> Hash::make($credentials['password'])]);
                         }else{
                            return response()->json(['status'=>false, 'messages' => $messages2],400); 
                         }   
                        
                    }


                }else{
                    
                    if($credentials['username'] =="" && $credentials['password'] =="")
                    {
                        $merge = array_merge($messages3,$messages4);
                        return response()->json(['status'=>false, 'messages' => $merge],400);
                    }  

                    if($credentials['username'] =="")
                    {
                        return response()->json(['status'=>false,'messages' => $messages3],400);
                    }  

                    if($credentials['password'] =="")
                    {
                        return response()->json(['status'=>false,'messages' => $messages4],400);
                    } 


                }    
                
              
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
         
        $token = compact('token');
        $auth = Auth::User();
        $RoleUser = RoleUser::where('user_id',$auth->id)->first();
        $access =  $RoleUser->role->slug;

        return response()->json(['status'=>true,'access'=>$access,'token'=>$token['token']],200);

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

    public function sidebar(){
        $res = array();
        $auth = Auth::User();
        $id = $auth->id;
        $template = GeneralPaginate::Template();
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
         
     

        $RoleUser = RoleUser::where('user_id',$id)->first()->role_id;
        $role = RequestMenuRoles::Roles($RoleUser);
        $res = array();
        if($role)
        {
            $data = json_decode($role);
            $result = RequestMenuRoles::MenuSidebar($data);

        
        } 
        return response()->json(['status'=>true,'user'=>$user,'menu'=>$result],200);
       

      

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

    
    public function GetDaerahID(Request $request)
    {
       
        $province = DB::table('provinces')->select('id as daerah_id','name as daerah_name');
        $regency = DB::table('regencies')->select('id as daerah_id','name as daerah_name')->union($province)->orderBy('daerah_id','ASC')->get();

        return response()->json(['status'=>true,'result'=>$regency,'message'=>'Daerah ID sucessfully']);
    }
    


}    
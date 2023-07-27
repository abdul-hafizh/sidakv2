<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestMenuRoles;
use App\Models\Roles;
use App\Models\MenusRole;
use App\Models\RoleUser;
use App\Models\Pages;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Request\Validation\ValidationKeys;
class MenusRoleApiController extends Controller
{

   
    public function __construct()
    {   
        
       
    }

     public function keys(Request $request)
    {
        $validation = ValidationKeys::validation($request);
        if($validation !=null || $validation !="")
        {
          return response()->json($validation,400);  
        }else{

            if (!Hash::check($request->password,Auth::User()->password)) {
                 $messages = array('password'=>'Password tidak cocok'); 
                return response()->json(['status'=>false,'messages'=>$messages],400); 

            }else{
                 return response()->json(['status'=>true],200);
            }
        }    

    }


    public function store(Request $request)
    {
        $objectMenu = json_decode(json_encode($request->menu), FALSE);
         RequestMenuRoles::getMenuAllSave($objectMenu);
        $check = MenusRole::where('role_id',$request->role_id)->first();
        
        if($check)
        {
           $data = MenusRole::where('role_id',$request->role_id)->update(['menu_json'=>$objectMenu]);

        }else{
            
           $fields = RequestMenuRoles::fieldsData($request);
           $data = MenusRole::create($fields);
        }    
        
         $role = RequestMenuRoles::Roles($request->role_id);
         $path = RequestMenuRoles::PathVue($role);

       return response()->json(['status'=>true,'result'=> $path,'message'=>'Success update menu']);
        
    }

     public function pages(Request $request)
    {
         $objectMenu = json_decode(json_encode($request->menu), FALSE);
         $fields = RequestMenuRoles::fieldsPages($objectMenu);
         $err = array();
         // if($fields->type == 'table')
         // {
         //     if(empty($fields->label_list) )
         //     {
         //        $err['messages']['label_list'] = 'Label & Column harus di isi';
              
         //     }

         //    if(empty($fields->action_list))
         //    {
         //           $err['messages']['action_list'] = 'Action Table harus di isi';  
         //    } 
         //     return response()->json($err,400);  
         // } 

         //$data = Pages::create($fields); 

        
         //$data = RequestMenuRoles::createDirectorySingle($objectMenu);
        
          return response()->json(['status'=>true,'result'=> $fields,'message'=>'Success update menu']);
    }

    

    public function delete($id)
    {
       
       $messages['messages'] = false;
        $_res = MenusRole::where('role_id',$id)->first();
          
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }

        $results = $_res->delete();
        if($results){
            $messages['messages'] = true;
        }
        return response()->json($messages);
    }

     


}    
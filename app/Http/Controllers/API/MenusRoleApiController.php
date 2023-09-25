<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestMenuRoles;
use App\Http\Request\Validation\ValidationPages;

use App\Models\Roles;
use App\Models\MenusRole;
use App\Models\RoleUser;
use App\Models\Pages;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Request\Validation\ValidationKeys;
use App\Http\Request\RequestAuditLog;
use App\Http\Request\RequestRoles;
class MenusRoleApiController extends Controller
{

   
    public function __construct()
    {   
        
       
    }

     public function keys(Request $request)
    {
        $validation = ValidationKeys::validation($request);
        if($validation)
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
        $check = MenusRole::where('role_id',$request->role_id)->first();
        if($check)
        {


            $log = array(             
            'category'=> 'LOG_DATA_ROLE',
            'group_menu'=>'mengubah_menu_role',
            'description'=>'Mengubah menu role <b>'.$check->role->slug.'</b>',
            );
            $datalog = RequestAuditLog::fieldsData($log);
            //Audit Log
                  
           MenusRole::where('role_id',$request->role_id)->update(['menu_json'=>$objectMenu]);

        }else{
            $role = RequestRoles::GetRoleWhere($request->role_id,'name');
            $log = array(             
            'category'=> 'LOG_DATA_ROLE',
            'group_menu'=>'upload_menu_role',
            'description'=>'Menambahkan menu role <b>'.$role.'</b>',
            );
            $datalog = RequestAuditLog::fieldsData($log);
            
           $fields = RequestMenuRoles::fieldsData($request);
           MenusRole::create($fields);
        }    
        
        // $role = RequestMenuRoles::Roles($request->role_id);
        // if($role)
        // {
        //         $dataMenu = json_decode($role);
        //         $path = RequestMenuRoles::PathVue($role);
        //         $sidebar = RequestMenuRoles::MenuSidebar($dataMenu);
        //         $condition =  RequestMenuRoles::Condition($path); 
               
        // } 

       return response()->json(['status'=>true,'message'=>'Success menu']);
        
    }

     public function pages(Request $request)
    {
        
         $validation = ValidationPages::validation($request);
         if($validation)
         {
          return response()->json($validation,400);  
         }else{

         }


         //$fields = RequestMenuRoles::fieldsPages($objectMenu);
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
        
         // return response()->json(['status'=>true,'result'=> $fields,'message'=>'Success update menu']);
    }

    

    public function delete($id)
    {
       
       $messages['messages'] = false;
        $_res = MenusRole::where('role_id',$id)->first();
        $role = RequestRoles::GetRoleWhere($id,'name');
        $log = array(             
            'category'=> 'LOG_DATA_ROLE',
            'group_menu'=>'menghapus_data_role',
            'description'=> '<b>'.$role.'</b> telah dihapus',
            );
        $datalog = RequestAuditLog::fieldsData($log);
          
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
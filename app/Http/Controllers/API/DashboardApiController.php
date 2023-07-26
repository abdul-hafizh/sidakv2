<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\Validation\ValidationAdminAuth;
use App\Http\Request\RequestAdminAuth;
use App\Helpers\GeneralPaginate;
use App\Models\Admin;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Payment;
use App\Models\ProgramStudy;
use App\Models\Subject;

use File;
use Auth;

class DashboardApiController extends Controller
{

   
    public function __construct()
    {   
        $this->perPage = GeneralPaginate::limit();
        $this->UploadFolder = GeneralPaginate::uploadPhotoFolder();
    }


    public function dashboard()
    {
      $res['total_teacher'] = Teacher::count();
      $res['total_student'] = Student::count();
      $res['total_payment_paid'] = Payment::where('status','paid')->count(); 
      $res['total_payment_unpaid'] = Payment::where('status','unpaid')->count(); 
      $res['total_prody'] = ProgramStudy::count(); 
      $res['total_subject'] = Subject::count(); 
        return response()->json($res); 
    }

    public function index(Request $request)
    {
       
        $student = Auth::User();
        $_res = RequestAdminAuth::GetDataID($student);
        return response()->json($_res);

    }

    

    public function profile($id,Request $request){
       
        $validation = ValidationAdminAuth::validation($request);
        if($validation !=null || $validation !="")
        {
          return response()->json($validation,400);  
        }else{
           
                $update = RequestAdminAuth::fieldsData($request);
               
                if ($request->hasFile('photo'))
                {
                    if($update['photo'])
                    {
                      File::delete($this->UploadFolder.$update['photo']); 
                    }    
                   
                   $img = $request->file('photo');
                   $nameImg = $request->username.'-'.date('YmdHis').'.'.$img->getClientOriginalExtension();
                   $img->move($this->UploadFolder, $nameImg);
                   $arr['photo'] = $nameImg;
                }else{
                   $arr['photo'] = $update['photo'];
                }

            
                if ($request->hasFile('signature'))
                {
                    if($update['signature'])
                    {
                       File::delete($this->UploadFolder.$update['signature']);
                    }    
                  
                   $imgs = $request->file('signature');
                   $nameImgs = $request->username.'-'.date('YmdHis').'.'.$imgs->getClientOriginalExtension();
                   $imgs->move($this->UploadFolder, $nameImgs);
                   $arrs['signature'] = $nameImgs;
                }else{
                   $arrs['signature'] = $update['signature'];
                }
            

                $account = array_merge($update['account'],$arr);
                //update account
                $UpdateAccount = User::where('id',$id)->update($account);
                //update attribut
                $attr = array_merge($update['attribut'],$arrs);
                $updateAttr = Admin::where('user_id',$id)->update($attr);
                //result
                return response()->json(['status'=>true,'id'=>$update['signature'],'message'=>'Update data sucessfully']);   
          
        }    

    }

    public function password($id,Request $request)
    {
         $validation = ValidationAdminAuth::validationPassword($request);
         if($validation !=null || $validation !="")
         {
           return response()->json($validation,400);  
         }else{

             $validationCheck = ValidationAdminAuth::validationCheck($request);
             if($validationCheck !=null || $validationCheck !="")
             {
               return response()->json($validationCheck,400);  
             }else{

             $account = array('password'=>bcrypt($request->password));
             $UpdateAccount = User::where('id',$id)->update($account);
             return response()->json(['status'=>true,'id'=>$UpdateAccount,'message'=>'Update data sucessfully']); 

            }
         }   

    }    


  
    
    


    


}    
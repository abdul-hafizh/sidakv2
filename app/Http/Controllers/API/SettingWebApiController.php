<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingApps;
use Auth;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\Validation\ValidationSettingApps;
use App\Helpers\GeneralPaginate;
use File;
class SettingWebApiController extends Controller
{

   
    public function __construct()
    {   
       $this->UploadFolder = GeneralPaginate::uploadApps();
    }

    public function index(Request $request)
    {
      
        $Data = SettingApps::first();
        $_res = RequestSettingApps::GetDataApps($Data);
        return response()->json($_res);

    }

    

    public function update($id,Request $request){
     
        $validation = ValidationSettingApps::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{
            
               $update = RequestSettingApps::fieldsData($request);

               if ($request->hasFile('logo_lg'))
                {
                    if($update['logo_lg'])
                    {
                        File::delete($this->UploadFolder.$update['logo_lg']);
                    }    
                    
                   $img = $request->file('logo_lg');
                   $nameImg = Auth::User()->username.'-'.date('YmdHis').'.'.$img->getClientOriginalExtension();
                   $img->move($this->UploadFolder, $nameImg);
                   $arr['logo_lg'] = $nameImg;
                }else{
                   $arr['logo_lg'] = $update['logo_lg'];
                }
                 $account = array_merge($update['account'],$arr);
                //update account
                $UpdateData = SettingApps::where('id',$id)->update($account);
                //result
               return response()->json(['status'=>true,'id'=>$UpdateData,'message'=>'Update data sucessfully']);
            
          
        }   

    }
  


    


}    
<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestRekapitulasi;
use App\Http\Request\RequestDashboard;
use App\Http\Request\RequestAuth;
use Auth;
use App\Models\User;

class RekapitulasiApiController extends Controller
{

   
    public function __construct()
    {   
       
    }


  

    public function index(Request $request)
    {
        $access = RequestAuth::Access();
        $periode_id = $request->periode_id;
        $semester_id = $request->semester_id;
        $daerah_id = $request->daerah_id;
      
        


        if($access =='admin' || $access =='pusat'){
            if($daerah_id =="")
            {
              $query = User::where('status','Y')->whereNotIn('username',['admin','pusat'])->orderBy('created_at', 'DESC');
            }else{
              $query = User::where(['daerah_id'=> $daerah_id,'status','Y'])->orderBy('created_at', 'DESC');  
            }  
        }else{
            $query = User::where(['daerah_id'=> Auth::User()->daerah_id,'status','Y'])->orderBy('created_at', 'DESC');  
            
        }

         
         if($request->per_page !='all')
         {
           $data = $query->paginate($request->per_page);
         }else{   
           $data = $query->get(); 
         }   

         $header = RequestRekapitulasi::Header($data,$request->per_page,$request);
         $result = RequestRekapitulasi::GetDataAll($data,$request->per_page,$request);
        
         return response()->json(['header'=>$header,'rekapitulasi'=>$result]);
 
        
    }

    

   


  
    
    


    


}    
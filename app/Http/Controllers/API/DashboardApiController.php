<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestDashboard;
use App\Http\Request\RequestAuth;
use Auth;

class DashboardApiController extends Controller
{

   
    public function __construct()
    {   
       
    }


  

    public function index(Request $request)
    {
       $access = RequestAuth::Access();
       $periode_id = $request->periode_id;
       $semester_id = $request->semester_id;
       if($access == 'province' || $access =='daerah')
       {
         $daerah_id = Auth::User()->daerah_id;
       }else{
         $daerah_id = $request->daerah_id;
       }
       $total_kegiatan = RequestDashboard::TotalKegiatan($periode_id,$semester_id,$daerah_id);
       $Pengawasan = RequestDashboard::Pengawasan($periode_id,$semester_id,$daerah_id);
       $Bimsos = RequestDashboard::Bimsos($periode_id,$semester_id,$daerah_id);
       $Penyelesaian = RequestDashboard::Penyelesaian($periode_id,$semester_id,$daerah_id);
      
       return response()->json(['total'=>$total_kegiatan,'access'=>$access,'pengawasan'=>$Pengawasan,'bimsos'=> $Bimsos,'penyelesaian'=>$Penyelesaian]);

    }

    

   


  
    
    


    


}    
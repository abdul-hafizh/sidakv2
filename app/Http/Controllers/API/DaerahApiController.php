<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestDaerah;
use App\Models\Provinces;
use App\Models\Regencies;
class DaerahApiController extends Controller
{

   
    public function __construct(){
       
   
    }

  
    // public  function listProvince()
    // {

    //     $data = RequestDaerah::GetProvinceID();
    //     return response()->json($data);
    // }
       
    public  function listAllDaerah(Request $request)
    {
        
        $province = Provinces::select('id as value','name as text');
        $regency = Regencies::select('id as value','name as text')->union($province)->orderBy('value','ASC')->get();
       
        return response()->json($regency);
    }

    public  function listAllKabupaten(Request $request)
    {
        if($request->term)
        {
          $data =  Regencies::select('id as value','name as text')->where('name','LIKE','%'.$request->term.'%')->orderBy('value','ASC')->get();   
        }else{
           $data =  Regencies::select('id as value','name as text')->orderBy('value','ASC')->get();   
        }    
       
        return response()->json($data);
    }

      public  function listAllProvince(Request $request)
    {
        if($request->term)
        {
           $data = Provinces::select('id as value','name as text')->where('name','LIKE','%'.$request->term.'%')->orderBy('value','ASC')->get();
        }else{
           $data = Provinces::select('id as value','name as text')->orderBy('value','ASC')->get();
            
        }
       return response()->json($data);
    }

    
    
   
    


}    
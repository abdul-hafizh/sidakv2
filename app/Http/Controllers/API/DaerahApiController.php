<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestDaerah;

class DaerahApiController extends Controller
{

   
    public function __construct(){
       
   
    }

  
    public  function listProvince()
    {

        $data = RequestDaerah::GetProvinceID();
        return response()->json($data);
    }
       
    public  function listAll()
    {

        $data = RequestDaerah::GetDaerahID();
        return response()->json($data);
    }

    
    
   
    


}    
<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestDaerah;

class DaerahApiController extends Controller
{

   
    public function __construct(){
       
   
    }

  
    public  function listAll()
    {

        $daerah = RequestDaerah::GetDaerahID();
        return response()->json($daerah);
    }
       
   

    
    
   
    


}    
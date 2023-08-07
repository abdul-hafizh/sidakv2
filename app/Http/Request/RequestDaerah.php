<?php

namespace App\Http\Request;

use App\Models\Provinces;
use App\Models\Regencies;


class RequestDaerah
{

     public function GetDaerahID()
    {
       
        $province = Provinces::select('id as value','name as text');
        $regency = Regencies::select('id as value','name as text')->union($province)->orderBy('value','ASC')->get();

        return $regency;
    }



   

   


}
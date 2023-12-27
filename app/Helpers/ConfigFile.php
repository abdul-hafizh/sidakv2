<?php

namespace App\Helpers;
use Request;
use App\Models\Roles;
use App\Http\Request\RequestMenuRoles;

class ConfigFile
{

    public static function CreateFilePeriode($periode,$daerah_id,$file_menu)
    {
         
         $path = public_path() . '/laporan/'.$file_menu.'/' . $periode;
            if (!file_exists($path)) 
            {
                mkdir($path, 0777, true);
                if(!file_exists($path.'/'.$daerah_id))
                {
                  mkdir($path.'/'.$daerah_id, 0777, true);
                }    
                
               
            }else{

                if(!file_exists($path.'/'.$daerah_id))
                {
                    mkdir($path.'/'.$daerah_id, 0777, true); 
                }  

            } 
       

    }  

}    
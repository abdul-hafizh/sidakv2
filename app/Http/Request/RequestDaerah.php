<?php

namespace App\Http\Request;

use App\Models\Provinces;
use App\Models\Regencies;
use App\Models\User;
use DB;

class RequestDaerah
{
    // public static function GetProvinceID()
    // {
       
    //     $province = Provinces::select('id as value','name as text')->orderBy('value','ASC')->get();

    //     return $province;
    // }

     public static function GetDaerahID()
    {
       
       // if($type =="Province")
       // {
       //   $data = Provinces::select('id as value','name as text')->orderBy('value','ASC')->get();
       // }else if($type =="Daerah"){
       //   $data = Regencies::select('id as value','name as text')->orderBy('value','ASC')->get()
       // }
        //$province = Provinces::select('id as value','name as text');
        // $regency = Regencies::select('id as value','name as text')->union($province)->orderBy('value','ASC')->get();

        //return $data;
    }

     public static function GetDaerahWhereName($id)
    {
        $result = '';
        $province = DB::table('provinces')->select('name')->where('id',$id)->first();
        if($province){
           $result = $province->name;

        }else{
             $regency = DB::table('regencies')->select('name')->where('id',$id)->first();
             if($regency)
             {
                $result = $regency->name;

             }
        }

   
        return $result;
    }

    public static function checkValidate($daerah_id){

       $data = User::where('daerah_id',$daerah_id)->first();
       if($data)
       {
          $result = false;
       }else{
          $result = true;
       } 

       return $result;
  }

   

   


}
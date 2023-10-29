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

     public static function GetDaerahWhereID($id)
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

     public static function GetDaerahWhereName($name)
    {
        $result = '';
        $province = DB::table('provinces')->select('name')->where('name',$name)->first();
        if($province){
           $result = $province->name;

        }else{
             $regency = DB::table('regencies')->select('name')->where('id',$name)->first();
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
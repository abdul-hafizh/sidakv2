<?php

namespace App\Http\Request;

use App\Models\Provinces;
use App\Models\Regencies;
use App\Models\User;
use DB;

class RequestDaerah
{
    public function GetProvinceID()
    {
       
        $province = Provinces::select('id as value','name as text')->orderBy('value','ASC')->get();

        return $province;
    }

     public function GetDaerahID()
    {
       
        $province = Provinces::select('id as value','name as text');
        $regency = Regencies::select('id as value','name as text')->union($province)->orderBy('value','ASC')->get();

        return $regency;
    }

     public function GetDaerahWhereName($id)
    {
       
        $province = DB::table('provinces as a')->select('a.name');
        $regency = DB::table('regencies as b')->select('b.name')->where('b.id',$id)->union($province)->first();
        if($id !=0)
        {
           $result = $regency->name;
        }else{
           $result =  '';   
        }    

        return $result;
    }

    public static function checkValidate($daerah_id){

       $data = User::where('daerah_id',$daerah_id)->first();
       if($data)
       {
          $result = 'disabled';
       }else{
          $result = '';
       } 

       return $result;
  }

   

   


}
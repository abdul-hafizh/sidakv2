<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;
use App\Http\Request\RequestProvinces;
use App\Models\Provinces;

class ProvinceController extends Controller
{

    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
        
    }

    public function index(Request $request)
    {
       $title = 'Data Provinsi';
       $log = array(             
            'menu'=>$title,
            'menu'=>$title,
            'slug'=>'provinsi',
            'url'=>'provinsi'
        );
        RequestSystemLog::CreateLog($log);

      
        return view('template/' . $this->template . '.province.index')
        ->with(
            [
              'title' => $title,
              'template'=>'template/'.$this->template
            ]);
    }

    
}

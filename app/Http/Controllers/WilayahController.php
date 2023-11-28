<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;

class WilayahController extends Controller
{
   
   
    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
        

    }

    public function index(Request $request)
    {
        $title = 'Data Wilayah';
        $log = array(             
            'menu'=> $title,
            'slug'=>'wilayah',
            'url'=>'wilayah'
        );
        RequestSystemLog::CreateLog($log);
        
        return view('template/' . $this->template . '.wilayah.index')
        ->with(
            [
              'title' => $title,
              'template'=>'template/'.$this->template
            ]);
    }

   
   
}

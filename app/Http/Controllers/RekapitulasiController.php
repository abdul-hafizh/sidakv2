<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;
use App\Http\Request\RequestAuth;

class RekapitulasiController extends Controller
{

    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
        
    }

    public function index(Request $request)
    {
        $title = 'Rekapitulasi';
        $log = array(             
            'menu'=>$title,
            'slug'=>'rekapitulasi',
            'url'=>'rekapitulasi'
        );
        RequestSystemLog::CreateLog($log);

         $access = RequestAuth::Access();
        if($access =='pusat' || $access =='admin')
        {
             $view = 'template/' . $this->template . '.rekapitulasi.pusat'; 
        }else{
             $view = 'template/' . $this->template . '.rekapitulasi.province';
        }    
      
      
        

        return view($view)
            ->with(
                [
                    'title' =>  $title,
                    'template' => 'template/' . $this->template
                ]
            );
      
        
    }

    
}

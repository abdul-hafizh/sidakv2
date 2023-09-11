<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;

class KriteriaController extends Controller
{
   
   
    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
        

    }

    public function index(Request $request)
    {
        $title = 'Data Kriteria Kendala';
        $log = array(             
            'menu'=> $title,
            'slug'=>'kriteria-kendala',
            'url'=>'kriteria-kendala'
        );
        RequestSystemLog::CreateLog($log);
        
        return view('template/' . $this->template . '.kriteria.index')
        ->with(
            [
              'title' => $title,
              'template'=>'template/'.$this->template
            ]);
    }

   
   
}

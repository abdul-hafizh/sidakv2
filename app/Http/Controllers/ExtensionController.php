<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;
use App\Http\Request\RequestPeriode;
use App\Models\Periode;

class ExtensionController extends Controller
{
   
   
    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
    }

    public function index(Request $request)
    {
        $title = 'Data Perpanjangan Periode';
        $log = array(             
            'menu'=>$title,
            'slug'=>'extension',
            'url'=>'extension'
        );
        RequestSystemLog::CreateLog($log);

       

        return view('template/' . $this->template . '.extension.index')
        ->with(
            [
              'title' => $title,
              'template'=>'template/'.$this->template
            ]);
    }

 
   
}

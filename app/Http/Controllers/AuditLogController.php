<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;


class AuditLogController extends Controller
{

    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
        
    }

    public function index(Request $request)
    {
        $title = 'Audit Log System';
        $log = array(             
            'menu'=> $title,
            'slug'=>'auditlog',
            'url'=>'auditlog'
        );
        RequestSystemLog::CreateLog($log);
      
        return view('template/' . $this->template . '.auditlog.index')
        ->with(
            [
              'title' =>  $title,
              'template'=>'template/'.$this->template
            ]);
    }

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;




class PaguTargetController extends Controller
{

    public function __construct()
    {
        $this->template = RequestSettingApps::AppsTemplate();
    }

    public function index(Request $request)
    {
        $title = 'Pagu APBN';
        $log = array(
            'menu' => $title,
            'slug' => 'paguapbn',
            'url' => 'paguapbn'
        );
        RequestSystemLog::CreateLog($log);

        return view('template/' . $this->template . '.paguTarget.index')
            ->with(
                [
                    'title' =>  $title,
                    'template' => 'template/' . $this->template
                ]
            );
    }
}

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
        $total_apbn = 1000000000;
        $total_promosi = 2000000000;
        $log = array(
            'menu' => $title,
            'slug' => 'pagutarget',
            'url' => 'pagutarget'
        );
        RequestSystemLog::CreateLog($log);

        return view('template/' . $this->template . '.paguTarget.dt_index')
            ->with(
                [
                    'title' =>  $title,
                    'total_apbn' =>  $total_apbn,
                    'total_promosi' =>  $total_promosi,
                    'template' => 'template/' . $this->template
                ]
            );
    }
}

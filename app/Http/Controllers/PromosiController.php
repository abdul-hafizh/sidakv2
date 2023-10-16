<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;

class PromosiController extends Controller
{
    public function __construct()
    {
        $this->template = RequestSettingApps::AppsTemplate();
    }

    public function index(Request $request)
    {
        $title = 'Promosi';
        $log = array(
            'menu' => $title,
            'slug' => 'promosi',
            'url' => 'promosi'
        );
        RequestSystemLog::CreateLog($log);

        return view('template/' . $this->template . '.promosi.index')
            ->with(
                [
                    'title' =>  $title,
                    'template' => 'template/' . $this->template
                ]
            );
    }
    //
}

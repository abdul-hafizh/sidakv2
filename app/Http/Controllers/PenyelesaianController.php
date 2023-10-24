<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;
use App\Http\Request\RequestAuth;

class PenyelesaianController extends Controller
{
    public function __construct()
    {
        $this->template = RequestSettingApps::AppsTemplate();
    }

    public function index(Request $request)
    {
        $title = 'Penyelesaian Masalah';
        $log = array(
            'menu' => $title,
            'slug' => 'penyelesaian',
            'url' => 'penyelesaian'
        );

        $access = RequestAuth::Access();
        RequestSystemLog::CreateLog($log);

        return view('template/' . $this->template . '.penyelesaian.index')
            ->with(
                [
                    'title' =>  $title,
                    'access' => $access,
                    'template' => 'template/' . $this->template,
                ]
            );
    }
}

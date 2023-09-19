<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;

class BimsosController extends Controller
{
    public function __construct()
    {
        $this->template = RequestSettingApps::AppsTemplate();
    }

    public function index(Request $request)
    {
        $title = 'Bimbingan Teknis/Sosialisasi Kemudahan Berusaha';
        $log = array(
            'menu' => $title,
            'slug' => 'bimsos',
            'url' => 'bimsos'
        );
        RequestSystemLog::CreateLog($log);

        return view('template/' . $this->template . '.bimsos.index')
            ->with(
                [
                    'title' =>  $title,
                    'template' => 'template/' . $this->template
                ]
            );
    }
    //
}

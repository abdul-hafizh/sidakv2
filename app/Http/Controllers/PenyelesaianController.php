<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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

        $ss_daerah_id = empty(Session::get('daerah_id')) ? '' : Session::get('daerah_id');
        $ss_periode_id = empty(Session::get('periode_id')) ? '' : Session::get('periode_id');
        $ss_sub_menu_slug = empty(Session::get('sub_menu_slug')) ? '' : Session::get('sub_menu_slug');
        $ss_status_laporan_id = empty(Session::get('status_laporan_id')) ? '' : Session::get('status_laporan_id');
        $ss_status_laporan_text = empty(Session::get('status_laporan_text')) ? '' : Session::get('status_laporan_text');

        return view('template/' . $this->template . '.penyelesaian.index')
            ->with(
                [
                    'title' =>  $title,
                    'access' => $access,
                    'template' => 'template/' . $this->template,                    
                    'ss_daerah_id' => $ss_daerah_id,
                    'ss_periode_id' => $ss_periode_id,
                    'ss_sub_menu_slug' => $ss_sub_menu_slug,
                    'ss_status_laporan_id' => $ss_status_laporan_id,
                    'ss_status_laporan_text' => $ss_status_laporan_text,
                ]
            );
    }
}

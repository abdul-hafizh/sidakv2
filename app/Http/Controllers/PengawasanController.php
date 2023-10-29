<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;
use App\Http\Request\RequestAuth;

class PengawasanController extends Controller
{

    public function __construct()
    {
        $this->title = 'Pengawasan Pelaksanaan Penanaman Modal';
        $this->template = RequestSettingApps::AppsTemplate();
    }

    public function index(Request $request)
    {
        $log = array(
            'menu' => $this->title,
            'slug' => 'pengawasan',
            'url' => 'pengawasan'
        );
        RequestSystemLog::CreateLog($log);
        $access = RequestAuth::Access();

        return view('template/' . $this->template . '.pengawasan.index')
            ->with(
                [
                    'title' => $this->title,
                    'access' => $access,
                    'template' => 'template/' . $this->template
                ]
            );
    }

    public function store(Request $request)
    {
    }

    public function add(Request $request)
    {
    }

    public function edit($id, Request $request)
    {
    }

    public function show($id, Request $request)
    {
    }

    public function update($id, Request $request)
    {
    }

    public function delete($id, Request $request)
    {
    }
}

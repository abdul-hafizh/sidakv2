<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestSystemLog;

class PerencanaanController extends Controller
{

    public function __construct()
    {
        $this->template = RequestSettingApps::AppsTemplate();
    }

    public function index(Request $request)
    {      
        $title = 'Perencanaan Tahun Anggaran';
        $log = array(             
            'menu' => $title,
            'slug' => 'perencanaan',
            'url' => 'perencanaan'
        );
        
        RequestSystemLog::CreateLog($log);  
        $with =  ['title' => $title,'template'=>'template/'.$this->template];

        return view('template/' . $this->template . '.perencanaan.index')->with($with);
        
    }

    public function add(Request $request)
    {
        $title = 'Tambah Perencanaan Anggaran';
        $log = array(             
            'menu' => $title,
            'slug' => 'perencanaan',
            'url' =>' perencanaan'
        );
        RequestSystemLog::CreateLog($log);  

        return view('template/' . $this->template . '.perencanaan.add')
        ->with([
            'title' => $title,
            'template' => 'template/'.$this->template ]);
    }

    public function edit(Request $request)
    {
        $title = 'Edit Perencanaan Anggaran';
        $log = array(             
            'menu' => $title,
            'slug' => 'perencanaan',
            'url' => 'perencanaan'
        );
        RequestSystemLog::CreateLog($log);  

        return view('template/' . $this->template . '.perencanaan.edit')
        ->with([
            'title' => $title,
            'template' => 'template/'.$this->template ]);
    }

     public function show(Request $request)
    {
        $title = 'Detail Perencanaan Anggaran';
        $log = array(             
            'menu' => $title,
            'slug' => 'perencanaan',
            'url' => 'perencanaan'
        );
        RequestSystemLog::CreateLog($log);  

        return view('template/' . $this->template . '.perencanaan.detail')
        ->with([
            'title' => $title,
            'template' => 'template/'.$this->template ]);
    }

}

<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestSystemLog;
use App\Models\Penyelesaian;

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
        
        RequestSystemLog::CreateLog($log);  
        $with =  ['title' => $title,'template'=>'template/'.$this->template];

        return view('template/' . $this->template . '.penyelesaian.index')->with($with);
        
    }

    public function add(Request $request)
    {
        $title = 'Tambah Penyelesaian Masalah';
        $log = array(             
            'menu' => $title,
            'slug' => 'penyelesaian',
            'url' =>' penyelesaian'
        );
        RequestSystemLog::CreateLog($log);  

        return view('template/' . $this->template . '.penyelesaian.add')
        ->with([
            'title' => $title,
            'template' => 'template/'.$this->template ]);
    }

    public function edit(Request $request)
    {
        $title = 'Edit Penyelesaian Masalah';
        $log = array(             
            'menu' => $title,
            'slug' => 'penyelesaian',
            'url' => 'penyelesaian'
        );
        RequestSystemLog::CreateLog($log);  

        return view('template/' . $this->template . '.penyelesaian.edit')
        ->with([
            'title' => $title,
            'template' => 'template/'.$this->template ]);
    }

     public function show(Request $request)
    {
        $title = 'Detail Penyelesaian Masalah';
        $log = array(             
            'menu' => $title,
            'slug' => 'penyelesaian',
            'url' => 'penyelesaian'
        );
        RequestSystemLog::CreateLog($log);  

        return view('template/' . $this->template . '.penyelesaian.detail')
        ->with([
            'title' => $title,
            'template' => 'template/'.$this->template ]);
    }

}

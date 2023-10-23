<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestSystemLog;
use App\Models\Perencanaan;

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
        
        $access = RequestAuth::Access();
        RequestSystemLog::CreateLog($log);  

        $with =  ['title' => $title,'access' => $access,'template' => 'template/'.$this->template];

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

    public function generate_pdf($id)
    {
        $get_data = Perencanaan::join('vw_wilayah_union', 'perencanaan.daerah_id', '=', 'vw_wilayah_union.id')
        ->join('pagu_target', function($join) {
            $join->on('perencanaan.periode_id', '=', 'pagu_target.periode_id')
                ->on('perencanaan.daerah_id', '=', 'pagu_target.daerah_id');
        })
        ->select('perencanaan.*', 'vw_wilayah_union.name AS nama_daerah', 'pagu_target.pagu_apbn')
        ->where('perencanaan.id', $id)
        ->first();

        $data = ['title' => 'Perencanaan', 'rows' => $get_data];
        $pdf = PDF::loadView('template/sidakv2/perencanaan/print', $data);
  
        return $pdf->download('Perencanaan ' . $get_data->nama_daerah . ' Tahun ' . $get_data->periode_id . '.pdf');
    }

}

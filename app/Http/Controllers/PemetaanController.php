<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;
use PDF;
use App\Models\Pemetaan;
use App\Http\Request\RequestPemetaan;
use App\Http\Request\RequestAuth;


class PemetaanController extends Controller
{
    public function __construct()
    {
        $this->template = RequestSettingApps::AppsTemplate();
    }

    public function index(Request $request)
    {
        $title = 'Pemetaan';
        $log = array(
            'menu' => $title,
            'slug' => 'pemetaan',
            'url' => 'pemetaan'
        );
        RequestSystemLog::CreateLog($log);
        $access = RequestAuth::Access();
        if($access =='pusat' || $access =='admin')
        {
             $view = 'template/' . $this->template . '.pemetaan.pusat'; 
        }else{
             $view = 'template/' . $this->template . '.pemetaan.province';
        }    

        return view($view)
            ->with(
                [
                    'title' =>  $title,
                    'template' => 'template/' . $this->template
                ]
            );
    }
    
    public function add(Request $request)
    {
        $title = 'Tambah Pemetaan';
        $log = array(
            'menu' => $title,
            'slug' => 'add-pemetaan',
            'url' => 'pemetaan/add'
        );
        RequestSystemLog::CreateLog($log);

        return view('template/' . $this->template . '.pemetaan.add')
            ->with(
                [
                    'title' =>  $title,
                    'template' => 'template/' . $this->template
                ]
            );
    }

    public function edit($id,Request $request)
    {
        $title = 'Edit Pemetaan';
        $log = array(
            'menu' => $title,
            'slug' => 'edit-pemetaan',
            'url' => 'pemetaan/edit/'.$id
        );
        RequestSystemLog::CreateLog($log);

        return view('template/' . $this->template . '.pemetaan.edit')
            ->with(
                [
                    'title' =>  $title,
                    'template' => 'template/' . $this->template
                ]
            );
    }


     public function show($id,Request $request)
    {
        $title = 'Detail Pemetaan';
        $log = array(
            'menu' => $title,
            'slug' => 'detail-pemetaan',
            'url' => 'pemetaan/detail/'.$id
        );
        RequestSystemLog::CreateLog($log);

        return view('template/' . $this->template . '.pemetaan.detail')
            ->with(
                [
                    'title' =>  $title,
                    'template' => 'template/' . $this->template
                ]
            );
    }

     public function generate($id)
    {
        $get_data = Pemetaan::where('id', $id)->first();
        $detail =   RequestPemetaan::GetDetail($get_data);
        $build = json_decode(json_encode($detail), FALSE);
        // dd($build);
        $data = ['title' => 'Pemetaan', 'rows' => $build ];
          
         // return view('template/' . $this->template . '.pemetaan.print')
         //    ->with(
         //        [
         //            'title' =>  'Pemetaan',
         //            'rows' => $build,
         //            'template' => 'template/' . $this->template
         //        ]
         //    );
       $pdf = PDF::loadView('template/sidakv2/pemetaan/print', $data);
       return $pdf->download('Pemetaan_' . $build->daerah_name . '_Tahun_' . $build->periode_id . '.pdf');
    }
}

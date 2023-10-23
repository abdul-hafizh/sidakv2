<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;
use PDF;
use App\Models\Promosi;
use App\Http\Request\RequestPromosi;
use App\Http\Request\RequestAuth;
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
        $access = RequestAuth::Access();
        if($access =='pusat' || $access =='admin')
        {
             $view = 'template/' . $this->template . '.promosi.pusat'; 
        }else{
             $view = 'template/' . $this->template . '.promosi.province';
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
        $title = 'Tambah Promosi';
        $log = array(
            'menu' => $title,
            'slug' => 'add-promosi',
            'url' => 'promosi/add'
        );
        RequestSystemLog::CreateLog($log);

        return view('template/' . $this->template . '.promosi.add')
            ->with(
                [
                    'title' =>  $title,
                    'template' => 'template/' . $this->template
                ]
            );
    }

    public function edit($id,Request $request)
    {
        $title = 'Edit Promosi';
        $log = array(
            'menu' => $title,
            'slug' => 'edit-promosi',
            'url' => 'promosi/edit/'.$id
        );
        RequestSystemLog::CreateLog($log);

        return view('template/' . $this->template . '.promosi.edit')
            ->with(
                [
                    'title' =>  $title,
                    'template' => 'template/' . $this->template
                ]
            );
    }

     public function generate($id)
    {
        $get_data = Promosi::where('id', $id)->first();
        $detail =   RequestPromosi::GetDetail($get_data);
        $build = json_decode(json_encode($detail), FALSE);
        $data = ['title' => 'Promosi', 'rows' => $build ];
          
         // return view('template/' . $this->template . '.promosi.print')
         //    ->with(
         //        [
         //            'title' =>  'Promosi',
         //            'rows' => $build,
         //            'template' => 'template/' . $this->template
         //        ]
         //    );
    $pdf = PDF::loadView('template/sidakv2/promosi/print', $data);
  
    return $pdf->download('Promosi ' . $build->daerah_name . ' Tahun ' . $build->periode_id . '.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestPerencanaan;
use App\Http\Request\Validation\ValidationPerencanaan;
use App\Helpers\GeneralPaginate;
use App\Models\Perencanaan;
use Auth;

class PerencanaanController extends Controller
{

    public function __construct()
    {
        $this->template = RequestSettingApps::AppsTemplate();
    }

    public function index(Request $request)
    {

        return view('template/' . $this->template . '.perencanaan.index')
        ->with([
            'title' => 'Data Perencanaan',
            'template'=>'template/'.$this->template ]);
    }

     public function add(Request $request)
    {

        return view('template/' . $this->template . '.perencanaan.add')
        ->with([
            'title' => 'Tambah Perencanaan',
            'template'=>'template/'.$this->template ]);
    }

      public function edit(Request $request)
    {

        return view('template/' . $this->template . '.perencanaan.edit')
        ->with([
            'title' => 'Edit Perencanaan',
            'template'=>'template/'.$this->template ]);
    }

}

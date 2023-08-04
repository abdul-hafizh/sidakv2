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
        $this->title = 'Perencanaan';
        $this->template = RequestSettingApps::AppsTemplate();
        $this->sidebar = RequestSettingApps::AppsSidebar();
        $this->perPage = GeneralPaginate::limit();
    }

    public function index(Request $request)
    {

        $data = Perencanaan::orderBy('id', 'DESC')->paginate($this->perPage);
        $result = RequestPerencanaan::GetDataAll($data,$this->perPage,$request);

        return view('template/' . $this->template . '.perencanaan.index')
        ->with([
            'result' => $result,
            'paginate' => $data->links('vendor.pagination.default'),   
            'title' => $this->title,
            'sidebar' =>$this->sidebar,
            'template'=>'template/'.$this->template ]);
    }

    public function store(Request $request)
    {

        
        $validation = ValidationPerencanaan::validation($request);

        if($validation) {

            $data = Perencanaan::orderBy('id', 'DESC')->paginate($this->perPage);
            $result = RequestPerencanaan::GetDataAll($data,$this->perPage,$request);

            return view('template/' . $this->template . '.perencanaan.index')
            ->with([
                'result' => $result,
                'paginate' => $data->links('vendor.pagination.default'),   
                'title' => $this->title,
                'sidebar' =>$this->sidebar,
                'errors' =>$validation,
                'template'=>'template/'.$this->template ]);

        } else {

            $data = RequestPerencanaan::fieldsData($request);
            Perencanaan::create($data);
            

        }   
         
      
    }

    public function update($id, Request $request)
    {
        
        $validation = ValidationPerencanaan::validation($request);

        if($validation) {

            $data = Perencanaan::orderBy('id', 'DESC')->paginate($this->perPage);
            $result = RequestPerencanaan::GetDataAll($data,$this->perPage,$request);

            return view('template/' . $this->template . '.perencanaan.index')
            ->with([
                'result' => $result,
                'paginate' => $data->links('vendor.pagination.default'),   
                'title' => $this->title,
                'sidebar' =>$this->sidebar,
                'errors' =>$validation,
                'template'=>'template/'.$this->template ]);

        } else {

            $data = RequestPerencanaan::fieldsData($request);

            dd($data);
            
            Perencanaan::where('id',$id)->update($data);
            

        }
        
      
    }

    public function show($id, Request $request) {

    }

}

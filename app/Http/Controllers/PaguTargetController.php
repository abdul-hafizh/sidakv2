<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestPaguTarget;
use App\Helpers\GeneralPaginate;
use App\Models\PaguTarget;
use Auth;

class PaguTargetController extends Controller
{

    public function __construct()
    {
        $this->title = 'Pagu Target';
        $this->template = RequestSettingApps::AppsTemplate();
        $this->sidebar = RequestSettingApps::AppsSidebar();
        $this->perPage = GeneralPaginate::limit();
    }

    public function index(Request $request)
    {

        $data = PaguTarget::orderBy('id', 'ASC')->paginate($this->perPage);
        $result = RequestPaguTarget::GetDataAll($data, $this->perPage, $request);

        return view('template/' . $this->template . '.paguTarget.index')
            ->with(
                [
                    'result' => $result,
                    'paginate' => $data->links('vendor.pagination.default'),
                    'title' => $this->title,
                    'sidebar' => $this->sidebar,
                    'template' => 'template/' . $this->template
                ]
            );
    }

    public function dt_index(Request $request)
    {

        $data = PaguTarget::orderBy('id', 'ASC')->paginate($this->perPage);
        $result = RequestPaguTarget::GetDataAll($data, $this->perPage, $request);

        return view('template/' . $this->template . '.paguTarget.dt_index')->with(
            [
                'title' => $this->title,
                'sidebar' => $this->sidebar,
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



    // public function show(Request $request)
    // {

    //     return view('template/' . $this->template . '.index')->with(['title' => $this->title]);
    // }
}

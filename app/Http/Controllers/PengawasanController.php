<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestPengawasan;
use App\Helpers\GeneralPaginate;
use App\Models\Pengawasan;
use Auth;

class PengawasanController extends Controller
{

    public function __construct()
    {
        $this->title = 'Pengawasan';
        $this->template = RequestSettingApps::AppsTemplate();
        $this->sidebar = RequestSettingApps::AppsSidebar();
        $this->perPage = GeneralPaginate::limit();
    }

    public function index(Request $request)
    {

        $data = Pengawasan::orderBy('id', 'ASC')->paginate($this->perPage);
        $result = RequestPengawasan::GetDataAll($data, $this->perPage, $request);

        return view('template/' . $this->template . '.pengawasan.index')->with(
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

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ConfigHeader;
use App\Http\Request\RequestSettingApps;

class LayoutController extends Controller
{

    public function __construct()
    {
        $this->title = ConfigHeader::index();
        $this->template = RequestSettingApps::AppsTemplate();
    }

    public function index(Request $request)
    {
        return view('template/' . $this->template . '.index')->with(['title' => $this->title]);
    }

    public function test(Request $request)
    {
        return view('template/' . $this->template . '.index')->with(['title' => $this->title]);
    }



    public function show(Request $request)
    {

        return view('template/' . $this->template . '.index')->with(['title' => $this->title]);
    }
}

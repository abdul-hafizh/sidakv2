<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestPengawasan;
use App\Models\Pengawasan;
use App\Helpers\GeneralPaginate;
use Auth;
use Yajra\DataTables\DataTables;

class PengawasanApiController extends Controller
{

    public function __construct()
    {
    }

    public function check(Request $request)
    {
        if ($request->periode_id != "") {
            $data = Pengawasan::where(['periode_id' => $request->periode_id, 'daerah_id' => Auth::User()->daerah_id])->orderBy('id', 'DESC')->first();
        } else {
            $data = [];
        }

        return response()->json($data);
    }

    public function jsonData(Request $request)
    {
        $result = RequestPengawasan::GetDataList($request);
        $output = array(
            "draw" => $request->draw,
            "recordsTotal" => $result->total,
            "recordsFiltered" => $result->total,
            "data" => $result->data,
        );
        return response()->json($output);
    }
}

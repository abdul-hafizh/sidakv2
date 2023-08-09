<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestPaguTarget;
use App\Models\PaguTarget;
use App\Helpers\GeneralPaginate;
use Auth;
use Yajra\DataTables\DataTables;

class PaguTargetApiController extends Controller
{


    public function __construct()
    {
        $this->perPage = GeneralPaginate::limit();
    }

    public function index(Request $request)
    {
        $paginate = GeneralPaginate::limit();
        $Data = PaguTarget::orderBy('id', 'DESC')->paginate($paginate);
        $description = '';
        $_res = RequestPaguTarget::GetDataAll($Data, $this->perPage, $request, $description);
        return response()->json($_res);
    }

    public function check(Request $request)
    {
        if ($request->periode_id != "") {
            $Data = PaguTarget::where(['periode_id' => $request->periode_id, 'daerah_id' => Auth::User()->daerah_id])->orderBy('id', 'DESC')->first();
        } else {
            $Data = [];
        }

        return response()->json($Data);
    }

    public function jsonData(Request $request)
    {
        $result = RequestPaguTarget::GetDataList($request);
        $output = array(
            "draw" => $request->draw,
            "recordsTotal" => $result->total,
            "recordsFiltered" => $result->total,
            "data" => $result->data,
        );
        return response()->json($output);
    }
}

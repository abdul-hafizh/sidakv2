<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periode;
use App\Http\Request\RequestPeriode;
use App\Http\Request\Validation\ValidationPeriode;
use App\Helpers\GeneralPaginate;
use Auth;
use DB;

class PeriodeApiController extends Controller
{


    public function __construct()
    {
        $this->perPage = GeneralPaginate::limit();
    }

    public function index(Request $request)
    {
        $paginate = GeneralPaginate::limit();
        $Data = Periode::orderBy('id', 'DESC')->paginate($paginate);
        $description = '';
        $_res = RequestPeriode::GetDataAll($Data, $this->perPage, $request, $description);
        return response()->json($_res);
    }



    public function listAll(Request $request)
    {

        $data =  DB::table('periode as a')
            ->select('a.slug', 'a.year')
            ->where('a.status', 'Y')
            ->groupBy('a.year')
            ->whereNotIn(
                'a.year',
                DB::table('perencanaan as c')
                    ->select(DB::raw("LEFT(c.periode_id,4) AS periode_id"))
                    ->where('c.daerah_id', Auth::User()->daerah_id)

            )
            ->get();

        $periode = RequestPeriode::SelectAll($data);
        return response()->json($periode);
    }


    public function periode(Request $request)
    {

        $data =  DB::table('periode')
            ->select('slug', 'year')
            ->where('status', 'Y')
            ->whereIn(
                'slug',
                DB::table('perencanaan')
                    ->select('periode_id')->where('daerah_id', Auth::User()->daerah_id)
            )
            ->groupBy('year')
            ->get();


        $periode = RequestPeriode::SelectAll($data);
        return response()->json($periode);
    }



    public function search(Request $request)
    {
        $search = $request->search;
        $_res = array();
        $AccountValidate = SearchGeneration::Search($search);
        if (count($AccountValidate) > 0) {
            $label = $AccountValidate['label'];
            $value = $AccountValidate['value'];
            $Data = Periode::where($label, 'LIKE', '%' . $value . '%')->orderBy('id', 'DESC')->paginate($this->perPage);
            $description = $search;
            $_res = RequestPeriode::GetDataAll($Data, $this->perPage, $request, $description);
        }
        return response()->json($_res);
    }


    public function edit($id)
    {
        $Data = Periode::find($id);
        $_res = RequestPeriode::GetDataID($Data);
        return response()->json($_res);
    }


    public function store(Request $request)
    {

        $validation = ValidationPeriode::validation($request);
        if ($validation) {
            return response()->json($validation, 400);
        } else {

            $insert = RequestPeriode::fieldsData($request);
            //create menu
            $saveData = Periode::create($insert);
            //result
            return response()->json(['status' => true, 'id' => $saveData, 'message' => 'Insert data sucessfully']);
        }
    }

    public function update($id, Request $request)
    {

        $validation = ValidationPeriode::validation($request);
        if ($validation) {
            return response()->json($validation, 400);
        } else {

            $update = RequestPeriode::fieldsData($request);
            //update account
            $UpdateData = Periode::where('id', $id)->update($update);
            //result
            return response()->json(['status' => true, 'id' => $UpdateData, 'message' => 'Update data sucessfully']);
        }
    }

    public function delete($id)
    {
        $messages['messages'] = false;
        $_res = Periode::find($id);

        if (empty($_res)) {
            return response()->json(['messages' => false]);
        }

        $results = $_res->delete();
        if ($results) {
            $messages['messages'] = true;
        }
        return response()->json($messages);
    }
}

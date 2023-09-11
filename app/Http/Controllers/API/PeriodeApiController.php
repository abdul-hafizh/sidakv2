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
        // $_res = array();
        $query = Periode::orderBy('created_at', 'DESC');
        if ($request->per_page != 'all') {
            $data = $query->paginate($request->per_page);
        } else {
            $data = $query->get();
        }

        $result = RequestPeriode::GetDataAll($data, $request->per_page, $request);
        return response()->json($result);
    }



    public function listAll(Request $request)
    {

        $query =  DB::table('periode as a')
            ->select('a.id', 'a.slug', 'a.year', 'c.pagu_apbn', 'c.pagu_promosi', 'c.target_pengawasan', 'c.target_bimbingan_teknis', 'c.target_penyelesaian_permasalahan')
            ->where('a.status', 'Y')
            ->where('c.daerah_id', Auth::User()->daerah_id);
        if ($request->type == 'POST') {
            $query->whereNotIn(
                'slug',
                DB::table('perencanaan')
                    ->select('periode_id')->where('daerah_id', Auth::User()->daerah_id)
            );
        } else {
            $query->whereIn(
                'slug',
                DB::table('perencanaan')
                    ->select('periode_id')->where('daerah_id', Auth::User()->daerah_id)
            );
        }
        $query->join('pagu_target as c', 'a.year', '=', 'c.periode_id')
            ->groupBy('year');



        $data = $query->get();
        if ($data->count() != 0) {
            $selected = false;
        } else {
            $selected = true;
        }
        $periode = RequestPeriode::SelectAll($data, $request->type);
        return response()->json(['selected' => $selected, 'result' => $periode]);
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

    public function listAll2(Request $request)
    {

        $query =  DB::table('periode as a')
            ->select('a.id', 'a.slug', 'a.year')
            ->where('a.status', 'Y')
            ->groupBy('year');

        $data = $query->get();

        $periode = RequestPeriode::SelectAll2($data);
        return response()->json($periode);
    }
}

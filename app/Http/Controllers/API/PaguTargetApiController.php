<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestPaguTarget;
use App\Models\PaguTarget;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Http\Request\Validation\ValidationPaguTarget;
use App\Imports\PaguTargetImport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use File;
use Response;
use Yajra\DataTables\DataTables;

class PaguTargetApiController extends Controller
{


    public function __construct()
    {
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
        $count = RequestPaguTarget::GetDataCountFilter($request);

        $output = array(
            "draw" => $request->draw,
            "recordsTotal" => $result->total,
            "recordsFiltered" => $count->total,
            "data" => $result->data,
        );
        return response()->json($output);
    }

    public function total_pagu(Request $request)
    {
        $result = RequestPaguTarget::GetTotalPagu($request);

        $output = array(
            "total_apbn" => GeneralHelpers::formatRupiah($result->total_apbn),
            "total_promosi" => GeneralHelpers::formatRupiah($result->total_promosi),
            "total_all" => GeneralHelpers::formatRupiah($result->total_promosi + $result->total_apbn)
        );
        return response()->json($output);
    }

    public function store(Request $request)
    {
        $validation = ValidationPaguTarget::validation($request);
        if ($validation) {
            return response()->json($validation, 400);
        } else {


            $insert = RequestPaguTarget::fieldsData($request);
            //create menu
            $saveData = PaguTarget::create($insert);
            //result
            return response()->json(['status' => true, 'id' => $saveData, 'message' => 'Insert data sucessfully']);
        }
    }

    public function update($id, Request $request)
    {

        $validation = ValidationPaguTarget::validationUpdate($request, $id);
        if ($validation) {
            return response()->json($validation, 400);
        } else {

            $update = RequestPaguTarget::fieldsData($request);
            //update account
            $UpdateData = PaguTarget::where('id', $id)->update($update);
            //result
            return response()->json(['status' => true, 'id' => $UpdateData, 'message' => 'Update data sucessfully']);
        }
    }

    public function import_excel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);


        Excel::import(new PaguTargetImport, $request->file('file')->store('temp'));

        return response()->json(['status' => true, 'id' => 1, 'message' => 'Data Pagu Berhasil Diimport!']);
    }


    public function download_excel(Request $request)
    {
        $myFile = public_path("/pagu_target/template.xlsx");

        return response()->download($myFile);
    }
    public function download_daerah(Request $request)
    {
        $myFile = public_path("/pagu_target/data_daerah.xlsx");

        return response()->download($myFile);
    }

    public function edit($id)
    {
        $result = PaguTarget::where(['id' => $id])->first();
        return response()->json($result);
    }
}

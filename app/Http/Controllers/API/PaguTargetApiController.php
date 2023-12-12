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
use App\Exports\DaerahExport;
use Auth;
use File;
use Response;
use Yajra\DataTables\DataTables;
use App\Http\Request\RequestAuditLog;

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
            "options" => $result->options,
        );
        return response()->json($output);
    }

    public function total_pagu(Request $request)
    {
        $result = RequestPaguTarget::GetTotalPagu($request);

        $output = array(
            "total_apbn" => GeneralHelpers::formatRupiah($result->total_apbn),
            "total_promosi" => GeneralHelpers::formatRupiah($result->total_promosi),
            "total_pengawasan" => GeneralHelpers::formatRupiah($result->total_pengawasan),
            "total_penyelesaian_permasalahan" => GeneralHelpers::formatRupiah($result->total_penyelesaian_permasalahan),
            "total_bimbingan_teknis" => GeneralHelpers::formatRupiah($result->total_bimbingan_teknis),
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

            $log = array(
                'category' => 'LOG_DATA_PAGU_APBN',
                'group_menu' => 'upload_data_pagu_apbn',
                'description' => 'Menambahkan data pagu APBN<b>' . $request->nama_daerah . '</b>',
            );
            $datalog = RequestAuditLog::fieldsData($log);

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

            if ($request->pagu_apbn != ($request->pagu_pengawasan + $request->pagu_penyelesaian_permasalahan + $request->pagu_bimbingan_teknis)) {
                $err['messages']['pagu_apbn'] = 'Total Pagu tidak sama.';
                return response()->json($err, 400);
            }

            $update = RequestPaguTarget::fieldsData($request);
            //update account

            $log = array(
                'category' => 'LOG_DATA_PAGU_APBN',
                'group_menu' => 'mengubah_pagu_apbn',
                'description' => 'Mengubah pagu APBN <b>' . $request->nama_daerah . '</b>',
            );
            $datalog = RequestAuditLog::fieldsData($log);
            //Audit Log

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
        $myFile = public_path("/file/pagu_target/template.xlsx");

        return response()->download($myFile);
    }
    public function download_daerah()
    {
        return Excel::download(new DaerahExport, 'data_daerah.xlsx');
    }

    public function edit($id)
    {
        $result = PaguTarget::where(['id' => $id])->first();
        return response()->json($result);
    }

    public function delete($id)
    {
        $messages['messages'] = false;
        $_res = PaguTarget::find($id);

        if (empty($_res)) {
            return response()->json(['messages' => false]);
        }

        $log = array(
            'category' => 'LOG_DATA_PAGU_APBN',
            'group_menu' => 'menghapus_pagu_apbn',
            'description' => '<b>' . $_res->nama_daerah . '</b> telah dihapus',
        );
        $datalog = RequestAuditLog::fieldsData($log);

        $results = $_res->delete();
        if ($results) {
            $messages['messages'] = true;
        }
        return response()->json($messages);
    }

    public function deleteSelected(Request $request)
    {
        $messages['messages'] = false;

        foreach ($request->data as $key) {
            $find = PaguTarget::where('id', $key)->first();
            $log = array(
                'category' => 'LOG_DATA_PAGU_APBN',
                'group_menu' => 'menghapus_pagu_apbn',
                'description' => '<b>' . $find->nama_daerah . '</b> telah dihapus',
            );
            $datalog = RequestAuditLog::fieldsData($log);

            $results = PaguTarget::where('id', (int)$key)->delete();
        }

        if ($results) {
            $messages['messages'] = true;
        }

        return response()->json($messages);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestBimsos;
use App\Models\Bimsos;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Http\Request\Validation\ValidationBimsos;
use App\Imports\BimsosImport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use File;
use Response;
use Yajra\DataTables\DataTables;

class BimsosApiController extends Controller
{


    public function __construct()
    {
    }


    public function check(Request $request)
    {
        if ($request->periode_id != "") {
            $Data = Bimsos::where(['periode_id' => $request->periode_id, 'daerah_id' => Auth::User()->daerah_id])->orderBy('id', 'DESC')->first();
        } else {
            $Data = [];
        }

        return response()->json($Data);
    }

    public function jsonData(Request $request)
    {
        $result = RequestBimsos::GetDataList($request);
        $count = RequestBimsos::GetDataCountFilter($request);

        $output = array(
            "draw" => $request->draw,
            "recordsTotal" => $result->total,
            "recordsFiltered" => $count->total,
            "data" => $result->data,
        );
        return response()->json($output);
    }

    public function store(Request $request)
    {
        $validation = ValidationBimsos::validation($request);
        if ($validation) {
            return response()->json($validation, 400);
        } else {
            $insert = RequestBimsos::fieldsData($request);

            if ($request->hasFile('lap_hadir')) {
                $file_hadir = $request->file('lap_hadir');
                $lap_hadir = 'lap_hadir_' . time() . '_' . $file_hadir->getClientOriginalName();
                $file_hadir->move(public_path('laporan/bimsos'), $lap_hadir);
                $insert['lap_hadir'] = 'laporan/bimsos/' . $lap_hadir;
            }
            if ($request->hasFile('lap_pendamping')) {
                $file_pendamping = $request->file('lap_pendamping');
                $lap_pendamping = 'lap_pendamping_' . time() . '_' . $file_pendamping->getClientOriginalName();
                $file_pendamping->move(public_path('laporan/bimsos'), $lap_pendamping);
                $insert['lap_pendamping'] = 'laporan/bimsos/' . $lap_pendamping;
            }
            if ($request->hasFile('lap_notula')) {
                $file_notula = $request->file('lap_notula');
                $lap_notula = 'lap_notula_' . time() . '_' . $file_notula->getClientOriginalName();
                $file_notula->move(public_path('laporan/bimsos'), $lap_notula);
                $insert['lap_notula'] = 'laporan/bimsos/' . $lap_notula;
            }
            if ($request->hasFile('lap_survey')) {
                $file_survey = $request->file('lap_survey');
                $lap_survey = 'lap_survey_' . time() . '_' . $file_survey->getClientOriginalName();
                $file_survey->move(public_path('laporan/bimsos'), $lap_survey);
                $insert['lap_survey'] = 'laporan/bimsos/' . $lap_survey;
            }
            if ($request->hasFile('lap_narasumber')) {
                $file_narasumber = $request->file('lap_narasumber');
                $lap_narasumber = 'lap_narasumber_' . time() . '_' . $file_narasumber->getClientOriginalName();
                $file_narasumber->move(public_path('laporan/bimsos'), $lap_narasumber);
                $insert['lap_narasumber'] = 'laporan/bimsos/' . $lap_narasumber;
            }
            if ($request->hasFile('lap_materi')) {
                $file_materi = $request->file('lap_materi');
                $lap_materi = 'lap_materi_' . time() . '_' . $file_materi->getClientOriginalName();
                $file_materi->move(public_path('laporan/bimsos'), $lap_materi);
                $insert['lap_materi'] = 'laporan/bimsos/' . $lap_materi;
            }
            if ($request->hasFile('lap_document')) {
                $file_document = $request->file('lap_document');
                $lap_document = 'lap_document_' . time() . '_' . $file_document->getClientOriginalName();
                $file_document->move(public_path('laporan/bimsos'), $lap_document);
                $insert['lap_document'] = 'laporan/bimsos/' . $lap_document;
            }

            $saveData = Bimsos::create($insert);
            //result
            return response()->json(['status' => true, 'id' => $saveData, 'message' => 'Insert data sucessfully']);
        }
    }

    public function update($id, Request $request)
    {

        $validation = ValidationBimsos::validationUpdate($request, $id);
        if ($validation) {
            return response()->json($validation, 400);
        } else {

            $update = RequestBimsos::fieldsData($request);
            //update account
            if ($request->hasFile('lap_hadir')) {
                $file_hadir = $request->file('lap_hadir');
                $lap_hadir = 'lap_hadir_' . time() . '_' . $file_hadir->getClientOriginalName();
                $file_hadir->move(public_path('laporan/bimsos'), $lap_hadir);
                $update['lap_hadir'] = 'laporan/bimsos/' . $lap_hadir;
            }
            if ($request->hasFile('lap_pendamping')) {
                $file_pendamping = $request->file('lap_pendamping');
                $lap_pendamping = 'lap_pendamping_' . time() . '_' . $file_pendamping->getClientOriginalName();
                $file_pendamping->move(public_path('laporan/bimsos'), $lap_pendamping);
                $update['lap_pendamping'] = 'laporan/bimsos/' . $lap_pendamping;
            }
            if ($request->hasFile('lap_notula')) {
                $file_notula = $request->file('lap_notula');
                $lap_notula = 'lap_notula_' . time() . '_' . $file_notula->getClientOriginalName();
                $file_notula->move(public_path('laporan/bimsos'), $lap_notula);
                $update['lap_notula'] = 'laporan/bimsos/' . $lap_notula;
            }
            if ($request->hasFile('lap_survey')) {
                $file_survey = $request->file('lap_survey');
                $lap_survey = 'lap_survey_' . time() . '_' . $file_survey->getClientOriginalName();
                $file_survey->move(public_path('laporan/bimsos'), $lap_survey);
                $update['lap_survey'] = 'laporan/bimsos/' . $lap_survey;
            }
            if ($request->hasFile('lap_narasumber')) {
                $file_narasumber = $request->file('lap_narasumber');
                $lap_narasumber = 'lap_narasumber_' . time() . '_' . $file_narasumber->getClientOriginalName();
                $file_narasumber->move(public_path('laporan/bimsos'), $lap_narasumber);
                $update['lap_narasumber'] = 'laporan/bimsos/' . $lap_narasumber;
            }
            if ($request->hasFile('lap_materi')) {
                $file_materi = $request->file('lap_materi');
                $lap_materi = 'lap_materi_' . time() . '_' . $file_materi->getClientOriginalName();
                $file_materi->move(public_path('laporan/bimsos'), $lap_materi);
                $update['lap_materi'] = 'laporan/bimsos/' . $lap_materi;
            }
            if ($request->hasFile('lap_document')) {
                $file_document = $request->file('lap_document');
                $lap_document = 'lap_document_' . time() . '_' . $file_document->getClientOriginalName();
                $file_document->move(public_path('laporan/bimsos'), $lap_document);
                $update['lap_document'] = 'laporan/bimsos/' . $lap_document;
            }
            $UpdateData = Bimsos::where('id', $id)->update($update);
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


        Excel::import(new BimsosImport, $request->file('file')->store('temp'));

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
        $result = Bimsos::where(['id' => $id])->first();
        return response()->json($result);
    }

    public function delete($id)
    {
        $messages['messages'] = false;
        $_res = Bimsos::find($id);

        if (empty($_res)) {
            return response()->json(['messages' => false]);
        }

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
            $results = Bimsos::where('id', (int)$key)->delete();
        }

        if ($results) {
            $messages['messages'] = true;
        }

        return response()->json($messages);
    }
}

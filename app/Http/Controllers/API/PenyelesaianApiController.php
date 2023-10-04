<?php

namespace App\Http\Controllers\API;

use Auth;
use File;
use Response;
use Illuminate\Http\Request;
use App\Models\Penyelesaian;
use App\Http\Controllers\Controller;
use App\Http\Request\RequestPenyelesaian;
use App\Http\Request\RequestAuth;
use App\Http\Request\Validation\ValidationPenyelesaian;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Imports\PenyelesaianImport;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class PenyelesaianApiController extends Controller
{


    public function __construct()
    {
    }

    public function check(Request $request)
    {
        if ($request->periode_id != "") {
            $Data = Penyelesaian::where(['periode_id' => $request->periode_id, 'daerah_id' => Auth::User()->daerah_id])->orderBy('id', 'DESC')->first();
        } else {
            $Data = [];
        }

        return response()->json($Data);
    }

    public function jsonData(Request $request)
    {
        $result = RequestPenyelesaian::GetDataList($request);
        $count = RequestPenyelesaian::GetDataCountFilter($request);

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
        $validation = ValidationPenyelesaian::validation($request);
        if ($validation) {
            return response()->json($validation, 400);
        } else {
            $insert = RequestPenyelesaian::fieldsData($request);

            if ($request->hasFile('lap_hadir')) {
                $file_hadir = $request->file('lap_hadir');
                $lap_hadir = 'lap_hadir_' . time() . '_' . $file_hadir->getClientOriginalName();
                $file_hadir->move(public_path('laporan/penyelesaian'), $lap_hadir);
                $insert['lap_hadir'] = 'laporan/penyelesaian/' . $lap_hadir;
            }
            if ($request->hasFile('lap_pendamping')) {
                $file_pendamping = $request->file('lap_pendamping');
                $lap_pendamping = 'lap_pendamping_' . time() . '_' . $file_pendamping->getClientOriginalName();
                $file_pendamping->move(public_path('laporan/penyelesaian'), $lap_pendamping);
                $insert['lap_pendamping'] = 'laporan/penyelesaian/' . $lap_pendamping;
            }
            if ($request->hasFile('lap_notula')) {
                $file_notula = $request->file('lap_notula');
                $lap_notula = 'lap_notula_' . time() . '_' . $file_notula->getClientOriginalName();
                $file_notula->move(public_path('laporan/penyelesaian'), $lap_notula);
                $insert['lap_notula'] = 'laporan/penyelesaian/' . $lap_notula;
            }
            if ($request->hasFile('lap_survey')) {
                $file_survey = $request->file('lap_survey');
                $lap_survey = 'lap_survey_' . time() . '_' . $file_survey->getClientOriginalName();
                $file_survey->move(public_path('laporan/penyelesaian'), $lap_survey);
                $insert['lap_survey'] = 'laporan/penyelesaian/' . $lap_survey;
            }
            if ($request->hasFile('lap_narasumber')) {
                $file_narasumber = $request->file('lap_narasumber');
                $lap_narasumber = 'lap_narasumber_' . time() . '_' . $file_narasumber->getClientOriginalName();
                $file_narasumber->move(public_path('laporan/penyelesaian'), $lap_narasumber);
                $insert['lap_narasumber'] = 'laporan/penyelesaian/' . $lap_narasumber;
            }
            if ($request->hasFile('lap_materi')) {
                $file_materi = $request->file('lap_materi');
                $lap_materi = 'lap_materi_' . time() . '_' . $file_materi->getClientOriginalName();
                $file_materi->move(public_path('laporan/penyelesaian'), $lap_materi);
                $insert['lap_materi'] = 'laporan/penyelesaian/' . $lap_materi;
            }
            if ($request->hasFile('lap_document')) {
                $file_document = $request->file('lap_document');
                $lap_document = 'lap_document_' . time() . '_' . $file_document->getClientOriginalName();
                $file_document->move(public_path('laporan/penyelesaian'), $lap_document);
                $insert['lap_document'] = 'laporan/penyelesaian/' . $lap_document;
            }

            $saveData = Penyelesaian::create($insert);
            //result
            return response()->json(['status' => true, 'id' => $saveData, 'message' => 'Insert data sucessfully']);
        }
    }

    public function update($id, Request $request)
    {

        $validation = ValidationPenyelesaian::validationUpdate($request, $id);
        if ($validation) {
            return response()->json($validation, 400);
        } else {

            $update = RequestPenyelesaian::fieldsData($request);
            //update account
            if ($request->hasFile('lap_hadir')) {
                $file_hadir = $request->file('lap_hadir');
                $lap_hadir = 'lap_hadir_' . time() . '_' . $file_hadir->getClientOriginalName();
                $file_hadir->move(public_path('laporan/penyelesaian'), $lap_hadir);
                $update['lap_hadir'] = 'laporan/penyelesaian/' . $lap_hadir;
            }
            if ($request->hasFile('lap_pendamping')) {
                $file_pendamping = $request->file('lap_pendamping');
                $lap_pendamping = 'lap_pendamping_' . time() . '_' . $file_pendamping->getClientOriginalName();
                $file_pendamping->move(public_path('laporan/penyelesaian'), $lap_pendamping);
                $update['lap_pendamping'] = 'laporan/penyelesaian/' . $lap_pendamping;
            }
            if ($request->hasFile('lap_notula')) {
                $file_notula = $request->file('lap_notula');
                $lap_notula = 'lap_notula_' . time() . '_' . $file_notula->getClientOriginalName();
                $file_notula->move(public_path('laporan/penyelesaian'), $lap_notula);
                $update['lap_notula'] = 'laporan/penyelesaian/' . $lap_notula;
            }
            if ($request->hasFile('lap_survey')) {
                $file_survey = $request->file('lap_survey');
                $lap_survey = 'lap_survey_' . time() . '_' . $file_survey->getClientOriginalName();
                $file_survey->move(public_path('laporan/penyelesaian'), $lap_survey);
                $update['lap_survey'] = 'laporan/penyelesaian/' . $lap_survey;
            }
            if ($request->hasFile('lap_narasumber')) {
                $file_narasumber = $request->file('lap_narasumber');
                $lap_narasumber = 'lap_narasumber_' . time() . '_' . $file_narasumber->getClientOriginalName();
                $file_narasumber->move(public_path('laporan/penyelesaian'), $lap_narasumber);
                $update['lap_narasumber'] = 'laporan/penyelesaian/' . $lap_narasumber;
            }
            if ($request->hasFile('lap_materi')) {
                $file_materi = $request->file('lap_materi');
                $lap_materi = 'lap_materi_' . time() . '_' . $file_materi->getClientOriginalName();
                $file_materi->move(public_path('laporan/penyelesaian'), $lap_materi);
                $update['lap_materi'] = 'laporan/penyelesaian/' . $lap_materi;
            }
            if ($request->hasFile('lap_document')) {
                $file_document = $request->file('lap_document');
                $lap_document = 'lap_document_' . time() . '_' . $file_document->getClientOriginalName();
                $file_document->move(public_path('laporan/penyelesaian'), $lap_document);
                $update['lap_document'] = 'laporan/penyelesaian/' . $lap_document;
            }


            $result = RequestPenyelesaian::GetNilaiPerencanaan($request);
            $sumPenyelesaian = RequestPenyelesaian::GetSumPenyelesaian($request);
            if ($result->total_pagu < $sumPenyelesaian->biaya_kegiatan && $request->status == 14) {
                $err['messages']['biaya_kegiatan'] = 'biaya kegiatan melebihi perencanaan.';
                return response()->json($err, 400);
            }
            if ($result->total_peserta < $sumPenyelesaian->jml_peserta && $request->status == 14) {
                $err['messages']['jml_peserta'] = 'Jumlah Peserta melebihi perencanaan.';
                return response()->json($err, 400);
            }
            $UpdateData = Penyelesaian::where('id', $id)->update($update);
            return response()->json(['status' => true, 'id' => $UpdateData, 'message' => 'Update data sucessfully']);
        }
    }

    public function import_excel(Request $request)
    {        
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        Excel::import(new PenyelesaianImport, $request->file('file')->store('temp'));

        return response()->json(['status' => true, 'id' => 1, 'message' => 'Data Berhasil Diimpor.']);
    }


    public function download_excel(Request $request)
    {
        $myFile = public_path("/pagu_target/template.xlsx");

        return response()->download($myFile);
    }

    public function edit($id)
    {
        $access = RequestAuth::Access();
        $result = Penyelesaian::where(['id' => $id])->first();
        $result['access'] = $access;
        return response()->json($result);
    }

    public function delete($id)
    {
        $messages['messages'] = false;
        $_res = Penyelesaian::find($id);

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
            $results = Penyelesaian::where('id', (int)$key)->delete();
        }

        if ($results) {
            $messages['messages'] = true;
        }

        return response()->json($messages);
    }

    public function request_edit($id, Request $request)
    {

        $messages['messages'] = false;
        $_res = Penyelesaian::find($id);

        if (empty($_res)) {

            return response()->json(['messages' => false]);
        }

        $update = RequestPenyelesaian::fieldReqEdit($request);
        $results = Penyelesaian::where('id', $id)->update($update);

        return response()->json(['status' => true, 'id' => $results, 'message' => 'Update data sucessfully']);
    }

    public function request_revisi($id, Request $request)
    {

        $messages['messages'] = false;
        $_res = Penyelesaian::find($id);

        if (empty($_res)) {

            return response()->json(['messages' => false]);
        }

        $update = RequestPenyelesaian::fieldReqRevisi($request);
        $results = Penyelesaian::where('id', $id)->update($update);

        return response()->json(['status' => true, 'id' => $results, 'message' => 'Update data sucessfully']);
    }

    public function approve_edit($id, Request $request)
    {

        $messages['messages'] = false;
        $_res = Penyelesaian::find($id);

        if (empty($_res)) {

            return response()->json(['messages' => false]);
        }

        $update = RequestPenyelesaian::fieldApprEdit($request);
        $results = Penyelesaian::where('id', $id)->update($update);

        return response()->json(['status' => true, 'id' => $results, 'message' => 'Update data sucessfully']);
    }
}

<?php

namespace App\Http\Controllers\API;

use Auth;
use File;
use Response;
use Illuminate\Http\Request;
use App\Models\Penyelesaian;
use App\Models\AuditLogRequest;
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

            if ($request->hasFile('lap_profile')) {
                $file_profile = $request->file('lap_profile');
                $lap_profile = 'lap_profile_' . time() . '_' . $file_profile->getClientOriginalName();
                $file_profile->move(public_path('laporan/penyelesaian'), $lap_profile);
                $insert['lap_profile'] = 'laporan/penyelesaian/' . $lap_profile;
            }
            if ($request->hasFile('lap_peserta')) {
                $file_hadir = $request->file('lap_peserta');
                $lap_peserta = 'lap_peserta_' . time() . '_' . $file_hadir->getClientOriginalName();
                $file_hadir->move(public_path('laporan/penyelesaian'), $lap_peserta);
                $insert['lap_peserta'] = 'laporan/penyelesaian/' . $lap_peserta;
            }
            if ($request->hasFile('lap_notula')) {
                $file_notula = $request->file('lap_notula');
                $lap_notula = 'lap_notula_' . time() . '_' . $file_notula->getClientOriginalName();
                $file_notula->move(public_path('laporan/penyelesaian'), $lap_notula);
                $insert['lap_notula'] = 'laporan/penyelesaian/' . $lap_notula;
            }
            if ($request->hasFile('lap_narasumber')) {
                $file_narasumber = $request->file('lap_narasumber');
                $lap_narasumber = 'lap_narasumber_' . time() . '_' . $file_narasumber->getClientOriginalName();
                $file_narasumber->move(public_path('laporan/penyelesaian'), $lap_narasumber);
                $insert['lap_narasumber'] = 'laporan/penyelesaian/' . $lap_narasumber;
            }
            if ($request->hasFile('lap_lkpm')) {
                $file_lkpm = $request->file('lap_lkpm');
                $lap_lkpm = 'lap_lkpm_' . time() . '_' . $file_lkpm->getClientOriginalName();
                $file_lkpm->move(public_path('laporan/penyelesaian'), $lap_lkpm);
                $insert['lap_lkpm'] = 'laporan/penyelesaian/' . $lap_lkpm;
            }
            if ($request->hasFile('lap_evaluasi')) {
                $file_evaluasi = $request->file('lap_evaluasi');
                $lap_evaluasi = 'lap_evaluasi_' . time() . '_' . $file_evaluasi->getClientOriginalName();
                $file_evaluasi->move(public_path('laporan/penyelesaian'), $lap_evaluasi);
                $insert['lap_evaluasi'] = 'laporan/penyelesaian/' . $lap_evaluasi;
            }
            if ($request->hasFile('lap_document')) {
                $file_document = $request->file('lap_document');
                $lap_document = 'lap_document_' . time() . '_' . $file_document->getClientOriginalName();
                $file_document->move(public_path('laporan/penyelesaian'), $lap_document);
                $insert['lap_document'] = 'laporan/penyelesaian/' . $lap_document;
            }

            $result = RequestPenyelesaian::GetNilaiPerencanaan($request);
            $sumPenyelesaian = RequestPenyelesaian::GetSumPenyelesaian($request);

            if ($result->total_pagu < $sumPenyelesaian->biaya) {
                $err['messages']['biaya'] = 'Biaya Kegiatan Melebihi Perencanaan.';
                return response()->json($err, 400);
            }
            if ($result->total_target < $sumPenyelesaian->jml_perusahaan) {
                $err['messages']['jml_perusahaan'] = 'Jumlah Perusahaan Melebihi Target.';
                return response()->json($err, 400);
            }

            $saveData = Penyelesaian::create($insert);
            
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

            if ($request->hasFile('lap_profile')) {
                $file_profile = $request->file('lap_profile');
                $lap_profile = 'lap_profile_' . time() . '_' . $file_profile->getClientOriginalName();
                $file_profile->move(public_path('laporan/penyelesaian'), $lap_profile);
                $insert['lap_profile'] = 'laporan/penyelesaian/' . $lap_profile;
            }
            if ($request->hasFile('lap_peserta')) {
                $file_hadir = $request->file('lap_peserta');
                $lap_peserta = 'lap_peserta_' . time() . '_' . $file_hadir->getClientOriginalName();
                $file_hadir->move(public_path('laporan/penyelesaian'), $lap_peserta);
                $insert['lap_peserta'] = 'laporan/penyelesaian/' . $lap_peserta;
            }
            if ($request->hasFile('lap_notula')) {
                $file_notula = $request->file('lap_notula');
                $lap_notula = 'lap_notula_' . time() . '_' . $file_notula->getClientOriginalName();
                $file_notula->move(public_path('laporan/penyelesaian'), $lap_notula);
                $insert['lap_notula'] = 'laporan/penyelesaian/' . $lap_notula;
            }
            if ($request->hasFile('lap_narasumber')) {
                $file_narasumber = $request->file('lap_narasumber');
                $lap_narasumber = 'lap_narasumber_' . time() . '_' . $file_narasumber->getClientOriginalName();
                $file_narasumber->move(public_path('laporan/penyelesaian'), $lap_narasumber);
                $insert['lap_narasumber'] = 'laporan/penyelesaian/' . $lap_narasumber;
            }
            if ($request->hasFile('lap_lkpm')) {
                $file_lkpm = $request->file('lap_lkpm');
                $lap_lkpm = 'lap_lkpm_' . time() . '_' . $file_lkpm->getClientOriginalName();
                $file_lkpm->move(public_path('laporan/penyelesaian'), $lap_lkpm);
                $insert['lap_lkpm'] = 'laporan/penyelesaian/' . $lap_lkpm;
            }
            if ($request->hasFile('lap_evaluasi')) {
                $file_evaluasi = $request->file('lap_evaluasi');
                $lap_evaluasi = 'lap_evaluasi_' . time() . '_' . $file_evaluasi->getClientOriginalName();
                $file_evaluasi->move(public_path('laporan/penyelesaian'), $lap_evaluasi);
                $insert['lap_evaluasi'] = 'laporan/penyelesaian/' . $lap_evaluasi;
            }
            if ($request->hasFile('lap_document')) {
                $file_document = $request->file('lap_document');
                $lap_document = 'lap_document_' . time() . '_' . $file_document->getClientOriginalName();
                $file_document->move(public_path('laporan/penyelesaian'), $lap_document);
                $insert['lap_document'] = 'laporan/penyelesaian/' . $lap_document;
            }

            $result = RequestPenyelesaian::GetNilaiPerencanaan($request);
            $sumPenyelesaian = RequestPenyelesaian::GetSumPenyelesaian($request);

            if ($result->total_pagu < $sumPenyelesaian->biaya) {
                $err['messages']['biaya'] = 'Biaya Kegiatan Melebihi Perencanaan.';
                return response()->json($err, 400);
            }
            if ($result->total_target < $sumPenyelesaian->jml_perusahaan) {
                $err['messages']['jml_perusahaan'] = 'Jumlah Perusahaan Melebihi Target.';
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

        if($results) {
            $request->merge(['id' => $id]);
            $dataLog = RequestPenyelesaian::fieldLogRequest($request);
            $saveLog = AuditLogRequest::create($dataLog);
        }

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

        if($results) {
            $request->merge(['id' => $id]);
            $dataLog = RequestPenyelesaian::fieldLogRequest($request);
            $saveLog = AuditLogRequest::create($dataLog);
        }

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

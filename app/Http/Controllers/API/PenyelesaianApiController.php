<?php

namespace App\Http\Controllers\API;

use DB;
use Auth;
use Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use App\Models\Penyelesaian;
use App\Models\AuditLogRequest;
use App\Models\Periode;
use App\Models\PeriodeExtension;
use App\Models\Notification;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Request\RequestPenyelesaian;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestDaerah;
use App\Http\Request\RequestNotification;
use App\Http\Request\Validation\ValidationPenyelesaian;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Imports\PenyelesaianImport;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\PenyelesaianMail;

class PenyelesaianApiController extends Controller
{

    public function __construct()
    {
    }

    public function check(Request $request)
    {
        if ($request->periode_id != "") {
            $Data = Penyelesaian::where(['periode_id' => $request->periode_id, 'daerah_id' => Auth::User()->daerah_id])->orderBy('created_at', 'DESC')->first();
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
            "options" => $result->options,
        );
        return response()->json($output);
    }

    public function header(Request $request)
    {
        $searchColumn = $request->data;
        $tahunSemester = GeneralHelpers::semesterToday();
        if ($_COOKIE['access'] == 'daerah' || $_COOKIE['access'] == 'province') {
            if (!empty($request->data)) {
                $filterjs = json_decode($searchColumn);
                $data = DB::select(
                    'call header_modul(?,?,?)',
                    array('PENYELESAIAN', $filterjs[0]->periode_id, Auth::User()->daerah_id)
                );
                $semester = substr($filterjs[0]->periode_id, 4);
                $tahun = substr($filterjs[0]->periode_id, 0, 4);
            } else {
                $data = DB::select(
                    'call header_modul(?,?,?)',
                    array('PENYELESAIAN', $tahunSemester, Auth::User()->daerah_id)
                );
                $semester = substr($tahunSemester, 4);
                $tahun = substr($tahunSemester, 0, 4);
            }
        } else {
            $result = RequestPenyelesaian::GetTotalPagu($request);
            $data['total_perencanaan'] = GeneralHelpers::formatRupiah($result->total_perencanaan);
            $data['total_penyelesaian'] = GeneralHelpers::formatRupiah($result->total_penyelesaian);
            $data['total_draft'] = GeneralHelpers::formatRupiah($result->total_draft);
            $semester = substr($tahunSemester, 4);
            $tahun = substr($tahunSemester, 0, 4);
        }
        $output = array(
            "data" => $data,
            "semester" => $semester,
            "tahun" => $tahun,
            "user" => $_COOKIE['access']
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

            if ($request->type == 'kirim') {
                $validationFile = ValidationPenyelesaian::validationFile($request);
                if ($validationFile) {
                    return response()->json($validationFile, 400);
                }
            }

            $path = 'laporan/penyelesaian/' . $request->periode_id_mdl . '/' . Auth::User()->daerah_id;
            $path_save = $request->periode_id_mdl . '/' . Auth::User()->daerah_id;

            if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), $mode = 0777, true, true);
            }

            if ($request->hasFile('lap_profile')) {
                $file_profile = $request->file('lap_profile');
                $lap_profile = 'lap_profile_' . time() . '_' . $file_profile->getClientOriginalName();
                $file_profile->move(public_path($path), $lap_profile);
                $insert['lap_profile'] = $path_save. '/' . $lap_profile;
            }

            if ($request->hasFile('lap_peserta')) {
                $file_peserta = $request->file('lap_peserta');
                $lap_peserta = 'lap_peserta_' . time() . '_' . $file_peserta->getClientOriginalName();
                $file_peserta->move(public_path($path), $lap_peserta);
                $insert['lap_peserta'] = $path_save. '/' . $lap_peserta;
            }

            if ($request->hasFile('lap_profile2')) {
                $file_profile2 = $request->file('lap_profile2');
                $lap_profile2 = 'lap_profile_' . time() . '_' . $file_profile2->getClientOriginalName();
                $file_profile2->move(public_path($path), $lap_profile2);
                $insert['lap_profile2'] = $path_save. '/' . $lap_profile2;
            }

            if ($request->hasFile('lap_narasumber')) {
                $file_narasumber = $request->file('lap_narasumber');
                $lap_narasumber = 'lap_narasumber_' . time() . '_' . $file_narasumber->getClientOriginalName();
                $file_narasumber->move(public_path($path), $lap_narasumber);
                $insert['lap_narasumber'] = $path_save. '/' . $lap_narasumber;
            }

            if ($request->hasFile('lap_notula2')) {
                $file_notula2 = $request->file('lap_notula2');
                $lap_notula2 = 'lap_notula_' . time() . '_' . $file_notula2->getClientOriginalName();
                $file_notula2->move(public_path($path), $lap_notula2);
                $insert['lap_notula2'] = $path_save. '/' . $lap_notula2;
            }

            if ($request->hasFile('lap_lkpm')) {
                $file_lkpm = $request->file('lap_lkpm');
                $lap_lkpm = 'lap_lkpm_' . time() . '_' . $file_lkpm->getClientOriginalName();
                $file_lkpm->move(public_path($path), $lap_lkpm);
                $insert['lap_lkpm'] = $path_save. '/' . $lap_lkpm;
            }

            if ($request->hasFile('lap_document')) {
                $file_document = $request->file('lap_document');
                $lap_document = 'lap_document_' . time() . '_' . $file_document->getClientOriginalName();
                $file_document->move(public_path($path), $lap_document);
                $insert['lap_document'] = $path_save. '/' . $lap_document;
            }

            if ($request->hasFile('lap_notula')) {
                $file_notula = $request->file('lap_notula');
                $lap_notula = 'lap_notula_' . time() . '_' . $file_notula->getClientOriginalName();
                $file_notula->move(public_path($path), $lap_notula);
                $insert['lap_notula'] = $path_save. '/' . $lap_notula;
            }

            if ($request->hasFile('lap_evaluasi')) {
                $file_evaluasi = $request->file('lap_evaluasi');
                $lap_evaluasi = 'lap_evaluasi_' . time() . '_' . $file_evaluasi->getClientOriginalName();
                $file_evaluasi->move(public_path($path), $lap_evaluasi);
                $insert['lap_evaluasi'] = $path_save. '/' . $lap_evaluasi;
            }

            $result = RequestPenyelesaian::GetNilaiPerencanaan($request);
            $sumPenyelesaian = RequestPenyelesaian::GetSumPenyelesaian($request);

            if (
                ($request->sub_menu_slug == 'identifikasi' && $result->penyelesaian_identifikasi_pagu < $sumPenyelesaian->biaya) ||
                ($request->sub_menu_slug == 'penyelesaian' && $result->penyelesaian_realisasi_pagu < $sumPenyelesaian->biaya) ||
                ($request->sub_menu_slug == 'evaluasi' && $result->penyelesaian_evaluasi_pagu < $sumPenyelesaian->biaya)
            ) {
                $err['messages']['biaya'] = 'Biaya Kegiatan Melebihi Perencanaan.';
            }

            // if (
            //     ($request->sub_menu_slug == 'identifikasi' && $result->penyelesaian_identifikasi_target < $sumPenyelesaian->jml_perusahaan) ||
            //     ($request->sub_menu_slug == 'penyelesaian' && $result->penyelesaian_realisasi_target < $sumPenyelesaian->jml_perusahaan) ||
            //     ($request->sub_menu_slug == 'evaluasi' && $result->penyelesaian_evaluasi_target < $sumPenyelesaian->jml_perusahaan)
            // ) {
            //     $err['messages']['jml_perusahaan'] = 'Jumlah Perusahaan Melebihi Target.';
            // }

            if (!empty($err)) {
                return response()->json($err, 400);
            }

            $saveData = Penyelesaian::create($insert);

            if ($saveData) {
                return response()->json(['status' => true, 'message' => 'Berhasil simpan data.']);
            } else {
                return response()->json(['status' => false, 'message' => 'Gagal simpan data.']);
            }
        }
    }

    public function update($id, Request $request)
    {
        $_res = Penyelesaian::find($id);

        $validation = ValidationPenyelesaian::validationUpdate($request, $id);

        if ($validation) {
            return response()->json($validation, 400);
        } else {

            if ($request->type == 'kirim') {
                $validationFile = ValidationPenyelesaian::validationUpdateFile($request, $id);
                if ($validationFile) {
                    return response()->json($validationFile, 400);
                }
            }

            $update = RequestPenyelesaian::fieldsData($request);

            $path = 'laporan/penyelesaian/' . $request->periode_id_mdl . '/' . Auth::User()->daerah_id;
            $path_save = $request->periode_id_mdl . '/' . Auth::User()->daerah_id;

            if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), $mode = 0755, true, true);
            }

            if ($request->hasFile('lap_profile')) {
                $file_profile = $request->file('lap_profile');
                $lap_profile = 'lap_profile_' . time() . '_' . $file_profile->getClientOriginalName();
                $file_profile->move(public_path($path), $lap_profile);
                $update['lap_profile'] = $path_save. '/' . $lap_profile;
            }

            if ($request->hasFile('lap_peserta')) {
                $file_peserta = $request->file('lap_peserta');
                $lap_peserta = 'lap_peserta_' . time() . '_' . $file_peserta->getClientOriginalName();
                $file_peserta->move(public_path($path), $lap_peserta);
                $update['lap_peserta'] = $path_save. '/' . $lap_peserta;
            }

            if ($request->hasFile('lap_profile2')) {
                $file_profile2 = $request->file('lap_profile2');
                $lap_profile2 = 'lap_profile_' . time() . '_' . $file_profile2->getClientOriginalName();
                $file_profile2->move(public_path($path), $lap_profile2);
                $update['lap_profile2'] = $path_save. '/' . $lap_profile2;
            }

            if ($request->hasFile('lap_notula2')) {
                $file_notula2 = $request->file('lap_notula2');
                $lap_notula2 = 'lap_notula_' . time() . '_' . $file_notula2->getClientOriginalName();
                $file_notula2->move(public_path($path), $lap_notula2);
                $update['lap_notula2'] = $path_save. '/' . $lap_notula2;
            }

            if ($request->hasFile('lap_narasumber')) {
                $file_narasumber = $request->file('lap_narasumber');
                $lap_narasumber = 'lap_narasumber_' . time() . '_' . $file_narasumber->getClientOriginalName();
                $file_narasumber->move(public_path($path), $lap_narasumber);
                $update['lap_narasumber'] = $path_save. '/' . $lap_narasumber;
            }

            if ($request->hasFile('lap_lkpm')) {
                $file_lkpm = $request->file('lap_lkpm');
                $lap_lkpm = 'lap_lkpm_' . time() . '_' . $file_lkpm->getClientOriginalName();
                $file_lkpm->move(public_path($path), $lap_lkpm);
                $update['lap_lkpm'] = $path_save. '/' . $lap_lkpm;
            }

            if ($request->hasFile('lap_document')) {
                $file_document = $request->file('lap_document');
                $lap_document = 'lap_document_' . time() . '_' . $file_document->getClientOriginalName();
                $file_document->move(public_path($path), $lap_document);
                $update['lap_document'] = $path_save. '/' . $lap_document;
            }

            if ($request->hasFile('lap_notula')) {
                $file_notula = $request->file('lap_notula');
                $lap_notula = 'lap_notula_' . time() . '_' . $file_notula->getClientOriginalName();
                $file_notula->move(public_path($path), $lap_notula);
                $update['lap_notula'] = $path_save. '/' . $lap_notula;
            }

            if ($request->hasFile('lap_evaluasi')) {
                $file_evaluasi = $request->file('lap_evaluasi');
                $lap_evaluasi = 'lap_evaluasi_' . time() . '_' . $file_evaluasi->getClientOriginalName();
                $file_evaluasi->move(public_path($path), $lap_evaluasi);
                $update['lap_evaluasi'] = $path_save. '/' . $lap_evaluasi;
            }

            $result = RequestPenyelesaian::GetNilaiPerencanaan($request);
            $sumPenyelesaian = RequestPenyelesaian::GetSumPenyelesaian($request, $id);

            if (
                ($request->sub_menu_slug == 'identifikasi' && $result->penyelesaian_identifikasi_pagu < $sumPenyelesaian->biaya) ||
                ($request->sub_menu_slug == 'penyelesaian' && $result->penyelesaian_realisasi_pagu < $sumPenyelesaian->biaya) ||
                ($request->sub_menu_slug == 'evaluasi' && $result->penyelesaian_evaluasi_pagu < $sumPenyelesaian->biaya)
            ) {
                $err['messages']['biaya'] = 'Biaya Kegiatan Melebihi Perencanaan.';
            }

            // if (
            //     ($request->sub_menu_slug == 'identifikasi' && $result->penyelesaian_identifikasi_target < $sumPenyelesaian->jml_perusahaan) ||
            //     ($request->sub_menu_slug == 'penyelesaian' && $result->penyelesaian_realisasi_target < $sumPenyelesaian->jml_perusahaan) ||
            //     ($request->sub_menu_slug == 'evaluasi' && $result->penyelesaian_evaluasi_target < $sumPenyelesaian->jml_perusahaan)
            // ) {
            //     $err['messages']['jml_perusahaan'] = 'Jumlah Perusahaan Melebihi Target.';
            // }

            if (!empty($err)) {
                return response()->json($err, 400);
            }

            $UpdateData = Penyelesaian::where('id', $id)->update($update);

            if ($UpdateData && $request->type == 'kirim') {
                $daerah_name = RequestDaerah::GetDaerahWhereName(Auth::User()->daerah_id);

                $url = url('penyelesaian/' . $id);
                $tahun = substr($request->periode_id_mdl, 0, 4);
                $semester = substr($request->periode_id_mdl, 4);
                $sub_kegiatan = ucwords($request->sub_menu_slug);

                $pusat = User::where('username', 'pusat')->first()->email;
                $judul = 'Penyelesaian Masalah (' . $sub_kegiatan . ')';
                $kepada = 'Kementerian Investasi';
                $subject = 'Permohonan Persetujuan/Approval Penyelesaian Masalah (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name;
                $pesan = 'Mohon persetujuan untuk Penyelesaian Masalah (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' dari daerah Kab/Prov ' . $daerah_name;

                $type = 'penyelesaian';
                $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Approve Penyelesaian Masalah (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester;
                $notif = RequestNotification::fieldsData($type, $messages_desc, $url, Auth::User()->username);
                $insertNotif = Notification::create($notif);

                if ($insertNotif) {
                    //Mail::to($pusat)->send(new PenyelesaianMail(Auth::User()->username, $url, $tahun, $semester, $daerah_name, $sub_kegiatan, $judul, $kepada, $subject, $pesan, 'kirim'));
                    return response()->json(['status' => true, 'message' => 'Berhasil kirim data']);
                } else {
                    return response()->json(['status' => false, 'message' => 'Gagal kirim data']);
                }
            } else if ($UpdateData) {
                return response()->json(['status' => true, 'message' => 'Berhasil ubah data']);
            } else {
                return response()->json(['status' => false, 'message' => 'Gagal ubah data']);
            }
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

    public function log($id)
    {
        $result = Penyelesaian::leftJoin('audit_log_request as log', 'penyelesaian.id', '=', 'log.kegiatan_id')
            ->select('penyelesaian.nama_kegiatan', 'penyelesaian.sub_menu', 'log.*')
            ->where('penyelesaian.id', $id)
            ->orderBy('log.id', 'desc')
            ->get();

        return response()->json($result);
    }

    public function cekPeriode($id)
    {
        $today = Carbon::now();
        $formattedDate = $today->format('Y-m-d');
        $daerah_id =  Auth::User()->daerah_id;

        $year = substr($id, 0, 4);
        $semester = substr($id, 4);

        $cek_exten = PeriodeExtension::where('year', $year)
            ->where('semester', $semester)
            ->whereDate('expireddate', '<=', $formattedDate)
            ->whereDate('extensiondate', '>=', $formattedDate)
            ->where('daerah_id', $daerah_id)
            ->where('checklist', 'approved')
            ->orderBy('created_at', 'desc')
            ->first();

        $result = Periode::where('slug', $id)
            ->where('status', 'Y')
            ->whereDate('startdate', '<=', $formattedDate)
            ->whereDate('enddate', '>=', $formattedDate)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($cek_exten) {
            $result = Periode::where('slug', $id)
                ->where('status', 'Y')
                ->orderBy('created_at', 'desc')
                ->first();
        }

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

        if ($results) {
            $request->merge(['id' => $id]);
            $dataLog = RequestPenyelesaian::fieldLogRequest($request);
            $saveLog = AuditLogRequest::create($dataLog);

            $daerah_name = RequestDaerah::GetDaerahWhereName(Auth::User()->daerah_id);

            $tahun = substr($_res->periode_id_mdl, 0, 4);
            $semester = substr($_res->periode_id_mdl, 4);
            $sub_kegiatan = ucwords($_res->sub_menu_slug);

            $url = url('penyelesaian/' . $id);
            $type = 'penyelesaian';
            $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Request Edit Penyelesaian Masalah (' . $sub_kegiatan . '), Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name;
            $notif = RequestNotification::fieldsData($type, $messages_desc, $url, Auth::User()->username);
            $insertNotif = Notification::create($notif);

            $pusat = User::where('username', 'pusat')->first()->email;
            $judul = 'Penyelesaian Masalah (' . $sub_kegiatan . ')';
            $kepada = 'Kementerian Investasi';
            $subject = 'Permohonan Request Edit Penyelesaian Masalah (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name;
            $pesan = 'Mohon persetujuan untuk request edit menu penyelesaian masalah (' . $sub_kegiatan . '), Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name . ', dengan alasan ' . $request->alasan;

            if ($insertNotif) {
                // Mail::to($pusat)->send(new PenyelesaianMail(Auth::User()->username, $url, $tahun, $semester, $daerah_name, $sub_kegiatan, $judul, $kepada, $subject, $pesan, 'request_edit'));
                return response()->json(['status' => true, 'id' => $id, 'message' => 'Berhasil request edit data']);
            } else {
                return response()->json(['status' => false, 'id' => $id, 'message' => 'Gagal request edit data']);
            }
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

        if ($results) {
            $request->merge(['id' => $id]);
            $dataLog = RequestPenyelesaian::fieldLogRequest($request);
            $saveLog = AuditLogRequest::create($dataLog);

            $daerah_name = RequestDaerah::GetDaerahWhereName($_res->daerah_id);

            $tahun = substr($_res->periode_id_mdl, 0, 4);
            $semester = substr($_res->periode_id_mdl, 4);
            $sub_kegiatan = ucwords($_res->sub_menu_slug);

            $type = 'penyelesaian';
            $url = url('penyelesaian');
            $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Revisi Penyelesaian Masalah (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name;
            $notif = RequestNotification::fieldsData($type, $messages_desc, $url, Auth::User()->username);
            $insertNotif = Notification::create($notif);

            $email_daerah = User::where('username', $_res->created_by)->first()->email;
            $judul = 'Penyelesaian Masalah (' . $sub_kegiatan . ')';
            $kepada = 'Pemerintah Daerah ' . $daerah_name;
            $subject = 'Permohonan Perbaikan Penyelesaian Masalah (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name;
            $pesan = 'Mohon persetujuan untuk perbaikan data penyelesaian masalah (' . $sub_kegiatan . '), Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name . ', dengan alasan ' . $request->alasan;

            if ($insertNotif) {
                // Mail::to('abdulha05518@gmail.com')->send(new PenyelesaianMail(Auth::User()->username, $url, $tahun, $semester, $daerah_name, $sub_kegiatan, $judul, $kepada, $subject, $pesan, 'revisi'));
                return response()->json(['status' => true, 'id' => $id, 'message' => 'Berhasil kirim perbaikan data']);
            } else {
                return response()->json(['status' => false, 'id' => $id, 'message' => 'Gagal kirim perbaikan data']);
            }
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

        if ($results) {
            $type = 'penyelesaian';
            $url = 'penyelesaian';
            $messages_desc = strtoupper(Auth::User()->username) . ' Request Edit Telah Diapprove';
            $notif = RequestNotification::fieldsData($type, $messages_desc, $url, Auth::User()->username);            
            Notification::create($notif);
        }

        return response()->json(['status' => true, 'id' => $results, 'message' => 'Update data sucessfully']);
    }

    public function approveSelected(Request $request)
    {
        $messages['messages'] = false;

        foreach ($request->data as $key) {
            $update = RequestPenyelesaian::fieldApprEdit($request);
            $results = Penyelesaian::where('id', (int)$key)->update($update);
        }

        if ($results) {
            $messages['messages'] = true;
        }

        return response()->json($messages);
    }
}

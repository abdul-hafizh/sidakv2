<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestBimsos;
use App\Models\AuditLogRequest;
use App\Models\Bimsos;
use App\Models\User;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestNotification;
use App\Models\Notification;
use App\Http\Request\RequestDaerah;
use App\Http\Request\Validation\ValidationBimsos;
use App\Imports\BimsosImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
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
            "options" => $result->options,
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

            if ($request->status == 14) {
                $validationFile = ValidationBimsos::validationFile($request);
                if ($validationFile) {
                    return response()->json($validationFile, 400);
                }
            }
            $path = 'laporan/bimtek/' . $request->periode_id_mdl . '/' . Auth::User()->daerah_id;
            if ($request->hasFile('lap_hadir')) {
                $file_hadir = $request->file('lap_hadir');
                $lap_hadir = 'hadir-' . time() . '-' . $file_hadir->getClientOriginalName();
                $file_hadir->move(public_path($path), $lap_hadir);
                $insert['lap_hadir'] = $path . '/' . $lap_hadir;
            }
            if ($request->hasFile('lap_pendamping')) {
                $file_pendamping = $request->file('lap_pendamping');
                $lap_pendamping = 'pendamping-' . time() . '-' . $file_pendamping->getClientOriginalName();
                $file_pendamping->move(public_path($path), $lap_pendamping);
                $insert['lap_pendamping'] = $path . '/' . $lap_pendamping;
            }
            if ($request->hasFile('lap_notula')) {
                $file_notula = $request->file('lap_notula');
                $lap_notula = 'notula-' . time() . '-' . $file_notula->getClientOriginalName();
                $file_notula->move(public_path($path), $lap_notula);
                $insert['lap_notula'] = $path . '/' . $lap_notula;
            }
            if ($request->hasFile('lap_survey')) {
                $file_survey = $request->file('lap_survey');
                $lap_survey = 'survey-' . time() . '-' . $file_survey->getClientOriginalName();
                $file_survey->move(public_path($path), $lap_survey);
                $insert['lap_survey'] = $path . '/' . $lap_survey;
            }
            if ($request->hasFile('lap_narasumber')) {
                $file_narasumber = $request->file('lap_narasumber');
                $lap_narasumber = 'narasumber-' . time() . '-' . $file_narasumber->getClientOriginalName();
                $file_narasumber->move(public_path($path), $lap_narasumber);
                $insert['lap_narasumber'] = $path . '/' . $lap_narasumber;
            }
            if ($request->hasFile('lap_materi')) {
                $file_materi = $request->file('lap_materi');
                $lap_materi = 'materi-' . time() . '-' . $file_materi->getClientOriginalName();
                $file_materi->move(public_path($path), $lap_materi);
                $insert['lap_materi'] = $path . '/' . $lap_materi;
            }
            if ($request->hasFile('lap_document')) {
                $file_document = $request->file('lap_document');
                $lap_document = 'document-' . time() . '-' . $file_document->getClientOriginalName();
                $file_document->move(public_path($path), $lap_document);
                $insert['lap_document'] = $path . '/' . $lap_document;
            }

            $result = RequestBimsos::GetNilaiPerencanaan($request);
            $sumBimsos = RequestBimsos::GetSumBimsos($request);
            if ($result->total_pagu < $sumBimsos->biaya_kegiatan && $request->status == 14) {
                $err['messages']['biaya_kegiatan'] = 'biaya kegiatan melebihi perencanaan.';
                return response()->json($err, 400);
            }

            $saveData = Bimsos::create($insert);
            //result
            if ($saveData && $request->status == 14) {
                $daerah_name = RequestDaerah::GetDaerahWhereName(Auth::User()->daerah_id);

                $url = url('bimsos/' . $saveData);
                $tahun = substr($request->periode_id_mdl, 0, 4);
                $semester = substr($request->periode_id_mdl, 4);
                $sub_kegiatan = ucwords($request->sub_menu_slug);

                // $pusat = User::where('username', 'pusat')->first()->email;
                // $judul = 'Bimbingan Teknis/Sosialisasi Kemudahan Berusaha (' . $sub_kegiatan . ')';
                // $kepada = 'Kementerian Investasi';
                // $subject = 'Permohonan Persetujuan/Approval Bimbingan Teknis/Sosialisasi Kemudahan Berusaha (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name;
                // $pesan = 'Mohon persetujuan untuk Bimbingan Teknis/Sosialisasi Kemudahan Berusaha (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' dari daerah Kab/Prov ' . $daerah_name;

                $pusat = User::where('username', 'pusat')->first();
                $type = 'bimsos';
                $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Approve Bimbingan Teknis/Sosialisasi Kemudahan Berusaha (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester;
                $notif = RequestNotification::fieldsData($type, $messages_desc, $url, $pusat->username);
                $insertNotif = Notification::create($notif);

                if ($insertNotif) {
                    //  Mail::to($pusat)->send(new PenyelesaianMail(Auth::User()->username, $url, $tahun, $semester, $daerah_name, $sub_kegiatan, $judul, $kepada, $subject, $pesan, 'kirim'));
                    return response()->json(['status' => true, 'id' => $saveData, 'message' => 'Berhasil kirim data']);
                } else {
                    return response()->json(['status' => false, 'id' => $saveData, 'message' => 'Gagal kirim data']);
                }
            } else if ($saveData) {
                return response()->json(['status' => true, 'id' => $saveData, 'message' => 'Berhasil simpan data']);
            } else {
                return response()->json(['status' => false, 'id' => $saveData, 'message' => 'Gagal simpan data']);
            }
        }
    }

    public function update($id, Request $request)
    {

        $validation = ValidationBimsos::validationUpdate($request, $id);
        if ($validation) {
            return response()->json($validation, 400);
        } else {

            if ($request->status == 14) {
                $validationFile = ValidationBimsos::validationUpdateFile($request, $id);
                if ($validationFile) {
                    return response()->json($validationFile, 400);
                }
            }

            $update = RequestBimsos::fieldsData($request);
            //update account
            $path = 'laporan/bimtek/' . $request->periode_id_mdl . '/' . Auth::User()->daerah_id;
            if ($request->hasFile('lap_hadir')) {
                $file_hadir = $request->file('lap_hadir');
                $lap_hadir = 'hadir-' . time() . '-' . $file_hadir->getClientOriginalName();
                $file_hadir->move(public_path($path), $lap_hadir);
                $update['lap_hadir'] = $path . '/' . $lap_hadir;
            }
            if ($request->hasFile('lap_pendamping')) {
                $file_pendamping = $request->file('lap_pendamping');
                $lap_pendamping = 'pendamping-' . time() . '-' . $file_pendamping->getClientOriginalName();
                $file_pendamping->move(public_path($path), $lap_pendamping);
                $update['lap_pendamping'] = $path . '/' . $lap_pendamping;
            }
            if ($request->hasFile('lap_notula')) {
                $file_notula = $request->file('lap_notula');
                $lap_notula = 'notula-' . time() . '-' . $file_notula->getClientOriginalName();
                $file_notula->move(public_path($path), $lap_notula);
                $update['lap_notula'] = $path . '/' . $lap_notula;
            }
            if ($request->hasFile('lap_survey')) {
                $file_survey = $request->file('lap_survey');
                $lap_survey = 'survey-' . time() . '-' . $file_survey->getClientOriginalName();
                $file_survey->move(public_path($path), $lap_survey);
                $update['lap_survey'] = $path . '/' . $lap_survey;
            }
            if ($request->hasFile('lap_narasumber')) {
                $file_narasumber = $request->file('lap_narasumber');
                $lap_narasumber = 'narasumber-' . time() . '-' . $file_narasumber->getClientOriginalName();
                $file_narasumber->move(public_path($path), $lap_narasumber);
                $update['lap_narasumber'] = $path . '/' . $lap_narasumber;
            }
            if ($request->hasFile('lap_materi')) {
                $file_materi = $request->file('lap_materi');
                $lap_materi = 'materi-' . time() . '-' . $file_materi->getClientOriginalName();
                $file_materi->move(public_path($path), $lap_materi);
                $update['lap_materi'] = $path . '/' . $lap_materi;
            }
            if ($request->hasFile('lap_document')) {
                $file_document = $request->file('lap_document');
                $lap_document = 'document-' . time() . '-' . $file_document->getClientOriginalName();
                $file_document->move(public_path($path), $lap_document);
                $update['lap_document'] = $path . '/' . $lap_document;
            }


            $result = RequestBimsos::GetNilaiPerencanaan($request);
            $sumBimsos = RequestBimsos::GetSumBimsos($request);
            if ($result->total_pagu < $sumBimsos->biaya_kegiatan && $request->status == 14) {
                $err['messages']['biaya_kegiatan'] = 'biaya kegiatan melebihi perencanaan.';
                return response()->json($err, 400);
            }
            // if ($result->total_peserta < $sumBimsos->jml_peserta && $request->status == 14) {
            //     $err['messages']['jml_peserta'] = 'Jumlah Peserta melebihi perencanaan.';
            //     return response()->json($err, 400);
            // }
            $id_bimsos = $request->id_bimsos;
            $UpdateData = Bimsos::where('id', $id_bimsos)->update($update);

            if ($UpdateData && $request->status == 14) {
                $daerah_name = RequestDaerah::GetDaerahWhereName(Auth::User()->daerah_id);

                $url = url('bimsos/' . $id);
                $tahun = substr($request->periode_id_mdl, 0, 4);
                $semester = substr($request->periode_id_mdl, 4);
                $sub_kegiatan = ucwords($request->sub_menu_slug);

                // $pusat = User::where('username', 'pusat')->first()->email;
                // $judul = 'Bimbingan Teknis/Sosialisasi Kemudahan Berusaha (' . $sub_kegiatan . ')';
                // $kepada = 'Kementerian Investasi';
                // $subject = 'Permohonan Persetujuan/Approval Bimbingan Teknis/Sosialisasi Kemudahan Berusaha (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name;
                // $pesan = 'Mohon persetujuan untuk Bimbingan Teknis/Sosialisasi Kemudahan Berusaha (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' dari daerah Kab/Prov ' . $daerah_name;

                $pusat = User::where('username', 'pusat')->first();
                $type = 'bimsos';
                $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Approve Bimbingan Teknis/Sosialisasi Kemudahan Berusaha (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester;
                $notif = RequestNotification::fieldsData($type, $messages_desc, $url, $pusat->username);
                $insertNotif = Notification::create($notif);

                if ($insertNotif) {
                    //  Mail::to($pusat)->send(new PenyelesaianMail(Auth::User()->username, $url, $tahun, $semester, $daerah_name, $sub_kegiatan, $judul, $kepada, $subject, $pesan, 'kirim'));
                    return response()->json(['status' => true, 'id' => $id, 'message' => 'Berhasil kirim data']);
                } else {
                    return response()->json(['status' => false, 'id' => $id, 'message' => 'Gagal kirim data']);
                }
            } else if ($UpdateData) {
                return response()->json(['status' => true, 'id' => $id, 'message' => 'Berhasil ubah data']);
            } else {
                return response()->json(['status' => false, 'id' => $id, 'message' => 'Gagal ubah data']);
            }
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


    public function edit($id)
    {
        $access = RequestAuth::Access();
        $result = Bimsos::where(['id' => $id])->first();
        $result['access'] = $access;
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

    public function approveSelected(Request $request)
    {
        $messages['messages'] = false;

        foreach ($request->data as $key) {
            $update = RequestBimsos::fieldApprEdit($request);
            $results = Bimsos::where('id', (int)$key)->update($update);
        }

        if ($results) {
            $messages['messages'] = true;
        }

        return response()->json($messages);
    }

    public function request_edit($id, Request $request)
    {

        $messages['messages'] = false;
        $_res = Bimsos::find($id);

        if (empty($_res)) {

            return response()->json(['messages' => false]);
        }

        $update = RequestBimsos::fieldReqEdit($request);
        $results = Bimsos::where('id', $id)->update($update);

        if ($results) {
            $request->merge(['id' => $id]);
            $dataLog = RequestBimsos::fieldLogRequest($request);
            $saveLog = AuditLogRequest::create($dataLog);

            $daerah_name = RequestDaerah::GetDaerahWhereName(Auth::User()->daerah_id);

            $url = url('bimsos/' . $id);
            $tahun = substr($request->periode_id_mdl, 0, 4);
            $semester = substr($request->periode_id_mdl, 4);
            $sub_kegiatan = ucwords($request->sub_menu_slug);

            // $pusat = User::where('username', 'pusat')->first()->email;
            // $judul = 'Bimbingan Teknis/Sosialisasi Kemudahan Berusaha (' . $sub_kegiatan . ')';
            // $kepada = 'Kementerian Investasi';
            // $subject = 'Meminta Request Edit Bimbingan Teknis/Sosialisasi Kemudahan Berusaha (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name;
            // $pesan = 'Meminta Request Edit untuk Bimbingan Teknis/Sosialisasi Kemudahan Berusaha (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' dari daerah Kab/Prov ' . $daerah_name;

            $pusat = User::where('username', 'pusat')->first();
            $type = 'bimsos';
            $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Request Edit Bimbingan Teknis/Sosialisasi Kemudahan Berusaha (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester;
            $notif = RequestNotification::fieldsData($type, $messages_desc, $url, $pusat->username);
            $insertNotif = Notification::create($notif);

            if ($insertNotif) {
                //  Mail::to($pusat)->send(new PenyelesaianMail(Auth::User()->username, $url, $tahun, $semester, $daerah_name, $sub_kegiatan, $judul, $kepada, $subject, $pesan, 'kirim'));
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
        $_res = Bimsos::find($id);

        if (empty($_res)) {

            return response()->json(['messages' => false]);
        }

        $update = RequestBimsos::fieldReqRevisi($request);
        $results = Bimsos::where('id', $id)->update($update);

        if ($results) {
            $request->merge(['id' => $id]);
            $dataLog = RequestBimsos::fieldLogRequest($request);
            $saveLog = AuditLogRequest::create($dataLog);

            $daerah_name = RequestDaerah::GetDaerahWhereName(Auth::User()->daerah_id);

            $url = url('bimsos/' . $id);
            $tahun = substr($request->periode_id_mdl, 0, 4);
            $semester = substr($request->periode_id_mdl, 4);
            $sub_kegiatan = ucwords($request->sub_menu_slug);

            // $pusat = User::where('username', 'pusat')->first()->email;
            // $judul = 'Bimbingan Teknis/Sosialisasi Kemudahan Berusaha (' . $sub_kegiatan . ')';
            // $kepada = 'Kementerian Investasi';
            // $subject = 'Meminta Request Edit Bimbingan Teknis/Sosialisasi Kemudahan Berusaha (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name;
            // $pesan = 'Meminta Request Edit untuk Bimbingan Teknis/Sosialisasi Kemudahan Berusaha (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' dari daerah Kab/Prov ' . $daerah_name;

            $bim = Bimsos::find($id);
            $type = 'bimsos';
            $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Request revisi Bimbingan Teknis/Sosialisasi Kemudahan Berusaha (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester;
            $notif = RequestNotification::fieldsData($type, $messages_desc, $url, $bim->created_by);
            $insertNotif = Notification::create($notif);

            if ($insertNotif) {
                //  Mail::to($pusat)->send(new PenyelesaianMail(Auth::User()->username, $url, $tahun, $semester, $daerah_name, $sub_kegiatan, $judul, $kepada, $subject, $pesan, 'kirim'));
                return response()->json(['status' => true, 'id' => $id, 'message' => 'Berhasil request revisi data']);
            } else {
                return response()->json(['status' => false, 'id' => $id, 'message' => 'Gagal request revisi data']);
            }
        }
        return response()->json(['status' => true, 'id' => $results, 'message' => 'Update data sucessfully']);
    }

    public function approve_edit($id, Request $request)
    {

        $messages['messages'] = false;
        $_res = Bimsos::find($id);

        if (empty($_res)) {

            return response()->json(['messages' => false]);
        }

        $bim = Bimsos::find($id);
        $type = 'bimsos';
        $url = url('bimsos/');
        $tahun = substr($request->periode_id_mdl, 0, 4);
        $semester = substr($request->periode_id_mdl, 4);
        $sub_kegiatan = ucwords($request->sub_menu_slug);
        $messages_desc = strtoupper(Auth::User()->username) . ' Approve edit revisi Bimbingan Teknis/Sosialisasi Kemudahan Berusaha (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester;
        $notif = RequestNotification::fieldsData($type, $messages_desc, $url, $bim->created_by);
        Notification::create($notif);

        $update = RequestBimsos::fieldApprEdit($request);
        $results = Bimsos::where('id', $id)->update($update);

        // if ($results) {
        //     $type = 'perencanaan';
        //     $messages_desc = strtoupper(Auth::User()->username) . ' Tidak Menyetujui Perencanaan Tahun ' . $_res->periode_id;
        //     $notif = RequestNotification::fieldsData($type, $messages_desc);
        //     Notification::create($notif);

        //     $messages['messages'] = true;
        // }
        return response()->json(['status' => true, 'id' => $results, 'message' => 'Update data sucessfully']);
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
                    array('BIMSOS', $filterjs[0]->periode_id, Auth::User()->daerah_id)
                );
                $semester = substr($filterjs[0]->periode_id, 4);
                $tahun = substr($filterjs[0]->periode_id, 0, 4);
            } else {
                $data = DB::select(
                    'call header_modul(?,?,?)',
                    array('BIMSOS', $tahunSemester, Auth::User()->daerah_id)
                );
                $semester = substr($tahunSemester, 4);
                $tahun = substr($tahunSemester, 0, 4);
            }
        } else {
            $result = RequestBimsos::GetTotalPagu($request);
            $data['total_perencanaan'] = GeneralHelpers::formatRupiah($result->total_perencanaan);
            $data['total_bimsos'] = GeneralHelpers::formatRupiah($result->total_bimsos);
            $data['total_bimsos_draft'] = GeneralHelpers::formatRupiah($result->total_bimsos_draft);
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
}

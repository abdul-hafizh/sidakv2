<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestPengawasan;
use App\Http\Request\RequestDaerah;
use App\Models\Pengawasan;
use App\Models\AuditLogRequest;
use App\Helpers\GeneralPaginate;
use App\Http\Request\RequestNotification;
use App\Models\Notification;
use App\Http\Request\Validation\ValidationPengawasan;
use Auth;
use Yajra\DataTables\DataTables;

class PengawasanApiController extends Controller
{

    public function __construct()
    {
    }

    public function check(Request $request)
    {
        if ($request->periode_id != "") {
            $data = Pengawasan::where(['periode_id' => $request->periode_id, 'daerah_id' => Auth::User()->daerah_id])->orderBy('id', 'DESC')->first();
        } else {
            $data = [];
        }

        return response()->json($data);
    }

    public function jsonData(Request $request)
    {
        $result = RequestPengawasan::GetDataList($request);
        $count = RequestPengawasan::GetDataCountFilter($request);

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
        $validation = ValidationPengawasan::validation($request);
        if ($validation) {
            return response()->json($validation, 400);
        } else {
            $insert = RequestPengawasan::fieldsData($request);

            if ($request->status == 14) {
                $validationFile = ValidationPengawasan::validationFile($request);
                if ($validationFile) {
                    return response()->json($validationFile, 400);
                }
            }

            if ($request->hasFile('lap_kegiatan')) {
                $file_hadir = $request->file('lap_kegiatan');
                $lap_kegiatan = 'lap_kegiatan_' . time() . '_' . $file_hadir->getClientOriginalName();
                $file_hadir->move(public_path('laporan/pengawasan'), $lap_kegiatan);
                $insert['lap_kegiatan'] = 'laporan/pengawasan/' . $lap_kegiatan;
            }
            if ($request->hasFile('lap_pendamping')) {
                $file_pendamping = $request->file('lap_pendamping');
                $lap_pendamping = 'lap_pendamping_' . time() . '_' . $file_pendamping->getClientOriginalName();
                $file_pendamping->move(public_path('laporan/pengawasan'), $lap_pendamping);
                $insert['lap_pendamping'] = 'laporan/pengawasan/' . $lap_pendamping;
            }
            if ($request->hasFile('lap_notula')) {
                $file_notula = $request->file('lap_notula');
                $lap_notula = 'lap_notula_' . time() . '_' . $file_notula->getClientOriginalName();
                $file_notula->move(public_path('laporan/pengawasan'), $lap_notula);
                $insert['lap_notula'] = 'laporan/pengawasan/' . $lap_notula;
            }
            if ($request->hasFile('lap_survey')) {
                $file_survey = $request->file('lap_survey');
                $lap_survey = 'lap_survey_' . time() . '_' . $file_survey->getClientOriginalName();
                $file_survey->move(public_path('laporan/pengawasan'), $lap_survey);
                $insert['lap_survey'] = 'laporan/pengawasan/' . $lap_survey;
            }
            if ($request->hasFile('lap_narasumber')) {
                $file_narasumber = $request->file('lap_narasumber');
                $lap_narasumber = 'lap_narasumber_' . time() . '_' . $file_narasumber->getClientOriginalName();
                $file_narasumber->move(public_path('laporan/pengawasan'), $lap_narasumber);
                $insert['lap_narasumber'] = 'laporan/pengawasan/' . $lap_narasumber;
            }
            if ($request->hasFile('lap_materi')) {
                $file_materi = $request->file('lap_materi');
                $lap_materi = 'lap_materi_' . time() . '_' . $file_materi->getClientOriginalName();
                $file_materi->move(public_path('laporan/pengawasan'), $lap_materi);
                $insert['lap_materi'] = 'laporan/pengawasan/' . $lap_materi;
            }
            if ($request->hasFile('lap_document')) {
                $file_document = $request->file('lap_document');
                $lap_document = 'lap_document_' . time() . '_' . $file_document->getClientOriginalName();
                $file_document->move(public_path('laporan/pengawasan'), $lap_document);
                $insert['lap_document'] = 'laporan/pengawasan/' . $lap_document;
            }


            $saveData = Pengawasan::create($insert);
            //result
            if ($saveData && $request->status == 14) {
                $daerah_name = RequestDaerah::GetDaerahWhereName(Auth::User()->daerah_id);

                $url = url('pengawasan/' . $saveData);
                $tahun = substr($request->periode_id_mdl, 0, 4);
                $semester = substr($request->periode_id_mdl, 4);
                $sub_kegiatan = ucwords($request->sub_menu_slug);

                // $pusat = User::where('username', 'pusat')->first()->email;
                // $judul = 'Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ')';
                // $kepada = 'Kementerian Investasi';
                // $subject = 'Permohonan Persetujuan/Approval Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name;
                // $pesan = 'Mohon persetujuan untuk Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' dari daerah Kab/Prov ' . $daerah_name;

                $type = 'pengawasan';
                $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Approve Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester;
                $notif = RequestNotification::fieldsData($type, $messages_desc, $url);
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

    public function edit($id)
    {
        $access = RequestAuth::Access();
        $result = Pengawasan::where(['id' => $id])->first();
        $result['access'] = $access;
        return response()->json($result);
    }

    public function update($id, Request $request)
    {

        $validation = ValidationPengawasan::validationUpdate($request, $id);
        if ($validation) {
            return response()->json($validation, 400);
        } else {

            if ($request->status == 14) {
                $validationFile = ValidationPengawasan::validationUpdateFile($request, $id);
                if ($validationFile) {
                    return response()->json($validationFile, 400);
                }
            }

            $update = RequestPengawasan::fieldsData($request);
            //update account
            if ($request->hasFile('lap_kegiatan')) {
                $file_hadir = $request->file('lap_kegiatan');
                $lap_kegiatan = 'lap_kegiatan_' . time() . '_' . $file_hadir->getClientOriginalName();
                $file_hadir->move(public_path('laporan/pengawasan'), $lap_kegiatan);
                $update['lap_kegiatan'] = 'laporan/pengawasan/' . $lap_kegiatan;
            }
            if ($request->hasFile('lap_pendamping')) {
                $file_pendamping = $request->file('lap_pendamping');
                $lap_pendamping = 'lap_pendamping_' . time() . '_' . $file_pendamping->getClientOriginalName();
                $file_pendamping->move(public_path('laporan/pengawasan'), $lap_pendamping);
                $update['lap_pendamping'] = 'laporan/pengawasan/' . $lap_pendamping;
            }
            if ($request->hasFile('lap_notula')) {
                $file_notula = $request->file('lap_notula');
                $lap_notula = 'lap_notula_' . time() . '_' . $file_notula->getClientOriginalName();
                $file_notula->move(public_path('laporan/pengawasan'), $lap_notula);
                $update['lap_notula'] = 'laporan/pengawasan/' . $lap_notula;
            }
            if ($request->hasFile('lap_survey')) {
                $file_survey = $request->file('lap_survey');
                $lap_survey = 'lap_survey_' . time() . '_' . $file_survey->getClientOriginalName();
                $file_survey->move(public_path('laporan/pengawasan'), $lap_survey);
                $update['lap_survey'] = 'laporan/pengawasan/' . $lap_survey;
            }
            if ($request->hasFile('lap_narasumber')) {
                $file_narasumber = $request->file('lap_narasumber');
                $lap_narasumber = 'lap_narasumber_' . time() . '_' . $file_narasumber->getClientOriginalName();
                $file_narasumber->move(public_path('laporan/pengawasan'), $lap_narasumber);
                $update['lap_narasumber'] = 'laporan/pengawasan/' . $lap_narasumber;
            }
            if ($request->hasFile('lap_materi')) {
                $file_materi = $request->file('lap_materi');
                $lap_materi = 'lap_materi_' . time() . '_' . $file_materi->getClientOriginalName();
                $file_materi->move(public_path('laporan/pengawasan'), $lap_materi);
                $update['lap_materi'] = 'laporan/pengawasan/' . $lap_materi;
            }
            if ($request->hasFile('lap_document')) {
                $file_document = $request->file('lap_document');
                $lap_document = 'lap_document_' . time() . '_' . $file_document->getClientOriginalName();
                $file_document->move(public_path('laporan/pengawasan'), $lap_document);
                $update['lap_document'] = 'laporan/pengawasan/' . $lap_document;
            }

            $id_pengawasan = $request->id_pengawasan;
            $UpdateData = Pengawasan::where('id', $id_pengawasan)->update($update);

            if ($UpdateData && $request->status == 14) {
                $daerah_name = RequestDaerah::GetDaerahWhereName(Auth::User()->daerah_id);

                $url = url('pengawasan/' . $id);
                $tahun = substr($request->periode_id_mdl, 0, 4);
                $semester = substr($request->periode_id_mdl, 4);
                $sub_kegiatan = ucwords($request->sub_menu_slug);

                // $pusat = User::where('username', 'pusat')->first()->email;
                // $judul = 'Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ')';
                // $kepada = 'Kementerian Investasi';
                // $subject = 'Permohonan Persetujuan/Approval Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name;
                // $pesan = 'Mohon persetujuan untuk Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' dari daerah Kab/Prov ' . $daerah_name;

                $type = 'pengawasan';
                $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Approve Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester;
                $notif = RequestNotification::fieldsData($type, $messages_desc, $url);
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

    public function delete($id)
    {
        $messages['messages'] = false;
        $_res = Pengawasan::find($id);

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
            $results = Pengawasan::where('id', (int)$key)->delete();
        }

        if ($results) {
            $messages['messages'] = true;
        }

        return response()->json($messages);
    }

    public function request_edit($id, Request $request)
    {

        $messages['messages'] = false;
        $_res = Pengawasan::find($id);

        if (empty($_res)) {

            return response()->json(['messages' => false]);
        }

        $update = RequestPengawasan::fieldReqEdit($request);
        $results = Pengawasan::where('id', $id)->update($update);

        if ($results) {
            $request->merge(['id' => $id]);
            $dataLog = RequestPengawasan::fieldLogRequest($request);
            $saveLog = AuditLogRequest::create($dataLog);

            $daerah_name = RequestDaerah::GetDaerahWhereName(Auth::User()->daerah_id);

            $url = url('pengawasan/' . $id);
            $tahun = substr($request->periode_id_mdl, 0, 4);
            $semester = substr($request->periode_id_mdl, 4);
            $sub_kegiatan = ucwords($request->sub_menu_slug);

            // $pusat = User::where('username', 'pusat')->first()->email;
            // $judul = 'Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ')';
            // $kepada = 'Kementerian Investasi';
            // $subject = 'Meminta Request Edit Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name;
            // $pesan = 'Meminta Request Edit untuk Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' dari daerah Kab/Prov ' . $daerah_name;

            $type = 'bimsos';
            $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Request Edit Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester;
            $notif = RequestNotification::fieldsData($type, $messages_desc, $url);
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
        $_res = Pengawasan::find($id);

        if (empty($_res)) {

            return response()->json(['messages' => false]);
        }

        $update = RequestPengawasan::fieldReqRevisi($request);
        $results = Pengawasan::where('id', $id)->update($update);

        if ($results) {
            $request->merge(['id' => $id]);
            $dataLog = RequestPengawasan::fieldLogRequest($request);
            $saveLog = AuditLogRequest::create($dataLog);

            $daerah_name = RequestDaerah::GetDaerahWhereName(Auth::User()->daerah_id);

            $url = url('pengawasan/' . $id);
            $tahun = substr($request->periode_id_mdl, 0, 4);
            $semester = substr($request->periode_id_mdl, 4);
            $sub_kegiatan = ucwords($request->sub_menu_slug);

            // $pusat = User::where('username', 'pusat')->first()->email;
            // $judul = 'Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ')';
            // $kepada = 'Kementerian Investasi';
            // $subject = 'Meminta Request Edit Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name;
            // $pesan = 'Meminta Request Edit untuk Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' dari daerah Kab/Prov ' . $daerah_name;

            $type = 'bimsos';
            $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Request revisi Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester;
            $notif = RequestNotification::fieldsData($type, $messages_desc, $url);
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
        $_res = Pengawasan::find($id);

        if (empty($_res)) {

            return response()->json(['messages' => false]);
        }

        $update = RequestPengawasan::fieldApprEdit($request);
        $results = Pengawasan::where('id', $id)->update($update);

        // if ($results) {
        //     $type = 'perencanaan';
        //     $messages_desc = strtoupper(Auth::User()->username) . ' Tidak Menyetujui Perencanaan Tahun ' . $_res->periode_id;
        //     $notif = RequestNotification::fieldsData($type, $messages_desc);
        //     Notification::create($notif);

        //     $messages['messages'] = true;
        // }
        return response()->json(['status' => true, 'id' => $results, 'message' => 'Update data sucessfully']);
    }
}

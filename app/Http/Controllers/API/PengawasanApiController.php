<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestPengawasan;
use App\Http\Request\RequestDaerah;
use App\Models\Pengawasan;
use App\Models\Pengawasan_perusahaan;
use App\Models\AuditLogRequest;
use App\Helpers\GeneralPaginate;
use App\Http\Request\RequestNotification;
use App\Models\Notification;
use App\Models\User;
use App\Http\Request\Validation\ValidationPengawasan;
use App\Helpers\GeneralHelpers;
use DB;
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

            if ($request->status == 14) {
                if ($request->sub_menu_slug == 'inspeksi') {
                    $validationPerusahaan = ValidationPengawasan::validationPerusahaan($request);
                    if ($validationPerusahaan) {
                        return response()->json($validationPerusahaan, 400);
                    }
                }
            }

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
                if ($request->sub_menu_slug == 'inspeksi' && isset($request->nib)) {
                    $data_perusahaan = RequestPengawasan::fieldsDataPerusahaan($request, $saveData->id);
                    Pengawasan_perusahaan::insert($data_perusahaan);
                }
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
        $result['perusahaan'] = Pengawasan_perusahaan::where(['pengawasan_id' => $id])->get();
        $result['count_perusahaan'] = Pengawasan_perusahaan::where(['pengawasan_id' => $id])->get()->count();
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

            $result = RequestPengawasan::GetNilaiPerencanaan($request);
            $sumPengawasan = RequestPengawasan::GetSumPengawasan($request);

            if ($result->total_pagu < $sumPengawasan->biaya_kegiatan && $request->status == 14) {
                $err['messages']['biaya_kegiatan'] = 'biaya kegiatan melebihi perencanaan.';
                return response()->json($err, 400);
            }
            if ($result->total_target < $sumPengawasan->jml_target && $request->status == 14) {
                $err['messages']['jml_target'] = 'Jumlah Target melebihi perencanaan.';
                return response()->json($err, 400);
            }

            $id_pengawasan = $request->id_pengawasan;
            $UpdateData = Pengawasan::where('id', $id_pengawasan)->update($update);

            if ($UpdateData && $request->status == 14) {

                if ($request->sub_menu_slug == 'inspeksi' && isset($request->nib)) {
                    Pengawasan_perusahaan::where('pengawasan_id', $id_pengawasan)->delete();
                    $data_perusahaan = RequestPengawasan::fieldsDataPerusahaan($request, $id_pengawasan);
                    Pengawasan_perusahaan::insert($data_perusahaan);
                }

                $daerah_name = RequestDaerah::GetDaerahWhereName(Auth::User()->daerah_id);

                $url = url('pengawasan/' . $id);
                $tahun = substr($request->periode_id_mdl, 0, 4);
                $semester = substr($request->periode_id_mdl, 4);
                $sub_kegiatan = ucwords($request->sub_menu_slug);

                $pusat = User::where('username', 'pusat')->first();
                // $judul = 'Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ')';
                // $kepada = 'Kementerian Investasi';
                // $subject = 'Permohonan Persetujuan/Approval Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name;
                // $pesan = 'Mohon persetujuan untuk Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' dari daerah Kab/Prov ' . $daerah_name;

                $type = 'pengawasan';
                $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Approve Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester;
                $notif = RequestNotification::fieldsData($type, $messages_desc, $url, $pusat->username);
                $insertNotif = Notification::create($notif);

                if ($insertNotif) {
                    //  Mail::to($pusat)->send(new PenyelesaianMail(Auth::User()->username, $url, $tahun, $semester, $daerah_name, $sub_kegiatan, $judul, $kepada, $subject, $pesan, 'kirim'));
                    return response()->json(['status' => true, 'id' => $id, 'message' => 'Berhasil kirim data']);
                } else {
                    return response()->json(['status' => false, 'id' => $id, 'message' => 'Gagal kirim data']);
                }
            } else if ($UpdateData) {
                if ($request->sub_menu_slug == 'inspeksi' && isset($request->nib)) {
                    Pengawasan_perusahaan::where('pengawasan_id', $id)->delete();
                    $data_perusahaan = RequestPengawasan::fieldsDataPerusahaan($request, $id);
                    Pengawasan_perusahaan::insert($data_perusahaan);
                }
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

            $pusat = User::where('username', 'pusat')->first();
            // $judul = 'Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ')';
            // $kepada = 'Kementerian Investasi';
            // $subject = 'Meminta Request Edit Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name;
            // $pesan = 'Meminta Request Edit untuk Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' dari daerah Kab/Prov ' . $daerah_name;

            $type = 'bimsos';
            $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Request Edit Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester;
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

            $pusat = User::where('username', 'pusat')->first();
            // $judul = 'Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ')';
            // $kepada = 'Kementerian Investasi';
            // $subject = 'Meminta Request Edit Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' Kab/Prop ' . $daerah_name;
            // $pesan = 'Meminta Request Edit untuk Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester . ' dari daerah Kab/Prov ' . $daerah_name;

            $type = 'bimsos';
            $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Request revisi Pengawasan Pelaksanaan Penanaman Modal (' . $sub_kegiatan . ') Tahun ' . $tahun . ' Semester ' . $semester;
            $notif = RequestNotification::fieldsData($type, $messages_desc, $url, $pusat->username);
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

    public function header(Request $request)
    {
        $searchColumn = $request->data;
        $tahunSemester = GeneralHelpers::semesterToday();
        if ($_COOKIE['access'] == 'daerah' || $_COOKIE['access'] == 'province') {
            if (!empty($request->data)) {
                $filterjs = json_decode($searchColumn);
                $data = DB::select(
                    'call header_modul(?,?,?)',
                    array('PENGAWASAN', $filterjs[0]->periode_id, Auth::User()->daerah_id)
                );
                $semester = substr($filterjs[0]->periode_id, 4);
                $tahun = substr($filterjs[0]->periode_id, 0, 4);
            } else {
                $data = DB::select(
                    'call header_modul(?,?,?)',
                    array('PENGAWASAN', $tahunSemester, Auth::User()->daerah_id)
                );
                $semester = substr($tahunSemester, 4);
                $tahun = substr($tahunSemester, 0, 4);
            }
        } else {
            $result = RequestPengawasan::GetTotalPagu($request);
            $data['total_perencanaan'] = GeneralHelpers::formatRupiah($result->total_perencanaan);
            $data['total_pengawasan'] = GeneralHelpers::formatRupiah($result->total_pengawasan);
            $data['total_pengawasan_draft'] = GeneralHelpers::formatRupiah($result->total_pengawasan_draft);
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

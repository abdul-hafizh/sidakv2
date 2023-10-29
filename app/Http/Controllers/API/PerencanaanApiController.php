<?php

namespace App\Http\Controllers\API;

use DB;
use Auth;
use File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Http\Request\Validation\ValidationPerencanaan;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestDaerah;
use App\Http\Request\RequestAuditLog;
use App\Http\Request\RequestPerencanaan;
use App\Http\Request\RequestNotification;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Models\Perencanaan;
use App\Models\Notification;
use App\Models\User;
use App\Models\AuditLog;
use App\Models\AuditLogRequest;
use App\Mail\PerencanaanMail;

class PerencanaanApiController extends Controller
{
    public function __construct()
    {   
        $this->perPage = GeneralPaginate::limit();
        $this->UploadFolder = GeneralPaginate::uploadPhotoFolder();
    }

    public function index(Request $request)
    {                
        $access = RequestAuth::Access(); 
        $year = $request->periode_id;
        //$tahunSemester = GeneralHelpers::semesterToday();

        if($access == 'daerah' ||  $access == 'province') { 
             $query = Perencanaan::where(['daerah_id'=>Auth::User()->daerah_id,'periode_id'=>$year])->orderBy('created_at', 'DESC');
        } else {
             $query = Perencanaan::where(['periode_id'=>$year])->orderBy('created_at', 'DESC');
        }

        if($request->per_page !='all')
        {
           $data = $query->paginate($request->per_page);
        } else {   
           $data = $query->get(); 
        }   
        
        $result = RequestPerencanaan::GetDataAll($data,$request->per_page,$request);    
        return response()->json($result);        
    }

    public function export(Request $request)
    {
        $access = RequestAuth::Access();
        $userDaerahId = Auth::user()->daerah_id;

        $query = Perencanaan::rightJoin('vw_wilayah_union as wilayah', 'perencanaan.daerah_id', '=', 'wilayah.id')
            ->select('perencanaan.*', 'wilayah.name as wilayah')
            ->orderBy('wilayah.id', 'ASC');

        if ($access == 'daerah' || $access == 'province') {
            $query->where('perencanaan.daerah_id', $userDaerahId);
        }

        $data = $query->get();

        $result = RequestPerencanaan::GetDataAllExport($data, $request);
        return response()->json($result);
    }

    public function edit($id)
    { 
        $data = Perencanaan::leftJoin('pagu_target', function($join) {
            $join->on('perencanaan.periode_id', '=', 'pagu_target.periode_id')
                 ->on('perencanaan.daerah_id', '=', 'pagu_target.daerah_id');
        })
        ->select('perencanaan.*', 'pagu_target.pagu_apbn', 'pagu_target.pagu_promosi', 'pagu_target.target_pengawasan', 'pagu_target.target_penyelesaian_permasalahan', 'pagu_target.target_bimbingan_teknis', 'pagu_target.target_video_promosi', 'pagu_target.pagu_dalak')
        ->where('perencanaan.id', $id)
        ->first();        

        $result = RequestPerencanaan::GetDetailID($data); 
        return response()->json($result);
    }
    
    public function search(Request $request)
    {
        $access = RequestAuth::Access(); 
        $daerah_id = $request->daerah_id;
        $periode_id = $request->periode_id;
        $search_status = $request->search_status;
        $search_text = $request->search_text;

        if($access == 'daerah' || $access == 'province') { 
            $query  = Perencanaan::where('daerah_id', Auth::user()->daerah_id)->orderBy('id', 'DESC');
        } else {
            $query  = Perencanaan::orderBy('id', 'DESC');
        }

        if($daerah_id) {
            $query->where(function ($q) use ($daerah_id) {
                $q->where('daerah_id', $daerah_id);
            });
        }

        if($periode_id) {
            $query->where(function ($q) use ($periode_id) {
                $q->where('periode_id', 'LIKE', '%' . $periode_id . '%');
            });
        }

        if ($search_text) {
            $query->where(function ($q) use ($search_text) {
                $q->where('pengawas_analisa_pagu', 'like', "%$search_text%")
                  ->orWhere('pengawas_inspeksi_pagu', 'like', "%$search_text%")
                  ->orWhere('pengawas_evaluasi_pagu', 'like', "%$search_text%")
                  ->orWhere('bimtek_perizinan_pagu', 'like', "%$search_text%")
                  ->orWhere('bimtek_pengawasan_pagu', 'like', "%$search_text%")
                  ->orWhere('penyelesaian_identifikasi_pagu', 'like', "%$search_text%")
                  ->orWhere('penyelesaian_realisasi_pagu', 'like', "%$search_text%")
                  ->orWhere('penyelesaian_evaluasi_pagu', 'like', "%$search_text%")
                  ->orWhere('promosi_pengadaan_pagu', 'like', "%$search_text%")
                  ->orWhere('lokasi', 'like', "%$search_text%");
            });
        }             

        if($search_status) {
            $query->where(function ($q) use ($search_status) {
                switch ($search_status) {
                    case 1:
                        $q->where('status', 13)->WhereIn('request_edit', ['false', 'true', 'revisi', 'reject', 'reject_doc']);
                        break;
                    case 2:
                        $q->where('status', 15)->where('request_edit', 'request_doc');
                        break;
                    case 3:
                        $q->where('status', 15)->where('request_edit', 'true');
                        break;
                    case 4:
                        $q->where('status', 15)->where('request_edit', 'false');
                        break;
                    case 5:
                        $q->where('status', 16)->where('request_edit', 'false');
                        break;
                    case 6:
                        $q->where('status', 13)->WhereIn('request_edit', ['reject', 'reject_doc']);
                        break;
                }
            });
        }           
    
        $data = $query->paginate($this->perPage);        
        $result = RequestPerencanaan::GetDataAll($data, $this->perPage, $request);

        return response()->json($result);
    }
       
    public function store(Request $request){           
            
        DB::beginTransaction(); 
    
        try {
            $validation = ValidationPerencanaan::validation($request);
    
            if($validation)
            {            
                DB::rollBack();
                return response()->json($validation, 400);  
            } else {

                $existingData = Perencanaan::where('periode_id', $request->periode_id)
                ->where('daerah_id', Auth::User()->daerah_id)
                ->first();

                if ($existingData) {
                    DB::rollBack();
                    return response()->json(['status' => false, 'message' => 'Perencanaan sudah ada pada periode ini.']);
                }
            
                $insert = RequestPerencanaan::fieldsData($request);  
                $saveData = Perencanaan::create($insert);
    
                if($saveData && $request->type == 'kirim')
                {                    
                    $daerah_name = RequestDaerah::GetDaerahWhereName(Auth::User()->daerah_id);
    
                    $url = url('perencanaan/detail/' . $saveData->id);
                    $pusat = User::where('username','pusat')->first();
                    $judul = 'Perencanaan DAK';
                    $kepada = 'Kementerian Investasi';
                    $subject = 'Permohonan Persetujuan/Approval Perencanaan DAK Tahun ' . $request->periode_id . ' Kab/Prop ' . $daerah_name;
                    $pesan = 'Mohon persetujuan untuk perencanaan DAK Tahun ' . $request->periode_id . ' dari daerah Kab/Prov ' . $daerah_name;
    
                    $type = 'perencanaan';
                    $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Approve Perencanaan Tahun ' . $request->periode_id;
                    $notif = RequestNotification::fieldsData($type, $messages_desc, $url,$pusat->username);
                    $insertNotif = Notification::create($notif);
    
                    if ($insertNotif) {
                        DB::commit();
                        Mail::to($pusat->email)->send(new PerencanaanMail(Auth::User()->username, $url, $request->periode_id, $daerah_name, $judul, $kepada, $subject, $pesan, 'kirim'));
                        return response()->json(['status' => true, 'id' => $saveData, 'message' => 'Input data berhasil']);
                    } else {
                        DB::rollBack(); 
                        return response()->json(['status' => false, 'message' => 'Gagal menyimpan notifikasi']);
                    }
                } else {
                    DB::rollBack();
                    return response()->json(['status' => false, 'message' => 'Gagal menyimpan data Perencanaan']);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack(); 
            return response()->json(['status' => false, 'message' => 'Terjadi kesalahan dalam menyimpan data']);
        }
    }    

    public function update($id, Request $request){

        DB::beginTransaction(); 
     
        try {
            $validation = ValidationPerencanaan::validationUpdate($request,$id);

            if($validation)
            {
            
                return response()->json($validation, 400);  
                
            } else {            

                $update = RequestPerencanaan::fieldsData($request);
                $UpdateData = Perencanaan::where('id',$id)->update($update);

                if ($UpdateData) {
                    if ($request->type == 'kirim') {
                        $daerah_name = RequestDaerah::GetDaerahWhereName(Auth::User()->daerah_id);
        
                        $url = url('perencanaan/detail/' . $id);
                        $pusat = User::where('username','pusat')->first();
                        $judul = 'Permohonan Persetujuan/Approval Perencanaan DAK';
                        $kepada = 'Kementerian Investasi';
                        $subject = 'Permohonan Persetujuan/Approval Perencanaan DAK Tahun ' . $request->periode_id . ' Kab/Prop ' . $daerah_name;
                        $pesan = 'Mohon persetujuan untuk perencanaan DAK Tahun ' . $request->periode_id . ' dari daerah Kab/Prov ' . $daerah_name;    
        
                        $type = 'perencanaan';
                        $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Approve Perencanaan Tahun ' . $request->periode_id;
                        $notif = RequestNotification::fieldsData($type, $messages_desc, $url,$pusat->username);
                        $insertNotif = Notification::create($notif);
        
                        if ($insertNotif) {
                            DB::commit();
                            Mail::to($pusat->email)->send(new PerencanaanMail(Auth::User()->username, $url, $request->periode_id, $daerah_name, $judul, $kepada, $subject, $pesan, 'kirim'));
                            return response()->json(['status'=>true,'id'=>$UpdateData,'message'=>'Update data sucessfully']);
                        } else {
                            DB::rollBack(); 
                            return response()->json(['status' => false, 'message' => 'Gagal menyimpan notifikasi']);
                        }
                    } else {
                        DB::commit();
                        return response()->json(['status'=>true,'id'=>$UpdateData,'message'=>'Update data sucessfully']);
                    }
                    
                } else {
                    DB::rollBack(); 
                    return response()->json(['status' => false, 'message' => 'Gagal update data.']);
                }
                
            }   
        } catch (\Exception $e) {
            DB::rollBack(); 
            return response()->json(['status' => false, 'message' => 'Terjadi kesalahan dalam update data']);
        }
    }

    public function request_doc($id){

        $messages['messages'] = false;
        $_res = Perencanaan::find($id);
          
        if(empty($_res)){
            
            return response()->json(['messages' => false]);

        }

        $results = $_res->where('id', $id)->update([ 'status' => 15, 'request_edit' => 'request_doc']);

        if($results){
            
            $type = 'perencanaan';
            $url = 'perencanaan/detail/' . $id;
            $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Dokumen Perencanaan Tahun ' . $_res->periode_id;
            $notif = RequestNotification::fieldsData($type,$messages_desc,$url,$_res->created_by);
            Notification::create($notif);
            
            $messages['messages'] = true;
        }
        
        return response()->json($messages);

    }

    public function upload_laporan($id, Request $request)
    {                
        $validation = ValidationPerencanaan::validationUploadFile($request, $id);

        $_res = Perencanaan::find($id);
          
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }        

        if($validation)
        {
            return response()->json($validation, 400);

        } else {
                          
            $source = explode(";base64,", $request->lap_rencana);
            $fileDir = '/file/perencanaan/';
            $image = base64_decode($source[1]);
            $filePath = public_path() . $fileDir;
            $filepdf = time() .'.pdf';
            $success = file_put_contents($filePath.$filepdf, $image);

            $daerah_name = RequestDaerah::GetDaerahWhereID($_res->daerah_id);

            $url = url('perencanaan/detail/' . $id);
            $pusat = User::where('username','pusat')->first();
            $judul = 'Perencanaan DAK';
            $kepada = 'Kementerian Investasi';
            $subject = 'Permohonan Persetujuan/Approval Dokumen Perencanaan Perencanaan Tahun ' . $_res->periode_id . ' Kab/Prop ' . $daerah_name;
            $pesan = 'Mohon persetujuan untuk dokumen perencanaan Perencanaan Tahun ' . $_res->periode_id . ' dari daerah Kab/Prov ' . $daerah_name;  
            
            $check = Perencanaan::where('id', $request->id_perencanaan)->first();
            if($check)
            { 
                File::delete(public_path() . $fileDir . $check->lap_rencana);
            } 
            
             $log = array(
                'category' => 'LOG_DATA_UPLOAD_DOCUMENT',
                'group_menu' => 'upload_data_dokumen',
                'description' => '<b>' . $_res->created_by . '</b> mengunggah dokumen Perencanaan Tahun ' .$_res->periode_id,
             );
             $datalog = RequestAuditLog::fieldsData($log);

            $type = 'perencanaan';
            
            $messages_desc = strtoupper(Auth::User()->username) . ' mengunggah Dokumen Perencanaan Tahun '. $_res->periode_id;
            $notif = RequestNotification::fieldsData($type,$messages_desc,$url,$_res->created_by);
            Notification::create($notif);
            


            $results = $_res->where('id', $id)->update([ 'lap_rencana' => $filepdf, 'status' => 14, 'request_edit' => 'false']);
            
            Mail::to($pusat->email)->send(new PerencanaanMail(Auth::User()->username, $url, $_res->periode_id, $daerah_name, $judul, $kepada, $subject, $pesan, 'upload_doc'));

            return response()->json(['status' => true, 'messages' => 'Update data sucessfully']);
        }  
    }

    public function approve($id){

        $messages['messages'] = false;
        $_res = Perencanaan::find($id);
          
        if(empty($_res)){
            
            return response()->json(['messages' => false]);

        }

        $results = $_res->where('id', $id)->update([ 'status' => 16, 'request_edit' => 'false']);

        if($results){

            $log = array(
                'category' => 'LOG_DATA_APPROVED_DOCUMENT',
                'group_menu' => 'approve_data_dokumen',
                'description' => '<b>' . Auth::User()->username . '</b> Menyetujui Perencanaan Tahun ' .$_res->periode_id,
             );
             $datalog = RequestAuditLog::fieldsData($log);


            $type = 'perencanaan';
            $url = 'perencanaan/detail/' . $id;
            $messages_desc = strtoupper(Auth::User()->username) . ' Menyetujui Perencanaan Tahun ' . $_res->periode_id;
            $notif = RequestNotification::fieldsData($type,$messages_desc,$url,$_res->created_by);
            Notification::create($notif);

            $messages['messages'] = true;
        }
        
        return response()->json($messages);

    }

    public function approve_edit($id){

        $messages['messages'] = false;
        $_res = Perencanaan::find($id);
          
        if(empty($_res)){
            
            return response()->json(['messages' => false]);

        }

        $results = $_res->where('id', $id)->update([ 'status' => 13, 'request_edit' => 'true']);

        if($results){

             $log = array(
                'category' => 'LOG_DATA_APPROVED_DOCUMENT',
                'group_menu' => 'approve_data_dokumen',
                'description' => '<b>' . Auth::User()->username . '</b> Menyetujui Request Edit Perencanaan Tahun ' .$_res->periode_id,
             );
             $datalog = RequestAuditLog::fieldsData($log);

            $type = 'perencanaan';
            $url = 'perencanaan/detail/' . $id;
            $messages_desc = strtoupper(Auth::User()->username) . ' Menyetujui Request Edit Perencanaan Tahun ' . $_res->periode_id;
            $notif = RequestNotification::fieldsData($type,$messages_desc,$url,$_res->created_by);
            Notification::create($notif);

            $messages['messages'] = true;
        }
        
        return response()->json($messages);

    }

    public function unapprove($id, Request $request){

        $messages['messages'] = false;
        $_res = Perencanaan::find($id);
          
        if(empty($_res)){
            
            return response()->json(['messages' => false]);

        }

        $update = RequestPerencanaan::fieldAlasan($request);
        $results = Perencanaan::where('id', $id)->update($update);

        if($results){

            $log = array(
                'category' => 'LOG_DATA_UNAPPROVED',
                'group_menu' => 'unapprove_data',
                'description' => '<b>' . Auth::User()->username . '</b> Tidak Menyetujui Perencanaan Tahun ' .$_res->periode_id,
             );
             $datalog = RequestAuditLog::fieldsData($log);


            $type = 'perencanaan';
            $url = 'perencanaan/detail/' . $id;
            $messages_desc = strtoupper(Auth::User()->username) . ' Tidak Menyetujui Perencanaan Tahun ' . $_res->periode_id;
            $notif = RequestNotification::fieldsData($type,$messages_desc,$url,$_res->created_by);
            Notification::create($notif);

            $request->merge(['id' => $id]);
            $dataLog = RequestPerencanaan::fieldLogRequest($request);
            $saveLog = AuditLogRequest::create($dataLog);

            $messages['messages'] = true;
        }
        
        return response()->json($messages);

    }

    public function unapprove_doc($id, Request $request){

        $messages['messages'] = false;
        $_res = Perencanaan::find($id);
          
        if(empty($_res)){
            
            return response()->json(['messages' => false]);

        }

        $update = RequestPerencanaan::fieldAlasanDoc($request);
        $results = Perencanaan::where('id', $id)->update($update);

        if($results){

             $log = array(
                'category' => 'LOG_DATA_APPROVED_DOCUMENT',
                'group_menu' => 'approve_data_dokumen',
                'description' => '<b>' . Auth::User()->username . '</b> Tidak Menyetujui DAK Tahun ' .$_res->periode_id,
             );
             $datalog = RequestAuditLog::fieldsData($log);

            $type = 'perencanaan';
            $url = 'perencanaan/detail/' . $id;
            $messages_desc = strtoupper(Auth::User()->username) . ' Tidak Menyetujui Dokumen Perencanaan Tahun ' . $_res->periode_id;
            $notif = RequestNotification::fieldsData($type,$messages_desc,$url,$_res->created_by);
            Notification::create($notif);

            $request->merge(['id' => $id]);
            $dataLog = RequestPerencanaan::fieldLogRequest($request);
            $saveLog = AuditLogRequest::create($dataLog);

            $messages['messages'] = true;
        }
        
        return response()->json($messages);

    }

    public function reqedit($id, Request $request){

        $messages['messages'] = false;
        $_res = Perencanaan::find($id);
          
        if(empty($_res)){
            
            return response()->json(['messages' => false]);

        }

        $update = RequestPerencanaan::fieldReqedit($request);
        $results = Perencanaan::where('id', $id)->update($update);

        if($results){

             $log = array(
                'category' => 'LOG_DATA_REQUEST_EDIT',
                'group_menu' => 'request_edit',
                'description' => '<b>' . Auth::User()->username . '</b> Request Edit Perencanaan Tahun ' .$_res->periode_id,
             );
             $datalog = RequestAuditLog::fieldsData($log);

            $type = 'perencanaan';
            $pusat = User::where('username','pusat')->first();
            $url = url('perencanaan/detail/' . $id);
            $messages_desc = strtoupper(Auth::User()->username) . ' Request Edit Perencanaan Tahun ' . $_res->periode_id;
            $notif = RequestNotification::fieldsData($type,$messages_desc,$url,$pusat->username);
            Notification::create($notif);

            $request->merge(['id' => $id]);
            $dataLog = RequestPerencanaan::fieldLogRequest($request);
            $saveLog = AuditLogRequest::create($dataLog);

            $daerah_name = RequestDaerah::GetDaerahWhereID($_res->daerah_id);

            
            $judul = 'Perencanaan DAK';
            $kepada = 'Kementerian Investasi';
            $subject = 'Permohonan Persetujuan Request edit Perencanaan Perencanaan Tahun ' . $_res->periode_id . ' Kab/Prop ' . $daerah_name;
            $pesan = 'Mohon persetujuan untuk Request edit Perencanaan Perencanaan Tahun ' . $_res->periode_id . ' Kab/Prop ' . $daerah_name . ', dengan alasan ' . $request->alasan;

            Mail::to($pusat->email)->send(new PerencanaanMail(Auth::User()->username, $url, $_res->periode_id, $daerah_name, $judul, $kepada, $subject, $pesan, 'request_edit'));

            $messages['messages'] = true;
        }
        
        return response()->json($messages);

    }

    public function reqrevisi($id, Request $request){

        $messages['messages'] = false;
        $_res = Perencanaan::find($id);
          
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }

        $update = RequestPerencanaan::fieldReqrevisi($request);
        $results = Perencanaan::where('id', $id)->update($update);

        if($results){

             $log = array(
                'category' => 'LOG_DATA_REQUEST_REVISI',
                'group_menu' => 'request_revisi',
                'description' => '<b>' . Auth::User()->username . '</b> Meminta Perbaikan Pada Perencanaan Tahun ' .$_res->periode_id,
             );
             $datalog = RequestAuditLog::fieldsData($log);

            $type = 'perencanaan';
            $url = url('perencanaan/detail/' . $id);
            $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Perbaikan Pada Perencanaan Tahun ' . $_res->periode_id;
            $notif = RequestNotification::fieldsData($type,$messages_desc,$url,$_res->created_by);
            Notification::create($notif);

            $request->merge(['id' => $id]);
            $dataLog = RequestPerencanaan::fieldLogRequest($request);
            $saveLog = AuditLogRequest::create($dataLog);

            $daerah_name = RequestDaerah::GetDaerahWhereName($_res->daerah_id);

            $email_daerah = User::where('username', $_res->created_by)->first()->email;
            $judul = 'Perencanaan DAK';
            $kepada = 'Pemerintah Daerah ' . $daerah_name;
            $subject = 'Permohonan Perbaikan Perencanaan DAK Tahun ' . $_res->periode_id . ' Kab/Prop ' . $daerah_name;
            $pesan = 'Mohon untuk memperbaiki Perencanaan DAK Tahun ' . $_res->periode_id . ' Kab/Prop ' . $daerah_name . ', dengan alasan ' . $request->alasan;

            Mail::to('abdulha05518@gmail.com')->send(new PerencanaanMail(Auth::User()->username, $url, $_res->periode_id, $daerah_name, $judul, $kepada, $subject, $pesan, 'revisi'));

            $messages['messages'] = true;
        }
        
        return response()->json($messages);

    }

    public function approveSelected(Request $request){        
        $results = false;
        $messages['messages'] = false;
                
        foreach($request->data as $key)
        {                        
            $_res = Perencanaan::find($key);

            if($_res->status == 15 && $_res->request_edit == 'false') {
                $updateResult = $_res->where('id', $key)->update([ 'status' => 15, 'request_edit' => 'request_doc']);
                if($updateResult) {

                    $log = array(
                        'category' => 'LOG_DATA_APPROVED',
                        'group_menu' => 'approve_data',
                        'description' => '<b>' . Auth::User()->username . '</b>  Menyetujui Formulir Perencanaan Tahun ' .$_res->periode_id,
                     );
                     $datalog = RequestAuditLog::fieldsData($log);

                    $type = 'perencanaan';
                    $url = 'perencanaan/detail/' . $_res->id;
                    $messages_desc = strtoupper(Auth::User()->username) . ' Menyetujui Formulir Perencanaan Tahun ' . $_res->periode_id;
                    $notif = RequestNotification::fieldsData($type,$messages_desc,$url,Auth::User()->username);
                    Notification::create($notif);
                }
            } elseif ($_res->status == 14 && $_res->request_edit == 'false') {
                $updateResult = $_res->where('id', $key)->update([ 'status' => 16, 'request_edit' => 'false']);
                if($updateResult) {

                    $log = array(
                        'category' => 'LOG_DATA_APPROVED',
                        'group_menu' => 'approve_data',
                        'description' => '<b>' . Auth::User()->username . '</b>  Menyetujui Perencanaan Tahun ' .$_res->periode_id,
                     );
                     $datalog = RequestAuditLog::fieldsData($log);

                    $type = 'perencanaan';
                    $url = 'perencanaan/detail/' . $_res->id;
                    $messages_desc = strtoupper(Auth::User()->username) . ' Menyetujui Perencanaan Tahun ' . $_res->periode_id;

                    $notif = RequestNotification::fieldsData($type,$messages_desc,$url,Auth::User()->username);
                    Notification::create($notif);
                }
            } elseif ($_res->status == 15 && $_res->request_edit == 'true') {
                $updateResult = $_res->where('id', $key)->update([ 'status' => 13, 'request_edit' => 'true']);
                if($updateResult) {

                      $log = array(
                        'category' => 'LOG_DATA_REQUEST_EDIT',
                        'group_menu' => 'request_edit',
                        'description' => '<b>' . Auth::User()->username . '</b> Menyetujui Request Edit Perencanaan Tahun ' .$_res->periode_id,
                     );
                     $datalog = RequestAuditLog::fieldsData($log);


                    $type = 'perencanaan';
                    $url = 'perencanaan/detail/' . $_res->id;
                    $messages_desc = strtoupper(Auth::User()->username) . ' Menyetujui Request Edit Perencanaan Tahun ' . $_res->periode_id;
                    $notif = RequestNotification::fieldsData($type,$messages_desc,$url,Auth::User()->username);
                    Notification::create($notif);
                }
            } else {
                $results = false;
            }

            if ($updateResult) {             
                $results = true;
            }
        }

        if($results){
            $messages['messages'] = true;
        }

        return response()->json($messages);
    }
    
    public function log($id)
    {        
        $result = Perencanaan::leftJoin('audit_log_request as log', 'perencanaan.id', '=', 'log.kegiatan_id')
            ->select('log.*')
            ->where('perencanaan.id', $id)
            ->orderBy('log.id', 'desc')
            ->get();

        return response()->json($result);
    }

    public function deleteSelected(Request $request){
        $messages['messages'] = false;

        foreach($request->data as $key)
        {
            $results = Perencanaan::where('id',(int)$key)->delete();
        }

        if($results){
            $messages['messages'] = true;
        }

        return response()->json($messages);
    }    

    public function delete($id){

        $messages['messages'] = false;
        $_res = Perencanaan::find($id);
          
        if(empty($_res)){
            
            return response()->json(['messages' => false]);

        } else {

            if(file_exists($this->UploadFolder.$_res['lap_rencana'])) {
                File::delete($this->UploadFolder.$_res['lap_rencana']);
            } 
        }

        $results = $_res->delete();

        if($results){
            $messages['messages'] = true;
        }
        
        return response()->json($messages);
    }    
}    
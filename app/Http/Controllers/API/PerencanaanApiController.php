<?php

namespace App\Http\Controllers\API;

use DB;
use Auth;
use File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Request\Validation\ValidationPerencanaan;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestAuditLog;
use App\Http\Request\RequestPerencanaan;
use App\Http\Request\RequestNotification;
use App\Helpers\GeneralPaginate;
use App\Models\Perencanaan;
use App\Models\Notification;
use App\Models\AuditLog;

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
        if($access == 'daerah' ||  $access == 'province') { 
             $query = Perencanaan::where('daerah_id',Auth::User()->daerah_id)->orderBy('created_at', 'DESC');
        } else {
             $query = Perencanaan::orderBy('created_at', 'DESC');
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
        $search = $request->search;
        $column_search  = array('periode_id');
        $_res = array();
        $i = 0;

        if($access == 'daerah' ||  $access == 'province') { 
            $query  = Perencanaan::where('daerah_id',Auth::User()->daerah_id)->orderBy('id','DESC');

        } else {
            $query  = Perencanaan::orderBy('id','DESC');
        }

        foreach ($column_search as $item)
        {
            if ($search) 
            {                
                if ($i === 0) {   
                   $query->where($item,'LIKE','%'.$search.'%');
                } else {
                   $query->orWhere($item,'LIKE','%'.$search.'%');
                }   
            }

            $i++;
        }
       
        $data = $query->paginate($this->perPage);
        $description = $search;        
        $result = RequestPerencanaan::GetDataAll($data,$this->perPage,$request);

        return response()->json($result);

    }
       
    public function store(Request $request){

        $validation = ValidationPerencanaan::validation($request);

        if($validation)
        {
          
            return response()->json($validation, 400);  

        } else {
            
            $insert = RequestPerencanaan::fieldsData($request);  
            $saveData = Perencanaan::create($insert);

            if($saveData && $request->type == 'kirim')
            {
                $type = 'perencanaan';
                $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Approve Perencanaan Tahun ' . $request->periode_id;
                $notif = RequestNotification::fieldsData($type,$messages_desc);
                Notification::create($notif);
            }  

            return response()->json(['status' => true, 'id' => $saveData, 'message' => 'Input data berhasil']);    
            
        } 
    }

    public function update($id, Request $request){
     
        $validation = ValidationPerencanaan::validationUpdate($request,$id);

        if($validation)
        {
        
            return response()->json($validation, 400);  
            
        } else {            

            $update = RequestPerencanaan::fieldsData($request);            
            $UpdateData = Perencanaan::where('id',$id)->update($update);
            
            return response()->json(['status'=>true,'id'=>$UpdateData,'message'=>'Update data sucessfully']);            
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
            $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Dokumen Perencanaan Tahun ' . $_res->periode_id;
            $notif = RequestNotification::fieldsData($type,$messages_desc);
            Notification::create($notif);
            
            $messages['messages'] = true;
        }
        
        return response()->json($messages);

    }

    public function approve($id){

        $messages['messages'] = false;
        $_res = Perencanaan::find($id);
          
        if(empty($_res)){
            
            return response()->json(['messages' => false]);

        }

        $results = $_res->where('id', $id)->update([ 'status' => 16, 'request_edit' => 'false']);

        if($results){
            $type = 'perencanaan';
            $messages_desc = strtoupper(Auth::User()->username) . ' Menyetujui Perencanaan Tahun ' . $_res->periode_id;
            $notif = RequestNotification::fieldsData($type,$messages_desc);
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
            $type = 'perencanaan';
            $messages_desc = strtoupper(Auth::User()->username) . ' Menyetujui Request Edit Perencanaan Tahun ' . $_res->periode_id;
            $notif = RequestNotification::fieldsData($type,$messages_desc);
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
            $type = 'perencanaan';
            $messages_desc = strtoupper(Auth::User()->username) . ' Tidak Menyetujui Perencanaan Tahun ' . $_res->periode_id;
            $notif = RequestNotification::fieldsData($type,$messages_desc);
            Notification::create($notif);

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
            $type = 'perencanaan';
            $messages_desc = strtoupper(Auth::User()->username) . ' Tidak Menyetujui Dokumen Perencanaan Tahun ' . $_res->periode_id;
            $notif = RequestNotification::fieldsData($type,$messages_desc);
            Notification::create($notif);

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
            $type = 'perencanaan';
            $messages_desc = strtoupper(Auth::User()->username) . ' Request Edit Perencanaan Tahun ' . $_res->periode_id;
            $notif = RequestNotification::fieldsData($type,$messages_desc);
            Notification::create($notif);

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
            $type = 'perencanaan';
            $messages_desc = strtoupper(Auth::User()->username) . ' Meminta Perbaikan Pada Perencanaan Tahun ' . $_res->periode_id;
            $notif = RequestNotification::fieldsData($type,$messages_desc);
            Notification::create($notif);

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
                    $type = 'perencanaan';
                    $messages_desc = strtoupper(Auth::User()->username) . ' Menyetujui Formulir Perencanaan Tahun ' . $_res->periode_id;
                    $notif = RequestNotification::fieldsData($type,$messages_desc);
                    Notification::create($notif);
                }
            } elseif ($_res->status == 14 && $_res->request_edit == 'false') {
                $updateResult = $_res->where('id', $key)->update([ 'status' => 16, 'request_edit' => 'false']);
                if($updateResult) {
                    $type = 'perencanaan';
                    $messages_desc = strtoupper(Auth::User()->username) . ' Menyetujui Perencanaan Tahun ' . $_res->periode_id;
                    $notif = RequestNotification::fieldsData($type,$messages_desc);
                    Notification::create($notif);
                }
            } elseif ($_res->status == 15 && $_res->request_edit == 'true') {
                $updateResult = $_res->where('id', $key)->update([ 'status' => 13, 'request_edit' => 'true']);
                if($updateResult) {
                    $type = 'perencanaan';
                    $messages_desc = strtoupper(Auth::User()->username) . ' Menyetujui Request Edit Perencanaan Tahun ' . $_res->periode_id;
                    $notif = RequestNotification::fieldsData($type,$messages_desc);
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
            
            $check = Perencanaan::where('id', $request->id_perencanaan)->first();
            if($check)
            { 
                File::delete(public_path() . $fileDir . $check->lap_rencana);
            } 
            
            //Audit Log
            $json = json_encode(['lap_rencana' => $filepdf, 'status' => 14, 'request_edit' => 'false']);
            $log = array(             
                'action'=> 'Update Perencanaan',
                'slug'=>'update-perencanaan',
                'type'=>'put',
                'json_field'=> $json,
                'url'=>'api/perencanaan/'.$id
            );
            $datalog =  RequestAuditLog::fieldsData($log);

            //update data
            $results = $_res->where('id', $id)->update([ 'lap_rencana' => $filepdf, 'status' => 14, 'request_edit' => 'false']);

            //result
            return response()->json(['status' => true, 'messages' => 'Update data sucessfully']);            
        }  
    }
}    
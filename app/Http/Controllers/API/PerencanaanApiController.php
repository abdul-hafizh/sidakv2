<?php

namespace App\Http\Controllers\API;

use Auth;
use File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Request\Validation\ValidationPerencanaan;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestPerencanaan;
use App\Helpers\GeneralPaginate;
use App\Models\Perencanaan;
use App\Models\PaguTarget;

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
        $search = $request->search;
        $_res = array();
        $column_search  = array('periode_id');

        $i = 0;
        $query  = Perencanaan::where('daerah_id',Auth::User()->daerah_id)->orderBy('id','DESC');

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

            return response()->json(['status' => true, 'id' => $saveData, 'message' => 'Input data berhasil']);    
            
        } 
    }

    public function update($id, Request $request){
     
        $validation = ValidationPerencanaan::validation($request);

        if($validation)
        {
        
            return response()->json($validation, 400);  
            
        } else {            

            $update = RequestPerencanaan::fieldsData($request);            
            $UpdateData = Perencanaan::where('id',$id)->update($update);
            
            return response()->json(['status'=>true,'id'=>$UpdateData,'message'=>'Update data sucessfully']);            
        }   
    }

    public function approve($id){

        $messages['messages'] = false;
        $_res = Perencanaan::find($id);
          
        if(empty($_res)){
            
            return response()->json(['messages' => false]);

        }

        $results = $_res->where('id', $id)->update([ 'status' => 15, 'request_edit' => 'request_doc']);

        if($results){
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

    public function upload_laporan(Request $request)
    {        
        $this->validate($request, [
            'file' => 'required|mimes:pdf'
        ]);

        $path = $request->file('lap_rencana')->store('temp');

        return response()->json(['status' => true, 'id' => 1, 'message' => 'Perencanaan Berhasil Diupload!']);
    }

    public function download_file(Request $request)
    {
        $myFile = public_path("/perencanaan/test.pdf");

        return response()->download($myFile);
    }
}    
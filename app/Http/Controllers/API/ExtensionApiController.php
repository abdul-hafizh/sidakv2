<?php

namespace App\Http\Controllers\API;

use DB;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Extension;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestExtension;
use App\Http\Request\Validation\ValidationExtension;
use App\Http\Request\RequestAuditLog;
use App\Helpers\GeneralHelpers;
use App\Helpers\GeneralPaginate;
use App\Models\Provinces;
use App\Models\Regencies;
use App\Models\Notification;
use App\Http\Request\RequestDaerah;
use App\Http\Request\RequestNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\PeriodeApproved;
use App\Mail\PeriodeExtension;
use App\Models\User;

class ExtensionApiController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {

        $access = RequestAuth::Access(); 
        $tahunSemester = GeneralHelpers::semesterToday();

        if($access == 'daerah' ||  $access == 'province') { 
             $query = Extension::where('daerah_id',Auth::User()->daerah_id)->orderBy('created_at', 'DESC');
        } else {
             $query = Extension::orderBy('created_at', 'DESC');
        }

       
        if ($request->per_page != 'all') {
            $data = $query->paginate($request->per_page);
        } else {
            $data = $query->get();
        }

        $result = RequestExtension::GetDataAll($data, $request->per_page, $request);
        return response()->json($result);
    }

    
    public function search(Request $request)
    {
        $search = $request->search;
        $search_daerah = $request->daerah_id;
        $_res = array();
        $column_search  = array('extensiondate');

        //$province = Provinces::select('id')->where('id',$search_daerah);
      //  $daerah_id = Regencies::select('id')->where('province_id',$search_daerah)->get();
         $query  = Extension::orderBy('id', 'DESC');
        if($search == '')
        {
          $query->where('daerah_id',$search_daerah);
        }else{

            $i = 0;
           
            foreach ($column_search as $item) {
                if ($search) {
                    if ($i === 0) {
                        $query->where($item, 'LIKE', '%' . $search . '%');
                    } else {
                        $query->orWhere($item, 'LIKE', '%' . $search . '%');
                    }
                }
                $i++;
            }
        }     

        $data = $query->paginate($request->per_page);
        $description = $search;

        $_res = RequestExtension::GetDataAll($data, $request->per_page, $request, $description);
        return response()->json($_res);
    }

    

    public function store(Request $request)
    {
        $validation = ValidationExtension::validationInsert($request);
        if ($validation) {
            return response()->json($validation, 400);
        } else {
           
           if($request->expireddate > $request->extensiondate || $request->expireddate == $request->extensiondate)
            {

                $err['messages']['extensiondate'] = 'Tanggal pengajuan maksimal lebih dari tanggal masa berahir '.$request->expireddate;
            
                return response()->json($err, 400);

            }else{ 
            
                $insert = RequestExtension::fieldsData($request); 
                $log = array(
                    'category' => 'LOG_DATA_PERIODE_EXTENSION',
                    'group_menu' => 'upload_data_periode',
                    'description' => 'Menambahkan data pengajuan periode <b> ' . $request->extensiondate . '</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);
                //create menu
                $saveData = Extension::create($insert);
                 if($request->status =='Y')
                 {   
                    $access = RequestAuth::Access();
                      //send notif
                    if($access !="admin" || $access !="pusat")
                    {
                         $type = 'periode';
                         $messages = Auth::User()->username.' Permohonan Persetujuan/Approval sampai tanggal '.$request->extensiondate;
                         $url = url('extension/show/'.$saveData->id);
                         $notif = RequestNotification::fieldsData($type,$messages,$url);
                         Notification::create($notif);
                         $datafrom = User::where('username','pusat')->first();

                         $description = $request->description;
                         $daerah_name = RequestDaerah::GetDaerahWhereName(Auth::User()->daerah_id);
                         $pusat = User::where('username','pusat')->first()->email;
                         Mail::to($pusat)->send(new PeriodeExtension(Auth::User()->username,$url,$request->year,$request->semester,$description, $daerah_name));
                      

                    }
                 }
                //result
                return response()->json(['status' => true, 'id' => $saveData, 'message' => 'Insert data sucessfully']);
            }    
            
        }
    }

    public function update($id, Request $request)
    {
        $validation = ValidationExtension::validationUpdate($request, $id);
        if ($validation) {
            return response()->json($validation, 400);
        } else {

            if($request->expireddate > $request->extensiondate || $request->expireddate == $request->extensiondate)
            {

                $err['messages']['extensiondate'] = 'Tanggal pengajuan maksimal lebih dari tanggal masa berahir '.$request->expireddate;
                return response()->json($err, 400);

            }else{ 



                $update = RequestExtension::fieldsData($request);
                $UpdateData = Extension::where('id', $id)->update($update);

                 if($request->status =='Y')
                 {   
                    $access = RequestAuth::Access();
                      //send notif
                    if($access !="admin" || $access !="pusat")
                    {
                         $type = 'periode';
                         $messages = Auth::User()->username.' meminta pengajuan perpanjangan periode sampai tanggal '.$request->extensiondate;
                         $url = url('extension/show/'.$id);
                         $notif = RequestNotification::fieldsData($type,$messages,$url);
                         Notification::create($notif);

                        
                         $description = $request->description;
                         $daerah_name = RequestDaerah::GetDaerahWhereName(Auth::User()->daerah_id);
                         $pusat = User::where('username','pusat')->first()->email;
                         Mail::to($pusat)->send(new PeriodeExtension(Auth::User()->username,$url,$request->year,$request->semester,$description, $daerah_name));

                    }
                 }

                  $log = array(
                    'category' => 'LOG_DATA_PERIODE_EXTENSION',
                    'group_menu' => 'mengubah_data_periode',
                    'description' => 'Mengubah data Extension <b>' . $request->extensiondate . '</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);

                
          
              return response()->json(['status' => true, 'id' => $UpdateData, 'message' => 'Update data sucessfully']);
            } 
        }
    }

    public function approved($type,$id)
    {
        $messages['messages'] = false;
        $_res = Extension::find($id);
       
        $daerah_name = RequestDaerah::GetDaerahWhereName($_res->daerah_id);
        $log = array(
            'category' => 'LOG_DATA_PERIODE',
            'group_menu' => 'approved_pengajuan_periode',
            'description' => '<b>' . $daerah_name . '</b> telah approved',
        );
        $datalog = RequestAuditLog::fieldsData($log);

        if (empty($_res)) {
            return response()->json(['messages' => false]);
        }

        if($type =='approved')
        {
             $results = $_res->update(['checklist'=>'approved']);  

             $type = 'periode';
             $pesan = 'pengajuan perpanjangan periode sampai tanggal '.$_res->extensiondate.' di approved';
             $url = url('extension/show/'.$id);
             $notif = RequestNotification::fieldsData($type,$pesan,$url);
             Notification::create($notif);

             $status = 'Disetujui';
             $description = $_res->description;
             
             Mail::to('ryzal.kazama@gmail.com')->send(new PeriodeApproved($daerah_name,$url,$_res->year,$_res->semester,$daerah_name, $status,$description));

        }else{
            $results = $_res->update(['checklist'=>'not_approved']);

            $type = 'periode';
            $pesan = Auth::User()->username.' pengajuan perpanjangan periode sampai tanggal '.$_res->extensiondate.' dibatalkan';
            $url = url('extension/show/'.$id);
            $notif = RequestNotification::fieldsData($type,$pesan,$url);
            Notification::create($notif);

             $status = 'Ditolak';
             $description = $_res->description;
             
             Mail::to(Auth::User()->email)->send(new PeriodeApproved($daerah_name,$url,$_res->year,$_res->semester,$daerah_name,$status,$description));   
        }    

       
        if ($results) {
            $messages['messages'] = true;
        }
        return response()->json($messages);

    }

    public function delete($id)
    {
        $messages['messages'] = false;
        $_res = Extension::find($id);
        if ($_res->semester == '01') {
            $name = 'Semester 1 Tahun ' . $_res->year;
        } else {
            $name = 'Semester 2 Tahun ' . $_res->year;
        }

        $log = array(
            'category' => 'LOG_DATA_PERIODE',
            'group_menu' => 'menghapus_data_periode',
            'description' => '<b>' . $name . '</b> telah dihapus',
        );
        $datalog = RequestAuditLog::fieldsData($log);

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

        $json = json_encode($request->data);
        //Audit Log
        $log = array(
            'action' => 'Delete Extension Select',
            'slug' => 'delete-Extension-select',
            'type' => 'post',
            'json_field' => $json,
            'url' => 'api/Extension/selected/'
        );

        RequestAuditLog::fieldsData($log);

        foreach ($request->data as $key) 
        {
            $find = Extension::where('id', $key)->first();
            if ($find->semester == '01') {
                $name = 'Semester 1 Tahun ' . $find->year;
            } else {
                $name = 'Semester 2 Tahun ' . $find->year;
            }

            if($request->type =='deleted')
            {
                $log = array(
                'category' => 'LOG_DATA_PERIODE_EXTENSION',
                'group_menu' => 'menghapus_data_periode',
                'description' => '<b>' . $name . '</b> telah dihapus',
                );
                // $datalog = RequestAuditLog::fieldsData($log);
                $results = Extension::where('id', (int)$key)->delete();

            }else{

                $log = array(
                    'category' => 'LOG_DATA_PERIODE_EXTENSION',
                    'group_menu' => 'approval_data_periode',
                    'description' => '<b>' . $name . '</b> telah diaprove',
                );
                // $datalog = RequestAuditLog::fieldsData($log);
                $results = Extension::where('id', (int)$key)->update(['checklist'=>'approved']);

                $type = 'periode';
                $url = '';
                $messages = 'Pengajuan perpanjangan periode sampai tanggal '.$request->extensiondate.' sudah approved oleh admin';
                $notif = RequestNotification::fieldsData($type,$messages,$url);
                Notification::create($notif);

            }   

        
        }




        if ($results) {
            $messages['messages'] = true;
        }

        return response()->json($messages);
    }

    
    
}

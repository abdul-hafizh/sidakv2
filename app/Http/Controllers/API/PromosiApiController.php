<?php

namespace App\Http\Controllers\API;

use DB;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promosi;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestPromosi;
use App\Http\Request\Validation\ValidationPromosi;
use App\Http\Request\RequestAuditLog;
use App\Helpers\GeneralHelpers;
use App\Helpers\GeneralPaginate;
use App\Models\Notification;
use App\Http\Request\RequestDaerah;
use App\Http\Request\RequestNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\PeriodeApproved;
use App\Mail\PeriodeExtension;
use App\Models\User;

class PromosiApiController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {

        $access = RequestAuth::Access(); 
        $year = $request->periode_id;

        if($access == 'province') { 
            
             $query = Promosi::where(['daerah_id'=>Auth::User()->daerah_id,'periode_id'=>$year])->orderBy('created_at', 'DESC');
        } else {
             $query = Promosi::where(['periode_id'=>$year])->orderBy('created_at', 'DESC');
        }

       
        if ($request->per_page != 'all') {
            $data = $query->paginate($request->per_page);
        } else {
            $data = $query->get();
        }

        $result = RequestPromosi::GetDataAll($data, $request->per_page, $request);
        return response()->json($result);
    }


    public function show($id){

        $data = Promosi::where(['id'=>$id])->first();
        $result = RequestPromosi::GetDetail($data);
        return response()->json($result);
    }

    
    public function search(Request $request)
    {
        $search = $request->search;
        $periode_id = $request->periode_id;
        $daerah_id = $request->daerah_id;
        $status = $request->status;
        $_res = array();
        $column_search  = array('provinces.name');

      
         $query  = Promosi::join('provinces','promosi.daerah_id','=','provinces.id');
       

         if($status =='req_edit')
         {
            $query->where(['promosi.request_edit'=>'true','checklist'=>'not_approved']); 
         }else if($status =='approved'){
            $query->where(['promosi.request_edit'=>'false','checklist'=>'approved']); 
         }   


        if($search == '')
        {
            if($daerah_id !='')
            {
                $query->where('daerah_id',$daerah_id); 
            }    

           
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
         $query->where('periode_id',$periode_id);      
         $data = $query->orderBy('promosi.id', 'DESC')->paginate($request->per_page);
         $description = $search;
 
         $_res = RequestPromosi::GetDataAll($data, $request->per_page, $request, $description);
         return response()->json($_res);
    }

    

    public function store(Request $request)
    {
        $validation = ValidationPromosi::validation($request);
        if ($validation) {
            return response()->json($validation, 400);
        } else {
                $daerah_name = RequestDaerah::GetDaerahWhereName(Auth::User()->daerah_id); 
           
            
                $insert = RequestPromosi::fieldsData($request); 
                $log = array(
                    'category' => 'LOG_DATA_PROMOSI',
                    'group_menu' => 'upload_data_promosi',
                    'description' => 'Menambahkan data promosi '.$daerah_name.' periode <b> ' . $request->periode_id . '</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);
                //create menu
                $saveData = Promosi::create($insert);
                 if($request->status =='Y')
                 {   
                    $access = RequestAuth::Access();
                      //send notif
                    if($access !="admin" || $access !="pusat")
                    {
                         $type = 'promosi';
                         $messages = Auth::User()->username.' Menambahkan Menambahkan promosi '.$daerah_name.' periode '.$request->periode_id;
                         $url = url('promosi/show/'.$saveData->id);
                         $notif = RequestNotification::fieldsData($type,$messages,$url);
                         Notification::create($notif);
                         $datafrom = User::where('username','pusat')->first();

                        // $description = $request->description;
                        
                         // $pusat = User::where('username','pusat')->first()->email;
                         // Mail::to($pusat)->send(new PeriodeExtension(Auth::User()->username,$url,$request->year,$request->semester,$description, $daerah_name));
                      

                    }
                 }
                //result
                return response()->json(['status' => true, 'id' => $saveData, 'message' => 'Insert data sucessfully']);
            }    
            
        
    }


    public function reqedit($id, Request $request)
    {
        $find = Promosi::find($id);
        if (empty($find)) {
            return response()->json(['messages' => false]);
        }  

        $messages['messages'] = false;
        $_res = Promosi::find($id);
        $daerah_name = RequestDaerah::GetDaerahWhereName($_res->daerah_id);

        $log = array(
            'category' => 'LOG_DATA_PROMOSI',
            'group_menu' => 'requestedit_data_promosi',
            'description' => $daerah_name.' untuk periode tahun <b>' . $_res->periode_id . '</b> mengajukan permintaan request edit dengan alasan '.$request->alasan,
        );
        $datalog = RequestAuditLog::fieldsData($log);

 


        if (empty($_res)) {
            return response()->json(['messages' => false]);
        }

        $results = $_res->where('id',$id)->update(['alasan'=>$request->alasan,'request_edit'=>'true','checklist'=>'not_approved']);

        if($access !="admin" || $access !="pusat")
        {
                 $type = 'promosi';
                 $messages = $daerah_name.' untuk periode tahun <b>' . $_res->periode_id . '</b> mengajukan permintaan request edit dengan alasan '.$request->alasan;
                 $url = url('promosi/show/'.$saveData->id);
                 $notif = RequestNotification::fieldsData($type,$messages,$url);
                 Notification::create($notif);
                 $datafrom = User::where('username','pusat')->first();

        }

        if ($results) {
            $messages['messages'] = true;
        }
        return response()->json($messages);

        
         
    }

     public function approved($type,$id)
    {
        $messages['messages'] = false;
        $_res = Promosi::find($id);
       
        $daerah_name = RequestDaerah::GetDaerahWhereName($_res->daerah_id);
        $log = array(
            'category' => 'LOG_DATA_PROMOSI',
            'group_menu' => 'approved_pengajuan_promosi',
            'description' => '<b>' . $daerah_name . '</b> telah approved',
        );
        $datalog = RequestAuditLog::fieldsData($log);

        if (empty($_res)) {
            return response()->json(['messages' => false]);
        }

        if($type =='approved')
        {
             $results = $_res->update(['request_edit'=>'false','checklist'=>'approved']);  

             $type = 'periode';
             $pesan = 'pengajuan promosi '.$daerah_name.' di approved';
             $url = url('promosi/show/'.$id);
             $notif = RequestNotification::fieldsData($type,$pesan,$url);
             Notification::create($notif);

             $status = 'Disetujui';
             $description = $_res->description;
             
            // Mail::to('ryzal.kazama@gmail.com')->send(new PeriodeApproved($daerah_name,$url,$_res->year,$_res->semester,$daerah_name, $status,$description));

        }else{
            $results = $_res->update(['request_edit'=>'false','checklist'=>'not_approved']);

            $type = 'periode';
            $pesan = Auth::User()->username.' pengajuan promosi dibatalkan';
            $url = url('promosi/show/'.$id);
            $notif = RequestNotification::fieldsData($type,$pesan,$url);
            Notification::create($notif);

             $status = 'Ditolak';
             $description = $_res->description;
             
          //   Mail::to(Auth::User()->email)->send(new PeriodeApproved($daerah_name,$url,$_res->year,$_res->semester,$daerah_name,$status,$description));   
        }    

       
        if ($results) {
            $messages['messages'] = true;
        }
        return response()->json($messages);

    }

    public function update($id, Request $request)
    {
        $validation = ValidationPromosi::validation($request);
        if ($validation) {
            return response()->json($validation, 400);
        } else {

          


                $update = RequestPromosi::fieldsData($request);
                $UpdateData = Promosi::where('id', $id)->update($update);

                 
                  $log = array(
                    'category' => 'LOG_DATA_PROMOSI',
                    'group_menu' => 'mengubah_data_promosi',
                    'description' => 'Mengubah data Promosi <b>' . $request->periode_id . '</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);

                return response()->json(['status' => true, 'id' => $UpdateData, 'message' => 'Update data sucessfully']);
             
        }
    }

    

    public function delete($id)
    {
        $messages['messages'] = false;
        $_res = Promosi::find($id);
       

        $log = array(
            'category' => 'LOG_DATA_PROMOSI',
            'group_menu' => 'menghapus_data_promosi',
            'description' => '<b>Promosi ' . $_res->periode_id . '</b> telah dihapus',
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

       
         
    

        foreach ($request->data as $key) 
        {
            $find = Promosi::where('id', $key)->first();
            $daerah_name = RequestDaerah::GetDaerahWhereName($find->daerah_id);
            if($request->type =='deleted')
            {
                $log = array(
                'category' => 'LOG_DATA_PERIODE_PROMOSI',
                'group_menu' => 'menghapus_data_promosi',
                'description' => '<b>Promosi ' . $find->periode_id .' '.$daerah_name.'</b> telah dihapus',
                );
                $datalog = RequestAuditLog::fieldsData($log);
                $results = Promosi::where('id', (int)$key)->delete();

            }else{

                $log = array(
                'category' => 'LOG_DATA_PERIODE_PROMOSI',
                'group_menu' => 'approved_data_promosi',
                'description' => '<b> Promosi ' . $find->periode_id . ' '.$daerah_name.'</b> telah diapproved',
                );
                $datalog = RequestAuditLog::fieldsData($log);
                $results = Promosi::where('id', (int)$key)->update(['checklist'=>'approved','request_edit'=>'false']);

                $type = 'periode';
                $url = '';
                $msg = 'Pengajuan request edit sudah approved oleh admin';
                $notif = RequestNotification::fieldsData($type,$msg,$url);
                Notification::create($notif);

            }   

        
        }




        if ($results) {
            $messages['messages'] = true;
        }

        return response()->json($messages);
    }

    
    
}

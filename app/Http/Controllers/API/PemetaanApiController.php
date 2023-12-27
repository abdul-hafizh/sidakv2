<?php

namespace App\Http\Controllers\API;

use DB;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemetaan;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestPemetaan;
use App\Http\Request\Validation\ValidationPemetaan;
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



class PemetaanApiController extends Controller
{

    public function __construct()
    {
       
    }

    public function index(Request $request)
    {
          
        $access = RequestAuth::Access(); 
        $year = $request->periode_id;

        if($access == 'province') { 
            
             $query = Pemetaan::where(['daerah_id'=>Auth::User()->daerah_id,'periode_id'=>$year])->orderBy('created_at', 'DESC');
        } else {
             $query = Pemetaan::where(['periode_id'=>$year])->orderBy('created_at', 'DESC');
        }

       
        if ($request->per_page != 'all') {
            $data = $query->paginate($request->per_page);
        } else {
            $data = $query->get();
        }

        $result = RequestPemetaan::GetDataAll($data, $request->per_page, $request);
        return response()->json($result);
    }


    public function show($id){

        $data = Pemetaan::where(['id'=>$id])->first();
        $result = RequestPemetaan::GetDetail($data);
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

      
         $query  = Pemetaan::join('provinces','pemetaan.daerah_id','=','provinces.id');
       

         if($status =='req_edit')
         {
            $query->where(['pemetaan.request_edit'=>'true','checklist'=>'not_approved']); 
         }else if($status =='approved'){
            $query->where(['pemetaan.request_edit'=>'false','checklist'=>'approved']); 
         }else if($status =='draft'){  
            $query->where(['pemetaan.status_laporan_id'=>'13']);
         }else if($status =='terkirim'){ 
            $query->where(['pemetaan.status_laporan_id'=>'14']);     
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
         $data = $query->orderBy('pemetaan.id', 'DESC')->paginate($request->per_page);
         $description = $search;
 
         $_res = RequestPemetaan::GetDataAll($data, $request->per_page, $request, $description);
         return response()->json($_res);
    }

    

    public function store(Request $request)
    {
          
        // $id = '';
        //    $insert = RequestPemetaan::fieldsGroup($request,$id);
        //   return  $insert;

        $validation = ValidationPemetaan::validation($request);
        if ($validation) {


            return response()->json($validation, 400);
        } else {

                $daerah_name = RequestDaerah::GetDaerahWhereID(Auth::User()->daerah_id); 
           
                $id = '';
                
                $log = array(
                    'category' => 'LOG_DATA_PEMETAAN',
                    'group_menu' => 'upload_data_pemetaan',
                    'description' => 'Menambahkan data pemetaan '.$daerah_name.' periode <b> ' . $request->periode_id . '</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);
                //create menu
                $insert = RequestPemetaan::fieldsGroup($request,$id); 
                $saveData = Pemetaan::create($insert);
                 if($request->status =='Y')
                 {   
                    $access = RequestAuth::Access();
                      //send notif
                    if($access !="admin" || $access !="pusat")
                    {
                         $type = 'pemetaan';
                         $messages = Auth::User()->username.' Menambahkan pemetaan '.$daerah_name.' periode '.$request->periode_id;
                         $url = url('pemetaan/show/'.$saveData->id);
                         $sender = Auth::User()->username;
                         $notif = RequestNotification::fieldsData($type,$messages,$url,$sender);
                         Notification::create($notif);
                         $datafrom = User::where('username','pusat')->first();

                        $description = $request->description;
                        
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
       

        $messages['messages'] = false;
        $_res = Pemetaan::find($id);


        if (empty($_res)) {
            return response()->json(['messages' => false]);
        }
         $daerah_name = RequestDaerah::GetDaerahWhereID($_res->daerah_id); 
        if($request->access =='member')
        {

               $results = $_res->where('id',$id)->update(['alasan'=>$request->alasan,'request_edit'=>'true','checklist'=>'not_approved','request_edit_by'=>$access_type]);

                  $type = 'pemetaan';
                 $msg = $daerah_name.' mengajukan permintaan request edit untuk periode tahun <b>' . $_res->periode_id . '</b>  dengan alasan '.$request->alasan;
                 $url = url('pemetaan/detail/'.$id);
                 $sender = User::where(['username'=>'pusat'])->first()->username;
                 $notif = RequestNotification::fieldsData($type,$msg,$url,$sender);
                 Notification::create($notif);

               
                $log = array(
                    'category' => 'LOG_DATA_PEMETAAN',
                    'group_menu' => 'request_edit_data_pemetaan_member',
                    'description' => $daerah_name.' untuk periode tahun <b>' . $_res->periode_id . '</b> mengajukan permintaan request edit dengan alasan '.$request->alasan,
                );
                $datalog = RequestAuditLog::fieldsData($log);

                $access_type = 'member';
                 


        }else{
                 
                $type = 'pemetaan';
                 $msg = 'Pusat meminta untuk merevisi laporan data pemetaan daerah  '.$daerah_name.' periode tahun <b>' . $_res->periode_id . '</b> alasan '.$request->alasan;
                 $url = url('pemetaan/detail/'.$id);
                 $sender = User::where(['daerah_id'=>$_res->daerah_id])->first()->username;
                 $notif = RequestNotification::fieldsData($type,$msg,$url,$sender);
                 Notification::create($notif);

               
                $log = array(
                    'category' => 'LOG_DATA_PEMETAAN',
                    'group_menu' => 'request_edit_data_pemetaan_pusat',
                    'description' => 'Pusat meminta untuk merevisi laporan data pemetaan daerah  '.$daerah_name.' periode tahun <b>' . $_res->periode_id . '</b> alasan '.$request->alasan,
                );
                $datalog = RequestAuditLog::fieldsData($log);

                $access_type = 'pusat';
                 $results = $_res->where('id',$id)->update(['alasan'=>$request->alasan,'request_edit'=>'true','checklist'=>'not_approved','status_laporan_id'=>'13','request_edit_by'=>$access_type]);

        }    

    
        if ($results) {
            $messages['messages'] = true;
        }
        return response()->json($results);

        
         
    }


     public function approved($type,$id)
    {
        $messages['messages'] = false;
        $_res = Pemetaan::find($id);
       
        $daerah_name = RequestDaerah::GetDaerahWhereID($_res->daerah_id);
        $log = array(
            'category' => 'LOG_DATA_PEMETAAN',
            'group_menu' => 'approved_pengajuan_pemetaan',
            'description' => '<b>' . $daerah_name . '</b> telah approved',
        );
        $datalog = RequestAuditLog::fieldsData($log);

        if (empty($_res)) {
            return response()->json(['messages' => false]);
        }

        if($type =='approved')
        {
             $results = $_res->update(['status_laporan_id'=>'13','request_edit'=>'false','checklist'=>'approved','alasan'=>'']);  

             $type = 'periode';
           
             $url = url('pemetaan/detail/'.$id);
             $sender = $_res->created_by;
             $msg = Auth::User()->username.' pengajuan pemetaan dibatalkan';
             $notif = RequestNotification::fieldsData($type,$msg,$url,$sender);
             Notification::create($notif);

             $status = 'Disetujui';
             $description = $_res->description;
             
            // Mail::to('ryzal.kazama@gmail.com')->send(new PeriodeApproved($daerah_name,$url,$_res->year,$_res->semester,$daerah_name, $status,$description));

        }else{
            $results = $_res->update(['request_edit'=>'false','checklist'=>'not_approved']);

            $type = 'periode';
           
            $msg = 'pengajuan pemetaan '.$daerah_name.' di approved';
            $sender = $_res->created_by;
            $url = url('pemetaan/detail/'.$id);
            $notif = RequestNotification::fieldsData($type,$msg,$url,$sender);
            Notification::create($notif);

             // $status = 'Ditolak';
             // $description = $_res->description;
             
            // Mail::to($_res)->send(new PeriodeApproved($daerah_name,$url,$_res->year,$_res->semester,$daerah_name,$status,$description));   
        }    

       
        if ($results) {
            $messages['messages'] = true;
        }
        return response()->json($messages);

    }

    

    public function update($id, Request $request)
    {
        $validation = ValidationPemetaan::validation($request);
        if ($validation) {
            return response()->json($validation, 400);
        } else {
            
                $update = RequestPemetaan::fieldsGroup($request,$id);
                $UpdateData = Pemetaan::where('id', $id)->update($update);

                 
                $log = array(
                    'category' => 'LOG_DATA_PEMETAAN',
                    'group_menu' => 'mengubah_data_pemetaan',
                    'description' => 'Mengubah data pemetaan <b>' . $request->periode_id . '</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);

                return response()->json(['status' => true, 'id' => $update, 'message' => 'Update data sucessfully']);
             
        }
    }

    

    public function delete($id)
    {
        $messages['messages'] = false;
        $_res = Pemetaan::find($id);
       
          
        $log = array(
            'category' => 'LOG_DATA_PEMETAAN',
            'group_menu' => 'menghapus_data_pemetaan',
            'description' => '<b>Pemetaan ' . $_res->periode_id . '</b> telah dihapus',
        );
        $datalog = RequestAuditLog::fieldsData($log);

        if (empty($_res)) {
            return response()->json(['messages' => false]);
        }

        RequestPemetaan::DeletePDF($_res);

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
            $find = Pemetaan::where('id', $key)->first();
            $daerah_name = RequestDaerah::GetDaerahWhereName($find->daerah_id);
            if($request->type =='deleted')
            {
                $log = array(
                'category' => 'LOG_DATA_PEMETAAN',
                'group_menu' => 'menghapus_data_pemetaan',
                'description' => '<b>Pemetaan ' . $find->periode_id .' '.$daerah_name.'</b> telah dihapus',
                );
                $datalog = RequestAuditLog::fieldsData($log);
                $results = Pemetaan::where('id', (int)$key)->delete();

            }else{

                $log = array(
                'category' => 'LOG_DATA_PEMETAAN',
                'group_menu' => 'approved_data_pemetaan',
                'description' => '<b> pemetaan ' . $find->periode_id . ' '.$daerah_name.'</b> telah diapproved',
                );
                $datalog = RequestAuditLog::fieldsData($log);
                $results = Pemetaan::where('id', (int)$key)->update(['checklist'=>'approved','request_edit'=>'false']);

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

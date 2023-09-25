<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Kendala;
use App\Models\KendalaDetail;
use App\Models\Notification;
use App\Helpers\GeneralPaginate;
use App\Http\Request\RequestKendala;
use App\Http\Request\RequestNotification;
use App\Http\Request\Validation\ValidationKriteria;
use App\Http\Request\Validation\ValidationKendala;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestAuditLog;
use DB;
use Auth;

class KendalaApiController extends Controller
{

   
    public function __construct()
    {   
         $this->perPage = GeneralPaginate::limit();
    }

    public function index(Request $request)
    {
       

        $query = Kriteria::orderBy('created_at', 'DESC');
        if($_COOKIE['access'] !="admin")
        {
            $query->where(['status'=>'Y']);
        }  

        if($request->per_page !='all')
        {
            $data = $query->paginate($request->per_page);
        }else{   
            $data = $query->get(); 
        }   
        
        $result = RequestKendala::GetDataAll($data,$request->per_page,$request);
        return response()->json($result);


    }

    


    public function show($id,Request $request)
    {
       
        $Kriteria = Kriteria::where('slug',$id)->first();
        if($Kriteria)
        {

            $query = Kendala::where('kriteria_id',$Kriteria->id)->orderBy('created_at', 'DESC');
        
            if($request->per_page !='all')
            {
                $data = $query->paginate($request->per_page);
            }else{   
                $data = $query->get(); 
            }   
            
            $result = RequestKendala::GetDataKendala($data,$request->per_page,$request);
            return response()->json($result);

        }    
       


    }

    public function commentDetail($id,Request $request)
    {
       
            $data = KendalaDetail::where('id',$id)->first();
            if($data)
            {
                $result['messages'] = $data->messages;
            }else{
                $result['messages'] = '';  
            }   
            return response()->json($result);

          
       


    }


    public function saveKendala(Request $request){
        $validation = ValidationKendala::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{

           $insert = RequestKendala::fieldsDataKendala($request);  

            $log = array(             
            'category'=> 'LOG_DATA_KENDALA',
            'group_menu'=>'upload_data_kendala',
            'description'=>'Menambahkan data kendala <b>'.$request->permasalahan.'</b>',
            );
            $datalog = RequestAuditLog::fieldsData($log);


            //create menu
           $saveData = Kendala::create($insert);
           $messages = RequestKendala::fieldsDataKendalaDetail($saveData->id,$request);
           KendalaDetail::create($messages);
            //result
            return response()->json(['status'=>true,'id'=>$saveData,'message'=>'Insert data sucessfully']);
        }    

    }


    public function listreplay($id){
       $data = KendalaDetail::where('Kendala_id',$id)->orderBy('created_at','DESC')->get();
       $_res = RequestKendala::ReplayAll($data);
       return response()->json($_res); 

    }


    public function saveComment(Request $request){
        $validation = ValidationKendala::validationComment($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{

           $insert = RequestKendala::fieldsDataKendalaDetail($request->kendala_id,$request);  

           $log = array(             
            'category'=> 'LOG_DATA_LIST_KENDALA',
            'group_menu'=>'upload_data_list_kendala',
            'description'=>'Menambahkan data kendala <b>'.$request->permasalahan.'</b>',
            );
            $datalog = RequestAuditLog::fieldsData($log);

            //create menu
           $saveData = KendalaDetail::create($insert);
           $last = RequestKendala::MessagesLast($saveData->id,$request->kendala_id);

            $access = RequestAuth::Access();
              //send notif
            if($access !="admin" || $access !="pusat")
            {
                 $type = 'kendala';
                 $messages = Auth::User()->username.' meminta tanggapan atas kendala '.$request->permasalahan;
                 $notif = RequestNotification::fieldsData($type,$messages);
                 Notification::create($notif);

            }else{
                
                $type = 'kendala';
                $messages = 'Tanggapan atas kendala '.$request->permasalahan.' sudah dibalas Admin';
                $notif = RequestNotification::fieldsData($type,$messages);
                Notification::create($notif);


            }    
           

            
         
            //result
           return response()->json(['status'=>true,'data'=>$last,'message'=>'Insert data sucessfully']);
        }    

    }

    

    public function searchKriteria(Request $request){
        $search = $request->search;
        $_res = array();
        $column_search  = array('from','permasalahan');

        $i = 0;
        $query  = Kendala::orderBy('id','DESC');
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
        // $description = $search;
        $_res = RequestKendala::GetDataKendala($data,$this->perPage,$request);
               
    
        return response()->json($_res);

    }


    public function searchKendala(Request $request){
        $search = $request->search;
        $_res = array();
        $column_search  = array('category');

        $i = 0;
        $query  = Kriteria::orderBy('id','DESC');
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
       
        $Data = $query->paginate($this->perPage);
        // $description = $search;
        $_res = RequestKendala::GetDataAll($Data,$this->perPage,$request);
               
    
        return response()->json($_res);

    }


       
    public function store(Request $request){

        $validation = ValidationKriteria::validation($request);
        if($validation)
        {
           return response()->json($validation,400);  
        }else{

           if($request->status =='sent')
           {
                //send notif
                $type = 'kendala';
                $messages = Auth::User()->username.' meminta tanggapan atas kendala '.$request->permasalahan;
                $notif = RequestNotification::fieldsData($type,$messages);
                Notification::create($notif);

           }  
           $insert = RequestKendala::fieldsData($request);  

           // $json = json_encode($insert);
           //  $log = array(             
           //  'action'=> 'Insert Kendala',
           //  'slug'=>'insert-kendala',
           //  'type'=>'post',
           //  'json_field'=> $json,
           //  'url'=>'api/kendala'
           //  );

           //  $datalog = RequestAuditLog::fieldsData($log);

            //create menu
           $saveData = Kriteria::create($insert);
            //result
            return response()->json(['status'=>true,'id'=>$saveData,'message'=>'Insert data sucessfully']);    
            
        } 
    }

    
    public function update($id,Request $request){
     
        $validation = ValidationKriteria::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{
            
               $update = RequestKendala::fieldsData($request);
                 $log = array(             
                'category'=> 'LOG_DATA_KENDALA',
                'group_menu'=>'mengubah_data_kendala',
                'description'=>'Mengubah data kendala <b>'.$request->category.'</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);
                //Audit Log

                //update account
               $UpdateData = Kriteria::where('id',$id)->update($update);
                //result
               return response()->json(['status'=>true,'id'=>$UpdateData,'message'=>'Update data sucessfully']);
            
          
        }   

    }


    public function updatereplay($id,Request $request){
     
        $validation = ValidationKendala::validationComment($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{
            
               $update = array('messages'=>$request->messages);

                $log = array(             
                'category'=> 'LOG_DATA_REPLAY',
                'group_menu'=>'mengubah_data_replay',
                'description'=>'Mengubah data Replay <b>'.$request->messages.'</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);
                //Audit Log

                //update account
               $UpdateData = KendalaDetail::where('id',$id)->update($update);
                //result
               return response()->json(['status'=>true,'id'=>$UpdateData,'message'=>'Update data sucessfully']);
            
          
        }   

    }

    public function deletereplay($id){
        $messages['messages'] = false;
        $_res = KendalaDetail::find($id);

        $log = array(             
            'category'=> 'LOG_DATA_REPLAY',
            'group_menu'=>'menghapus_data_replay',
            'description'=> '<b>'.$_res->messages.'</b> telah dihapus',
            );
        $datalog = RequestAuditLog::fieldsData($log);
          
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }

        $results = $_res->delete();
        if($results){
            $messages['messages'] = true;
        }
        return response()->json($messages);


    }

    public function deleteSelected(Request $request){
        $messages['messages'] = false;

        foreach($request->data as $key)
        {
             $find = Kriteria::where('id',$key)->first();
            $log = array(             
                'category'=> 'LOG_DATA_KENDALA',
                'group_menu'=>'menghapus_data_kendala',
                'description'=> '<b>'.$find->category.'</b> telah dihapus',
                );
            $datalog = RequestAuditLog::fieldsData($log);
            $results = Kriteria::where('id',(int)$key)->delete();
        }

         $json = json_encode($request->data);
        //Audit Log
        

        if($results){
            $messages['messages'] = true;
        }

        return response()->json($messages);
    
    }

    

    public function delete($id){
        $messages['messages'] = false;
        $_res = Kriteria::find($id);
        // $json = json_encode($_res);
        // //Audit Log
        // $log = array(             
        // 'action'=> 'Delete Kendala',
        // 'slug'=>'delete-kendala',
        // 'type'=>'delete',
        // 'json_field'=> $json,
        // 'url'=>'api/kendala/'.$id
        // );

        // RequestAuditLog::fieldsData($log);   
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }

        $results = $_res->delete();
        if($results){
            $messages['messages'] = true;
        }
        return response()->json($messages);
    
    }


    


    


}    
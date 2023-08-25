<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendala;
use App\Models\KendalaDetail;
use App\Models\Notification;
use App\Helpers\GeneralPaginate;
use App\Http\Request\RequestKendala;
use App\Http\Request\RequestNotification;
use App\Http\Request\Validation\ValidationKendala;
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
       

        $query = Kendala::orderBy('created_at', 'DESC');
        if($_COOKIE['access'] !="admin")
        {
            $query->where('created_by',Auth::User()->username);
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

    


   

    

    public function search(Request $request){
        $search = $request->search;
        $_res = array();
        $column_search  = array('permasalahan');

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
       
        $Data = $query->paginate($this->perPage);
        // $description = $search;
        $_res = RequestKendala::GetDataAll($Data,$this->perPage,$request);
               
    
        return response()->json($_res);

    }


    public function listreplay($id){
     
       $data = KendalaDetail::where('kendala_id',$id)->orderBy('created_at','DESC')->get();
       $_res = RequestKendala::ReplayAll($data,$id);
       return response()->json($_res); 
    }



       
    public function store(Request $request){

        $validation = ValidationKendala::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{

            
           $insert = RequestKendala::fieldsData($request);  
            //create menu
           if($request->status =='sent')
           {
                //send notif
                $type = 'kendala';
                $messages = Auth::User()->username.' meminta tanggapan atas kendala '.$request->permasalahan;
                $notif = RequestNotification::fieldsData($type,$messages);
                Notification::create($notif);

           } 
           $saveData = Kendala::create($insert);
            //result
            return response()->json(['status'=>true,'id'=>$saveData,'message'=>'Insert data sucessfully']);    
            
        } 
    }

    public function replay(Request $request){

        $validation = ValidationKendala::validationReplay($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{

            
           $insert = RequestKendala::fieldsDataReplay($request);  
            //create menu
           if($request->status =='sent')
           {
                //send notif
                $type = 'kendala';
                $messages = 'Tanggapan atas kendala '.$request->permasalahan.' sudah dibalas Admin';
                $notif = RequestNotification::fieldsData($type,$messages);
                Notification::create($notif);

           } 
           $saveData = KendalaDetail::create($insert);
           $last = RequestKendala::MessagesLast($saveData->id);
            //result
            return response()->json(['status'=>true,'data'=>$last,'message'=>'Insert data sucessfully']);    
            
        } 
    }

    public function update($id,Request $request){
     
        $validation = ValidationKendala::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{
            
               $update = RequestKendala::fieldsData($request);
                //update account
               if($request->status =='sent')
               {
                //send notif
                $type = 'kendala';
                $messages = Auth::User()->username.' meminta tanggapan atas kendala '.$request->permasalahan;
                $notif = RequestNotification::fieldsData($type,$messages);
                Notification::create($notif);

               } 
               $UpdateData = Kendala::where('id',$id)->update($update);
                //result
               return response()->json(['status'=>true,'id'=>$UpdateData,'message'=>'Update data sucessfully']);
            
          
        }   

    }

    public function deleteSelected(Request $request){
        $messages['messages'] = false;
        foreach($request->data as $key)
        {
            $results = Kendala::where('id',(int)$key)->delete();
        }

        if($results){
            $messages['messages'] = true;
        }

        return response()->json($messages);
    
    }

    public function deletereplay($id){
        $messages['messages'] = false;
        $_res = KendalaDetail::find($id);
          
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }

        $results = $_res->delete();
        if($results){
            $messages['messages'] = true;
        }
        return response()->json($messages);


    }

    public function delete($id){
        $messages['messages'] = false;
        $_res = Kendala::find($id);
          
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
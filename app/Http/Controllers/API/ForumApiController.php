<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Topic;
use App\Models\TopicDetail;
use App\Models\Notification;
use App\Helpers\GeneralPaginate;
use App\Http\Request\RequestForum;
use App\Http\Request\RequestNotification;
use App\Http\Request\Validation\ValidationForum;
use App\Http\Request\Validation\ValidationTopic;
use App\Http\Request\RequestAuditLog;
use DB;
use Auth;

class ForumApiController extends Controller
{

   
    public function __construct()
    {   
         $this->perPage = GeneralPaginate::limit();
    }

    public function index(Request $request)
    {
       

        $query = Forum::orderBy('created_at', 'DESC');
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
        
        $result = RequestForum::GetDataAll($data,$request->per_page,$request);
        return response()->json($result);


    }

    


    public function show($id,Request $request)
    {
       
        $forum = Forum::where('slug',$id)->first();
        if($forum)
        {

            $query = Topic::where('forum_id',$forum->id)->orderBy('created_at', 'DESC');
        
            if($request->per_page !='all')
            {
                $data = $query->paginate($request->per_page);
            }else{   
                $data = $query->get(); 
            }   
            
            $result = RequestForum::GetDataTopic($data,$request->per_page,$request);
            return response()->json($result);

        }    
       


    }

    public function commentDetail($id,Request $request)
    {
       
            $data = TopicDetail::where('id',$id)->first();
            if($data)
            {
                $result['messages'] = $data->messages;
            }else{
                $result['messages'] = '';  
            }   
            return response()->json($result);

          
       


    }


    public function saveTopic(Request $request){
        $validation = ValidationTopic::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{

           $insert = RequestForum::fieldsDataTopic($request);  


            $json = json_encode($insert);
            $log = array(             
            'action'=> 'Insert Topik',
            'slug'=>'insert-topik',
            'type'=>'post',
            'json_field'=> $json,
            'url'=>'api/topic'
            );

            $datalog = RequestAuditLog::fieldsData($log);
            //create menu
           $saveData = Topic::create($insert);
           $messages = RequestForum::fieldsDataTopicDetail($saveData->id,$request);
           TopicDetail::create($messages);
            //result
            return response()->json(['status'=>true,'id'=>$saveData,'message'=>'Insert data sucessfully']);
        }    

    }


    public function listreplay($id){
       $data = TopicDetail::where('topic_id',$id)->orderBy('created_at','DESC')->get();
       $_res = RequestForum::ReplayAll($data);
       return response()->json($_res); 

    }


    public function saveComment(Request $request){
        $validation = ValidationTopic::validationComment($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{

           $insert = RequestForum::fieldsDataTopicDetail($request->topic_id,$request); 

            

            $json = json_encode($insert);
            $log = array(             
            'action'=> 'Insert Komentar',
            'slug'=>'insert-komentar',
            'type'=>'post',
            'json_field'=> $json,
            'url'=>'api/topic/comment'
            );

            $datalog = RequestAuditLog::fieldsData($log);

            //create menu
           $saveData = TopicDetail::create($insert);
           $last = RequestForum::MessagesLast($saveData->id,$request->topic_id);

           //send notif
                $type = 'Topic';
                $messages = Auth::User()->username.' mengomentari tautan anda';
                $notif = RequestNotification::fieldsData($type,$messages);
                Notification::create($notif);
         
            //result
           return response()->json(['status'=>true,'data'=>$last,'message'=>'Insert data sucessfully']);
        }    

    }

    

    public function searchForum(Request $request){
        $search = $request->search;
        $_res = array();
        $column_search  = array('category');

        $i = 0;
        $query  = Forum::orderBy('id','DESC');
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
        $_res = RequestForum::GetDataAll($Data,$this->perPage,$request);
               
    
        return response()->json($_res);

    }


    public function searchTopic(Request $request){
        $search = $request->search;
        $_res = array();
        $column_search  = array('name');

        $i = 0;
        $query  = Topic::orderBy('id','DESC');
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
        $_res = RequestForum::GetDataAll($Data,$this->perPage,$request);
               
    
        return response()->json($_res);

    }


       
    public function store(Request $request){

        $validation = ValidationForum::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{

            
            $insert = RequestForum::fieldsData($request); 
            $json = json_encode($insert);
            $log = array(             
            'action'=> 'Insert Forum',
            'slug'=>'insert-forum',
            'type'=>'post',
            'json_field'=> $json,
            'url'=>'api/forum'
            );

            $datalog = RequestAuditLog::fieldsData($log);

            //create menu
           $saveData = Forum::create($insert);
            //result
            return response()->json(['status'=>true,'id'=>$saveData,'message'=>'Insert data sucessfully']);    
            
        } 
    }

    
    public function update($id,Request $request){
     
        $validation = ValidationForum::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{
            
               $update = RequestForum::fieldsData($request);
               //Audit Log
                $json = json_encode($update);
                
                $log = array(             
                'action'=> 'Update Forum',
                'slug'=>'update-forum',
                'type'=>'put',
                'json_field'=> $json,
                'url'=>'api/forum/'.$id
                );

                $datalog =  RequestAuditLog::fieldsData($log);

                //update account
               $UpdateData = Forum::where('id',$id)->update($update);
                //result
               return response()->json(['status'=>true,'id'=>$UpdateData,'message'=>'Update data sucessfully']);
            
          
        }   

    }


    public function updatereplay($id,Request $request){
     
        $validation = ValidationTopic::validationComment($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{
            
               $update = array('messages'=>$request->comment);
                //update account
               $UpdateData = TopicDetail::where('id',$id)->update($update);
                //result
               return response()->json(['status'=>true,'id'=>$UpdateData,'message'=>'Update data sucessfully']);
            
          
        }   

    }

    public function deletereplay($id){
        $messages['messages'] = false;
        $_res = TopicDetail::find($id);

         $json = json_encode($_res);
        //Audit Log
        $log = array(             
        'action'=> 'Delete Replay',
        'slug'=>'delete-replay',
        'type'=>'delete',
        'json_field'=> $json,
        'url'=>'api/topic/'.$id
        );

        RequestAuditLog::fieldsData($log);
          
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
            $results = Forum::where('id',(int)$key)->delete();
        }

        if($results){
            $messages['messages'] = true;
        }

        return response()->json($messages);
    
    }

    

    public function delete($id){
        $messages['messages'] = false;
        $_res = Forum::find($id);

        $json = json_encode($_res);
        //Audit Log
        $log = array(             
        'action'=> 'Delete Forum',
        'slug'=>'delete-forum',
        'type'=>'delete',
        'json_field'=> $json,
        'url'=>'api/forum/'.$id
        );

        RequestAuditLog::fieldsData($log);
          
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
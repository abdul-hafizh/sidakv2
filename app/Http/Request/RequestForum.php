<?php

namespace App\Http\Request;
use Auth;
use App\Helpers\GeneralHelpers;
use Illuminate\Support\Str;
use App\Models\Forum;
use App\Models\Topic;
use App\Models\TopicDetail;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestMenuRoles;

class RequestForum 
{
   
   public static function GetDataAll($data,$perPage,$request)
   {
        $temp = array();
         
        $getRequest = $request->all();
        $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
        if($perPage !='all')
        {
             $numberNext = (($page * $perPage) - ($perPage - 1));
        }else{
             $numberNext = (($page * $data->count()) - ($data->count() - 1));
        }  
       
        foreach ($data as $key => $val)
        {
            if($val->status =="Y") { 
                $status = "Publish";
            }else{ 
                $status = "Draft";
            }

            
            $description =  $val->description;
            if (strlen($description) > 70) {
                $description = substr($description, 0, 70) . "...";
            } 

            $temp[$key]['number'] = $numberNext++;
            $temp[$key]['id'] = $val->id;
            $temp[$key]['category'] = $val->category;
            $temp[$key]['slug'] = $val->slug;
            $temp[$key]['description'] = $description;
            $temp[$key]['access'] = RequestAuth::Access();
           
            $temp[$key]['status'] = array('status_db' => $val->status, 'status_convert' => $status);
            $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val->created_at);
            $temp[$key]['created_at_format'] = GeneralHelpers::formatExcel($val->created_at); 
        }

       $result['data'] = $temp;
       $result['options'] = RequestMenuRoles::ActionPage('forum');
       if($perPage !='all')
       {
           $result['current_page'] = $data->currentPage();
           $result['last_page'] = $data->lastPage();
           $result['total'] = $data->total(); 
       }else{
           $result['current_page'] = 1;
           $result['last_page'] = 1;
           $result['total'] = $data->count(); 
       }
        return $result;

   }

  

  
   public static function GetDataTopic($data,$perPage,$request)
   {
        $temp = array();
         
        $getRequest = $request->all();
        $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
        if($perPage !='all')
        {
             $numberNext = (($page * $perPage) - ($perPage - 1));
        }else{
             $numberNext = (($page * $data->count()) - ($data->count() - 1));
        }  
       
        foreach ($data as $key => $val)
        {
            if($val->status =="Y") { 
                $status = "Publish";
            }else{ 
                $status = "Draft";
            }

            
            $description =  $val->description;
            if (strlen($description) > 70) {
                $description = substr($description, 0, 70) . "...";
            } 

            $temp[$key]['number'] = $numberNext++;
            $temp[$key]['id'] = $val->id;
            $temp[$key]['name'] = $val->name;
            $temp[$key]['slug'] = $val->slug;
            $temp[$key]['category'] = RequestForum::categoryForum($val->forum_id);
            $temp[$key]['access'] = RequestAuth::Access();
            $temp[$key]['total_messsage'] = RequestForum::TotalMessage($val->id,$val->created_by).' Komentar';
            $temp[$key]['status'] = array('status_db' => $val->status, 'status_convert' => $status);
            $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val->created_at);
            $temp[$key]['created_at_format'] = GeneralHelpers::formatExcel($val->created_at); 
        }

       $result['data'] = $temp;
       $result['options'] = RequestMenuRoles::ActionPage('forum');
       if($perPage !='all')
       {
           $result['current_page'] = $data->currentPage();
           $result['last_page'] = $data->lastPage();
           $result['total'] = $data->total(); 
       }else{
           $result['current_page'] = 1;
           $result['last_page'] = 1;
           $result['total'] = $data->count(); 
       }
        return $result;

   }

   

   public static function TotalMessage($topic_id,$created_by)
   { 
      $count = TopicDetail::where('topic_id',$topic_id)->where('created_by','!=',$created_by)->count();
      return $count;
   }

   public static function categoryForum($forum_id){
      $forum = Forum::where('id',$forum_id)->first();
      if($forum)
      {
         $data = $forum->category; 
      }else{
          $data = null;
      }
      return $data;  
   }
  

    public static function ReplayAll($data)
   {
       $temp = array();
       foreach ($data as $key => $val)
       {
          $temp[$key]['id'] = $val->id;
          $temp[$key]['username'] = $val->created_by;
          $temp[$key]['photo'] = RequestAuth::photoUser($val->created_by);
          $temp[$key]['action'] = RequestKendala::CheckAction($val->created_by);
          $temp[$key]['messages'] = $val->messages; 
          $temp[$key]['deleted'] = true;
       } 


        return $temp;
   }

   public static function CheckAction($username)
   {
        if($username == Auth::User()->username)
        {
          $result = true;
        }else{
          $result = false;
        } 

        return $result;   

   }


    public static function MessagesLast($id,$topic_id){
     
     $last = TopicDetail::where(['id'=>$id,'topic_id'=>$topic_id])->first();
     $messages = array('id'=>$last->id,'username'=>$last->created_by,'photo'=>RequestAuth::photoUser($last->created_by),'messages'=>$last->messages);
     return $messages;

   }
 

   public static function fieldsData($request)
   {
        $uuid = Str::uuid()->toString();
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->category)));

        $fields = [ 
                'id'=> $uuid,
                'category'  =>  $request->category,
                'slug'      =>  $slug,
                'description'  =>  $request->description,
                'status'  =>  $request->status,
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
        ];
        return $fields;
   }

    public static function fieldsDataTopic($request)
   {
        $uuid = Str::uuid()->toString();
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $fields = [];
        $forum = Forum::where('slug',$request->forum_slug)->first();
        if($forum)
        {

            $fields = [ 
                'id'=> $uuid,
                'forum_id'=>$forum->id,
                'name'  =>  $request->name,
                'slug'      =>  $slug,
                'status'  =>  'Y',
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
            ];

        }    

       
        return $fields;
   }


    public static function fieldsDataTopicDetail($topic_id,$request)
   {
        $uuid = Str::uuid()->toString();
        $fields = [ 
            'id'=> $uuid,
            'topic_id'=>$topic_id,
            'messages'  =>  $request->comment,
            'status'  =>  'Y',
            'created_by' => Auth::User()->username,
            'created_at' => date('Y-m-d H:i:s'),
        ];
       
        return $fields;
   }


   

   

  

   

}
<?php

namespace App\Http\Request;
use Auth;
use App\Helpers\GeneralHelpers;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\KendalaDetail;
use App\Models\Kendala;
use App\Http\Request\RequestAuth;
class RequestKendala 
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
            if($val->status =="sent") { 
                $status = "Terkirim";
                $showedit = false;
                $showdelete = false;
               

            }else{ 
                $status = "Draft";
                $showedit = true;
                $showdelete = true; 
              
            }

            $permasalahan =   $val->permasalahan;
            if (strlen($permasalahan) > 20) {
                $permasalahan = substr($permasalahan, 0, 20) . "...";
            }

            $messages =  $val->messages;
            if (strlen($messages) > 70) {
                $messages = substr($messages, 0, 70) . "...";
            } 

            $temp[$key]['number'] = $numberNext++;
            $temp[$key]['id'] = $val->id;
            $temp[$key]['permasalahan'] = $permasalahan;
            $temp[$key]['messages'] = $messages;
            $temp[$key]['from'] = $val->from;
            $temp[$key]['sender'] = $val->sender;
            $temp[$key]['status'] = $status;
            $temp[$key]['showedit'] = $showedit;
            $temp[$key]['showdelete'] = $showdelete;
            $temp[$key]['replay'] = RequestKendala::CheckReplay($val->id);

            $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val['created_at']);
        }

       $result['data'] = $temp;
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

   public static function ReplayAll($data,$id)
   {
       $temp = array();
       foreach ($data as $key => $val)
       {
          $temp[$key]['id'] = $val->id;
          $temp[$key]['username'] = $val->from;
          $temp[$key]['photo'] = RequestAuth::photoUser($val->from);
          $temp[$key]['messages'] = $val->messages; 
       } 

        $first = Kendala::where('id',$id)->first();
        $messages = array(['id'=>$first->id,'username'=>$first->from,'photo'=>RequestAuth::photoUser($val->from),'messages'=>$first->messages]);
        $merge = array_merge($messages,$temp);
        return $merge;
   }

   public static function CheckReplay($id)
   {
        $data = KendalaDetail::where('kendala_id',$id)->count();
        if($data>0)
        {
          $result = true;
        }else{
          $result = false;
        }    
        
        return $result;

   }

  
 

   public static function fieldsData($request)
   {
        $uuid = Str::uuid()->toString();
        $pusat = User::where(['username'=>'pusat'])->first();
        if($pusat)
        {
            $sender = $pusat->username;
        }else{
            $sender = 'null';
        }

        $fields = [ 
                'id'=> $uuid,
                'permasalahan'  =>  $request->permasalahan,
                'messages'  =>  $request->messages,
                'from'  =>  Auth::User()->username,
                'sender'  =>  $sender,
                'status'  =>  $request->status,
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
        ];
        return $fields;
   }


   public static function fieldsDataReplay($request)
   {
        $uuid = Str::uuid()->toString();
        $fields = [ 
                'id'=> $uuid,
                'kendala_id'  =>  $request->kendala_id,
                'messages'  =>  $request->messages,
                'from'  =>  Auth::User()->username,
                'sender'  => $request->sender,
                'status'  =>  $request->status,
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
        ];
        return $fields;
   }

   

  

   

}
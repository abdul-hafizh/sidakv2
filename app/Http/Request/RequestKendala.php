<?php

namespace App\Http\Request;
use Auth;
use App\Helpers\GeneralHelpers;
use Illuminate\Support\Str;
use App\Models\Kriteria;
use App\Models\Kendala;
use App\Models\User;
use App\Models\KendalaDetail;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestMenuRoles;

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
            $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val['created_at']);
            $temp[$key]['created_at_format'] = GeneralHelpers::formatExcel($val['created_at']); 
        }

       $result['data'] = $temp;
       $result['options'] = RequestMenuRoles::ActionPage('kendala');
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

  
   public static function GetDataKendala($data,$perPage,$request)
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

            
            // $description =  $val->description;
            // if (strlen($description) > 70) {
            //     $description = substr($description, 0, 70) . "...";
            // } 

            $temp[$key]['number'] = $numberNext++;
            $temp[$key]['id'] = $val->id;
            $temp[$key]['permasalahan'] = $val->permasalahan;
            $temp[$key]['messages'] = $val->messages;
            $temp[$key]['from'] = RequestAuth::fullname($val->from);
            //$temp[$key]['deleted'] = RequestKendala::checkValidate($val->id);
            $temp[$key]['category'] = RequestKendala::categoryKendala($val->kriteria_id);
            $temp[$key]['total_messsage'] = RequestKendala::TotalMessage($val->id).' Pesan';
            $temp[$key]['status'] = array('status_db' => $val->status, 'status_convert' => $status);
            $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val['created_at']);
            $temp[$key]['created_at_format'] = GeneralHelpers::formatExcel($val['created_at']); 
            
        }

       $result['data'] = $temp;
       $result['options'] = RequestMenuRoles::ActionPage('kendala');
      
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

   public static function checkValidate($id){

       $data = KendalaDetail::where('kendala_id',$id)->count();
       if($data > 0)
       {
          $result = false;
       }else{
          $result = true;
       } 

       return $result;
  }

  public static function Category($kendala_id){
     $data = Kendala::where('id',$kendala_id)->first();
     if($data)
     {
        $result = RequestKendala::categoryKendala($data->kriteria_id);
     }  

     return $result; 
  }

 

   public static function TotalMessage($kendala_id)
   { 
      $count = KendalaDetail::where('kendala_id',$kendala_id)->count();
      return $count;
   }

   public static function categoryKendala($kriteria_id){
      $kriteria = Kriteria::where('id',$kriteria_id)->first();
      if($kriteria)
      {
         $data = $kriteria->category; 
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
          $temp[$key]['messages'] = $val->messages; 
          $temp[$key]['action'] = RequestKendala::CheckAction($val->from);
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


    public static function MessagesLast($id,$kendala_id){
     
     $last = KendalaDetail::where(['id'=>$id,'kendala_id'=>$kendala_id])->first();
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

    public static function fieldsDataKendala($request)
   {
        $uuid = Str::uuid()->toString();
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $fields = [];
        $kriteria = Kriteria::where('slug',$request->kriteria_slug)->first();
        if($kriteria)
        {
            $pusat = User::where(['username'=>'pusat'])->first();
            if($pusat)
            {
                $sender = $pusat->username;
            }else{
                $sender = 'null';
            }

            $fields = [ 
                'id'=> $uuid,
                'kriteria_id'=>$kriteria->id,
                'permasalahan'  =>  $request->permasalahan,
                'messages'  =>  $request->messages,
                'from' => Auth::User()->username,
                'sender'=> $sender,
                'slug'      =>  $slug,
                'status'  =>  'Y',
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
            ];

        }    

       
        return $fields;
   }


    public static function fieldsDataKendalaDetail($kendala_id,$request)
   {
        $uuid = Str::uuid()->toString();

        $access = RequestAuth::Access();
        if($access =="admin" || $access =="pusat")
        {
             $data = Kendala::where('id',$kendala_id)->first();
             if( $data)
             {
                 $sender = $data->from;

             }
           
         }else{

             $pusat = User::where(['username'=>'pusat'])->first();
            if($pusat)
            {
                $sender = $pusat->username;
            }

            
         }


        $fields = [ 
            'id'=> $uuid,
            'kendala_id'=>$kendala_id,
            'from' => Auth::User()->username,
            'sender'=> $sender,
            'messages'  =>  $request->messages,
            'status'  =>  'Y',
            'created_by' => Auth::User()->username,
            'created_at' => date('Y-m-d H:i:s'),
        ];
       
        return $fields;
   }


   

   

  

   

}
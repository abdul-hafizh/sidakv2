<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Http\Request\RequestNotification;
use App\Helpers\GeneralPaginate;
use Auth;

class NotificationApiController extends Controller
{

   
    public function __construct()
    {   
         $this->perPage = GeneralPaginate::limit();
    }

    public function index(Request $request)
    {
        if($_COOKIE['access'] !='admin' && $_COOKIE['access'] !='pusat')
        {
          $query = Notification::where('from','pusat')->Orwhere('from','admin')->orderBy('created_at', 'DESC');
        }else{
         $query = Notification::orderBy('created_at', 'DESC');

        }  
         if($request->per_page !='all')
         {
           $data = $query->paginate($request->per_page);
         }else{   
           $data = $query->get(); 
         }   
        
         $result = RequestNotification::GetDataAll($data,$request->per_page,$request);
         return response()->json($result);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $_res = array();
        $column_search  = array('type');

        $i = 0;
        $query  = Notification::orderBy('id', 'DESC');
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

        $data = $query->paginate($this->perPage);
        $description = $search;
        $_res = RequestNotification::GetDataAll($data, $this->perPage, $request);


        return response()->json($_res);
    }


    public function show(Request $request)
    {
        if($_COOKIE['access'] !='admin' && $_COOKIE['access'] !='pusat')
        {
            $data = Notification::whereIn('from',['admin','pusat'])->orderBy('created_at', 'DESC')->limit(8)->get();
        }else{
            $data = Notification::whereNotIn('from',['admin','pusat'])->orderBy('created_at', 'DESC')->limit(8)->get(); 
        }
        $_res = RequestNotification::GetDataLimit($data);
        return response()->json($_res);

    }

    public function update($id,Request $request)
    {
        $check =  RequestNotification::check($id);
        if($check ==false)
        {

            if($_COOKIE['access'] !='admin' && $_COOKIE['access'] !='pusat')
            {

              $update = Notification::where(['from'=>'pusat','sender'=>Auth::User()->username])->Orwhere(['from'=>'admin','sender'=>Auth::User()->username])->update(['view_from'=>'true','updated_by'=>Auth::User()->username]);
            }else{
               
               $update = Notification::where(['id'=>$id,'sender'=>'pusat'])->update(['view_sender'=>'true','updated_by'=>Auth::User()->username]);
            }   
            return response()->json(['status'=>'success','messages'=>'Update notif success']);
        }else{
             return response()->json(['status'=>'success','messages'=>'Sudah update notif']); 

        }    

    }

    

   

   

    

   


    


    


    


}    
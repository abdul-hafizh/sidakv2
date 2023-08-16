<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemLog;
use App\Http\Request\RequestSystemLog;
use App\Helpers\GeneralPaginate;

class AuditLogApiController extends Controller
{

   
    public function __construct()
    {   
        $this->perPage = GeneralPaginate::limit();
    }

    public function index(Request $request)
    {
      
        $data = SystemLog::groupBy('created_by')->orderBy('created_at', 'DESC')->paginate($this->perPage);
        $_res = RequestSystemLog::GetDataAll($data,$this->perPage,$request);
        return response()->json($_res);

    }

    

   

   

    

    public function search(Request $request){
        $search = $request->search;
        $_res = array();
        $column_search  = array('created_by');

        $i = 0;
        $query  = SystemLog::groupBy('created_by')->orderBy('created_at','DESC');
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
        $description = $search;
        $_res = RequestSystemLog::GetDataAll($Data,$this->perPage,$request);
               
    
        return response()->json($_res);

    }



    


    


    


}    
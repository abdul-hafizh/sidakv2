<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditLog;
use App\Http\Request\RequestAuditLog;
use App\Helpers\GeneralPaginate;

class AuditLogApiController extends Controller
{

   
    public function __construct()
    {   
        
    }

    public function index(Request $request)
    {
         $query = AuditLog::orderBy('created_at', 'DESC');
         if($request->per_page !='all')
         {
           $data = $query->paginate($request->per_page);
         }else{   
           $data = $query->get(); 
         }   
        
         $result = RequestAuditLog::GetDataAll($data,$request->per_page,$request);
         return response()->json($result);
    }


   


    public function search(Request $request)
    {
        $search = $request->search;
        $_res = array();
        $column_search  = array('created_by', 'action');

        $i = 0;
        $query  = AuditLog::orderBy('id', 'DESC');
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

        if($request->per_page !='all')
        {
           $data = $query->paginate($request->per_page);
        }else{   
           $data = $query->get(); 
        } 
        $description = $search;
        $_res = RequestAuditLog::GetDataAll($data, $request->per_page, $request);


        return response()->json($_res);
    }


   




    

    public function deleteSelected(Request $request)
    {
        $messages['messages'] = false;
        foreach ($request->data as $key) {
            $results = AuditLog::where('id', (int)$key)->delete();
        }

        if ($results) {
            $messages['messages'] = true;
        }

        return response()->json($messages);
    }

    public function delete($id)
    {
        $messages['messages'] = false;
        $_res = AuditLog::find($id);

        if (empty($_res)) {
            return response()->json(['messages' => false]);
        }

        $results = $_res->delete();
        if ($results) {
            $messages['messages'] = true;
        }
        return response()->json($messages);
    }

    

   

   


    


    


    


}    
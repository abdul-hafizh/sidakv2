<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestRegency;
use App\Http\Request\Validation\ValidationRegency;
use App\Models\Regencies;
use App\Helpers\GeneralPaginate;
use DB;

class RegencyApiController extends Controller
{


    public function __construct()
    {
        $this->perPage = GeneralPaginate::limit();
    }

    public function index(Request $request)
    {
        $paginate = GeneralPaginate::limit();
        $Data = Regencies::orderBy('created_at', 'DESC')->paginate($paginate);
        $_res = RequestRegency::GetDataAll($Data, $this->perPage, $request);
        return response()->json($_res);
    }


    public function store(Request $request)
    {

        $validation = ValidationRegency::validation($request);
        if ($validation) {
            return response()->json($validation, 400);
        } else {


            $insert = RequestRegency::fieldsData($request);
            //create menu
            $saveData = Regencies::create($insert);
            //result
            return response()->json(['status' => true, 'id' => $saveData, 'message' => 'Insert data sucessfully']);
        }
    }






    public function search(Request $request)
    {
        $search = $request->search;
        $_res = array();
        $column_search  = array('name', 'created_by');

        $i = 0;
        $query  = Regencies::orderBy('id', 'DESC');
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

        $Data = $query->paginate($this->perPage);
        $description = $search;
        $_res = RequestRegency::GetDataAll($Data, $this->perPage, $request, $description);


        return response()->json($_res);
    }






    public function update($id, Request $request)
    {

        $validation = ValidationRegency::validation($request);
        if ($validation) {
            return response()->json($validation, 400);
        } else {

            $update = RequestRegency::fieldsData($request);
            //update account
            $UpdateData = Regencies::where('id', $id)->update($update);
            //result
            return response()->json(['status' => true, 'id' => $UpdateData, 'message' => 'Update data sucessfully']);
        }
    }

    public function deleteSelected(Request $request)
    {
        $messages['messages'] = false;
        foreach ($request->data as $key) {
            $results = Regencies::where('id', (int)$key)->delete();
        }

        if ($results) {
            $messages['messages'] = true;
        }

        return response()->json($messages);
    }

    public function delete($id)
    {
        $messages['messages'] = false;
        $_res = Regencies::find($id);

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

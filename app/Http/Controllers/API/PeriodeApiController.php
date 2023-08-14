<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periode;
use App\Http\Request\RequestPeriode;
use App\Http\Request\Validation\ValidationPeriode;
use App\Helpers\GeneralPaginate;


class PeriodeApiController extends Controller
{


    public function __construct()
    {
        $this->perPage = GeneralPaginate::limit();
    }

    public function index(Request $request)
    {
        $paginate = GeneralPaginate::limit();
        $Data = Periode::orderBy('id', 'DESC')->paginate($paginate);
        $_res = RequestPeriode::GetDataAll($Data,$this->perPage,$request);
        return response()->json($_res);
    }



    public function check(Request $request)
    {
       
        $data =  DB::table('periode')->whereNotIn('slug', DB::table('perencanaan')->select('periode_id')->where('daerah_id',Auth::User()->daerah_id))->select('slug','name')->get();
        
        $periode = RequestPeriode::SelectAll($data); 
        return response()->json($periode);

    }


    public function periode(Request $request)
    {
       
        $data =  DB::table('periode')->whereIn('slug', DB::table('perencanaan')->select('periode_id')->where('daerah_id',Auth::User()->daerah_id))->select('slug','name')->get();
       
        $Data = Periode::orderBy('id', 'DESC')->get();
        $periode = RequestPeriode::SelectAll($Data, $request);
        return response()->json(['status' => true, 'periode' => $periode]);
    }



    public function store(Request $request)
    {

        $validation = ValidationPeriode::validation($request);
        if ($validation != null || $validation != "") {
            return response()->json($validation, 400);
        } else {

            $insert = RequestPeriode::fieldsData($request);
            //create menu
            $saveData = Periode::create($insert);
            //result
            return response()->json(['status' => true, 'id' => $saveData, 'message' => 'Insert data sucessfully']);
        }
    }

    public function update($id, Request $request)
    {

        $validation = ValidationPeriode::validation($request);
        if ($validation != null || $validation != "") {
            return response()->json($validation, 400);
        } else {

            $update = RequestPeriode::fieldsData($request);
            //update account
            $UpdateData = Periode::where('id', $id)->update($update);
            //result
            return response()->json(['status' => true, 'id' => $UpdateData, 'message' => 'Update data sucessfully']);
        }
    }

    
      public function search(Request $request)
    {
        $search = $request->search;
        $_res = array();
        $column_search  = array('name');

        $i = 0;
        $query  = Periode::orderBy('id', 'DESC');
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
        $_res = RequestPeriode::GetDataAll($Data, $this->perPage, $request);


        return response()->json($_res);
    }

    public function deleteSelected(Request $request){
        $messages['messages'] = false;
        foreach($request->data as $key)
        {
            $results = Periode::where('id',(int)$key)->delete();
        }

        if($results){
            $messages['messages'] = true;
        }

        return response()->json($messages);
    
    }
    
    
     public function delete($id){

       $messages['messages'] = false;
        $_res = Periode::find($id);

        if (empty($_res)) {
            return response()->json(['messages' => false]);
        }
        $results = $_res->delete();
        if ($results) {
            $messages['messages'] = true;
        }
        return response()->json($messages);
    }



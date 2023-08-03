<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;

class ValidationPages
{
    public static function validation($request){
        $err = array(); 
        
        $fields = [
            'name'  => 'Name',
            'role_id'  => 'Role',
            'foldername'=>'Foldername',
            'filename'=>'Filename',
            'type'=>'Type',
            'table_name'=>'Table Name',
            'order_by'=>'Order By',
            'label_list'=>'Label & Column',
            'action_list'=>'Action List',
            'limit_table'=>'Limit Table',
            'path_api'=>'Path API',
            'search' =>'Search',
            'paginate'=>'Paginate',

        ];

        $validator =  Validator::make($request->all(), 
        [
            'name'  => 'required|max:255',
            'role_id'  => 'required',
            'foldername'  => 'required',
            'filename'  => 'required',
            'type'  => 'required',
            'table_name'=>'required',
            'order_by' =>'required_if:type,table',
            'label_list'=>'required',
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

            if($errors->has('role_id')){
                $err['messages']['role_id'] = $errors->first('role_id');
            }

            if($errors->has('foldername')){
                $err['messages']['foldername'] = $errors->first('foldername');
            }

            if($errors->has('filename')){
                $err['messages']['filename'] = $errors->first('filename');
            }

            if($errors->has('type')){
                $err['messages']['type'] = $errors->first('type');
            }

            if($errors->has('table_name')){
                $err['messages']['table_name'] = $errors->first('table_name');
            }

            if($errors->has('order_by')){
                $err['messages']['order_by'] = $errors->first('order_by');
            }

            if($errors->has('label_list')){
                $err['messages']['label_list'] = $errors->first('label_list');
            }
            

            return $err;
       }
    }


   
}

<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use Auth;

class ValidationUser
{
    public static function validationInsert($request){
        $err = array(); 
        
        $fields = [
            'username'  => 'Username',
            'name'  => 'Nama',
            'email'  => 'Email',
            'phone'  => 'No Telp',
            'nip'  => 'NIP',
            'leader_name'  => 'Penanggung Jawab',
            'leader_nip'=>'NIP Penanggung Jawab',
            'daerah_id'  => 'Daerah',
            'role_id'  => 'Role',
            'password'  => 'Password',
            'password_confirmation'  => 'Password Konfirmasi',
        ];

        $validator =  Validator::make($request->all(), 
        [
            'username'  => 'required|unique:users|max:255',
            'name'  => 'required',
            'email'  => 'required|email|unique:users',
            'phone' => 'required|unique:users,phone',
            'nip' => 'required|unique:users,nip',
            'leader_name'  => 'required',
            'leader_nip'  => 'required',
            'role_id'  => 'required|required_if:role_id,admin,pusat',
            'daerah_id'  => 'required_if:role_id,daerah,province',
            'password'  => 'required|confirmed|min:6',
            'password_confirmation'  => 'required',
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
            if($errors->has('username')){
                $err['messages']['username'] = $errors->first('username');
            }

            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

            if($errors->has('email')){
                $err['messages']['email'] = $errors->first('email');
            }

            if($errors->has('phone')){
                $err['messages']['phone'] = $errors->first('phone');
            }

            if($errors->has('nip')){
                $err['messages']['nip'] = $errors->first('nip');
            }

            if($errors->has('leader_name')){
                $err['messages']['leader_name'] = $errors->first('leader_name');
            }

            if($errors->has('leader_nip')){
                $err['messages']['leader_nip'] = $errors->first('leader_nip');
            }
            
            if($errors->has('daerah_id')){
                $err['messages']['daerah_id'] = $errors->first('daerah_id');
            }

            if($errors->has('role_id')){
                $err['messages']['role_id'] = $errors->first('role_id');
            }
            
            if($errors->has('password')){
                $err['messages']['password'] = $errors->first('password');
            }

            if($errors->has('password_confirmation')){
                $err['messages']['password_confirmation'] = $errors->first('password_confirmation');
            } 
            return $err;
       }
    }


      public static function validationUpdate($request,$id){
        $err = array(); 
        
        $fields = [
           
            'name'  => 'Nama',
            'email'  => 'Email',
            'phone'  => 'No Telp',
            'nip'  => 'NIP',
            'leader_name'  => 'Penanggung Jawab',
            'leader_nip'=>'NIP Penanggung Jawab',
            'daerah_id'  => 'Daerah',
            'role_id'  => 'Role',
        ];



         $validator =  Validator::make($request->all(), 
         [
            
            'name'  => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'phone' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'nip' => [
                'required',
                Rule::unique('users')->ignore($id),
            ], 
            'leader_name'  => 'required',
            'leader_nip'  => 'required',
            'role_id'  => 'required|required_if:role_id,admin,pusat',
            'daerah_id'  => 'required_if:role_id,daerah,province',
            'password'  => 'required|confirmed|min:6',
            'password_confirmation'  => 'required',
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
            if($errors->has('username')){
                $err['messages']['username'] = $errors->first('username');
            }

            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

            if($errors->has('email')){
                $err['messages']['email'] = $errors->first('email');
            }

            if($errors->has('phone')){
                $err['messages']['phone'] = $errors->first('phone');
            }

            if($errors->has('nip')){
                $err['messages']['nip'] = $errors->first('nip');
            }

            if($errors->has('leader_name')){
                $err['messages']['leader_name'] = $errors->first('leader_name');
            }

            if($errors->has('leader_nip')){
                $err['messages']['leader_nip'] = $errors->first('leader_nip');
            }
            
            if($errors->has('daerah_id')){
                $err['messages']['daerah_id'] = $errors->first('daerah_id');
            }

            if($errors->has('role_id')){
                $err['messages']['role_id'] = $errors->first('role_id');
            }

            return $err;
       }
    }


     public static function validationProfile($request){
        $err = array(); 
        
        $fields = [
           
            'name'  => 'Nama',
            'email'  => 'Email',
            'phone'  => 'No Telp',
            'nip'  => 'NIP',
            'leader_name'  => 'Penanggung Jawab',
            'leader_nip'=>'NIP Penanggung Jawab',
           
        ];

        $validator =  Validator::make($request->all(), 
        [
            
            'name'  => 'required',
            'email'  => 'required',
            'phone'  => 'required',
            'nip'  => 'required',
            'leader_name'  => 'required',
            'leader_nip'  => 'required',
            
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
            
            if($errors->has('username')){
                $err['messages']['username'] = $errors->first('username');
            }

            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

            if($errors->has('email')){
                $err['messages']['email'] = $errors->first('email');
            }

            if($errors->has('phone')){
                $err['messages']['phone'] = $errors->first('phone');
            }

            if($errors->has('nip')){
                $err['messages']['nip'] = $errors->first('nip');
            }

            if($errors->has('leader_name')){
                $err['messages']['leader_name'] = $errors->first('leader_name');
            }

            if($errors->has('leader_nip')){
                $err['messages']['leader_nip'] = $errors->first('leader_nip');
            }
            
          

            return $err;
       }
    }


    public static function ValidateAttribut($request){

         $err = array();
            $tmp_email = User::where('email',$request->email)->first();
            if($tmp_email)
            {
                if($tmp_email->email != $request->temp_email)
                {
                    $err['messages']['email'] = 'Emaile sudah pernah dibuat.';   
                }    

            } 


            $tmp_phone = User::where('phone',$request->phone)->first();
            if($tmp_phone)
            {
                if($tmp_phone->phone != $request->temp_phone)
                {
                    $err['messages']['phone'] = 'No Telpe sudah pernah dibuat.';   
                }    

            }   

            $tmp_nip = User::where('phone',$request->nip)->first();
            if($tmp_nip)
            {
                if($tmp_nip->nip != $request->temp_nip)
                {
                    $err['messages']['nip'] = 'NIPe sudah pernah dibuat.';   
                }    

            }  

            return $err; 

    }

    


   
}

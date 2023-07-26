<?php

namespace App\Http\Repositories\Import;
use Auth;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Admin;
use App\Models\RoleUser;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeacherImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
     public function model(array $row)
     {
        
         $admin = Admin::select('first_name','last_name')->where('user_id',Auth::User()->id)->first();
         $fullname = $admin->first_name.' '.$admin->last_name;
        
         $user = User::create([
             'username'  => $row['kodeidentitas'],
             'email' => $row['email'],
             'password'=> bcrypt($row['kodeidentitas']),
             'phone' =>  $row['telp'],
             'status' => 'A',
             'created_by' =>$fullname, 
         ]);
         
        $status = $this->Status($row['status']);
        $jK = $this->CheckGender($row['jeniskelamin']);
        $Lahir =  $this->Brithday($row['tanggallahir']);

        Teacher::create([
            'user_id'=>$user->id,
            'first_name'=> $row['namadepan'],
            'last_name' => $row['namabelakang'],
            'status'=>$status,
            'address'=>$row['alamat'],
            'gender'=>$jK,
            'brithday'=> $Lahir,
          ]);

        RoleUser::create(['user_id'=>$user->id,'role_id'=>3]);

     }

    

    public function CheckGender($gender)
    {

         if($gender =="Laki-laki" || $gender =="Laki - laki" || $gender =="laki-laki"  || $gender =="Laki-Laki" || $gender =="Laki - Laki" || $gender =="laki - laki")
         {
            $jK = "L";
         }else if($gender =="Perempuan"  || $gender =="perempuan" ){
           $jK = "P";
         }else{
           $jK = "";
         }

         return $jK;   

    }

    public function Status($statusAction)
    {
        if($statusAction =="Honorer")
        {
          $status = "H";
        }else if($statusAction =="Tetap"){
           $status = "T";
        }else if($statusAction =="Magang"){
           $status = "M";
        }else{
          $status = "";  
        }

        return $status;    
    }

    public function Brithday($dates){

        $dateSplit =  $this->transformDate($dates);
         if($dateSplit)
         {
            $exp = explode(' ',$dateSplit);
            $Lahir = $exp[0];
         }else{
            $Lahir = "";
         }

         return $Lahir; 

    }


    public function headingRow(): int
    {
        return 3;
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }


}


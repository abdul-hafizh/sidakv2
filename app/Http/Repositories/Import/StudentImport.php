<?php

namespace App\Http\Repositories\Import;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\ProgramStudy;
use App\Models\Generation;
use App\Models\ClassRoom;
use App\Models\Academic;
use App\Models\Semester;
use App\Models\RoleUser;
use App\Models\Student;
use App\Models\Admin;
use App\Models\User;
use Auth;




class StudentImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
     use Importable;
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
        $ClassID = $this->CheckClass($row['kelas']);
        $Semester = $this->CheckSemester($row['semester']);
        $Academic = $this->CheckAcademic($row['tahunakademik']);
        $Prodi = $this->CheckProdi($row['programstudi']);
        $Generation = $this->CheckGeneration($row['angkatan']);

        Student::create([
            'user_id'=>$user->id,
            'first_name'=> $row['namadepan'],
            'last_name' => $row['namabelakang'],
            'class_id' => $ClassID,
            'semester_id'=> $Semester,
            'academic_id'=> $Academic,
            'prodi_id'=> $Prodi,
            'generation_id'=> $Generation,
            'status'=>$status,
            'address'=>$row['alamat'],
            'gender'=>$jK,
            'brithday'=> $Lahir,
        ]);

        RoleUser::create(['user_id'=>$user->id,'role_id'=>4]);

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
        if($statusAction =="Aktif")
        {
          $status = "A";
        }else if($statusAction =="Cuti"){
           $status = "C";
        }else if($statusAction =="DropOut"){
           $status = "DO";
         }else if($statusAction =="MengundurkanDiri"){
           $status = "MD";   
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

    public function CheckClass($search){
        $Data = ClassRoom::where('name','LIKE','%'.$search.'%')->first();
        if($Data)
        {
             $result = $Data->id;
        }else{
            $result = 1;
        }   

        return $result;  

    }

    public function CheckSemester($search){
        $Data = Semester::where('name','LIKE','%'.$search.'%')->first();
        if($Data)
        {
             $result = $Data->id;
        }else{
            $result = 1;
        }    

        return $result;  

    }


     public function CheckAcademic($search){
        $Data = Academic::where('name','LIKE','%'.$search.'%')->first();
        if($Data)
        {
             $result = $Data->id;
        }else{
            $result = 1;
        }    

        return $result;  

    }

    public function CheckProdi($search){
        $Data = ProgramStudy::where('name','LIKE','%'.$search.'%')->first();
        if($Data)
        {
             $result = $Data->id;
        }else{
            $result = 1;
        }    

        return $result;  

    }

    public function CheckGeneration($search){
        $Data = Generation::where('name','LIKE',''.$search.'%')->first();
        if($Data)
        {
             $result = $Data->id;
        }else{
            $result = 1;
        }   

        return $result;   

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


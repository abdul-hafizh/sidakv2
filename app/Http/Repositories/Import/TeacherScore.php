<?php

namespace App\Http\Repositories\Import;
use Auth;
use App\Models\Teacher;
use App\Models\StudyPlans;
use App\Http\Request\RequestTeacherScoring;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\ScoringDetail;
use App\Models\CategoryScore;

class TeacherScore implements ToModel,WithHeadingRow,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   
     protected $subject_id;
     protected $category_id;
     protected $semester_id;
     protected $class_id;
     protected $academic_id;
     protected $data;
     

     function __construct($subject_id,$category_id,$semester_id,$class_id,$academic_id,$data) {
           
            $this->subject_id = $subject_id;
            $this->category_id = $category_id;
            $this->semester_id = $semester_id;
            $this->class_id = $class_id;
            $this->academic_id = $academic_id;
            $this->data = $data;
           
     }

     public function model(array $row)
     {
        
        if($this->data ==true)
        { 
        
            $teacher = Teacher::where('user_id', Auth::User()->id)->first();
            $fullname = $teacher->first_name.' '.$teacher->last_name;
           
            
            
            $category_id =  CategoryScore::where('slug',$this->category_id)->first()->id;
            if($this->category_id =="nilai-teori")
            {
                $arr1 = array('teacher_id'=>$teacher->id,'student_id'=>$row["kodemahasiswa"],'subject_id'=>$this->subject_id,'category_score_id'=> $category_id,'academic_id'=>$this->academic_id,'semester_id'=>$this->semester_id,'class_id'=>$this->class_id);

                $arr2 = array('score_attendance'=> $row["presensi"],'score_task'=>$row["tugas"],'score_mid'=>$row["uts"],'score_uas'=> $row["uas"],'score_demonstration'=>0,'score_independent'=>0,'score_evaluation'=>0,'score_dops'=>0,'score_conference'=>0,'score_percentage_of_cases'=>0);

                $arr = array_merge($arr1,$arr2);
                $request =  RequestTeacherScoring::convertArr($arr);

                $teori = RequestTeacherScoring::SearchTeori($request);
                $scoreTeori = $teori;
                $scorePraktikum = 0;
                $scoreKlinik = 0;
                $score = $scoreTeori;
                $score_conversi = RequestTeacherScoring::Conversi($teori);
            }


             if($this->category_id =="nilai-teori-praktek")
            { 
                $arr1 = array('teacher_id'=>$teacher->id,'student_id'=>$row["kodemahasiswa"],'subject_id'=>$this->subject_id,'category_score_id'=> $category_id,'academic_id'=>$this->academic_id,'semester_id'=>$this->semester_id,'class_id'=>$this->class_id);

                $arr2 = array('score_attendance'=> $row["presensi"],'score_task'=>$row["tugas"],'score_mid'=>$row["uts"],'score_uas'=> $row["uas"],'score_demonstration'=>$row["demonstrasi"],'score_independent'=>$row["mandiri"],'score_evaluation'=>$row["evaluasi"],'score_dops'=>0,'score_conference'=>0,'score_percentage_of_cases'=>0);
                $arr = array_merge($arr1,$arr2);

                $request =  RequestTeacherScoring::convertArr($arr);
                
                //$total_sks = StudyPlans::where('teacher_id',$teacher->id)->sum('total_sks');
                $total_sks = 5;
                $teori = RequestTeacherScoring::SearchTeori($request); 
                $praktikum = RequestTeacherScoring::SearchPraktikum($request);
                $formula = RequestTeacherScoring::RequestFormula('teori-praktikum');   

                $scoreTeori = $teori *  $formula->tatap_muka;
                $scorePraktikum = $praktikum *  $formula->praktikum;
                $scoreKlinik = 0;

                $score = ($scoreTeori + $scorePraktikum) / $total_sks;
                $score_conversi = RequestTeacherScoring::Conversi($score);

            }


            if($this->category_id =="nilai-teori-praktek-klinik")
            { 
                  $arr1 = array('teacher_id'=>$teacher->id,'student_id'=>$row["kodemahasiswa"],'subject_id'=>$this->subject_id,'category_score_id'=> $category_id,'academic_id'=>$this->academic_id,'semester_id'=>$this->semester_id,'class_id'=>$this->class_id);

                  $arr2 = array('score_attendance'=> $row["presensi"],'score_task'=>$row["tugas"],'score_mid'=>$row["uts"],'score_uas'=> $row["uas"],'score_demonstration'=>$row["demonstrasi"],'score_independent'=>$row["mandiri"],'score_evaluation'=>$row["evaluasi"],'score_dops'=>$row["dops"],'score_conference'=>$row["conference"],'score_percentage_of_cases'=>$row["kasus"]);

                  $arr = array_merge($arr1,$arr2);

                  $request =  RequestTeacherScoring::convertArr($arr);

                  //$total_sks = StudyPlans::where('teacher_id',$teacher->id)->sum('total_sks');
                  $total_sks = 5;

                  $teori = RequestTeacherScoring::SearchTeori($request); 
                  $praktikum = RequestTeacherScoring::SearchPraktikum($request);
                  $klinik =  RequestTeacherScoring::SearchKlinik($request); 
                  

                  $formula = RequestTeacherScoring::RequestFormula('teori-praktikum-klinik');
                  $scoreTeori = $teori * $formula->tatap_muka;
                  $scorePraktikum = $praktikum * $formula->praktikum;
                  $scoreKlinik = $klinik * $formula->klinik;

                  $score =  ($scoreTeori  + $scorePraktikum + $scoreKlinik) /  $total_sks;
                  $score_conversi = RequestTeacherScoring::Conversi($score);
            }

            if($this->category_id =="nilai-klinik")
            { 

                  $arr1 = array('teacher_id'=>$teacher->id,'student_id'=>$row["kodemahasiswa"],'subject_id'=>$this->subject_id,'category_score_id'=> $category_id,'academic_id'=>$this->academic_id,'semester_id'=>$this->semester_id,'class_id'=>$this->class_id);

                  $arr2 = array('score_attendance'=> 0,'score_task'=>0,'score_mid'=>0,'score_uas'=>0,'score_demonstration'=>0,'score_independent'=>0,'score_evaluation'=>0,'score_dops'=>$row["dops"],'score_conference'=>$row["conference"],'score_percentage_of_cases'=>$row["kasus"]);

                  $arr = array_merge($arr1,$arr2);
               
                  $request =  RequestTeacherScoring::convertArr($arr);
                  $klinik =  RequestTeacherScoring::SearchKlinik($request); 
                  $scoreTeori = 0;
                  $scorePraktikum = 0;
                  $scoreKlinik = $klinik;
                  $score = $scoreKlinik;
                  $score_conversi = RequestTeacherScoring::Conversi($score);
           
            }


       


         $user = ScoringDetail::create([
             'teacher_id' =>$request->teacher_id,
             'student_id' =>$request->student_id,
             'subject_id' =>$request->subject_id,
             'category_score_id' =>$request->category_score_id,
             'academic_id'=>$request->academic_id,
             'semester_id'=>$request->semester_id,
             'class_id'=>$request->class_id,
             'score_uas'  => $request->score_uas,
             'score_mid' => $request->score_mid,
             'score_task'=> $request->score_task,
             'score_attendance' => $request->score_attendance,
             
             'score_demonstration' => $request->score_demonstration,
             'score_independent'=> $request->score_independent,
             'score_evaluation' => $request->score_evaluation,

             'score_dops' => $request->score_dops,
             'score_conference'=> $request->score_conference,
             'score_percentage_of_cases' => $request->score_percentage_of_cases,  


             'score_teory' => $score,
             'score_practicum' => $scorePraktikum,
             'score_clinic' => $scoreKlinik,
             'result_score' =>$score_conversi, 
             'total_score'=>$score,
             'created_by' => $fullname,
             'status' =>'P'
         ]);
        }

     }

    public function rules(): array
    {

        if($this->category_id =="nilai-teori-praktek")
        {
                return  [
                    'demonstrasi' => 'required',
                    'mandiri' => 'required',
                    'evaluasi' => 'required',
                ];

        }else if($this->category_id =="nilai-teori-praktek-klinik"){
                return  [
                    'demonstrasi' => 'required',
                    'mandiri' => 'required',
                    'evaluasi' => 'required',
                    'dops' =>'required',
                    'conference' =>'required',
                    'kasus' =>'required',
                ];

        }else if($this->category_id =="nilai-klinik"){
                return  [
                    'dops' =>'required',
                    'conference' =>'required',
                    'kasus' =>'required',
                ];

        }else{
           return  []; 
        }   



        
   }

    
     public function headingRow(): int
    {
        return 3;
    }

  
   


}


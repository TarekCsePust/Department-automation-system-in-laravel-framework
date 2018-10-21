<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Semester;
use App\Course;
use App\ExamDate;
use App\ExamSchedule;
use App\ExamDuty;
use DB;
use Auth;
use App\User;
use App\SemesterDetail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function login()
    {
        if (Auth::check()) {
            
            return redirect('/index');
        }
        else
        {
            return view('auth.login');
        }
    }
    public function index()
    {
       /*$details = SemesterDetail::get()->where('resultPublish','0');
        $examDates = array(); 
       foreach($details as $detail)
       {
              $exam = ExamDate::get()->where('sessionId',$detail->sessionId)->where('semesterId',$detail->semesterId)->first();
              if($exam){
               $session = Session::find($exam->sessionId);
            $semester = Semester::find($exam->semesterId);

            if(!$session || !$semester)
            {
                $exm = ExamDate::find($exam->id);
           
                 DB::table('exam_schedules')->where('examDateId',$exam->id)->delete();
                $exm->delete();
            }
            else
            {
                 array_push($examDates,[
                "id"=>$exam->id,
                "session"=>$session->session,
                "semester"=>$semester->semester,
                "startingDate"=>$exam->startingDate,
                "endingDate"=>$exam->endingDate,
                "examType" => $exam->examType
                ]);
            }

        }

       }*/
        $exams = ExamDate::get();
        //$examDetails =  DB::table('exam_schedules')->where('sessionAssignCourseId',$id)->get();
       
        $examDates = array(); 
        foreach($exams as $exam)
        {

            $details = SemesterDetail::get()->where('resultPublish','1')->where('sessionId',$exam->sessionId)->where('semesterId',$exam->semesterId);
            if(!count($details)){
            $session = Session::find($exam->sessionId);
            $semester = Semester::find($exam->semesterId);

            if(!$session || !$semester)
            {
                $exm = ExamDate::find($exam->id);
           
                 DB::table('exam_schedules')->where('examDateId',$exam->id)->delete();
                $exm->delete();
            }
            else
            {
                 array_push($examDates,[
                "id"=>$exam->id,
                "session"=>$session->session,
                "semester"=>$semester->semester,
                "startingDate"=>$exam->startingDate,
                "endingDate"=>$exam->endingDate,
                "examType" => $exam->examType
                ]);
            }

            

        }
    }
       // return $examDates;
        return view('index',compact('examDates'));
    }


    public function getExamDetails($id)
    {
       // return $id;
        $schedules =  DB::table('exam_schedules')->where('examDateId',$id)->get();
        //return $schedules;

       $examDetails = array();

        foreach($schedules as  $schedule)
        {   $dutys = ExamDuty::get()->where('examScheduleId',$schedule->id);
            $teachers="";
            $cm = 0;
            foreach($dutys as $duty)
            {
                $tech = User::find($duty->teacherId);
                if($cm==0)
                {
                    $teachers=$teachers.$tech->name;
                    $cm++;
                }
                else
                {
                     $teachers=$teachers.", ".$tech->name;
                }
               
               
            }
            
         
            
            $course = Course::find($schedule->courseId);
            if(!$course)
            {
                 DB::table('exam_schedules')->where('courseId',$schedule->courseId)->delete();
                 continue;
            }
             array_push($examDetails,[
                "id"=>$schedule->id,
                "date"=>$schedule->date,
                "time"=>$schedule->time,
                "course_code"=>$course->courseCode,
                "course_title"=>$course->courseTitle,
                "teacher" =>$teachers
               
                ]);

        }
        return view('examDetails',compact('examDetails'));
    }
    

}

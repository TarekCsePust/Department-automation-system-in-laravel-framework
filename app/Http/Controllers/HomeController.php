<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Semester;
use App\Course;
use App\ExamDate;
use App\ExamSchedule;
use DB;
use Auth;

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
        $exams = ExamDate::get();
        //$examDetails =  DB::table('exam_schedules')->where('sessionAssignCourseId',$id)->get();
       
        $examDates = array(); 
        foreach($exams as $exam)
        {
            $session = Session::find($exam->sessionId);
            $semester = Semester::find($exam->semesterId);

             array_push($examDates,[
                "id"=>$exam->id,
                "session"=>$session->session,
                "semester"=>$semester->semester,
                "startingDate"=>$exam->startingDate,
                "endingDate"=>$exam->endingDate,
                "examType" => $exam->examType
                ]);

        }
       // return $examDates;
        return view('index',compact('examDates'));
    }


    public function getExamDetails($id)
    {
       // return $id;
        $schedules =  DB::table('exam_schedules')->where('examDateId',$id)->get();
       $examDetails = array();
        foreach($schedules as  $schedule)
        {
            $course = Course::find($schedule->courseId);
             array_push($examDetails,[
                "id"=>$schedule->id,
                "date"=>$schedule->date,
                "time"=>$schedule->time,
                "course_code"=>$course->courseCode,
                "course_title"=>$course->courseTitle
               
                ]);

        }
        return view('examDetails',compact('examDetails'));
    }
    

}

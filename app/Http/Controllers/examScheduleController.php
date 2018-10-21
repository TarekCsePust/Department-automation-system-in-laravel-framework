<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Semester;
use App\Course;
use App\ExamDate;
use App\ExamSchedule;
use DB;
use App\User;
use App\ExamDuty;

class examScheduleController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function entryExamDate()
    {
    	$sessions = Session::get();
    	$semesters = Semester::get();
    	$lavCourses = Course::get()->where('TheoryLab', '0');
      $thCourses = Course::get()->where('TheoryLab', '1');
      $teachers = User::get()->where('position','Teacher');

    	return view('entryExamSchedule',compact('sessions','semesters','thCourses','lavCourses','teachers'));
    }

    public function insertExamDate(Request $request)
    {
        $this->validate($request, [
        'session' => 'required',
        'semester' => 'required',
        'startingDate' => 'required',
        'endingDate' => 'required',
        'ExamType' => 'required',
        'noExam' => 'required',
        'date' => 'required',
        'time' => 'required',
        'course' => 'required',
        'duty' => 'required',
      

        ]);

        $examSchedule = new ExamSchedule;
        $date = strtotime($request->endingDate);
        $day   = date('d',$date);
        $month = date('m',$date);
        $year  = date('Y',$date);
        $endTime = $day."-".$month."-".$year;

        $date = strtotime($request->startingDate);
        $day   = date('d',$date);
        $month = date('m',$date);
        $year  = date('Y',$date);
        $startTime = $day."-".$month."-".$year;
        //return $request->duty;
        //return $startTime;
        $id = DB::table('exam_dates')->insertGetId(
         ['sessionId' =>$request->session, 'semesterId' =>$request->semester,'startingDate'=>$startTime,'endingDate'=>$endTime,
         'examType'=>$request->ExamType]
        );

        $dates = $request->date;
        $times = $request->time;
        $courses = $request->course;
        $dutys = $request->duty;
        //return $dutys;
        for($i=0;$i<count($dates);$i++)
        {    //$examduty = new ExamDuty;
             //$examSchedule = new ExamSchedule;
             //$examSchedule->examDateId=$id;
              $date = strtotime($dates[$i]);
              $day   = date('d',$date);
              $month = date('m',$date);
              $year  = date('Y',$date);
              $date = $day."-".$month."-".$year;

             //$examSchedule->date = $date;
             //$examSchedule->time = $times[$i];
             //$examSchedule->courseId = $courses[$i];

              $examid = DB::table('exam_schedules')->insertGetId(
         ['examDateId' =>$id, 'date' =>$date,'time'=>$times[$i],'courseId'=>$courses[$i]]
        );

            
            
            
              for($j=0;$j<count($dutys[$i]);$j++)
              {  
                   if($dutys[$i][$j]){
                   $examduty = new ExamDuty;
                   $examduty->teacherId = $dutys[$i][$j];
                   $examduty->examScheduleId = $examid;
                   $examduty->save();
                 }
              }
            
            //$examduty->teacherId = $dutys[$i];
              
            // $examSchedule->save();
        }
       

      

    	return redirect('/index');
    }


    public function deleteExamDetail(Request $request)
    {
       $exam = ExamDate::find($request->id);
       //return $exam;
       DB::table('exam_schedules')->where('examDateId',$request->id)->delete();
       $exam->delete();
       return redirect('/index');
    }
}

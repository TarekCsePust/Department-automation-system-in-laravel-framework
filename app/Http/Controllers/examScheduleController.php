<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Semester;
use App\Course;
use App\ExamDate;
use App\ExamSchedule;
use DB;

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
    	$courses = Course::get();
    	return view('entryExamSchedule',compact('sessions','semesters','courses'));
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

        //return $startTime;
        $id = DB::table('exam_dates')->insertGetId(
         ['sessionId' =>$request->session, 'semesterId' =>$request->semester,'startingDate'=>$startTime,'endingDate'=>$endTime,
         'examType'=>$request->ExamType]
        );

        $dates = $request->date;
        $times = $request->time;
        $courses = $request->course;
        for($i=0;$i<count($dates);$i++)
        {
             $examSchedule = new ExamSchedule;
             $examSchedule->examDateId=$id;
              $date = strtotime($dates[$i]);
              $day   = date('d',$date);
              $month = date('m',$date);
              $year  = date('Y',$date);
              $date = $day."-".$month."-".$year;

             $examSchedule->date = $date;
             $examSchedule->time = $times[$i];
             $examSchedule->courseId = $courses[$i];
             $examSchedule->save();
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

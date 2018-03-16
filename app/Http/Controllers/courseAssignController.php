<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Course;
use App\User;
use App\Session_assign_course;
use App\Course_assign_teacher;
use App\Semester;
use DB;

class courseAssignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	$sessions = Session::get();
    	$courses = Course::get();
        $semesters = Semester::get();
    	return view('courseAssign',compact('sessions','courses','semesters'));
    }

    public function assignSemesterCourses(Request $request)
    {
    	$this->validate($request, [
        'session' => 'required',
        'semester' => 'required',
        'course' => 'required',
    	]);
    
    	
        $session = $request->input('session');
        $semester = $request->input('semester');
        $id = DB::table('session_assign_courses')->insertGetId(
     	 ['sessionId' =>$session, 'semesterId' =>$semester]
    	);

        $courses = $request->input('course');

    	for($i=0;$i<count($courses);$i++)
    	{
    		$assignTeacher = new Course_assign_teacher;
    		$assignTeacher->courseId=$courses[$i];
    		$assignTeacher->sessionAssignCourseId=$id;
    		$assignTeacher->save();
    	}
      
       
    	return redirect('courseAssign');
    }


    public function getAllAssignSession()
    {
        $assigns = Session_assign_course::get();

        $sessionAssigns= array();
        foreach($assigns as $assign)
        {

         $session = Session::find($assign->sessionId);
         $semester = Semester::find($assign->semesterId);

      


         array_push($sessionAssigns,[
                "id"=>$assign->id,
                "session"=>$session->session,
                "semester"=>$semester->semester
                ]);


        }


        return view('courseAssignDetails',compact('sessionAssigns'));
    }


    public function findAssignSession($id)
    {
        $sessions = Session::get();
        $semesters = Semester::get();
        $assign = Session_assign_course::find($id);

        return view('assignSessionEdit',compact('sessions','assign','semesters'));
    }

    public function assignChange(Request $request)
    {
        $this->validate($request, [
        'session' => 'required',
        'semester' => 'required',
       
        ]);
    
        $assign = Session_assign_course::find($request->id);
        $assign->session = $request->input('session');
        $assign->semester=$request->input('semester');
        $assign->save();
        return redirect('courseAssignDetails');
    }

    public function assignDelete(Request $request)
    {
        $assign =  Session_assign_course::find($request->id);
        $courses =  DB::table('course_assign_teachers')->where('sessionAssignCourseId',$request->id)->delete();
        $assign->delete();
        return redirect('courseAssignDetails');
    }


    public function getCourseTeacher($id)
    {
       
         $coursesDetails =  DB::table('course_assign_teachers')->where('sessionAssignCourseId',$id)->get();

         $coursesTeachers = array();
         foreach($coursesDetails as $courseDetails)
         {
           $course = Course::find($courseDetails->courseId);
           
            if($course)
            {
                $internal = "Null";
                if($courseDetails->internalTeacherId!=0)
                {
                  $user = User::find($courseDetails->internalTeacherId);
                  
                  $internal = $user->name;

                }
               

               


                if($courseDetails->externalTeacherId==0)
                {
                   $external = "Null";
                }
                else
                {
                    $user = User::find($courseDetails->externalTeacherId);
                    $external = $user->name;
                }

                 array_push($coursesTeachers,[
                "id"=>$courseDetails->id,
                "courseCode"=>$course->courseCode,
                "courseTitle"=>$course->courseTitle,
                "internal"=>$internal,
                "external"=>$external,
                 "IQS"=>$courseDetails->IQS,
                 "EQS"=>$courseDetails->EQS,
                 "IQA"=>$courseDetails->IQA,
                 "EQA"=>$courseDetails->EQA
                ]);

            }
            
         }
        
        


        // $data[]
         return  view('courseTeacherTracking',compact('coursesTeachers')); 
    }


    public function insertCourseTeacher(Request $request)
    {
        $course = Course_assign_teacher::find($request->id);
        $course->internalTeacherId = $request->input('internal');
        $course->externalTeacherId = $request->input('external');


        $iqs=  $request->input('IQS');
        $eqs = $request->input('EQS');
        $iqa = $request->input('IQA');
        $eqa = $request->input('EQA');

        if($iqs)
        {
             $course->IQS=$iqs;
        }
        else
        {
            $course->IQS="No";
        }

        if($eqs)
        {
            $course->EQS=$eqs;
        }
        else
        {
            $course->EQS="No";
        }

        if($iqa)
        {
            $course->IQA="Yes";
        }
        else
        {
            $course->IQA="No";
        }

        if($eqa)
        {
             $course->EQA="Yes";
        }
        else
        {
            $course->EQA="No";
        }

       
        $course->save();
         return redirect('courseAssignDetails');
    }


    public function assignTeacher($id)
    {
         $course = Course_assign_teacher::find($id);
         $teachers = DB::table('users')->where('position','Teacher')->get();
         return view('assignTeacher',compact('course','teachers'));
    }

    public function insert(Request $request)
    {
        return "donr";
    }
}

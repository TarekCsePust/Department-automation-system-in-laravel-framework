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
use App\SemesterDetail;

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


    $sessionAssigns = $this->getAssign();

    	return view('courseAssign',compact('sessions','courses','semesters','sessionAssigns'));
    }

    public function importCourseAssign(Request $request)
    {
        $fsession = $request->from_session;
        $fsemester = $request->from_semester;
        $tsession = $request->to_session; 
        $tsemester = $request->to_semester;
       // return $request;
        if(($fsemester=="all" && $tsemester!="all")||($fsemester!="all" && $tsemester=="all"))
        {
             $request->session()->flash('msg', 'Your selected semester is wrong.');
              return redirect('courseAssign');
        }
        
        $assigned = $this->isAssigned($tsession,$tsemester);
        if(!$assigned){
        if($fsemester=="all")
        {
          $sacs = Session_assign_course::get()->where('sessionId',$fsession);
          if(count($sacs)){
          foreach($sacs as $sac)
          {
             $cats = Course_assign_teacher::get()->where('sessionAssignCourseId',$sac->id);

               $id = DB::table('session_assign_courses')->insertGetId(
             ['sessionId' =>$tsession, 'semesterId' =>$sac->semesterId]
              );

            foreach($cats as $cat)
            {
                $assignTeacher = new Course_assign_teacher;
                $assignTeacher->courseId=$cat->courseId;
                $assignTeacher->sessionAssignCourseId=$id;
                $assignTeacher->save();
            }

          }
           $request->session()->flash('msg', 'Imported sucessfully.');

      }
      else
      {
        $request->session()->flash('msg', 'Not Imported sucessfully.');
      }

         
        }
        else
        {
            $sac = Session_assign_course::get()->where('sessionId',$fsession)->where('semesterId',$fsemester)->first();
           // return $sac;
             if($sac){
             $id = DB::table('session_assign_courses')->insertGetId(
             ['sessionId' =>$tsession,'semesterId' =>$tsemester]
              );

             $cats = Course_assign_teacher::get()->where('sessionAssignCourseId',$sac->id);


            foreach($cats as $cat)
            {
                $assignTeacher = new Course_assign_teacher;
                $assignTeacher->courseId=$cat->courseId;
                $assignTeacher->sessionAssignCourseId=$id;
                $assignTeacher->save();
            }

            $request->session()->flash('msg', 'Courses assigned sucessfully.');

        }
        else
        {
             $request->session()->flash('msg', 'Courses not assigned sucessfully.');
        }


        }
    }
    else
    {
         $request->session()->flash('msg', 'Courses already assigned.');
    }

      return redirect('courseAssign');

    }


    public function isAssigned($ses, $sem)
    {

        if($sem=="all")
        {
            if(count(Session_assign_course::get()->where('sessionId',$ses)))
                {
                    return true;
                }
        }
        else
        {
           
           

            if(count(Session_assign_course::get()->where('sessionId',$ses)->where('semesterId',$sem)))
                {
                  
                    return true;
                }
        }

        return false;
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
        $assigned = $this->isAssigned($session,$semester);
       
        if(!$assigned){
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

        $request->session()->flash('msg', 'Courses assigned sucessfully.');

    }
    else
    {
        $request->session()->flash('msg', 'Courses already assigned.');
    }
      
       
    	return redirect('courseAssign');
    }


    public function getAllAssignSession()
    {   

        $sessionAssigns = $this->getAssign();
        //return $sessionAssigns;
        /*$details = SemesterDetail::get()->where('resultPublish','0');
        $sessionAssigns= array();
       // return $details;
        foreach($details as $detail)
        {
          $assign = Session_assign_course::get()->where('sessionId',$detail->sessionId)->where('semesterId',$detail->semesterId)->first();
            if($assign)
            {
                 $session = Session::find($assign->sessionId);
         $semester = Semester::find($assign->semesterId);
         //return $assign;
      
         if(!$session || !$semester)
         {
            $sac = Session_assign_course::find($assign->id);
             $courses =  DB::table('course_assign_teachers')->where('sessionAssignCourseId',$assign->id)->delete();
            $sac->delete();
         }
         else
         {
             array_push($sessionAssigns,[
                "id"=>$assign->id,
                "session"=>$session->session,
                "semester"=>$semester->semester
                ]);
         }

            }
          
          //return view('courseAssignDetails',compact('sessionAssigns'));

        }*/
        
      /*  $assigns = Session_assign_course::get();

        $sessionAssigns= array();
        foreach($assigns as $assign)
        {
          $details =  SemesterDetail::get()->where('sessionId',$assign->sessionId)->where('semesterId',$assign->semesterId)->where('resultPublish','1');
          if(!$dtails){
         $session = Session::find($assign->sessionId);
         $semester = Semester::find($assign->semesterId);

      
         if(!$session || !$semester)
         {
            $sac = Session_assign_course::find($assign->id);
             $courses =  DB::table('course_assign_teachers')->where('sessionAssignCourseId',$assign->id)->delete();
            $sac->delete();
         }
         else
         {
             array_push($sessionAssigns,[
                "id"=>$assign->id,
                "session"=>$session->session,
                "semester"=>$semester->semester
                ]);
         }

       


        }
      }*/


        return view('courseAssignDetails',compact('sessionAssigns'));
    }

    public function getAssign()
    {
        /* $details = SemesterDetail::get()->where('resultPublish','0');
        $sessionAssigns= array();
       // return $details;
        foreach($details as $detail)
        {
          $assign = Session_assign_course::get()->where('sessionId',$detail->sessionId)->where('semesterId',$detail->semesterId)->first();
            if($assign)
            {
                 $session = Session::find($assign->sessionId);
         $semester = Semester::find($assign->semesterId);
         //return $assign;
      
         if(!$session || !$semester)
         {
            $sac = Session_assign_course::find($assign->id);
             $courses =  DB::table('course_assign_teachers')->where('sessionAssignCourseId',$assign->id)->delete();
            $sac->delete();
         }
         else
         {
             array_push($sessionAssigns,[
                "id"=>$assign->id,
                "session"=>$session->session,
                "semester"=>$semester->semester
                ]);
         }

            }
          
          //return view('courseAssignDetails',compact('sessionAssigns'));

        }*/


         $assigns = Session_assign_course::get();

        $sessionAssigns= array();
        foreach($assigns as $assign)
        {
          
          $details =  SemesterDetail::get()->where('sessionId',$assign->sessionId)->where('semesterId',$assign->semesterId)->where('resultPublish','1')->first();
          if(!$details){
         $session = Session::find($assign->sessionId);
         $semester = Semester::find($assign->semesterId);

      
         if(!$session || !$semester)
         {
            $sac = Session_assign_course::find($assign->id);
             $courses =  DB::table('course_assign_teachers')->where('sessionAssignCourseId',$assign->id)->delete();
            $sac->delete();
         }
         else
         {
             array_push($sessionAssigns,[
                "id"=>$assign->id,
                "session"=>$session->session,
                "semester"=>$semester->semester
                ]);
         }

       


        }
      }



        return $sessionAssigns;
    }


    public function findAssignSession($id)
    {
        $sessions = Session::get();
        $semesters = Semester::get();
        $allCourse = Course::get();

        $assign = Session_assign_course::find($id);
        $assignCourses = Course_assign_teacher::get()->where('sessionAssignCourseId',$assign->id);
        return view('assignSessionEdit',compact('sessions','assign','semesters','assignCourses','allCourse'));
    }

    public function assignChange(Request $request)
    {
        $this->validate($request, [
        'session' => 'required',
        'semester' => 'required',
       
        ]);

        //return $request;
    
        $assign = Session_assign_course::find($request->id);
        //return $assign;
        $assign->sessionId = $request->input('session');
        $assign->semesterId=$request->input('semester');
        $assign->save();
        DB::table('course_assign_teachers')->where('sessionAssignCourseId',$request->id)->delete();

      $courses = $request->input('course');

      for($i=0;$i<count($courses);$i++)
      {
        $assignTeacher = new Course_assign_teacher;
        $assignTeacher->courseId=$courses[$i];
        $assignTeacher->sessionAssignCourseId=$request->id;
        $assignTeacher->save();
      }


        return redirect('/courseAssign');
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
           
            if($course->TheoryLab)
            {
                $internal = "Null";
                if($courseDetails->internalTeacherId!=0)
                {
                  $user = User::find($courseDetails->internalTeacherId);
                  if(!$user)
                  {
                      DB::table('course_assign_teachers')->where('internalTeacherId',$courseDetails->internalTeacherId)->delete();
                      continue;
                  }

                 $internal = $user->name;

                }
               

               


                if($courseDetails->externalTeacherId==0)
                {
                   $external = "Null";
                }
                else
                {
                    $user = User::find($courseDetails->externalTeacherId);
                    if(!$user)
                    {
                      DB::table('course_assign_teachers')->where('externalTeacherId',$courseDetails->externalTeacherId)->delete();
                      continue;
                    }

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
            /*else
            {
                 DB::table('course_assign_teachers')->where('courseId',$courseDetails->courseId)->delete();
            }*/
            
         }
        
        

         $ctt = $id;
        // $data[]
         return  view('courseTeacherTracking',compact('coursesTeachers','ctt')); 
    }


    public function insertCourseTeacher(Request $request)
    {

        //return $request->courseTeacherTrackingId;
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


    public function assignTeacher(Request $request)
    {
         //return $request->id;
         $course = Course_assign_teacher::find($request->id);
         $teachers = DB::table('users')->where('position','Teacher')->get();
         $cttId = $request->ctt;

         return view('assignTeacher',compact('course','teachers','cttId'));
    }

    public function insert(Request $request)
    {
        return "donr";
    }
}

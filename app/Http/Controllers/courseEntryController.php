<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use DB;
use App\Course_assign_teacher;

class courseEntryController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function InsertToNewCourse(Request $request){

	
    $course = new Course;
	$course->courseCode =strtoupper($request->input('code'));
	$course->courseTitle =strtoupper($request->input('title'));
	$course->TheoryLab = $request->input('type');
	$course->credit = $request->input('credit');

	$courseHave = DB::table('courses')->where([
    'courseCode' => $course->courseCode,
    'courseTitle' => $course->courseTitle
    ])->get();

    if(count($courseHave)==0)
    {
    	$course->save();
    	return "Add sucessfully";
    }
    else
    {
    	return "Add not sucessfully";
    }

	
}




public function getCourses()
{
	$courses =  DB::table('courses')->get();
	return view('courseDetails',compact('courses'));
}



public function findCourse($id)
{
	$course = Course::find($id);

	return view('courseEdit',compact('course'));
}

public function updateCourse(Request $request)
{

	$this->validate($request, [
	    'code' => 'required',
	    'title' => 'required',
	    'type' => 'required',
	    'credit' => 'required',
	    ]);

	$course = Course::find($request->id);
	$course->courseCode =strtoupper($request->input('code'));
	$course->courseTitle =strtoupper($request->input('title'));
	$course->TheoryLab = $request->input('type');
	$course->credit = $request->input('credit');
	$course->save();
	return redirect('/courseDetails');
}

public function deleteCourse(Request $request)
{
	$course = Course::find($request->id);
	 $courseAssign  =  DB::table('course_assign_teachers')->where('courseId',$request->id)->delete();
	$course->delete();
	return redirect('/courseDetails');
}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semester;
use App\Session;
use App\SemesterDetail;

class semesterDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getSemesterDetails()
    {
    	$sessions = Session::get();
    	$semesters = Semester::get();

        $details = SemesterDetail::get();
        $semesterDetails = array();

        foreach($details as $detail)
        {
            $session = Session::find($detail->sessionId);
            $semester = Semester::find($detail->semesterId);


              array_push($semesterDetails,[
                "id"=>$detail->id,
                "session"=>$session->session,
                "semester"=>$semester->semester,
                "startingDate"=>$detail->startingDate,
                "endingDate"=>$detail->endingDate
                ]);

        }
        //return  $semesterDetails;
    	return view('semesterDetails',compact('sessions','semesters','semesterDetails'));
    }

    public function addSemesterDetail(Request $request)
    {
        $this->validate($request, [
        'session' => 'required',
        'semester' => 'required',
        'startingDate' => 'required',
        'endingDate' => 'required',
        ]);
        $semesterDetail = new SemesterDetail;

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

        $semesterDetail->sessionId = $request->session;
        $semesterDetail->semesterId = $request->semester;
    	$semesterDetail->startingDate=$startTime;
        $semesterDetail->endingDate=$endTime;
        $semesterDetail->save();
    	return redirect('semesterDetails');
    }


    public function deleteSemesterDetail(Request $request)
    {
        $detail = SemesterDetail::find($request->id);
        $detail->delete();
        return redirect('semesterDetails');
    }
}

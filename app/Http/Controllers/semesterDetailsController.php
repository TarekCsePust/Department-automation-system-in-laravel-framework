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

        $details = SemesterDetail::get()->where('resultPublish','0');
        $semesterDetails = array();

        foreach($details as $detail)
        {
            $session = Session::find($detail->sessionId);
            $semester = Semester::find($detail->semesterId);

            if(!$session || !$semester)
            {
                $detail->delete();
            }
            else
            {
                 array_push($semesterDetails,[
                "id"=>$detail->id,
                "session"=>$session->session,
                "semester"=>$semester->semester,
                "startingDate"=>$detail->startingDate,
                "endingDate"=>$detail->endingDate,
                "result"=>$detail->resultPublish
                ]);
            }
             

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

    public function publishResult(Request $request)
    {
        $detail = SemesterDetail::find($request->id);
        $detail->resultPublish = 1;
        $detail->save();
        return redirect('semesterDetails');
    }
    public function updateSemesterDetail(Request $request)
    {
        $detail = SemesterDetail::find($request->id);
     
        $sessions = Session::get();
        $semesters = Semester::get();
        //$session = Session::find($detail->sessionId);
        //$semester = Semester::find($detail->semesterId);
      
        return view('editSemesterDetail',compact('detail','sessions','semesters'));
    }

    public function changeSemesterDetail(Request $request)
    {

        $detail = SemesterDetail::find($request->id);

        $detail->sessionId=$request->session;
        $detail->semesterId=$request->semester;
        $detail->startingDate=$request->startingDate;
        $detail->endingDate = $request->endingDate;
        $detail->resultPublish = $request->result;
        $detail->save();
        return redirect('semesterDetails');
    }
}

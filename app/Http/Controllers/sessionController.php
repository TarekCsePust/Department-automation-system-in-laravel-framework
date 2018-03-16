<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;

class sessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addSession(Request $request)
    {
    	$session = new Session;
    	$session->session = $request->input('session');
    	$session->save();
    	
    	return "sucessfull";
    }


    public function getSessions()
    {
    	
    	$sessions = Session::get();
    	return view('session',compact('sessions'));
    }

    public function changeSession(Request $request)
    {
    	$session = Session::find($request->id);
    	$session->session = $request->input('session');
    	$session->save();
    	
    	return "sucessfull";
    }

    public function deleteSession(Request $request)
    {
    	$session = Session::find($request->id);
    	$session->delete();
    	return "sucessfull";
    }
}

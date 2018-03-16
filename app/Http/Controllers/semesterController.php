<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semester;

class semesterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function getSemesters()
    {
    	$semesters = Semester::get();
    	return view('semester',compact('semesters'));
    }
}

@extends('layouts.master')

@section('title','home')

@section('heading')

@include('layouts.header')

@endsection

@section('body')
<div class="container">
  
  <div class="panel panel-default">
    <div class="panel-heading">Manage</div>
    <div class="panel-body">
      <a href="{{URL::to('/index')}}"><button class="btn btn-primary">Back</button></a>
    	<h3>Exam Schedule</h3>
    	<table class="table table-striped">
    <thead>

      <tr>
         <th>No</th>
         <th>Date</th>
         <th>Time</th>
         <th>Course Code</th>
         <th>Course Title</th>
         
 
      </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>
       @foreach($examDetails as $examDetail)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$examDetail['date']}}</td>
        <td>{{$examDetail['time']}}</td>
        <td>{{$examDetail['course_code']}}</td>
        <td>{{$examDetail['course_title']}}</td>
      </tr>
      @endforeach
   
    </tbody>
  </table>


    

    </div>
  </div>
</div>
@endsection
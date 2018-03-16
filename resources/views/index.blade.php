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
    	<h3>Upcomming Exam</h3>
    	<table class="table table-striped">
    <thead>

      <tr>
         <th>No</th>
         <th>Session</th>
         <th>Semester</th>
         <th>Exam-Type</th>
         <th>Starting-Date</th>
         <th>Ending-Date</th>
         <th>View</th>
         <th>Delete</th>
 
      </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>
       @foreach($examDates as $examDate)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$examDate['session']}}</td>
        <td>{{$examDate['semester']}}</td>
         <td>{{$examDate['examType']}}</td>
        <td>{{$examDate['startingDate']}}</td>
        <td>{{$examDate['endingDate']}}</td>
       
        <td><a href="{{URL::to('examDetails/'.$examDate['id'])}}"><button class="btn bg-primary">View</button></a></td>
        
        <td>
          <form method="POST" action="{{url('deleteExamDetail')}}">
            {{csrf_field()}}
          <input type="hidden" name="id" value="{{$examDate['id']}}">

           <button class="btn btn-danger">Delete</button>
          </form>
        </td>
      
      </tr>
      @endforeach
   
    </tbody>
  </table>

    


    </div>
  </div>
</div>
@endsection
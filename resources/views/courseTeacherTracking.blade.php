@extends('layouts.master')

@section('title','home')

@section('heading')

@include('layouts.header')

@endsection

@section('body')
<div class="container-fluid">
  
  <div class="panel panel-default">
    <div class="panel-heading">Manage</div>
    <div class="panel-body">
     
      
    	<h3>Course Teachers</h3>
    	<table class="table table-striped">
    <thead>
      <tr>
         <th>No</th>
         <th>Course code</th>
         <th>Course title</th>
         <th>Internal teacher</th>
         <th>External teacher</th>
         <th>IQS</th>
         <th>EQS</th>
         <th>IQA</th>
         <th>EQA</th>
         <th>Update</th>
      </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>
      @foreach($coursesTeachers as $courseTeacher)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$courseTeacher["courseCode"]}}</td>
        <td>{{$courseTeacher["courseTitle"]}}</td>
        <td>{{$courseTeacher["internal"]}}</td>
        <td>{{$courseTeacher["external"]}}</td>
        <td>{{$courseTeacher["IQS"]}}</td>
        <td>{{$courseTeacher["EQS"]}}</td>
        <td>{{$courseTeacher["IQA"]}}</td>
        <td>{{$courseTeacher["EQA"]}}</td>
        <td><a href="{{URL::to('assignTeacher/'.$courseTeacher['id'])}}"> <button class="btn btn-info">Update</button></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>






   


    </div>
  </div>
</div>
@endsection
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
     
     
    	<h3>Course Tracking</h3>
    	<table class="table table-striped">
    <thead>
      <tr>
         <th>No</th>
         <th>Session</th>
         <th>Semester</th>
         
         <th>Course Teacher</th>
      </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>

      @foreach($sessionAssigns as $assign)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$assign["session"]}}</td>
        <td>{{$assign["semester"]}}</td>

       

        <td> <a href="{{URL::to('courseTeacherTracking/'.$assign['id'])}}"> <button class="btn btn-info">View</button></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>

   


    </div>
  </div>
</div>
@endsection
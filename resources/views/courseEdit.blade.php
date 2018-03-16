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
       
       <a href="{{URL::to('/courseDetails')}}"><button class="btn btn-primary">Back</button></a>
       <br>

       <div class="col-lg-offset-3 col-lg-6">
        @include('layouts.error')
     <form class="form-horizontal" action="{{url('courseChanges')}}" method="post">
               {{csrf_field()}}
    <input type="hidden" name="id" value="{{$course->id}}">
    <div class="form-group">
      <label class="control-label col-sm-2" for="course_code">Course code:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="course_code" name="code" value="{{$course->courseCode}}" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="course_title">Course title:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="course_title" value="{{$course->courseTitle}}" name="title" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="course_title">Course type:</label>
      <div class="col-sm-10">
        @if($course->TheoryLab=="Theory")          
        <label class="radio-inline">
      <input type="radio" value="Theory" name="type" required checked="true">Theory
    </label>
    <label class="radio-inline">
      <input type="radio" value="Lab" name="type" required>Lab
    </label>
      @else
      <label class="radio-inline">
      <input type="radio" value="Theory" name="type" required>Theory
    </label>
    <label class="radio-inline">
      <input type="radio" value="Lab" checked="true" name="type" required>Lab
    </label>
    @endif
    
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="course_credit">Course credit:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="course_credit" placeholder="Enter course credit" value="{{$course->credit}}" name="credit" required>
      </div>
    </div>
      <div class="col-lg-3" style="margin-left: 50px;">
          <button type="submit" class="btn btn-info">Save changes</button>
      </div>
  </form>



<form method="post" action="{{url('courseRemove')}}">
  {{csrf_field()}}
  <input type="hidden" name="id" value="{{$course->id}}">
  <button type="submit" class="btn btn-danger">Delete</button>
  
</form>
 






 <!--<a href="{{URL::to('courseRemove/'.$course->id)}}"><button class="btn btn-danger">Delete</button></a>
-->
  </div>
</div>

    </div>
  </div>
</div>
@endsection
@extends('layouts.master')

@section('title','home')

@section('heading')

@include('layouts.header')

@endsection

@section('body')
<div class="container">
  
  <script type="text/javascript">

  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

  </script>

  <div class="panel panel-default">
    <div class="panel-heading">Manage</div>
    <div class="panel-body">
    
      @include('layouts.error')
      @include('layouts.confirmation_msg')
      <div class="row">
      <div class="col-lg-5">
       <h3><b>Assign new courses</b></h3>
      <form action="{{url('courseAssignToSemester')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
          <label for="session">Session:</label>
            <select name="session" class="form-control" id="sel1">
              <option value="">chose session</option>
            @foreach($sessions as $session)
            <option value="{{$session->id}}">
              {{$session->session}}
            </option>
             @endforeach
            </select>
        </div>


        <div class="form-group">
          <label for="semester">Semester:</label>
            <select name="semester" class="form-control" id="sel1">
            <option value="">chose semester</option>
            @foreach($semesters as $semester)
            <option value="{{$semester->id}}">
              {{$semester->semester}}
            </option>
            @endforeach
            </select>
        </div>

         <div class="form-group">
          <label for="session">Course:</label>
          <br>
            <select  class="form-control js-example-basic-multiple" name="course[]" multiple="multiple">
              @foreach($courses as $course)
              <option  value="{{$course->id}}">
                {{$course->courseTitle}}{{". "}}{{$course->courseCode}}
              </option>
              @endforeach
            </select>
         </div>
       
      
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

    <div class="col-lg-5 col-lg-offset-1">
      <br>
      <br>
      <h3><b>Import</b></h3>
    <form class="form-inline" action="{{url('importCourseAssignToSemester')}}" method="POST">
      {{csrf_field()}}
        <h5><b>From</b></h5>
        <div class="form-group">
          <label for="session">Session:</label>
          <select name="from_session" class="form-control" id="sel1">
              <option value="">chose session</option>
            @foreach($sessions as $session)
            <option value="{{$session->id}}">
              {{$session->session}}
            </option>
             @endforeach
            </select>
        </div>
        <div class="form-group">
          <label for="semester">Semester:</label>
         <select name="from_semester" class="form-control" id="sel1">
            <option value="">chose semester</option>

            @foreach($semesters as $semester)
            <option value="{{$semester->id}}">
              {{$semester->semester}}
            </option>
            @endforeach
            <option value="all">All</option>
            </select>
        </div>
       

        <h5><b>To</b></h5>

         <div class="form-group">
          <label for="session">Session:</label>
          <select name="to_session" class="form-control" id="sel1">
              <option value="">choose session</option>
            @foreach($sessions as $session)
            <option value="{{$session->id}}">
              {{$session->session}}
            </option>
             @endforeach
            </select>
        </div>
        <div class="form-group">
          <label for="semester">Semester:</label>
          <select name="to_semester" class="form-control" id="sel1">
            <option value="">choose semester</option>
            @foreach($semesters as $semester)
            <option value="{{$semester->id}}">
              {{$semester->semester}}
            </option>
            @endforeach
             <option value="all">All</option>
            </select>
        </div>


  <br>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>

     
    <div class="row">
        <h3><b>Assigned courses</b></h3>
      <div class="col-lg-7 col-lg-offset-2">
        
      

  

       <table class="table table-striped">
    <thead>
      <tr>
        <th>Session</th>
        <th>Semester</th>
        <th>Update</th>
      </tr>
    </thead>
    <tbody>
      @foreach($sessionAssigns as $assign)
      <tr>
        <td>{{$assign["session"]}}</td>
        <td>{{$assign["semester"]}}</td>
        <td><a href="{{URL::to('assignSessionEdit/'.$assign['id'])}}"> <button class="btn btn-info">ADD OR EDIT COURSES</button></a></td>
      </tr>
      @endforeach
     
    </tbody>
  </table>
</div>
</div>

    </div>
  </div>
</div>
@endsection
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
            <select  class="js-example-basic-multiple col-lg-12" name="course[]" multiple="multiple">
              @foreach($courses as $course)
              <option value="{{$course->id}}">
                {{$course->courseTitle}}{{". "}}{{$course->courseCode}}
              </option>
              @endforeach
            </select>
         </div>
       
      
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


    </div>
  </div>
</div>
@endsection
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
        
       <div class="col-lg-offset-1 col-lg-10">
     <form class="form-horizontal" action="{{url('assignChanges')}}" method="post">
               {{csrf_field()}}
    <input type="hidden" name="id" value="{{$assign->id}}">
     <div class="form-group">
          <label for="session">Session:</label>
            <select name="session" class="form-control" >
              <option value="">chose session</option>
            @foreach($sessions as $session)

            @if($session->id==$assign->sessionId)
            <option value="{{$session->id}}" selected="1">
              {{$session->session}}
            </option>
            @else
            <option value="{{$session->id}}">
              {{$session->session}}
            </option>
            @endif
             @endforeach
            </select>
     </div>

     <div class="form-group">
          <label for="semester">Semester:</label>
            <select name="semester" class="form-control" id="sel1">
            <option value="">chose semester</option> 
            @foreach($semesters as $semester)
            @if($assign->semesterId==$semester->id)
            <option value="{{$semester->id}}" selected="1">
              {{$semester->semester}}
            </option>
            @else
             <option value="{{$semester->id}}">
              {{$semester->semester}}
            </option>
            @endif
            @endforeach
           
            </select>
     </div>
     <div  class="form-group" >
       <label for="course">Course:</label>
       <select  class="js-example-basic-multiple col-lg-12" name="course[]" multiple="multiple">
            
              @foreach($allCourse as $course)
                 <?php $i=0; ?>
              @foreach($assignCourses as $ac)
                @if($ac->courseId==$course->id)
                  {{$i=1}}
                   <option selected="1"  value="{{$course->id}}">
                  
                {{$course->courseTitle}}{{". "}}{{$course->courseCode}}
              </option>

                @endif
              @endforeach
              @if(!$i)
                 <option  value="{{$course->id}}">
                  
                {{$course->courseTitle}}{{". "}}{{$course->courseCode}}
              </option>
              @endif

              @endforeach
            </select>
     </div>
     
      <div class="col-lg-3" style="margin-left: 50px;">
          <button type="submit" class="btn btn-info">Save changes</button>
      </div>
  </form>
  <!--
<form method="post" action="{{url('assignRemove')}}">
  {{csrf_field()}}
  <input type="hidden" name="id" value="{{$assign->id}}">
  <button type="submit" class="btn btn-danger">Delete</button>
  
</form>
-->
 
</div>
</div>

    </div>
  </div>
</div>
@endsection
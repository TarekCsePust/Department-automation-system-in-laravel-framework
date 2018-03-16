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
    	<h3>Insert New Exam Schedule</h3>
      @include('layouts.error')


        <form class="form-horizontal" method="POST" action="{{url('addExamDate')}}">
           {{csrf_field() }}

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Session:</label>
      <div class="col-sm-10">
      <select class="form-control" name="session" >
        <option selected="1" value="">select</option>
        @foreach($sessions as $session)
        <option value="{{$session->id}}">{{$session->session}}</option>
       @endforeach
      </select> 
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Semester:</label>
      <div class="col-sm-10">          
        <select class="form-control" name="semester" >
        <option selected="1" value="">select</option>
        @foreach($semesters as $semester)
        <option value="{{$semester->id}}">{{$semester->semester}}</option>
        @endforeach
       
      </select> 
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" >Starting Date:</label>
      <div class="col-sm-10">          
        <input type="date" class="form-control"  name="startingDate">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-2">Ending Date:</label>
      <div class="col-sm-10">          
        <input type="date" class="form-control"  name="endingDate">
      </div>
    </div>
    
    <div class="form-group">

       <label class="control-label col-sm-2">Exam Type:</label>
      <div class="col-sm-10">          
        <label class="radio-inline">
      <input type="radio" name="ExamType" value="Lab">Lab
      </label>
    <label class="radio-inline">
      <input type="radio" name="ExamType" value="Theory">Theory
    </label>
      </div>
    
    </div>


    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Number Of Exam:</label>
      <div class="col-sm-10">          
      <select class="form-control" name="noExam" onchange=" addInput();" id="noExam">
        <option selected="1" value="">select</option>
        <option value="1" >1</option>
        <option value="2" >2</option>
        <option value="3" >3</option>
        <option value="4" >4</option>
        <option value="5" >5</option>
        <option value="6" >6</option>
        <option value="7" >7</option>
        <option value="8" >8</option>
        <option value="9" >9</option>
        <option value="10" >10</option>
      </select> 
      </div>
    </div>
    
    <br>
    <br>



   



<div class="col-md-12">

  <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead>
                <th style="width:60px;" >Date</th>
                 <th style="width:60px;" >Time</th>
                   <th style="width: 200px;">Course</th>
                      
               
         
            </thead>
            <tbody id="inputs">
                
            </tbody>
        </table>
    </div>



</div>

              <div class="form-group">
                            <div class="col-md-6 col-sm-offset-5">
                                <button type="submit" class="btn btn-primary">
                                 Submit
                                </button>
          </div>
          </div>


  </form>

  
  	

















  <script type="text/javascript">
    function addInput(){
      var amount = $('#noExam').val();
      var inputs = $('#inputs').empty();
      for(i = 0; i < amount; i++) {
        inputs.append(

          '<tr><td style="width:10px;"><input type="date" class="form-control" name="date[]"></td><td style="width:10px;"><input type="text" class="form-control" name="time[]"></td><td style="width:10px;"><select class="form-control" name="course[]" ><option selected="1" value="">select</option>@foreach($courses as $course)<option value="{{$course->id}}">{{$course->courseTitle}}{{' - '}}{{$course->courseCode}}</option>@endforeach</select></td></tr>'

          );
      }
    }
  </script>


























    </div>
  </div>
</div>
@endsection
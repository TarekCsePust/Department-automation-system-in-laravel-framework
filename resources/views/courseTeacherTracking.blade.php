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

    <a href="{{URL::to('/courseAssignDetails')}}"><button class="btn btn-primary">Back</button></a>
    
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
        <td>
          @if($courseTeacher["IQS"]=="Yes")

             <i><span class="glyphicon glyphicon-ok"></span></i>
          @else

             <i> <span class="glyphicon glyphicon-remove"></span></i>
          @endif
        </td>
        <td>
          @if($courseTeacher["EQS"]=="Yes")

              <i> <span class="glyphicon glyphicon-ok"></span></i>
          @else

             <i> <span class="glyphicon glyphicon-remove"></span></i>
          @endif

        </td>
        <td>

           @if($courseTeacher["IQA"]=="Yes")

              <i> <span class="glyphicon glyphicon-ok"></span></i>
          @else

             <i> <span class="glyphicon glyphicon-remove"></span></i>
          @endif

        </td>
        <td>
           @if($courseTeacher["EQA"]=="Yes")

              <i> <span class="glyphicon glyphicon-ok"></span></i>
          @else

             <i> <span class="glyphicon glyphicon-remove"></span></i>
          @endif
        </td>
        <td>
        <form action="{{url('assignTeacher')}}" method="get">
          <input type="hidden" name="id" value="{{$courseTeacher['id']}}">
          <input type="hidden" name="ctt" value="{{$ctt}}">
          <button class="btn btn-info">Update</button></a>
        </form>
      </td>
        <!--<a href="{{URL::to('assignTeacher/'.$courseTeacher['id'])}}"> <button class="btn btn-info">Update</button></a>-->
      </tr>
      @endforeach
    </tbody>
  </table>






   


    </div>
  </div>
</div>
@endsection
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

   <div class="">

@include('layouts.error')
   
<form class="form-horizontal" method="POST" action="{{url('addSemesterDetail')}}" >

   {{csrf_field() }}
          

<div class="col-md-9 col-md-offset-1">

  <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead>
                <th style="width:50px;" >Session</th>
                 <th style="width:50px;" >Semester</th>
                   <th>Starting-Date</th>
                        <th>Ending-Date</th>
               
         
            </thead>
            <tbody>
                <tr>
                <td style="width:10px;">
                       
             <select name="session" class="form-control">
               <option selected="1" value="">select</option>
              @foreach($sessions as $session)
           <option value="{{$session->id}}">{{$session->session}}</option>
               @endforeach
             
              </select>
                         
                      
    </td>
     <td style="width:10px;">
         <select name="semester" class="form-control">

             <option selected="1" value="">select</option>
             @foreach($semesters as $semester)
              <option value="{{$semester->id}}">{{$semester->semester}}</option>
              
             @endforeach
              </select>             
    </td>
                    
     <td style="width:10px;">
     <input type="date" class="form-control" name="startingDate">           
    </td>
     <td style="width:10px;">
     <input type="date" class="form-control" name="endingDate">           
    </td>
            

                   </tr>
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

</div>


    	<h3>Semester Details</h3>
    	<table class="table table-striped">
    <thead>
      <tr>
         <th>No</th>
         <th>Session</th>
         <th>Semester</th>
         <th>Class Starting date</th>
         <th>Class Ending date</th>
         <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
    <?php $i=1 ?>
      @foreach($semesterDetails as $detail)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$detail['session']}}</td>
        <td>{{$detail['semester']}}</td>
        <td>{{$detail['startingDate']}}</td>
        <td>{{$detail['endingDate']}}</td>
        <form method="POST" action="{{url('deleteSemesterDetail')}}">
           {{csrf_field()}}
           <td><button class="btn btn-danger">Delete</button></td>
           <input type="hidden" name="id" value="{{$detail['id']}}">
        </form>
       
      </tr>
      @endforeach
    
    </tbody>
  </table>

   


    </div>
  </div>
</div>
@endsection
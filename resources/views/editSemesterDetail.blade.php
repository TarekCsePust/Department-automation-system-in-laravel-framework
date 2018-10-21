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
   
<form class="form-horizontal" method="POST" action="{{url('changeSemesterDetail')}}" >

   {{csrf_field() }}
   <input type="hidden" name="id" value="{{$detail->id}}">
          

<div class="col-md-9 col-md-offset-1">

  <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead>
                <th style="width:90px;" >Session</th>
                 <th style="width:50px;" >Semester</th>
                   <th style="width:50px;">Starting-Date</th>
                        <th style="width:50px;">Ending-Date</th>
                        <th>Result</th>
               
         
            </thead>
            <tbody>
                <tr>
                <td style="width:10px;">
                       
             <select name="session" class="form-control">
               <option selected="1" value="">select</option>
              @foreach($sessions as $session)
              @if($detail->sessionId==$session->id)
           <option selected="1" value="{{$session->id}}">{{$session->session}}</option>
             @else
                   <option  value="{{$session->id}}">{{$session->session}}</option>
             @endif

               @endforeach
             
              </select>
                         
                      
    </td>
     <td style="width:10px;">
         <select name="semester" class="form-control">

             <option selected="1" value="">select</option>
             @foreach($semesters as $semester)
               @if($detail->semesterId==$semester->id)
              <option selected="1" value="{{$semester->id}}">{{$semester->semester}}</option>
               @else
                   <option value="{{$semester->id}}">{{$semester->semester}}</option>
               @endif
              
             @endforeach
              </select>             
    </td>
                    
     <td style="width:10px;">
     <input type="text" value="{{$detail->startingDate}}" class="form-control" name="startingDate" >           
    </td>
     <td style="width:10px;">
     <input type="text" value="{{$detail->endingDate}}" class="form-control" name="endingDate">           
    </td>

    </td>
     <td style="width: 100px;">
      @if($detail->resultPublish)
      <label class="radio-inline">
      <input type="radio" checked="1" value="1" name="result">Publish
    </label>
    <label class="radio-inline">
      <input type="radio" value="0" name="result">Not publish
    </label>
    @else
    <label class="radio-inline">
      <input type="radio" value="1" name="result">Publish
    </label>
    <label class="radio-inline">
      <input type="radio" checked="1" value="0" name="result">Not publish
    </label>
    @endif
    </td>
            

                   </tr>
            </tbody>
        </table>
    </div>



</div>

              <div class="form-group">
                            <div class="col-md-6 col-sm-offset-5">
                                <button type="submit" class="btn btn-primary">
                                 Update
                                </button>
          </div>
          </div>
        

</form>

</div>


    

   


    </div>
  </div>
</div>
@endsection
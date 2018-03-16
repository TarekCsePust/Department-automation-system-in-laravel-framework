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
    	
     
       <form class="form-horizontal" action="{{url('courseTeacher')}}" style="margin-left: 20px;" method="post">

        {{csrf_field()}}
    <div class="form-group">

      <label class="control-label" for="internal">Internal:</label>

       <input type="hidden" name="id" value="{{$course->id}}">
       <select name="internal" class="form-control" id="internal">

                <option value="0">
              chose internal teacher</option>
              @foreach($teachers as $teacher)
                @if($teacher->id ==$course->internalTeacherId)
              <option value="{{$teacher->id}}" selected="1">
                {{$teacher->name}}
              </option>
              @else
               <option value="{{$teacher->id}}">
                {{$teacher->name}}
              </option>
              @endif
              @endforeach
             


              </select>


    </div>



    <div class="form-group">

      <label class="control-label" for="internal">External:</label>


       <select name="external" class="form-control" id="external">

                <option value="0">
              chose external teacher</option>
              @foreach($teachers as $teacher)
                @if($teacher->id==$course->externalTeacherId)
              <option value="{{$teacher->id}}" selected="1">
                {{$teacher->name}}
              </option>
              @else
               <option value="{{$teacher->id}}">
                {{$teacher->name}}
              </option>
              @endif
              @endforeach

         

              </select>



    </div>



    <div class="form-group">
    
    @if($course->IQS=="Yes")
    <label class="checkbox-inline">
      <input type="checkbox" checked="1" name="IQS" value="Yes">IQS
    </label>
    @else
     <label class="checkbox-inline">
      <input type="checkbox" name="IQS" value="Yes">IQS
    </label>
    @endif

    @if($course->EQS=="Yes")
    <label class="checkbox-inline">
      <input type="checkbox" checked="1" name="EQS" value="Yes">EQS
    </label>
    @else
     <label class="checkbox-inline">
      <input type="checkbox"  name="EQS" value="Yes">EQS
    </label>
    @endif


    @if($course->IQA=="Yes")
    <label class="checkbox-inline">
      <input type="checkbox" checked="1" name="IQA" value="Yes">IQA
    </label>
    @else
     <label class="checkbox-inline">
      <input type="checkbox"  name="IQA" value="Yes">IQA
    </label>
    @endif

     @if($course->EQA=="Yes")
     <label class="checkbox-inline">
      <input type="checkbox" checked="1" name="EQA" value="Yes">EQA
    </label>
    @else
    <label class="checkbox-inline">
      <input type="checkbox" name="EQA" value="Yes">EQA
    </label>
    @endif

    </div>



    <div class="form-group">        
      <div class="">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>


    </div>
  </div>
</div>
@endsection
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

  


    	<h3>Existing Semester</h3>
      <div class="col-lg-offset-3 col-lg-4">
    	<table class="table table-striped">
    <thead>
      <tr>
         <th>No</th>
         <th>Semester</th>
      </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>
      @foreach($semesters as $semester)
      <tr class="item">
        <td>{{$i++}}</td>
        <td>{{$semester->semester}}
           
        </td>  
      </tr>
      @endforeach
    </tbody>
  </table>
</div>


    </div>
  </div>
</div>
@endsection
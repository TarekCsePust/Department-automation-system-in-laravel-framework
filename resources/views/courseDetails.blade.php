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
       
<script type="text/javascript">
    $(document).ready(function(){
    $('#myTable').DataTable();
});
  </script>

       <div class="container">
   
   <div class="row">
      <button  data-toggle="modal" data-target="#myModal" type="button" class="btn btn-primary">Add new course</button>
   </div>
   <br>
   <div class="row">
      <table class="table table-condensed table-responsive" id="myTable">
        <thead>
          <th>No</th>
          <th>Course code</th>
          <th>Course title</th>
          <th>Course type</th>
          <th>Course credit</th>
               <th>View</th>
              
        </thead>
        <tbody>
               <?php $i=1; ?>
               @foreach($courses as $course)
          <tr class="ourItem">
            <td>
            {{$i++}}
            </td>
            <td>{{$course->courseCode}}
                     <input type="hidden" id="courseCode" value="{{$course->courseCode}}">
                  </td>
            <td>{{$course->courseTitle}}
                      <input type="hidden" id="courseTitle" value="{{$course->courseTitle}}">
                  </td>
            <td>{{$course->TheoryLab}}
                      <input type="hidden" id="TheoryLab" value="{{$course->TheoryLab}}">
                  </td>
            <td>{{$course->credit}}

                      <input type="hidden" id="courseCredit" value="{{$course->credit}}">

                  </td>
                  <td>
<a href="{{URL::to('courseEdit/'.$course->id)}}"><button type="button" class="btn btn-info" id="update">View</button></a></td>
                  
          </tr>
               @endforeach
        
        </tbody>
        <tfoot>
          <th>No</th>
          <th>Course code</th>
          <th>Course title</th>
          <th>Course type</th>
          <th>Course credit</th>
               <th>View</th>
        </tfoot>

        
      </table>
    
   </div>
   
</div>




<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add new course</h4>
      </div>
      <div class="modal-body">

    <input type="text" class="form-control" id="course_code" name="course_code" placeholder="Enter course code" required>
    <br>

    <input type="text" class="form-control" id="course_title" placeholder="Enter course title" name="course_title" required><br>

     <b>Course Type:</b>
     <input type="radio" name="optradio" id="theory" value="Theory" required>Theory
     <input type="radio" name="optradio" id="lab" value="Lab" required>Lab
     <br>

     <br>
     <input type="text" class="form-control" id="course_credit" placeholder="Enter course credit" name="course_credit" required>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="add">ADD</button>
      </div>
    </div>

  </div>
</div>

{{csrf_field()}}


<script type="text/javascript">
   $(document).ready(function() {

      $("#add").click(function(){
               var code = $("#course_code").val();
               var title = $("#course_title").val();
               var credit = $("#course_credit").val();
               var type = "";
                if ($("#theory").is(":checked")) {
                  type="Theory";
                 //console.log("theory");
               }else
               if ($("#lab").is(":checked")) {
                  type = "Lab";
                 //console.log("lab");
               }

               if(code=="" || title=="" || credit==""
                   || type=="")
               {
                  alert("you can not empty any field");
               }
               else
               {
                  $.post('InsertToNewCourses',
                     {'code':code,'title':title,'credit':credit,'type':type,'_token':$('input[name=_token]').val()},function(data){

                        location.reload();
                        if(data=="Add sucessfully")
                        {
                          alert("Add sucessfully");
                        }
                        else
                        {
                          alert("course already exist");
                        }
             
               console.log(data);
               //console.log(data["text"]);
               });

               }


             
               
            });


   });
    
    

</script>


    </div>
  </div>
</div>
@endsection
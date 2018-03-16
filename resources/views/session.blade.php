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

  <button type="button" id="addNew" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Session</button>

</div>


    	<h3>Existing Sessions</h3>
      <div class="col-lg-offset-3 col-lg-4">
    	<table class="table table-striped">
    <thead>
      <tr>
         <th>No</th>
         <th>Session</th>
      </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>
      @foreach($sessions as $session)
      <tr class="item" data-toggle="modal" data-target="#myModal">
        <td>{{$i++}}</td>
        <td>{{$session->session}}
            <input type="hidden" id="sesn" value="{{$session->session}}">
            <input type="hidden" id="id" value="{{$session->id}}">
        </td>  
      </tr>
      @endforeach
    </tbody>
  </table>
</div>



<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
         <label for="session">Session:</label>
        <input type="text" class="form-control" id="seson" required="true" name="session">
         </div>
        </div>
        <input type="hidden" value="" id="seson_id">
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal" style="display: none;" id="update">Update</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="add">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" style="display: none;" id="delete">Delete</button>
        </div>
      </div>
      
    </div>
  </div>




{{csrf_field()}}
   
<script type="text/javascript">
  
    $(document).ready(function() {
      $('.item').each(function(){

          $(this).click(function(){
              $("#add").hide();
              $("#delete").show();
              $("#update").show();
              var session = $(this).find('#sesn').val();
              $("#seson").val(session);
              var id = $(this).find('#id').val();
              $("#seson_id").val(id);
             console.log();
          });
      });

        $("#addNew").click(function() {

           $("#delete").hide();
            $("#update").hide();
            $("#add").show();
             $("#seson").val("");
          /* Act on the event */
        });

      $("#update").click(function() {
         
         var text =  $("#seson").val();
         var id = $("#seson_id").val();
         
        if(text=="")
        {
          alert("You can not empty this field");
        }
        else
        {
            $.post('sessionUpdate',{'id':id,'session':text,'_token':$('input[name=_token]').val()},function(data){
           location.reload();
          //$("#items").load(location.href + ' #items');
          //console.log(data);
          //console.log(data["text"]);
        });
        }
       



         console.log(text);
      });



       $("#add").click(function() {
        
         var text =  $("#seson").val();
           $("#delete").hide();
           $("#update").hide();
           $("#add").show();

        if(text=="")
        {
          alert("You can not empty this field");
        }
        else
        {
           $.post('addSession',{'session':text,'_token':$('input[name=_token]').val()},function(data){
           location.reload();
          //$("#items").load(location.href + ' #items');
          //console.log(data);
          //console.log(data["text"]);
          });
        }
        



         console.log(text);
      });


      $("#delete").click(function() {
        /* Act on the event */

          var id = $("#seson_id").val();
           $("#add").hide();
           

         $.post('sessionDelete',{'id':id,'_token':$('input[name=_token]').val()},function(data){
           location.reload();
          //$("#items").load(location.href + ' #items');
          //console.log(data);
          //console.log(data["text"]);
        });


      });

    });

</script>

    </div>
  </div>
</div>
@endsection
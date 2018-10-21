@if(session()->has('msg'))
	<div class="alert alert-info alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>{{session()->get('msg')}}</strong>
  </div>
@endif
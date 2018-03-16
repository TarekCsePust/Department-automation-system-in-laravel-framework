<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Dept.Of CSE</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="{{URL::to('/index')}}">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage<span class="caret"></span></a>
         <ul class="dropdown-menu">
          <li class="dropdown-header">Academic</li>
          <li><a href="{{URL::to('/session')}}">Session</a></li>
          <li><a href="{{URL::to('/semester')}}">Semester</a></li>
          <li><a href="{{URL::to('/semesterDetails')}}">Semester details</a></li>
          <li><a href="{{URL::to('/entryExamDate')}}">Entry Exam</a></li>
          <li class="divider"></li>
          <li class="dropdown-header">Courses</li>
          <li><a href="{{URL::to('/courseDetails')}}">Course Details</a></li>
          <li><a href="{{URL::to('/courseAssign')}}">Assign</a></li>
         
        </ul>
      </li>



        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Tracking<span class="caret"></span></a>
         <ul class="dropdown-menu">
         <li><a href="{{URL::to('/courseAssignDetails')}}">Course Teacher</a></li>
         
         </ul>
        </li>


      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Academic Schedule<span class="caret"></span></a>
         <ul class="dropdown-menu">
          <li><a href="#">Show duties</a></li>
          <li><a href="#">Exam plan</a></li>
         </ul>
      </li>
      <li><a href="#">Casual leave</a></li>
    
       
    </ul>

    <ul class="nav navbar-nav navbar-right">
     
     

       <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <span class="glyphicon glyphicon-user"></span>
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>



    </ul>

  </div>
</nav>
  
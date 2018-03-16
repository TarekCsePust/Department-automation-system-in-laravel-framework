<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	 <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  	 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		 <script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
	
	<div class="container-fluid">
		<div class="row">
		@section('heading')
  		@show
		</div>
		<div class="row">
			@section('body')
  			@show
		</div>

		<div class="row" style="background-color:#0080ff;height: 200px; margin-top: 200px;">
			  <div class="footer-copyright py-3 text-center">
              <div class="container-fluid" style="margin-top: 100px; color: white;">
                  © 2018 Copyright:Dept.Of CSE,PUST
              </div>
          </div>
		</div>

	</div>
	
	


			<!-- jQuery library -->

	

	
</body>
</html>
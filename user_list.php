<!DOCTYPE html>
<!-- saved from url=(0075)http://ironsummitmedia.github.io/startbootstrap-sb-admin-2/pages/login.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>SB Admin 2 - Bootstrap Admin Theme</title>

		<!-- Bootstrap Core CSS -->
		<link href="http://ironsummitmedia.github.io/startbootstrap-sb-admin-2/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

		<!-- MetisMenu CSS -->
		<link href="http://ironsummitmedia.github.io/startbootstrap-sb-admin-2/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

		<!-- Custom CSS -->
		<link href="http://ironsummitmedia.github.io/startbootstrap-sb-admin-2/dist/css/sb-admin-2.css" rel="stylesheet">

		<!-- Custom Fonts -->
		<link href="./login_files/font-awesome.min.css" rel="stylesheet" type="text/css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
				<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
				<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
				<![endif]-->

	</head>

	<body>
		<?php
			 //only admin could visit this page
 session_start();
	 if($_SESSION['is_admin'] != 1){
		 header("Location:login.php");
	 }
			 include('conn.php');
			 $user_query = mysql_query("select id,email,is_admin,ip,updated_at from users; ");

			 ?>
		<div class="container">
			<div class="row">
				<div class="col-md-4" style="width:60%;margin-left:20%;">
					<div class="login-panel panel panel-default">
						<div class="panel-body">
							<table class="table table-striped">
								<thead>
									<tr role="row"><th>Email</th><th>Is admin?</th><th>IP</th><th>Updated At</th><th>Operation</th></tr>
								</thead>
								<?php
									 while($row=mysql_fetch_array($user_query))
									 {
                     $admin_or_not = ($row[2] == 1 ? "YES" : "NO");
										 echo "<tr id='user_$row[0]'><td>".$row[1]."</td><td>$admin_or_not</td><td>$row[3]</td><td>$row[4]</td><td><a href='javascript:delete_resource($row[0])';>Delete</a></td></tr>";
									 }
									 ?>
							</table> 
							<a style="float:right" class='btn btn-success' href='register.php'>Register</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- jQuery -->
		<script src="./login_files/jquery.min.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="./login_files/bootstrap.min.js"></script>

		<!-- Metis Menu Plugin JavaScript -->
		<script src="./login_files/metisMenu.min.js"></script>

		<!-- Custom Theme JavaScript -->
		<script src="./login_files/sb-admin-2.js"></script>
		<script src="./login_files/main.js"></script>

	</body>
</html>

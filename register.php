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
 session_start();
	 if($_SESSION['is_admin'] != 1){
		 header("Location:login.php");
	 }
?>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="login-panel panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Please Sign In</h3>
						</div>
						<div class="panel-body">
							<form role="form" action="regcheck.php" method="post">
								<fieldset>
									<div class="form-group">
										<input class="form-control" placeholder="E-mail" type="text" name="email"/>
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="password" type="password" name="password"/>
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="password confirmation" type="password" name="confirm"/>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="is_admin" value=1 /> is admin?
										</label>
									</div>
									<input class="btn btn-lg btn-success btn-block" type="Submit" name="Submit" value="注册"/>
								</fieldset>
							</form>
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
	</body>
</html>

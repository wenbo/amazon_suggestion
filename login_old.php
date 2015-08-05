<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<form action="logincheck.php" method="post">
	 Email：<input type="text" name="email" />
	 <br />
	 密码：<input type="password" name="password" />
	 <br />
	 <input type="submit" name="submit" value="登陆" />
	 &nbsp;&nbsp;&nbsp;&nbsp;
<a href="register.php">注册</a>
</form>
<?php
//注销登录
if($_GET['action'] == "logout"){
	session_start();
	unset($_SESSION['userid']);
	unset($_SESSION['email']);
	unset($_SESSION['is_admin']);
	exit;
}
?>
</body>
</html>

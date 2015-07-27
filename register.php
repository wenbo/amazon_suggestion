<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
	 session_start();
	 if($_SESSION['is_admin'] != 1){
		 header("Location:login.php");
	 }
?>
<form action="regcheck.php" method="post">
	Email：<input type="text" name="email"/>
    <br/>
    密　码:<input type="password" name="password"/>
    <br/>
    确认密码：<input type="password" name="confirm"/>
    <br/>
	 is_admin:<input type="checkbox" name="is_admin" value=1 />
	 <br/>
    <input type="Submit" name="Submit" value="注册"/>
</form>
</body>
</html>

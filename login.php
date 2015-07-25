<form action="logincheck.php" method="post">
	 用户名：<input type="text" name="username" />
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
	unset($_SESSION['username']);
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
	header("Location:login.php");
	exit();
}
//包含数据库连接文件
include('conn.php');
$userid = $_SESSION['userid'];
$email = $_SESSION['email'];
$user_query = mysql_query("select * from user where id = '$userid' limit 1");
$row = mysql_fetch_array($user_query);
echo '用户信息：<br />';
echo '用户ID：',$userid,'<br />';
echo '用户名：',$email,'<br />';
echo 'is_admin：',$_SESSION['is_admin'],'<br />';
echo '<a href="login.php?action=logout">注销</a> 登录<br />';
?>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
include('common.php');

	if(isset($_POST["Submit"]) && $_POST["Submit"] == "注册")
	{
		$email = $_POST["email"];
		$psw = $_POST["password"];
		$psw_confirm = $_POST["confirm"];
                $is_admin = $_POST["is_admin"];
		if($email == "" || $psw == "" || $psw_confirm == "")
		{
			echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";
		}
		else
		{
			if($psw == $psw_confirm)
			{
				mysql_connect("localhost","root","");	//连接数据库
				mysql_select_db("amazon_suggestion");	//选择数据库
				mysql_query("set names 'gdk'");	//设定字符集
				$sql = "select email from users where email = '$_POST[email]'";	//SQL语句
				$result = mysql_query($sql);	//执行SQL语句
				$num = mysql_num_rows($result);	//统计执行结果影响的行数
				if($num)	//如果已经存在该用户
				{
					echo "<script>alert('用户名已存在'); history.go(-1);</script>";
				}
				else	//不存在当前注册用户名称
				{
					$encryped = pwd_hash($psw);
                                        $sql_insert = "insert into users (email,password,is_admin) values('$_POST[email]','$encryped','$is_admin')";
					$res_insert = mysql_query($sql_insert);
					//$num_insert = mysql_num_rows($res_insert);
					if($res_insert)
					{
                                          echo "<script>alert('注册成功！');location.href='login.php';</script>";
					}
					else
					{
						echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
					}
				}
			}
			else
			{
				echo "<script>alert('密码不一致！'); history.go(-1);</script>";
			}
		}
	}
	else
	{
		echo "<script>alert('提交未成功！'); history.go(-1);</script>";
	}
?>
</body>
</html>

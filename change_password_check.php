<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
include('common.php');

	if(isset($_POST["Submit"]) && $_POST["Submit"] == "Submit")
	{
		session_start();
		$email = $_SESSION['email'];
		$old_psw = $_POST["old_password"];
		$psw = $_POST["password"];
		$psw_confirm = $_POST["confirm"];
		if($email == "" || $psw == "" || $psw_confirm == "")
		{
			echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";
		}
		else
		{
			if($psw == $psw_confirm)
			{
				include('conn.php');
				$encryped = pwd_hash($old_psw);
				$sql = "select id,email from users where password = '$encryped'";	//SQL语句
				$result = mysql_query($sql);	//执行SQL语句
				$num = mysql_num_rows($result);	//统计执行结果影响的行数
				if($num)	//if old password is correct
				{
					$new_encryped = pwd_hash($psw);	//
					
					$id = mysql_fetch_array($result); //[0];
					$id = $id[0];
					
					$sql_update = "update  users  SET password='$new_encryped' where id = '$id' ";

					/* echo $id; */
					/* echo $psw; */
					/* echo $sql; */

					$res_update = mysql_query($sql_update);
					//$num_insert = mysql_num_rows($res_insert);
					if($res_update)
						{
							echo "<script>alert('success！');location.href='login.php';</script>";
						}
					else
						{
							echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
					}

				}
				else	// old password is incorrect.
				{
					echo "<script>alert('old password is incorrect'); history.go(-1);</script>";
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

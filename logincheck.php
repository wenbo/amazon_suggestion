<?php
include('common.php');

	if(isset($_POST["submit"]) && $_POST["submit"] == "Login")
	{
		$email = $_POST["email"];
		$psw = $_POST["password"];
		if($email == "" || $psw == "")
		{
			echo "<script>alert('请输入Email或密码！'); history.go(-1);</script>";
		}
		else
		{
			include("conn.php");
			$encryped = pwd_hash($psw);
			$sql = "select id,email,is_admin from users where email = '$_POST[email]' and password = '$encryped'";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			if($num)
			{
				$row = mysql_fetch_array($result);	//将数据以索引方式储存在数组中 usernmae
				$ip = $_SERVER["REMOTE_ADDR"];
				date_default_timezone_set('Asia/Shanghai'); 
				$time_now = date("Y-m-d H:i:s",time());
				$sql_update = "update users set ip = '$ip', updated_at = '$time_now' where id = $row[0]";
				$res_update = mysql_query($sql_update);
				if($res_update)
					{
						session_start(); 
						$_SESSION['userid'] = $row[0];  
						$_SESSION['email'] = $row[1];  
						$_SESSION['is_admin'] = $row[2];  
						header("Location:index.html");
					}
				/* echo $sql_update; */
			}
			else
			{
				echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";
			}
		}
	}
	else
	{
		echo "<script>alert('提交未成功！'); history.go(-1);</script>";
	}

?>

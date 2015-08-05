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
			mysql_connect("localhost","root",'');
			mysql_select_db("amazon_suggestion");
                        mysql_query("set names 'gbk'");
                        $encryped = pwd_hash($psw);
                        $sql = "select id,email,is_admin from users where email = '$_POST[email]' and password = '$encryped'";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			if($num)
			{
				$row = mysql_fetch_array($result);	//将数据以索引方式储存在数组中 usernmae
				session_start(); 
				$_SESSION['userid'] = $row[0];  
				$_SESSION['email'] = $row[1];  
				$_SESSION['is_admin'] = $row[2];  
				header("Location:index.html");
				echo $row[0];
			}
			else
			{
				echo "<script>alert('用户名或密码不正确！');</script>";
			}
		}
	}
	else
	{
		echo "<script>alert('提交未成功！'); history.go(-1);</script>";
	}

?>

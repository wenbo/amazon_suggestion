<?php
	if(isset($_POST["submit"]) && $_POST["submit"] == "登陆")
	{
		$user = $_POST["username"];
		$psw = $_POST["password"];
		if($user == "" || $psw == "")
		{
			echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";
		}
		else
		{
			mysql_connect("localhost","root","");
			mysql_select_db("amazon_suggestion");
			mysql_query("set names 'gbk'");
			$sql = "select id,username,password from user where username = '$_POST[username]' and password = '$_POST[password]'";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			if($num)
			{
				$row = mysql_fetch_array($result);	//将数据以索引方式储存在数组中 usernmae
				session_start(); 
				$_SESSION['userid'] = $row[0];  
				$_SESSION['username'] = $row[1];  
				header("Location:my.php");
				echo $row[0];
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
<?php
header('Content-type: text/json');

$user_id = $_GET["id"];

session_start(); 

/* echo $user_id; */
/* echo $_SESSION["userid"]; */


if($_SESSION['is_admin'] && $_SESSION["userid"] != $user_id)
	{
		include('conn.php');
		$sql = "select id from users where id = '$user_id'";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		if($num)
			{
				$sql = "delete from users where id = '$user_id'";
				/* echo $sql; */
				mysql_query($sql);
				/* echo "1"; //indicates successful */
				echo json_encode(array("msg" => "1"));
			}
		else
			{
				echo json_encode(array("msg" => "0"));
			}
	}
else
	{
		/* echo "0"; //indicates failure */
		echo json_encode(array("msg" => "0"));
	}

?>

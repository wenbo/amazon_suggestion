<?php
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
?>
window.location.href = "/login.php";
<?php
  
	exit();
}

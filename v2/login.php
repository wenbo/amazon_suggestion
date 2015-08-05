<?php

//Checks if the cookie exists, if true then verifies it with the database.

if (isset($_COOKIE[‘user’]) && isset($_COOKIE[‘pass’]))

{

$usar = $_COOKIE[‘user’];

$pswd = $_COOKIE[‘pass’];

$con = mysql_connect(“localhost”, “root”) or die(“cannot connect”);

mysql_select_db(“user_logs”, $con) or die(“cannot select DB”);

$sql=”SELECT * FROM user WHERE username=’$usar'”;

$result=mysql_query($sql, $con);

$info=mysql_fetch_array($result);

//if verified redirects your page to member.php

if (mysql_num_rows($result)==1 && $pswd!= $info[‘password’])

{

header (“Location: member.php”);

}

}

// other wise if you don’t have cookies set you’ll already be welcomed with the login form which is executed from the bottom of this PHP page. And if you input your username and password it will check and verify with the mysql database.

if (isset($_POST[‘save’]))

{

$con = mysql_connect(“localhost”, “root”) or die(“cannot connect”);

mysql_select_db(“user_logs”, $con) or die(“cannot select DB”);

$user = $_POST[“user”];

$pwd = md5($_POST[‘pwd’]);

$sql=”SELECT * FROM user WHERE username=’$user'”;

$result=mysql_query($sql, $con);

$info=mysql_fetch_array($result);

if (mysql_num_rows($result)==1 && $pwd!= $info[‘password’])

{

$hour = time() + 60;

setcookie(user, $_POST[‘user’], $hour);

setcookie(pass, $_POST[‘pwd’], $hour);

header (“Location: member.php”);

}

//if false user information then returns with try-again message and a login form.

else {

echo “Access denied. Try re-entering your username and password, if you haven’t registered yet, <a href=’register.php’>Click here to register</a>”;

echo “<title>Login module</title>”;

echo “<form action=’login.php’ method=’post’>”;

echo “Name: <input type=’text’ name=’user’ />”;

echo “password: <input type=’password’ name=’pwd’ />”;

echo “<input type=’submit’ name=’save’/>”;

echo “</form>”;

}

}

// if nothing is true or neutral then loads login form only.

else {

echo “<title>Login module</title>”;

echo “<form action=’login.php’ method=’post’>”;

echo “Name: <input type=’text’ name=’user’ />”;

echo “password: <input type=’password’ name=’pwd’ />”;

echo “<input type=’submit’ name=’save’/>”;

echo “</form>”;

}

?>
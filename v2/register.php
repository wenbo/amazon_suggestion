<form action=”register.php” method=”post”>

Name: <input />

password: <input name=”pwd” />

email: <input name=”mail”/>

<input/>

</form>

Now lets make a backend code using PHP.

<?php

//connects to the database.

$con= mysql_connect(“localhost”, “root”);

// if everything is empty then returns with message.

if (empty($_POST[“user”]) || empty($_POST[“pwd”]) || empty($_POST[“mail”]) && isset($_POST[“save”]))

{

echo “Please enter your username with maximum 15 characters and password with maximum 15 characters properly with valid email ID.”;

}

// if values are properly posted, applies md5 hash to the password.

if (isset($_POST[“save”]) && $_POST[“user”] && $_POST[“pwd”] && $_POST[“mail”])

{

$user = $_POST[“user”];

$_POST[‘pwd’] = md5($_POST[‘pwd’]);

$pwd = $_POST[‘pwd’];

$mail = $_POST[“mail”];

}

// again when the value are properly posted, queries the database if the same username exists. If true then returns with message else writes on the database.

if (isset($_POST[“save”]) && $_POST[“user”] && $_POST[“pwd”] && $_POST[“mail”])

{

mysql_select_db(“user_logs”, $con);

$checkuser = mysql_query(“SELECT username FROM user WHERE username=’$user'”);

$username_exist = mysql_num_rows($checkuser);

}

if($username_exist > 0)

{

echo “The username you’ve request has already been taken, please try any other username.”;

}

elseif (isset($_POST[“save”]) && $_POST[“user”] && $_POST[“pwd”] && $_POST[“mail”]) {

mysql_select_db(“user_logs”, $con);

$write = “INSERT INTO user (username, password, email) VALUES (‘$user’, ‘$pwd’, ‘$mail’)”;

mysql_query($write, $con);

echo “Congraturlations, you’ve been registered”;

mysql_close($con);

}

?>

<br />

<span style=”text-align:right;”>Already registered? <a href=”login.php”>Click here to Login</a></span>
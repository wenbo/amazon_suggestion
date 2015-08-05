<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
		echo("no");
  die('Could not connect: ' . mysql_error());
  }
else{
	echo("connected ok");
}

// some code

?>
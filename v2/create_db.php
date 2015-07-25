<?php

//connects to the database

$con= mysql_connect(“localhost”, “root”, “”);

// creates command new database named user_logs

$dbase= “CREATE DATABASE user_logs”;

//creates new database using mysql_query function.

mysql_query($dbase, $con);

//selects recently created user_logs database

mysql_select_db(“user_logs”, $con);

//creates new user table with columns in user_logs dtabase.

$sqls = “CREATE TABLE user

(

username VARCHAR(15),

password VARCHAR(15),

email VARCHAR(50),

userID int NOT NULL AUTO_INCREMENT,

PRIMARY KEY(userID)

)”;

// Execute query

mysql_query($sqls, $con);

// closes the connection.

mysql_close($con);

?>
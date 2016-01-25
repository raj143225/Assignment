<?php
$db_username = "rajkumar";
$db_password = "rajkumar";
$db_database = "REGISTRATION";
$connection = mysqli_connect('localhost', $db_username, $db_password, $db_database);
if (!$connection) 
{	
	echo "problem<br/>";
	die("Connection Problem");
}
?>
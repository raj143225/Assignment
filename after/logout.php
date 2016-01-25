<?php
	session_start();
	//$_SESSION['id']=null;
	//$_SESSION['username']=null;
	session_destroy();
	session_start();
	$_SESSION['logout']="You have successfully logged out!";
	header("Location: login.php");
?>
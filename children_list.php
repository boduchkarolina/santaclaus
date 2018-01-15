<?php
	session_start();
	if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in']== false {
		header("Location: login.php");
	}
?>

<h2> You have logged in! </h2>
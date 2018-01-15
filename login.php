<!DOCTYPE HTML>

<?php
	session_start();
$_SESSION['logged_in'] = false;
	$username ="santaclaus";
	$password ="Laponia";

	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		header("Location: ./children_list.php");
	}

	if (isset($_POST['username']) && isset($_POST['password'])) {
		if ($_POST['username'] == $username && $_POST['password'] == $password)
	{
			$_SESSION['logged_in'] = true;
			header("Location: ./children_list.php");  
		}
}
?>

<html>
	<body>
		<form method="post" action="login.php">
			Username:<br/>
			<input type="text" name="username">
			Password<br/>
			<input type="password" name="password">
			<input type="submit" value="LOG IN">
		</form>
	</body>

</html>
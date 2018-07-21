<?php
	require_once("./config.php");
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	$username = $_POST['username'];
	$pwd = $_POST['password'];

	$result = mysqli_query($con, "select username from user where username='$username' and password='$pwd'");
	if (mysqli_num_rows($result) > 0) {
		mysqli_close($con);
		header('Location: ./doCalculate.php');
	}
?>
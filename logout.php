<?php
	include('connect.php');
	session_start();
	$sql = "update shites set activ = false WHERE id = ".$_SESSION['id'];
	$result = $conn -> query($sql);
	session_destroy();
	header("Location: index.php");
?>
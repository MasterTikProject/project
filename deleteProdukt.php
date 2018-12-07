<?php
	
	include('connect.php');
	
	$id = mysqli_real_escape_string($conn,$_POST['id']);
	$sql = "delete from produkte where id = '".$id."'";
	$result = $conn -> query($sql);
	if ( $result){
		echo "OK";
	}
	else{
		echo "ERROR";
	}
	
	
?>
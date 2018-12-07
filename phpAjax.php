
<?php
	error_reporting(E_ALL ^ E_NOTICE);
	include('connect.php');
	
	
	if($_GET['action']=="getSasi"){
			
		$emri = mysqli_real_escape_string($conn, $_POST['emri']);
		
		$sql = "select sasia from produkte where emri ='".$emri."'";
		$result = $conn -> query($sql);
		$row = $result->fetch_assoc();
		$obj = [];
		$obj['query']= "ok";
		$obj['sasi']= $row['sasia'];
		echo json_encode($obj);
		
		
		
		
	}	
	


?>
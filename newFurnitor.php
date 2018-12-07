<?php
	include ('connect.php');
	error_reporting(E_ALL ^ E_NOTICE);
	function newfurnitor() { 
		global $conn;
		$fullname = mysqli_real_escape_string ($conn,$_POST['emriFurnitor']); 
		$qyteti = mysqli_real_escape_string ($conn,$_POST['qytetiFurnitor']); 
		
		
		$query = "INSERT INTO furnitor (emer,qyteti) VALUES ('$fullname','$qyteti')"; 
		$data = $conn -> query ($query); 
		if($data) {
			$sql = "SELECT * FROM furnitor WHERE emer = '".mysqli_real_escape_string($conn,$_POST['emriFurnitor'])."'";
			$result = $conn->query ($sql); 
			$row = $result -> fetch_assoc() ;
			
			$myObj = [];
			$myObj['emer'] = $row['emer'];
			$myObj['qyteti'] = $row['qyteti'];
			$myObj['id'] = $row['id'];
			$myObj['query'] = "ok";
			$myJSON = json_encode($myObj);
			echo $myJSON;
			
			
			
		} 
	} 
	
		if(!empty($_POST['emriFurnitor'])) {
			
		$sql = "SELECT * FROM furnitor WHERE emer = '".$_POST['emriFurnitor']."' ";
		$result	= $conn->query($sql);	
		if(!$row = $result->fetch_assoc()) { 
			
				newfurnitor(); 
		} 
		else { 
			
			$myObj = [];
			$myObj['query'] = "error";
			$myJSON = json_encode($myObj);
			echo $myJSON;
		} 
		} 
	 
	
	
?>
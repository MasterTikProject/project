<?php
	include ('connect.php');
	error_reporting(E_ALL ^ E_NOTICE);
	function newuser() { 
		global $conn;
		$fullname = mysqli_real_escape_string ($conn,$_POST['name']); 
		$status = mysqli_real_escape_string ($conn,$_POST['statusi']); 
		$password = mysqli_real_escape_string ($conn,$_POST['pass']); 
		
		$query = "INSERT INTO shites (username,password,status) VALUES ('$fullname','$password','$status')"; 
		$data = $conn -> query ($query); 
		if($data) {
			$sql = "SELECT * FROM shites WHERE username = '".mysqli_real_escape_string($conn,$_POST['name'])."'";
			$result = $conn->query ($sql); 
			$row = $result -> fetch_assoc() ;
			
			$myObj = [];
			$myObj['name'] = $row['username'];
			$myObj['id'] = $row['id'];
			$myObj['query'] = "ok";
			$myJSON = json_encode($myObj);
			echo $myJSON;
			
			
			
		} 
	} 
	function SignUp() { 
		global $conn;
		if(!empty($_POST['name'])) {
			
		$sql = "SELECT * FROM shites WHERE username = '".$_POST['name']."' ";
		$result	= $conn->query($sql);	
		if(!$row = $result->fetch_assoc()) { 
			
				newuser(); 
		} 
		else { 
			
			$myObj = [];
			$myObj['query'] = "error";
			$myJSON = json_encode($myObj);
			echo $myJSON;
		} 
		} 
	} 
	
	$fullname = mysqli_real_escape_string ($conn,$_POST['name']); 
	
	  if(!empty($fullname)){
			
			$password = mysqli_real_escape_string ($conn,$_POST['pass']); 
			$password1 = mysqli_real_escape_string ($conn,$_POST['pass1']); 
			if($password == $password1){
			SignUp(); 
			}
			else {
				$myObj = [];
			$myObj['query'] = "error";
			$myJSON = json_encode($myObj);
			echo $myJSON;
			}
	  }
?>
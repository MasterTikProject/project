<?php
	include('connect.php');
	
	$menu =  mysqli_real_escape_string($conn,$_POST['menu']);

	if($menu == "fatur"){		
			
					$id = mysqli_real_escape_string($conn,$_POST['id']);
					$sql = "delete from faturat where id = '".$id."'";
					$result = $conn -> query($sql);
					$sql = "delete from shitjet where fatur_id = '".$id."'";
					$result = $conn -> query($sql);
					if ( $result){
						echo "OK";
					}
					else{
						echo "ERROR";
					}
	}
	elseif($menu == "shites"){
		
		$id = mysqli_real_escape_string($conn,$_POST['id']);
					$sql = "delete from shites where id = '".$id."'";
					$result = $conn -> query($sql);
					if ( $result){
						echo "OK";
					}
					else{
						echo "ERROR";
					}
	}
	elseif($menu == "furnitor"){
		
		$id = mysqli_real_escape_string($conn,$_POST['id']);
					$sql = "delete from furnitor where id = '".$id."'";
					$result = $conn -> query($sql);
					if ( $result){
						echo "OK";
					}
					else{
						echo "ERROR";
					}
	}
					


?>
<?php
include ('connect.php');
error_reporting(E_ALL ^ E_NOTICE);

$sql = "SELECT id, username,password,status FROM shites where username='".mysqli_real_escape_string ( $conn,$_POST["emri"])."' and password='".mysqli_real_escape_string ( $conn,$_POST['pass'])."'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // output data of each row
    $row = $result->fetch_assoc() ;
	
	 session_start();
	$_SESSION[id]=$row['id'];
	$_SESSION[username]=$row['username'];
	$_SESSION[status] = $row['status'] ;
	$sql = "update shites set activ = true where id = ".$row['id'];
	$result = $conn->query($sql);
	header("Location: dashboard.php ");
	
} else {
    header("Location: index.php ");
}
$conn->close();






?>
<?php
	error_reporting(E_ALL ^ E_NOTICE);
	include('function.php');
	isLoggedIn();
	include('connect.php');
	
?>
<!DOCTYPE html>
<html>
    <head>
      
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
		<link rel="stylesheet" href="style.css">
		
		<script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.0/moment.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootpag/1.0.4/jquery.bootpag.js"></script>
		<script src="main.js"></script>
		
<style>
body {
		
		background-color: #ffffff;
		background-repeat: no-repeat ;
		background-size : 100% 400% ;
	}
</style>    

  
  </head>
<body >
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    
    <ul class="nav navbar-nav">
		<li <?php echo $_GET['menu']=="" ? "class=\"active\"":"";  ?>><a href="dashboard.php" >Shto Fatur</a></li>
		<li <?php echo $_GET['menu']=="faturat" ? "class=\"active\"":"";  ?> ><a href="dashboard.php?menu=faturat">Faturat</a></li>
		<li <?php echo $_GET['menu']=="shitesit" ? "class=\"active\"":"";  ?>><a  href="dashboard.php?menu=shitesit">Shitesit</a></li>
		<li <?php echo $_GET['menu']=="shtoartikuj" ? "class=\"active\"":"";  ?>><a  href="dashboard.php?menu=shtoartikuj">Shto Artikuj</a></li>
		<li <?php echo $_GET['menu']=="Shitje" ? "class=\"active\"":"";  ?>><a  href="dashboard.php?menu=Shitje">Shitje</a></li>
		<li <?php echo $_GET['menu']=="bilanc" ? "class=\"active\"":"";  ?>><a  href="dashboard.php?menu=bilanc">Bilanc</a></li>
	<?php
		session_start();
		if($_SESSION[status]=="admin"){
		echo " <li "; echo $_GET['menu']=="active" ? "class=\"active\"":"";  echo "><a  href=\"dashboard.php?menu=active\">Active Users</a></li> "; }?>
	  <li class="pull-right"><a  href="logout.php">Log Out</a></li>
    </ul>
  </div>
</nav>
	<div id="div1" >
	<?php
	
	if($_GET['menu']=="faturat"){
		include('faturat.php');
		
	}
	elseif($_GET['menu']=="shitesit"){
		include('shitesit.php');
	}	
	elseif($_GET['menu']=="shtoartikuj"){
		include('shtoartikuj.php');
	}
	elseif($_GET['menu']=="Shitje"){
		include('Shitje.php');
	}
	elseif($_GET['menu']=="active"){
		include('active.php');
	}
	elseif($_GET['menu']=="bilanc"){
		include('bilanc.php');
	}
	else {
		include('shto.php');
	}
	?>
	
	
	</div>


</body>

</html>

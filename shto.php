<?php
	include ('connect.php');
	error_reporting(E_ALL ^ E_NOTICE);
	isLoggedIn();
	$sql = "SELECT emri FROM produkte";
	$result = $conn->query($sql);

?>
<?php 
	
	if(!empty($_POST)){
		
		$vlera = 0;
		foreach($_POST[emri] as $k => $v ){
	
		
			
			$emri = mysqli_real_escape_string($conn,$_POST['emri'][$k]);
			$sasia = mysqli_real_escape_string($conn,$_POST['sasia'][$k]);
			
			$vler = mysqli_query ($conn," SELECT cmimi FROM  produkte WHERE emri = '".$emri."' " );
			$row = mysqli_fetch_assoc($vler);
			$vlera = $vlera + ($sasia * $row['cmimi']);
			
			$query = "SELECT * FROM produkte WHERE emri = '".$emri."'";  
			$res = mysqli_query ($conn,$query)or die(mysqli_error($conn)); 
			if($res->num_rows > 0) { 
				$row = $res->fetch_assoc();
				 
				if($row['sasia']>=$sasia){
				$change= "update produkte set sasia=sasia-".$sasia." where emri='".$emri."'";
				$resul = mysqli_query ($conn,$change); 
				
			}
			}
			
			
			if($resul){
				$a = true; 
				
				
			}
			else{
				
				
				$a = false;
			}
		}
		if ($a){
			
			$shites = mysqli_real_escape_string($conn,$_SESSION['id']);
			$produkte = mysqli_real_escape_string($conn, json_encode($_POST));
			$data = date("Y/m/d/h/i/sa");
		
			$tvsh = ($vlera/100)*20;
			$totali= $vlera + $tvsh ;
			$query =  $conn -> query("insert into faturat (shites_id,produktet,data,vlera,tvsh,totali) 
										values 
										('".$shites."','".$produkte."','".$data."','".$vlera."','".$tvsh."','".$totali."') ");
			
			$last_id = $conn->insert_id ;
			foreach($_POST[emri] as $k => $v ){
				$emri = mysqli_real_escape_string($conn,$_POST['emri'][$k]);
				$query = "SELECT * FROM produkte WHERE emri = '".$emri."'";  
				$result1 = $conn -> query($query);
				$row = $result1 ->fetch_assoc();
			$vler = mysqli_query ($conn," SELECT cmimi FROM  produkte WHERE emri = '".$emri."' " );
			$row1 = mysqli_fetch_assoc($vler);
			
				$sql = "insert into shitjet (product_id,cmimi,fatur_id,sasia,data,user_id,vlera) value ('".$row['id']."','".$row['cmimi']."','".$last_id."','".$sasia."','".$data."','".$shites."','".($sasia*$row['cmimi'])."')";
				$result2 = $conn -> query($sql);
			}
			
			
			
			echo "<div class=\"alert alert-success\">
  <strong>Success! </strong> U ruajt.
</div>";

		}
		else {
			echo "
			<div class=\"alert alert-danger\">
  <strong>ERROR!</strong> Nuk u ruajt.
</div>";
		}
		
		
		
	}
	
	
?>

<div class="container">
	<div class="col-xs-6">
		<form method="POST" >
			<div class="col-xs-12 inputet">
				<div class="form-group col-xs-12" id="copy">
					<div class="col-xs-6">
						<label for="sel1" class="col-xs-12">Emrin e produktit</label>
						<select class="selectpicker" name="emri[]" onchange="getSasi(this)" data-live-search="true">
								<?php
								
									if ($result->num_rows > 0) {
										echo "<option ></option>";
										while($row = $result->fetch_assoc()) {
											
											echo "<option >".$row['emri']."</option>";
										}
									}
								?>
						</select>
					</div>
					<div class="col-xs-6" id="divSasia">
						<label for="ex3">Sasia</label>
						<input class="form-control" name="sasia[]" id="sasia[]" max="20" min="1" type="text" placeholder="">
					</div>
				</div>
			</div>
			<script>
				var copyDiv = $('<div>').append($('#copy').clone()).html();
			</script>
			
			<div class="col-xs-12">
			 <br>
				
				<input type="submit"   class="btn btn-info printo" value="SAVE" >
				<br>
			</div>
		</form>
	</div>
	<div class="col-md-6">
		<br>
		<button type="button" name="shto" class="btn btn-info col-xs-3">
			Shto Artikull
		</button>
	</div>
	<div class="col-md-6">
	<br>
		<button type="button" name="fshiFaturElement" class="btn btn-info col-xs-3">
			Fshi Artikull
		</button>
	
	</div>
</div>  

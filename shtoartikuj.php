<?php	
include('connect.php');
	if(!empty($_POST)){
		
		$sql = "SELECT emri FROM produkte where emri = '".mysqli_real_escape_string($conn,$_POST[emri])."'";
		$result = $conn->query ($sql); 
		
		
		 $row = $result -> fetch_assoc() ;
		
		if(empty($row)){
			$emer = mysqli_real_escape_string($conn,$_POST['emri']);
			$cmimi = mysqli_real_escape_string($conn,$_POST['cmimi']);
			$sasia = mysqli_real_escape_string($conn,$_POST['sasia']);
			$furnitor_emer = mysqli_real_escape_string($conn,$_POST['furnitor']);
			echo $s = "select id from furnitor where emer = \"".$furnitor_emer."\"";
			$r = $conn->query($s);
			$row = $r->fetch_assoc();
			
			$sql= "insert into produkte (emri,cmimi,sasia,furnitor_id) value('".$emer."','".$cmimi."','".$sasia."','".$row['id']."')";
			if ($conn->query($sql) === TRUE) {
			
				echo "<div class=\"alert alert-success\">
						<strong>Success! </strong> U ruajt.
						</div>";
			}
			else {
			
				echo "<div class=\"alert alert-success\">
					 <strong>ERROR! </strong> Nuk u ruajt.
					</div>" . $sql . "<br>" . $conn->error;
			}
		}
		else{
			
			$sql = "update produkte set cmimi = ".mysqli_real_escape_string($conn,$_POST[cmimi])." , sasia = sasia + ".mysqli_real_escape_string($conn,$_POST[sasia])." where emri= '".mysqli_real_escape_string($conn,$_POST[emri])."'";
			$result = $conn->query($sql);
		}
	
	}

session_start()	;
if($_SESSION[status]=="admin"){

		echo "
		<div class=\"container\">
		  <form method=\"post\" action=\"/bilanc/dashboard.php?menu=shtoartikuj\">
			<div class=\"form-group row\">
			  <div class=\"col-xs-2\">
				<label for=\"ex1\" class=\"required\" >Emri</label>
				<input class=\"form-control\" required name=\"emri\" type=\"text\">
			  </div>
			  <div class=\"col-xs-2\">
				<label for=\"ex2\" class=\"required\">Cmimi</label>
				<input class=\"form-control\" name=\"cmimi\" required type=\"text\">
			  </div>
			  <div class=\"col-xs-2\">
				<label for=\"ex3\" class=\"required\">Sasia</label>
				<input class=\"form-control\" required name=\"sasia\" type=\"text\">
			  </div>
			 
			  <div class=\"col-xs-3\">
				<label for=\"ex1\"  >Furnitor</label><br>
				<select class=\"selectpicker\" name=\"furnitor\"  data-live-search=\"true\" >";
								$sqlusername = "select emer from furnitor ";
									$result = $conn-> query($sqlusername);
									if ($result->num_rows > 0) {
										echo "<option ></option>";
										while($row = $result->fetch_assoc()) {
											
											echo "<option >".$row['emer']."</option>";
										}
									}
				echo "
				</select>
			</div>
			  <div class=\"col-xs-2\">
			  <br>
			  <input type=\"submit\" class=\"btn btn-primary\" value=\"Krijo Artikull\" >
			  </div>
			</div>
		  </form> ";
}
?>
	<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
              <th width="10%">ID</th>
                <th>Emri</th>
				<th>Furnitor</th>
                <th>Cmimi</th>
				<th>Sasia</th>
                <?php
				session_start();
				if($_SESSION[status]=="admin"){
				echo"<th width=\"2%\">Delete</th>";}
				?>
			</tr>
        </thead>
        
        <tbody>
		<?php
			
			$sql = "select produkte.*, furnitor.emer as f_emer FROM produkte join furnitor on produkte.furnitor_id = furnitor.id ";
			$results = $conn->query($sql);
			while($row = $results->fetch_assoc()){
				
			echo "
            <tr id=\"".$row['id']."\">
                <td>".$row['id']."</td>
                <td>".$row['emri']."</td>
				<td>".$row['f_emer']."</td>
                <td>".$row['cmimi']."</td>
                <td>".$row['sasia']."</td>";
                if($_SESSION[status]=="admin"){
				echo"<td>
					<input type=\"button\" name=\"delete\" value=\"Delete\" id=\"delete\" class=\"btn btn-primary\" onclick=\"deleteProdukt(".$row['id'].")\">
				</td>";}
            echo"</tr>";
			
			}
		?>

		
        </tbody>
    </table>
</div>

<script>
	
	$(document).ready(function() {
    
		$('#example').DataTable();
	} );

	
	
	
</script>




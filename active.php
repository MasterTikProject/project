<?php 
	isLoggedIn();


?>

<table border="1" width="95%" height="500" >
	<tr>
		<td width="45%" valign="top">
		<div class="container col-xs-12 ">	
			<h3>Personat Aktiv</h3>
			<table id="example" class="display exampleShites" cellspacing="0" width="100%" >
			
				<thead>
					<tr>
					  <th>ID</th>
					  <th>Emri</th>
					  <th>Status</th>
					</tr>
				</thead>
				<tbody id="activeusers">
				
				
				
				</tbody>
			</table>
		</div>
		</td>
		<td width="45%" valign="top">
		<div class="col-xs-12">
<?php			
			echo "
			<div class=\"col-xs-12\"> <h3>Shto Furnitor</h3>
				<form method=\"post\" action=\"/bilanc/dashboard.php?menu=active\">
					<div class=\"form-group row\" id=\"newFurnitor\">
						<div class=\"col-xs-4\">
							<label for=\"ex1\" class=\"required\" >Emri</label>
							<input class=\"form-control\" required name=\"emriFurnitor\" type=\"text\">
						</div>
						<div class=\"col-xs-4\">
						<label for=\"ex1\" class=\"required\" >Qyteti</label>
							<input class=\"form-control\" required name=\"qytetiFurnitor\" type=\"text\">
						</div>
						<div class=\"col-xs-1 \">
						<br>
						<input type=\"button \" class=\"btn btn-primary\" value=\"Krijo Furnitor\" onclick=\"shtoFurnitor()\" name=\"krijoFurnitor\" id=\"krijoFurnitor\"  >
					</div>
					</div>
				</form> 
			</div>  ";

?>
		<table class="tabelFurnitor" width="100%">
			<thead>
				<tr>
					<th>Id</th>
					<th>Emer</th>
					<th>Qyteti</th>
					<th>Delete</th>
										
				</tr>
			</thead>
			<tbody>
			<?php
			$sql = "select * from furnitor ";
			$res = $conn->query($sql);
			while($row = $res->fetch_assoc()){
				echo"
				<tr>
				<td>".$row['id']."</td>
				<td>".$row['emer']."</td>
				<td>".$row['qyteti']."</td>
				<td><button id=\"".$row['id']."\" type=\"button\" class=\"btn btn-danger\" onclick=\"deleteFurnitor(".$row['id'].")\">Delete</button></td>
				</tr>";
				
				
				
			}
			
			
			?>
			</tbody>
				
		
		
		</table>




		</div>
		</td>
	</tr>
</table>
<script>
	window.setInterval(function(){
	
		$.post("activeusers.php",
		function(data){
			$("#activeusers").empty();
			$('#activeusers').append(data);
			
		});
	}, 5000);


</script>
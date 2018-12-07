<?php 

session_start();

if($_SESSION[status]=="admin"){
echo "
		<div class=\"col-xs-6\">
			<form method=\"post\" action=\"/bilanc/dashboard.php?menu=shitesit\">
				<div class=\"form-group row\" id=\"newShites\"> 
					<div class=\"col-xs-6\">
						<label for=\"ex1\" class=\"required\" >Emri</label>
						<input class=\"form-control\" required name=\"emri\" type=\"text\">
					</div>
					<div class=\"col-xs-6\">
							<label for=\"ex2\" class=\"required col-xs-12\" >Statusi</label>
							<select class=\"selectpicker form-group row col-xs-12\" name=\"statusShites\" data-live-search=\"true\">
									<option >user</option>
									<option >admin</option>
							</select>
					</div>
					<div class=\"col-xs-12\">
					<br>
					</div>
					<div class=\"col-xs-6\">
						<label for=\"ex3\" class=\"required\">Password</label>
						<input class=\"form-control\" required name=\"pass\" type=\"password\">
					</div>
					<div class=\"col-xs-6\">
						<label for=\"ex3\" class=\"required col-xs-12\">Retype Password</label>
						<input class=\"form-control\" required name=\"pass1\" type=\"password\">
					</div>
					<div class=\"col-xs-2 col-xs-offset-8\">
						<br>
						<input type=\"button \" class=\"btn btn-primary\" value=\"Krijo Shites\" onclick=\"shtoShites()\" name=\"krijoShites\" id=\"krijoShites\"  >
					</div>
				</div>
			</form> 
		</div>  ";

}
?>



<div class="container col-xs-6">	
	<table id="example" class="display exampleShites" cellspacing="0" width="100%" >
	
        <thead>
            <tr>
              <th>ID</th>
              <th>Emri</th>
<?php
	
	

	
			session_start();
			  if($_SESSION[status]=="admin"){
				  
				  echo "<th>Delete</th>";
				  
			  }
	?>
			  
            </tr>
        </thead>
        
        <tbody>
		<?php
			
			$sql = "select * FROM shites ";
			$results = $conn->query($sql);
			while($row = $results->fetch_assoc()){
				
			echo "
				<tr>
					<td>".$row['id']."</td>
					<td>".$row['username']."</td>";
			
				if($_SESSION[status]=="admin"){
				  
				  echo "<td><button id=\"".$row['id']."\" type=\"button\" class=\"btn btn-danger\" onclick=\"deleteShites(".$row['id'].")\">Delete</button></td>";
				}
			echo "	</tr>";
			
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
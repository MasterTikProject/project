<?php 
	include('connect.php');
	error_reporting(E_ALL ^ E_NOTICE);

			
			$sql = "select * FROM shites where activ = true";
			$results = $conn->query($sql);
			while($row = $results->fetch_assoc()){
				
			echo "
				<tr>
					<td>".$row['id']."</td>
					<td>".$row['username']."</td>
					<td>".$row['status']."</td>";
			}
		?>
	

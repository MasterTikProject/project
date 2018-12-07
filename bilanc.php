<?php

	isLoggedIn();
	include ('connect.php');
	error_reporting(E_ALL ^ E_NOTICE);

?>

<div  class="col-xs-12">
	<form method="GET" action="dashboard.php?menu=bilanc">
		<div class='col-xs-3 '>
			<div class="form-group">
				<label for="ex1" class=" col-md-10" >Start Date</label>
				<div class='input-group' id='fromDate'>
					<input type='text' class="form-control" name="fromDate" id='fromDate' value="<?php echo $_GET['fromDate'] ; ?>"/>
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
			</div>
		</div>
		<div class='col-xs-3'>
			<div class="form-group">
				<label for="ex1" class=" col-md-10" >End Date </label>
				<div class='input-group' id='dateTo'>
					<input type='text' class="form-control" name="dateTo" id="dateTo"  value="<?php echo $_GET['dateTo'] ; ?>"/>
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
			</div>
		</div>
		<input type="hidden" name="menu" value="bilanc">
		<div class="form-group row">
			<div class="col-xs-2">
				<label for="ex1"  >Shites</label><br>
				<select class="selectpicker" name="shites" onchange="getSasi(this)" data-live-search="true" >
							<?php
								$sqlusername = "select username from shites ";
									$result = $conn-> query($sqlusername);
									if ($result->num_rows > 0) {
										echo "<option ></option>";
										while($row = $result->fetch_assoc()) {
											
											echo "<option".	($_GET['produkte']==$row['username'] ?  " selected" : " ")." >".$row['username']."</option>";
										}
									}
								?>
				</select>
			</div>
			<div class="col-xs-2">
				<label for="ex1"  >Produkt</label><br>
				<select class="selectpicker" name="produkte" onchange="getSasi(this)" data-live-search="true" >
							<?php
								$sqlusername = "select emri from produkte ";
									$result = $conn-> query($sqlusername);
									if ($result->num_rows > 0) {
										echo "<option ></option>";
										while($row = $result->fetch_assoc()) {
											
											echo "<option".	($_GET['produkte']==$row['emri'] ?  " selected" : " ")." >".$row['emri']."</option>";
										}
									}
								?>
				</select>
			</div>
			<div class="col-xs-1">
				<br>
				<input type="submit" class="btn btn-info" value="Filtro" >
			</div>
			<br>	
		</div>
	</form>
</div>


<div class=" col-xs-11 col-md-offset-3">
	<table>
		<tr>
			
			<th width="20%"> Emri </th>
			<th width="20%"> Produkte</th>
			<th width="10%"> Vlera</th>
		 </tr>

<?php
	$dateTo = mysqli_real_escape_string($conn , $_GET['dateTo']);
	$fromDate = mysqli_real_escape_string($conn , $_GET['fromDate']);
	$emriFilter = mysqli_real_escape_string($conn , $_GET['shites']);
	$produkteFilter = mysqli_real_escape_string($conn , $_GET['produkte']);
	
	$limit =  ((empty($_GET['page']) ? 1 : $_GET['page']) -1)*20 .",20";
	$sql = "SELECT SUM(shitjet.vlera) as shuma , shites.username as username FROM shitjet join shites on shitjet.user_id = shites.id join produkte on shitjet.product_id = produkte.id   where 1=1 ";
	$sql_result = "SELECT id FROM shitjet where 1=1 ";
	if(!empty($fromDate)){
		
			$sql .= " and data >= '$fromDate' "; 
			$sql_result .= " and data >= '$fromDate' ";
		}
		if(!empty($dateTo)){
		
			$sql .=" and data <= '$dateTo' ";  
			$sql_result .=" and data <= '$dateTo' ";
		}
		if(!empty($emriFilter)){
			
			$sql .=" and shites.username = '$emriFilter' ";  
			$sql_result .=" and shites.username = '$emriFilter' ";
			
		}
		if(!empty($produkteFilter)){
			
			$sql .=" and produkte.emri = '$produkteFilter' ";  
			$sql_result .=" and produkte.emri = '$produkteFilter' ";
			
		}
	
	
	
	
	
	
	$sql .=  "  GROUP by shites.username order by shitjet.id desc limit $limit ";
	$result = $conn->query($sql);
	$tot = 0;
	while($row = $result -> fetch_assoc()){
		
		echo "
				<tr id=\"".$row['fatur_id']."\" onclick=\"trEfect(".$row['id'].")\" onmouseout=\"trEfectback(".$row['id'].")\" >
					
				
					<td>".$row['username']."</td><td>";
					if(!empty($produkteFilter)){echo $produkteFilter ; } else {echo "TE gjitha" ;}
		
		echo "		</td>	<td>".$row['shuma']."</td>
				</tr> ";
		
		$tot = $tot + $row['shuma'];
		
	}
	$sql_result ;
	$result1 = $conn -> query ($sql_result);
	$row_number = $result1->num_rows;
	
	
	
?>
	<tfoot>
		<tr>
		<td></td>
		<td>Totali = </td>
		<td><?php echo $tot; ?></td>
		</tr>
	
	</tfoot>

</table>
<div id="pagination" class="col-xs-8 pagination centered text-center"></div>
</div>



<script>
        // init bootpag
        $('.pagination').bootpag({
            total: <?php echo  ceil($row_number/20) ; ?>,
			maxVisible: 5 ,
			page: <?php echo empty($_GET['page']) ? 1 : $_GET['page'] ;?>
			
        }).on("page", function(event, /* page number here */ num){
           
		   var uri = window.location.href;
		   var new_url = updateQueryStringParameter(uri, "page",num);
		   window.open(new_url, "_self");
        });
		$( "ul.bootpag" ).addClass( "pagination" );
		
		$(document).ready(function(){
			
			$('#fromDate').datetimepicker({
				format:'YYYY-MM-DD HH:mm:ss'
			});
			$('#dateTo').datetimepicker({
				format:'YYYY-MM-DD HH:mm:ss'
			});
			
		});
</script>		
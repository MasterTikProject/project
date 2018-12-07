<?php

	isLoggedIn();
	include ('connect.php');
	error_reporting(E_ALL ^ E_NOTICE);

?>

<div  class="col-xs-12">
	<form method="GET" action="">
		<div class='col-xs-3 col-md-offset-1'>
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
		<input type="hidden" name="menu" value="Shitje"	
		<div class="form-group row">
			<div class="col-xs-3">
				<label for="ex1"  >Produkt</label><br>
				<select class="selectpicker" name="emri" onchange="getSasi(this)" data-live-search="true" >
							<?php
								$sqlusername = "select emri from produkte ";
									$result = $conn-> query($sqlusername);
									if ($result->num_rows > 0) {
										echo "<option ></option>";
										while($row = $result->fetch_assoc()) {
											
											echo "<option".	($_GET['emri']==$row['emri'] ?  " selected" : " ")." >".$row['emri']."</option>";
										}
									}
								?>
				</select>
			</div>
			<div class="col-xs-2">
				<br>
				<input type="submit" class="btn btn-info" value="Filtro" >
			</div>
			<br>	
		</div>
	</form>
</div>


<div class=" col-xs-11 ">
	<table>
		<tr>
			<th width="5%">ID Fatures</th>
			<th width="20%"> Emri </th>
			<th width="20%"> Shites </th>
			<th width="20%"> DATA</th>
			<th width="10%"> Sasia</th>
			<th width="10%"> Cmimi</th>
			<th width="10%"> Vlera</th>
		 </tr>

<?php
	$dateTo = mysqli_real_escape_string($conn , $_GET['dateTo']);
	$fromDate = mysqli_real_escape_string($conn , $_GET['fromDate']);
	$emriFilter = mysqli_real_escape_string($conn , $_GET['emri']);
	
	$limit =  ((empty($_GET['page']) ? 1 : $_GET['page']) -1)*20 .",20";
	$sql = "SELECT shitjet.* , produkte.emri  FROM shitjet join produkte on shitjet.product_id = produkte.id   where 1=1 ";
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
			
			$sql .=" and emri = '$emriFilter' ";  
			$sql_result .=" and emri = '$emriFilter' ";
			
		}
	
	
	
	
	
	
	$sql .=  " order by shitjet.id desc limit $limit ";
	$result = $conn->query($sql);
	
	while($row = $result -> fetch_assoc()){
		$findName = "select username from shites where id = ".$row['user_id'];
		$re = $conn -> query ($findName);
		$r = $re -> fetch_assoc();

		echo "
				<tr id=\"".$row['fatur_id']."\" onclick=\"trEfect(".$row['id'].")\" onmouseout=\"trEfectback(".$row['id'].")\" >
					
					<td>".$row['fatur_id']."</td>
					<td>".$row['emri']."</td>
					<td>".$r['username']."</td>
					<td>".$row['data']."</td>
					<td>".$row['sasia']."</td>
					<td>".$row['cmimi']."</td>
					<td>".$row['vlera']."</td>
				</tr> ";
		
		
		
	}
	$sql_result ;
	$result1 = $conn -> query ($sql_result);
	$row_number = $result1->num_rows;
	
	
	
?>

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
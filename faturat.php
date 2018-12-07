<?php

	isLoggedIn();

?>



	 <div  class="col-xs-12">
		<form method="GET" action="dashboard.php?menu=faturat">
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
				<input type="hidden" name="menu" value="faturat"	
				<div class="form-group row">
				  <div class="col-xs-3">
					<label for="ex1"  >Shites</label><br>
					<select class="selectpicker" name="emri" onchange="getSasi(this)" data-live-search="true" >
									<?php
										$sqlusername = "select username from shites ";
										$result = $conn-> query($sqlusername);
										if ($result->num_rows > 0) {
											echo "<option ></option>";
											while($row = $result->fetch_assoc()) {
												
												echo "<option".	($_GET['emri']==$row['username'] ?  " selected" : " ")." >".$row['username']."</option>";
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
	<br>
<div class="col-xs-offset-1">
	<table>
		<tr>
			<th width="5%"> NR</th>
			<th width="25%"> SHITES</th>
			<th width="30%"> DATA</th>
			<th width="20%"> VLERA</th>
			<th width="25%"> OPSIONE</th>
		 </tr>
	
	<?php
	
		$fatura_per_faqe = 20;
		$fromDate = mysqli_real_escape_string($conn,$_GET['fromDate']);
		$dateTo = mysqli_real_escape_string($conn,$_GET['dateTo']);
		$emriFilter = mysqli_real_escape_string($conn,$_GET['emri']);
		
		$limit = ((empty($_GET['page']) ? 1 : $_GET['page']) -1)*$fatura_per_faqe .",$fatura_per_faqe";
		
		$nr=1*((empty($_GET['page']) ? 1 : $_GET['page']) -1)*$fatura_per_faqe+1;
		
		
		// $sql ="SELECT faturat.*,shites.username FROM faturat join shites on faturat.shites_id = shites.id  order by faturat.id desc limit $limit "; 
		$sql ="SELECT faturat.*,shites.username FROM faturat join shites on faturat.shites_id = shites.id where 1=1 "; 
		$sqlpagination ="SELECT faturat.*,shites.username as nr FROM faturat join shites on faturat.shites_id = shites.id where 1=1 "; 
		
		if(!empty($fromDate)){
		
			$sql .= " and data >= '$fromDate' "; 
			$sqlpagination .= " and data >= '$fromDate' ";
		}
		if(!empty($dateTo)){
		
			$sql .=" and data <= '$dateTo' ";  
			$sqlpagination .=" and data <= '$dateTo' ";
		}
		if(!empty($emriFilter)){
			
			$sql .=" and username = '$emriFilter' ";  
			$sqlpagination .=" and username = '$emriFilter' ";
			
		}
		
		$sql .= " order by faturat.id desc limit $limit ";
		$result = $conn->query($sql);
		$vleratotale = 0;
		while($row = $result->fetch_assoc()){	
		

			echo "
				<tr id=\"".$row['id']."\" onclick=\"trEfect(".$row['id'].")\" onmouseout=\"trEfectback(".$row['id'].")\" >
					<td>".$nr."</td>
					<td>".$row['username']."</td>
					<td>".$row['data']."</td>
					<td>".$row['totali']."</td>
					<td>
						<button id=\"".$row['id']."\" type=\"button\" class=\"btn btn-info\" onclick=\"afishoFatur(".$row['id'].")\">Afisho</button> ";
						session_start();
						
						if ($_SESSION[status]=="admin"){
							
							echo 
							" <button id=\"".$row['id']."\" type=\"button\" class=\"btn btn-danger\" onclick=\"deleteFatur(".$row['id'].")\">Delete</button> " ;
						}
	
			echo "	</td>
				</tr> ";
			$vleratotale = $vleratotale + $row['totali'] ;
			$nr++;
	 
		}			
 ?>
 
		<tr>
			<th width="5%"> </th>
			<th width="25%"> </th>
			<th width="30%"> Totali</th>
			<th width="20%"><?php echo $vleratotale ?></th>
			<th width="25%"> </th>
		 </tr>
 </table>
<div>
<!-- Modal -->
  <div class="modal fade" id="afishoFaturModal" role="dialog"> 
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Fatur</h4>
        </div>
        <div class="modal-body" id="modalFatur">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
			<button type="button" class="btn btn-default" onclick="printDiv('modalFatur')">Print</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
	
 <div id="pagination" class="col-xs-8 pagination centered text-center"></div>

 <?php
	
	
	$result = $conn->query($sqlpagination);
	$row = $result ->fetch_assoc();
	
	$total = ceil($nr/$fatura_per_faqe);
 
 
 ?>
<script>
        // init bootpag
        $('.pagination').bootpag({
            total: <?php echo $total ; ?> ,
			maxVisible: 10 ,
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
	
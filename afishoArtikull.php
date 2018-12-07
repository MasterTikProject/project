<?php
	error_reporting(E_ALL ^ E_NOTICE);
	include('connect.php');
	include('function.php');
	
	$id = mysqli_real_escape_string($conn,$_POST['id']);
	$sql = "select * from faturat where id = '".$id."'";
	$result = $conn -> query($sql);
	$row = $result->fetch_assoc();
	
	
	

?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="text-center"><strong>Fatura</strong></h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Artikulli</strong></td>
										<td class="text-center"><strong>Cmimi</strong></td>
										<td class="text-center"><strong>Item</strong></td>
										<td class="text-right"><strong>Total</strong></td>
									</tr>
								</thead>
								<tbody>
								<?php
								
									$produktet = json_decode($row['produktet'], true);


								  foreach($produktet['emri'] as $key => $v){
					
									$sql2 = "select cmimi from produkte where emri = \"".$v."\"";
									$res = $conn -> query($sql2);
						
									$cm = $res->fetch_assoc();
									$total = $cm['cmimi'] * $produktet['sasia'][$key]; 
									
									
									$subtotal = $subtotal + $total ;
									?>
										<tr>
											<td><?php echo $v ; ?></td>
											<td class=\"text-center\"><?php echo $cm['cmimi'] ; ?></td>
											<td class=\"text-center\"><?php echo $produktet['sasia'][$key]; ?></td>
											<td class=\"text-right\"><?php echo $total ; ?></td>
										</tr> 
										<?php
								  }
								?>  	
								   <tr>
										<td class="highrow"></td>
										<td class="highrow"></td>
										<td class="highrow text-center"><strong>VLERA</strong></td>
										<td class="highrow text-right"><?php echo $subtotal ; ?></td>
									</tr>
									<tr>
										<td class="emptyrow"></td>
										<td class="emptyrow"></td>
										<td class="emptyrow text-center"><strong>TVSH</strong></td>
										<td class="emptyrow text-right"><?php echo ($subtotal/100)*1 ; ?></td>
									</tr>
									<tr>
										<td class="emptyrow"><i class="fa fa-barcode iconbig"></i></td>
										<td class="emptyrow"></td>
										<td class="emptyrow text-center"><strong>Total</strong></td>
										<td class="emptyrow text-right"><?php echo $subtotal+(($subtotal/100)*1) ; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>


	<style>
	.height {
		min-height: 200px;
	}

	.icon {
		font-size: 47px;
		color: #5CB85C;
	}

	.iconbig {
		font-size: 77px;
		color: #5CB85C;
	}

	.table > tbody > tr > .emptyrow {
		border-top: none;
	}

	.table > thead > tr > .emptyrow {
		border-bottom: none;
	}

	.table > tbody > tr > .highrow {
		border-top: 3px solid;
	}
	</style>
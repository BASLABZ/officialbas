<br><br><br><br><br>
<h1>DATA MASTER ASET</h1> 
<?php 
		$id = $_GET['id'];
		$where = array(
				'KODEBIDANG' => $id
			);
		//print_r($where);
		$viewdetail = $mainindex->GETDATAOTOMATIS('BIDANG',$where);
		$row= ibase_fetch_object($viewdetail);
 ?>
<div class="row">
	<div class="col-sm-12">
	<div class="row">
		<div class="col-sm-3">
			<div class="panel panel-warning">
				<div class="panel-body">
					<form method="POST">
							<div class="form-group">
							<label>KODE BIDANG</label>
							<input type="text" disabled="" value="<?php echo $row->KODEBIDANG; ?>"> 
							</div>
							<div class="form-group">
								<label>NAMA BIDANG</label>
							<input type="text" disabled="" value="<?php echo $row->URAI; ?>">
							</div>
							
					</form>
				</div>
			</div>
		</div>
	</div>
	
	</div>
</div>
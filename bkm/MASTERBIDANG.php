<br><br><br><br><br>
<?php 
//$AUTOKODE = $mainindex->AUTOCODE('BIDANG',"B");
if(isset($_POST['simpan'])) {
	$KODEBIDANG = $_POST['KODEBIDANG'];
	$NAMABIDANG = $_POST['URAI'];
	$input = $mainindex->INSERTDATABIDANG('BIDANG',$KODEBIDANG,$NAMABIDANG);
	if ($input) {
		 echo "<script> alert('Terimakasih Data Berhasil Di Simpan'); 
          location.href='masterbidang.html' </script>";exit;
	}
}
 ?>
 <?php 
// if (isset($_GET['cmd']=='hapus')) 
// 	{
// 	//die($_GET['id']);
// 		//die();
// 		$ids = $_GET['id']; 
// 		$wheres = array(
// 			'KODEBIDANG'=>$ids);
// 			$hapus = $mainindex->DELETEDATA('BIDANG',$wheres);
// 			//print_r($hapus);
			
//  //	$hapus = mysql_query("DELETE FROM anggota where anggota_id = '$_GET[hapus]'");
//  	if ($hapus) {
// 				echo "<script> alert(' Data Berhasil Di Hapus'); location.href='masterbidang.html' </script>";exit; 	
//  	}
// 		 }

  ?>
<div class="row">
	<div class="col-sm-6">
		
		<div class="panel panel-primary">
			<div class="panel-heading">
				INPUT DATA BIDANG
			</div>
			<div class="panel-body">
			<form method="POST">
				<div class="form-group">
					<label>KODE BIDANG : <?php //echo $AUTOKODE; ?></label>
					<input type="text" name="KODEBIDANG" >
				</div>
				<div class="form-group">
					<label>NAMA BIDANG</label>
					<input type="text" name="URAI" >
				</div>
				<div class="form-group">
					<button class="btn btn-warning" name="simpan">SIMPAN</button>
				</div>
				
				
			</form>
		</div>
		</div>
	</div>
</div>
<h1>DATA MASTER ASET</h1> 

<div class="row">
	<div class="col-sm-12">
	<div class="row">
		<div class="col-sm-3">
			<div class="panel panel-warning">
				<div class="panel-body">
					<form method="POST">
							<div class="form-group">
								<select name="cari" class="form-control">
									<option value="NULL">Choose Item</option>
								</select>
							</div>
							<div></div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="table">
		<table class="table table-hover">
		<th>No</th>
		<th>KODEBIDANG</th>
		<th>URAI</th>
		<th>AKSI</th>
		
		<?php 
				$no = 0;
				//$KODEBIDANG = " ";
				$where = array(
						//param 
						//'KODEBIDANG'=>$KODEBIDANG
					);
				$tampungquery = $mainindex->GETDATAOTOMATIS('BIDANG',$where);
				
				while ($row = ibase_fetch_object($tampungquery)) {
					$id = $row->KODEBIDANG;
					echo "<tr>
						<td>".++$no."</td>
						<td>".$id."</td>
						<td>".$row->URAI."</td>
						<td>
						<a href='viewbidang/$id/detailbidang.html' class='btn btn-warning'>VIEW</a>

						<a href='masterbidang/$id/hapus/tes.html' class='btn btn-warning'>DELETE</a>
						</td>
						</tr>
							";
							// index.php?hal=masterbidang&id=$id&cmd=hapus
				}
		 ?>
		 </table>
	</div>
	</div>
</div>
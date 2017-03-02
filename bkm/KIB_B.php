<?php 
require 'config.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>KIB B</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<center>
					<h2>KARTU INVENTARIS BARANG (KIB) B
						PERALATAN DAN MESIN<br> INTRA COUNTABLE
					</h2>
				</center>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2">
				<div class="form gorup">
					<label>SKPD</label>
					<label>KABUPATEN/KOTA</label>
					<label>PROVINSI</label>
				</div>
			</div>
			<div class="col-sm-8">
				
			</div>
			<div class="col-sm-2">
				<label>KODE LOKASI</label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<table class="table table-bordered">
			<center>
			<tr>
				<td rowspan="2">NO</td>
				<td rowspan="2">JENIS BARANG</td>
				<td rowspan="2">NOMOR REGISTRASI</td>
				<td rowspan="2">MERK/TYPE</td>
				<td rowspan="2">UKURAN/CC</td>
				<td rowspan="2">BAHAN</td>
				<td rowspan="2">TAHUN PEMBELIAN</td>
				<td colspan="5">NOMOR</td>
				<td rowspan="2">ASAL-USUL CARA</td>
				<td rowspan="2">KONDISI</td>
				<td rowspan="2">HARGA</td>
				<td rowspan="2">KETERANGAN</td>
			</tr>
			
			<tr>
				<td>PABRIL</td>
				<td>RANGKA</td>
				<td>MESIN</td>
				<td>POSISI</td>
				<td>BPKB</td>
			</tr>
			<tr>
				<?php 
					for ($i=1; $i < 18 ; $i++) { 
						echo "<td>$i</td>";
					}
				 ?>
			</tr>
				
			</center>
			</table>
			
		</div>
	</div>

</body>
</html>
<?php 
require 'include.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>ASET</title>
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
					<h2>KARTU INVENTARIS BARANG (KIB) A 
						<br>TANAH <br>
						INTRA COUNTABLE
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
			<?php  
				$where = array(
					/*'KODEGOLONGAN'=>'1',
					'KODEBIDANG'=>'1',
					'KODEKELOMPOK'=>'11'*/
					);
				$tampung = $fungsi_si->view('KIBA',$where);// ambil query;
				$kolom = ibase_fetch_object($tampung);
			?>
				<label>Kode Lokasi : <?php echo $kolom->URAILOKASI; ?></label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<table class="table table-bordered">
			<center>
			<tr>
				<td rowspan="3">NO</td>
				<td rowspan="3">JENIS BARANG</td>
				<td colspan="2">NOMOR</td>
				<td rowspan="3">LUAS m2</td>
				<td rowspan="3">TAHUN PENGADAAN</td>
				<td rowspan="3">LETAK/ALAMAT</td>
				<td colspan="3">SATUAN TANAH</td>
				<td rowspan="3">PENGGUNAAN</td>
				<td rowspan="3">ASAL USUL</td>
				<td rowspan="3">HARGA(Ribuan Rp)</td>
				<td rowspan="3">KETERANGAN</td>
			</tr>
			<tr>
				<td rowspan="2">KODEBARANG</td>
				<td rowspan="2">REGISTRASI</td>
				<td rowspan="2">HAK</td>
				<td colspan="2">SATUAN TANAH</td>

			</tr>
			<tr>
				<td>Tanggal</td>
				<td>NOMOR</td>
			</tr>
			<tr>
				<?php 
					for ($i=1; $i < 15 ; $i++) { 
						echo "<td>$i</td>";
					}
				 ?>
			</tr>
			<?php
				$no = 0;
				
				 while ($row = ibase_fetch_object($tampung)) 
				 {
							echo "<tr>
									<td>".++$no."</td>
									<td>".$row->NAMAASET."</td>
									<td>".$row->KODEBARANG."</td>
									<td>".$row->NOREGS."</td>
									<td>".$row->LUAS."</td>
									<td>".$row->TAHUNPENGADAAN."</td>
									<td>".$row->ALAMAT."</td>
									<td>".$row->HAK."</td>
									<td>".$row->TGFIKAT."</td>
									<td>".$row->NOFIKAT."</td>
									<td>".$row->PENGGUNA."</td>
									<td>".$row->ASALUSUL."</td>
									<td>".$row->NILAI."</td>
									<td>".$row->KETERANGAN."</td>
									
									
									
									
									
									
									
								  </tr>";
				}
				?>
				
			</center>
			</table>
			
		</div>
	</div>

</body>
</html>
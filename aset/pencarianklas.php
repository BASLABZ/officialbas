<!DOCTYPE html>
<html>
<head>
	<title>PENCARIAN BERDASARKAN KLASIFIKASI</title>
</head>
<body>
<?php 
	$id = '01';
	$tahuns ='2015';
	$config = ibase_connect('E:\Masters\master\ASETFIX.GDB','ASET','t3mp3-t3l3s');
	$querys = "SELECT * FROM PRO_KLAS_KIB('$id','$tahuns')";
	$data = ibase_query($config,$querys);
	$no =0;

 ?> 
 <hr>
 <form method="POST">
 	<label>Nama Klasifikasi</label>
 	<select name="idklas">
 		<option value="null">pilih klasifikasi</option>
 		<?php 
 			$klas = 'SELECT * FROM KLASIFIKASI';
 			$dtklas = ibase_query($config,$klas);
 			while ($rowklas = ibase_fetch_object($dtklas)) 
 			{
 				echo "<option>".$rowklas->URAIKLAS."</option>";
 			}
 		 ?>
 	</select>
 </form>
 	<table border="1">
 			<th>No</th>
 			<th>Kode Klasifikasi</th>
 			<th>Klasifikasi</th>
 			<th>No Reg.</th>
 			<th>Tahun Pengadaan</th>
 			<th>Kode Barang</th>
 			<th>Kode Lokasi</th>
 			<th>SATUAN</th>

 			<?php 
 				while ($row = ibase_fetch_object($data)) {
 					echo "<tr>
 							<td>".++$no."</td>
 							<td>".$row->KODKLAS."</td>
 							<td>".$row->URAIKELAS."</td>
 							<td>".$row->NOREG."</td>
 							<td>".$row->TAHUNPENGADAAN."</td>
 							<td>".$row->KODEBARANG."</td>
 							<td>".$row->KODELOKASI."</td>
 							<td>".$row->SATUANS."</td>
				
 						</tr>
 							";
 				}
 			 ?>
 			

 	</table>


</body>
</html>
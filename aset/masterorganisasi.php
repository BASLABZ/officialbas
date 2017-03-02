<!DOCTYPE html>
<html>
<head>
	<title>DATA ORGANISASI</title>
</head>
<body>
		<?php 
				$config = ibase_connect('E:\Masters\master\ASETFIX.GDB','ASET','t3mp3-t3l3s');
				$query = 'SELECT * FROM ORGANISASI';
				$data = ibase_query($config,$query);

				$no=0;
		 ?>
		 <form method="POST">
		 	<label>Tahun</label>
		 	<select name="tahun">
		 		<option>pilih tahun</option>
		 		<?php 
		 			for ($i=2000; $i <= 2016; $i++) { 
		 				echo "<option value='$i'>".$i."</option>";
		 			}
		 		 ?>
		 	</select>
		 	<button type="submit" name="cari">Filter</button>
		 </form>
		 <table border="1">
		 	<th>No</th>
		 	<th>TAHUN</th>
		 	<th>KODE URUSAN</th>
		 	<th>KODE SUB URUSAN</th>
		 	<th>KODE ORGANISASI</th>
		 	<th>KODE UNIT</th>
		 	<th>KODE SUB UNIT</th>
		 	<th>URAI</th>
		 	<th>KEPALA SKPD</th>
		 	<th>PANGKAT</th>
		 	<th>SKPD</th>
		 	<th>ALAMAT</th>
		 	<th>PENGELOLAH BARANG</th>
		 	
		 	<?php 
		 		while ($row = ibase_fetch_object($data)) {
		 			echo 	"
		 					<tr>
		 						<td>".++$no."</td>
		 						<td>".$row->TAHUN."</td>
		 						<td>".$row->KODEURUSAN."</td>
		 						<td>".$row->KODESUBURUSAN."</td>
		 						<td>".$row->KODEORGANISASI."</td>
		 						<td>".$row->KODEUNIT."</td>
		 						<td>".$row->KODESUBUNIT."</td>
		 						<td>".$row->URAI."</td>
		 						<td>".$row->KEPALASKPD."</td>
		 						<td>".$row->PANGKAT."</td>
		 						<td>".$row->SKPKD."</td>
		 						<td>".$row->ALAMAT."</td>
		 						<td>".$row->PENGELOLABARANG."</td>
		 					</tr>
		 					";
		 		}
		 	 ?>
		 </table>
</body>
</html>
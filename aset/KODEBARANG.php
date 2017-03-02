<!DOCTYPE html>
<html>
<head>
	<title>KODE BARANG</title>
</head>
<body>
<?php 
		$config = ibase_connect('E:\Masters\master\ASETFIX.GDB','ASET','t3mp3-t3l3s');
		$prosedure = 'SELECT * FROM PROC_NOMOR';
		$data = ibase_query($config,$prosedure);
		$no=1;
 ?>
 		<table border="1">
 			<thead>
 				<th>No</th>
 				<th>KODEGOLONGAN</th>
 				<th>KODEBIDANG</th>
 				<th>KODEKELOMPOK</th>
 				<th>KODESUB</th>
 				<th>KODESUBSUB</th>
 				<th>NO REGISTRASI</th>
 				<th>URAI</th>
 				<th>ASAL USUL</th>
 				<th>PENGGUNA</th>
 				<th>ALAMAT</th>
 				
 			</thead>
 			<tbody>
 				<?php 
 					while ($row = ibase_fetch_object($data)) {
 						echo "
 						<tr>
 							<td>".$no."</td>
 							<td>".$row->GOLONGAN."</td>
 							<td>".$row->BIDANGS."</td>
 							<td>".$row->KELOMPOK."</td>
 							<td>".$row->SUB."</td>
 							<td>".$row->SUBSUB."</td>
 							<td>".$row->NOREG."</td>
 							<td>".$row->URAI."</td>
 							<td>".$row->ASALUSUL."</td>
 							<td>".$row->PENGGUNA."</td>
 							<td>".$row->ALAMAT."</td>
 						
 							
 						</tr>";
 					$no++;}
 				 ?>
 			</tbody>
 		</table>

</body>
</html>
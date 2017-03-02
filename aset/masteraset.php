<!DOCTYPE html>
<html>
<head>
	<title>Master Asset</title>
</head>
<body>

<?php 
	$config = ibase_connect('E:\Masters\master\ASETFIX.GDB','ASET','t3mp3-t3l3s');
 	$query = 'SELECT  *  from MASTERASET  order by kodegolongan,kodebidang,kodekelompok,kodesub,kodesubsub desc';
 	$data = ibase_query($config,$query);
 	// $jumlah = 'SELECT count(KODEGOLONGAN) from MASTERASET';
 	// $COUNT = ibase_query($config,$jumlah);
 ?>
 <table border="1">
 	<thead>
 		<th>No</th>
 		<th>Kode Golongan</th>
 		<th>Kode Bidang</th>
 		<th>Kode Kelompok</th>
 		<th>Kode Sub</th>
 		<th>Kode SubSub</th>
 		<th>Urai</th>
 	</thead>
 	<tbody>
 	<?php 
 		$no=1;

 		while ($row = ibase_fetch_object($data)) {
 		echo "
 		<tr>
 			<td>".$no."</td>
 			<td>".$row->KODEGOLONGAN."</td>
 			<td>".$row->KODEBIDANG."</td>
 			<td>".$row->KODEKELOMPOK."</td>
 			<td>".$row->KODESUB."</td>
 			<td>".$row->KODESUBSUB."</td>
 			<td>".$row->URAI."</td>
 		</tr>";
 		
 		$no++;
 		$JUMLAH[]='data';
 	}

 	 ?>
 	</tbody>
 </table>
 <h1>Jumlah Data : <?php echo count($JUMLAH); ?></h1>

</body>
</html>
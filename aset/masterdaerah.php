<!DOCTYPE html>
<html>
<head>
	<title>master daerah</title>
</head>
<body>

 <form method="POST">
		 	<label>JENIS DAERAH</label>
		 	<select name="tahun">
		 		<option>Pilih Jenis</option>
		 		<option value="KABUPATEN">KABUPATEN</option>
		 		<option value="KOTA">KOTA</option>
		 		
		 	</select>
		 	<button type="submit" name="cari">Filter</button>
		 </form>
<hr>
	<table border="1">
		<thead>
			<th>NO</th>
			<th>KODE DAERAH</th>
			<th>KODE PROPINSI</th>
			<th>JENIS DAERAH</th>
			<th>NAMA DAERAH</th>
		</thead>
		<tbody>
<?php 
	$config = ibase_connect('E:\Masters\master\ASETFIX.GDB','ASET','t3mp3-t3l3s');
	// $query = 'SELECT * FROM MASTERDAERAH';
	// $data = ibase_query($config,$query); 
 	$no=0;
 	if (isset($_POST['cari'])) {
 		$cari = $_POST['cari'];
	 	$query = 'SELECT * from masterdaerah where jenisdaerah like '%'$cari'%' ';	
	 	//$data = ibase_query($config,$query); 
 	}else{
 		$query = 'SELECT * FROM MASTERDAERAH';
		$data = ibase_query($config,$query); 
 ?>

			<?php 

				while ($row = ibase_fetch_object($data)) {
					echo "<tr>
								<td>".++$no."</td>
								<td>".$row->KD_DAERAH."</td>
								<td>".$row->KDPROV."</td>
								<td>".$row->JENISDAERAH."</td>
								<td>".$row->NMDAERAH."</td>
								
						 </tr>";
				$JUMLAH[] = 'data';}

			 ?>
			 <?php echo  count($JUMLAH); ?>
	<?php } ?> 
		</tbody>
	</table>
</body>
</html>
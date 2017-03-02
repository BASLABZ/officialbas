<!DOCTYPE html>
<html>
<head>
	<title>MASTER PROPINSI</title>
</head>
<body>
	<hr>
	<?php 

		$config = ibase_connect('E:\Masters\master\ASETFIX.GDB','ASET','t3mp3-t3l3s');
		$query = 'SELECT * FROM MASTERPROV';
		$data = ibase_query($config,$query);
		$no=0;
	 ?>
	<table border="1">
		<thead>
			<th>No</th>
			
			<th>KODE PROVINSI</th>
			
			<th>NAMA PROPINSI</th>
		</thead>
		<tbody>
		<?php 
		while ($row=ibase_fetch_assoc($data)) {

		echo "
				<tr>
						<td>".++$no."</td>
						<td>".$row['KDPROV']."</td>
						<td>".$row['NAMA_PROPINSI']."</td>
				</tr>";

				} ?>

			
		
		</tbody>
	</table>
</body>
</html>
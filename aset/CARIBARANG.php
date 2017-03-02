<!DOCTYPE html>
<html>
<head>
	<title>barang</title>
</head>
<body>
<?php 
		$config = ibase_connect('E:\Masters\master\ASETFIX.GDB','ASET','t3mp3-t3l3s');
		
		if (isset($_POST['cari'])) {
			$query = "SELECT * from  PRO_BARANG ('$_POST[KDGOLONGAN]','$_POST[KDBIDANG]','$_POST[KDKELOMPOK]','$_POST[KDSUB]','$_POST[KDSUBSUB]')";
			$data = ibase_query($config,$query);
			if ($data) {
				   echo "<script>location.href='caribarang.php' </script>";exit;
			}
		
		}else{
			$id1=1;
			$id2=1;
			$id3=11;
			$id4=0;
			$id5=0;
			$query = "SELECT * from  PRO_BARANG ('$id1','$id2','$id3','$id4','$id5')";
			$data = ibase_query($config,$query);

				
	
 ?>
 		<table border="1">
			<tr>
				<form method="POST">
				<tr>
					<td><label>KODE GOLONGAN</label></td>
					<td><input type="text" name="KDGOLONGAN"></td>
				</tr>
				<tr>
					<td><label>KODE BIDANG</label></td>
					<td><input type="text" name="KDBIDANG"></td>
				</tr>	<tr>
					<td><label>KODE KELOMPOK</label></td>
					<td><input type="text" name="KDKELOMPOK"></td>
				</tr>	<tr>
					<td><label>KODE SUB</label></td>
					<td><input type="text" name="KDSUB"></td>
				</tr>	<tr>
					<td><label>KODE SUB SUB</label></td>
					<td><input type="text" name="KDSUBSUB"></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<button name="cari">Cari</button>
					</td>
				</tr>		
				</form>
				
			</tr> 			
 		</table>
 		<hr>
		<table border="1">
			<thead>
				
				<th>KODE GOLONGAN</th>
				<th>KODEBIDANG</th>
				<th>KODEKELOMPOK</th>
				<th>KODESUB</th>
				<th>KODESUBSUB</th>
				<th>KODE BARANG</th>
				<th>URAI</th>
			</thead>
			<tbody>
				<?php 

					while ($r = ibase_fetch_object($data)) {
						echo "<tr>
									<td>".$r->KODEGOLONGAN."</td>
									<td>".$r->KODEBIDANG."</td>
									<td>".$r->KODEKELOMPOK."</td>
									<td>".$r->KODESUB."</td>
									<td>".$r->KODESUBSUB."</td>
									<td>".$r->NOMORBARANG."</td>
									<td>".$r->URAI."</td>
							 </tr>";
					}
				 ?>
				
			</tbody>
			
		</table>
		<?php } ?>
</body>
</html>
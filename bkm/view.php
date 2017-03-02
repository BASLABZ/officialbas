	<?php require 'include.php';	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title></title>
	</head>
	<body>
			<h1><?php echo $fungsi_si->kodepu(); ?></h1>
			<table border="1">
				<th>no</th>
				<th>KODE KODEGOLONGAN</th>
				<th>KODE BIDANG</th>
				<th>KODE KELOMPOK</th>
				<th>URAI</th>

				<?php
				$no = 0;
				$where = array(
					/*'KODEGOLONGAN'=>'1',
					'KODEBIDANG'=>'1',
					'KODEKELOMPOK'=>'11'*/
					);
				$tampung = $fungsi_si->view('MASTERASET',$where);// ambil query;
				 while ($row = ibase_fetch_object($tampung)) 
				 {
							echo "<tr>
									<td>".++$no."</td>
									<td>".$row->KODEGOLONGAN."</td>
									<td>".$row->KODEBIDANG."</td>
									<td>".$row->KODEKELOMPOK."</td>
									<td>".$row->URAI."</td>
									
								  </tr>";
				}
				?>
			</table>

	</body>
	</html>


	
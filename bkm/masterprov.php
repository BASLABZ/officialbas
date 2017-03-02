<?php require 'include.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>master propinsi</title>
	<style type="text/css">
	body{
		background-color: grey;
	}
	</style>
</head>
<body>
		<table border="1">
			<th>No</th>
			<th>Kode Propinsi</th>
			<th>Nama Propinsi</th>
				<?php 
				$no = 0;
				$where = array(
					/*'KDPROV'=>'1',
					'NAMA_PROPINSI'=>'1'
					*/
					);
				$tampung = $fungsi_si->view('MASTERPROV',$where);// ambil query;
				 while ($row = ibase_fetch_object($tampung)) 
				 {
							echo "<tr>
									<td>".++$no."</td>
									<td>".$row->KDPROV."</td>
									<td>".$row->NAMA_PROPINSI."</td>
									
								  </tr>";
				}
				 ?>
				
		</table>
</body>
</html>
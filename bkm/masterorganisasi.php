
<div class="row"></div>
<br>
<br><br><br><br>
<h1>DATA MASTER ORGANISASI</h1> 

<div class="row">
	<div class="col-sm-12">
	<div class="table">
		<table class="table table-hover">
		<!-- <th>No</th>
		<th>TAHUN</th>
		<th>KODEURUSAN</th>
		<th>KODESUBURUSAN</th>
		<th>KODEORGANISASI</th>
		<th>KODEUNIT</th>
		<th>KODE SUBUNIT</th>
		<th>NAMA ASET</th> -->
		
		<?php 
		
				$where = array(
					//'KODEURUSAN'=>'1'
					);
				
				$dtmasterorg = $mainindex->GETDATAOTOMATIS('ORGANISASI',$where);
				while ($row = ibase_fetch_object($dtmasterorg)) {
					echo "".$row->KODEORGANISASI."";
				}



				$kolom = ibase_num_fields($dtmasterorg);
				for ($i=0; $i < $kolom ; $i++) { 
				$colom_info = ibase_field_info($dtmasterorg, $i);
				$colom_nama[] = $colom_info['name'];
				}
				//var_dump($colom_nama) ;
				die();
				foreach ($colom_nama as $th) {
					echo "<th>".$th."</th>";
				}
			$no =0;
			
			while ($row = ibase_fetch_object($dtmasterorg)) {
		 		echo "<tr>";
		 			foreach ($colom_nama as $v) {
		 				echo "<td>".$row[$v]."</td>";
		 			}
		 		echo "</tr>";
		 	}
		 ?>
		 </table>
	</div>
	</div>
</div>
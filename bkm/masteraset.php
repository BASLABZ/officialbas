<br><br><br><br><br><br>
<hr>


<h1>DATA MASTER ASET</h1> 

<div class="row">
	<div class="col-sm-12">
	<div class="table">
		<table class="table table-hover">
		<th>No</th>
		<th>KODEGOLONGAN</th>
		<th>KODEBIDANG</th>
		<th>KODEKELOMPOK</th>
		<th>KODESUB</th>
		<th>KODESUBSUB</th>
		<th>URAI</th>
		
		<?php 
				$no = 0;
				$tampungquery = $mainindex->Getdata();
				while ($row = ibase_fetch_object($tampungquery)) {
					echo "<tr>
						<td>".++$no."</td>
						<td>".$row->KODEGOLONGAN."</td>
						<td>".$row->KODEBIDANG."</td>
						<td>".$row->KODEKELOMPOK."</td>
						<td>".$row->KODESUB."</td>
						<td>".$row->KODESUBSUB."</td>
						<td>".$row->URAI."</td>
							</tr>
							";
				}

		 ?>
		 </table>
	</div>
	</div>
</div>
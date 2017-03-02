<script type="text/javascript">
$(document).ready(function() {
	$("#tahun").change(function(){
		window.location = '?pg=log&mode=presensi&tahun='+$(this).val();
	});
});
</script>
<div class="navclue abu-abu">
	<div class="clue"><a href="#">LOG DATA PRESENSI</a></div>
</div>
<div class="canvas-content">
	<div class="ket">
		<table class="tabket">
        	<tr><td class="td1">Tahun</td><td>: <?php echo "".$this->optTahun($_GET["tahun"]).""; ?></td></tr>
        </table>
	</div>
	<div class="overflow">
	<?php
		echo '<table class="tabdata zebra">';
		echo '<tr><th class="biru" class="td1">No.</th>
					<th class="biru">SKPD</th>
					<th class="biru">No.Alat</th>
					<th class="biru">Jan</th>
					<th class="biru">Feb</th>
					<th class="biru">Mar</th>
					<th class="biru">Apr</th>
					<th class="biru">Mei</th>
					<th class="biru">Jun</th>
					<th class="biru">Jul</th>
					<th class="biru">Ags</th>
					<th class="biru">Sep</th>
					<th class="biru">Okt</th>
					<th class="biru">Nov</th>
					<th class="biru">Des</th>
				</tr>';
		$no = 1;
		while($data = $this->db->fetchArray($this->res)){
			echo '<tr class="hov transng">
					<td class="td1">'.$no.'</td>
					<td>'.$data['skpd'].'</td>
					<td class="td1 tooltip" title="No. Alat"><b>'.$data['dwMachineNumber'].'</b></td>
					<td class="tooltip td1" title="Januari">'.$data['jan'].'</td>
					<td class="tooltip td1" title="Februari">'.$data['feb'].'</td>
					<td class="tooltip td1" title="Maret">'.$data['mar'].'</td>
					<td class="tooltip td1" title="April">'.$data['apr'].'</td>
					<td class="tooltip td1" title="Mei">'.$data['mei'].'</td>
					<td class="tooltip td1" title="Juni">'.$data['jun'].'</td>
					<td class="tooltip td1" title="Juli">'.$data['jul'].'</td>
					<td class="tooltip td1" title="Agustus">'.$data['ags'].'</td>
					<td class="tooltip td1" title="September">'.$data['sep'].'</td>
					<td class="tooltip td1" title="Oktober">'.$data['okt'].'</td>
					<td class="tooltip td1" title="November">'.$data['nov'].'</td>
					<td class="tooltip td1" title="Desember">'.$data['des'].'</td>
					
				  </tr>';
			$no++;
		}
		echo '</table>';
	?>
	</div>
</div>
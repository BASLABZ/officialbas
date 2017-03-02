<script type="text/javascript">
	function keypress(e){
		var e=window.event || e;
		var keyunicode=e.charCode || e.keyCode;
		return (keyunicode>=48 && keyunicode<=57 || keyunicode==8 || keyunicode==32 || keyunicode==13)? true : false;
	}
</script>
<div class="navclue abu-abu">
	<div class="clue"><a href="#">Form Setting TPB Khusus</a></div>
</div>
<div class="canvas-content">
	<form method="POST" action="?pg=tpbsetting&mode=updatebesarantpbkhusus">
	<div class="nav-table">
    	<div class="ll">
            <input type="submit" name="simpan" class="button biru" value="Simpan" id="tampil"/>
        </div>
    </div>
	<br /><br />
	<table class="tabdata">
		<tr>
			<th class='biru'>K1</th>
			<th class='biru'>K2</th>
			<th class='biru'>K3</th>
			<th class='biru'>Kode</th>
			<th class='biru'>Urai</th>
			<th class='biru'>Nilai</th>
		</tr>
		<?php
		while ($data = $this->db->fetchArray($this->res)) {
			echo '<tr class="hov transbg">
					<td class="td1" width="50px">'.$data['k_1'].'</td>
					<td class="td1" width="50px">'.$data['k_2'].'</td>
					<td class="td1" width="50px">'.$data['k_3'].'</td>
					<td class="td1" width="50px">'.$data['kode'].'</td>
					<td>'.$data['urai'].'</td>
					<td width="200px">Rp <input type="text" onkeypress="return keypress(event);" name="nilai['.$data['id'].']" value="'.$data['nilai'].'"/></td>
				  <tr>';
		}
		?>
	</table>
	<div class="nav-table">
    	<div class="ll">
            <input type="submit" name="simpan" class="button biru" value="Simpan" id="tampil"/>
        </div>
    </div>
	</form>
</div>
<div class="navclue abu-abu">
	<div class="clue"><a href="#">Form Setting Besaran TPB05</a></div>
</div>
<form id="periode" method="post"><input type="hidden" id="fbulan" name="bulan"><input type="hidden" id="ftahun" name="tahun"></form>
<div class="canvas-content">
<?php
	$res = $this->db->query("SELECT persen_disiplin, persen_kehadiran, persen_kepatuhan, persen_kinerja, persen_prestasi, persen_inovasi_kreativitas, persen_kemampuan_teknis, persen_kemampuan_interpersonal FROM setting05 LIMIT 0,1");
	list($persen_disiplin, $persen_kehadiran, $persen_kepatuhan, $persen_kinerja, $persen_prestasi, $persen_inovasi_kreativitas, $persen_kemampuan_teknis, $persen_kemampuan_interpersonal) = $this->db->fetchArray($res);	
	
?>		
	<form method="post" onSubmit="return cek(this);">
	<table cellpadding="5" cellspacing="1" class="tabdata">	
		<tr><th class="biru" width="200px"></th><th class="biru">Persentase TPB 05</th></tr>
		<tr>
			<td><strong>PERSEN DISIPLIN</strong></td>
			<td><input type="text" name="persen_disiplin" value="<?php echo $persen_disiplin; ?>" size="3" maxlength="2" onkeypress="return keypress(event);"></td>
		</tr>
		<tr>
			<td>Persen Kehadiran</td>
			<td><input type="text" name="persen_kehadiran" value="<?php echo $persen_kehadiran; ?>" size="3" maxlength="2" onkeypress="return keypress(event);"></td>
		</tr>
		<tr>
			<td>Persen Kepatuhan</td>
			<td><input type="text" name="persen_kepatuhan" value="<?php echo $persen_kepatuhan; ?>" size="3" maxlength="2" onkeypress="return keypress(event);"></td>
		</tr>
		<tr>
			<td><strong>PERSEN KINERJA</strong></td>
			<td><input type="text" name="persen_kinerja" value="<?php echo $persen_kinerja; ?>" size="3" maxlength="2" onkeypress="return keypress(event);"></td>
		</tr>		
		<tr>
			<td>Persen Prestasi</td>
			<td><input type="text" name="persen_prestasi" value="<?php echo $persen_prestasi; ?>" size="3" maxlength="2" onkeypress="return keypress(event);"></td>
		</tr>
		<tr>
			<td>Persen Inovasi Kreativitas</td>
			<td><input type="text" name="persen_inovasi_kreativitas" value="<?php echo $persen_inovasi_kreativitas; ?>" size="3" maxlength="2" onkeypress="return keypress(event);"></td>
		</tr>
		<tr>
			<td>Persen Kemampuan Teknis</td>
			<td><input type="text" name="persen_kemampuan_teknis" value="<?php echo $persen_kemampuan_teknis; ?>" size="3" maxlength="2" onkeypress="return keypress(event);"></td>
		</tr>
		<tr>
			<td>Persen Kemampuan Interpersonal</td>
			<td><input type="text" name="persen_kemampuan_interpersonal" value="<?php echo $persen_kemampuan_interpersonal; ?>" size="3" maxlength="2" onkeypress="return keypress(event);"></td>
		</tr>	
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Simpan" class="button biru" value="Simpan" id="simpan" ></td>
		</tr>
	
	</table>
	</form>
	<script language="javascript">
	function keypress(e){
		var e=window.event || e;
		var keyunicode=e.charCode || e.keyCode;
		return (keyunicode>=48 && keyunicode<=57 || keyunicode==8 || keyunicode==32 || keyunicode==13)? true : false;
	}
	function cek(x){
	
		if(trim(x.persen_disiplin.value)==""){
			alert('Jumlah persen disiplin masih kosong.'); x.persen_disiplin.focus(); return false;
		} else if(trim(x.persen_kehadiran.value)==""){
			alert('Jumlah persen kehadiran masih kosong.'); x.persen_kehadiran.focus(); return false;
		} else if(trim(x.persen_kepatuhan.value)==""){
			alert('Jumlah persen_kepatuhan masih kosong.'); x.persen_kepatuhan.focus(); return false;
		} else if(trim(x.persen_kinerja.value)==""){
			alert('Jumlah persen kinerja masih kosong.'); x.persen_kinerja.focus(); return false;
		} else if(trim(x.persen_prestasi.value)==""){
			alert('Jumlah persen prestasi masih kosong.'); x.persen_prestasi.focus(); return false;
		} else if(trim(x.persen_inovasi_kreativitas.value)==""){
			alert('Jumlah persen inovasi kreativitas masih kosong.'); x.persen_inovasi_kreativitas.focus(); return false;
		} else if(trim(x.persen_kemampuan_teknis.value)==""){
			alert('Jumlah persen kemampuan teknis masih kosong.'); x.persen_kemampuan_teknis.focus(); return false;
		} else if(trim(x.persen_kemampuan_interpersonal.value)==""){
			alert('Jumlah persen kemampuan interpersonal masih kosong.'); x.persen_kemampuan_interpersonal.focus(); return false;
		}
		
		if (parseInt(x.persen_disiplin.value)+parseInt(x.persen_kinerja.value)!=100) {
			alert('Jumlah persen disiplin dan kinerja harus 100.'); x.persen_disiplin.focus(); return false;
		} else if (parseInt(x.persen_kehadiran.value)+parseInt(x.persen_kepatuhan.value)!=100) {
			alert('Jumlah persen kehadiran dan kepatuhan harus 100.'); x.persen_kehadiran.focus(); return false;
		} else if (parseInt(x.persen_prestasi.value)+parseInt(x.persen_inovasi_kreativitas.value)+parseInt(x.persen_kemampuan_teknis.value)+parseInt(x.persen_kemampuan_interpersonal.value)!=100) {
			alert('Jumlah persen prestasi, inovasi, teknis dan interpersonal harus 100.'); x.persen_prestasi.focus(); return false;
		} else return true;
		
	}
	<?php if (isset($_POST['Simpan'])) echo "alert('data telah tersimpan')"; ?>
	</script>	
</div>

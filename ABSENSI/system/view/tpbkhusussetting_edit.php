<div class="navclue abu-abu">
	<div class="clue"><a href="#">Form Setting TPB Khusus</a></div>
</div>
<script>
	$(document).ready(function() {
		var kodeskpd = '<?php echo $this->data['id'];?>'; 
		$("#optskpd").change(function(){
			window.location = '?pg=tpbsetting&mode=tpbkhusussetting&kodeskpd='+$(this).val();
		});
		
		$("#tampilkan").click(function(){
			if(kodeskpd == ''){
				alert('Pilih SKPD terlebih dahulu!');
				return false;	
			}
			$("#fbulan").val($("#bulan").val());
			$("#ftahun").val($("#tahun").val());
			$("#periode").attr('target','');
			$("#periode").attr('action','');
			$("#fnip").val('');
			$("#periode").submit();
		});
	});
</script>
<form id="periode" method="post"><input type="hidden" id="fbulan" name="bulan"><input type="hidden" id="ftahun" name="tahun"></form>
<div class="canvas-content">
	<div class="ket">
    	<table class="tabket">
        	<tr><td class="td1">SKPD</td><td>: <?php echo "".$this->optSKPD($this->user['kodeskpd']).""; ?></td></tr>
        	<tr><td class="td1">Bulan/Tahun</td><td>: <?php echo "".$this->optBulan($_POST["bulan"]).""; ?> <?php echo "".$this->optTahun($_POST["tahun"]).""; ?></td></tr>
        </table>
    </div>
	<div class="nav-table"><div class="ll"><a href="#" class="aksi" alt="tampilkan" id="tampilkan"><div class="button biru">Tampilkan</div></a></div></div>
<?php
	if(($this->data['id']<>'') && ($_POST['bulan'])) {
		list($nama_direktur,$nip_direktur,$nama_kepala_sdm,$nip_kepala_sdm,$nama_petugas,$nip_petugas) = $this->db->fetchArray($this->res);
		if ($nama_direktur=='') {
			$this->res = $this->db->query("nama_direktur,nip_direktur,nama_kepala_sdm,nip_kepala_sdm,nama_petugas,nip_petugas FROM setting_tpb_khusus WHERE skpd = '".$this->esc($this->data['id'])."' order by tahun DESC , CAST( bulan AS signed ) DESC");
			list($nama_direktur,$nip_direktur,$nama_kepala_sdm,$nip_kepala_sdm,$nama_petugas,$nip_petugas) = $this->db->fetchArray($this->res);
		}
?>		
	<form method="post" onSubmit="return cek(this);">
	<input type="hidden" name="skpd" value="<?php echo $this->data['id'] ?>">
	<input type="hidden" name="bulan" value="<?php echo $_POST["bulan"]; ?>">
	<input type="hidden" name="tahun" value="<?php echo $_POST["tahun"]; ?>">
	<table cellpadding="5" cellspacing="1" class="tabdata">	
		<tr><th class="biru" width="150px"></th><th class="biru"></th></tr>
		<tr>
			<td>Bulan / Tahun</td>
			<td><?php echo $this->util->longMonth[$_POST['bulan']]." / ".$_POST['tahun']; ?></td>
		</tr>
		<tr>
			<td>Nama Direktur</td>
			<td><input name="nama_direktur" type="text" value="<?php echo $nama_direktur; ?>" size="50" maxlength="100"></td>
		</tr>
		<tr>
			<td>Nip Direktur</td>
			<td><input name="nip_direktur" type="text" value="<?php echo $nip_direktur; ?>" size="30" maxlength="30"></td>
		</tr>
		<tr>
			<td>Nama Kepala SDM</td>
			<td><input name="nama_kepala_sdm" type="text" value="<?php echo $nama_kepala_sdm; ?>" size="50" maxlength="100"></td>
		</tr>
		<tr>
			<td>NIP Kepala SDM</td>
			<td><input name="nip_kepala_sdm" type="text" value="<?php echo $nip_kepala_sdm; ?>" size="30" maxlength="30"></td>
		</tr>
		<tr>
			<td>Nama Petugas Input</td>
			<td><input name="nama_petugas" type="text" value="<?php echo $nama_petugas; ?>" size="50" maxlength="100"></td>
		</tr>
		<tr>
			<td>NIP Petugas Input</td>
			<td><input name="nip_petugas" type="text" value="<?php echo $nip_petugas; ?>" size="30" maxlength="30"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Simpan" class="button biru" value="Simpan" id="simpan" ></td>
		</tr>
	
	</table>
	</form>
	<script language="javascript">
	document.getElementById("hari").onkeypress=function(e){
		var e=window.event || e;
		var keyunicode=e.charCode || e.keyCode;
		return (keyunicode>=48 && keyunicode<=57 || keyunicode==8 || keyunicode==32 || keyunicode==13)? true : false;
	}
	document.getElementById("jam").onkeypress=function(e){
		var e=window.event || e;
		var keyunicode=e.charCode || e.keyCode;
		return (keyunicode>=48 && keyunicode<=57 || keyunicode==8 || keyunicode==32 || keyunicode==13)? true : false;
	}
	function cek(x){
		if(trim(x.nama_direktur.value)==""){
			alert('Nama Direktur masih kosong.'); x.nip_kepala.focus(); return false;
		} else if(trim(x.nip_direktur.value)==""){
			alert('NIP Direktur masih kosong.'); x.nip_direktur.focus(); return false;
		} else if(trim(x.nama_kepala_sdm.value)==""){
			alert('Nama Kepala SDM masih kosong.'); x.nama_kepala_sdm.focus(); return false;
		} else if(trim(x.nip_kepala_sdm.value)==""){
			alert('NIP Kepala SDM masih kosong.'); x.nip_kepala_sdm.focus(); return false;
		} else if(trim(x.nama_petugas.value)==""){
			alert('Nama petugas input masih kosong.'); x.nama_petugas.focus(); return false;
		} else if(trim(x.nip_petugas.value)==""){
			alert('NIP petugas input masih kosong.'); x.nip_petugas.focus(); return false;
		} else {
			return true;
		}
	}
	</script>	
<?php
}
?>	
</div>

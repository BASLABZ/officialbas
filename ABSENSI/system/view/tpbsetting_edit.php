<div class="navclue abu-abu">
	<div class="clue"><a href="#">Form Setting TPB Umum [Entri Jumlah Hari & Jam Kerja]</a></div>
</div>
<script>
	$(document).ready(function() {
		var kodeskpd = '<?php echo $this->data['id'];?>'; 
		$("#optskpd").change(function(){
			window.location = '?pg=tpbsetting&mode=tpbsetting&kodeskpd='+$(this).val();
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
		list($hari, $jam, $nama_kepala, $nip_kepala, $nama_bendahara, $nip_bendahara, $nama_petugas, $nip_petugas) = $this->db->fetchArray($this->res);
		if ($hari=='') {
			$this->res = $this->db->query("SELECT nama_kepala, nip_kepala, nama_bendahara, nip_bendahara, nama_petugas, nip_petugas FROM setting WHERE skpd = '".$this->esc($this->data['id'])."' order by tahun DESC , CAST( bulan AS signed ) DESC");
			list($nama_kepala, $nip_kepala, $nama_bendahara, $nip_bendahara, $nama_petugas, $nip_petugas) = $this->db->fetchArray($this->res);
			$hari = $this->workDay( mktime(0,0,0,$_POST['bulan'],1,$_POST['tahun']));
			$jam = 8;
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
			<td>Jumlah Hari Kerja</td>
			<td><input id="hari" type="text" name="hari" value="<?php echo $hari; ?>" maxlength="2"></td>
		</tr>
		<tr>
			<td>Jumlah Jam Kerja/Hari</td>
			<td><input id="jam" type="text" name="jam" value="<?php echo $jam; ?>" maxlength="2"></td>
		</tr>
		<tr>
			<td>Nama Kepala SKPD</td>
			<td><input name="nama_kepala" type="text" value="<?php echo $nama_kepala; ?>" size="50" maxlength="100"></td>
		</tr>
		<tr>
			<td>NIP Kepala SKPD</td>
			<td><input name="nip_kepala" type="text" value="<?php echo $nip_kepala; ?>" size="30" maxlength="30"></td>
		</tr>
		<tr>
			<td>Nama Bendahara</td>
			<td><input name="nama_bendahara" type="text" value="<?php echo $nama_bendahara; ?>" size="50" maxlength="100"></td>
		</tr>
		<tr>
			<td>NIP Bendahara</td>
			<td><input name="nip_bendahara" type="text" value="<?php echo $nip_bendahara; ?>" size="30" maxlength="30"></td>
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
		if(trim(x.hari.value)==""){
			alert('Jumlah hari kerja masih kosong.'); x.hari.focus(); return false;
		} else if(trim(x.jam.value)==""){
			alert('Jumlah jam kerja masih kosong.'); x.jam.focus(); return false;
		} else if(trim(x.nama_kepala.value)==""){
			alert('Nama kepala SKPD masih kosong.'); x.nama_kepala.focus(); return false;
		} else if(trim(x.nip_kepala.value)==""){
			alert('NIP kepala SKPD masih kosong.'); x.nip_kepala.focus(); return false;
		} else if(trim(x.nama_bendahara.value)==""){
			alert('Nama bendahara masih kosong.'); x.nama_bendahara.focus(); return false;
		} else if(trim(x.nip_bendahara.value)==""){
			alert('NIP bendahara masih kosong.'); x.nip_bendahara.focus(); return false;
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

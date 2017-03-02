<div class="navclue abu-abu">
	<div class="clue"><a href="#">TPB Rekap Khusus <?php if (@$_POST['bulan']) echo 'Triwulan ke '.$this->util->triwulan($_POST['bulan']).' Tahun '.$_POST["tahun"]; ?></a></div>
</div>
<script>
	$(document).ready(function() {
		var kodeskpd = '<?php echo $this->data['id'];?>'; 
		$("#optskpd").change(function(){
			window.location = '?pg=datatpb&mode=tpbrekapkhusus&kodeskpd='+$(this).val();
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
	
	
	function cetak() {
		$("#periode").attr('target','frame');
		$("#periode").attr('action','?pg=datatpb&mode=print_tpbrekapkhusus');
		
		$("#fbulan").val($("#bulan").val());
		$("#ftahun").val($("#tahun").val());
		$("#fskpd").val($("#optskpd").val());
		
		$("#periode").submit();	
	}


</script>
<form id="periode" method="post">
	<input type="hidden" id="fbulan" name="bulan">
	<input type="hidden" id="ftahun" name="tahun">
	<input type="hidden" id="fskpd" name="skpd" value="<?php echo $_GET['kodeskpd']; ?>">
</form>
<div class="canvas-content">
	<div class="ket">
    	<table class="tabket">
        	<tr><td class="td1">SKPD</td><td>: <?php echo "".$this->optSKPDKhusus($this->user['kodeskpd']).""; ?></td></tr>
        	<tr><td class="td1">Bulan/Tahun</td><td>: <?php echo "".$this->optBulan(@$_POST["bulan"]).""; ?> <?php echo "".$this->optTahun(@$_POST["tahun"]).""; ?></td></tr>
        </table>
    </div>
    <div class="nav-table"><div class="ll"><a href="#" class="aksi" alt="tampilkan" id="tampilkan"><div class="button biru">Tampilkan</div></a></div></div>
    <table class="tabdata">
    	<tr>
    		<th class="biru" width="30px">No.</th>
    		<th class="biru">Nama Pegawai</th>
			<th class="biru">NIP</th>
			<th class="biru">Pangkat/Golongan</th>
			<th class="biru">Jabatan</th>
			<th class="biru">Total TPB<br>(Kotor)</th>
			<th class="biru">Potongan</th>
			<th class="biru">Jumlah TPB<br>(Bersih)</th>
        </tr>
        <?php
		if(($this->data['id']<>'') && (@$_POST['bulan'])) {
			if($this->db->numRows($this->res) > 0){
				$no = 1;
				while($data = $this->db->fetchArray($this->res)){
	
					echo '<tr>
							<td class="td1">'.$no.'</td>
							<td>'.$data['nama'].'</td>
							<td>'.$data['nip'].'</td>
							<td>'.$data['golongan'].'</td>
							<td>'.$data['jabatan'].'</td>
							<td align="right">'.$this->util->duit_rp($data['totaltpb']).'</td>
							<td align="right">'.$this->util->duit_rp($data['totalpotongan']).'</td>
							<td align="right">'.$this->util->duit_rp($data['totaltpbkotor']).'</td>
						  </tr>';
					$no++;
				}
			}else{
				echo '<tr><td class="td1" colspan="9">Data Kosong</td></tr>';	
			}
		}else{
			echo '<tr><td class="td1" colspan="9">Pilih Tampilkan terlebih dahulu</td></tr>';	
		}
		?>
    </table>
    <a href="#" class="aksi" alt="cetak" onClick="cetak();"><div class="button biru">Cetak</div></a>
</div>
<iframe id="frame" name="frame"  src="" height="1" width="1" frameborder="0"></iframe>
<?php 

if (@$_POST['cetaknip']) {
	echo "<script>cetak('".$_POST['cetaknip']."');</script>";	
}

?>
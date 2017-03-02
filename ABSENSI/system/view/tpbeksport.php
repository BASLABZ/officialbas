<div class="navclue abu-abu">
	<div class="clue"><a href="#">Export <?php if ($_POST['bulan']) echo 'Triwulan ke '.$this->util->triwulan($_POST['bulan']).' Tahun '.$_POST["tahun"]; ?></a></div>
</div>
<script>
	$(document).ready(function() {
		var kodeskpd = '<?php echo $this->data['id'];?>'; 
		$("#optskpd").change(function(){
			window.location = '?pg=datatpb&mode=tpbeksport&kodeskpd='+$(this).val();
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
	
	
	function eksport() {
		//alert('export');
		
		$("#periode").attr('target','frame');
		$("#periode").attr('action','?pg=datatpb&mode=do_eksport');
		
		$("#fbulan").val($("#bulan").val());
		$("#ftahun").val($("#tahun").val());
		$("#fskpd").val($("#optskpd").val());
		
		$("#periode").submit();
			
	}

	/*
	function cetak() {
		document.getElementById('frame').src = "page/save.php";
	}
	*/


</script>
<form id="periode" method="post">
	<input type="hidden" id="fbulan" name="bulan">
	<input type="hidden" id="ftahun" name="tahun">
	<input type="hidden" id="fskpd" name="skpd">
</form>
<div class="canvas-content">
	<div class="ket">
    	<table class="tabket">
        	<tr><td class="td1">SKPD</td><td>: <?php echo "".$this->optSKPD($this->user['kodeskpd']).""; ?></td></tr>
        	<tr><td class="td1">Bulan/Tahun</td><td>: <?php echo "".$this->optBulan($_POST["bulan"]).""; ?> <?php echo "".$this->optTahun($_POST["tahun"]).""; ?></td></tr>
        </table>
    </div>
    
    <a href="#" class="aksi" alt="Export" onClick="eksport();"><div class="button biru">Export</div></a>
<iframe id="frame" name="frame"  src="" height="1" width="1" frameborder="0"></iframe>
<?php 

if ($_POST['cetaknip']) {
	echo "<script>cetak('".$_POST['cetaknip']."');</script>";	
}

?>
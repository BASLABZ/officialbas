<script>
	$(document).ready(function() {	
		
        $("#tampil").click(function(){
			var kodeskpd = $("#kodeskpd").val();
			if(kodeskpd == ''){
				alert('Pilih SKPD terlebih dahulu');
				return false;	
			}
			var bulan = $("#bulan").val();
			var tahun = $("#tahun").val();
			$(this).attr('disabled','disabled');
			$('#canvas-data').html('<img src="img/ajax-loader.gif"> Loading data...');
			$.ajax({
				type:"POST",
				url: "?pg=laporan&mode=ambil_bulanan",
				data: "bulan="+bulan+"&tahun="+tahun+"&kodeskpd="+kodeskpd,
				cache: false,
				success: function(msg){
					
					$("#canvas-data").html(msg);
					$("#tampil").removeAttr('disabled');
				}
			});
		});
		$("#cetak").click(function(){
			var kodeskpd = $("#kodeskpd").val();
			if(kodeskpd == ''){
				alert('Pilih SKPD terlebih dahulu');
				return false;	
			}
			var bulan = $("#bulan").val();
			var tahun = $("#tahun").val();
			url = '&kodeskpd='+kodeskpd+'&bulan='+bulan+'&tahun='+tahun
			window.open("?pg=laporan&mode=cetak_bulanan"+url, "_blank");
		})
	});
</script>
<div class="navclue abu-abu">
	<div class="clue"><a href="#">LAPORAN PRESENSI BULANAN</a></div>
</div>
<form id="periode" method="post" >
<div class="canvas-content">
	<div class="ket">
    	<table class="tabket">
        	<tr><td class="td1">SKPD</td><td>: <?php echo "".$this->optSKPD($this->user['kodeskpd']).""; ?></td></tr>
        	<tr><td class="td1">Bulan/Tahun</td><td>: <?php echo "".$this->optBulan(($_POST["bulan"] <> '')?$_POST["bulan"]:date('m')).""; ?> <?php echo "".$this->optTahun($_POST["tahun"]).""; ?></td></tr>
        </table>
        
    </div>
    <div class="nav-table">
    	<div class="ll">
            <input type="button" class="button biru" value="Tampilkan" id="tampil"/>
            <input type="button" class="button biru" value="Cetak" id="cetak"/>
        </div>
    </div>
	<br /><br />
    <div id="canvas-data">
    
    </div>
    
    <table>
            <tr><td colspan="2"><b>Keterangan :</b></td></tr>
            <tr><td>HD</td><td>= Hadir</td><td>TH</td><td>= Tidak Hadir</td></tr>
            <tr><td>L</td><td>= Libur</td><td>AS</td><td>= Absen Sekali</td></tr>
            <tr><td>I</td><td>= Ijin</td><td>TL</td><td>= Terlambat</td></tr>
            <tr><td>S</td><td>= Sakit</td><td>PL</td><td>= Pulang Lebih Awal</td></tr>
            <tr><td>C</td><td>= Cuti</td><td>TP</td><td>= Terlambat - Pulang Lebih Awal</td></tr>
            <tr><td>DL</td><td>= Dinas Luar</td><td>TB</td><td>= Tugas Belajar</td></tr>
	</table>	
   
    
</div>
</form>
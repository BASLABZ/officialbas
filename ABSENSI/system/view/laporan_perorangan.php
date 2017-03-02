<script>
	$(document).ready(function() {
		
		<?php if($this->user['kodeskpd'] <> ''){?>
			$('#optPegawai').html('<img src="img/ajax-loader.gif"> Loading data...');	  
			var kode = '<?php echo $this->user['kodeskpd'];?>';
			$.ajax({
				url: "?pg=laporan&mode=optpegawai",
				data: "skpd="+kode,
				cache: false,
				success: function(msg){
					$("#optPegawai").html(msg);
				}
			});
		<?php }else{?>
		$("#kodeskpd").change(function(){
			$('#optPegawai').html('<img src="img/ajax-loader.gif"> Loading data...');	  
			var kode = $("#kodeskpd").val();
			$.ajax({
				url: "?pg=laporan&mode=optpegawai",
				data: "skpd="+kode,
				cache: false,
				success: function(msg){
					$("#optPegawai").html(msg);
				}
			});
		});
		<?php }?>
					
		$("#tampil").click(function(){
			var kodeskpd = $("#kodeskpd").val();
			var nip = $("#nip").val();
			var bulan = $("#bulan").val();
			var tahun = $("#tahun").val();
			$(this).attr('disabled','disabled');
			$('#canvas-data').html('<img src="img/ajax-loader.gif"> Loading data...');
			$.ajax({
				type:"POST",
				url: "?pg=laporan&mode=ambil_perorangan",
				data: "bulan="+bulan+"&tahun="+tahun+"&kodeskpd="+kodeskpd+"&nip="+nip,
				cache: false,
				success: function(msg){
					
					$("#canvas-data").html(msg);
					$("#tampil").removeAttr('disabled');
				}
			});
		});
		$("#cetak").click(function(){
			var kodeskpd = $("#kodeskpd").val();
			var nip = $("#nip").val();
			if(kodeskpd == ''){
				alert('Pilih SKPD terlebih dahulu');
				return false;	
			}
			var bulan = $("#bulan").val();
			var tahun = $("#tahun").val();
			url = '&kodeskpd='+kodeskpd+'&bulan='+bulan+'&tahun='+tahun+'&nip='+nip;
			window.open("?pg=laporan&mode=cetak_perorangan"+url, "_blank");
		})
	});	
</script>
<div class="navclue abu-abu">
	<div class="clue"><a href="#">LAPORAN PRESENSI PERORANGAN</a></div>
</div>
<form id="periode" method="post" >
<div class="canvas-content">
	<div class="ket">
    	<table class="tabket">
        	<tr><td class="td1">SKPD</td><td>: <?php echo "".$this->optSKPD($this->user['kodeskpd']).""; ?></td></tr>
        	<tr><td class="td1">Pegawai</td><td height="20px" style="vertical-align:middle;">: <div id="optPegawai" style="width:200px; display:inline-table;"><select id="nip" name="nip"><option value="">-</option></select></div></td></tr>
            <tr><td class="td1">Bulan / Tahun</td><td>: <?php echo "".$this->optBulan(($_POST["bulan"] <> '')?$_POST["bulan"]:date('m'))."";  echo " ".$this->optTahun($_POST["tahun"]).""; ?></td></tr>
            
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
    
</div>
</form>
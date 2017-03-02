<script>
	$(document).ready(function() {	
        $("#proses").click(function(){
			var kodeskpd = $("#kodeskpd").val();
			var bulan = $("#bulan").val();
			var tahun = $("#tahun").val();
			$(this).attr('disabled','disabled');
			$('.auth').hide();
			$('.auth-warning').html('<img src="img/ajax-loader.gif"> Loading data...');
			$('.auth-warning').fadeIn('fast');
			if(kodeskpd == ''){
				$('.auth').hide();
				$('.auth-error').html('Kode SKPD Masih Kosong');
				$('.auth-error').fadeIn('slow');
				$("#proses").removeAttr('disabled');
				return false;
			}
			$.ajax({
				type:"POST",
				url: "?pg=laporan&mode=prosesdata",
				data: "bulan="+bulan+"&tahun="+tahun+"&kodeskpd="+kodeskpd,
				cache: false,
				success: function(msg){
					$('.auth').hide();
					//$('.auth').html(msg);
					if(msg == '100'){
						$('.auth-success').html('Proses Data Presensi Berhasil');
						$('.auth-success').fadeIn('slow');
					}
					if(msg == 'e'){
						$('.auth-error').html('Proses Data Presensi Gagal');
						$('.auth-error').fadeIn('slow');
					}
					if(msg == '0'){
						$('.auth-error').html('Tidak Ada Data Yang Diproses');
						$('.auth-error').fadeIn('slow');
					}
					
					$("#proses").removeAttr('disabled');
				}
			});
		});
	});
</script>
<div class="navclue abu-abu">
	<div class="clue"><a href="#">FORM PROSES DATA PRESENSI</a></div>
</div>
<form id="periode" method="post" >
<div class="canvas-content">
	<div class="ket">
    	<table class="tabket">
        	<tr><td class="td1">SKPD</td><td>: <?php echo "".$this->optSKPD($this->user['kodeskpd']).""; ?></td></tr>
        	<tr><td class="td1">Bulan/Tahun</td><td>: <?php echo "".$this->optBulan(($_POST["bulan"] <> '')?$_POST["bulan"]:date('m')).""; ?> <?php echo "".$this->optTahun($_POST["tahun"]).""; ?></td></tr>
        	<tr><td colspan="2"></td></tr>
        </table>
        
    </div>
    <div class="nav-table">
    	<div class="ll">
            <input type="button" class="button biru" value="Proses" id="proses"/>
            
        </div>
    </div>
    <br/>
    
    <div class="auth auth-success"></div>
    <div class="auth auth-warning"></div>
    <div class="auth auth-error"></div>
    
</div>
</form>
<link rel="stylesheet" href="css/jquery-ui.1.10.2.custom.2.css" />
<link rel="stylesheet" href="css/jquery-ui-timepicker-addon.css" />
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>

<script>
	$(document).ready(function() {	
		$('#tanggal').datepicker({
			dateFormat: "yy-mm-dd",
			monthNames: ["Januari","Februari","Maret","April","Mei","Juni",
			"Juli","Agustus","September","Oktober","November","Desember"], // Names of months for drop-down and formatting
			monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"], // For formatting
			dayNames: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"], // For formatting
			dayNamesShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"], // For formatting
			dayNamesMin: ["Mi","Sn","Sl","Rb","Km","Jm","Sa"],
			maxDate: 'D'
		});
        $("#tampil").click(function(){
			var kodeskpd = $("#kodeskpd").val();
			var tanggal = $("#tanggal").val();
			if(kodeskpd == ''){
				alert('Pilih SKPD terlebih dahulu');
				return false;	
			}
			if(tanggal == ''){
				alert('Isi tanggal terlebih dahulu');
				return false;	
			}
			$(this).attr('disabled','disabled');
			$('#canvas-data').html('<img src="img/ajax-loader.gif"> Loading data...');
			$.ajax({
				type:"POST",
				url: "?pg=laporan&mode=ambil_harian",
				data: "tanggal="+tanggal+"&kodeskpd="+kodeskpd,
				cache: false,
				success: function(msg){
					
					$("#canvas-data").html(msg);
					$("#tampil").removeAttr('disabled');
				}
			});
		});
		$("#cetak").click(function(){
			var kodeskpd = $("#kodeskpd").val();
			var tanggal = $("#tanggal").val();
			if(kodeskpd == ''){
				alert('Pilih SKPD terlebih dahulu');
				return false;	
			}
			if(tanggal == ''){
				alert('Isi tanggal terlebih dahulu');
				return false;	
			}
			url = '&kodeskpd='+kodeskpd+'&tanggal='+tanggal
			window.open("?pg=laporan&mode=cetak_harian"+url, "_blank");
		})
	});
</script>
<div class="navclue abu-abu">
	<div class="clue"><a href="#">LAPORAN PRESENSI HARIAN</a></div>
</div>
<form id="periode" method="post" >
<div class="canvas-content">
	<div class="ket">
    	<table class="tabket">
        	<tr><td class="td1">SKPD</td><td>: <?php echo "".$this->optSKPD($this->user['kodeskpd']).""; ?></td></tr>
        	<tr><td class="td1">Tanggal</td><td>: <input type="text" name="tanggal" id="tanggal" /> </td></tr>
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
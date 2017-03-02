<link rel="stylesheet" href="css/jquery-ui.1.10.2.custom.2.css" />
<link rel="stylesheet" href="css/jquery-ui-timepicker-addon.css" />
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="js/jquery.draggable.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script>
	$(document).ready(function() {
		$('#optskpd').change(function() {
	        $.ajax({
	            url: "system/ajax/pilihan_bidang.php",
	            data: "kodeskpd="+$('#optskpd').val(),
	            cache: false,
	            success: function(msg){
	                $("#bidang").html(msg);
	            }
	        });
	    });
		
		$('#tanggal').datepicker({
			dateFormat: "yy-mm-dd",
			monthNames: ["Januari","Februari","Maret","April","Mei","Juni",
			"Juli","Agustus","September","Oktober","November","Desember"], // Names of months for drop-down and formatting
			monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"], // For formatting
			dayNames: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"], // For formatting
			dayNamesShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"], // For formatting
			dayNamesMin: ["Mi","Sn","Sl","Rb","Km","Jm","Sa"]
		});

		$(".search").live('click', function(){
			kodeskpd = $("#optskpd").val();
			var iddata = $(this).attr('alt');
			var nip = $(".nip").val();
			$(".CanvasPopup").fadeIn('fast');
			$(".loading").fadeIn('fast');
			$(".ContentPopup").load("?pg=pegawai&mode=optAtasan&kodeskpd="+kodeskpd+"&nip="+nip+"&id="+iddata+"");
			$(".CenterPopup").draggable({ handle: $(".titlePopup") });
		});

		$(".close").click(function(){
			$(".CanvasPopup").fadeOut('fast');
			$(".ContentPopup").html('<div class="loading"><img src="img/load.gif"/></div>');
		});

		$("#formapp").validate({
			messages: {
				
				tanggal: {
					required: "Tanggal harus diisi"	
				},
				kodeskpd: {
					required: "SKPD harus diisi"	
				}
			},
			
			rules: {
				
				tanggal: {
					required:true	
				},		
				kodeskpd: {
					required:true	
				}
			},		
			
			errorPlacement: function(error, element) {
				error.appendTo(element.parent("td"));
			}
		});

});
</script>
<div class="navclue abu-abu">
	<div class="clue"><a href="#">FORM PEGAWAI PINDAH SKPD</a></div>
</div>
<div class="canvas-content">
	<form method="post" id="formapp">
    <div class="ket">
    	<table class="tabket">
        	<tr><td class="td1">SKPD</td><td>: <?php echo "".$this->data['optskpd'].""; ?></td></tr>
            <tr><td class="td1">Tanggal Pindah</td><td>: <input type="text" name="tanggal" id="tanggal"/></td></tr>
        </table>
    </div>
    <table class="tabdata">
    	<tr>
            <th class="biru">NIP / Nama Pegawai</th>
            <th class="biru" width="600px">Detail</th>
            
        </tr>
    <tr>
   	<?php
		echo $this->data['listpeg'];
	?>
	</table>
    <input type="submit" class="button biru" value="Simpan"/>
    <input type="button" value="Batal" class="button biru" onclick="window.history.go(-1)"/>
    <input type="hidden" name="mode" value="pindah_peg" id="mode"/>
    <input type="hidden" name="oldkodeskpd" value="<?php echo $this->data['oldkodeskpd'];?>"/>
    </form>
</div>
<div class="CanvasPopup">
   <div class="BgPopup"></div>
   <div class="CenterPopup">
   	  <div class="titlePopup abu-abu">PILIH ATASAN<div class="close">x</div></div>
      <div class="ContentPopup">
      	<div class="loading">
			<img src="img/load.gif"/>
		</div>
      </div>  
   </div>
</div>
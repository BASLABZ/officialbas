<link rel="stylesheet" href="css/jquery-ui.1.10.2.custom.2.css" />
<link rel="stylesheet" href="css/jquery-ui-timepicker-addon.css" />
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>

<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="application/javascript">
$(document).ready(function() {
		$('#tanggal').datepicker({
			dateFormat: "yy-mm-dd",
			monthNames: ["Januari","Februari","Maret","April","Mei","Juni",
			"Juli","Agustus","September","Oktober","November","Desember"], // Names of months for drop-down and formatting
			monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"], // For formatting
			dayNames: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"], // For formatting
			dayNamesShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"], // For formatting
			dayNamesMin: ["Mi","Sn","Sl","Rb","Km","Jm","Sa"]
		});
		$("#formapp").validate({
			messages: {
				
				tanggal: {
					required: "Tanggal harus diisi"	
				},
				keterangan: {
					required: "Keterangan harus diisi"	
				}
			},
			
		  	rules: {
				
				tanggal: {
					required:true	
				},		
				keterangan: {
					required:true	
				}
		  	},		
		
			errorPlacement: function(error, element) {
				error.appendTo(element.parent("td"));
			}
		});
})
</script>
<div class="navclue abu-abu">
	<div class="clue"><a href="#"><?php echo strtoupper($this->data['status']);?> DATA HARI LIBUR</a></div>
</div>
<div class="canvas-content">
	<form method="post" id="formapp">
    <table class="form" width="100%" cellpadding="0" cellspacing="0">
    <tr><td width="150px">Tanggal</td><td><input type="text" name="tanggal" id="tanggal" value="<?php echo $this->data['tanggal'];?>"/></td></tr>
    <tr><td width="150px">Keterangan</td><td><textarea cols="30" name="keterangan"><?php echo $this->data['keterangan'];?></textarea></td></tr>
    <tr><td colspan="2">
    					<input type="hidden" value="<?php echo $this->data['action'];?>" name="mode"/>
                        <input type="hidden" value="<?php echo $this->data['id_libur'];?>" name="id"/>
    					<input type="submit" class="button biru" value="Simpan"/>
                        <input type="reset" class="button biru" value="Reset"/>
                        <input type="button" value="Batal" class="button biru" onclick="window.history.go(-1)"/>
        </td>
    </tr>
	</table>
    </form>
</div>
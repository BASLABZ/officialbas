<link rel="stylesheet" href="css/jquery-ui.1.10.2.custom.2.css" />
<link rel="stylesheet" href="css/jquery-ui-timepicker-addon.css" />
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="js/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="application/javascript">
$(document).ready(function() {
		$('#date_start').datetimepicker({
			dateFormat: "yy-mm-dd",
			monthNames: ["Januari","Februari","Maret","April","Mei","Juni",
			"Juli","Agustus","September","Oktober","November","Desember"], // Names of months for drop-down and formatting
			monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"], // For formatting
			dayNames: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"], // For formatting
			dayNamesShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"], // For formatting
			dayNamesMin: ["Mi","Sn","Sl","Rb","Km","Jm","Sa"],
			altField: "#time_start"
		});
		$('#date_end').datetimepicker({
			dateFormat: "yy-mm-dd",
			monthNames: ["Januari","Februari","Maret","April","Mei","Juni",
			"Juli","Agustus","September","Oktober","November","Desember"], // Names of months for drop-down and formatting
			monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"], // For formatting
			dayNames: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"], // For formatting
			dayNamesShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"], // For formatting
			dayNamesMin: ["Mi","Sn","Sl","Rb","Km","Jm","Sa"],
			altField: "#time_end"
		});
		$("#formapp").validate({
		messages: {
		 	nip: {
				required: "Pegawai harus dipilih",
			}
		},
		
	  rules: {
			nip: {
			  required: true
			}
	  },		
		
		errorPlacement: function(error, element) {
			error.appendTo(element.parent("td"));
		}
	});
});
</script>
<div class="navclue abu-abu">
	<div class="clue"><a href="#">EDIT DATA - <?php echo strtoupper($this->getJenisIjin($_GET['id']));?></a></div>
</div>
<div class="canvas-content">
	<form method="post" id="formapp">
    <table class="form" width="100%" cellpadding="0" cellspacing="0">
    <tr><td width="150px">SKPD</td><td><?php echo $this->getSKPD(($this->user['kodeskpd'] <> '')?$this->user['kodeskpd']:$_GET['kodeskpd']);?></td></tr>
    <tr><td width="150px">Pegawai</td><td><select name="nip"><?php echo $this->optPegawai(($this->user['kodeskpd'] <> '')?$this->user['kodeskpd']:$_GET['kodeskpd'],$this->data['nip']);?></select></td></tr>
    <tr><td width="150px">Tanggal Awal</td><td><input type="text" name="date_start" id="date_start" value="<?php echo $this->data['date_start'];?>"/></td></tr>
    <tr><td width="150px">Jam Awal</td><td><input type="text" name="time_start" id="time_start" value="<?php echo $this->data['time_start'];?>"/></td></tr>
    <tr><td width="150px">Tanggal Akhir</td><td><input type="text" name="date_end" id="date_end" value="<?php echo $this->data['date_end'];?>"/></td></tr>
    <tr><td width="150px">Jam Akhir</td><td><input type="text" name="time_end" id="time_end" value="<?php echo $this->data['time_end'];?>"/></td></tr>
    <tr><td width="150px">Keterangan</td><td><textarea name="keterangan" cols="40"><?php echo $this->data['keterangan'];?></textarea></td></tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2">
    					<input type="hidden" value="update" name="mode"/>
                        <input type="hidden" value="<?php echo $_GET['kodeskpd'];?>" name="kodeskpd"/>
                        <input type="hidden" value="<?php echo $_GET['jenis'];?>" name="idjenis"/>
                        <input type="hidden" value="<?php echo $_GET['id'];?>" name="id"/>
    					<input type="submit" class="button biru" value="Simpan"/>
                        <input type="reset" class="button biru" value="Reset"/>
                        <input type="button" value="Batal" class="button biru" onclick="window.history.go(-1)"/></td></tr>
        </td>
    </tr>
    </table>
    </form>
</div>
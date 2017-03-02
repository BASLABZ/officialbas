<link rel="stylesheet" href="css/jquery-ui.1.10.2.custom.2.css" />
<link rel="stylesheet" href="css/jquery-ui-timepicker-addon.css" />
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="js/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="application/javascript">
$(document).ready(function() {
		$('#tanggal').datetimepicker({
			dateFormat: "yy-mm-dd",
			monthNames: ["Januari","Februari","Maret","April","Mei","Juni",
			"Juli","Agustus","September","Oktober","November","Desember"], // Names of months for drop-down and formatting
			monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"], // For formatting
			dayNames: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"], // For formatting
			dayNamesShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"], // For formatting
			dayNamesMin: ["Mi","Sn","Sl","Rb","Km","Jm","Sa"],
			altField: "#jam"
		});
		$("#formapp").validate({
		messages: {
		 	nip: {
				required: "Pegawai harus dipilih",
			},
			type: {
				required: "Type absen harus dipilih"	
			},
			tanggal: {
				required: "Tanggal harus diisi"	
			},
			jam: {
				required: "Jam harus diisi"	
			}
		},
		
	  rules: {
			nip: {
			  required: true
			},
			type: {
				required:true	
			},
			tanggal: {
				required:true	
			},		
			jam: {
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
	<div class="clue"><a href="#">EDIT PRESENSI MANUAL</a></div>
</div>
<div class="canvas-content">
	<form method="post" id="formapp">
    <table class="form" width="100%" cellpadding="0" cellspacing="0">
    <tr><td width="150px">SKPD</td><td><?php echo $this->getSKPD(($this->user['skpd'] <> '')?$this->user['skpd']:$_GET['kodeskpd']);?></td></tr>
    <tr><td width="150px">Pegawai</td><td><select name="nip"><?php echo $this->optPegawai(($this->user['kodeskpd'] <> '')?$this->user['kodeskpd']:$_GET['kodeskpd'],$this->data['nip']);?></select></td></tr>
    <tr><td width="150px">Type Absen</td><td><select name="type"><?php echo $this->optTypeAbsen($this->data['inoutmode']);?></select></td></tr>
    <tr><td width="150px">Tanggal</td><td><input type="text" name="tanggal" id="tanggal" value="<?php echo $this->data['date'];?>"/></td></tr>
    <tr><td width="150px">Jam</td><td><input type="text" name="jam" id="jam" value="<?php echo $this->data['time'];?>"/></td></tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2">
    					<input type="hidden" value="update" name="mode"/>
                        <input type="hidden" value="<?php echo $this->data['id_presensim'];?>" name="id"/>
                        <input type="hidden" value="<?php echo ($this->user['skpd'] <> '')?$this->user['skpd']:$_GET['kodeskpd'];?>" name="kodeskpd"/>
    					<input type="submit" class="button biru" value="Simpan"/>
                        <input type="reset" class="button biru" value="Reset"/>
                        <input type="button" value="Batal" class="button biru" onclick="window.history.go(-1)"/></td></tr>
        </td>
    </tr>
    </table>
    </form>
</div>
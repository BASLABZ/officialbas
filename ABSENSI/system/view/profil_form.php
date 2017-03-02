<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	$("#formapp").validate({
		messages: {
		 	nama: {
				required: "Nama Harus Diisi",
			},
			password2: {
				equalTo: "Konfirmasi Password Tidak Sama"	
			}
		},
		
	  rules: {
			nama: {
			  required: true
			},
			password2: {
				equalTo: "#password"	
			}
	  },		
		
		errorPlacement: function(error, element) {
			error.appendTo(element.parent("td"));
		}
	});
});
</script>
<div class="navclue abu-abu">
	<div class="clue"><a href="#">Profil - Ubah Password</a></div>
</div>

<div class="canvas-content">
	<form method="post" id="formapp">
    	<table class="form" width="100%" cellpadding="0" cellspacing="0">
    		<tr><td width="150px">Username</td><td><?php echo $this->user['username'];?></td></tr>
    		<tr><td width="150px">Nama Lengkap</td><td><input type="text" name="nama" id="nama" value="<?php echo $this->user['nama'];?>"/></td></tr>
    		<tr><td width="150px">Password</td><td><input type="password" name="password" id="password" /></td></tr>
    		<tr><td width="150px">Konfirmasi Password</td><td><input type="password" name="password2" id="password2" /></td></tr>
    		<tr><td colspan="2">&nbsp;</td></tr>
    		<tr><td colspan="2">
    					<input type="hidden" value="update" name="mode"/>
    					<input type="submit" class="button biru" value="Simpan" name="simpan"/>
                        <input type="button" value="Batal" class="button biru" onclick="window.history.go(-1)"/></td></tr>
        		</td>
    		</tr>
		</table>	
	</form>
</div>
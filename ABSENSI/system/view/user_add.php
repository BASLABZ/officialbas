<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function() { 
	$("#formapp").validate({
		messages: {
		 	kodeskpd: {
		 		required: "SKPD harus diisi"
		 	},
		 	nama: {
				required: "Nama Pengguna harus diisi"
			},
			username: {
				required: "Username harus diisi"	
			},
			password: {
				required: "Password harus diisi"	
			},
			password2: {
				equalTo: "Konfirmasi password tidak sama"	
			}

		},
		
	  rules: {
			kodeskpd: {
			  	required: true
			},
			nama: {
			  	required: true
			},
			username: {
				required:true	
			},
			password: {
				required:true	
			},
			password2: {
				equalTo: "#password"	
			}		
	  },		
		
		errorPlacement: function(error, element) {
			error.appendTo(element.parent("td"));
		}
	});
	
})
</script>
<div class="navclue abu-abu">
	<div class="clue"><a href="#"><?php echo strtoupper($this->data['status']);?> DATA PENGGUNA - <?php echo $this->getHakakses($_GET['id']);?></a></div>
</div>
<div class="canvas-content">
	<form method="post" id="formapp">
    <table class="form" width="100%" cellpadding="0" cellspacing="0">
    <?php if($_GET['id'] == '5' || $_GET['id'] == '6'){ ?>
    <tr><td width="150px">SKPD</td><td><?php echo $this->optSKPD();?></td></tr>
    <?php } ?>
    <tr><td width="150px">Nama Lengkap</td><td><input type="text" name="nama" size="40"/></td></tr>
    <tr><td width="150px">Username</td><td><input type="text" name="username" /></td></tr>
    <tr><td width="150px">Password</td><td><input type="password" name="password" id="password"/></td></tr>
    <tr><td width="150px">Konfirmasi Password</td><td><input type="password" name="password2" /></td></tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2">
    					<input type="hidden" value="insert" name="mode"/>
                        
    					<input type="hidden" value="<?php echo $_GET['id'];?>" name="hakakses"/>
                        <input type="submit" class="button biru" value="Simpan"/>
                        <input type="reset" class="button biru" value="Reset"/>
                        <input type="button" value="Batal" class="button biru" onclick="window.history.go(-1)"/></td></tr>
        </td>
    </tr>
    </table>
    </form>
</div>
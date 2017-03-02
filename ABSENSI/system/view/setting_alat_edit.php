<div class="navclue abu-abu">
	<div class="clue"><a href="#">EDIT ALAT</a></div>
</div>
<div class="canvas-content">
	<form method="post" id="formapp">
    <table class="form" width="100%" cellpadding="0" cellspacing="0">
    <tr><td width="150px">Nomor Alat</td><td><input type="text" name="no_alat" id="no_alat" size="10" maxlength="9" value="<?php echo $this->data['dwMachineNumber'];?>"/></td></tr>
    <tr><td width="150px">Nama Alat</td><td><input type="text" name="nama_alat" id="nama_alat" value="<?php echo $this->data['dwTitle'];?>"/></td></tr>
    <tr><td width="150px">SKPD</td><td><select name="skpd" id="skpd"><?php echo $this->optSKPD($this->data['kodeskpd']);?></select></td></tr>
    <tr><td width="150px">IP</td><td><input type="text" name="ip" id="ip" value="<?php echo $this->data['dwIPAddress'];?>"/></td></tr>
    <tr><td width="150px">Port</td><td><input type="text" name="port" id="port" value="<?php echo $this->data['dwPort'];?>"/></td></tr>
    <tr><td width="150px">Password</td><td><input type="text" name="password" id="password" value="<?php echo $this->data['dwPassword'];?>"/></td></tr>
    <tr><td width="150px">Status</td><td><select name="status" id="status"><?php echo $this->optStatus($this->data['dwEnable']);?></select></td></tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2">
    					<input type="hidden" value="update_alat" name="mode"/>
                        <input type="hidden" value="<?php echo $this->data['dwMachineNumber'];?>" name="id"/>
    					<input type="submit" class="button biru" value="Simpan"/>
                        <input type="reset" class="button biru" value="Reset"/>
                        <input type="button" value="Batal" class="button biru" onclick="window.history.go(-1)"/>
        </td>
    </tr>
    </table>
    </form>
</div>
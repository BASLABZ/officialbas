<div class="navclue abu-abu">
	<div class="clue"><a href="#">TAMBAH ALAT</a></div>
</div>
<div class="canvas-content">
	<form method="post" id="formapp">
    <table class="form" width="100%" cellpadding="0" cellspacing="0">
    <tr><td width="150px">Nomor Alat</td><td><input type="text" name="no_alat" id="no_alat" size="10" maxlength="9" /></td></tr>
    <tr><td width="150px">Nama Alat</td><td><input type="text" name="nama_alat" id="nama_alat" /></td></tr>
    <tr><td width="150px">SKPD</td><td><select name="skpd" id="skpd"><?php echo $this->optSKPD($this->data['kodeskpd']);?></select></td></tr>
    <tr><td width="150px">IP</td><td><input type="text" name="ip" id="ip" /></td></tr>
    <tr><td width="150px">Port</td><td><input type="text" name="port" id="port" /></td></tr>
    <tr><td width="150px">Password</td><td><input type="text" name="password" id="password" /></td></tr>
    <tr><td width="150px">Status</td><td><select name="status" id="status"><?php echo $this->optStatus($this->data['dwEnable']);?></select></td></tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2">
    					<input type="hidden" value="insert_alat" name="mode"/>
    					<input type="submit" class="button biru" value="Simpan"/>
                        <input type="reset" class="button biru" value="Reset"/>
                        <input type="button" value="Batal" class="button biru" onclick="window.history.go(-1)"/>
        </td>
    </tr>
    </table>
    </form>
</div>
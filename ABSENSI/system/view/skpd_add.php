<div class="navclue abu-abu">
	<div class="clue"><a href="#">TAMBAH SKPD</a></div>
</div>
<div class="canvas-content">
	<form method="post" id="formapp">
    <table class="form" width="100%" cellpadding="0" cellspacing="0">
    <tr><td width="150px">Kode</td><td><input type="text" name="kode" id="kode" size="10" maxlength="9"/></td></tr>
    <tr><td width="150px">Nama SKPD</td><td><input type="text" name="urai" id="urai" size="70"/></td></tr>
    <tr><td width="150px">Singkatan</td><td><input type="text" name="singkat" id="singkat" /></td></tr>
    
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2">
    					<input type="hidden" value="insert" name="mode"/>
    					<input type="submit" class="button biru" value="Simpan"/>
                        <input type="reset" class="button biru" value="Reset"/>
                        <input type="button" value="Batal" class="button biru" onclick="window.history.go(-1)"/></td></tr>
        </td>
    </tr>
    </table>
    </form>
</div>
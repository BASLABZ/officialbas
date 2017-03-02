<div class="navclue abu-abu">
	<div class="clue"><a href="#">EDIT JENIS IJIN</a></div>
</div>
<div class="canvas-content">
	<form method="post" id="formapp">
    <table class="form" width="100%" cellpadding="0" cellspacing="0">
    <tr><td width="150px">Nama Ijin</td><td><input type="text" name="ijin" id="ijin" value="<?php echo $this->data['nama_ijin'];?>"/></td></tr>
    <tr><td width="150px">Kode</td><td><input type="text" name="kode" id="kode" value="<?php echo $this->data['kode'];?>"/></td></tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2">
    					<input type="hidden" value="update_ijin" name="mode"/>
                        <input type="hidden" value="<?php echo $this->data['id_jenisijin'];?>" name="id"/>
    					<input type="submit" class="button biru" value="Simpan"/>
                        <input type="reset" class="button biru" value="Reset"/>
                        <input type="button" value="Batal" class="button biru" onclick="window.history.go(-1)"/></td></tr>
        </td>
    </tr>
    </table>
    </form>
</div>
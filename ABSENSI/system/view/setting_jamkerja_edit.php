<div class="navclue abu-abu">
	<div class="clue"><a href="#">EDIT JAM KERJA</a></div>
</div>
<div class="canvas-content">
	<form method="post" id="formapp">
    <table class="form" width="100%" cellpadding="0" cellspacing="0">
    <tr><td width="150px">Senin</td><td><input type="text" name="start[1]" size="10" value="<?php echo $this->data['start_1'];?>"/> s/d 
    <input type="text" name="end[1]" size="10" value="<?php echo $this->data['end_1'];?>"/></td></tr>
    <tr><td width="150px">Selasa</td><td><input type="text" name="start[2]" size="10" value="<?php echo $this->data['start_2'];?>"/> s/d 
    <input type="text" name="end[2]" size="10" value="<?php echo $this->data['end_1'];?>"/></td></tr>
    <tr><td width="150px">Rabu</td><td><input type="text" name="start[3]" size="10" value="<?php echo $this->data['start_3'];?>"/> s/d 
    <input type="text" name="end[3]" size="10" value="<?php echo $this->data['end_1'];?>"/></td></tr>
    <tr><td width="150px">Kamis</td><td><input type="text" name="start[4]" size="10" value="<?php echo $this->data['start_4'];?>"/> s/d 
    <input type="text" name="end[4]" size="10" value="<?php echo $this->data['end_1'];?>"/></td></tr>
    <tr><td width="150px">Jum'at</td><td><input type="text" name="start[5]" size="10" value="<?php echo $this->data['start_5'];?>"/> s/d 
    <input type="text" name="end[5]" size="10" value="<?php echo $this->data['end_1'];?>"/></td></tr>
    <tr><td width="150px"><strong>Toleransi Waktu</strong></td><td>
    <input type="text" name="toleransi" size="5" value="<?php echo $this->data['toleransi'];?>"/> Menit</td></tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2">
    					<input type="hidden" value="update_jamkerja" name="mode"/>
    					<input type="submit" class="button biru" value="Simpan"/>
                        <input type="reset" class="button biru" value="Reset"/>
                        <input type="button" value="Batal" class="button biru" onclick="window.history.go(-1)"/></td></tr>
        </td>
    </tr>
    </table>
    </form>
</div>
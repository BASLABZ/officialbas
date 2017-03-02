<div class="navclue abu-abu">
	<div class="clue"><a href="#"><?php echo $this->data['status'];?> TEXT BERJALAN</a></div>
</div>
<div class="canvas-content">
	<form method="post" id="formapp">
    <table class="form" width="100%" cellpadding="0" cellspacing="0">
    <tr><td width="150px">Text</td><td><textarea name="text" cols="40"><?php echo $this->data['text'];?></textarea></td></tr>
    <tr><td width="150px">Status</td><td><select name="enable" id="enable"><?php echo $this->optStatus($this->data['enable']);?></select></td></tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2">
    					<input type="hidden" value="<?php echo $this->data['action'];?>" name="mode"/>
                        <input type="hidden" value="<?php echo $this->data['id'];?>" name="id"/>
    					<input type="submit" class="button biru" value="Simpan"/>
                        <input type="reset" class="button biru" value="Reset"/>
                        <input type="button" value="Batal" class="button biru" onclick="window.history.go(-1)"/>
        </td>
    </tr>
    </table>
    </form>
</div>
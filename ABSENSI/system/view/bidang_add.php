<div class="navclue abu-abu">
	<div class="clue"><a href="#">TAMBAH BIDANG</a></div>
</div>
<div class="canvas-content">
	<form method="post" id="formapp">
    <table class="form" width="100%" cellpadding="0" cellspacing="0">
    <tr><td width="150px">Nama SKPD</td><td><?php echo $this->data['kode']?> - <?php echo $this->data['skpd'];?></td></tr>
    <tr><td width="150px">Nama Bidang</td><td><input type="text" name="nama_bidang" id="nama_bidang" size="70"/></td></tr>
    <input type="hidden" name="id_skpd" id="id_skpd" size="1" maxlength="2" value="<?php echo $this->data['id'];?>"/>
    
    <tr><td colspan="2">
    					<input type="hidden" value="insert_bidang" name="mode"/>
    					<input type="submit" class="button biru" value="Simpan"/>
                        <input type="reset" class="button biru" value="Reset"/>
                        <input type="button" value="Batal" class="button biru" onclick="window.history.go(-1)"/></td></tr>
        </td>
    </tr>
    </table>
    </form>
</div>
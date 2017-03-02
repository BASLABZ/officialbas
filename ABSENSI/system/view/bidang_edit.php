<div class="navclue abu-abu">
	<div class="clue"><a href="#">EDIT BIDANG</a></div>
</div>
<div class="canvas-content">
	<form method="post" id="formapp">
    <table class="form" width="100%" cellpadding="0" cellspacing="0">
        <?php
            $sql = "select skpd, kode from skpd where id='".$this->data['id_skpd']."' ";
            $this->row = $this->db->query($sql);
            $this->data1= $this->db->fetchArray($this->row);
        ?>
    <tr><td width="150px">Nama SKPD</td><td><?php echo $this->data1['kode']?> - <?php echo $this->data1['skpd'];?></td></tr>
    <tr><td width="150px">Nama Bidang</td><td><input type="text" name="nama_bidang" id="nama_bidang" value="<?php echo $this->data['nama_bidang'];?>"/></td></tr>
    
    <tr><td colspan="2">
    					<input type="hidden" value="updateBidang" name="mode"/>
                        <input type="hidden" value="<?php echo $this->data['id'];?>" name="id"/>
    					<input type="submit" class="button biru" value="Simpan"/>
                        <input type="reset" class="button biru" value="Reset"/>
                        <input type="button" value="Batal" class="button biru" onclick="window.history.go(-1)"/></td></tr>
        </td>
    </tr>
    </table>
    </form>
</div>
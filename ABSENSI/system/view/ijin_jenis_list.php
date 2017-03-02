<div class="navclue abu-abu">
	<div class="clue"><a href="#">JENIS - JENIS IJIN</a></div>
</div>
<div class="canvas-content">
    <a href="?pg=setting&mode=addjenis">
    	<div class="button biru">
    		<img src="img/plus.png" alt="tambah"/> Tambah
        </div>
    </a>
    <table class="tabdata">
    <tr>
    	<th class="biru" width="30px">No</th>
    	<th class="biru">Jenis Ijin</th>
        <th class="biru" width="50px">Kode</th>
        <th class="biru" width="55px">Aksi</th>
    </tr>
    <?php 
    $no = 1;
    while($data = $this->db->fetchArray($this->res)){
    ?>
        <tr>
            <td class="td1"><?php echo $no;?></td>
            <td class="td2"><?php echo $data['nama_ijin'];?></td>
            <td class="td1"><?php echo $data['kode'];?></td>
            <td class="td1">
            				<a href="?pg=setting&mode=edit_ijin&id=<?php echo $data['id_jenisijin'];?>">
                            	<img src="img/file-edit.png" class="tooltip" title="Edit"/>
                            </a> 
            				<a onclick="return confirm('Anda yakin akan menghapus data ini?');" href="?pg=setting&mode=delete_ijin&id=<?php echo $data['id_jenisijin'];?>">
                            	<img src="img/file-delete.png" class="tooltip" title="Hapus"/>
                            </a>
            </td>
        </tr>
    <?php
    $no++;
    }
    ?>
    </table>
</div>
<div class="navclue abu-abu">
	<div class="clue"><a href="#">DATA SKPD</a></div>
</div>
<div class="canvas-content">
    <a href="?pg=skpd&mode=add" class="tooltip" title="Tambah SKPD">
    	<div class="button biru">
    		<img src="img/plus.png" alt="tambah" /> Tambah
        </div>
    </a>
    <table class="tabdata">
    <tr>
    	<th class="biru" width="30px">No.</th>
        <th class="biru" width="30px">Kode</th>
    	<th class="biru">Nama SKPD</th>
        <th class="biru" width="100px">Singkatan</th>
        <th class="biru" width="55px">Aksi</th>
    </tr>
    <?php 
	$no = 1;
    while($data = $this->db->fetchArray($this->res)){
    ?>
        <tr class="hov transbg">
            <td class="td1"><?php echo $no;?></td>
            <td class="td1"><?php echo $data['kode'];?></td>
            <td class="td2"><?php echo $data['skpd'];?></td>
            <td class="td2"><?php echo $data['singkat'];?></td>
            <td class="td1">
                            <a href="?pg=skpd&mode=tambah&id=<?php echo $data['id'];?>">
                                <img src="img/file-add.png" class="tooltip" title="Tambah Bidang">
                            </a>
            				<a href="?pg=skpd&mode=edit&id=<?php echo $data['id'];?>">
                            	<img src="img/file-edit.png" class="tooltip" title="Edit"/>
                            </a> 
            				<a onclick="return confirm('Anda yakin akan menghapus data ini?');" href="?pg=skpd&mode=delete&id=<?php echo $data['id'];?>">
                            	<img src="img/file-delete.png" class="tooltip" title="Hapus"/>
                            </a>
            </td>
        </tr>
        <?php
            $sql = "select * from bidang where id_skpd= '".$data['id']."'";
            // die($sql);
            $this->row = $this->db->query($sql);
            while($dataBidang=$this->db->fetchArray($this->row)){
            ?>
        <tr class="hov transbg">
            <td class="td2"></td>
            <td class="td2"></td>
            <td class="td2"><?php echo $dataBidang['nama_bidang'];?></td>
            <td class="td2"></td>
            <td class="td3">
                <a href="?pg=skpd&mode=editBidang&id=<?php echo $dataBidang['id'];?>">
                    <img src="img/file-edit.png" class="tooltip" title="edit">
                </a>
                <a onclick="return confirm('Anda yakin akan menghapus data ini?');" href="?pg=skpd&mode=deleteBidang&id=<?php echo $dataBidang['id'];?>">
                    <img src="img/file-delete.png" class="tooltip" title="edit">
                </a>
            </td>
        </tr>
        <?php
            }
    $no++;
    }
    ?>
    </table>
</div>
<div class="navclue abu-abu">
	<div class="clue"><a href="#">DAFTAR HARI LIBUR</a></div>
</div>
<div class="canvas-content">
	<div class="nav-table">
    	<div class="ll">
            <a href="?pg=setting&mode=addlibur" id="tambah">
                <div class="button biru">
                    <img src="img/plus.png" alt="tambah"/> Tambah
                </div>
            </a>
        </div>
        <div class="rr">
            
        </div>
    </div>
	<table class="tabdata zebra">
    	<tr>
        	<th class="biru" width="30px">No.</th>
            <th class="biru">Tanggal</th>           
            <th class="biru">Keterangan</th> 
            <th class="biru" width="50px">Aksi</th> 
        </tr>
<?php
	$no = 1;
	while($data = $this->db->fetchArray($this->res)){
		echo '<tr class="hov transbg">
				<td class="td1">'.$no.'</td>
				<td>'.$this->dt->IndonesianDatetime($data['tanggal']).'</td>
				<td>'.$data['keterangan'].'</td>
				<td class="td1">
								<a href="?pg=setting&mode=editlibur&id='.$data['id_libur'].'">
                            	<img src="img/file-edit.png" class="tooltip" title="Edit"/>
                            	</a> 
            					<a onclick="return confirm(\'Anda yakin akan menghapus data ini?\');" 
								href="?pg=setting&mode=deletelibur&id='.$data['id_libur'].'">
                            	<img src="img/file-delete.png" class="tooltip" title="Hapus"/>
                            	</a>
							</td>
			  </tr>';	
		$no++;
	}
?>
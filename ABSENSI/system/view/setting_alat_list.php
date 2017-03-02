<div class="navclue abu-abu">
	<div class="clue"><a href="#">DAFTAR ALAT</a></div>
</div>
<div class="canvas-content">
	<div class="nav-table">
    	<div class="ll">
            <a href="?pg=setting&mode=add_alat" id="tambah">
                <div class="button biru">
                    <img src="img/plus.png" alt="tambah"/> Tambah
                </div>
            </a>
        </div>
    </div>
	<table class="tabdata zebra">
    	<tr>
        	
            <th class="biru">No. Alat</th>
            <th class="biru">SKPD</th>
            <th class="biru">Nama Alat</th>
            <th class="biru">IP</th>            
            <th class="biru">Port</th>
            <th class="biru">Status</th>
            <th class="biru">Aksi</th>
        </tr>
        <?php
		while($data = $this->db->fetchArray($this->res)){
			$aktif = ($data['dwEnable'] =='-1')?"Aktif":"Tidak Aktif";
        	echo '<tr class="hov transbg">
					
					<td class="td1">'.$data['dwMachineNumber'].'</td>
					<td>'.$data['skpd'].'</td>
					<td>'.$data['dwTitle'].'</td>
					<td>'.$data['dwIPAddress'].'</td>
					<td class="td1">'.$data['dwPort'].'</td>
					<td class="td1">'.$aktif.'</td>
					<td class="td1">
            				<a href="?pg=setting&mode=edit_alat&id='.$data['dwMachineNumber'].'">
                            	<img src="img/file-edit.png" class="tooltip" title="Edit"/>
                            </a> 
            				<a onclick="return confirm(\'Anda yakin akan menghapus data ini?\');" href="?pg=setting&mode=delete_alat&id='.$data['dwMachineNumber'].'">
                            	<img src="img/file-delete.png" class="tooltip" title="Hapus"/>
                            </a>
            </td>
				  </tr>';
        
		}
		?>
     </table>
</div>
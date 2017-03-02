
<div class="navclue abu-abu">
	<div class="clue"><a href="#">DAFTAR PENGGUNA - <?php echo $this->getHakakses($_GET['id']);?></a></div>
</div>
<div class="canvas-content">
	
    <div class="nav-table">
    	<div class="ll">
            <a href="?pg=<?php echo $_GET['pg'];?>&mode=add&kodeskpd=<?php echo $_GET['kodeskpd'];?>&id=<?php echo $_GET['id'];?>" id="tambah">
                <div class="button biru">
                    <img src="img/plus.png" alt="tambah"/> Tambah
                </div>
            </a>
        </div>
    </div>
    <table class="tabdata zebra">
    	<tr>
        	<th class="biru" width="30px">No.</th>
     
            <th class="biru">Nama Pengguna</th>
            <th class="biru">SKPD</th>
            <th class="biru">Hakakses</th>
                       
            <th class="biru" width="50px">Aksi</th>  
        </tr>
        <?php
		
			if($this->db->numRows($this->res) > 0){
				$no = 1;
				while($data = $this->db->fetchArray($this->res)){
					$type = ($data['inoutmode'] == '0')?'Masuk':'Pulang';
					echo '<tr class="hov transbg">
							<td class="td1">'.$no.'</td>
							
							<td>'.$data['nama'].'</td>
							<td>'.$data['skpd'].'</td>
							<td class="td1" width="120px">'.$data['jenis'].'</td>
							<td class="td1" width="50px">
								<a href="?pg=user&mode=edit&id='.$data['id_user'].'&jenis='.$_GET['id'].'">
                            	<img src="img/file-edit.png" class="tooltip" title="Edit"/>
                            	</a> 
            					<a onclick="return confirm(\'Anda yakin akan menghapus data ini?\');" 
								href="?pg=user&mode=delete&id='.$data['id_user'].'&jenis='.$_GET['id'].'">
                            	<img src="img/file-delete.png" class="tooltip" title="Hapus"/>
                            	</a>
							</td>
						  </tr>';
					$no++;
				}
			}else{
				echo '<tr><td class="td1" colspan="5">Data Kosong</td></tr>';	
			}
		
		?>

    </table>
</div>
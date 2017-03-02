<div class="navclue abu-abu">
	<div class="clue"><a href="#">TEXT BERJALAN </a></div>
</div>
<div class="canvas-content">
	<div class="nav-table">
    	<div class="ll">
            <a href="?pg=setting&mode=add_text" id="tambah">
                <div class="button biru">
                    <img src="img/plus.png" alt="tambah"/> Tambah
                </div>
            </a>
        </div>
    </div>
	<table class="tabdata zebra">
    	<tr>
        	
            <th class="biru" width="30px" >No.</th>
            <th class="biru">Text</th>            
            <th class="biru" width="130px" >Status</th>
            <th class="biru" width="50px" >Aksi</th>
        </tr>
    <?php
	$no = 1;
	while($data = $this->db->fetchArray($this->res)){
		$aktif = ($data['enable'] =='-1')?"Aktif":"Tidak Aktif";
		echo '<tr class="hov transbg">
        		<td width="30px" class="td1">'.$no.'</td>
            	<td>'.$data['text'].'</td>
            	<td class="td1">'.$aktif.'</td>
            	<td class="td1">
            		<a href="?pg=setting&mode=edit_text&id='.$data['id'].'">
                           	<img src="img/file-edit.png" class="tooltip" title="Edit"/>
                    </a> 
            		<a onclick="return confirm(\'Anda yakin akan menghapus data ini?\');" href="?pg=setting&mode=delete_text&id='.$data['id'].'">
                           	<img src="img/file-delete.png" class="tooltip" title="Hapus"/>
                    </a>
            	</td>
        	 </tr>';
		$no++;
	}
	?>
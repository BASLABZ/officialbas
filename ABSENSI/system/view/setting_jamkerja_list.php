<div class="navclue abu-abu">
	<div class="clue"><a href="#">DAFTAR JAM KERJA</a></div>
</div>
<div class="canvas-content">
	<div class="nav-table">
    	
        <div class="rr">
            <a href="?pg=setting&mode=editjamkerja" class="aksi" alt="edit">
                <div class="button biru">
                    Edit
                </div>
            </a>
            
        </div>
    </div>
	<table class="tabdata zebra">
    	<tr>
        	<th class="biru" width="30px">No.</th>
            <th class="biru">Hari</th>
            <th class="biru">Jam Masuk</th>
            <th class="biru">Jam Pulang</th>           
            <th class="biru">Toleransi</th>  
        </tr>
        <?php
        $no = 1;
		while($data = $this->db->fetchArray($this->res)){
			echo '<tr class="hov transbg">
				  	<td>'.$no.'</td>
					<td>'.$data['workDay'].'</td>
					<td width="150px" class="td1">'.$data['workStart'].'</td>
					<td width="150px" class="td1">'.$data['workEnd'].'</td>
					<td width="150px" class="td1">'.$data['tolerance'].'</td>
				  </tr>';
			$no++;
		}
		?>
    </table>
</div>
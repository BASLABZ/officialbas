<div class="navclue abu-abu">
	<div class="clue"><a href="#">DATA IJIN PEGAWAI - <?php echo strtoupper($this->getJenisIjin($_GET['id']));?></a></div>
</div>
<script>
	$(document).ready(function() {
		var kodeskpd = '<?php echo $_GET['kodeskpd'];?>'; 
		var id = '<?php echo $_GET['id'];?>'; 
		$("#optskpd").change(function(){
			window.location = '?pg=ijin&id='+id+'&kodeskpd='+$(this).val();
		});
		$("#tambah").click(function(){
			if(kodeskpd == ''){
				alert('Pilih SKPD terlebih dahulu!');
				return false;	
			}
		});
		
	});
</script>
<div class="canvas-content">
	<div class="ket">
    	<table class="tabket">
        	<tr><td class="td1">SKPD</td><td>: <?php echo "".$this->optSKPD($this->user['kodeskpd']).""; ?></td></tr>
        </table>
    </div>
    <div class="nav-table">
    	<div class="ll">
            <a href="?pg=ijin&mode=add&id=<?php echo $_GET['id'];?>&kodeskpd=<?php echo $_GET['kodeskpd'];?>" id="tambah">
                <div class="button biru">
                    <img src="img/plus.png" alt="tambah"/> Tambah
                </div>
            </a>
        </div>
        <div class="rr">
            
        </div>
    </div>
    <form id="form-ijin" method="post">
    <table class="tabdata zebra">
    	<tr>
        	<th class="biru" width="30px">No.</th>
        	<th class="biru">NIP</th>
            <th class="biru">Nama Pegawai</th>
            <th class="biru" width="100px">Ijin</th>
            <th class="biru" width="100px">Tanggal Mulai</th>
            <th class="biru" width="100px">Jam Mulai</th>
            <th class="biru" width="100px">Tanggal Selesai</th>
            <th class="biru" width="100px">Jam Selesai</th>
            <th class="biru" width="70px">Jml Ijin Hari Kerja</th>
            <th class="biru">Keterangan</th>
            <th class="biru" width="50px">Aksi</th>
        </tr>
        <?php
		if($_GET['kodeskpd'] <> ''){
			if($this->db->numRows($this->res) > 0){
				$no = 1;
				while($data = $this->db->fetchArray($this->res)){
	
					echo '<tr class="hov transbg">
							<td class="td1">'.$no.'</td>
							<td width="160px">'.$data['nip'].'</td>
							<td width="160px">'.$data['nama'].'</td>
							<td class="td1">'.$data['nama_ijin'].'</td>
							<td>'.$this->dt->indonesian_date($data['date_start'],'l, j F Y').'</td>
							<td>'.$data['time_start'].'</td>
							<td>'.$this->dt->indonesian_date($data['date_end'],'l, j F Y').'</td>
							<td>'.$data['time_end'].'</td>
							<td class="td1">'.$data['jumlah_harikerja'].'</td>
							<td>'.$data['keterangan'].'</td>
							<td class="td1">
								<a href="?pg=ijin&mode=edit&id='.$data['id_ijin'].'&kodeskpd='.$_GET['kodeskpd'].'&jenis='.$_GET['id'].'">
                            	<img src="img/file-edit.png" class="tooltip" title="Edit"/>
                            	</a> 
            					<a onclick="return confirm(\'Anda yakin akan menghapus data ini?\');" 
								href="?pg=ijin&mode=delete&id='.$data['id_ijin'].'&kodeskpd='.$_GET['kodeskpd'].'&jenis='.$_GET['id'].'">
                            	<img src="img/file-delete.png" class="tooltip" title="Hapus"/>
                            	</a>
							</td>
						  </tr>';
					$no++;
				}
			}else{
				echo '<tr><td class="td1" colspan="11">Data Kosong</td></tr>';	
			}
		}else{
			echo '<tr><td class="td1" colspan="11">Pilih SKPD terlebih dahulu</td></tr>';	
		}
		?>
    </table>
    <input type="hidden" name="mode" value="" id="mode"/>
    <input type="hidden" name="kodeskpd" value="<?php echo $_GET['kodeskpd'];?>"/>
    </form>
</div>
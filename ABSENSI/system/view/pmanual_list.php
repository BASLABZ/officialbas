<script>
	$(document).ready(function() {
		var kodeskpd = '<?php echo $_GET['kodeskpd'];?>';
		$("#tambah").click(function(){
			if(kodeskpd == ''){
				alert('Pilih SKPD terlebih dahulu!');
				return false;	
			}
		});
		$("#optskpd").change(function(){
			window.location = '?pg=pmanual&mode=harian&kodeskpd='+$(this).val();
		});
		
	});
</script>
<div class="navclue abu-abu">
	<div class="clue"><a href="#">PRESENSI MANUAL</a></div>
</div>
<div class="canvas-content">
	<div class="ket">
    	<table class="tabket">
        	<tr><td class="td1">SKPD</td><td>: <?php echo "".$this->optSKPD($this->user['kodeskpd']).""; ?></td></tr>
        </table>
    </div>
    <div class="nav-table">
    	<div class="ll">
            <a href="?pg=pmanual&mode=add&kodeskpd=<?php echo $_GET['kodeskpd'];?>" id="tambah">
                <div class="button biru">
                    <img src="img/plus.png" alt="tambah"/> Tambah
                </div>
            </a>
        </div>
    </div>
    <table class="tabdata zebra">
    	<tr class="hov transbg">
        	<th class="biru" width="30px">No.</th>
            <th class="biru">NIP</th>
            <th class="biru">Nama Pegawai</th>
            <th class="biru">Type Absen</th>
            <th class="biru">Tanggal</th>
            <th class="biru">Jam</th>            
            <th class="biru">Aksi</th>  
        </tr>
        <?php
		if($this->data['id'] <> ''){
			if($this->db->numRows($this->res) > 0){
				$no = $this->page->low + 1;
				while($data = $this->db->fetchArray($this->res)){
					$type = ($data['inoutmode'] == '0')?'Masuk':'Pulang';
					echo '<tr class="hov transbg">
							<td class="td1">'.$no.'</td>
							<td>'.$data['nip'].'</td>
							<td>'.$data['nama'].'</td>
							<td class="td1" width="120px">'.$type.'</td>
							<td>'.$this->dt->indonesian_date($data['date'],'l, j F Y').'</td>
							<td class="td1">'.$data['time'].'</td>
							<td class="td1" width="50px">
								<a href="?pg=pmanual&mode=edit&id='.$data['id_presensim'].'&kodeskpd='.$_GET['kodeskpd'].'">
                            	<img src="img/file-edit.png" class="tooltip" title="Edit"/>
                            	</a> 
            					<a onclick="return confirm(\'Anda yakin akan menghapus data ini?\');" 
								href="?pg=pmanual&mode=delete&id='.$data['id_presensim'].'&kodeskpd='.$_GET['kodeskpd'].'">
                            	<img src="img/file-delete.png" class="tooltip" title="Hapus"/>
                            	</a>
							</td>
						  </tr>';
					$no++;
				}
			}else{
				echo '<tr><td class="td1" colspan="8">Data Kosong</td></tr>';	
			}
		}else{
			echo '<tr><td class="td1" colspan="8">Pilih SKPD terlebih dahulu</td></tr>';	
		}
		?>
    </table>
    <div class="b">
            <div class="l">
                <?php echo $this->page->display_result();?>
            </div><!--[l]-->
            <div class="r">
            	<?php
					echo $this->page->display_pages(); 
				?>
            </div><!--[r]-->       
    </div><!--[b]-->
</div>
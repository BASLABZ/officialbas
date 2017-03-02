<div class="navclue abu-abu">
	<div class="clue"><a href="#">DATA PEGAWAI</a></div>
</div>
<script>
	$(document).ready(function() {
		var kodeskpd = '<?php echo $_GET['kodeskpd'];?>'; 
		var idbidang = '<?php echo $_GET['bidang'];?>'; 
		$("#optskpd").change(function(){
			window.location = '?pg=pegawai&kodeskpd='+$(this).val();
		});
		$("#bidang").change(function(){
			window.location = '?pg=pegawai&kodeskpd='+kodeskpd+'&bidang='+$(this).val();
		});
		$.ajax({
	            url: "system/ajax/pilihan_bidang.php",
	            data: "kodeskpd="+$('#optskpd').val(),
	            cache: false,
	            success: function(msg){
	                $("#bidang").html(msg).val(idbidang);
	            }
	        });
		$("#tambah").click(function(){
			if(kodeskpd == ''){
				alert('Pilih SKPD terlebih dahulu!');
				return false;	
			}
		});
		
		$(".aksi").click(function(){
			t = $(this).attr("alt");
			$("#mode").val(t);
			if(checksum > 0){
				$("#form-pegawai").submit();
			}else{
				alert('Pilih data terlebih dahulu');	
			}
		});

		
	});
</script>
<div class="canvas-content">
	<div class="ket">
    	<table class="tabket">
        	<tr><td class="td1">SKPD</td><td>: <?php echo "".$this->optSKPD($this->user['kodeskpd']).""; ?></td></tr>
        	<tr><td class="td1">BIDANG</td><td>: <select name="unit" id="bidang"><?php echo "".$this->optBidanglist($data['skpd'],$data['id']).""; ?></select></td></tr>
        </table>
    </div>
    <div class="nav-table">
    	<div class="ll">
            <a href="?pg=pegawai&mode=add&kodeskpd=<?php echo $_GET['kodeskpd'];?>" id="tambah">
                <div class="button biru">
                    <img src="img/plus.png" alt="tambah"/> Tambah
                </div>
            </a>
        </div>
        <div class="rr">
            <a href="#" class="aksi" alt="edit">
                <div class="button biru">
                    Edit
                </div>
            </a>
            <a href="#" class="aksi" alt="delete">
                <div class="button biru">
                    Hapus
                </div>
            </a>
        </div>
    </div>
    <form id="form-pegawai" method="post">
    <table class="tabdata zebra">
    	<tr><th class="biru" width="30px"><input type="checkbox" id="checkall"/></th>
        	<th class="biru" width="30px">No.</th>
        	
            <th class="biru">Nama Pegawai</th>
            <th class="biru">NIP</th>
            <th class="biru">Eselon</th>
            <th class="biru">Pangkat/Golongan</th>
            <th class="biru">Jabatan</th>
            <th class="biru">Bidang</th>
            <th class="biru">Status</th>            
            <th class="biru" width="70px">No. Alat</th>
            <th class="biru" width="70px">No. Enroll</th>
            <th class="biru" width="30px"></th>
        </tr>
        <?php
		if($this->data['id'] <> ''){
			if($this->db->numRows($this->res) > 0){
				$no = 1;
				while($data = $this->db->fetchArray($this->res)){
	
					echo '<tr class="hov transbg">
							<td class="td1"><input type="checkbox" class="cb" value="'.$data['nip'].'" name="nip[]"/></td>
							<td class="td1">'.$no.'</td>
							<td width="160px">'.$data['nama'].'</td>
							<td width="160px">'.$this->util->formatNIP($data['nip']).'</td>
							<td>'.$data['eselon'].'</td>
							<td>'.$data['golongan'].'</td>
							<td>'.$data['jabatan'].'</td>
							<td>'.$data['nama_bidang'].'</td>
							<td class="td1">'.$data['status'].'</td>
							<td class="td1">'.$data['dwMachineNumber'].'</td>
							<td class="td1">'.$data['dwEnrollNumber'].'</td>
							<td class="td1"><a href="?pg=pegawai&mode=pindah&nip='.$data['nip'].'"><img src="img/pindah.png" height="16px" class="tooltip" title="Pindah SKPD"/></a></td>
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
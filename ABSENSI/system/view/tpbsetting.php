<div class="navclue abu-abu">	<div class="clue"><a href="#">Form Setting TPB Umum</a></div></div><script>	$(document).ready(function() {		var kodeskpd = '<?php echo $this->data['id'];?>'; 		$("#optskpd").change(function(){			window.location = '?pg=tpbsetting&mode=tpbsetting&kodeskpd='+$(this).val();		});				$("#tambah").click(function(){			if(kodeskpd == ''){				alert('Pilih SKPD terlebih dahulu!');				return false;				}			$("#fbulan").val(<?php echo date('m'); ?>);			$("#ftahun").val(<?php echo date('Y'); ?>);			$("#fnip").val('');			$("#periode").attr('target','');		    $("#periode").attr('action','?pg=tpbsetting&mode=tpbsetting&kodeskpd=<?php echo $this->data['id'];?>');			$("#periode").submit();		});	});		function edit(bulan,tahun) {		$("#periode").attr('target','');		$("#periode").attr('action','?pg=tpbsetting&mode=tpbsetting&kodeskpd=<?php echo $this->data['id'];?>');		$("#fbulan").val(bulan);		$("#ftahun").val(tahun);		$("#periode").submit();		}	function tpb04(bulan,tahun) {		$("#periode").attr('target','');		$("#periode").attr('action','?pg=datatpb&mode=tpb04&kodeskpd=<?php echo $this->data['id'];?>');		$("#fbulan").val(bulan);		$("#ftahun").val(tahun);		$("#periode").submit();		}	function tpb05(bulan,tahun) {		$("#periode").attr('target','');		$("#periode").attr('action','?pg=datatpb&mode=tpb05&kodeskpd=<?php echo $this->data['id'];?>');		$("#fbulan").val(bulan);		$("#ftahun").val(tahun);		$("#periode").submit();		}</script><form id="periode" method="post" target=""><input type="hidden" id="fbulan" name="bulan"><input type="hidden" id="ftahun" name="tahun"><input type="hidden" id="fnip" name="nip"></form><div class="canvas-content">	<div class="ket">    	<table class="tabket">        	<tr><td class="td1">SKPD</td><td>: <?php echo "".$this->optSKPD($this->user['kodeskpd']).""; ?></td></tr>        </table>    </div>    <div class="nav-table"><div class="ll"><a href="#" class="aksi" alt="tambah" id="tambah"><div class="button biru">Tambah</div></a></div></div>    <table class="tabdata">    	<tr><th class="biru" width="30px">No.</th>            <th class="biru">Bulan</th>            <th class="biru">Tahun</th>            <th class="biru">Hari Kerja</th>            <th class="biru">Jam Kerja</th>			<th class="biru">Kepala</th>              <th class="biru">Petugas</th>                           <th class="biru" width="150px">&nbsp;</th>        </tr>        <?php		if($this->data['id']<>'') {			if($this->db->numRows($this->res) > 0){				$no = 1;				while($data = $this->db->fetchArray($this->res)){						echo '<tr>							<td class="td1">'.$no.'</td>							<td>'.$this->util->longMonth[$data['bulan']].'</td>							<td>'.$data['tahun'].'</td>							<td>'.$data['hari'].'</td>							<td>'.$data['jam'].'</td>							<td>'.$data['nama_kepala'].'</td>							<td>'.$data['nama_petugas'].'</td>							<td class="td1" width="25%">							<div class="nav-table">							<div class="ll">            						<a href="#" class="aksi" alt="edit" onClick="edit(\''.$data['bulan'].'\',\''.$data['tahun'].'\');"><div class="button biru">Edit</div></a>            						<a href="#" class="aksi" alt="edit" onClick="tpb04(\''.$data['bulan'].'\',\''.$data['tahun'].'\');"><div class="button biru">TPB 04</div></a>            						<a href="#" class="aksi" alt="edit" onClick="tpb05(\''.$data['bulan'].'\',\''.$data['tahun'].'\');"><div class="button biru">TPB 05</div></a>        						</div>        						</div>							</td>						  </tr>';					$no++;				}			}else{				echo '<tr><td class="td1" colspan="8">Data Kosong</td></tr>';				}		}else{			echo '<tr><td class="td1" colspan="8">Pilih SKPD terlebih dahulu</td></tr>';			}		?>    </table></div>
<?php 
$db = $this->db;
$util = $this->util;
$image = $this->cnf->ROOTDIR."img/image003.png";

if(!empty($_POST['bulan'])) {
	$res = $db->query("SELECT hari, jam, nama_kepala, nip_kepala, nama_bendahara, nip_bendahara, nama_petugas, nip_petugas  FROM setting WHERE skpd = '".$db->esc($this->data['id'])."' AND bulan = '".$db->esc($_POST['bulan'])."' AND tahun = '".$db->esc($_POST['tahun'])."'");
	list($hari, $jam, $nama_kepala, $nip_kepala, $nama_bendahara, $nip_bendahara, $nama_petugas, $nip_petugas) = $db->fetchArray($res);
	
	$res = $db->query("SELECT * FROM setting04 LIMIT 0,1");
	list($persen_disiplin, $persen_kehadiran, $persen_kepatuhan, $persen_kinerja, $persen_prestasi, $persen_inovasi_kreativitas, $persen_kemampuan_managerial, $persen_kemampuan_interpersonal) = $db->fetchArray($res);	
	
	if(!empty($_POST['nip'])) {
		$nip = $_POST['nip'];
		$res = $db->query("SELECT nama,golongan, pangkat, eselon,gol1, gol2, jabatan, subunit, id, skpd.skpd, status, namaa,nipa,tpb FROM pegawai LEFT JOIN skpd on id = pegawai.skpd WHERE nip = '".$db->esc($_POST['nip'])."'");
		list($nama,$golongan,$pangkat,$eselon,$gol1,$gol2,$jabatan,$subunit,$skpd,$nama_skpd,$status,$namaa,$nipa,$tpb) = $db->fetchArray($res);
		
		$res = $db->query("SELECT pajak FROM pajak WHERE golongan = '".$db->esc($golongan)."'");
		list($pajak) = $db->fetchArray($res);
		
		$res = $db->query("SELECT hari,jam,total_tpb,kehadiran,kepatuhan,potongan,prestasi,inovasi,managerial,interpersonal,tambahan,tgl,bln,thn,nama1,nip1,nama2,nip2,persen_disiplin,persen_kehadiran,persen_kepatuhan,persen_kinerja,persen_prestasi,persen_inovasi_kreativitas,persen_kemampuan_managerial,persen_kemampuan_interpersonal,pajak FROM form04 WHERE nip = '".$db->esc($_POST['nip'])."' AND bulan = '".$db->esc($_POST['bulan'])."' AND tahun = '".$db->esc($_POST['tahun'])."'");
		if($db->numRows($res) > 0) {
			list($hari, $jam, $total_tpb, $huruf_kehadiran, $huruf_kepatuhan, $potongan, $huruf_prestasi, $huruf_inovasi, $huruf_managerial, $huruf_interpersonal, $tambahan, $tgl, $bln, $thn, $nama1, $nip1, $nama2, $nip2, $_POST['persen_disiplin'], $_POST['persen_kehadiran'], $_POST['persen_kepatuhan'], $_POST['persen_kinerja'], $_POST['persen_prestasi'], $_POST['persen_inovasi_kreativitas'], $_POST['persen_kemampuan_managerial'], $_POST['persen_kemampuan_interpersonal'], $_POST['pajak']) = $db->fetchArray($res);

?>
<form method="post" id="formUbah" style="display:none ">
	<input type="hidden" name="bulan" value="<?php echo $_POST['bulan']; ?>">
	<input type="hidden" name="tahun" value="<?php echo $_POST['tahun']; ?>">
	<input type="hidden" name="skpd" value="<?php echo $this->data["id"]; ?>">
	<input type="hidden" name="nip" value="<?php echo $_POST['nip']; ?>">
	<input type="hidden" name="diupdate" value="true">
</form>
<?php
			if(!isset($_POST['diupdate']) && !($_POST['aksi'] == "Simpan" || $_POST['aksi'] == "Cetak")) {
				if($persen_disiplin != $_POST['persen_disiplin'] || $persen_kehadiran != $_POST['persen_kehadiran'] || $persen_kepatuhan != $_POST['persen_kepatuhan'] || $persen_kinerja != $_POST['persen_kinerja'] | $persen_prestasi != $_POST['persen_prestasi'] || $persen_inovasi_kreativitas != $_POST['persen_inovasi_kreativitas'] || $persen_kemampuan_managerial != $_POST['persen_kemampuan_managerial'] || $persen_kemampuan_interpersonal != $_POST['persen_kemampuan_interpersonal'] || $pajak != $_POST['pajak']) {
?>
<script>
	if(confirm('Apakah akan menggunakan tarif pajak baru?'))
		document.getElementById('formUbah').submit();
</script>
<?php
				}
			}
		}
			 
		if(isset($_POST['diupdate']) || $db->numRows($res) <= 0) {
			$_POST['persen_disiplin'] = $persen_disiplin;
			$_POST['persen_kehadiran'] = $persen_kehadiran;
			$_POST['persen_kepatuhan'] = $persen_kepatuhan;
			$_POST['persen_kinerja'] = $persen_kinerja;
			$_POST['persen_prestasi'] = $persen_prestasi;
			$_POST['persen_inovasi_kreativitas'] = $persen_inovasi_kreativitas;
			$_POST['persen_kemampuan_managerial'] = $persen_kemampuan_managerial;
			$_POST['persen_kemampuan_interpersonal']= $persen_kemampuan_interpersonal;
			$_POST['pajak'] = $pajak;
		}
			
			
		if(!isset($_POST['aksi'])) {
			$_POST['aksi'] = "Preview";
			@$_POST['huruf_kehadiran'] = $huruf_kehadiran;
			@$_POST['huruf_kepatuhan'] = $huruf_kepatuhan;
			@$_POST['huruf_prestasi'] = $huruf_prestasi;
			@$_POST['huruf_inovasi'] = $huruf_inovasi;
			@$_POST['huruf_managerial'] = $huruf_managerial;
			@$_POST['huruf_interpersonal'] = $huruf_interpersonal;
			@$_POST['tgl'] = $tgl;
			@$_POST['bln'] = $bln;
			@$_POST['thn'] = $thn;
			@$_POST['nama1'] = $nama1;
			@$_POST['nip1'] = $nip1;
			@$_POST['nama2'] = $nama2;
			@$_POST['nip2'] = $nip2;
		}
			
		$res = $db->query("SELECT tgl, bln, thn, nama1, nip1, nama2, nip2 FROM form04 WHERE bulan = '".$db->esc($_POST['bulan'])."' AND tahun = '".$db->esc($_POST['tahun'])."' AND skpd = '".$db->esc($skpd)."' GROUP BY tgl, bln, thn, nama1, nip1, nama2, nip2");
		while(list($_tgl, $_bln, $_thn, $_nama1, $_nip1, $_nama2, $_nip2) = $db->fetchArray($res)) {
			$tgl = $_tgl;
			$bln = $_bln;
			$thn = $_thn;
			$nama1 = $_nama1;
			$nip1 = $_nip1;
			$nama2 = $_nama1;
			$nip2 = $_nip2;
		}
			
		if(empty($_POST['tgl'])) $_POST['tgl']  =@$tgl;
				
		if(empty($_POST['bln'])) $_POST['bln']  =@$bln;
				
		if(empty($_POST['thn'])) $_POST['thn']  =@$thn;
				
		if(empty($_POST['nama1'])) $_POST['nama1']  =@$nama1;
				
		if(empty($_POST['nip1'])) $_POST['nip1']  =@$nip1;
				
		if(empty($_POST['nama2'])) $_POST['nama2']  =@$nama2;
				
		if(empty($_POST['nip2'])) $_POST['nip2']  =@$nip2;
			
		$lanjut = true;		
	} else 
		$lanjut = false;
		
	if(isset($_POST['aksi'])) {
		if($_POST['aksi'] == "Simpan") {
			$total_tpb = $tpb;
			$hari = $_POST['hari'];
			$jam = $_POST['jam'];
		}
			
		if($_POST['aksi'] == "Simpan" || $_POST['aksi'] == "Cetak") {
		
			$duit_disiplin  = $total_tpb*$_POST['persen_disiplin']/100;
			$duit_kehadiran  = $duit_disiplin*$_POST['persen_kehadiran']/100;
			$duit_kepatuhan  = $duit_disiplin*$_POST['persen_kepatuhan']/100;
			
			$potongan_kehadiran = $duit_kehadiran*$this->pengaliDisiplin04($_POST['huruf_kehadiran'])/100;
			$potongan_kepatuhan = $duit_kepatuhan*$this->pengaliDisiplin04($_POST['huruf_kepatuhan'])/100;
			$potongan = $potongan_kehadiran + $potongan_kepatuhan;
			
			$duit_kinerja  = $total_tpb*$_POST['persen_kinerja']/100;
			$duit_prestasi  = $duit_kinerja*$_POST['persen_prestasi']/100;
			$duit_inovasi_kreativitas  = $duit_kinerja*$_POST['persen_inovasi_kreativitas']/100;
			$duit_kemampuan_managerial  = $duit_kinerja*$_POST['persen_kemampuan_managerial']/100;
			$duit_kemampuan_interpersonal  = $duit_kinerja*$_POST['persen_kemampuan_interpersonal']/100;
			
			$tambahan_prestasi = $duit_prestasi*$this->pengaliKinerja04($_POST['huruf_prestasi'])/100;
			$tambahan_inovasi_kreativitas = $duit_inovasi_kreativitas*$this->pengaliKinerja04($_POST['huruf_inovasi'])/100;
			$tambahan_kemampuan_managerial = $duit_kemampuan_managerial*$this->pengaliKinerja04($_POST['huruf_managerial'])/100;
			$tambahan_kemampuan_interpersonal = $duit_kemampuan_interpersonal*$this->pengaliKinerja04($_POST['huruf_interpersonal'])/100;
			$tambahan = $tambahan_prestasi + $tambahan_inovasi_kreativitas + $tambahan_kemampuan_managerial + $tambahan_kemampuan_interpersonal;
		
			$db->query("DELETE FROM form05 WHERE nip = '".$db->esc($_POST['nip'])."' AND bulan = '".$db->esc($_POST['bulan'])."' AND tahun = '".$db->esc($_POST['tahun'])."'");
		
			$query = "REPLACE INTO form04 (bulan, tahun, nip, golongan, pangkat, gol1, gol2, jabatan, subunit, status, skpd, hari, jam, total_tpb, ".
			         "kehadiran, kepatuhan, potongan, prestasi, inovasi, managerial, interpersonal, tambahan, tgl, bln, thn, nama1, nip1, nama2, nip2, ".
					 "persen_disiplin, persen_kehadiran, persen_kepatuhan, persen_kinerja, persen_prestasi, persen_inovasi_kreativitas, ".
					 "persen_kemampuan_managerial, persen_kemampuan_interpersonal, pajak) ".
					 "VALUE ('".$db->esc($_POST['bulan'])."', '".$db->esc($_POST['tahun'])."', '".$db->esc($_POST['nip'])."', '".$db->esc($golongan)."','".$db->esc($pangkat)."', '".$db->esc($gol1)."', '".$db->esc($gol2)."', ".
					 "'".$db->esc($jabatan)."', '".$db->esc($subunit)."', '".$db->esc($status)."', '".$db->esc($this->data['id'])."', '".$db->esc($_POST['hari'])."', '".$db->esc($_POST['jam'])."', ".
					 "'".$db->esc($total_tpb)."', '".$db->esc($_POST['huruf_kehadiran'])."', '".$db->esc($_POST['huruf_kepatuhan'])."', '".$db->esc($potongan)."', '".$db->esc($_POST['huruf_prestasi'])."', ".
					 "'".$db->esc($_POST['huruf_inovasi'])."', '".$db->esc($_POST['huruf_managerial'])."', '".$db->esc($_POST['huruf_interpersonal'])."', '".$db->esc($tambahan)."', ".
					 "'".$db->esc($_POST['tgl'])."', '".$db->esc($_POST['bln'])."', '".$db->esc($_POST['thn'])."', '".$db->esc($namaa)."', '".$db->esc($nipa)."', '".$db->esc($_POST['nama2'])."', '".$db->esc($_POST['nip2'])."', ".
					 "'".$db->esc($_POST['persen_disiplin'])."', '".$db->esc($_POST['persen_kehadiran'])."', '".$db->esc($_POST['persen_kepatuhan'])."', '".$db->esc($_POST['persen_kinerja'])."', ".
					 "'".$db->esc($_POST['persen_prestasi'])."', '".$db->esc($_POST['persen_inovasi_kreativitas'])."', '".$db->esc($_POST['persen_kemampuan_managerial'])."', ".
					 "'".$db->esc($_POST['persen_kemampuan_interpersonal'])."', '".$db->esc($_POST['pajak'])."')";
			
			$res = $db->query($query);
			
			if ($res) { 
				echo "<form id='back' method='post' action='?pg=datatpb&mode=tpb04&kodeskpd=".$this->data['id']."'>";
				echo "<input type='hidden' name='bulan' value='".$_POST['bulan']."'>";
				echo "<input type='hidden' name='tahun' value='".$_POST['tahun']."'>";
				if ($_POST['aksi'] == "Cetak") echo "<input type='hidden' name='cetaknip' value='".$_POST['nip']."'>"; 
				echo "</form><script>document.getElementById('back').submit();</script>";
			}
		} 
	}
}

if($lanjut) {
?>
<form id="frmInput" method="post" onSubmit="return confirm('Simpan data?');">
<input type="hidden" name="bulan" value="<?php echo $_POST['bulan']; ?>">
<input type="hidden" name="tahun" value="<?php echo $_POST['tahun']; ?>">
<input type="hidden" name="nip" value="<?php echo $_POST['nip']; ?>">
<input type="hidden" name="skpd" value="<?php echo $this->data["id"]; ?>">
<input type="hidden" name="total_tpb" id="total_tpb" value="<?php echo $total_tpb; ?>">
<input type="hidden" name="hari" value="<?php echo $hari; ?>">
<input type="hidden" name="jam" value="<?php echo $jam; ?>">
<?php
  if (isset($_POST['diupdate']) || $db->numRows($res) <= 0) echo '<input type="hidden" name="diupdate" value="true">';
?>
<table border="1" cellpadding="5" cellspacing="0">
	<tr>
		<td width="730"><strong>FORMULIR TPB 04</strong></td>
	</tr>
	<tr>
		<td align="center"><strong>PEMERINTAH PROVINSI PAPUA<br>DAFTAR PERHITUNGAN TAMBAHAN PENGHASILAN BERSYARAT (TPB) UNTUK JABATAN STRUKTURAL<br>
		</strong></td>
	</tr>
	<tr>
		<td align="center"><strong>IDENTITAS PEGAWAI</strong></td>
	</tr>
	<tr>
		<td>
			<table border="0" width="100%">
				<tr>
					<td width="20%">NIP / Nama</td>
					<td>:</td>				
					<td width="100%"><?php echo $util->formatNIP($nip)." / ".$nama; ?></td>
					<td rowspan="5"><img src="<?php echo $image; ?>"></td>
				</tr>
				<tr>
					<td>Pangkat/Golongan</td>
					<td>:</td>
					<td><?php echo $golongan; ?></td>
				</tr>
				<tr>
					<td>Jabatan Struktural</td>
					<td>:</td>
					<td><?php echo $jabatan; ?></td>
				</tr>
				<tr>
					<td>Unit Kerja/SKPD</td>
					<td>:</td>
					<td><?php echo $subunit."/".$nama_skpd; ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<table width="100%" border="0">
              <tr>
                <td>Bulan/Tahun Penilaian </td>
                <td>: <?php echo $util->longMonth[$_POST['bulan']*1]. " ".$_POST['tahun']; ?></td>
                <td>&nbsp;</td>
                <td>Jumlah Hari Kerja/Bulan</td>
                <td>: <?php echo $hari; ?> Hari</td>
              </tr>
              <tr>
                <td>Total Maksimal TPB</td>
                <td>: <?php echo $util->duit_rp($tpb);?> </td>
                <td>&nbsp;</td>
                <td>Jumlah Jam Kerja/Hari</td>
                <td>: <?php echo $jam; ?> Jam</td>
              </tr>
            </table>
			<hr>
			<strong>PERHITUNGAN TAMBAHAN PENGHASILAN BERSYARAT (TPB) PNS</strong>
		</td>
	</tr>
	<tr>
	  <td>
	  	<table border="0" cellpadding="5" cellspacing="0" width="100%">
			<tr style="background-color:#CCCCCC ">
				<td><strong>A. DISIPLIN</strong></td>
				<td>&nbsp;</td>
				<td><strong><span id="persen_disiplin"></span> %</strong></td>
				<td><strong>Dari Total TPB Sebesar :</strong></td>
				<td align="right"><strong><span id="duit_disiplin"></span></strong></td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td>1. Kehadiran</td>
				<td>&nbsp;</td>
				<td><span id="persen_kehadiran"> %</span></td>
				<td>Dari Alokasi TPB Disiplin Sebesar : </td>
				<td align="right"><span id="duit_kehadiran"></span></td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Penilaian</td>
				<td><?php $util->select_huruf('huruf_kehadiran'); ?></td>
				<td>Potongan : <span id="potongan_kehadiran"></span></td>
				<td>&nbsp;</td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td>2. Kepatuhan</td>
				<td>&nbsp;</td>
				<td><span id="persen_kepatuhan"></span> %</td>
				<td>Dari Alokasi TPB Disiplin Sebesar : </td>
				<td align="right"><span id="duit_kepatuhan"></span></td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Penilaian</td>
				<td><?php $util->select_huruf('huruf_kepatuhan'); ?></td>
				<td>Potongan : <span id="potongan_kepatuhan"></span></td>
				<td>&nbsp;</td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="5" align="right">Total Potongan Kedisiplinan Pegawai (D) :</td>
				<td align="right"><span id="duit_potongan"></span></td>
			</tr>
			<tr>
				<td colspan="6">&nbsp;</td>
			</tr>
			<tr style="background-color:#CCCCCC ">
				<td><strong>B. KINERJA</strong></td>
				<td>&nbsp;</td>
				<td><strong><span id="persen_kinerja"></span> %</strong></td>
				<td><strong>Dari Total TPB Sebesar :</strong></td>
				<td align="right"><strong><span id="duit_kinerja"></span></strong></td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td>1. Prestasi</td>
				<td>&nbsp;</td>
				<td><span id="persen_prestasi"></span> %</td>
				<td>Dari Alokasi TPB Kinerja Sebesar : </td>
				<td align="right"><span id="duit_prestasi"></span></td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Penilaian</td>
				<td><?php $util->select_huruf('huruf_prestasi'); ?></td>
				<td>Tambahan : <span id="tambahan_prestasi"></span></td>
				<td>&nbsp;</td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td>2. Inovasi dan Kreativitas</td>
				<td>&nbsp;</td>
				<td><span id="persen_inovasi_kreativitas"></span> %</td>
				<td>Dari Alokasi TPB kinerja Sebesar : </td>
				<td align="right"><span id="duit_inovasi_kreativitas"></span></td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Penilaian</td>
				<td><?php $util->select_huruf('huruf_inovasi'); ?></td>
				<td>Tambahan : <span id="tambahan_inovasi_kreativitas"></span></td>
				<td>&nbsp;</td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td>3. Kemampuan Managerial</td>
				<td>&nbsp;</td>
				<td><span id="persen_kemampuan_managerial"></span> %</td>
				<td>Dari Alokasi TPB kinerja Sebesar : </td>
				<td align="right"><span id="duit_kemampuan_managerial"></span></td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Penilaian</td>
				<td><?php $util->select_huruf('huruf_managerial'); ?></td>
				<td>Tambahan : <span id="tambahan_kemampuan_managerial"></span></td>
				<td>&nbsp;</td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td>4. Kemampuan Interpersonal</td>
				<td>&nbsp;</td>
				<td><span id="persen_kemampuan_interpersonal"></span> %</td>
				<td>Dari Alokasi TPB kinerja Sebesar : </td>
				<td align="right"><span id="duit_kemampuan_interpersonal"></span></td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Penilaian</td>
				<td><?php $util->select_huruf('huruf_interpersonal'); ?></td>
				<td>Tambahan : <span id="tambahan_kemampuan_interpersonal"></span></td>
				<td>&nbsp;</td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="5" align="right">Total Tambahan Kinerja Pegawai (K) :</td>
				<td align="right"><span id="duit_tambahan"></span></td>
			</tr>
			<tr>
			  <td colspan="5" align="right">Total TPB (kotor) adalah (<span id="t_disiplin"></span> - <span id="t_potongan"></span> + <span id="t_tambahan"></span>) :</td>
			  <td align="right"><span id="total"></span></td>
		    </tr>
			<tr>
			  <td align="center">TERBILANG : </td>
			  <td colspan="5"><span id="terbilang"></span></td>
		    </tr>
		</table>
	  </td>
    </tr>
	<tr>
		<td>
			<table width="100%" border="0">
				<tr>
					<td colspan="2">Demikian daftar perhitungan Tambahan Penghasilan Bersyarat (TPB) ini dibuat dengan sebenarnya.</td>
				</tr>
				<tr>
					<td align="center"><strong>Mengetahui,</strong></td>
					<td align="center">Jayapura, 
					<select name="tgl">
						<?php
							for($i=1;$i<=31;$i++) {
								$tgl_now = date("j");
								$tanggal = (empty($tgl))?$tgl_now:$tgl;
						?>
						<option value="<?php echo $i; ?>" <?php if($i==$tanggal) echo "selected"; ?>><?php echo $i; ?></option>
						<?php
							}
						?>
					</select>
					<select name="bln">
						<?php
							for($i=1;$i<=12;$i++) {
								$bln_now = date("n");
								$bulan = (empty($bln))?$bln_now:$bln;
						?>
						<option value="<?php echo $i; ?>" <?php if($i==$bulan) echo "selected"; ?>><?php echo $util->longMonth[$i]; ?></option>
						<?php
							}
						?>
					</select>
					<select name="thn">
						<?php
							for($i=date("Y");$i>=2010;$i--) {
								$thn_now = date("n");
								$tahun = (empty($thn))?$thn_now:$thn;
						?>
						<option value="<?php echo $i; ?>" <?php if($i==$tahun) echo "selected"; ?>><?php echo $i; ?></option>
						<?php
							}
						?>
					</select>
					
					</td>
				</tr>
				<tr>
					<td align="center">Atasan Langsung/Penilai</td>
					<td align="center">Petugas Input Data,</td>
				</tr>
				<tr>
					<td align="center"><br><br><br><br><u><strong><?php echo $namaa; ?></strong></u></td>
					<td align="center" valign="bottom"><br><br><br><br><u><strong><input type="hidden" name="nama2" value="<?php echo $nama_petugas; ?>"><?php echo $nama_petugas; ?></strong></u></td>
				</tr>
				<tr>
					<td align="center"><strong>NIP.<?php echo $util->formatNIP($nipa); ?></strong></td>
					<td align="center" valign="top"><strong>NIP.<input type="hidden" name="nip2" value="<?php echo $nip_petugas; ?>"><?php echo $util->formatNIP($nip_petugas); ?></strong></td>
				</tr>
			</table>
			<br>
			<table align="center" width="100%" cellpadding="5" cellspacing="0" border="1">
				<tr>
					<th colspan="4">KONVERSI BOBOT PENILAIAN TAMBAHAN PENGHASILAN BERSYARAT (TPB)</th>
				</tr>
				<tr>
					<th>Kode Penilaian</th>
					<th>Potongan Untuk Disiplin</th>
					<th>Tambahan Untuk Kinerja</th>
					<th>Keterangan</th>
				</tr>
				<tr>
					<td>a. Sangat Tidak Baik (STB)</td>
					<td align="center">100%</td>
					<td align="center">0%</td>
					<td rowspan="5">Dari Alokasi TPB Untuk Masing-Masing Indikator Penilaian</td>
				</tr>
				<tr>
					<td>b. Tidak Baik (TB)</td>
					<td align="center">75%</td>
					<td align="center">25%</td>
				</tr>
				<tr>
					<td>c. Cukup (C)</td>
					<td align="center">50%</td>
					<td align="center">50%</td>
				</tr>
				<tr>
					<td>d. Baik (B)</td>
					<td align="center">25%</td>
					<td align="center">75%</td>
				</tr>
				<tr>
					<td>c. Sangat Baik (SB)</td>
					<td align="center">0%</td>
					<td align="center">100%</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td align='center'>
	<input type="submit" name="aksi" class="button biru" value="Simpan" id="simpan" >&nbsp;
	<input type="submit" name="aksi" class="button biru" value="Cetak" id="cetak" ></td></tr>
</table>
</form>
<br/><br/>&nbsp;
<iframe id="frame" src="" height="1" width="1" frameborder="0"></iframe>
<script>
	 
	function hitungTPB() {
		var duit_tpb = <?php echo $tpb; ?>; 
		var persen_disiplin = <?php echo $_POST['persen_disiplin']; ?>;
		var persen_kehadiran  = <?php echo $_POST['persen_kehadiran']; ?>;
		var persen_kepatuhan  = <?php echo $_POST['persen_kepatuhan']; ?>;
		var persen_kinerja  = <?php echo $_POST['persen_kinerja']; ?>;
		var persen_prestasi  = <?php echo $_POST['persen_prestasi']; ?>;
		var persen_inovasi_kreativitas  = <?php echo $_POST['persen_inovasi_kreativitas']; ?>;
		var persen_kemampuan_managerial  = <?php echo $_POST['persen_kemampuan_managerial']; ?>;
		var persen_kemampuan_interpersonal = <?php echo $_POST['persen_kemampuan_interpersonal']; ?>;
		
		var duit_disiplin  = duit_tpb*persen_disiplin/100;
		var duit_kehadiran  = duit_disiplin*persen_kehadiran/100;
		var duit_kepatuhan  = duit_disiplin*persen_kepatuhan/100;
		
		var potongan_kehadiran = duit_kehadiran*pengaliDisiplin($('#huruf_kehadiran').val())/100;
		var potongan_kepatuhan = duit_kepatuhan*pengaliDisiplin($('#huruf_kepatuhan').val())/100;
		var duit_potongan = potongan_kehadiran + potongan_kepatuhan;
		
		var duit_kinerja  = duit_tpb*persen_kinerja/100;
		var duit_prestasi  = duit_kinerja*persen_prestasi/100;
		var duit_inovasi_kreativitas  = duit_kinerja*persen_inovasi_kreativitas/100;
		var duit_kemampuan_managerial  = duit_kinerja*persen_kemampuan_managerial/100;
		var duit_kemampuan_interpersonal  = duit_kinerja*persen_kemampuan_interpersonal/100;
		
		var tambahan_prestasi = duit_prestasi*pengaliKinerja($('#huruf_prestasi').val())/100;
		var tambahan_inovasi_kreativitas = duit_inovasi_kreativitas*pengaliKinerja($('#huruf_inovasi').val())/100;
		var tambahan_kemampuan_managerial = duit_kemampuan_managerial*pengaliKinerja($('#huruf_managerial').val())/100;
		var tambahan_kemampuan_interpersonal = duit_kemampuan_interpersonal*pengaliKinerja($('#huruf_interpersonal').val())/100;
		var duit_tambahan = tambahan_prestasi + tambahan_inovasi_kreativitas + tambahan_kemampuan_managerial + tambahan_kemampuan_interpersonal;
		
		var total = duit_disiplin - duit_potongan + duit_tambahan;
		
		$("#persen_disiplin").html(persen_disiplin);
		$("#duit_disiplin").html(duit(duit_disiplin));
		$("#persen_kehadiran").html(persen_kehadiran);
		$("#duit_kehadiran").html(duit(duit_kehadiran));
		$("#persen_kepatuhan").html(persen_kepatuhan);
		$("#duit_kepatuhan").html(duit(duit_kepatuhan));
		
		$("#persen_kinerja").html(persen_kinerja);
		$("#duit_kinerja").html(duit(duit_kinerja));
		$("#persen_prestasi").html(persen_prestasi);
		$("#duit_prestasi").html(duit(duit_prestasi));
		$("#persen_inovasi_kreativitas").html(persen_inovasi_kreativitas);
		$("#duit_inovasi_kreativitas").html(duit(duit_inovasi_kreativitas));
		$("#persen_kemampuan_managerial").html(persen_kemampuan_managerial);
		$("#duit_kemampuan_managerial").html(duit(duit_kemampuan_managerial));
		$("#persen_kemampuan_interpersonal").html(persen_kemampuan_interpersonal);
		$("#duit_kemampuan_interpersonal").html(duit(duit_kemampuan_interpersonal));
		
		$("#potongan_kehadiran").html(duit(potongan_kehadiran));
		$("#potongan_kepatuhan").html(duit(potongan_kepatuhan));
		$("#duit_potongan").html(duit(duit_potongan));
		
		$("#tambahan_prestasi").html(duit(tambahan_prestasi));
		$("#tambahan_inovasi_kreativitas").html(duit(tambahan_inovasi_kreativitas));
		$("#tambahan_kemampuan_managerial").html(duit(tambahan_kemampuan_managerial));
		$("#tambahan_kemampuan_interpersonal").html(duit(tambahan_kemampuan_interpersonal));
		$("#duit_tambahan").html(duit(duit_tambahan));
		
		$("#t_disiplin").html(duit(duit_disiplin));
		$("#t_potongan").html(duit(duit_potongan));
		$("#t_tambahan").html(duit(duit_tambahan));
		$("#total").html(duit(total));
		$("#terbilang").html(ucwords(toTerbilang(total)));
		
	}
	
	$("#huruf_kehadiran").change(hitungTPB);
	$("#huruf_kepatuhan").change(hitungTPB);
	$("#huruf_prestasi").change(hitungTPB);
	$("#huruf_inovasi").change(hitungTPB);
	$("#huruf_managerial").change(hitungTPB);
	$("#huruf_interpersonal").change(hitungTPB);

	
	$(document).ready(function() {
		hitungTPB();
	});
	
	function duit(x) {
		return number_format(x,0,',','.');
	}
	
	function pengaliDisiplin(x) {
		if(x=="STB")
			return 100;
		else
		if(x=="KB")
			return 75;
		else
		if(x=="C")
			return 50;
		else
		if(x=="B")
			return 25;
		else 
			return 0;
	}
	
	function pengaliKinerja(x) {
		if(x=="SB")
			return 100;
		else
		if(x=="B")
			return 75;
		else
		if(x=="C")
			return 50;
		else
		if(x=="KB")
			return 25;
		else 
			return 0;
	}	
	
</script>

<?php
}
?>
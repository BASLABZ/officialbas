<?php 
$db = $this->db;
$util = $this->util;
$image = $this->cnf->ROOTDIR."img/image003.png";

if(!empty($_POST['bulan'])) {
	$res = $db->query("SELECT hari, jam, nama_kepala, nip_kepala, nama_bendahara, nip_bendahara, nama_petugas, nip_petugas  FROM setting WHERE skpd = '".$db->esc($this->data['id'])."' AND bulan = '".$db->esc($_POST['bulan'])."' AND tahun = '".$db->esc($_POST['tahun'])."'");
	list($hari, $jam, $nama_kepala, $nip_kepala, $nama_bendahara, $nip_bendahara, $nama_petugas, $nip_petugas) = $db->fetchArray($res);
	$tidak_hadir = 0;
	$terlambat_datang = 0;
	$cepat_pulang = 0;
	$res = $db->query("SELECT * FROM presensi_rekap WHERE tahun='".$db->esc($_POST['tahun'])."' and bulan = '".$db->esc($_POST['bulan'])."' and nip = '".$db->esc($_POST['nip'])."'");
	$data = $db->fetchArray($res);
	for ($i=1; $i <= 31 ; $i++) { 
		$status = ''.$i.'_status';
		$masuk = ''.$i.'_masuk';
		$pulang = ''.$i.'_pulang';
		if ($data[$status] == 'TH') {
			$tidak_hadir++;
		}
		if ($data[$status] == 'TL' || $data[$status] == 'TP') {
			$batasm = strtotime('08:30:00');
			$mlebu = strtotime($data[$masuk]);
			$jamm = ($mlebu - $batasm)/3600;
			$terlambat_datang = $terlambat_datang + $jamm;
		}
		if ($data[$status] == 'PL' || $data[$status] == 'TP') {
			$batasp = strtotime('14:30:00');
			$bali = strtotime($data[$pulang]);
			$jamp = ($batasp - $bali)/3600;
			
			$cepat_pulang = $cepat_pulang+$jamp;
		}
	}
	$terlambat_datang = round($terlambat_datang);
	$cepat_pulang = round($cepat_pulang);

	$res = $db->query("SELECT * FROM setting05 LIMIT 0,1");
	list($persen_disiplin, $persen_kehadiran, $persen_kepatuhan, $persen_kinerja, $persen_prestasi, $persen_inovasi_kreativitas, $persen_kemampuan_teknis, $persen_kemampuan_interpersonal) = $db->fetchArray($res);	

	if(!empty($_POST['nip'])) {
		$nip = $_POST['nip'];
		$res = $db->query("SELECT nama, golongan, pangkat, gol1, gol2, jabatan, unit, subunit, id, skpd.skpd, status,namaa,nipa,tpb FROM pegawai LEFT JOIN skpd on id = pegawai.skpd WHERE nip = '".$db->esc($_POST['nip'])."'");
		list($nama, $golongan, $pangkat, $gol1, $gol2, $jabatan, $unit, $subunit, $skpd, $nama_skpd, $status, $namaa,$nipa,$tpb) = $db->fetchArray($res);
					
		$res = $db->query("SELECT pajak FROM pajak WHERE golongan = '".$db->esc($golongan)."'");
		list($pajak) = $db->fetchArray($res);
		
		$res = $db->query("SELECT hari, jam, total_tpb, tidak_hadir, terlambat_datang, cepat_pulang, kepatuhan, potongan, ps_a, ps_b, ps_c, ps_d, ps_e, ik_a, ik_b, ik_c, kt, ki_a, ki_b, tambahan, tgl, bln, thn, nama1, nip1, nama2, nip2, persen_disiplin, persen_kehadiran, persen_kepatuhan, persen_kinerja, persen_prestasi, persen_inovasi_kreativitas, persen_kemampuan_teknis, persen_kemampuan_interpersonal, pajak  FROM form05 WHERE nip = '".$db->esc($_POST['nip'])."' AND bulan = '".$db->esc($_POST['bulan'])."' AND tahun = '".$db->esc($_POST['tahun'])."'");
		if($db->numRows($res) > 0) {
			list($hari, $jam, $total_tpb, $tidak_hadir, $terlambat_datang,  $cepat_pulang, $kepatuhan, $potongan, $ps_a, $ps_b,  $ps_c, $ps_d, $ps_e, $ik_a, $ik_b, $ik_c, $kt, $ki_a,  $ki_b, $tambahan, $tgl, $bln, $thn, $nama1, $nip1, $nama2, $nip2, $_POST['persen_disiplin'], $_POST['persen_kehadiran'], $_POST['persen_kepatuhan'], $_POST['persen_kinerja'], $_POST['persen_prestasi'], $_POST['persen_inovasi_kreativitas'], $_POST['persen_kemampuan_teknis'], $_POST['persen_kemampuan_interpersonal'], $_POST['pajak']) = $db->fetchArray($res);
			
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
				if($persen_disiplin != $_POST['persen_disiplin'] || $persen_kehadiran != $_POST['persen_kehadiran'] || $persen_kepatuhan != $_POST['persen_kepatuhan'] || $persen_kinerja != $_POST['persen_kinerja'] | $persen_prestasi != $_POST['persen_prestasi'] || $persen_inovasi_kreativitas != $_POST['persen_inovasi_kreativitas'] || $persen_kemampuan_teknis != $_POST['persen_kemampuan_teknis'] || $persen_kemampuan_interpersonal != $_POST['persen_kemampuan_interpersonal'] || $pajak != $_POST['pajak']) {
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
			$_POST['persen_kemampuan_teknis'] = $persen_kemampuan_teknis;
			$_POST['persen_kemampuan_interpersonal']= $persen_kemampuan_interpersonal;
			$_POST['pajak'] = $pajak;
		}
			
		if(!isset($_POST['aksi'])) {
			$_POST['aksi'] = "Preview";
			$_POST['hari'] = $hari;
			$_POST['jam'] = $jam;
			$_POST['total_tpb'] = @$total_tpb;
			$_POST['tidak_hadir'] = @$tidak_hadir;
			$_POST['terlambat_datang'] = @$terlambat_datang;
			$_POST['cepat_pulang'] = @$cepat_pulang;
			$_POST['kepatuhan'] = @$kepatuhan;
			$_POST['potongan'] = @$potongan;
			$_POST['ps_a'] = @$ps_a;
			$_POST['ps_b'] = @$ps_b;
			$_POST['ps_c'] = @$ps_c;
			$_POST['ps_d'] = @$ps_d;
			$_POST['ps_e'] = @$ps_e;
			$_POST['ik_a'] = @$ik_a;
			$_POST['ik_b'] = @$ik_b;
			$_POST['ik_c'] = @$ik_c;
			$_POST['kt'] = @$kt;
			$_POST['ki_a'] = @$ki_a;
			$_POST['ki_b'] = @$ki_b;
			$_POST['tambahan'] = @$tambahan;
			$_POST['tgl'] = @$tgl;
			$_POST['bln'] = @$bln;
			$_POST['thn'] = @$thn;
			$_POST['nama1'] = @$nama1;
			$_POST['nip1'] = @$nip1;
			$_POST['nama2'] = @$nama2;
			$_POST['nip2'] = @$nip2;
		}
			
		$res = $db->query("SELECT tgl, bln, thn, nama1, nip1, nama2, nip2 FROM form05 WHERE bulan = '".$db->esc($_POST['bulan'])."' AND tahun = '".$db->esc($_POST['tahun'])."' AND skpd = '".$db->esc($skpd)."' GROUP BY tgl, bln, thn, nama1, nip1, nama2, nip2");
		while(list($_tgl, $_bln, $_thn, $_nama1, $_nip1, $_nama2, $_nip2) = $db->fetchArray($res)) {
			$tgl = $_tgl;
			$bln = $_bln;
			$thn = $_thn;
			$nama1 = $_nama1;
			$nip1 = $_nip1;
			$nama2 = $_nama1;
			$nip2 = $_nip2;
		}
			
		if(empty($_POST['tgl'])) $_POST['tgl']  = $tgl;
				
		if(empty($_POST['bln'])) $_POST['bln']  = $bln;
			
		if(empty($_POST['thn'])) $_POST['thn']  = $thn;
			
		if(empty($_POST['nama1'])) $_POST['nama1']  = $nama1;
				
		if(empty($_POST['nip1'])) $_POST['nip1']  = $nip1;
				
		if(empty($_POST['nama2'])) $_POST['nama2']  = $nama2;
				
		if(empty($_POST['nip2'])) $_POST['nip2']  = $nip2;
			
		$lanjut = true;		
	} else
		$lanjut = false;
	
	if($lanjut) {
		if($_POST['aksi'] == "Simpan") {
			$total_tpb = $tpb;
			$hari = $_POST['hari'];
			$jam = $_POST['jam'];
		}
		
		$total_tpb = str_replace(",",".",str_replace(".","",$tpb));
		
		$duit_disiplin = $total_tpb*$_POST['persen_disiplin']/100;
		$duit_kehadiran = $duit_disiplin*$_POST['persen_kehadiran']/100;
	
		$tidak_hadir = $_POST['tidak_hadir'];
		$maksimal_th = round($hari/2,0);
		$maksimal_td = $jam*$hari/2;
		$maksimal_cp = $jam*$hari/2;
		if($hari == 0) {
			$potongan_tidak_hadir = 0;
			$potongan_terlambat_datang = 0;
			$potongan_cepat_pulang = 0;
		}
		else {
			//$potongan_tidak_hadir = round(($_POST['tidak_hadir']<=$maksimal_th?$_POST['tidak_hadir']*($duit_kehadiran*0.5/$hari):$duit_kehadiran*0.5),-2);
			//$potongan_terlambat_datang = round(($_POST['terlambat_datang']<=$maksimal_td?$_POST['terlambat_datang']*(0.25*$duit_kehadiran)/($hari*$jam):$duit_kehadiran*0.25),-2);
			//$potongan_cepat_pulang = round(($_POST['cepat_pulang']<=$maksimal_cp?$_POST['cepat_pulang']*($duit_kehadiran*0.25)/($hari*$jam):$duit_kehadiran*0.25),-2);
			
			$potongan_tidak_hadir = ($_POST['tidak_hadir']<=$maksimal_th?$_POST['tidak_hadir']*($duit_kehadiran*0.5/$hari):$duit_kehadiran*0.5);
			$potongan_terlambat_datang = ($_POST['terlambat_datang']<=$maksimal_td?$_POST['terlambat_datang']*(0.25*$duit_kehadiran)/($hari*$jam):$duit_kehadiran*0.25);
			$potongan_cepat_pulang = ($_POST['cepat_pulang']<=$maksimal_cp?$_POST['cepat_pulang']*($duit_kehadiran*0.25)/($hari*$jam):$duit_kehadiran*0.25);

			}
		
		$potongan_kehadiran = ($_POST['tidak_hadir'] > $hari/2 ?$duit_kehadiran:$potongan_tidak_hadir+$potongan_terlambat_datang+$potongan_cepat_pulang);
		
		//$potongan_kehadiran = round($potongan_kehadiran,-2);
		
		if($_POST['tidak_hadir'] > $hari/2)
			$pesan = "PNS Tidak Hadir Lebih dari ".$maksimal_th." Hari";
		
		$duit_kepatuhan = $duit_disiplin*$_POST['persen_kepatuhan']/100;
		
		if($_POST['tidak_hadir'] > $hari/2 || $_POST['kepatuhan'] == "TP")
			$potongan_kepatuhan = $duit_kepatuhan;
		else
		if($_POST['kepatuhan'] == "KP")
			$potongan_kepatuhan = $duit_kepatuhan * 50/100;
		else
			$potongan_kepatuhan = 0;
			
		//$potongan_kepatuhan = round($potongan_kepatuhan,-2);
		
		//$potongan = round($potongan_kehadiran + $potongan_kepatuhan,-2);
		$potongan = $potongan_kehadiran + $potongan_kepatuhan;
		
		//$duit_kinerja = round($total_tpb*$_POST['persen_kinerja']/100,-2);
		$duit_kinerja = $total_tpb*$_POST['persen_kinerja']/100;
		
		$duit_prestasi = $duit_kinerja*$_POST['persen_prestasi']/100;
		$poin_ps = $_POST['ps_a'] + $_POST['ps_b'] + $_POST['ps_c'] + $_POST['ps_d'] + $_POST['ps_e'];
		
		if($poin_ps >= 17) {
			$keterangan_ps = "Baik";
			$tambahan_ps = $duit_prestasi;
		} else
		if($poin_ps >= 9) {
			$keterangan_ps = "Cukup";
			$tambahan_ps = $duit_prestasi*60/100;
		} else
		if($poin_ps >= 1) {
			$keterangan_ps = "Kurang";
			$tambahan_ps = $duit_prestasi*25/100;
		}
		
		//$tambahan_ps = round($tambahan_ps,-2);
		$duit_inovasi_kreativitas = $duit_kinerja*$_POST['persen_inovasi_kreativitas']/100;
		$poin_ik = $_POST['ik_a'] + $_POST['ik_b'] + $_POST['ik_c'];
		
		if($poin_ik >= 13) {
			$keterangan_ik = "Baik";
			$tambahan_ik = $duit_inovasi_kreativitas;
		} else
		if($poin_ik >= 7) {
			$keterangan_ik = "Cukup";
			$tambahan_ik = $duit_inovasi_kreativitas*60/100;
		} else
		if($poin_ik >= 1) {
			$keterangan_ik = "Kurang";
			$tambahan_ik = $duit_inovasi_kreativitas*25/100;
		}
		
		//$tambahan_ik = round($tambahan_ik,-2);
		$duit_kemampuan_teknis = $duit_kinerja*$_POST['persen_kemampuan_teknis']/100;
		$poin_kt = $_POST['kt'];
		
		if($poin_kt >= 5) {
			$keterangan_kt = "Baik";
			$tambahan_kt = $duit_kemampuan_teknis;
		} else
		if($poin_kt >= 3) {
			$keterangan_kt = "Cukup";
			$tambahan_kt = $duit_kemampuan_teknis*60/100;
		} else
		if($poin_kt >= 1) {
			$keterangan_kt = "Kurang";
			$tambahan_kt = $duit_kemampuan_teknis*25/100;
		}
		
		//$tambahan_kt = round($tambahan_kt,-2);
		$duit_kemampuan_interpersonal = $duit_kinerja*$_POST['persen_kemampuan_interpersonal']/100;
		$poin_ki = $_POST['ki_a'] + $_POST['ki_b'];
		
		if($poin_ki >= 8) {
			$keterangan_ki = "Baik";
			$tambahan_ki = $duit_kemampuan_interpersonal;
		} else
		if($poin_ki >= 4) {
			$keterangan_ki = "Cukup";
			$tambahan_ki = $duit_kemampuan_interpersonal*60/100;
		} else
		if($poin_ki >= 1) {
			$keterangan_ki = "Kurang";
			$tambahan_ki = $duit_kemampuan_interpersonal*25/100;
		}
		
		//$tambahan_ki = round($tambahan_ki,-2);
		@$tambahan = $tambahan_ps + $tambahan_ik + $tambahan_kt + $tambahan_ki;
		
		$total = $duit_disiplin - $potongan + $tambahan;
		if($_POST['aksi'] == "Simpan" || $_POST['aksi'] == "Cetak") {
			$db->query("DELETE FROM form04 WHERE nip = '".$db->esc($_POST['nip'])."' AND bulan = '".$db->esc($_POST['bulan'])."' AND tahun = '".$db->esc($_POST['tahun'])."'");
		    $res = $db->query("REPLACE INTO form05 (bulan, tahun, nip, golongan,pangkat, gol1, gol2, jabatan, subunit, status, skpd, hari, jam, total_tpb, ".
			           "tidak_hadir, terlambat_datang, cepat_pulang, kepatuhan, potongan, ps_a, ps_b, ps_c, ps_d, ps_e, ik_a, ik_b, ik_c, kt, ki_a, ki_b, ".
					   "tambahan, tgl, bln, thn, nama1, nip1, nama2, nip2, persen_disiplin, persen_kehadiran, persen_kepatuhan, persen_kinerja, ".
					   "persen_prestasi, persen_inovasi_kreativitas, persen_kemampuan_teknis, persen_kemampuan_interpersonal, pajak) VALUES ".
					   "('".$db->esc($_POST['bulan'])."', '".$db->esc($_POST['tahun'])."', '".$db->esc($_POST['nip'])."', '".$db->esc($golongan)."','".$db->esc($pangkat)."', '".$db->esc($gol1)."', '".$db->esc($gol2)."', ".
					   "'".$db->esc($jabatan)."', '".$db->esc($subunit)."', '".$db->esc($status)."', '".$db->esc($this->data['id'])."', '".$db->esc($_POST['hari'])."', '".$db->esc($_POST['jam'])."', '".$db->esc($total_tpb)."', ".
					   "'".$db->esc($_POST['tidak_hadir'])."', '".$db->esc($_POST['terlambat_datang'])."', '".$db->esc($_POST['cepat_pulang'])."', '".$db->esc($_POST['kepatuhan'])."', '".$db->esc($potongan)."', ".
					   "'".$db->esc($_POST['ps_a'])."', '".$db->esc($_POST['ps_b'])."', '".$db->esc($_POST['ps_c'])."', '".$db->esc($_POST['ps_d'])."', '".$db->esc($_POST['ps_e'])."', '".$db->esc($_POST['ik_a'])."', ".
					   "'".$db->esc($_POST['ik_b'])."', '".$db->esc($_POST['ik_c'])."', '".$db->esc($_POST['kt'])."', '".$db->esc($_POST['ki_a'])."', '".$db->esc($_POST['ki_b'])."', '".$db->esc($tambahan)."', ".
					   "'".$db->esc($_POST['tgl'])."', '".$db->esc($_POST['bln'])."', '".$db->esc($_POST['thn'])."', '".$db->esc($namaa)."', '".$db->esc($nipa)."', '".$db->esc($_POST['nama2'])."', '".$db->esc($_POST['nip2'])."', ".
					   "'".$db->esc($_POST['persen_disiplin'])."', '".$db->esc($_POST['persen_kehadiran'])."', '".$db->esc($_POST['persen_kepatuhan'])."', '".$db->esc($_POST['persen_kinerja'])."', ".
					   "'".$db->esc($_POST['persen_prestasi'])."', '".$db->esc($_POST['persen_inovasi_kreativitas'])."', '".$db->esc($_POST['persen_kemampuan_teknis'])."', ".
					   "'".$db->esc($_POST['persen_kemampuan_interpersonal'])."', '".$db->esc($_POST['pajak'])."')");
			
			if ($res) { 
				echo "<form id='back' method='post' action='?pg=datatpb&mode=tpb05&kodeskpd=".$this->data['id']."'>";
				echo "<input type='hidden' name='bulan' value='".$_POST['bulan']."'>";
				echo "<input type='hidden' name='tahun' value='".$_POST['tahun']."'>";
				if ($_POST['aksi'] == "Cetak") echo "<input type='hidden' name='cetaknip' value='".$_POST['nip']."'>"; 
				echo "</form><script>document.getElementById('back').submit();</script>";
			}
		}
		$lanjut = true;			
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
		<td><strong>FORMULIR TPB 05</strong></td>
	</tr>
	<tr>
		<td align="center"><strong>PEMERINTAH PROVINSI PAPUA<br>DAFTAR PERHITUNGAN TAMBAHAN PENGHASILAN BERSYARAT (TPB) <br>
	    UNTUK JABATAN STRUKTURAL DAN JABATAN FUNGSIONAL <br>
	   </strong></td>
	</tr>
	<tr>
		<td align="center"><strong>IDENTITAS PEGAWAI</strong></td>
	</tr>
	<tr>
		<td>
			<table border="0" width="100%">
				<tr>
				<tr>
					<td width="20%">NIP / Nama</td>
					<td>:</td>				
					<td width="100%"><?php echo $util->formatNIP($nip)." / ".$nama; ?></td>
					<td rowspan="5"><img src="<?php echo $image; ?>"></td>
				</tr>
				<tr>
					<td nowrap>Pangkat/Golongan</td>
					<td>:</td>
					<td><?php echo $golongan; ?></td>
				</tr>
				<tr>
					<td nowrap>Jabatan Struktural</td>
					<td>:</td>
					<td><?php echo $jabatan; ?></td>
				</tr>
				<tr>
					<td nowrap>Unit Kerja/SKPD</td>
					<td>:</td>
					<td><?php echo $unit."/".$nama_skpd; ?></td>
				</tr>
				<tr>
				  <td nowrap>Subunit Kerja </td>
				  <td>:</td>
				  <td><?php echo $subunit; ?></td>
				  <td>&nbsp;</td>
			  </tr>
				<?php
					if(@$lanjut2) {
				?>
				<?php
			  		}
				?>
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
                <td>: <?php echo $_POST['hari']; ?><strong>
                  <input type="hidden" id="hari" value="<?php echo $_POST['hari']; ?>">
                </strong> Hari</td>
              </tr>
              <tr>
                <td>Total Maksimal TPB</td>
                <td>: <?php echo $util->duit_rp($tpb);?></td>
                <td>&nbsp;</td>
                <td>Jumlah Jam Kerja/Hari</td>
                <td>: <?php echo $_POST['jam']; ?> <strong>
                  <input type="hidden" id="jam" value="<?php echo $_POST['jam']; ?>">
                </strong>Jam</td>
              </tr>
            </table>
			<hr>
			<strong>PERHITUNGAN TAMBAHAN PENGHASILAN BERSYARAT (TPB) PEGAWAI</strong></td>
	</tr>
	<tr>
	  <td>
	  	<table border="0" cellpadding="5" cellspacing="0" width="100%">
			<tr style="background-color:#CCCCCC ">
				<td><strong>A. DISIPLIN</strong></td>
				<td>&nbsp;</td>
				<td><strong><?php echo $_POST['persen_disiplin']; ?> %</strong></td>
				<td><strong>Dari Total TPB Sebesar :</strong></td>
				<td><strong><input type="text" id="duit_disiplin" value="<?php echo $util->duit($duit_disiplin); ?>" readonly="1" style="background-color:#CCC; border-style:none; direction:rtl  ">
				</strong></td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td>1. Kehadiran</td>
				<td>&nbsp;</td>
				<td><?php echo $_POST['persen_kehadiran']; ?> %</td>
				<td>Dari Alokasi TPB Disiplin Sebesar : </td>
				<td><input type="text" id="duit_kehadiran" value="<?php echo $util->duit($duit_kehadiran); ?>" readonly="1" style=" border-style:none; direction:rtl  "></strong></td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
			  <td colspan="6" align="center">
			  	<table align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>
							<table cellpadding="5" cellspacing="0" border="0" style="border-width:1px; border-style:solid">
								<tr>
									<td><strong>Keterangan</strong></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td><strong>Potongan :</strong></td>
								    <td colspan="3" align="center"><strong>Maksimal</strong></td>
							    </tr>
								<tr>
									<td>a. Tidak Hadir (TH)</td>
									<td><input type="text" id="tidak_hadir" name="tidak_hadir" size="2" maxlength="2" value="<?php echo $_POST['tidak_hadir']; ?>" onChange="proses_th()"></td>
									<td>Hari</td>
									<td align="right"><input type="text" id="potongan_tidak_hadir" value="<?php echo $util->duit($potongan_tidak_hadir); ?>" readonly="1" style=" border-style:none; direction:rtl  "><strong>
									</strong></td>
								    <td align="right">Jika TH &gt; dari </td>
								    <td align="right"><strong><?php echo $maksimal_th; ?><input type="hidden" id="max_th" value="<?php echo $maksimal_th; ?>"></strong></td>
								    <td>Hari, maka Alokasi Disiplin Hilang</td>
								</tr>
								<tr>
									<td>b. Terlambat Datang (TD)</td>
									<td><input type="text" id="terlambat_datang"  name="terlambat_datang" size="2" maxlength="2" value="<?php echo $_POST['terlambat_datang']; ?>" onChange="proses_td()"></td>
									<td>Jam</td>
									<td align="right"><input type="text" id="potongan_terlambat_datang" value="<?php echo $util->duit($potongan_terlambat_datang); ?>" readonly="1" style=" border-style:none;direction:rtl  ">
									  <strong>
									</strong></td>
								    <td align="right">Jika TD &gt; dari </td>
								    <td align="right"><strong><?php echo $maksimal_td; ?>
								      <input type="hidden" id="max_td" value="<?php echo $maksimal_td; ?>">
								    </strong></td>
								    <td>Jam, maka Alokasi TD Hilang </td>
								</tr>
								<tr>
									<td>c. Cepat Pulang (CP)</td>
									<td><input type="text" id="cepat_pulang" name="cepat_pulang" size="2" maxlength="2" value="<?php echo $_POST['cepat_pulang']; ?>" onChange="proses_cp()"></td>
									<td>Jam</td>
									<td align="right"><input type="text" id="potongan_cepat_pulang" value="<?php echo $util->duit($potongan_cepat_pulang); ?>" readonly="1" style=" border-style:none;direction:rtl  ">
									  <strong>
									</strong></td>
								    <td align="right">Jika CP &gt; dari </td>
								    <td align="right"><strong><?php echo $maksimal_cp; ?>
								      <input type="hidden" id="max_cp" value="<?php echo $maksimal_cp; ?>">
								    </strong></td>
								    <td>Jam, maka Alokasi CP Hilang </td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			  </td>
		    </tr>
			<tr>
				<td colspan="3" align="right"><strong>Subtotal Potongan Kehadiran : </strong></td>
				<td><input type="text" id="potongan_kehadiran" value="<?php echo $util->duit($potongan_kehadiran); ?>" readonly="1" style=" border-style:none;direction:rtl  "></td>
				<td>&nbsp;</td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
			  <td colspan="3" align="right">&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
		    </tr>
			<tr>
				<td>2. Kepatuhan</td>
				<td>&nbsp;</td>
				<td><?php echo $_POST['persen_kepatuhan']; ?> %</td>
				<td>Dari Alokasi TPB Disiplin Sebesar : </td>
				<td><input type="text" id="duit_kepatuhan" value="<?php echo $util->duit($duit_kepatuhan); ?>" readonly="1" style=" border-style:none; direction:rtl  "></td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
			  <td colspan="6"><table cellspacing="0" border="1" cellpadding="5" style="border-width:0px 0px 0px 0px">
                <tr>
                  <td style="border-width:0px 0px 0px 0px"><strong>Keterangan</strong></td>
                  <td style="border-width:0px 0px 0px 0px"><strong>Nilai</strong></td>
                  <td style="border-width:0px 0px 0px 0px">&nbsp;</td>
                  <td style="border-width:0px 0px 0px 0px" nowrap><strong>Potongan : </strong></td>
                  <td style="border-width:0px 0px 0px 0px">&nbsp;</td>
                  <td style="border-width:0px 0px 0px 0px">&nbsp;</td>
                </tr>
                <tr>
                  <td style="border-width:1px 0px 0px 1px">a. Patuh (P) </td>
                  <td rowspan="3" style="border-width:1px 0px 1px 1px; border-style:solid"><select name="kepatuhan" id="kepatuhan" onChange="proses_kepatuhan()">
				  	<option></option>
                    <option value="P" <?php if($_POST['kepatuhan'] == "P") echo "selected"; ?>>Patuh</option>
                    <option value="KP" <?php if($_POST['kepatuhan'] == "KP") echo "selected"; ?>>Kurang Patuh </option>
                    <option value="TP" <?php if($_POST['kepatuhan'] == "TP") echo "selected"; ?>>Tidak Patuh </option>
                  </select></td>
                  <td rowspan="3" style="border-width:1px 0px 1px 1px; border-style:solid">&nbsp;</td>
                  <td rowspan="3" style="border-width:1px 0px 1px 0px; border-style:solid">
                    <input type="text" id="potongan_kepatuhan" value="<?php echo $util->duit($potongan_kepatuhan); ?>" readonly="1" style=" border-style:none; direction:rtl  "></td>
                  <td rowspan="3" style="border-width:1px 1px 1px 0px; border-style:solid; ">&nbsp;</td>
                  <td rowspan="3" style="border-width:0px 0px 0px 0px; " align="center" width="100%"><span id="pesan"></span></td>
                </tr>
                <tr>
                  <td style="border-width:0px 0px 0px 1px" nowrap>b. Kurang Patuh (KP) </td>
                  </tr>
                <tr>
                  <td style="border-width:0px 0px 1px 1px; border-style:solid">c. Tidak Patuh (TP) </td>
                  </tr>
              </table></td>
		    </tr>
			<tr>
				<td colspan="3" align="right"><strong>Subtotal Potongan Kepatuhan : </strong></td>
				<td><input type="text" id="potongan_kepatuhan2" value="<?php echo $util->duit($potongan_kepatuhan); ?>" readonly="1" style=" border-style:none; direction:rtl "></td>
				<td>&nbsp;</td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="5" align="right"><strong>Total Potongan Kedisiplinan Pegawai (D) : </strong></td>
				<td align="right"><input type="text" id="potongan" value="<?php echo $util->duit($potongan); ?>" readonly="1" style=" border-style:none;direction:rtl  "></td>
			</tr>
			<tr>
				<td colspan="6">&nbsp;</td>
			</tr>
			<tr style="background-color:#CCCCCC ">
				<td><strong>B. KINERJA</strong></td>
				<td>&nbsp;</td>
				<td><strong><?php echo $_POST['persen_kinerja']; ?> %</strong></td>
				<td><strong>Dari Total TPB Sebesar :</strong></td>
				<td><strong><input type="text" id="duit_kinerja" value="<?php echo $util->duit($duit_kinerja); ?>" readonly="1" style="background-color:#CCC; border-style:none; direction:rtl  ">
				</strong></td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td>1. Prestasi (PS)</td>
				<td>&nbsp;</td>
				<td><?php echo $_POST['persen_prestasi']; ?> %</td>
				<td>Dari Alokasi TPB Kinerja Sebesar : </td>
				<td><input type="text" id="duit_prestasi" value="<?php echo $util->duit($duit_prestasi); ?>" readonly="1" style=" border-style:none; direction:rtl  "></td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
			  <td colspan="6">
			  	<table border="1" cellpadding="5" cellspacing="0" style="border-width:0px 0px 1px 0px ">
					<tr>
						<td style="border-width:0px 0px 0px 0px " width="320px"><strong>Keterangan</strong></td>
						<td style="border-width:0px 0px 0px 0px " align="center"><strong>Poin</strong></td>
						<td style="border-width:0px 0px 0px 0px " align="center"><strong>Total Poin</strong></td>
						<td style="border-width:0px 0px 0px 0px " align="center" width="100px"><strong>Ket.</strong></td>
						<td style="border-width:0px 0px 0px 0px " align="center" width="80px"><strong>Tambahan</strong></td>
					</tr>
					<tr>
						<td style="border-width:1px 0px 0px 1px ">a. Tugas Selesai Tepat Waktu</td>
						<td style="border-width:1px 0px 0px 1px " ><?php $util->select_poin("ps_a"); ?></td>
						<td rowspan="5" style="border-width:1px 0px 0px 1px " align="center">
					    <input type="text" id="poin_ps" size="2" value="<?php echo $poin_ps; ?>" readonly="1" style=" border-style:none; direction:rtl  "></td>
						<td rowspan="5" style="border-width:1px 0px 0px 1px " align="center">
					    <input type="text" id="keterangan_ps" value="<?php echo $keterangan_ps; ?>" readonly="1" style=" border-style:none;"></td>
						<td rowspan="5" style="border-width:1px 1px 0px 1px;border-style:solid " align="right">
					    <input type="text" id="tambahan_ps" value="<?php echo $util->duit($tambahan_ps); ?>" readonly="1" style=" border-style:none; direction:rtl  "></td>
					</tr>
					<tr>
						<td style="border-width:1px 0px 0px 1px ">b. Produk Bermanfaat Bagi Pihak Internal dan Eksternal</td>
						<td style="border-width:1px 0px 0px 1px "><?php $util->select_poin("ps_b"); ?></td>
					</tr>
					<tr>
						<td style="border-width:1px 0px 0px 1px ">c. Kuantitas Produk Sesuai Rencana Kerja/Standar</td>
						<td style="border-width:1px 0px 0px 1px "><?php $util->select_poin("ps_c"); ?></td>
					</tr>
					<tr>
						<td style="border-width:1px 0px 0px 1px ">d. Kualitas Produk Sesuai Rencana Kerja/Standar</td>
						<td style="border-width:1px 0px 0px 1px "><?php $util->select_poin("ps_d"); ?></td>
					</tr>
					<tr>
						<td style="border-width:1px 0px 0px 1px ">e. Tugas Sesuai dengan Petunjuk/Instruksi/Pedoman</td>
						<td style="border-width:1px 0px 0px 1px "><?php $util->select_poin("ps_e"); ?></td>
					</tr>
				</table>
			  </td>
		    </tr>
			<tr>
				<td colspan="6">&nbsp;</td>
			</tr>
			<tr>
				<td>2. Inovasi dan Kreativitas (IK) </td>
				<td>&nbsp;</td>
				<td><?php echo $_POST['persen_inovasi_kreativitas']; ?> %</td>
				<td>Dari Alokasi TPB kinerja Sebesar : </td>
				<td><input type="text" id="duit_inovasi_kreativitas" value="<?php echo $util->duit($duit_inovasi_kreativitas); ?>" readonly="1" style=" border-style:none; direction:rtl  "></td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
			  <td colspan="6"><table border="1" cellpadding="5" cellspacing="0" style="border-width:0px 0px 1px 0px ">
                <tr>
                  <td style="border-width:0px 0px 0px 0px " width="320px"><strong>Keterangan</strong></td>
                  <td style="border-width:0px 0px 0px 0px " align="center"><strong>Poin</strong></td>
                  <td style="border-width:0px 0px 0px 0px " align="center"><strong>Total Poin</strong></td>
                  <td style="border-width:0px 0px 0px 0px " align="center" width="100px"><strong>Ket.</strong></td>
                  <td style="border-width:0px 0px 0px 0px " align="center" width="80px"><strong>Tambahan</strong></td>
                </tr>
                <tr>
                  <td style="border-width:1px 0px 0px 1px ">a. Memiliki Ide/Gagasan Konstruktif</td>
                  <td style="border-width:1px 0px 0px 1px " align="center"><?php $util->select_poin("ik_a"); ?></td>
                  <td rowspan="3" style="border-width:1px 0px 0px 1px " align="center">
                    <input type="text" id="poin_ik" size="2" value="<?php echo $poin_ik; ?>" readonly="1" style=" border-style:none; direction:rtl  "></td>
                  <td rowspan="3" style="border-width:1px 0px 0px 1px " align="center">
                    <input type="text" id="keterangan_ik" value="<?php echo $keterangan_ik; ?>" readonly="1" style=" border-style:none;"></td>
                  <td rowspan="3" style="border-width:1px 1px 0px 1px;border-style:solid " align="right">
                    <input type="text" id="tambahan_ik" value="<?php echo $util->duit($tambahan_ik); ?>" readonly="1" style=" border-style:none; direction:rtl  "></td>
                </tr>
                <tr>
                  <td style="border-width:1px 0px 0px 1px ">b. Terbuka Terhadap Ide/Gagasan Baru </td>
                  <td style="border-width:1px 0px 0px 1px "><span class="style1">
                    <?php $util->select_poin("ik_b"); ?>
                  </span></td>
                </tr>
                <tr>
                  <td style="border-width:1px 0px 0px 1px ">c. Tanggap Terhadap Perubahan</td>
                  <td style="border-width:1px 0px 0px 1px "><?php $util->select_poin("ik_c"); ?></td>
                </tr>
              </table></td>
		    </tr>
			<tr>
				<td colspan="6">&nbsp;</td>
			</tr>
			<tr>
				<td>3. Kemampuan Teknis (KT) </td>
				<td>&nbsp;</td>
				<td><?php echo $_POST['persen_kemampuan_teknis']; ?> %</td>
				<td>Dari Alokasi TPB kinerja Sebesar : </td>
				<td><input type="text" id="duit_kemampuan_teknis" value="<?php echo $util->duit($duit_kemampuan_teknis); ?>" readonly="1" style=" border-style:none; direction:rtl  "></td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
			  <td colspan="6"><table border="1" cellpadding="5" cellspacing="0" style="border-width:0px 0px 1px 0px ">
                <tr>
                  <td style="border-width:0px 0px 0px 0px " width="320"><strong>Keterangan</strong></td>
                  <td style="border-width:0px 0px 0px 0px " align="center"><strong>Poin</strong></td>
                  <td style="border-width:0px 0px 0px 0px " align="center"><strong>Total Poin</strong></td>
                  <td style="border-width:0px 0px 0px 0px " width="100" align="center"><strong>Ket.</strong></td>
                  <td style="border-width:0px 0px 0px 0px " width="80" align="center"><strong>Tambahan</strong></td>
                </tr>
                <tr>
                  <td style="border-width:1px 0px 0px 1px ">Tingkat Kemahiran Mengoperasikan Alat Kerja</td>
                  <td style="border-width:1px 0px 0px 1px "><?php $util->select_poin("kt"); ?></td>
                  <td style="border-width:1px 0px 0px 1px " align="center">
                    <input type="text" id="poin_kt" size="2" value="<?php echo $poin_kt; ?>" readonly="1" style=" border-style:none; direction:rtl  "></td>
                  <td style="border-width:1px 0px 0px 1px " align="center">
                    <input type="text" id="keterangan_kt" value="<?php echo $keterangan_kt; ?>" readonly="1" style=" border-style:none;"></td>
                  <td style="border-width:1px 1px 0px 1px;border-style:solid " align="right">
                    <input type="text" id="tambahan_kt" value="<?php echo $util->duit($tambahan_kt); ?>" readonly="1" style=" border-style:none; direction:rtl  "></td>
                </tr>
              </table></td>
		    </tr>
			<tr>
				<td colspan="6">&nbsp;</td>
			</tr>
			<tr>
				<td>4. Kemampuan Interpersonal</td>
				<td>&nbsp;</td>
				<td><?php echo $_POST['persen_kemampuan_interpersonal']; ?> %</td>
				<td>Dari Alokasi TPB kinerja Sebesar : </td>
				<td><input type="text" id="duit_kemampuan_interpersonal" value="<?php echo $util->duit($duit_kemampuan_interpersonal); ?>" readonly="1" style=" border-style:none; direction:rtl  "></td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6"><table border="1" cellpadding="5" cellspacing="0" style="border-width:0px 0px 1px 0px ">
                  <tr>
                    <td style="border-width:0px 0px 0px 0px " width="320"><strong>Keterangan</strong></td>
                    <td style="border-width:0px 0px 0px 0px " align="center"><strong>Poin</strong></td>
                    <td style="border-width:0px 0px 0px 0px " align="center"><strong>Total Poin</strong></td>
                    <td style="border-width:0px 0px 0px 0px " width="100" align="center"><strong>Ket.</strong></td>
                    <td style="border-width:0px 0px 0px 0px " width="80" align="center"><strong>Tambahan</strong></td>
                  </tr>
                  <tr>
                    <td style="border-width:1px 0px 0px 1px ">a. Mampu Berkerjasama dalam Kelompok/Tim</td>
                    <td style="border-width:1px 0px 0px 1px "><?php $util->select_poin("ki_a"); ?></td>
                    <td rowspan="2" style="border-width:1px 0px 0px 1px " align="center">
                    <input type="text" id="poin_ki" size="2" value="<?php echo $poin_ki; ?>" readonly="1" style=" border-style:none; direction:rtl  "></td>
                    <td rowspan="2" style="border-width:1px 0px 0px 1px " align="center">
                    <input type="text" id="keterangan_ki" value="<?php echo $keterangan_ki; ?>" readonly="1" style=" border-style:none;"></td>
                    <td rowspan="2" style="border-width:1px 1px 0px 1px;border-style:solid " align="right">
                    <input type="text" id="tambahan_ki" value="<?php echo $util->duit($tambahan_ki); ?>" readonly="1" style=" border-style:none; direction:rtl  "></td>
                  </tr>
                  <tr>
                    <td style="border-width:1px 0px 0px 1px ">b. Mampu Berkomunikasi dengan Baik </td>
                    <td style="border-width:1px 0px 0px 1px "><span class="style1">
                      <?php $util->select_poin("ki_b"); ?>
                    </span></td>
                  </tr>
                </table></td>
			</tr>
			<tr>
				<td colspan="5" align="right">Total Tambahan Kinerja Pegawai (K) :</td>
				<td align="right"><input type="text" id="tambahan" value="<?php echo $util->duit($tambahan); ?>" readonly="1" style=" border-style:none;direction:rtl  "></td>
			</tr>
			<tr>
			  <td colspan="5" align="right">Total TPB (kotor) adalah  (<span id="t_disiplin"></span> - <span id="t_potongan"></span> + <span id="t_tambahan"></span>) :</td>
			  <td align="right"><input type="text" id="total" value="<?php echo $util->duit($total); ?>" readonly="1" style=" border-style:none;direction:rtl  "></td>
		    </tr>
			<tr>
			  <td align="center">TERBILANG : </td>
			  <td colspan="5">
		      <input type="text" id="terbilang" value="<?php echo ucwords($util->terbilang($total));?>" readonly="1" style=" border-style:none; width:100% "></td>
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
					<td align="center"><br><br><br><br><u><strong>
				    <input type="hidden" name="nama2" value="<?php echo $nama_petugas; ?>">
					<?php echo $nama_petugas; ?></strong></u></td>
				</tr>
				<tr>
					<td align="center"><strong>NIP. <?php echo $util->formatNIP($nipa); ?></strong></td>
					<td align="center"><strong>NIP. <input type="hidden" name="nip2" value="<?php echo $nip_petugas; ?>"><?php echo $util->formatNIP($nip_petugas); ?></strong></td>
				</tr>
			</table>
		  <br>
			<table align="center" width="100%" cellpadding="5" cellspacing="0" border="1">
				<tr>
					<th>KONVERSI KODE DAN POIN PENILAIAN TAMBAHAN PENGHASILAN BERSYARAT (TPB) </th>
				</tr>
				<tr>
					<td>a. <strong>Kepatuhan : P = </strong>Tidak Dipotong, <strong>KP = </strong>Dipotong 50%, <strong>TP </strong>Atau <strong>Jumlah TH Melebihi Batas Maksimal Ketidakhadiran = </strong>Dipotong 100%</td>
				</tr>
				<tr>
					<td>b. <strong>PS : </strong>Total Poin (1-8) = <strong>Kurang </strong>(Ditambah 25%), Total Poin (9-16) = <strong>Cukup </strong>(Ditambah 60%), Total Poin (17-25) = <strong>Baik </strong>(Ditambah 100%) </td>
				</tr>
				<tr>
					<td>c. <strong>IK : </strong>Total Poin (1-6) = <strong>Kurang </strong>(Ditambah 25%), Total Poin (7-12) = <strong>Cukup </strong>(Ditambah 60%), Total Poin (13-15) = <strong>Baik </strong>(Ditambah 100) </td>
				</tr>
				<tr>
					<td>d. <strong>KT : </strong>Total Poin (1-1) = <strong>Kurang </strong>(Ditambah 25%), Total Poin (3-4) = <strong>Cukup </strong>(Ditambah 60%), Total Poin (5) = <strong>Baik </strong>(Ditambah 100) </td>
				</tr>
				<tr>
					<td>e. <strong>KI : </strong>Total Poin (1-3) = <strong>Kurang </strong>(Ditambah 25%), Total Poin (4-7) = <strong>Cukup </strong>(Ditambah 60%), Total Poin (8-10) = <strong>Baik </strong>(Ditambah 100) </td>
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
	
	var hari = parseFloat(document.getElementById('hari').value);
	var jam = parseFloat(document.getElementById('jam').value);
	var duit_kehadiran = document.getElementById('duit_kehadiran').value;
	duit_kehadiran = parseFloat(duit_kehadiran.toString().replace(/\$|\./g,''));
	var duit_kepatuhan = document.getElementById('duit_kepatuhan').value;
	duit_kepatuhan = parseFloat(duit_kepatuhan.toString().replace(/\$|\./g,''));
	var max_th = parseFloat(document.getElementById('max_th').value);
	var max_td = parseFloat(document.getElementById('max_td').value);
	var max_cp = parseFloat(document.getElementById('max_cp').value);
	
	function proses_th() {
		tidak_hadir = parseFloat(document.getElementById('tidak_hadir').value);
		
		if(tidak_hadir <= max_th)
			document.getElementById('potongan_tidak_hadir').value = duit(tidak_hadir * ((0.5*duit_kehadiran)/hari));
		else
			document.getElementById('potongan_tidak_hadir').value = duit(0.5 * duit_kehadiran);
		
		proses_kepatuhan();		
	}
	
	function proses_td() {
		terlambat_datang = parseFloat(document.getElementById('terlambat_datang').value);
		
		if(terlambat_datang <= max_td)
			document.getElementById('potongan_terlambat_datang').value = duit(terlambat_datang * ((0.25*duit_kehadiran)/(hari*jam)));
		else
			document.getElementById('potongan_terlambat_datang').value = duit(0.25 * duit_kehadiran);
			
		jumlah_potongan_kehadiran();
		
	}
	
	function proses_cp() {
		cepat_pulang = parseFloat(document.getElementById('cepat_pulang').value);
		
		if(cepat_pulang <= max_cp)
			document.getElementById('potongan_cepat_pulang').value = duit(cepat_pulang * ((0.25*duit_kehadiran)/(hari*jam)));
		else
			document.getElementById('potongan_cepat_pulang').value = duit(0.25 * duit_kehadiran);
			
		jumlah_potongan_kehadiran();
		
	}
	
	function jumlah_potongan_kehadiran() {
		potongan_tidak_hadir = document.getElementById('potongan_tidak_hadir').value;
		potongan_tidak_hadir = parseFloat(potongan_tidak_hadir.toString().replace(/\$|\./g,''));
		
		potongan_terlambat_datang = document.getElementById('potongan_terlambat_datang').value;
		potongan_terlambat_datang = parseFloat(potongan_terlambat_datang.toString().replace(/\$|\./g,''));
		
		potongan_cepat_pulang = document.getElementById('potongan_cepat_pulang').value;
		potongan_cepat_pulang = parseFloat(potongan_cepat_pulang.toString().replace(/\$|\./g,''));
		
		tidak_hadir = parseFloat(document.getElementById('tidak_hadir').value);
		
		if(tidak_hadir <= max_th) {
			document.getElementById('potongan_kehadiran').value = duit(potongan_tidak_hadir + potongan_terlambat_datang + potongan_cepat_pulang);
			document.getElementById('pesan').innerHTML = "";
		}
		else {
		    document.getElementById('kepatuhan').value = "TP";
			document.getElementById('potongan_kehadiran').value = duit(duit_kehadiran);
			document.getElementById('pesan').innerHTML = "PNS Tidak Hadir Lebih dari "+max_th+" Hari";
		}
		
		jumlah_potongan();		
	}
	
	function proses_kepatuhan() {
		kepatuhan = document.getElementById('kepatuhan').value;
		tidak_hadir = parseFloat(document.getElementById('tidak_hadir').value);
		
		if(tidak_hadir <= max_th) {
			if(kepatuhan == "KP")
				document.getElementById('potongan_kepatuhan').value = duit(duit_kepatuhan * 0.5);
			else
			if(kepatuhan == "TP")
				document.getElementById('potongan_kepatuhan').value = duit(duit_kepatuhan);
			else
				document.getElementById('potongan_kepatuhan').value = duit(0);
		} else
			document.getElementById('potongan_kepatuhan').value = duit(duit_kepatuhan);
			
		document.getElementById('potongan_kepatuhan2').value = document.getElementById('potongan_kepatuhan').value;	
		jumlah_potongan_kehadiran();
	}
	
	function jumlah_potongan() {
		potongan_kehadiran = document.getElementById('potongan_kehadiran').value;
		potongan_kehadiran = parseFloat(potongan_kehadiran.toString().replace(/\$|\./g,''));
		
		potongan_kepatuhan = document.getElementById('potongan_kepatuhan').value;
		potongan_kepatuhan = parseFloat(potongan_kepatuhan.toString().replace(/\$|\./g,''));
		
		document.getElementById('potongan').value = duit(potongan_kehadiran + potongan_kepatuhan);
		
		jumlah_total();
	}
	
	function jumlah_total() {
		duit_disiplin = document.getElementById('duit_disiplin').value;
		duit_disiplin = parseFloat(duit_disiplin.toString().replace(/\$|\./g,''));
		
		potongan = document.getElementById('potongan').value;
		potongan = parseFloat(potongan.toString().replace(/\$|\./g,''));
		
		tambahan = document.getElementById('tambahan').value;
		tambahan = parseFloat(tambahan.toString().replace(/\$|\./g,''));
		
		total = duit_disiplin - potongan + tambahan;

		
		document.getElementById('t_disiplin').innerHTML = duit(duit_disiplin);
		document.getElementById('t_potongan').innerHTML = duit(potongan);
		document.getElementById('t_tambahan').innerHTML = duit(tambahan);
		document.getElementById('total').value = duit(total);
		document.getElementById('terbilang').value = ucwords(toTerbilang(total));
		
	}

	var duit_prestasi = document.getElementById('duit_prestasi').value;
	duit_prestasi = parseFloat(duit_prestasi.toString().replace(/\$|\./g,''));
	var duit_inovasi_kreativitas = document.getElementById('duit_inovasi_kreativitas').value;
	duit_inovasi_kreativitas = parseFloat(duit_inovasi_kreativitas.toString().replace(/\$|\./g,''));
	var duit_kemampuan_teknis = document.getElementById('duit_kemampuan_teknis').value;
	duit_kemampuan_teknis = parseFloat(duit_kemampuan_teknis.toString().replace(/\$|\./g,''));
	var duit_kemampuan_interpersonal = document.getElementById('duit_kemampuan_interpersonal').value;
	duit_kemampuan_interpersonal = parseFloat(duit_kemampuan_interpersonal.toString().replace(/\$|\./g,''));
	
	function proses_ps_a() {
		poin = document.getElementById('ps_a').value;
		if(poin == 0) {
			alert('Poin Prestasi Harus diisi');
		}
		proses_ps();			
	}
	
	function proses_ps_b() {
		poin = document.getElementById('ps_b').value;
		if(poin == 0) {
			alert('Poin Prestasi Harus diisi');
		}
		proses_ps();			
	}
	
	function proses_ps_c() {
		poin = document.getElementById('ps_c').value;
		if(poin == 0) {
			alert('Poin Prestasi Harus diisi');
		}
		proses_ps();			
	}
	
	function proses_ps_d() {
		poin = document.getElementById('ps_d').value;
		if(poin == 0) {
			alert('Poin Prestasi Harus diisi');
		}
		proses_ps();		
	}
	
	function proses_ps_e() {
		poin = document.getElementById('ps_e').value;
		if(poin == 0) {
			alert('Poin Prestasi Harus diisi');
		}
		proses_ps();			
	}
	
	function proses_ps() {
		a = parseInt(document.getElementById('ps_a').value);
		b = parseInt(document.getElementById('ps_b').value);
		c = parseInt(document.getElementById('ps_c').value);
		d = parseInt(document.getElementById('ps_d').value);
		e = parseInt(document.getElementById('ps_e').value);
		
		total = a+b+c+d+e;
		document.getElementById('poin_ps').value = total;
		
		if(total >= 17) {
			document.getElementById('keterangan_ps').value = 'Baik';
			document.getElementById('tambahan_ps').value = duit(duit_prestasi);
		} else
		if(total >= 9) {
			document.getElementById('keterangan_ps').value = 'Cukup';
			document.getElementById('tambahan_ps').value = duit(duit_prestasi*60/100);
		} else {
			document.getElementById('keterangan_ps').value = 'Kurang';
			document.getElementById('tambahan_ps').value = duit(duit_prestasi*25/100);
		}
		
		jumlah_tambahan();
	}
	
	
	function proses_ik_a() {
		poin = document.getElementById('ik_a').value;
		if(poin == 0) {
			alert('Poin Inovasi dan Kreativitas Harus diisi');
		} 
		proses_ik();		
	}
	
	function proses_ik_b() {
		poin = document.getElementById('ik_b').value;
		if(poin == 0) {
			alert('Poin Inovasi dan Kreativitas Harus diisi');
		} 
		proses_ik();		
	}
	
	function proses_ik_c() {
		poin = document.getElementById('ik_c').value;
		if(poin == 0) {
			alert('Poin Inovasi dan Kreativitas Harus diisi');
		} 
		proses_ik();
					
	}
	
	function proses_ik() {
		a = parseInt(document.getElementById('ik_a').value);
		b = parseInt(document.getElementById('ik_b').value);
		c = parseInt(document.getElementById('ik_c').value);
		
		total = a+b+c;
		document.getElementById('poin_ik').value = total;
		
		if(total >= 13) {
			document.getElementById('keterangan_ik').value = 'Baik';
			document.getElementById('tambahan_ik').value = duit(duit_inovasi_kreativitas);
		} else
		if(total >= 7) {
			document.getElementById('keterangan_ik').value = 'Cukup';
			document.getElementById('tambahan_ik').value = duit(duit_inovasi_kreativitas*60/100);
		} else {
			document.getElementById('keterangan_ik').value = 'Kurang';
			document.getElementById('tambahan_ik').value = duit(duit_inovasi_kreativitas*25/100);
		}
		
		jumlah_tambahan();
	}
	
	function proses_kt() {
		poin = document.getElementById('kt').value;
		if(poin == 0) {
		    document.getElementById('keterangan_kt').value = '';
			document.getElementById('tambahan_kt').value = 0;
		} else {
			a = parseInt(document.getElementById('kt').value);
		
			total = a;
			document.getElementById('poin_kt').value = total;
			
			if(total >= 5) {
				document.getElementById('keterangan_kt').value = 'Baik';
				document.getElementById('tambahan_kt').value = duit(duit_kemampuan_teknis);
			} else
			if(total >= 3) {
				document.getElementById('keterangan_kt').value = 'Cukup';
				document.getElementById('tambahan_kt').value = duit(duit_kemampuan_teknis*60/100);
			} else {
				document.getElementById('keterangan_kt').value = 'Kurang';
				document.getElementById('tambahan_kt').value = duit(duit_kemampuan_teknis*25/100);
			}
			
			jumlah_tambahan();
		}			
	}
	
	function proses_ki_a() {
		poin = document.getElementById('ki_a').value;
		if(poin == 0) {
			alert('Poin Kemampuan Interpersonal Harus diisi');
		} 
		proses_ki();			
	}
	
	function proses_ki_b() {
		poin = document.getElementById('ki_b').value;
		if(poin == 0) {
			alert('Poin Kemampuan Interpersonal Harus diisi');
		} 
		proses_ki();			
	}
	
	function proses_ki() {
		a = parseInt(document.getElementById('ki_a').value);
		b = parseInt(document.getElementById('ki_b').value);
		
		total = a+b;
		document.getElementById('poin_ki').value = total;
		
		if(total >= 8) {
			document.getElementById('keterangan_ki').value = 'Baik';
			document.getElementById('tambahan_ki').value = duit(duit_kemampuan_interpersonal);
		} else
		if(total >= 4) {
			document.getElementById('keterangan_ki').value = 'Cukup';
			document.getElementById('tambahan_ki').value = duit(duit_kemampuan_interpersonal*60/100);
		} else {
			document.getElementById('keterangan_ki').value = 'Kurang';
			document.getElementById('tambahan_ki').value = duit(duit_kemampuan_interpersonal*25/100);
		}
		
		jumlah_tambahan();
	}
	
	function jumlah_tambahan() {
		tambahan_ps = document.getElementById('tambahan_ps').value;
		tambahan_ps = parseFloat(tambahan_ps.toString().replace(/\$|\./g,''));
		
		tambahan_ik = document.getElementById('tambahan_ik').value;
		tambahan_ik = parseFloat(tambahan_ik.toString().replace(/\$|\./g,''));
		
		tambahan_kt = document.getElementById('tambahan_kt').value;
		tambahan_kt = parseFloat(tambahan_kt.toString().replace(/\$|\./g,''));
		
		tambahan_ki = document.getElementById('tambahan_ki').value;
		tambahan_ki = parseFloat(tambahan_ki.toString().replace(/\$|\./g,''));
		
		document.getElementById('tambahan').value = duit(tambahan_ps + tambahan_ik + tambahan_kt + tambahan_ki);
		
		jumlah_total();
	}
	
	function cek() {
		a = document.getElementById('kepatuhan').value;
		
		if(a == 0) {
			alert('Poin Kepatuhan harus terisi');
			return false;
		} else {
			a = document.getElementById('ps_a').value;
			b = document.getElementById('ps_b').value;
			c = document.getElementById('ps_c').value;
			d = document.getElementById('ps_d').value;
			e = document.getElementById('ps_e').value;
			
			if(a == 0 || b == 0 || c == 0 || d == 0 || e == 0) {
				alert('Poin Prestasi Harus terisi semua');
				return false;
			} else {
				a = document.getElementById('ik_a').value;
				b = document.getElementById('ik_b').value;
				c = document.getElementById('ik_c').value;
				
				if(a == 0 || b == 0 || c == 0) {
					alert('Poin Inovasi dan Kreativitas harus terisi semua');
					return false;
				} else {
					a = document.getElementById('kt').value;
					
					if(a == 0) {
						alert('Poin Kemampuan Teknis harus terisi');
						return false;
					} else {
						a = document.getElementById('ki_a').value;
						b = document.getElementById('ki_b').value;
						
						if(a == 0 || b == 0) {
							alert('Poin Kemampuan Interpersonal harus terisi semua');
							return false;
						} else if(confirm('Simpan data?')){
							return true;
						} else {
							return false;
						}
					}
				}
			}
		}		
	}
	
	function duit(x) {
		//x = Math.round(x/100)*100;
		return number_format(x,0,',','.');
	}
	
	$(document).ready(function() {
		proses_th();
		proses_td();
		proses_cp();
		proses_kepatuhan()
		proses_ps();
		proses_ik();
		proses_kt();
		proses_ki();		
		jumlah_total();
	});
</script>
<?php
}
?>
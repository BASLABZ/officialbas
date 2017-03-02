<?php 	
$db = $this->db;
$util = $this->util;
$image = $this->cnf->ROOTDIR."img/image003.png";

$_POST['skpd'] = $this->data['id'];

if(!empty($_POST['bulan'])) {
	if(!empty($_POST['nip'])) {
		$res = $db->query("SELECT p.nama, p.golongan, p.pangkat, p.gol1, p.gol2, p.jabatan, p.skpd, s.skpd, p.unit, p.subunit, p.tpb FROM pegawai p LEFT JOIN skpd s on s.id = p.skpd WHERE p.skpd = '".$this->data['id']."' AND p.nip = '".$_POST['nip']."'");
		list($nama,$golongan, $pangkat, $gol1, $gol2, $jabatan, $skpd, $nama_skpd,$unit, $subunit, $tpb) = $db->fetchArray($res);
					
		$res = $db->query("SELECT hari, jam, total_tpb, tidak_hadir, terlambat_datang, cepat_pulang, kepatuhan, potongan, ps_a, ps_b, ps_c, ps_d, ps_e, ik_a, ik_b, ik_c, kt, ki_a, ki_b, tambahan, tgl, bln, thn, nama1, nip1, nama2, nip2, persen_disiplin, persen_kehadiran, persen_kepatuhan, persen_kinerja, persen_prestasi, persen_inovasi_kreativitas, persen_kemampuan_teknis, persen_kemampuan_interpersonal, pajak FROM form05 WHERE nip = '".$_POST['nip']."' AND bulan = '".$_POST['bulan']."' AND tahun = '".$_POST['tahun']."'");
		list($hari, $jam, $total_tpb, $tidak_hadir, $terlambat_datang,  $cepat_pulang, $kepatuhan, $potongan, $ps_a, $ps_b,  $ps_c, $ps_d,  $ps_e, $ik_a,  $ik_b,  $ik_c, $kt, $ki_a,  $ki_b, $tambahan, $tgl, $bln, $thn, $nama1, $nip1, $nama2, $nip2, $_POST['persen_disiplin'], $_POST['persen_kehadiran'], $_POST['persen_kepatuhan'], $_POST['persen_kinerja'], $_POST['persen_prestasi'], $_POST['persen_inovasi_kreativitas'], $_POST['persen_kemampuan_teknis'], $_POST['persen_kemampuan_interpersonal'], $_POST['pajak']) = $db->fetchArray($res);
		
		$_POST['hari'] = $hari;
		$_POST['jam'] = $jam;
		$_POST['total_tpb'] = $total_tpb;
		$_POST['tidak_hadir'] = $tidak_hadir;
		$_POST['terlambat_datang'] = $terlambat_datang;
		$_POST['cepat_pulang'] = $cepat_pulang;
		$_POST['kepatuhan'] = $kepatuhan;
		$_POST['potongan'] = $potongan;
		$_POST['ps_a'] = $ps_a;
		$_POST['ps_b'] = $ps_b;
		$_POST['ps_c'] = $ps_c;
		$_POST['ps_d'] = $ps_d;
		$_POST['ps_e'] = $ps_e;
		$_POST['ik_a'] = $ik_a;
		$_POST['ik_b'] = $ik_b;
		$_POST['ik_c'] = $ik_c;
		$_POST['kt'] = $kt;
		$_POST['ki_a'] = $ki_a;
		$_POST['ki_b'] = $ki_b;
		$_POST['tambahan'] = $tambahan;
		$_POST['tgl'] = $tgl;
		$_POST['bln'] = $bln;
		$_POST['thn'] = $thn;
		$_POST['nama1'] = $nama1;
		$_POST['nip1'] = $nip1;
		$_POST['nama2'] = $nama2;
		$_POST['nip2'] = $nip2;		
		
		
		if($db->numRows($res) > 0) $lanjut=true;	
	} else
		$lanjut = false;
} else
	$lanjut = false;

if($lanjut) {
	
		
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
		
	//$duit_kepatuhan = round($duit_disiplin*$_POST['persen_kepatuhan']/100,-2);
	
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
	
	$tambahan = $tambahan_ps + $tambahan_ik + $tambahan_kt + $tambahan_ki;
	
	$total = $duit_disiplin - $potongan + $tambahan;
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Form TPB 05 - <?php echo $nama; ?></title>
<style>
body{font:65% "Arial",arial,sans-serif;color: #333;text-align:center;padding: 10px}
</style>
</head>
<body>
<center>
<table border="1" cellpadding="2" cellspacing="0">
	<tr>
		<td><strong>FORMULIR TPB 05</strong></td>
	</tr>
	<tr>
		<td align="center"><strong>PEMERINTAH PROVINSI PAPUA<br>DAFTAR PERHITUNGAN TAMBAHAN PENGHASILAN BERSYARAT (TPB) <br>
	    UNTUK JABATAN STRUKTURAL DAN JABATAN FUNGSIONAL <br></strong></td>
	</tr>
	<tr>
		<td align="center">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td nowrap width="25%">Bulan/Tahun Penilaian </td>
					<td>&nbsp;&nbsp;: <?php echo $util->longMonth[$_POST['bulan']*1]. "/".$_POST['tahun']; ?></td>
					<td>&nbsp;</td>
					<td nowrap width="25%">Jumlah Hari Kerja/Bulan</td>
					<td>&nbsp;&nbsp;: <?php echo $hari; ?> Hari</td>
				</tr>
				<tr>
					<td>Total Maksimal TPB</td>
					<td>&nbsp;&nbsp;: Rp. <?php echo $util->duit($total_tpb);?></td>
					<td>&nbsp;</td>
					<td>Jumlah Jam Kerja/Hari</td>
					<td>&nbsp;&nbsp;: <?php echo $jam; ?> Jam</td>
				</tr>
			</table>
		</td>
    </tr>
	<tr>
		<td align="center" style="background-color:#CCCCCC "><strong>IDENTITAS PEGAWAI</strong></td>
	</tr>
	<tr>
		<td>
			<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="20%">Nama</td>
					<td>:</td>
					<td width="100%"><?php echo $nama; ?></td>
					<td rowspan="6"><img src="<?php echo $image; ?>"></td>
				</tr>
				<tr>
					<td>NIP</td>
					<td>:</td>
					<td><?php echo $util->formatNIP($_POST['nip']); ?></td>
				</tr>
				<tr>
					<td>Pangkat/Golongan</td>
					<td>:</td>
					<td><?php echo $golongan?></td>
				</tr>
				<tr>
					<td>Jabatan Struktural</td>
					<td>:</td>
					<td><?php echo $jabatan; ?></td>
				</tr>
				<tr>
					<td>Unit Kerja/SKPD</td>
					<td>:</td>
					<td><?php echo $unit."/ ".$nama_skpd; ?></td>
				</tr>
				<tr>
					<td>Subunit Kerja </td>
					<td>:</td>
					<td><?php echo $subunit; ?></td>
			  </tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center" style="background-color:#CCCCCC ">
		<strong>PERHITUNGAN TAMBAHAN PENGHASILAN BERSYARAT (TPB) PEGAWAI</strong></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr style="background-color:#CCCCCC ">
					<td><strong>A. DISIPLIN</strong></td>
					<td>&nbsp;</td>
					<td><strong><?php echo $_POST['persen_disiplin']; ?> %</strong></td>
					<td><strong>Dari Total TPB Sebesar :</strong></td>
					<td><strong><?php echo $util->duit($duit_disiplin); ?></strong></td>
					<td>&nbsp;</td>
				</tr>
				<tr bgcolor="#DDDDDD">
					<td>1. Kehadiran</td>
					<td>&nbsp;</td>
					<td><?php echo $_POST['persen_kehadiran']; ?> %</td>
					<td>Dari Alokasi TPB Disiplin Sebesar : </td>
					<td><?php echo $util->duit($duit_kehadiran); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
				<td colspan="6" align="center">
					<table align="center" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td>
								<table cellpadding="0" cellspacing="0" border="0" style="border-width:0px 0px 0px 0px;">
									<tr>
										<td style="border-width:0px 0px 0px 0px "><strong>Keterangan</strong></td>
										<td style="border-width:0px 0px 0px 0px ">&nbsp;</td>
										<td style="border-width:0px 0px 0px 0px ">&nbsp;</td>
										<td style="border-width:0px 0px 0px 0px "><strong>&nbsp;Potongan :</strong></td>
										<td colspan="3" align="center" style="border-width:0px 0px 0px 0px "><strong>Maksimal</strong></td>
									</tr>
									<tr>
										<td style="border-width:1px 0px 0px 1px; border-style:solid ">&nbsp;a. Tidak Hadir (TH)</td>
										<td align="right" style="border-width:1px 0px 0px 0px; border-style:solid "><?php echo $_POST['tidak_hadir']; ?></td>
										<td style="border-width:1px 0px 0px 0px; border-style:solid">&nbsp;Hari</td>
										<td align="right" style="border-width:1px 1px 0px 0px; border-style:solid "><?php echo $util->duit($potongan_tidak_hadir); ?>&nbsp;</td>
										<td align="right" style="border-width:0px 0px 0px 0px; ">&nbsp;Jika TH &gt; dari </td>
										<td align="right" style="border-width:0px 0px 0px 0px">&nbsp;&nbsp;<strong><?php echo $maksimal_th; ?></strong></td>
										<td style="border-width:0px 0px 0px 0px; border-style:solid">&nbsp;Hari, maka Alokasi Disiplin Hilang</td>
									</tr>
									<tr>
										<td style="border-width:0px 0px 0px 1px; border-style:solid">&nbsp;b. Terlambat Datang (TD)&nbsp;</td>
										<td align="right" style="border-width:0px 1px 0px 0px; border-style:solid"><?php echo $_POST['terlambat_datang']; ?></td>
										<td style="border-width:0px 0px 0px 0px; border-style:solid">&nbsp;Jam</td>
										<td align="right" style="border-width:0px 1px 0px 0px; border-style:solid"><?php echo $util->duit($potongan_terlambat_datang); ?>&nbsp;</td>
										<td align="right" style="border-width:0px 0px 0px 0px">&nbsp;Jika TD &gt; dari </td>
										<td align="right" style="border-width:0px 0px 0px 0px">&nbsp;&nbsp;<strong><?php echo $maksimal_td; ?></strong></td>
										<td style="border-width:0px 0px 0px 0px; border-style:solid">&nbsp;Jam, maka Alokasi TD Hilang </td>
									</tr>
									<tr>
										<td style="border-width:0px 0px 1px 1px; border-style:solid">&nbsp;c. Cepat Pulang (CP)</td>
										<td align="right" style="border-width:0px 0px 1px 0px; border-style:solid"><?php echo $_POST['cepat_pulang']; ?></td>
										<td style="border-width:0px 0px 1px 0px; border-style:solid">&nbsp;Jam</td>
										<td align="right" style="border-width:0px 1px 1px 0px; border-style:solid"><?php echo $util->duit($potongan_cepat_pulang); ?>&nbsp;</td>
										<td align="right" style="border-width:0px 0px 0px 0px; border-style:solid">&nbsp;Jika CP &gt; dari </td>
										<td align="right" style="border-width:0px 0px 0px 0px; border-style:solid">&nbsp;&nbsp;<strong><?php echo $maksimal_cp; ?></strong></td>
										<td style="border-width:0px 0px 0px 0px; border-style:solid">&nbsp;Jam, maka Alokasi CP Hilang </td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
				</tr>
				<tr>
					<td colspan="4" align="right">
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td><strong>Subtotal Potongan Kehadiran : &nbsp;</strong></td>
								<td style="border-width:1px 1px 1px 1px; border-style:solid " width="60px" align="right"><?php echo $util->duit($potongan_kehadiran); ?>&nbsp;</td>
							</tr>
						</table>
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr bgcolor="#DDDDDD">
					<td>2. Kepatuhan</td>
					<td>&nbsp;</td>
					<td><?php echo $_POST['persen_kepatuhan']; ?> %</td>
					<td>Dari Alokasi TPB Disiplin Sebesar : </td>
					<td><?php echo $util->duit($duit_kepatuhan); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td colspan="6" align="center">
						<table cellspacing="0" border="1" cellpadding="0" style="border-width:0px 0px 0px 0px">
							<tr>
								<td style="border-width:0px 0px 0px 0px"><strong>Keterangan</strong></td>
								<td style="border-width:0px 0px 0px 0px">&nbsp;<strong>Nilai</strong>&nbsp;</td>
								<td style="border-width:0px 0px 0px 0px">&nbsp;</td>
								<td style="border-width:0px 0px 0px 0px"><strong>Potongan : </strong></td>
								<td style="border-width:0px 0px 0px 0px">&nbsp;</td>
								<td style="border-width:0px 0px 0px 0px">&nbsp;</td>
							</tr>
							<tr>
								<td style="border-width:1px 0px 0px 1px">&nbsp;a. Patuh (P) </td>
								<td rowspan="3" style="border-width:1px 0px 1px 1px; border-style:solid" align="center"><?php echo $_POST['kepatuhan']; ?></td>
								<td rowspan="3" style="border-width:1px 0px 1px 1px; border-style:solid">&nbsp;</td>
								<td rowspan="3" style="border-width:1px 0px 1px 0px; border-style:solid" align="right"><?php echo $util->duit($potongan_kepatuhan); ?></td>
								<td rowspan="3" style="border-width:1px 1px 1px 0px; border-style:solid; border-style:solid; ">&nbsp;</td>
								<td rowspan="3" style="border-width:0px 0px 0px 0px; border-style:none;" align="center" >&nbsp;&nbsp;&nbsp;<strong><?php echo $pesan; ?></strong></td>
							</tr>
							<tr>
								<td style="border-width:0px 0px 0px 1px">&nbsp;b. Kurang Patuh (KP) &nbsp;</td>
							</tr>
							<tr>
								<td style="border-width:0px 0px 1px 1px; border-style:solid">&nbsp;c. Tidak Patuh (TP) </td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="4" align="right">
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td><strong>Subtotal Potongan Kepatuhan : &nbsp;</strong></td>
								<td width="60px" style="border-width:1px 1px 1px 1px; border-style:solid " align="right"><?php echo $util->duit($potongan_kepatuhan); ?>&nbsp;</td>
							</tr>
						</table>
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td colspan="5" align="right"><strong>Total Potongan Kedisiplinan Pegawai (D) : </strong></td>
					<td align="right"><?php echo $util->duit($potongan); ?></td>
				</tr>
				<tr>
					<td colspan="6">&nbsp;</td>
				</tr>
				<tr style="background-color:#CCCCCC ">
					<td><strong>B. KINERJA</strong></td>
					<td>&nbsp;</td>
					<td><strong><?php echo $_POST['persen_kinerja']; ?> %</strong></td>
					<td><strong>Dari Total TPB Sebesar :</strong></td>
					<td><strong><?php echo $util->duit($duit_kinerja); ?></strong></td>
					<td>&nbsp;</td>
				</tr>
				<tr bgcolor="#DDDDDD">
					<td>1. Prestasi (PS)</td>
					<td>&nbsp;</td>
					<td><?php echo $_POST['persen_prestasi']; ?> %</td>
					<td>Dari Alokasi TPB Kinerja Sebesar : </td>
					<td><?php echo $util->duit($duit_prestasi); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
				<td colspan="6" align="center">
					<table border="1" cellpadding="0" cellspacing="0" style="border-width:0px 0px 1px 0px ">
						<tr>
							<td style="border-width:0px 0px 0px 0px " width="320px"><strong>Keterangan</strong></td>
							<td style="border-width:0px 0px 0px 0px " align="center"><strong>&nbsp;&nbsp;Poin&nbsp;&nbsp;</strong></td>
							<td style="border-width:0px 0px 0px 0px " align="center"><strong>&nbsp;&nbsp;Total Poin&nbsp;&nbsp;</strong></td>
							<td style="border-width:0px 0px 0px 0px " align="center" width="100px"><strong>Ket.</strong></td>
							<td style="border-width:0px 0px 0px 0px " align="center" width="80px"><strong>Tambahan</strong></td>
						</tr>
						<tr>
							<td style="border-width:1px 0px 0px 1px ">&nbsp;a. Tugas Selesai Tepat Waktu</td>
							<td style="border-width:1px 0px 0px 1px " align="center"><?php echo $_POST['ps_a']; ?></td>
							<td rowspan="5" style="border-width:1px 0px 0px 1px " align="center"><?php echo $poin_ps; ?></td>
							<td rowspan="5" style="border-width:1px 0px 0px 1px " align="center"><?php echo $keterangan_ps; ?></td>
							<td rowspan="5" style="border-width:1px 1px 0px 1px;border-style:solid " align="right"><?php echo $util->duit($tambahan_ps); ?>&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td style="border-width:1px 0px 0px 1px ">&nbsp;b. Produk Bermanfaat Bagi Pihak Internal dan Eksternal</td>
							<td style="border-width:1px 0px 0px 1px " align="center"><?php echo $_POST['ps_b']; ?></td>
						</tr>
						<tr>
							<td style="border-width:1px 0px 0px 1px ">&nbsp;c. Kuantitas Produk Sesuai Rencana Kerja/Standar</td>
							<td style="border-width:1px 0px 0px 1px " align="center"><?php echo $_POST['ps_c']; ?></td>
						</tr>
						<tr>
							<td style="border-width:1px 0px 0px 1px ">&nbsp;d. Kualitas Produk Sesuai Rencana Kerja/Standar</td>
							<td style="border-width:1px 0px 0px 1px " align="center"><?php echo $_POST['ps_d']; ?></td>
						</tr>
						<tr>
							<td style="border-width:1px 0px 0px 1px ">&nbsp;e. Tugas Sesuai dengan Petunjuk/Instruksi/Pedoman</td>
							<td style="border-width:1px 0px 0px 1px " align="center"><?php echo $_POST['ps_e']; ?></td>
						</tr>
					</table>
				</td>
				</tr>
				<tr>
					<td colspan="6">&nbsp;</td>
				</tr>
				<tr bgcolor="#CCCCCC">
					<td>2. Inovasi dan Kreativitas (IK) </td>
					<td>&nbsp;</td>
					<td><?php echo $_POST['persen_inovasi_kreativitas']; ?> %</td>
					<td>Dari Alokasi TPB kinerja Sebesar : </td>
					<td><?php echo $util->duit($duit_inovasi_kreativitas); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td colspan="6" align="center">
						<table border="1" cellpadding="0" cellspacing="0" style="border-width:0px 0px 1px 0px ">
							<tr>
								<td style="border-width:0px 0px 0px 0px " width="320px"><strong>Keterangan</strong></td>
								<td style="border-width:0px 0px 0px 0px " align="center"><strong>&nbsp;&nbsp;Poin&nbsp;&nbsp;</strong></td>
								<td style="border-width:0px 0px 0px 0px " align="center"><strong>&nbsp;&nbsp;Total Poin&nbsp;&nbsp;</strong></td>
								<td style="border-width:0px 0px 0px 0px " align="center" width="100px"><strong>Ket.</strong></td>
								<td style="border-width:0px 0px 0px 0px " align="center" width="80px"><strong>Tambahan</strong></td>
							</tr>
							<tr>
								<td style="border-width:1px 0px 0px 1px ">&nbsp;a. Memiliki Ide/Gagasan Konstruktif</td>
								<td style="border-width:1px 0px 0px 1px " align="center"><?php echo $_POST['ik_a']; ?></td>
								<td rowspan="3" style="border-width:1px 0px 0px 1px " align="center"><?php echo $poin_ik; ?></td>
								<td rowspan="3" style="border-width:1px 0px 0px 1px " align="center"><?php echo $keterangan_ik; ?></td>
								<td rowspan="3" style="border-width:1px 1px 0px 1px;border-style:solid " align="right"><?php echo $util->duit($tambahan_ik); ?>&nbsp;&nbsp;</td>
							</tr>
							<tr>
								<td style="border-width:1px 0px 0px 1px ">&nbsp;b. Terbuka Terhadap Ide/Gagasan Baru </td>
								<td style="border-width:1px 0px 0px 1px " align="center"><?php echo $_POST['ik_b']; ?></td>
							</tr>
							<tr>
								<td style="border-width:1px 0px 0px 1px ">&nbsp;c. Tanggap Terhadap Perubahan</td>
								<td style="border-width:1px 0px 0px 1px " align="center"><?php echo $_POST['ik_c']; ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="6">&nbsp;</td>
				</tr>
				<tr bgcolor="#CCCCCC">
					<td>3. Kemampuan Teknis (KT) </td>
					<td>&nbsp;</td>
					<td><?php echo $_POST['persen_kemampuan_teknis']; ?> %</td>
					<td>Dari Alokasi TPB kinerja Sebesar : </td>
					<td><?php echo $util->duit($duit_kemampuan_teknis); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td colspan="6" align="center">
						<table border="1" cellpadding="0" cellspacing="0" style="border-width:0px 0px 1px 0px ">
							<tr>
								<td style="border-width:0px 0px 0px 0px " width="320"><strong>Keterangan</strong></td>
								<td style="border-width:0px 0px 0px 0px " align="center"><strong>&nbsp;&nbsp;Poin&nbsp;&nbsp;</strong></td>
								<td style="border-width:0px 0px 0px 0px " align="center"><strong>&nbsp;&nbsp;Total Poin&nbsp;&nbsp;</strong></td>
								<td style="border-width:0px 0px 0px 0px " width="100" align="center"><strong>Ket.</strong></td>
								<td style="border-width:0px 0px 0px 0px " width="80" align="center"><strong>Tambahan</strong></td>
							</tr>
							<tr>
								<td style="border-width:1px 0px 0px 1px ">&nbsp;Tingkat Kemahiran Mengoperasikan Alat Kerja</td>
								<td style="border-width:1px 0px 0px 1px " align="center"><?php echo $_POST['kt']; ?></td>
								<td style="border-width:1px 0px 0px 1px " align="center"><?php echo $poin_kt; ?></td>
								<td style="border-width:1px 0px 0px 1px " align="center"><?php echo $keterangan_kt; ?></td>
								<td style="border-width:1px 1px 0px 1px;border-style:solid " align="right"><?php echo $util->duit($tambahan_kt); ?>&nbsp;&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="6">&nbsp;</td>
				</tr>
				<tr bgcolor="#CCCCCC">
					<td>4. Kemampuan Interpersonal (KI) </td>
					<td>&nbsp;</td>
					<td><?php echo $_POST['persen_kemampuan_interpersonal']; ?> %</td>
					<td>Dari Alokasi TPB kinerja Sebesar : </td>
					<td><?php echo $util->duit($duit_kemampuan_interpersonal); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td colspan="6" align="center">
						<table border="1" cellpadding="0" cellspacing="0" style="border-width:0px 0px 1px 0px ">
							<tr>
								<td style="border-width:0px 0px 0px 0px " width="320"><strong>Keterangan</strong></td>
								<td style="border-width:0px 0px 0px 0px " align="center"><strong>&nbsp;&nbsp;Poin&nbsp;&nbsp;</strong></td>
								<td style="border-width:0px 0px 0px 0px " align="center"><strong>&nbsp;&nbsp;Total Poin&nbsp;&nbsp;</strong></td>
								<td style="border-width:0px 0px 0px 0px " width="100" align="center"><strong>Ket.</strong></td>
								<td style="border-width:0px 0px 0px 0px " width="80" align="center"><strong>Tambahan</strong></td>
							</tr>
							<tr>
								<td style="border-width:1px 0px 0px 1px ">&nbsp;a. Mampu Berkerjasama dalam Kelompok/Tim</td>
								<td style="border-width:1px 0px 0px 1px " align="center"><?php echo $_POST['ki_a']; ?></td>
								<td rowspan="2" style="border-width:1px 0px 0px 1px " align="center"><?php echo $poin_ki; ?></td>
								<td rowspan="2" style="border-width:1px 0px 0px 1px " align="center"><?php echo $keterangan_ki; ?></td>
								<td rowspan="2" style="border-width:1px 1px 0px 1px;border-style:solid " align="right"><?php echo $util->duit($tambahan_ki); ?>&nbsp;&nbsp;</td>
							</tr>
							<tr>
								<td style="border-width:1px 0px 0px 1px ">&nbsp;b. Mampu Berkomunikasi dengan Baik </td>
								<td style="border-width:1px 0px 0px 1px " align="center"><?php echo $_POST['ki_b']; ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="5" align="right">Total Tambahan Kinerja Pegawai (K) :</td>
					<td align="right"><?php echo $util->duit($tambahan); ?></td>
				</tr>
				<tr>
					<td colspan="5" align="right">Total TPB (kotor) adalah (<?php echo $util->duit($duit_disiplin)." - ".$util->duit($potongan)." + ".$util->duit($tambahan); ?>) :</td>
					<td align="right" bgcolor="#CCCCCC"><strong><?php echo $util->duit_rp($total); ?></strong></td>
				</tr>
				<tr>
					<td align="right">TERBILANG : </td>
					<td colspan="5"><?php echo ucwords($util->terbilang($total));?></td>
				</tr>
			</table>
		</td>
    </tr>
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="2">Demikian daftar perhitungan Tambahan Penghasilan Bersyarat (TPB) ini dibuat dengan sebenarnya.<br><br></td>
				</tr>
				<tr>
					<td align="center"><strong>Mengetahui,</strong></td>
					<td align="center">Jayapura, <?php echo $_POST['tgl']." ".$util->longMonth[$_POST['bln']]." ".$_POST['thn']; ?></td>
				</tr>
				<tr>
					<td align="center">Atasan Langsung/Penilai</td>
					<td align="center">Petugas Input Data,</td>
				</tr>
				<tr>
					<td align="center"><br>
						<br>
						<br>
						<br>
						<strong>
						<table align="center" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td align="center"><u><?php echo $_POST['nama1']; ?></u></td>
							</tr>
							<tr>
								<td align="center">NIP. <?php echo $util->formatNIP($_POST['nip1']); ?></td>
							</tr>
						</table>
					</strong> </td>
					<td align="center"><br>
						<br>
						<br>
						<br>
						<strong>
						<table align="center" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td align="center"><u><?php echo $_POST['nama2']; ?></u></td>
							</tr>
							<tr>
								<td align="center">NIP. <?php echo $util->formatNIP($_POST['nip2']); ?></td>
							</tr>
						</table>
					</strong> </td>
				</tr>
            </table>
			<br>
			<table align="center" width="100%" cellpadding="0" cellspacing="0" border="1" style="border-width:0px 0px 0px 0px; border-style:solid ">
				<tr>
					<th style="border-width:1px 1px 0px 1px; border-style:solid ">KONVERSI KODE DAN POIN PENILAIAN TAMBAHAN PENGHASILAN BERSYARAT (TPB) </th>
				</tr>
				<tr>
					<td style="border-width:1px 1px 0px 1px; border-style:solid ">&nbsp;a. <strong>Kepatuhan : P = </strong>Tidak Dipotong, <strong>KP = </strong>Dipotong 50%, <strong>TP </strong>Atau <strong>Jumlah TH Melebihi Batas Maksimal Ketidakhadiran = </strong>Dipotong 100%&nbsp;</td>
				</tr>
				<tr>
					<td style="border-width:1px 1px 0px 1px; border-style:solid ">&nbsp;b. <strong>PS : </strong>Total Poin (1-8) = <strong>Kurang </strong>(Ditambah 25%), Total Poin (9-16) = <strong>Cukup </strong>(Ditambah 60%), Total Poin (17-25) = <strong>Baik </strong>(Ditambah 100%) </td>
				</tr>
				<tr>
					<td style="border-width:1px 1px 0px 1px; border-style:solid ">&nbsp;c. <strong>IK : </strong>Total Poin (1-6) = <strong>Kurang </strong>(Ditambah 25%), Total Poin (7-12) = <strong>Cukup </strong>(Ditambah 60%), Total Poin (13-15) = <strong>Baik </strong>(Ditambah 100) </td>
				</tr>
				<tr>
					<td style="border-width:1px 1px 0px 1px; border-style:solid ">&nbsp;d. <strong>KT : </strong>Total Poin (1-1) = <strong>Kurang </strong>(Ditambah 25%), Total Poin (3-4) = <strong>Cukup </strong>(Ditambah 60%), Total Poin (5) = <strong>Baik </strong>(Ditambah 100) </td>
				</tr>
				<tr>
					<td style="border-width:1px 1px 1px 1px; border-style:solid ">&nbsp;e. <strong>KI : </strong>Total Poin (1-3) = <strong>Kurang </strong>(Ditambah 25%), Total Poin (4-7) = <strong>Cukup </strong>(Ditambah 60%), Total Poin (8-10) = <strong>Baik </strong>(Ditambah 100) </td>
				</tr>
			</table>
		</td>
	</tr>
<?php	
}
?>
</table>
</center>
</body>
</html>
<script>
	window.print();
</script>

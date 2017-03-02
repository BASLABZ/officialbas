<?php
$db = $this->db;
$util = $this->util;
$image = $this->cnf->ROOTDIR."img/image003.png";

$_POST['skpd'] = $this->data['id'];

if(!empty($_POST['bulan'])) {	
	if(!empty($_POST['nip'])) {
		$res = $db->query("SELECT p.nama, p.golongan, p.pangkat, p.gol1, p.gol2, p.jabatan, p.subunit, s.skpd FROM pegawai p LEFT JOIN skpd s on s.id = p.skpd WHERE p.skpd = '".$this->data['id']."' AND p.nip = '".$_POST['nip']."'");
		list($nama, $golongan, $pangkat, $gol1, $gol2, $jabatan,$subunit, $nama_skpd) = $db->fetchArray($res);
		
		$res = $db->query("SELECT hari, jam, total_tpb, kehadiran, kepatuhan, potongan, prestasi, inovasi, managerial, interpersonal, tambahan, tgl, bln, thn, nama1, nip1, nama2, nip2, persen_disiplin, persen_kehadiran, persen_kepatuhan, persen_kinerja, persen_prestasi, persen_inovasi_kreativitas, persen_kemampuan_managerial, persen_kemampuan_interpersonal, pajak FROM form04 WHERE nip = '".$_POST['nip']."' AND bulan = '".$_POST['bulan']."' AND tahun = '".$_POST['tahun']."'");
		list($hari, $jam, $total_tpb, $_POST['huruf_kehadiran'], $_POST['huruf_kepatuhan'], $potongan, $_POST['huruf_prestasi'], $_POST['huruf_inovasi'], $_POST['huruf_managerial'], $_POST['huruf_interpersonal'], $tambahan, $_POST['tgl'], $_POST['bln'], $_POST['thn'], $_POST['nama1'], $_POST['nip1'], $_POST['nama2'], $_POST['nip2'], $_POST['persen_disiplin'], $_POST['persen_kehadiran'], $_POST['persen_kepatuhan'], $_POST['persen_kinerja'], $_POST['persen_prestasi'], $_POST['persen_inovasi_kreativitas'], $_POST['persen_kemampuan_managerial'], $_POST['persen_kemampuan_interpersonal'], $_POST['pajak']) = $db->fetchArray($res);
		
		if($db->numRows($res) > 0) $lanjut=true;	
	} else
		$lanjut = false;
} else
	$lanjut = false;


if($lanjut) {
	$duit_disiplin = round($total_tpb*$_POST['persen_disiplin']/100,-2);
	$duit_kehadiran = round($duit_disiplin*$_POST['persen_kehadiran']/100,-2);
	$duit_kepatuhan = round($duit_disiplin*$_POST['persen_kepatuhan']/100,-2);
	
	$potongan_kehadiran = round($this->pengaliDisiplin04($_POST['huruf_kehadiran'])/100*$duit_kehadiran,-2);
	$potongan_kepatuhan = round($this->pengaliDisiplin04($_POST['huruf_kepatuhan'])/100*$duit_kepatuhan,2);
	$potongan = round($potongan_kehadiran + $potongan_kepatuhan,-2);
	
	$duit_kinerja = $total_tpb*$_POST['persen_kinerja']/100;
	$duit_prestasi = $duit_kinerja*$_POST['persen_prestasi']/100;
	$duit_inovasi_kreativitas = $duit_kinerja*$_POST['persen_inovasi_kreativitas']/100;
	$duit_managerial = $duit_kinerja*$_POST['persen_kemampuan_managerial']/100;
	$duit_interpersonal = $duit_kinerja*$_POST['persen_kemampuan_interpersonal']/100;
	
	$tambahan_prestasi = $this->pengaliKinerja04($_POST['huruf_prestasi'])/100*$duit_prestasi;
	$tambahan_inovasi = $this->pengaliKinerja04($_POST['huruf_inovasi'])/100*$duit_inovasi_kreativitas;
	$tambahan_managerial = $this->pengaliKinerja04($_POST['huruf_managerial'])/100*$duit_managerial;
	$tambahan_interpersonal = $this->pengaliKinerja04($_POST['huruf_interpersonal'])/100*$duit_interpersonal;
	$tambahan = $tambahan_prestasi + $tambahan_inovasi + $tambahan_managerial + $tambahan_interpersonal;
	$total = $duit_disiplin - $potongan + $tambahan;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>FORM TPB 04 - <?php echo $nama; ?></title>
<style>
body{font:65% "Arial",arial,sans-serif;color: #333;text-align:center;padding: 10px}
</style>
</head>
<body>
<center>
<table border="1" cellpadding="5" cellspacing="0">
	<tr>
		<td><strong>FORMULIR TPB 04</strong></td>
	</tr>
	<tr>
		<td align="center" nowrap style="background-color:#CCCCCC "><strong>PEMERINTAH PROVINSI PAPUA<br>DAFTAR PERHITUNGAN TAMBAHAN PENGHASILAN BERSYARAT (TPB) UNTUK JABATAN STRUKTURAL<br>
		</strong></td>
	</tr>
	<tr>
		<td>
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
					<td>&nbsp;&nbsp;: Rp. <?php echo $util->duit($total_tpb); ?></td>
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
					<td width="20%" n>Nama</td>
					<td>:</td>
					<td width="100%"><?php echo $nama; ?></td>
					<td rowspan="5"><img src="<?php echo $image; ?>"></td>
				</tr>
				<tr>
					<td>NIP</td>
					<td>:</td>
					<td><?php echo $util->formatNIP($_POST['nip']); ?></td>
				</tr>
				<tr>
					<td>Pangkat/Golongan</td>
					<td>:</td>
					<td><?php echo $golongan; ?></td>
				</tr>
				<tr>
					<td nowrap>Jabatan Struktural</td>
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
		<td align="center" style="background-color:#CCCCCC "><strong>PERHITUNGAN TAMBAHAN PENGHASILAN BERSYARAT (TPB) PNS</strong></td>
	</tr>
	<tr>
	  <td>
	  	<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr style="background-color:#CCCCCC"  >
				<td ><strong>A. DISIPLIN </strong></td>
				<td >&nbsp;</td>
		    <td nowrap ><strong> <?php echo $_POST['persen_disiplin']; ?> %</strong></td>
				<td colspan="2" ><strong> Dari Total TPB Sebesar :</strong></td>
				<td ><strong> <?php echo $util->duit($duit_disiplin); ?></strong></td>
			    <td >&nbsp;</td>
			</tr>
			<tr style="background-color:#EEEEEE ">
				<td>1. Kehadiran</td>
				<td>&nbsp;</td>
				<td width="30px" align="center"><?php echo $_POST['persen_kehadiran']; ?> %</td>
				<td colspan="2">Dari Alokasi TPB Disiplin Sebesar : </td>
				<td width="50px" align="right"><?php echo $util->duit($duit_kehadiran); ?></td>
			    <td>&nbsp;</td>
			</tr>
			<tr style="background-color:#EEEEEE ">
				<td>&nbsp;</td>
				<td>Penilaian</td>
				<td width="25px" align="center"><?php echo $_POST['huruf_kehadiran']; ?></td>
				<td >Potongan :  </td>
				<td width="25px" align="right"><?php echo $util->duit($potongan_kehadiran); ?></td>
				<td>&nbsp;</td>
			    <td>&nbsp;</td>
			</tr>
			<tr style="background-color:#EEEEEE ">
				<td>2. Kepatuhan</td>
				<td>&nbsp;</td>
				<td width="25px" align="center"><?php echo $_POST['persen_kepatuhan']; ?> %</td>
				<td colspan="2">Dari Alokasi TPB Disiplin Sebesar : </td>
				<td width="25px" align="right"><?php echo $util->duit($duit_kepatuhan); ?></td>
			    <td>&nbsp;</td>
			</tr>
			<tr style="background-color:#EEEEEE ">
				<td>&nbsp;</td>
				<td>Penilaian</td>
				<td width="25px" align="center"><?php echo $_POST['huruf_kepatuhan']; ?></td>
				<td>Potongan : </td>
				<td width="25px" align="right"><?php echo $util->duit($potongan_kepatuhan); ?></td>
                
				<td>&nbsp;</td>
			    <td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6" width="100px" align="right"><b>Total Potongan Kedisiplinan Pegawai (D) :</b></td>
				<td width="25px" align="right" nowrap><?php echo $util->duit($potongan); ?></td>
			</tr>
			<tr>
				<td colspan="7">&nbsp;</td>
			</tr>
			<tr style="background-color:#CCCCCC ">
				<td><strong>B. KINERJA</strong></td>
				<td>&nbsp;</td>
				<td nowrap><strong><?php echo $_POST['persen_kinerja']; ?> %</strong></td>
				<td colspan="2"><strong>Dari Total TPB Sebesar :</strong></td>
				<td><strong><?php echo $util->duit($duit_kinerja); ?></strong></td>
			    <td>&nbsp;</td>
			</tr>
			<tr style="background-color:#EEEEEE ">
				<td>1. Prestasi</td>
				<td>&nbsp;</td>
				<td width="25px" align="center"><?php echo $_POST['persen_prestasi']; ?> %</td>
				<td colspan="2">Dari Alokasi TPB Kinerja Sebesar : </td>
				<td width="25px" align="right"><?php echo $util->duit($duit_prestasi); ?></td>
			    <td>&nbsp;</td>
			</tr>
			<tr style="background-color:#EEEEEE ">
				<td>&nbsp;</td>
				<td>Penilaian</td>
				<td width="25px" align="center"><?php echo $_POST['huruf_prestasi']; ?></td>
				<td>Tambahan : </td>
				<td width="25px" align="right"><?php echo $util->duit($tambahan_prestasi); ?></td>
				<td>&nbsp;</td>
			    <td>&nbsp;</td>
			</tr>
			<tr style="background-color:#EEEEEE ">
				<td>2. Inovasi dan Kreativitas</td>
				<td>&nbsp;</td>
				<td width="25px" align="center"><?php echo $_POST['persen_inovasi_kreativitas']; ?> %</td>
				<td colspan="2">Dari Alokasi TPB kinerja Sebesar : </td>
				<td width="25px" align="right"><?php echo $util->duit($duit_inovasi_kreativitas); ?></td>
			    <td>&nbsp;</td>
			</tr>
			<tr style="background-color:#EEEEEE ">
				<td>&nbsp;</td>
				<td>Penilaian</td>
				<td width="25px" align="center"><?php echo $_POST['huruf_inovasi']; ?></td>
				<td>Tambahan : </td>
				<td width="25px" align="right"><?php echo $util->duit($tambahan_inovasi); ?></td>
				<td>&nbsp;</td>
			    <td>&nbsp;</td>
			</tr>
			<tr style="background-color:#EEEEEE ">
				<td>3. Kemampuan Managerial</td>
				<td>&nbsp;</td>
				<td width="25px" align="center"><?php echo $_POST['persen_kemampuan_managerial']; ?> %</td>
				<td colspan="2">Dari Alokasi TPB kinerja Sebesar : </td>
				<td width="25px" align="right"><?php echo $util->duit($duit_managerial); ?></td>
			    <td>&nbsp;</td>
			</tr>
			<tr style="background-color:#EEEEEE ">
				<td>&nbsp;</td>
				<td>Penilaian</td>
				<td width="25px" align="center"><?php echo $_POST['huruf_managerial']; ?></td>
				<td>Tambahan : </td>
				<td width="25px" align="right"><?php echo $util->duit($tambahan_managerial); ?></td>
				<td>&nbsp;</td>
			    <td>&nbsp;</td>
			</tr>
			<tr style="background-color:#EEEEEE ">
				<td>4. Kemampuan Interpersonal</td>
				<td>&nbsp;</td>
				<td width="25px" align="center"><?php echo $_POST['persen_kemampuan_interpersonal']; ?> %</td>
				<td colspan="2">Dari Alokasi TPB kinerja Sebesar : </td>
				<td width="25px" align="right"><?php echo $util->duit($duit_interpersonal); ?></td>
			    <td>&nbsp;</td>
			</tr>
			<tr style="background-color:#EEEEEE ">
				<td>&nbsp;</td>
				<td>Penilaian</td>
				<td width="25px" align="center"><?php echo $_POST['huruf_interpersonal']; ?></td>
				<td>Tambahan : </td>
				<td width="25px" align="right"><?php echo $util->duit($tambahan_interpersonal); ?></td>
				<td>&nbsp;</td>
			    <td>&nbsp;</td>
			</tr>
			<tr >
				<td colspan="6" width="100px" align="right"><strong>Total Tambahan Kinerja Pegawai (K) :</strong></td>
				<td width="25px" align="right" nowrap><?php echo $util->duit($tambahan); ?></td>
			</tr>
			<tr>
				<td colspan="6" align="right"><strong>Total TPB (kotor) adalah</strong> (<?php echo $util->duit($duit_disiplin)." - ".$util->duit($potongan)." + ".$util->duit($tambahan); ?>) :</td>
				<td align="right" nowrap style="background-color:#EEEEEE "><strong><?php echo $util->duit_rp($total); ?></strong></td>
		    </tr>
			<tr>
				<td align="right">TERBILANG : </td>
				<td colspan="6"><?php echo ucwords($util->terbilang($total));?></td>
		    </tr>
		</table>
	  </td>
    </tr>
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="2">Demikian daftar perhitungan Tambahan Penghasilan Bersyarat (TPB) ini dibuat dengan sebenarnya.<br>
				    <br></td>
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
					<td align="center"><br><br><br><br><strong>
						<table align="center" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td align="center"><u><?php echo $_POST['nama1']; ?></u></td>
							</tr>
							<tr>
								<td align="center">NIP. <?php echo $util->formatNIP($_POST['nip1']); ?></td>
							</tr>
						</table></strong>
					</td>
					<td align="center"><br><br><br><br><strong>
						<table align="center" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td align="center"><u><?php echo $_POST['nama2']; ?></u></td>
							</tr>
							<tr>
								<td align="center">NIP. <?php echo $util->formatNIP($_POST['nip2']); ?></td>
							</tr>
						</table></strong>
					</td>
				</tr>
			</table>
			<br>
			<table align="center" width="100%" cellpadding="1" cellspacing="0" border="0">
				<tr style="background-color:#CCCCCC ">
					<th colspan="7">KONVERSI BOBOT PENILAIAN TAMBAHAN PENGHASILAN BERSYARAT (TPB)</th>
				</tr>
				<tr style="background-color:#DDDDDD ">
					<th>Kode Penilaian</th>
					<th>&nbsp;</th>
					<th nowrap>Potongan Untuk Disiplin</th>
					<th nowrap>&nbsp;</th>
					<th nowrap>Tambahan Untuk Kinerja</th>
					<th nowrap>&nbsp;</th>
					<th>Keterangan</th>
				</tr>
				<tr style="background-color:#EEEEEE ">
					<td nowrap>a. Sangat Tidak Baik (STB)</td>
					<td nowrap>&nbsp;</td>
					<td align="center">100%</td>
					<td align="center">&nbsp;</td>
					<td align="center">0%</td>
					<td align="center">&nbsp;</td>
					<td rowspan="5">Dari Alokasi TPB Untuk Masing-Masing Indikator Penilaian</td>
				</tr>
				<tr style="background-color:#EEEEEE ">
					<td>b. Tidak Baik (TB)</td>
					<td>&nbsp;</td>
					<td align="center">75%</td>
					<td align="center">&nbsp;</td>
					<td align="center">25%</td>
				    <td align="center">&nbsp;</td>
				</tr>
				<tr style="background-color:#EEEEEE ">
					<td>c. Cukup (C)</td>
					<td>&nbsp;</td>
					<td align="center">50%</td>
					<td align="center">&nbsp;</td>
					<td align="center">50%</td>
				    <td align="center">&nbsp;</td>
				</tr>
				<tr style="background-color:#EEEEEE ">
					<td>d. Baik (B)</td>
					<td>&nbsp;</td>
					<td align="center">25%</td>
					<td align="center">&nbsp;</td>
					<td align="center">75%</td>
				    <td align="center">&nbsp;</td>
				</tr>
				<tr style="background-color:#EEEEEE ">
					<td>c. Sangat Baik (SB)</td>
					<td>&nbsp;</td>
					<td align="center">0%</td>
					<td align="center">&nbsp;</td>
					<td align="center">100%</td>
				    <td align="center">&nbsp;</td>
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
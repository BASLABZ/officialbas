<?php
$db = $this->db;
$util = $this->util;
$image = $this->cnf->ROOTDIR."img/image003.png";


$_POST['skpd'] = $this->data['id'];

if(!empty($_POST['bulan'])) {
	$lanjut = true;
	$res = $db->query("SELECT nama_direktur, nip_direktur, nama_kepala_sdm, nip_kepala_sdm, nama_petugas, nip_petugas FROM setting_tpb_khusus WHERE skpd = '".$this->data['id']."' AND bulan = '".$_POST['bulan']."' AND tahun = '".$_POST['tahun']."'");
	list($nama_direktur, $nip_direktur, $nama_kepala_sdm, $nip_kepala_sdm, $nama_petugas, $nip_petugas) = $db->fetchArray($res);
	
	if(!empty($_POST['nip'])) {
		$res = $db->query("SELECT nama, nip, golongan, pangkat, gol1, gol2, jabatan, unit, subunit, id, skpd.skpd, status, namaa, nipa, tpb FROM pegawai LEFT JOIN skpd on id = pegawai.skpd WHERE nip = '".$_POST['nip']."'");
		list($nama, $nip, $golongan, $pangkat, $gol1, $gol2, $jabatan, $unit, $subunit, $skpd, $nama_skpd, $status, $namaa, $nipa, $tpb) = $db->fetchArray($res);
		
		$res = $db->query("SELECT k_1_1, nilai_k_1_1, k_1_2, nilai_k_1_2, k_2, nilai_k_2, k_3, nilai_k_3, k_3_rangkap, k_4, nilai_k_4, k_4_rangkap, k_5, nilai_k_5, k_5_rangkap, k_6, nilai_k_6, k_7, nilai_k_7, k_8, nilai_k_8, tidak_hadir, potongan, total_tpb, total_tpb_kotor, tgl, bln, thn FROM tpb_khusus WHERE nip = '".$_POST['nip']."' AND bulan = '".$_POST['bulan']."' AND tahun = '".$_POST['tahun']."'");
		if($db->numRows($res) > 0) {
			list($k_1_1, $nilai_k_1_1, $k_1_2, $nilai_k_1_2, $k_2, $nilai_k_2, $k_3, $nilai_k_3, $k_3_rangkap, $k_4, $nilai_k_4, $k_4_rangkap, $k_5, $nilai_k_5, $k_5_rangkap, $k_6, $nilai_k_6, $k_7, $nilai_k_7, $k_8, $nilai_k_8, $tidak_hadir, $potongan, $total_tpb, $total_tpb_kotor, $tgl, $bln, $thn) = $db->fetchArray($res);
		}
		$lanjut2 = true;			
	}
}

if($lanjut) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Form TPB Khusus - <?php echo $nama; ?></title>
<style>
body{font:65% "Arial",arial,sans-serif;color: #333;text-align:center;padding: 10px}
</style>
<style type="text/css" media="print">
@page
{
	size: landscape;
	margin: 1.5cm;
	
}
div.page { page-break-after: always} 
</style>
</head>
<body>
<center>
<table border="1" cellpadding="1" cellspacing="0">
	<tr>
		<td width="730"><strong>TPB Khusus</strong></td>
	</tr>
	<tr>
		<td align="center"><strong>PEMERINTAH PROVINSI PAPUA<br>DAFTAR PERHITUNGAN TAMBAHAN PENGHASILAN BERSYARAT KHUSUS (TPB KHUSUS) <br>
	    UNTUK TENAGA MEDIS, PARAMEDIS, DAN PENUNJANG MEDIS<br>
		PADA RSUD JAYAPURA, RSU ABEPURA DAN RSJ ABEPURA
	   </strong></td>
	</tr>
	<tr>
		<td>
			<table border="0" width="100%">
				<tr>
					<td width="15%" nowrap>Bulan/Tahun Penilaian</td>
					<td width="1%">:</td>
					<td width="81%"><?php echo $util->longMonth[$_POST['bulan']]." / ".$_POST['tahun']; ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center"><strong>IDENTITAS PEGAWAI</strong></td>
	</tr>
	<tr>
		<td>
			<table border="0" width="100%">
				<tr>
					<td width="15%" nowrap>Nama/NIP</td>
					<td width="1%">:</td>
					<td width="81%"><?php echo $nama." / ".$util->formatNIP($nip); ?>
					</td>
					<td width="3%" rowspan="5"><img src="<?php echo $image; ?>"></td>
				</tr>
				<tr>
					<td nowrap>Pangkat/Golongan</td><td>:</td><td><?php echo $golongan; ?></td>
				</tr>
				<tr>
					<td nowrap>Jabatan Struktural/Fungsional</td><td>:</td><td><?php echo $jabatan; ?></td>
				</tr>
				<tr>
					<td nowrap>Unit Kerja (RSUD/RSJ)</td><td>:</td><td><?php echo $unit."/".$nama_skpd; ?></td>
				</tr>
				<tr>
				  <td nowrap>Subunit Kerja </td><td>:</td><td><?php echo $subunit; ?></td>
			  </tr>
			</table>
		</td>
	</tr>
	<?php
	if($lanjut2) {
	?>
	<tr>
		<td align="center"><strong>PERHITUNGAN TPB KHUSUS</strong></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="1" cellspacing="0" width="100%">
				<tr style="background-color:#CCCCCC ">
					<td width="100%"><strong>1. KELOMPOK SDM</strong></td>
				</tr>
				<tr>
					<td width="100%">
						<table cellpadding="0" cellspacing="0" style="margin:0px" width="100%">
							<tr valign="top">
								<td width="100%">
									<table width="100%" border="1" cellpadding="1" style="border-collapse:collapse">
										<tr>
											<td rowspan="6" valign="top"><div align="center"><strong>1.1.</strong></div></td><td nowrap><strong>Jabatan Struktural:</strong></td><td><div align="center"><strong>Kode:</strong></div></td>
										</tr>
										<tr>
											<td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eselon IIA</td><td><div align="center">A</div></td>
										</tr>
										<tr>
											<td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eselon IIB</td><td><div align="center">B</div></td>
										</tr>
										<tr>
											<td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eselon IIIA</td><td><div align="center">C</div></td>
										</tr>
										<tr>
											<td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eselon IIIB</td><td><div align="center">D</div></td>
										</tr>
										<tr>
											<td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eselon IV</td><td><div align="center">E</div></td>
										</tr>
										<tr>
											<td><div align="center"><strong>1.2.</strong></div></td><td colspan="2" nowrap><strong>Jabatan Fungsional Tertentu</strong></td>
										</tr>
									</table>
								</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td>
									<table cellpadding="1" border="1" style="border-collapse:collapse">
										<tr>
											<td><div align="center"><strong>Jabatan:</strong></div></td>
											<td><div align="center"><strong>Kode:</strong></div></td>
										</tr>
										<tr>
											<td><strong>Struktural</strong></td>
											<td><strong><?php echo $k_1_1; ?>&nbsp;</strong></td>
										</tr>
										<tr>
											<td><strong>Fungsional Tertentu</strong></td>
											<td><strong><?php echo $k_1_2; ?>&nbsp;</strong></td>
										</tr>
									</table>
									<br>
									<table cellpadding="1" border="1" style="border-collapse:collapse">
										<tr>
											<td colspan="2" nowrap><div align="center"><strong>Nilai TPB (Rp.) </strong></div></td>
										</tr>
										<tr>
											<td nowrap><strong>Struktural</strong></td>
											<td align='right'><strong><?php echo $util->duit((int)$nilai_k_1_1); ?></strong></td>
										</tr>
										<tr>
											<td nowrap><strong>Fungsional Tertentu</strong></td>
											<td align='right'><strong><?php echo $util->duit((int)$nilai_k_1_2); ?></strong></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<br>
						<table cellpadding="1" border="1" style="border-collapse:collapse">
							<tr>
								<td colspan="6"><div align="center"><strong>Keterangan Kode Untuk Jabatan Fungsional Tertentu</strong></div></td>
							</tr>
							<tr>
								<td width="98"><div align="center"><strong>Medis</strong></div></td><td width="35"><div align="center"><strong>Kode</strong></div></td><td width="132"><div align="center"><strong>Paramedis</strong></div></td><td width="35"><div align="center"><strong>Kode</strong></div></td>
								<td width="353"><div align="center"><strong>Penunjang Medis</strong></div></td><td width="81"><div align="center"><strong>Kode</strong></div></td>
							</tr>
							<tr>
								<td nowrap>Dokter Sub-Spesialis </td>
								<td><div align="center">A</div></td>
								<td rowspan="4">Penata Anastesi, Perawat dan Bidan </td>
								<td rowspan="4"><div align="center">E</div></td>
								<td rowspan="4">Asisten Apoteker, Pranata Lab (Analis), Epidemiolog
									Kesehatan, Entomolog Kesehatan, Sanitarian, Administrator Kesehatan,
									Penyuluh Kesehatan Masyarakat, Nutrisionis, Radiografer,
									Perekam Medis, Teknisi Elektromedis, Fisioterapis,
									Rehabilitasi Medik, Kemoterapis, Hemodialis,
									dan Sosio Medik </td>
								<td rowspan="4"><div align="center">F</div></td>
								</tr>
							<tr>
								<td>Dokter Spesialis </td><td><div align="center">B</div></td>
							</tr>
							<tr>
								<td nowrap>Dokter Umum/Gigi</td><td><div align="center">C</div></td>
							</tr>
							<tr>
								<td>Apoteker</td><td><div align="center">D</div></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr style="background-color:#CCCCCC ">
					<td width="100%"><strong>2. TINGKAT PENDIDIKAN</strong></td>
				</tr>
				<tr>
					<td width="100%">
						<table cellpadding="0" cellspacing="0" style="margin:0px" width="100%">
							<tr valign="top">
								<td>
									<table width="100%" border="1" cellpadding="1" style="border-collapse:collapse">
										<tr>
											<td><div align="center"><strong>No.</strong></div></td><td><div align="center"><strong>Tingkat Pendidikan:</strong></div></td><td><div align="center"><strong>Kode:</strong></div></td>
										</tr>
										<tr>
											<td><div align="center">1.</div></td><td nowrap>Dokter Sub-Spesialis</td><td><div align="center">A</div></td>
										</tr>
										<tr>
											<td><div align="center">2.</div></td><td nowrap>Dokter Spesialis</td><td><div align="center">B</div></td>
										</tr>
										<tr>
											<td><div align="center">3.</div></td><td nowrap>Dokter Umum/Dokter Gigi/Apoteker/Nurse</td><td><div align="center">C</div></td>
										</tr>
										<tr>
											<td><div align="center">4.</div></td><td nowrap>Diploma IV</td><td><div align="center">D</div></td>
										</tr>
										<tr>
											<td><div align="center">5.</div></td><td nowrap>Diploma I/Diploma II/Diploma III</td><td><div align="center">E</div></td>
										</tr>
										<tr>
											<td><div align="center">6.</div></td><td nowrap>Sekolah Perawat Kesehatan/SMF atau SMA Sederajat</td><td><div align="center">F</div></td>
										</tr>
										<tr>
											<td><div align="center">7.</div></td><td nowrap>SMP Sederajat</td><td><div align="center">G</div></td>
										</tr>
									</table>
								</td>
								<td>&nbsp;</td>
								<td width="100">
									<table cellpadding="1" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Kode:</strong></td>
											<td><strong><?php echo $k_2; ?>&nbsp;</strong></td>
										</tr>
									</table>
									<br>
									<table cellpadding="1" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Nilai TBP(Rp.):</strong></td>
										</tr>
										<tr>
											<td align='right'><strong><?php echo $util->duit((int)$nilai_k_2); ?></strong></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr style="background-color:#CCCCCC ">
					<td width="100%"><strong>3. JABATAN TAMBAHAN</strong></td>
				</tr>
				<tr>
					<td width="100%">
						<table cellpadding="0" cellspacing="0" style="margin:0px" width="100%">
							<tr valign="top">
								<td>
									<table width="100%" border="1" cellpadding="1" style="border-collapse:collapse">
										<tr>
											<td><div align="center"><strong>No.</strong></div></td><td><div align="center"><strong>Keterangan</strong></div></td><td><div align="center"><strong>Kode</strong></div></td>
										</tr>
										<tr>
											<td><div align="center">1.</div></td><td nowrap>Satuan Pengawas Internal (SPI)</td><td><div align="center">A</div></td>
										</tr>
										<tr>
											<td><div align="center">2.</div></td><td nowrap>Komite Medik</td><td><div align="center">B</div></td>
										</tr>
										<tr>
											<td><div align="center">3.</div></td><td nowrap>Komite Keperawatan</td><td><div align="center">C</div></td>
										</tr>
										<tr>
											<td><div align="center">4.</div></td><td nowrap>Sub Komite Medik</td><td><div align="center">D</div></td>
										</tr>
									</table>							
								</td>
								<td>&nbsp;</td>
								<td>
									<table width="100%" border="1" cellpadding="1" style="border-collapse:collapse">
										<tr>
											<td><div align="center"><strong>No.</strong></div></td><td><div align="center"><strong>Keterangan</strong></div></td><td><div align="center"><strong>Kode</strong></div></td>
										</tr>
										<tr>
											<td><div align="center">5.</div></td><td nowrap>Kepala SMF</td><td><div align="center">E</div></td>
										</tr>
										<tr>
											<td><div align="center">6.</div></td><td nowrap>Kepala Instalasi </td><td><div align="center">F</div></td>
										</tr>
										<tr>
											<td><div align="center">7.</div></td><td nowrap>Kepala Ruangan </td><td><div align="center">G</div></td>
										</tr>
										<tr>
											<td><div align="center">8.</div></td><td nowrap>Kepala Poliklinik </td><td><div align="center">H</div></td>
										</tr>
									</table>							
								</td>
								<td>&nbsp;</td>
								<td width="100">
									<table cellpadding="1" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Kode:</strong></td>
											<td><strong><?php echo $k_3; ?>&nbsp;</strong></td>
										</tr>
									</table>
									<br>
									<table cellpadding="1" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Nilai TBP(Rp.):</strong></td>
										</tr>
										<tr>
											<td align='right'><strong><?php echo $util->duit((int)$nilai_k_3); ?></strong></td>
										</tr>
									</table>							
								</td>
							</tr>
						</table>
						<br>
						<table cellpadding="1" border="1" style="border-collapse:collapse">
							<tr>
								<td>Memiliki Rangkap Jabatan Tambahan?</td>
								<td><strong><?php echo (empty($k_3_rangkap) || $k_3_rangkap == 0)?"TIDAK":"YA"; ?></strong></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr style="background-color:#CCCCCC ">
					<td width="100%"><strong>4. RISIKO KERJA</strong></td>
				</tr>
				<tr>
					<td width="100%">
						<table cellpadding="0" cellspacing="0" style="margin:0px" width="100%">
							<tr valign="top">
								<td>
									<table width="100%" border="1" cellpadding="1" style="border-collapse:collapse">
										<tr>
											<td><div align="center"><strong>No.</strong></div></td><td><div align="center"><strong>Keterangan</strong></div></td><td><div align="center"><strong>Kode</strong></div></td>
										</tr>
										<tr>
											<td><div align="center">1.</div></td><td nowrap>Kamar Operasi UGD </td><td><div align="center">A</div></td>
										</tr>
										<tr>
											<td><div align="center">2.</div></td><td nowrap>Radiologi</td><td><div align="center">B</div></td>
										</tr>
										<tr>
											<td><div align="center">3.</div></td><td nowrap>Laboratorium</td><td><div align="center">C</div></td>
										</tr>
										<tr>
											<td><div align="center">4.</div></td><td nowrap>UGD (OK Cito, Triase) </td><td><div align="center">D</div></td>
										</tr>
										<tr>
											<td><div align="center">5.</div></td><td nowrap>Kamar Bersalin (VK) </td><td><div align="center">E</div></td>
										</tr>
										<tr>
											<td><div align="center">6.</div></td><td nowrap>ICU</td><td><div align="center">F</div></td>
										</tr>
									</table>
								</td>
								<td>&nbsp;</td>
								<td>
									<table width="100%" border="1" cellpadding="1" style="border-collapse:collapse">
										<tr>
											<td><div align="center"><strong>No.</strong></div></td><td><div align="center"><strong>Keterangan</strong></div></td><td><div align="center"><strong>Kode</strong></div></td>
										</tr>
										<tr>
											<td><div align="center">7.</div></td><td nowrap>ICCU</td><td><div align="center">G</div></td>
										</tr>
										<tr>
											<td><div align="center">8.</div></td><td nowrap>NICU</td><td><div align="center">H</div></td>
										</tr>
										<tr>
											<td><div align="center">9.</div></td><td nowrap>Ruang Isolasi </td><td><div align="center">I</div></td>
										</tr>
										<tr>
											<td><div align="center">10.</div></td><td nowrap>VCT</td><td><div align="center">J</div></td>
										</tr>
										<tr>
											<td><div align="center">11.</div></td><td nowrap>Ruang Laundry </td><td><div align="center">K</div></td>
										</tr>
										<tr>
											<td><div align="center">12.</div></td><td nowrap>Ruang Rawat Inap Biasa </td><td><div align="center">L</div></td>
										</tr>
									</table>
								</td>
								<td>&nbsp;</td>
								<td width="100">
									<table cellpadding="1" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Kode:</strong></td>
											<td><strong><?php echo $k_4; ?>&nbsp;</strong></td>
										</tr>
									</table>
									<br>
									<table cellpadding="1" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Nilai TBP(Rp.):</strong></td>
										</tr>
										<tr>
											<td align='right'><strong><?php echo $util->duit((int)$nilai_k_4); ?></strong></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<br>
						<table cellpadding="1" border="1" style="border-collapse:collapse">
							<tr>
								<td>Memiliki Rangkap Indikator Risiko Kerja?</td>
								<td><strong><?php echo (empty($k_4_rangkap) || $k_4_rangkap == 0)?"TIDAK":"YA"; ?></strong></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr style="background-color:#CCCCCC ">
					<td width="100%"><strong>5. KEGAWATDARURATAN</strong></td>
				</tr>
				<tr>
					<td width="100%">
						<table cellpadding="0" cellspacing="0" style="margin:0px" width="100%">
							<tr valign="top">
								<td>
									<table width="100%" border="1" cellpadding="1" style="border-collapse:collapse">
										<tr>
											<td><div align="center"><strong>No.</strong></div></td><td><div align="center"><strong>Keterangan</strong></div></td><td><div align="center"><strong>Kode</strong></div></td>
										</tr>
										<tr>
											<td><div align="center">1.</div></td><td nowrap>UGD</td><td><div align="center">A</div></td>
										</tr>
										<tr>
											<td><div align="center">2.</div></td><td nowrap>VK (Kamar Bersalin)</td><td><div align="center">B</div></td>
										</tr>
										<tr>
											<td><div align="center">3.</div></td><td nowrap>Ruang Isolasi (Khusus Rumah Sakit Jiwa) </td><td><div align="center">C</div></td>
										</tr>
										<tr>
											<td><div align="center">4.</div></td><td nowrap>ICU</td><td><div align="center">D</div></td>
										</tr>
										<tr>
											<td><div align="center">5.</div></td><td nowrap>ICCU</td><td><div align="center">E</div></td>
										</tr>
										<tr>
											<td><div align="center">6.</div></td><td nowrap>NICU</td><td><div align="center">F</div></td>
										</tr>
									</table>
								</td>
								<td>&nbsp;</td>
								<td>
									<table width="100%" border="1" cellpadding="1" style="border-collapse:collapse">
										<tr>
											<td><div align="center"><strong>No.</strong></div></td><td><div align="center"><strong>Keterangan</strong></div></td><td><div align="center"><strong>Kode</strong></div></td>
										</tr>
										<tr>
											<td><div align="center">7.</div></td><td nowrap>Kamar Operasi Non UGD </td><td><div align="center">G</div></td>
										</tr>
										<tr>
											<td><div align="center">8.</div></td><td nowrap>HCU</td><td><div align="center">H</div></td>
										</tr>
										<tr>
											<td><div align="center">9.</div></td><td nowrap>Ruang RR </td><td><div align="center">I</div></td>
										</tr>
										<tr>
											<td><div align="center">10.</div></td><td nowrap>Ruang Isolasi (RSUD) </td><td><div align="center">J</div></td>
										</tr>
										<tr>
											<td><div align="center">11.</div></td><td nowrap>Pelayanan Rawat Inap </td><td><div align="center">K</div></td>
										</tr>
									</table>
								</td>
								<td>&nbsp;</td>
								<td width="100">
									<table cellpadding="1" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Kode:</strong></td>
											<td><strong><?php echo $k_5; ?>&nbsp;</strong></td>
										</tr>
									</table>
									<br>
									<table cellpadding="1" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Nilai TBP(Rp.):</strong></td>
										</tr>
										<tr>
											<td align='right'><strong><?php echo $util->duit((int)$nilai_k_5); ?></strong></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<br>
						<table cellpadding="1" border="1" style="border-collapse:collapse">
							<tr>
								<td>Memiliki Rangkap Indikator Kegawatdaruratan?</td>
								<td><strong><?php echo (empty($k_5_rangkap) || $k_5_rangkap == 0)?"TIDAK":"YA"; ?></strong></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr style="background-color:#CCCCCC ">
					<td width="100%"><strong>6. PROFESI ANAMNESE DAN TERAPI PASIEN</strong></td>
				</tr>
				<tr>
					<td width="100%">
						<table cellpadding="0" cellspacing="0" style="margin:0px" width="100%">
							<tr valign="top">
								<td>
									<table width="100%" border="1" cellpadding="1" style="border-collapse:collapse">
										<tr>
											<td><div align="center"><strong>No.</strong></div></td><td><div align="center"><strong>Keterangan</strong></div></td><td><div align="center"><strong>Kode</strong></div></td>
										</tr>
										<tr>
											<td><div align="center">1.</div></td><td nowrap>Sub-Spesialis</td><td><div align="center">A</div></td>
										</tr>
										<tr>
											<td><div align="center">2.</div></td><td nowrap>Spesialis</td><td><div align="center">B</div></td>
										</tr>
										<tr>
											<td><div align="center">3.</div></td><td nowrap>Dokter Umum/Gigi </td><td><div align="center">C</div></td>
										</tr>
									</table>
								</td>
								<td>&nbsp;</td>
								<td>
									<table width="100%" border="1" cellpadding="1" style="border-collapse:collapse">
										<tr>
											<td><div align="center"><strong>No.</strong></div></td><td><div align="center"><strong>Keterangan</strong></div></td><td><div align="center"><strong>Kode</strong></div></td>
										</tr>
										<tr>
											<td><div align="center">4.</div></td><td nowrap>Apoteker</td><td><div align="center">D</div></td>
										</tr>
										<tr>
											<td><div align="center">5.</div></td><td nowrap>Tenaga Kesehatan Lain di Rumah Sakit </td><td><div align="center">E</div></td>
										</tr>
									</table>
								</td>
								<td>&nbsp;</td>
								<td width="100">
									<table cellpadding="1" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Kode:</strong></td>
											<td><strong><?php echo $k_6; ?>&nbsp;</strong></td>
										</tr>
									</table>
									<br>
									<table cellpadding="1" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Nilai TBP(Rp.):</strong></td>
										</tr>
										<tr>
											<td align='right'><strong><?php echo $util->duit((int)$nilai_k_6); ?></strong></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>				    
					</td>
				</tr>
				<tr style="background-color:#CCCCCC ">
					<td width="100%"><strong>7. MASA KERJA</strong></td>
				</tr>
				<tr>
					<td width="100%">
						<table cellpadding="0" cellspacing="0" style="margin:0px" width="100%">
							<tr valign="top">
								<td>
									<table width="100%" border="1" cellpadding="1" style="border-collapse:collapse">
										<tr>
											<td><div align="center"><strong>No.</strong></div></td>
											<td><div align="center"><strong>Keterangan</strong></div></td>
											<td><div align="center"><strong>Kode</strong></div></td>
										</tr>
										<tr>
											<td><div align="center">1.</div></td><td nowrap>Kurang dari 5 tahun </td><td><div align="center">A</div></td>
										</tr>
										<tr>
											<td><div align="center">2.</div></td><td nowrap>5 - 9,99 tahun </td><td><div align="center">B</div></td>
										</tr>
										<tr>
											<td><div align="center">3.</div></td><td nowrap>10 - 14,99 tahun </td><td><div align="center">C</div></td>
										</tr>
										<tr>
											<td><div align="center">4.</div></td><td nowrap>15 - 20 tahun </td><td><div align="center">D</div></td>
										</tr>
										<tr>
											<td><div align="center">5.</div></td><td nowrap>Di atas 20 tahun </td><td><div align="center">E</div></td>
										</tr>
									</table>
								</td>
								<td>&nbsp;</td>
								<td width="100">
									<table cellpadding="1" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Kode:</strong></td>
											<td><strong><?php echo $k_7; ?>&nbsp;</strong></td>
										</tr>
									</table>
									<br>
									<table cellpadding="1" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Nilai TBP(Rp.):</strong></td>
										</tr>
										<tr>
											<td align='right'><strong><?php echo $util->duit((int)$nilai_k_7); ?></strong></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>				    
					</td>
				</tr>
				<tr style="background-color:#CCCCCC ">
					<td width="100%"><strong>8. TIPE RUMAH SAKIT</strong></td>
				</tr>
				<tr>
					<td width="100%"><table cellpadding="0" cellspacing="0" style="margin:0px" width="100%">
						<tr valign="top">
							<td>
								<table width="100%" border="1" cellpadding="1" style="border-collapse:collapse">
									<tr>
										<td><div align="center"><strong>No.</strong></div></td><td><div align="center"><strong>Keterangan</strong></div></td><td><div align="center"><strong>Kode</strong></div></td>
									</tr>
									<tr>
										<td><div align="center">1.</div></td><td nowrap>A</td><td><div align="center">A</div></td>
									</tr>
									<tr>
										<td><div align="center">2.</div></td><td nowrap>B (Pendidikan) </td><td><div align="center">B</div></td>
									</tr>
									<tr>
										<td><div align="center">3.</div></td><td nowrap>B (Non Pendidikan) </td><td><div align="center">C</div></td>
									</tr>
									<tr>
										<td><div align="center">4.</div></td><td nowrap>C</td><td><div align="center">D</div></td>
									</tr>
								</table>
							</td>
							<td>&nbsp;</td>
							<td width="100">
								<div align="left">
									<table cellpadding="1" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Kode:</strong></td>
											<td><strong><?php echo $k_8; ?>&nbsp;</strong></td>
										</tr>
									</table>
									<br>
									<table cellpadding="1" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Nilai TBP(Rp.):</strong></td>
										</tr>
										<tr>
											<td align='right'><strong><?php echo $util->duit((int)$nilai_k_8); ?></strong></td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
					</table>				    
					<hr>
					<div align="center"><strong>Total TPB-Khusus SEBELUM DIKURANGI POTONGAN KETIDAKHADIRAN (Rp.): <?php echo $util->duit((int)$total_tpb); ?></strong></div></td>
				</tr>
				<tr style="background-color:#CCCCCC ">
					<td width="100%"><strong>9. KETIDAKHADIRAN</strong></td>
				</tr>
				<tr>
					<td width="100%">
						<table cellpadding="0" cellspacing="0" style="margin:0px" width="100%">
							<tr>
								<td>
									<div align="center">
										<table cellpadding="1" border="1" style="border-collapse:collapse">
											<tr>
												<td><strong>Jumlah Ketidakhadiran (Hari): </strong></td>
												<td align='right'><strong><?php echo $util->duit((int)$tidak_hadir); ?></strong></td>
											</tr>
										</table>
									</div>
								</td>
								<td><div align="center"></div></td>
								<td>
									<div align="center">
										<table cellpadding="1" border="1" style="border-collapse:collapse">
											<tr>
												<td><strong>Potongan (Rp.): </strong></td>
												<td align='right'><strong><?php echo $util->duit((int)$potongan); ?></strong></td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
						</table>
						<hr>
						<div align="center"><strong>TOTAL TPB-Khusus (KOTOR) YANG DITERIMA (Rp.): <?php echo $util->duit((int)$total_tpb_kotor); ?></strong></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
	    <td>
			<table width="100%" border="0">
				<tr>
					<td colspan="3">Demikian daftar perhitungan Tambahan Penghasilan Bersyarat Khusus (TPB-Khusus) ini dibuat dengan sebenarnya.</td>
				</tr>
				<tr>
					<td align="center"><strong>Mengetahui/Menyetujui</strong></td>
					<td align="center">&nbsp;</td>
					<td align="center"><strong>Jayapura, <?php echo $tgl." ".$util->longMonth[$bln]." ".$thn; ?></strong></td>
				</tr>
				<tr>
					<td align="center">Direktur</td>
					<td align="center">Kepala Bidang SDM </td>
					<td align="center">Petugas Input Data,</td>
				</tr>
				<tr>
					<td align="center"><br><br><br><br>
						<u><strong><?php echo $nama_direktur; ?></strong></u>
					</td>
					<td align="center"><br><br><br><br>
						<u><strong><?php echo $nama_kepala_sdm; ?></strong></u></td>
					<td align="center"><br><br><br><br>
						<u><strong><?php echo $nama_petugas; ?></strong></u>
					</td>
				</tr>
				<tr>
					<td align="center"><strong>NIP. <?php echo $util->formatNIP($nip_direktur); ?> </strong></td>
					<td align="center"><strong>NIP. <?php echo $util->formatNIP($nip_kepala_sdm); ?></strong></td>
					<td align="center"><strong>NIP. <?php echo $util->formatNIP($nip_petugas); ?></strong></td>
				</tr>
			</table>
		</td>
	</tr>
<?php
		}	
}
?>
</table>
</center>
</body>
</html>
<script>
	window.print();
</script>
<?php 
$db = $this->db;
$util = $this->util;
$image = $this->cnf->ROOTDIR."img/image003.png";

if(!empty($_POST['bulan'])) {
	$res = $db->query("SELECT nama_direktur, nip_direktur, nama_kepala_sdm, nip_kepala_sdm, nama_petugas, nip_petugas FROM setting_tpb_khusus WHERE skpd = '".$db->esc($this->data['id'])."' AND bulan = '".$db->esc($_POST['bulan'])."' AND tahun = '".$db->esc($_POST['tahun'])."'");
	list($nama_direktur, $nip_direktur, $nama_kepala_sdm, $nip_kepala_sdm, $nama_petugas, $nip_petugas) = $db->fetchArray($res);
	
	if(!empty($_POST['nip'])) {
		$res = $db->query("SELECT nama, nip, golongan, pangkat, gol1, gol2, jabatan, unit, subunit, id, skpd.skpd, status, namaa, nipa, tpb FROM pegawai LEFT JOIN skpd on id = pegawai.skpd WHERE nip = '".$db->esc($_POST['nip'])."'");
		list($nama, $nip, $golongan, $pangkat, $gol1, $gol2, $jabatan, $unit, $subunit, $skpd, $nama_skpd, $status, $namaa, $nipa, $tpb) = $db->fetchArray($res);
		
		if($_POST['aksi'] == "Simpan" || $_POST['aksi'] == "Cetak") {
			$res = $db->query("REPLACE INTO tpb_khusus(bulan, tahun, nip, golongan, pangkat, gol1, gol2, jabatan, subunit, status, skpd, total_tpb, total_tpb_kotor, tidak_hadir, potongan, ".
			                  "k_1_1, nilai_k_1_1, k_1_2, nilai_k_1_2, k_2, nilai_k_2, k_3, nilai_k_3, k_3_rangkap, k_4, nilai_k_4, k_4_rangkap, k_5, nilai_k_5, k_5_rangkap, k_6, nilai_k_6, k_7, nilai_k_7, k_8, nilai_k_8, tgl, bln, thn) ".
				              "VALUES ('".$db->esc($_POST['bulan'])."', '".$db->esc($_POST['tahun'])."', '".$db->esc($_POST['nip'])."', '".$db->esc($golongan)."','".$db->esc($pangkat)."',".
							  "'".$db->esc($gol1)."', '".$db->esc($gol2)."', '".$db->esc($jabatan)."', '".$db->esc($subunit)."', '".$db->esc($status)."', '".$db->esc($skpd)."', '".$db->esc($_POST['tot_tpb'])."', '".$db->esc($_POST['tot_tpb_kotor'])."', ".
							  "'".$db->esc($_POST['tidak_hadir'])."', '".$db->esc($_POST['potongan'])."', '".$db->esc($_POST['huruf_1_1'])."', '".$db->esc($_POST['tpb_1_1'])."', '".$db->esc($_POST['huruf_1_2'])."', '".$db->esc($_POST['tpb_1_2'])."',".
							  "'".$db->esc($_POST['huruf_2'])."', '".$db->esc($_POST['tpb_2'])."', '".$db->esc($_POST['huruf_3'])."', '".$db->esc($_POST['tpb_3'])."', '".$db->esc($_POST['3_rangkap'])."', '".$db->esc($_POST['huruf_4'])."', '".$db->esc($_POST['tpb_4'])."', ".
							  "'".$db->esc($_POST['4_rangkap'])."', '".$db->esc($_POST['huruf_5'])."', '".$db->esc($_POST['tpb_5'])."', '".$db->esc($_POST['5_rangkap'])."', '".$db->esc($_POST['huruf_6'])."', '".$db->esc($_POST['tpb_6'])."', '".$db->esc($_POST['huruf_7'])."', ".
							  "'".$db->esc($_POST['tpb_7'])."', '".$db->esc($_POST['huruf_8'])."', '".$db->esc($_POST['tpb_8'])."', '".$db->esc($_POST['tgl'])."', '".$db->esc($_POST['bln'])."', '".$db->esc($_POST['thn'])."')");
			if ($res) { 
				echo "<form id='back' method='post' action='?pg=datatpb&mode=tpbkhusus&kodeskpd=".$this->data['id']."'>";
				echo "<input type='hidden' name='bulan' value='".$_POST['bulan']."'>";
				echo "<input type='hidden' name='tahun' value='".$_POST['tahun']."'>";
				if ($_POST['aksi'] == "Cetak") echo "<input type='hidden' name='cetaknip' value='".$_POST['nip']."'>"; 
				echo "</form><script>document.getElementById('back').submit();</script>";
			}
		}
		
		$res = $db->query("SELECT k_1_1, nilai_k_1_1, k_1_2, nilai_k_1_2, k_2, nilai_k_2, k_3, nilai_k_3, k_3_rangkap, k_4, nilai_k_4, k_4_rangkap, k_5, nilai_k_5, k_5_rangkap, k_6, nilai_k_6, k_7, nilai_k_7, k_8, nilai_k_8, tidak_hadir, potongan, total_tpb, total_tpb_kotor, tgl, bln, thn FROM tpb_khusus WHERE nip = '".$db->esc($_POST['nip'])."' AND bulan = '".$db->esc($_POST['bulan'])."' AND tahun = '".$db->esc($_POST['tahun'])."'");
		if($db->numRows($res) > 0) {
			list($k_1_1, $nilai_k_1_1, $k_1_2, $nilai_k_1_2, $k_2, $nilai_k_2, $k_3, $nilai_k_3, $k_3_rangkap, $k_4, $nilai_k_4, $k_4_rangkap, $k_5, $nilai_k_5, $k_5_rangkap, $k_6, $nilai_k_6, $k_7, $nilai_k_7, $k_8, $nilai_k_8, $tidak_hadir, $potongan, $total_tpb, $total_tpb_kotor, $tgl, $bln, $thn) = $db->fetchArray($res);
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
<table border="1" cellpadding="5" cellspacing="0">
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
		<td align="center"><strong>IDENTITAS PEGAWAI</strong></td>
	</tr>
	<tr>
		<td>
			<table border="0" width="100%">
				<tr>
					<td width="15%" nowrap>Nama/NIP</td>
					<td width="1%">:</td>
					<td width="81%"><?php echo $Nama." / ".$util->formatNIP($nip); ?></td>
					<td width="3%" rowspan="4"><img src="<?php echo $image; ?>"></td>
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
				  <td nowrap>Subunit Kerja </td><td>:</td><td><?php echo $subunit; ?></td><td>&nbsp;</td>
			  </tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center"><strong>PERHITUNGAN TPB KHUSUS</strong></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="5" cellspacing="0" width="100%">
				<tr style="background-color:#CCCCCC ">
					<td width="100%"><strong>1. KELOMPOK SDM</strong></td>
				</tr>
				<tr>
					<td width="100%">
						<table cellpadding="0" cellspacing="0" style="margin:0px" width="100%">
							<tr valign="top">
								<td width="100%">
									<table width="100%" border="1" cellpadding="5" style="border-collapse:collapse">
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
									<table cellpadding="5" border="1" style="border-collapse:collapse">
										<tr>
											<td><div align="center"><strong>Jabatan:</strong></div></td>
											<td><div align="center"><strong>Kode:</strong></div></td>
										</tr>
										<tr>
											<td><strong>Struktural</strong></td>
											<td>
												<select name="1_1" onChange="return getNilai(this,'tpb_1_1','huruf_1_1',false,false,'');">
													<option value="0">-</option>
													<?php 
													$res = $db->query("SELECT nilai, kode FROM besaran_tpb_khusus WHERE k_1='1' AND k_2='1.1' GROUP BY k_1, k_2, k_3, kode ORDER BY id ASC");
													while($data=$db->fetchArray($res)){
														$selected = ($data[1] == $k_1_1)?"selected":"";
														echo "<option value=".$data[0]." ".$selected.">".$data[1]."</option>";
													}
													?>
												</select>
												<input id="huruf_1_1" type="hidden" name="huruf_1_1" value="<?php echo $k_1_1; ?>">
											</td>
										</tr>
										<tr>
											<td><strong>Fungsional Tertentu</strong></td>
											<td>
												<select name="1_2" onChange="return getNilai(this,'tpb_1_2','huruf_1_2',false,false,'');">
													<option value="0">-</option>
													<?php 
													$res = $db->query("SELECT nilai, kode FROM besaran_tpb_khusus WHERE k_1='1' AND k_2='1.2' GROUP BY k_1, k_2, k_3, kode ORDER BY id ASC");
													while($data=$db->fetchArray($res)){
														$selected = ($data[1] == $k_1_2)?"selected":"";
														echo "<option value=".$data[0]." ".$selected.">".$data[1]."</option>";
													}
													?>
												</select>
												<input id="huruf_1_2" type="hidden" name="huruf_1_2" value="<?php echo $k_1_2; ?>">
											</td>
										</tr>
									</table>
									<br>
									<table cellpadding="5" border="1" style="border-collapse:collapse">
										<tr>
											<td colspan="2" nowrap><div align="center"><strong>Nilai TPB (Rp.) </strong></div></td>
										</tr>
										<tr>
											<td nowrap><strong>Struktural</strong></td><td><input id="tpb_1_1" type="text" name="tpb_1_1" value="<?php echo (int)$nilai_k_1_1; ?>" readonly></td>
										</tr>
										<tr>
											<td nowrap><strong>Fungsional Tertentu</strong></td><td><input id="tpb_1_2" type="text" name="tpb_1_2" value="<?php echo (int)$nilai_k_1_2; ?>" readonly></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<br>
						<table cellpadding="5" border="1" style="border-collapse:collapse">
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
									<table width="100%" border="1" cellpadding="5" style="border-collapse:collapse">
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
									<table cellpadding="5" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Kode:</strong></td>
											<td>
												<select name="2" onChange="return getNilai(this,'tpb_2','huruf_2',false,false,'');">
													<option value="0">-</option>
													<?php 
													$res = $db->query("SELECT nilai, kode FROM besaran_tpb_khusus WHERE k_1='2' GROUP BY k_1, k_2, k_3, kode ORDER BY id ASC");
													while($data=$db->fetchArray($res)){
														$selected = ($data[1] == $k_2)?"selected":"";
														echo "<option value=".$data[0]." ".$selected.">".$data[1]."</option>";
													}
													?>
												</select>
												<input id="huruf_2" type="hidden" name="huruf_2" value="<?php echo $k_2; ?>">
											</td>
										</tr>
									</table>
									<br>
									<table cellpadding="5" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Nilai TBP(Rp.):</strong></td>
										</tr>
										<tr>
											<td><input id="tpb_2" type="text" name="tpb_2" value="<?php echo (int)$nilai_k_2; ?>" readonly></td>
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
									<table width="100%" border="1" cellpadding="5" style="border-collapse:collapse">
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
									<table width="100%" border="1" cellpadding="5" style="border-collapse:collapse">
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
									<table cellpadding="5" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Kode:</strong></td>
											<td>
												<select id="3" name="3" onChange="return getNilai(this,'tpb_3','huruf_3',false,true,'3_rangkap');">
													<option value="0">-</option>
													<?php 
													$res = $db->query("SELECT nilai, kode FROM besaran_tpb_khusus WHERE k_1='3' AND kode IS NOT NULL GROUP BY k_1, k_2, k_3, kode ORDER BY id ASC");
													while($data=$db->fetchArray($res)){
														$selected = ($data[1] == $k_3)?"selected":"";
														echo "<option value=".$data[0]." ".$selected.">".$data[1]."</option>";
													}
													?>
												</select>
												<input id="huruf_3" type="hidden" name="huruf_3" value="<?php echo $k_3; ?>">
											</td>
										</tr>
									</table>
									<br>
									<table cellpadding="5" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Nilai TBP(Rp.):</strong></td>
										</tr>
										<tr>
											<td><input id="tpb_3" type="text" name="tpb_3" value="<?php echo (int)$nilai_k_3; ?>" readonly></td>
										</tr>
									</table>							
								</td>
							</tr>
						</table>
						<br>
						<table cellpadding="5" border="1" style="border-collapse:collapse">
							<tr>
								<td>Memiliki Rangkap Jabatan Tambahan?</td>
								<td>
									<select id="3_rangkap" name="3_rangkap" onChange="return hitung('3_rangkap',true,document.getElementById('3').value,'tpb_3');">
										<option value="0">TIDAK</option>
										<?php 
										$res = $db->query("SELECT nilai, kode FROM besaran_tpb_khusus WHERE k_1='3' AND kode IS NULL GROUP BY k_1, k_2, k_3, kode ORDER BY id ASC");
										while($data=$db->fetchArray($res)){
											$selected = ($k_3_rangkap <> 0)?"selected":"";
											echo "<option value=".$data[0]." ".$selected.">YA</option>";
										}
										?>
									</select>
								</td>
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
									<table width="100%" border="1" cellpadding="5" style="border-collapse:collapse">
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
									<table width="100%" border="1" cellpadding="5" style="border-collapse:collapse">
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
									<table cellpadding="5" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Kode:</strong></td>
											<td>
												<select id="4" name="4" onChange="return getNilai(this,'tpb_4','huruf_4',false,true,'4_rangkap');">
													<option value="0">-</option>
													<?php 
													$res = $db->query("SELECT nilai, kode FROM besaran_tpb_khusus WHERE k_1='4' AND kode IS NOT NULL GROUP BY k_1, k_2, k_3, kode ORDER BY id ASC");
													while($data=$db->fetchArray($res)){
														$selected = ($data[1] == $k_4)?"selected":"";
														echo "<option value=".$data[0]." ".$selected.">".$data[1]."</option>";
													}
													?>
												</select>
												<input id="huruf_4" type="hidden" name="huruf_4" value="<?php echo $k_4; ?>">
											</td>
										</tr>
									</table>
									<br>
									<table cellpadding="5" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Nilai TBP(Rp.):</strong></td>
										</tr>
										<tr>
											<td><input id="tpb_4" type="text" name="tpb_4" value="<?php echo (int)$nilai_k_4; ?>" readonly></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<br>
						<table cellpadding="5" border="1" style="border-collapse:collapse">
							<tr>
								<td>Memiliki Rangkap Indikator Risiko Kerja?</td>
								<td>
									<select id="4_rangkap" name="4_rangkap" onChange="return hitung('4_rangkap',true,document.getElementById('4').value,'tpb_4');">
										<option value="0">TIDAK</option>
										<?php 
										$res = $db->query("SELECT nilai, kode FROM besaran_tpb_khusus WHERE k_1='4' AND kode IS NULL GROUP BY k_1, k_2, k_3, kode ORDER BY id ASC");
										while($data=$db->fetchArray($res)){
											$selected = ($k_4_rangkap <> 0)?"selected":"";
											echo "<option value=".$data[0]." ".$selected.">YA</option>";
										}
										?>
									</select>
								</td>
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
									<table width="100%" border="1" cellpadding="5" style="border-collapse:collapse">
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
									<table width="100%" border="1" cellpadding="5" style="border-collapse:collapse">
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
									<table cellpadding="5" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Kode:</strong></td>
											<td>
												<select id="5" name="5" onChange="return getNilai(this,'tpb_5','huruf_5',false,true,'5_rangkap');">
													<option value="0">-</option>
													<?php 
													$res = $db->query("SELECT nilai, kode FROM besaran_tpb_khusus WHERE k_1='5' AND kode IS NOT NULL GROUP BY k_1, k_2, k_3, kode ORDER BY id ASC");
													while($data=$db->fetchArray($res)){
														$selected = ($data[1] == $k_5)?"selected":"";
														echo "<option value=".$data[0]." ".$selected.">".$data[1]."</option>";
													}
													?>
												</select>
												<input id="huruf_5" type="hidden" name="huruf_5" value="<?php echo $k_5; ?>">
											</td>
										</tr>
									</table>
									<br>
									<table cellpadding="5" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Nilai TBP(Rp.):</strong></td>
										</tr>
										<tr>
											<td><input id="tpb_5" type="text" name="tpb_5" value="<?php echo (int)$nilai_k_5; ?>" readonly></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<br>
						<table cellpadding="5" border="1" style="border-collapse:collapse">
							<tr>
								<td>Memiliki Rangkap Indikator Kegawatdaruratan?</td>
								<td>
									<select id="5_rangkap" name="5_rangkap" onChange="return hitung('5_rangkap',true,document.getElementById('5').value,'tpb_5');">
										<option value="0">TIDAK</option>
										<?php 
										$res = $db->query("SELECT nilai, kode FROM besaran_tpb_khusus WHERE k_1='5' AND kode IS NULL GROUP BY k_1, k_2, k_3, kode ORDER BY id ASC");
										while($data=$db->fetchArray($res)){
											$selected = ($k_5_rangkap <> 0)?"selected":"";
											echo "<option value=".$data[0]." ".$selected.">YA</option>";
										}
										?>
									</select>
								</td>
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
									<table width="100%" border="1" cellpadding="5" style="border-collapse:collapse">
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
									<table width="100%" border="1" cellpadding="5" style="border-collapse:collapse">
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
									<table cellpadding="5" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Kode:</strong></td>
											<td>
												<select name="6" onChange="return getNilai(this,'tpb_6','huruf_6',false,false,'');">
													<option value="0">-</option>
													<?php 
													$res = $db->query("SELECT nilai, kode FROM besaran_tpb_khusus WHERE k_1='6' GROUP BY k_1, k_2, k_3, kode ORDER BY id ASC");
													while($data=$db->fetchArray($res)){
														$selected = ($data[1] == $k_6)?"selected":"";
														echo "<option value=".$data[0]." ".$selected.">".$data[1]."</option>";
													}
													?>
												</select>
												<input id="huruf_6" type="hidden" name="huruf_6" value="<?php echo $k_6; ?>">
											</td>
										</tr>
									</table>
									<br>
									<table cellpadding="5" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Nilai TBP(Rp.):</strong></td>
										</tr>
										<tr>
											<td><input id="tpb_6" type="text" name="tpb_6" value="<?php echo (int)$nilai_k_6; ?>" readonly></td>
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
									<table width="100%" border="1" cellpadding="5" style="border-collapse:collapse">
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
									<table cellpadding="5" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Kode:</strong></td>
											<td>
												<select name="7" onChange="return getNilai(this,'tpb_7','huruf_7',false,false,'');">
													<option value="0">-</option>
													<?php 
													$res = $db->query("SELECT nilai, kode FROM besaran_tpb_khusus WHERE k_1='7' GROUP BY k_1, k_2, k_3, kode ORDER BY id ASC");
													while($data=$db->fetchArray($res)){
														$selected = ($data[1] == $k_7)?"selected":"";
														echo "<option value=".$data[0]." ".$selected.">".$data[1]."</option>";
													}
													?>
												</select>
												<input id="huruf_7" type="hidden" name="huruf_7" value="<?php echo $k_7; ?>">
											</td>
										</tr>
									</table>
									<br>
									<table cellpadding="5" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Nilai TBP(Rp.):</strong></td>
										</tr>
										<tr>
											<td><input id="tpb_7" type="text" name="tpb_7" value="<?php echo (int)$nilai_k_7; ?>" readonly></td>
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
								<table width="100%" border="1" cellpadding="5" style="border-collapse:collapse">
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
									<table cellpadding="5" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Kode:</strong></td>
											<td>
												<select name="8" onChange="return getNilai(this,'tpb_8','huruf_8',false,false,'');">
													<option value="0">-</option>
													<?php 
													$res = $db->query("SELECT nilai, kode FROM besaran_tpb_khusus WHERE k_1='8' GROUP BY k_1, k_2, k_3, kode ORDER BY id ASC");
													while($data=$db->fetchArray($res)){
														$selected = ($data[1] == $k_8)?"selected":"";
														echo "<option value=".$data[0]." ".$selected.">".$data[1]."</option>";
													}
													?>
												</select>
												<input id="huruf_8" type="hidden" name="huruf_8" value="<?php echo $k_8; ?>">
											</td>
										</tr>
									</table>
									<br>
									<table cellpadding="5" border="1" style="border-collapse:collapse">
										<tr>
											<td><strong>Nilai TBP(Rp.):</strong></td>
										</tr>
										<tr>
											<td><input id="tpb_8" type="text" name="tpb_8" value="<?php echo (int)$nilai_k_8; ?>" readonly></td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
					</table>				    
					<hr>
					<div align="center"><strong>Total TPB-Khusus SEBELUM DIKURANGI POTONGAN KETIDAKHADIRAN (Rp.): <span id="total" style="font-style:italic"><?php echo number_format((int)$total_tpb,0,',','.'); ?></span></strong></div></td>
					<input id="tot_tpb" type="hidden" name="tot_tpb" value="<?php echo (int)$total_tpb; ?>">
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
										<table cellpadding="5" border="1" style="border-collapse:collapse">
											<tr>
												<td><strong>Jumlah Ketidakhadiran (Hari): </strong></td>
												<td><input id="tidak_hadir" type="text" name="tidak_hadir" value="<?php echo (int)$tidak_hadir; ?>" onChange="if(this.value==''){this.value=0; getNilai(this,'potongan','',true,false,'');} else {getNilai(this,'potongan','',true,false,'');}"></td>
											</tr>
										</table>
									</div>
								</td>
								<td><div align="center"></div></td>
								<td>
									<div align="center">
										<table cellpadding="5" border="1" style="border-collapse:collapse">
											<tr>
												<td><strong>Potongan (Rp.): </strong></td>
												<td><input id="potongan" type="text" name="potongan" value="<?php echo (int)$potongan; ?>" readonly></td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
						</table>
						<hr>
						<div align="center"><strong>TOTAL TPB-Khusus (KOTOR) YANG DITERIMA (Rp.): <span id="total_kotor" style="font-style:italic"><?php echo number_format((int)$total_tpb_kotor,0,',','.'); ?></span> </strong></div>
						<input id="tot_tpb_kotor" type="hidden" name="tot_tpb_kotor" value="<?php echo (int)$total_tpb_kotor; ?>">
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
	<tr><td align='center'>
	<input type="submit" name="aksi" class="button biru" value="Simpan" id="simpan" >&nbsp;
	<input type="submit" name="aksi" class="button biru" value="Cetak" id="cetak" ></td></tr>
</table>
</form>
<br/><br/>&nbsp;
	<script language="javascript">	
	document.getElementById('tidak_hadir').onkeypress=function(e){
		var e=window.event || e ;
		var keyunicode=e.charCode || e.keyCode;
		return (keyunicode>=48 && keyunicode<=57 || keyunicode==8 ||keyunicode==32)? true : false;
	}
	function formatCurrency(num) {
		num = Math.round(num/100)*100;
		num = num.toString().replace(/\$|\,/g,'');
		
		if(isNaN(num))
			num = "0";
		
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		
		if(cents<10)
			cents = "0" + cents;
		
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
			num = num.substring(0,num.length-(4*i+3))+'.'+num.substring(num.length-(4*i+3));
			
		return (((sign)?'':'-') + '' + num);
	}

	function getNilai(x,id,id_huruf,potong,tambahan,id_tambahan) {
		if(potong){
			document.getElementById(id).value = parseFloat(x.value)*(parseFloat(document.getElementById('tot_tpb').value)*5/100);
			hitung('',false,'','');
		} else {
			var huruf = x.options[x.selectedIndex].text;
			document.getElementById(id_huruf).value = huruf;
			if(tambahan){
				hitung(id_tambahan,true,x.value,id);
			} else {
				document.getElementById(id).value = parseFloat(x.value);
				hitung('',false,'','');
			}
		}
	}
	function hitung(id,tambah,id_select,id_text) {
		if(tambah){
			if(id_select != 0){
				document.getElementById(id_text).value = parseFloat(document.getElementById(id).value) + parseFloat(id_select);
			} else {
				document.getElementById(id_text).value = 0;
			}
		}	
		var a = parseFloat(document.getElementById('tpb_1_1').value);
		var b = parseFloat(document.getElementById('tpb_1_2').value);
		var c = parseFloat(document.getElementById('tpb_2').value);
		var d = parseFloat(document.getElementById('tpb_3').value);
		var f = parseFloat(document.getElementById('tpb_4').value);
		var h = parseFloat(document.getElementById('tpb_5').value);
		var j = parseFloat(document.getElementById('tpb_6').value);
		var k = parseFloat(document.getElementById('tpb_7').value);
		var l = parseFloat(document.getElementById('tpb_8').value);
		document.getElementById('total').innerHTML = formatCurrency(a+b+c+d+f+h+j+k+l);
		document.getElementById('tot_tpb').value = a+b+c+d+f+h+j+k+l;
		
		document.getElementById('potongan').value = potongan(parseFloat(document.getElementById('tidak_hadir').value));
		
		var m = parseFloat(document.getElementById('potongan').value);
		document.getElementById('total_kotor').innerHTML = formatCurrency(a+b+c+d+f+h+j+k+l-m);
		document.getElementById('tot_tpb_kotor').value = a+b+c+d+f+h+j+k+l-m;
	}
	function potongan(x){
		switch(x){
			case 0 : return 0; break;
			case 1 : return parseFloat(document.getElementById('tot_tpb').value)*5/100; break;
			case 2 : return parseFloat(document.getElementById('tot_tpb').value)*10/100; break;
			case 3 : return parseFloat(document.getElementById('tot_tpb').value)*15/100; break;
			case 4 : return parseFloat(document.getElementById('tot_tpb').value)*20/100; break;
			case 5 : return parseFloat(document.getElementById('tot_tpb').value)*25/100; break;
			case 6 : return parseFloat(document.getElementById('tot_tpb').value)*30/100; break;
			case 7 : return parseFloat(document.getElementById('tot_tpb').value)*40/100; break;
			case 8 : return parseFloat(document.getElementById('tot_tpb').value)*50/100; break;
			case 9 : return parseFloat(document.getElementById('tot_tpb').value)*60/100; break;
			case 10 : return parseFloat(document.getElementById('tot_tpb').value)*70/100; break;
			case 11 : return parseFloat(document.getElementById('tot_tpb').value)*80/100; break;
			default : return parseFloat(document.getElementById('tot_tpb').value); break;
		}
	}
	</script>
<?php
}	
?>		
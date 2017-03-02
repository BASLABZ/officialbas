<?php

	$idskpd = $this->db->esc($_POST['skpd']);
	
	$res = $this->db->query("SELECT skpd FROM skpd WHERE id = '".$idskpd."'");
	list($skpd) = $this->db->fetchRow($res);
	
	$res = $this->db->query("SELECT hari, jam 
							FROM setting 
							WHERE 
								skpd = '".$idskpd."' AND 
								bulan = '".$this->db->esc($_POST['bulan'])."' AND 
								tahun = '".$this->db->esc($_POST['tahun'])."'");
	list($hari, $jam) = $this->db->fetchRow($res);
	
	$res = $this->db->query("SELECT tgl, bln, thn, nama1, nip1, nama2, nip2, nama3, nip3 FROM rekap WHERE skpd = '".$idskpd."' AND bulan = '".$this->db->esc($_POST['bulan'])."' AND tahun = '".$this->db->esc($_POST['tahun'])."'");
	list($tgl, $bln, $thn, $nama1, $nip1, $nama2, $nip2, $nama3, $nip3) = $this->db->fetchRow($res);

	$res = $this->db->query("SELECT tgl, bln, thn, nama1, nip1, nama2, nip2, nama3, nip3 FROM rekap WHERE skpd = '".$idskpd."' AND bulan = '".$this->db->esc($_POST['bulan'])."' AND tahun = '".$this->db->esc($_POST['tahun'])."'");
	list($tgl, $bln, $thn, $nama1, $nip1, $nama2, $nip2, $nama3, $nip3) = $this->db->fetchRow($res);

	$sql ="select 
			`nama_kepala` ,
			`nip_kepala` ,
			`nama_bendahara` ,
			`nip_bendahara` ,
			`nama_petugas` ,
			`nip_petugas`  
			from 
				setting
			where 
				skpd = '".$this->db->esc($_POST['skpd'])."' and
				bulan = '".$this->db->esc($_POST['bulan'])."' and
				tahun = '".$this->db->esc($_POST['tahun'])."'";
	$res = $this->db->query($sql);			
	list($namakepala, $nipkepala, $namabendahara, $nipbendahara, $namapetugas, $nippetugas) = $this->db->fetchRow($res);			
		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>REKAP TPB <?php echo $skpd; ?></title>
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
<table align="center" cellpadding="5" cellspacing="0">
	
	<tr>
		<td align="center"><strong>PEMERINTAH PROVINSI PAPUA<br>
	    DAFTAR REKAPITULASI PENERIMAAN PEMBAYARAN TUNJANGAN PENGHASILAN BERSYARAT KHUSUS (TPB KHUSUS) PNS </strong></td>
	</tr>
	<tr>
		<td>
			<br/>
			<table align="center" cellpadding="5" cellspacing="0">
				<tr>
					<td nowrap>Unit Kerja/SKPD</td>
					<td>:</td>
					<td width="100%"><?php echo $skpd; ?></td>
					<td rowspan="4"><img src="img/papua.png"></td>
				</tr>
				<tr>
					<td nowrap>Bulan/Tahun</td>
					<td>:</td>
					<td><?php echo $this->util->longMonth[$_POST['bulan']]."/".$_POST['tahun']; ?></td>
				</tr>
				<tr>
					<td height="100%">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				</tr>
				<tr>
					<td height="100%">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
    </table>
	<table align="center" cellpadding="4" cellspacing="0" border="1" style="border-width:0px 0px 0px 0px ">
		<thead>
		  	<tr>
	    		<th class="biru" width="30px">No.</th>
	    		<th class="biru">Nama Pegawai</th>
				<th class="biru">NIP</th>
				<th class="biru">Pangkat/Golongan</th>
				<th class="biru">Jabatan</th>
				<th class="biru">Total TPB<br>(Kotor)</th>
				<th class="biru">Potongan</th>
				<th class="biru">Jumlah TPB<br>(Bersih)</th>
				<th rowspan="2" nowrap style="border-right-style:solid ">Tanda Tangan Penerima</th>
        	</tr>
		</thead>
		<tbody>
		<?php	
		$sql = "
				SELECT 
								p.nama, p.eselon, g.urut, t.nip, t.golongan, t.jabatan, 
								t.status, t.subunit, SUM(t.total_tpb) as totaltpb, 
								SUM(t.potongan) as totalpotongan, SUM(t.total_tpb_kotor) as totaltpbkotor
						FROM 
							tpb_khusus t JOIN golongan g 
								ON 
									t.golongan = g.golong
							JOIN pegawai p
								ON
									p.nip = t.nip  
						WHERE 
							t.bulan = '".$this->db->esc($_POST["bulan"])."' AND 
							t.tahun = '".$this->db->esc($_POST["tahun"])."' AND 
							t.skpd = '".$this->db->esc($idskpd)."' 
						GROUP BY 
							t.nip
						ORDER BY 
							if(eselon='-',1,0) ,
							eselon,
							urut ,
							t.nip,
							`status` desc";
		$res = $this->db->query($sql); 
		if($this->db->numRows($res) > 0){
				$no = 1;
				while($data = $this->db->fetchArray($res)){
	
					echo '<tr>
							<td class="td1">'.$no.'</td>
							<td>'.$data['nama'].'</td>
							<td>'.$data['nip'].'</td>
							<td>'.$data['golongan'].'</td>
							<td>'.$data['jabatan'].'</td>
							<td align="right">'.$this->util->duit_rp($data['totaltpb']).'</td>
							<td align="right">'.$this->util->duit_rp($data['totalpotongan']).'</td>
							<td align="right">'.$this->util->duit_rp($data['totaltpbkotor']).'</td>
							<td>&nbsp;</td>
						  </tr>';
					$no++;
					$total_kotor += $data['totaltpb']; 
					$total_potongan += $data['totalpotongan'];
					$total_bersih += $data['totaltpbkotor'];
				}
			}else{
				echo '<tr><td class="td1" colspan="9">Data Kosong</td></tr>';	
			}
		?>		
				
			<tr>
					<td colspan="5" align="center">Jumlah (Rp)</td>
					<td align="right"><?php echo $this->util->duit($total_kotor); ?></td>
					<td align="right"><?php echo $this->util->duit($total_potongan); ?></td>
					<td align="right"><?php echo $this->util->duit($total_bersih); ?></td>
					<td>&nbsp;</td>
			</tr>
			<tr>
					<td colspan="2" align="center"><em>TERBILANG</em></td>
					<td colspan="7"><?php echo ucwords($this->util->terbilang($total_kotor)); ?></td>
			</tr>

		</tbody>
    </table>	
    <div class="page"></div>
    <br><br>
    	<table align="center" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="center" width="33%">MENGETAHUI/MENYETUJUI</td>
			<td align="center" width="33%">&nbsp;</td>
			<td align="center" width="33%">Jayapura, <?php echo $tgl." ".$util->longMonth[$bln]." ".$thn; ?></td>
		</tr>
		<tr>
			<td align="center">PENGGUNA ANGGARAN/KEPALA SKPD, </td>
			<td align="center">BENDAHARA,</td>
			<td align="center">PEMBUAT DAFTAR REKAPITULASI TPB,</td>
		</tr>
		<tr>
			<td colspan="3"><br><br><br><br><br></td>
		</tr>
		<tr>
			<td align="center"><u><?php echo $namakepala; ?></u></td>
			<td align="center"><u><?php echo $namabendahara; ?></u></td>
			<td align="center"><u><?php echo $namapetugas; ?></u></td>
		</tr>
		<tr>
			<td align="center">NIP. <?php echo $nipkepala; ?></td>
			<td align="center">NIP. <?php echo $nipbendahara; ?></td>
			<td align="center">NIP. <?php echo $nippetugas; ?></td>
		</tr>
	</table>
		

</center>
</body>

<script>
	window.print();
</script>
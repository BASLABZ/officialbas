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

	$tgl = date("j");
	$bln = date("n");
	$thn = date("Y");			
		
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
	    DAFTAR REKAPITULASI PENERIMAAN PEMBAYARAN TUNJANGAN PENGHASILAN BERSYARAT (TPB) PNS</strong></td>
	</tr>
	<tr>
		<td>
			<table align="center" cellpadding="5" cellspacing="0">
				<tr>
					<td>Unit Kerja/SKPD</td>
					<td>:</td>
					<td width="100%"><?php echo $skpd; ?></td>
					<td rowspan="4"><img src="img/papua.png"></td>
				</tr>
				<tr>
					<td>Bulan/Tahun</td>
					<td>:</td>
					<td><?php echo $this->util->longMonth[$_POST['bulan']]." / ".$_POST['tahun']; ?></td>
				</tr>
				<tr>
					<td>Jumlah Hari Kerja</td>
					<td>:</td>
					<td><?php echo $hari; ?> Hari</td>
				</tr>
				<tr>
					<td nowrap>Jumlah Jam Kerja/Hari</td>
					<td>:</td>
					<td><?php echo $jam; ?> Jam</td>
				</tr>
			</table>
		</td>
	</tr>
    </table>
	<table align="center" cellpadding="4" cellspacing="0" border="1" style="border-width:0px 0px 0px 0px ">
		<thead>
			<tr>
				<th rowspan="2" style="border-width:1px 1px 1px 1px; border-style:solid" width="25px" align="left">No</th>
				<th rowspan="2" nowrap>Nama Pegawai</th>
				<th rowspan="2">NIP</th>
				<th rowspan="2">Pangkat/Golongan</th>
				<th rowspan="2">Jabatan</th>
				<th rowspan="2">TPB</th>
				<th colspan="3">TPB</th>
				<th colspan="2">Pajak (PPh) </th>
				<th rowspan="2">Jumlah TPB <br>
				(Bersih)</th>
				<th rowspan="2" nowrap style="border-right-style:solid ">Tanda Tangan Penerima</th>
		  	</tr>
			<tr>
				<th>Disiplin</th>
				<th>Kinerja</th>
				<th>Total TPB <br>
				(Kotor)</th>
				<th>%</th>
				<th>Potongan</th>
			</tr>
		</thead>
		<tbody>
		<?php

			$sql = "
					SELECT 
					p.nama, p.tpb,p.eselon,urut,v.nip,v.golongan, v.pangkat, v.gol1, v.gol2, 
					v.jabatan, v.`status`, v.subunit, sum(total_tpb) as totaltpb, 
					sum(potongan) as potongan, sum(tambahan) as tambahan, pajak 						
				FROM (
					(
						SELECT 
							urut,nip,golongan, form04.pangkat, 
							gol1, gol2, jabatan, subunit, `status`, 
							(total_tpb*persen_disiplin/100)-potongan+tambahan as total_tpb, (total_tpb*persen_disiplin/100-potongan) as potongan, 
							tambahan, pajak 
						FROM 
							form04,golongan 
						WHERE 
							golong=golongan AND 
							bulan = '".$_POST['bulan']."' AND 
							tahun = '".$_POST['tahun']."' AND 	
							skpd = '".$idskpd."'
					)	UNION
					(
						SELECT 
							urut,nip, golongan,form05.pangkat, 
							gol1, gol2, jabatan, subunit,`status`, 	
							(total_tpb*persen_disiplin/100)-potongan+tambahan as total_tpb, (total_tpb*persen_disiplin/100-potongan) as potongan, 
							tambahan, pajak 
						FROM 
							form05,golongan 
						WHERE 
							golong=golongan AND 
							bulan = '".$_POST['bulan']."' AND 
							tahun = '".$_POST['tahun']."' AND 
							skpd = '".$idskpd."'
					)
				  ) as v 
				join 
			  		pegawai p  
			  		on 
			  		p.nip = v.nip
					GROUP BY  
						nip 
					order by 
						if(eselon='-',1,0) ,
						eselon, 
						urut,
						p.nip,
						`status`
			";
			
			/*
			$sql = "
					SELECT urut, nip, golongan, pangkat, gol1, gol2, jabatan, status, subunit, sum(total_tpb), sum(potongan), sum(tambahan), pajak 
						FROM 
						(
							(SELECT urut,nip,golongan, form04.pangkat, gol1, gol2, jabatan, subunit, status, total_tpb, (total_tpb*persen_disiplin/100-potongan) as potongan, tambahan, pajak 
							FROM form04,golongan WHERE golong=golongan AND bulan = ".$_POST['bulan']." AND tahun = '".$_POST['tahun']."' AND skpd = '".$idskpd."') 
							UNION 
							(SELECT urut,nip, golongan,form05.pangkat, gol1, gol2, jabatan, subunit,status, total_tpb, (total_tpb*persen_disiplin/100-potongan) as potongan, tambahan, pajak 
							FROM form05,golongan WHERE golong=golongan AND bulan = ".$_POST['bulan']." AND tahun = '".$_POST['tahun']."' AND skpd = '".$idskpd."')
						) as t1 GROUP BY nip order by urut desc
					";
			echo($sql);		
			*/
			$res = $this->db->query($sql);
						
			if($this->db->numRows($res) > 0){
				$no = 1;
				while($data = $this->db->fetchArray($res)){
					$kotor = $data['tambahan'] + $data['potongan'];
					$pajak = $kotor * $data['pajak']/100;
					$bersih = $kotor - $pajak;
					echo '<tr>
							<td>'.$no.'</td>
							<td>'.$data['nama'].'</td>
							<td>'.$data['nip'].'</td>
							<td>'.$data['golongan'].'</td>
							<td>'.$data['jabatan'].'</td>
							<td>'.$this->util->duit($data['tpb']).'</td>
							<td>'.$this->util->duit($data['potongan']).'</td>
							<td>'.$this->util->duit($data['tambahan']).'</td>
							<td>'.$this->util->duit($data['totaltpb']).'</td>
							<td>'.$data['pajak'].'</td>
							<td>'.$this->util->duit($pajak).'</td>
							<td>'.$this->util->duit($bersih).'</td>
							<td> &nbsp; </td>
						  </tr>';
					
					$no++;
					// die($this->db->numRows($this->res).'sapi');
					$total_potongan += $data['tpb'];
					$total_tambahan += $data['potongan'];
					$total_kotor += $kotor; 
					$total_pajak += $pajak;
					$total_bersih += $bersih;
				}
			}else{
				echo '<tr><td class="td1" colspan="12">Data Kosong</td></tr>';	
			}
				
			?>
			<tr>
				<td colspan="6" align="center">Jumlah (Rp)</td>
				<td align="right"><?php echo $this->util->duit($total_potongan); ?></td>
				<td align="right"><?php echo $this->util->duit($total_tambahan); ?></td>
				<td align="right"><?php echo $this->util->duit($total_kotor); ?></td>
				<td align="right">&nbsp;</td>
				<td align="right"><?php echo $this->util->duit($total_pajak); ?></td>
				<td align="right"><?php echo $this->util->duit($total_bersih); ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><em>TERBILANG</em></td>
				<td colspan="11" style="border-right-style:solid "><?php echo ucwords($this->util->terbilang($total_kotor)); ?></td>
			</tr>
		</tbody>
    </table>	
    <div class="page"></div>
	<table align="center" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="center" width="33%">MENGETAHUI/MENYETUJUI</td>
			<td align="center" width="33%">&nbsp;</td>
			<td align="center" width="33%">Jayapura, <?php echo $tgl." ".$this->util->longMonth[$bln]." ".$thn; ?></td>
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
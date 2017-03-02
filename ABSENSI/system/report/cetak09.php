<?php
set_time_limit(0);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
date_default_timezone_set("Asia/Jayapura");
session_start();
define("WEWE", 1, 1);
require_once('../../inc/cache-control.php');
require_once('../../lib/CFactory.php');
$db = CFactory::getDBO();
$util = CFactory::getUO();

$idskpd=$_SESSION['sesi_idskpd'];
$sskpd=$_SESSION['sesi_skpd'];
$_POST['bulan'] = $_SESSION['sesi_bulan'];
$_POST['tahun'] = $_SESSION['sesi_tahun'];
$_POST['skpd'] = $idskpd;
$_POST['lanjut'] = "Lanjut";

if(!empty($_POST['lanjut'])) {
	$db->query("SELECT skpd FROM skpd WHERE id = '".$idskpd."'");
	list($skpd) = $db->fetchRow();
	
	$db->query("SELECT hari, jam FROM setting WHERE skpd = '".$idskpd."' AND bulan = '".$_POST['bulan']."' AND tahun = '".$_POST['tahun']."'");
	list($hari, $jam) = $db->fetchRow();
	
	$db->query("SELECT tgl, bln, thn, nama1, nip1, nama2, nip2, nama3, nip3 FROM rekap WHERE skpd = '".$idskpd."' AND bulan = '".$_POST['bulan']."' AND tahun = '".$_POST['tahun']."'");
	list($tgl, $bln, $thn, $nama1, $nip1, $nama2, $nip2, $nama3, $nip3) = $db->fetchRow();
		
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
	<?php
	if($_SESSION['tpb'] == 'umum') {
	?>
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
					<td rowspan="4"><img src="../../images/papua.png"></td>
				</tr>
				<tr>
					<td>Bulan/Tahun</td>
					<td>:</td>
					<td><?php echo $util->longMonth[$_POST['bulan']]." / ".$_POST['tahun']; ?></td>
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
			$db->query("SELECT urut, nip, golongan, pangkat, gol1, gol2, jabatan, status, subunit, sum(total_tpb), sum(potongan), sum(tambahan), pajak 
						FROM 
						(
							(SELECT urut,nip,golongan, form04.pangkat, gol1, gol2, jabatan, subunit, status, total_tpb, (total_tpb*persen_disiplin/100-potongan) as potongan, tambahan, pajak 
							FROM form04,golongan WHERE golong=golongan AND bulan = ".$_POST['bulan']." AND tahun = '".$_POST['tahun']."' AND skpd = '".$idskpd."') 
							UNION 
							(SELECT urut,nip, golongan,form05.pangkat, gol1, gol2, jabatan, subunit,status, total_tpb, (total_tpb*persen_disiplin/100-potongan) as potongan, tambahan, pajak 
							FROM form05,golongan WHERE golong=golongan AND bulan = ".$_POST['bulan']." AND tahun = '".$_POST['tahun']."' AND skpd = '".$idskpd."')
						) as t1 GROUP BY nip order by urut desc");
			$data = $db->fetchRows();			
			
			for($i=0; $i<count($data); $i++) {
				$db->query("SELECT nama, tpb FROM pegawai WHERE nip = '".$data[$i][1]."'");
				list($nama, $tpb) = $db->fetchRow();
		?>
			<tr>
				<td align="right"><?php echo ++$no;?></td>
				<td><?php echo $nama; ?></td>
				<td><?php echo $data[$i][1]; ?></td>
				<td><?php echo $data[$i][2]; ?></td>
				<td><?php echo $data[$i][6]; ?></td>
				<td><?php echo $util->duit($tpb); ?></td>
				<td align="right"><?php echo $util->duit($data[$i][10]); ?></td>
				<td align="right"><?php echo $util->duit($data[$i][11]); ?></td>
				<?php $kotor = $data[$i][10] + $data[$i][11]; ?>
				<td align="right"><?php echo $util->duit($kotor); ?></td>
				<td align="center"><?php echo $data[$i][12]; ?>%</td>
				<?php $pajak = $kotor * $data[$i][12]/100; ?>
				<td align="right"><?php echo $util->duit($pajak); ?></td>
				<?php $bersih = $kotor - $pajak; ?>
				<td align="right"><?php echo $util->duit($bersih); ?></td>
				<td style="border-right-style:solid ">&nbsp;<br><br><br></td>
			</tr>
			<?php
				$total_potongan += $data[$i][10];
				$total_tambahan += $data[$i][11];
				$total_kotor += $kotor; 
				$total_pajak += $pajak;
				$total_bersih += $bersih;
			} ?>
			<tr>
				<td colspan="6" align="center">Jumlah (Rp)</td>
				<td align="right"><?php echo $util->duit($total_potongan); ?></td>
				<td align="right"><?php echo $util->duit($total_tambahan); ?></td>
				<td align="right"><?php echo $util->duit($total_kotor); ?></td>
				<td align="right">&nbsp;</td>
				<td align="right"><?php echo $util->duit($total_pajak); ?></td>
				<td align="right"><?php echo $util->duit($total_bersih); ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><em>TERBILANG</em></td>
				<td colspan="11" style="border-right-style:solid "><?php echo ucwords($util->terbilang($total_kotor)); ?></td>
			</tr>
		</tbody>
    </table>
	<?php 
	} else {
	?>
	<tr>
		<td align="center"><strong>PEMERINTAH PROVINSI PAPUA<br>
	    DAFTAR REKAPITULASI PENERIMAAN PEMBAYARAN TAMBAHAN PENGHASILAN BERSYARAT KHUSUS (TPB KHUSUS)</strong></td>
	</tr>
	<tr>
		<td>
			<table align="center" cellpadding="5" cellspacing="0">
				<tr>
					<td nowrap>Unit Kerja/SKPD</td>
					<td>:</td>
					<td width="100%"><?php echo $sskpd; ?></td>
					<td rowspan="4"><img src="../../images/papua.png"></td>
				</tr>
				<tr>
					<td nowrap>Bulan/Tahun</td>
					<td>:</td>
					<td><?php echo $util->longMonth[$_POST['bulan']]."/".$_POST['tahun']; ?></td>
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
	<table align="center" cellpadding="5" cellspacing="0" border="1" style="border-width:0px 0px 0px 0px ">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Pegawai</th>
				<th>NIP</th>
				<th>Pangkat/Golongan</th>
				<th>Jabatan</th>
				<th>Total TPB<br>(Kotor)</th>
				<th>Potongan</th>
				<th>Jumlah TPB<br>(Bersih)</th>
				<th>Tanda Tangan Penerima</th>
		  	</tr>
		</thead>
		<tbody>
		<?php
			$db->query("SELECT g.urut, t.nip, t.golongan, t.jabatan, t.status, t.subunit, SUM(t.total_tpb), SUM(t.potongan), SUM(t.total_tpb_kotor) ".
						"FROM tpb_khusus AS t ".
						"JOIN golongan AS g ".
						"ON (t.golongan = g.golong) ".
						"WHERE t.bulan = ".$_POST['bulan']." AND t.tahun = ".$_POST['tahun']." AND t.skpd = ".$idskpd." ".
						"GROUP BY t.nip ".
						"ORDER BY g.urut DESC");
			$data = $db->fetchRows();
			for($i=0; $i<count($data); $i++) {
				$db->query("SELECT nama, eselon FROM pegawai WHERE nip = '".$data[$i][1]."'");
				list($nama,$eselon) = $db->fetchRow();
				$num_rows = $db->numRows();
		?>
			<tr>
				<td align="right"><?php echo ++$no; ?>.</td>
				<td><?php echo $nama?></td>
				<td><?php echo $data[$i][1]; ?></td>
				<td><?php echo $data[$i][2]; ?></td>
				<td><?php echo $data[$i][3]; ?></td>
				<td align="right"><?php echo $util->duit($data[$i][6]); ?></td>
				<td align="right"><?php echo $util->duit($data[$i][7]); ?></td>
				<td align="right"><?php echo $util->duit($data[$i][8]); ?></td>
				<td align="right">&nbsp;<br><br><br></td>
		  	</tr>
			<?php
				$total_kotor += $data[$i][6]; 
				$total_potongan += $data[$i][7];
				$total_bersih += $data[$i][8];
			} ?>
			<tr>
				<td colspan="5" align="center">Jumlah (Rp)</td>
				<td align="right"><?php echo $util->duit($total_kotor); ?></td>
				<td align="right"><?php echo $util->duit($total_potongan); ?></td>
				<td align="right"><?php echo $util->duit($total_bersih); ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><em>TERBILANG</em></td>
				<td colspan="7"><?php echo ucwords($util->terbilang($total_kotor)); ?></td>
			</tr>
		</tbody>
	</table>
	<?php
	}
	?>
    <div class="page"></div>
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
			<td align="center"><u><?php echo $nama1; ?></u></td>
			<td align="center"><u><?php echo $nama2; ?></u></td>
			<td align="center"><u><?php echo $nama3; ?></u></td>
		</tr>
		<tr>
			<td align="center">NIP. <?php echo $nip1; ?></td>
			<td align="center">NIP. <?php echo $nip2; ?></td>
			<td align="center">NIP. <?php echo $nip3; ?></td>
		</tr>
	</table>
		
<?php	
} 
?>
</center>
</body>

<script>
	window.print();
</script>
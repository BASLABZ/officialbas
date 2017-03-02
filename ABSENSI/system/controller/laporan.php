<?php
class laporan extends Controller
{
	function __construct(){
		parent::__construct();
		$this->ceklogin();
		$this->library("CUtilities");
		$this->util = new CUtilities();
		$this->library("date");
		$this->dt = new DateClass;
		ini_set("memory_limit","256M");
		$this->init();	
	}
	function init(){
		$mode = ($_POST['mode'])?$_POST['mode']:$_GET['mode'];
		switch($mode){
			case 'bulanan':
				$this->laporan_bulanan();
			break;
			case 'harian':
				$this->laporan_harian();
			break;
			case 'ambil_harian':
				$this->ambil_harian();
			break;
			case 'ambil_bulanan':
				$this->ambil_bulanan();
			break;
			case 'ambil_perorangan':
				$this->ambil_perorangan();
			break;
			case 'perorangan':
				$this->perorangan();
			break;
			case 'optpegawai':
				$this->optPegawai();
			break;
			case 'data_perorangan':
				$this->data_perorangan();
			break;
			case 'formproses';
				$this->formproses();
			break;
			case 'prosesdata':
				$this->prosesdata();
			break;
			case 'cetak_bulanan':
				$this->cetak_bulanan();
			break;
			case 'cetak_perorangan':
				$this->cetak_perorangan();
			break;
			case 'libur':
				$this->libur();
			break;	
			case 'ambil_datalibur':
				$this->ambil_datalibur();
			break;
			case 'cetak_libur':
				$this->cetak_libur();
			break;
			case 'cetak_harian':
				$this->cetak_harian();
			break;
			case 'rekap':
				$this->laporan_rekap();
			break;
			case 'ambil_rekap':
				$this->ambil_rekap();
			break;
			case 'cetak_rekap':
				$this->cetak_rekap();	
			break;	
		}
	}

	function laporan_rekap(){
		$this->template('laporan_rekap','admin');
	}
	function cetak_rekap(){
		$sumday = $this->dt->jumlah_hari($_GET['tahun'],$_GET['bulan']);

		$sql = "select skpd from skpd where id = '".$this->db->esc($_GET['kodeskpd'])."'";

		$res = $this->db->query($sql);
		$data = $this->db->fetchArray($res);
		$this->dtpres['skpd'] = $data['skpd'];

		$this->data['table'] = '<table class="tabdata zebra" border="1">
					<thead>
					<tr>
						<th class="biru" width="30px" rowspan="2">No.</th>
            			<th class="biru" rowspan="2">Nama</th>
            			<th class="biru" rowspan="2">NIP</th>
            			<th class="biru" rowspan="2">Pangkat/Golongan</th>
            			<th class="biru" rowspan="2">Jabatan</th>
            			<th class="biru" colspan="11">Uraian</th>
            			<th class="biru" rowspan="2" width="50px">Jumlah Hari Kerja</th>
            		</tr>
            		<tr>
            			<th class="biru" width="20px">HD</th>
            			<th class="biru" width="20px">TL</th>
            			<th class="biru" width="20px">PL</th>
            			<th class="biru" width="20px">TP</th>
            			<th class="biru" width="20px">AS</th>
            			<th class="biru" width="20px">I</th>
            			<th class="biru" width="20px">S</th>
            			<th class="biru" width="20px">DL</th>
            			<th class="biru" width="20px">C</th>
            			<th class="biru" width="20px">TB</th>
            			<th class="biru" width="20px">TH</th>
            		</tr>
            		</thead>';
        $sql = "select r.*,p.nama,p.golongan,p.jabatan from presensi_rekap r join pegawai p on (r.nip = p.nip)
												join golongan g on (p.golongan = g.golong)
													where r.bulan = '".$this->db->esc($_GET['bulan'])."' and
													r.tahun = '".$this->db->esc($_GET['tahun'])."' and
													r.skpd = '".$this->db->esc($_GET['kodeskpd'])."'
											order by 
											if(p.eselon = '-',1,0),
											p.eselon,g.urut,p.nip,if(p.status = 'pns',0,1)";
		$res = $this->db->query($sql);
		$nrw = $this->db->numRows($res);
		if($nrw > 0){
			$no = 1;
			while($data = $this->db->fetchArray($res)){
				$this->data['table'] .= '<tr><td class="td1">'.$no.'</td>
						  				  <td width="160px">'.$data['nama'].'</td>
										  <td width="160px">'.$this->util->formatNIP($data['nip']).'</td>
										  <td width="160px">'.$data['golongan'].'</td>
										  <td width="160px">'.$data['jabatan'].'</td>';
				$M = 0; $TL = 0; $PL = 0; $TP = 0; $AS = 0; $I = 0;
				$S = 0; $DL = 0; $C = 0; $TB = 0; $TH = 0;
				for($i=1;$i <= $sumday;$i++){
					$field = ''.$i.'_status';
					
					switch ($data[$field]) {
						case 'M':
							$M++;
						break;
						case 'TL':
							$TL++;
						break;
						case 'PL':
							$PL++;
						break;
						case 'TP':
							$TP++;
						break;
						case 'AS':
							$AS++;
						break;
						case 'I':
							$I++;
						break;
						case 'S':
							$S++;
						break;
						case 'DL':
							$DL++;
						break;
						case 'C':
							$C++;
						break;
						case 'TB':
							$TB++;
						break;
						case 'TH':
							$TH++;
						break;
					}
						
				}
				$this->data['table'] .= '<td class="td1">'.$M.'</td>
						<td class="td1">'.$TL.'</td>
						<td class="td1">'.$PL.'</td>
						<td class="td1">'.$TP.'</td>
						<td class="td1">'.$AS.'</td>
						<td class="td1">'.$I.'</td>
						<td class="td1">'.$S.'</td>
						<td class="td1">'.$DL.'</td>
						<td class="td1">'.$C.'</td>
						<td class="td1">'.$TB.'</td>
						<td class="td1">'.$TH.'</td>';
				$this->data['table'] .= '<td class="td1">'.$data['jml_harikerja'].'</td></tr>';
				$no++;
			}
		}
		$this->data['table'] .= '</table>';
		//die($this->data['table']);
		include("mpdf/mpdf.php");
		
		$this->data['bulan'] = $this->db->esc($_GET['bulan']);
		$this->data['tahun'] = $this->db->esc($_GET['tahun']);
		$this->data['kodeskpd'] = $this->db->esc($_GET['kodeskpd']);
		$this->data['jumlah'] = $this->dt->jumlah_hari($_GET['tahun'],$_GET['bulan']);
		
		$html = $this->parse_report('presensi_rekap');
		
		$mpdf=new mPDF('','A4-L', 0, '', 15, 15, 50, 55, 9, 9);
		$stylesheet = file_get_contents('css/cssreport.css');
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->WriteHTML($html,2);
		
		// $mpdf->WriteHTML('<pagebreak />');
		// $mpdf->WriteHTML('<pagebreak />');
		$mpdf->Output();
		
		exit;
	}
	function ambil_rekap(){
		$sumday = $this->dt->jumlah_hari($_POST['tahun'],$_POST['bulan']);
		echo '<table class="tabdata zebra">
					<tr>
						<th class="biru" width="30px" rowspan="2">No.</th>
            			<th class="biru" rowspan="2">Nama</th>
            			<th class="biru" rowspan="2">NIP</th>
            			<th class="biru" rowspan="2">Pangkat/Golongan</th>
            			<th class="biru" rowspan="2">Jabatan</th>
            			<th class="biru" colspan="11">Uraian</th>
            			<th class="biru" rowspan="2" width="50px">Jumlah Hari Kerja</th>
            		</tr>
            		<tr>
            			<th class="biru" width="20px">HD</th>
            			<th class="biru" width="20px">TL</th>
            			<th class="biru" width="20px">PL</th>
            			<th class="biru" width="20px">TP</th>
            			<th class="biru" width="20px">AS</th>
            			<th class="biru" width="20px">I</th>
            			<th class="biru" width="20px">S</th>
            			<th class="biru" width="20px">DL</th>
            			<th class="biru" width="20px">C</th>
            			<th class="biru" width="20px">TB</th>
            			<th class="biru" width="20px">TH</th>
            		</tr>';
        $sql = "select r.*,p.nama,p.golongan,p.jabatan from presensi_rekap r join pegawai p on (r.nip = p.nip)
												join golongan g on (p.golongan = g.golong)
													where r.bulan = '".$this->db->esc($_POST['bulan'])."' and
													r.tahun = '".$this->db->esc($_POST['tahun'])."' and
													r.skpd = '".$this->db->esc($_POST['kodeskpd'])."'
											order by 
											if(p.eselon = '-',1,0),
											p.eselon,g.urut,p.nip,if(p.status = 'pns',0,1)";
		$res = $this->db->query($sql);
		$nrw = $this->db->numRows($res);
		if($nrw > 0){
			$no = 1;
			while($data = $this->db->fetchArray($res)){
				echo '<tr><td class="td1">'.$no.'</td>
						  <td width="160px">'.$data['nama'].'</td>
						  <td width="160px">'.$this->util->formatNIP($data['nip']).'</td>
						  <td width="160px">'.$data['golongan'].'</td>
						  <td width="160px">'.$data['jabatan'].'</td>';
				$M = 0; $TL = 0; $PL = 0; $TP = 0; $AS = 0; $I = 0;
				$S = 0; $DL = 0; $C = 0; $TB = 0; $TH = 0;
				for($i=1;$i <= $sumday;$i++){
					$field = ''.$i.'_status';
					
					switch ($data[$field]) {
						case 'M':
							$M++;
						break;
						case 'TL':
							$TL++;
						break;
						case 'PL':
							$PL++;
						break;
						case 'TP':
							$TP++;
						break;
						case 'AS':
							$AS++;
						break;
						case 'I':
							$I++;
						break;
						case 'S':
							$S++;
						break;
						case 'DL':
							$DL++;
						break;
						case 'C':
							$C++;
						break;
						case 'TB':
							$TB++;
						break;
						case 'TH':
							$TH++;
						break;
					}
						
				}
				echo '<td class="td1">'.$M.'</td>
						<td class="td1">'.$TL.'</td>
						<td class="td1">'.$PL.'</td>
						<td class="td1">'.$TP.'</td>
						<td class="td1">'.$AS.'</td>
						<td class="td1">'.$I.'</td>
						<td class="td1">'.$S.'</td>
						<td class="td1">'.$DL.'</td>
						<td class="td1">'.$C.'</td>
						<td class="td1">'.$TB.'</td>
						<td class="td1">'.$TH.'</td>';
				echo '<td class="td1">'.$data['jml_harikerja'].'</td></tr>';
				$no++;
			}
		}
	}
	function libur(){
		$this->template('laporan_libur','admin');

	}
	function ambil_datalibur(){
		echo '<table class="tabdata zebra"><tr>
						<th class="biru" width="30px">No.</th>
            			<th class="biru">Hari / Tanggal</th>
            			<th class="biru">Keterangan</th>
            			</tr>';
		$sql = "select * from presensi_harilibur where year(tanggal) = '".$this->db->esc($_POST['tahun'])."' order by tanggal";
		$res = $this->db->query($sql);
		$no = 1;
		while ($data = $this->db->fetchArray($res)) {
			echo "<tr>
					<td class='td1'>".$no."</td>
					<td width='250px'>".$this->dt->indonesian_date($data['tanggal'],'l, j F Y')."</td>
					<td>".$data['keterangan']."</td>
				  </tr>";
			$no++;
		}
		echo "</table>";
	}
	function laporan_harian(){
		$this->template('laporan_harian','admin');
	}
	function cetak_libur(){
		$this->data['table'] = '<table border="1" width="100%"><tr>
						<th class="biru" width="30px">No.</th>
            			<th class="biru">Hari / Tanggal</th>
            			<th class="biru">Keterangan</th>
            			</tr>';
		$sql = "select * from presensi_harilibur where year(tanggal) = '".$this->db->esc($_GET['tahun'])."' order by tanggal";
		$res = $this->db->query($sql);
		$no = 1;
		while ($data = $this->db->fetchArray($res)) {
			$this->data['table'] .= "<tr>
					<td class='td1'>".$no."</td>
					<td width='250px'>".$this->dt->indonesian_date($data['tanggal'],'l, j F Y')."</td>
					<td>".$data['keterangan']."</td>
				  </tr>";
			$no++;
		}
		$this->data['table'] .= "</table>";
		include("mpdf/mpdf.php");
		
		$this->data['bulan'] = $this->db->esc($_GET['bulan']);
		$this->data['tahun'] = $this->db->esc($_GET['tahun']);
		$this->data['kodeskpd'] = $this->db->esc($_GET['kodeskpd']);
		$this->data['jumlah'] = $this->dt->jumlah_hari($_GET['tahun'],$_GET['bulan']);
		
		$html = $this->parse_report('presensi_harilibur');
		
		$mpdf=new mPDF('','A4', 0, '', 15, 15, 50, 16, 9, 9);
		$stylesheet = file_get_contents('css/cssreport.css');
		
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->WriteHTML($html,2);
		$mpdf->Output();
		
		exit;

	}
	function optSKPD($val){
		if($val <> ''){
			$sql = "select * from skpd where id='".$val."'";
			$res = $this->db->query($sql);
			$data = $this->db->fetchArray($res);
			$option = $data['skpd'];
			$option .= '<input type="hidden" value="'.$data['id'].'" name="kodeskpd" id="kodeskpd"/>';
		}else{
			$sql = "select * from skpd order by kode";
			$res = $this->db->query($sql);
			$option = '<select id="kodeskpd" name="kodeskpd">';
			$option .= '<option value="">- Pilih SKPD -</option>';
			$i=1;
			while($data = $this->db->fetchArray($res)){
				$sel = ($data['id'] == $_GET['kodeskpd'])?'selected':'';
				$option .= '<option value="'.$data['id'].'" '.$sel.'>'.($i++).' - '.$data['skpd'].'</option>';
			}
			$option .= '</select>';
		}
		return $option;	
	}
	function laporan_bulanan(){
		$this->template('laporan_bulanan','admin');
	}
	function ambil_harian(){
		echo '<table class="tabdata">
					<tr>
						<th class="biru td1" width="30px" rowspan="2">No.</th>
            			<th class="biru" rowspan="2">Nama Pegawai</th>
            			<th class="biru" rowspan="2">NIP</th>
            			<th class="biru" colspan="2">Jam Presensi</th>
            			<th class="biru" rowspan="2">Durasi</th>
            			<th class="biru" rowspan="2">Status</th>
            			<th class="biru"rowspan="2">Keterangan</th>
            		</tr>
            		<tr>
            			<th class="biru td1">Masuk</th>
            			<th class="biru td1">Pulang</th>
            		</tr>
            		<tr>';
        $time = strtotime($_POST['tanggal']);								
		$tgl = date("j", $time);
        $sql = "select 	r.nip,
        				r.".$tgl."_masuk as masuk,
        				r.".$tgl."_pulang as pulang,
        				r.".$tgl."_status as status,
        				r.".$tgl."_keterangan as keterangan,
        				s.jenis,
        				if(".$tgl."_pulang <> '00:00:00' and ".$tgl."_masuk <> '00:00:00',timediff(".$tgl."_pulang,".$tgl."_masuk),'00:00:00') as durasi,
        				p.nama from presensi_rekap r join pegawai p on (r.nip = p.nip)
												join golongan g on (p.golongan = g.golong)
												join (select nama_ijin as jenis,kode from jenis_ijin union
													  select keterangan as jenis,kode from keterangan) as s on (r.".$tgl."_status=s.kode)
													where r.bulan = month('".$this->db->esc($_POST['tanggal'])."') and
													r.tahun = year('".$this->db->esc($_POST['tanggal'])."') and
													r.skpd = '".$this->db->esc($_POST['kodeskpd'])."'
											order by 
											if(p.eselon = '-',1,0),
											p.eselon,g.urut,p.nip,if(p.status = 'pns',0,1)";
		
		$res = $this->db->query($sql);
		$no = 1;
		while ($data = $this->db->fetchArray($res)) {
			echo '<tr class="hov transbg">
					<td class="td1">'.$no.'</td>
					<td width="200px">'.$data['nama'].'</td>
					<td width="180px">'.$this->util->formatNIP($data['nip']).'</td>
					<td width="80px" class="td1">'.$data['masuk'].'</td>
					<td class="td1" width="80px">'.$data['pulang'].'</td>
					<td class="td1" width="80px">'.$data['durasi'].'</td>
					<td>'.$data['jenis'].'</td>
					<td>'.$data['keterangan'].'</td>
				  </tr>';
			$no++;
		}
        echo "</table>";
	}
	function cetak_harian(){
		$this->table = '<table class="tabdata" border="1" width="100%" style="font-size:10px;">
					<thead>
					<tr>
						<th class="biru td1" width="20px" rowspan="2">No.</th>
            			<th class="biru" rowspan="2">Nama Pegawai</th>
            			<th class="biru" rowspan="2">NIP</th>
            			<th class="biru" colspan="2">Jam Presensi</th>
            			<th class="biru" rowspan="2">Durasi</th>
            			<th class="biru" rowspan="2">Status</th>
            			<th class="biru"rowspan="2">Keterangan</th>
            		</tr>
            		<tr>
            			<th class="biru td1">Masuk</th>
            			<th class="biru td1">Pulang</th>
            		</tr>
            		<tr>
            		</thead>';
        $time = strtotime($_GET['tanggal']);								
		$tgl = date("j", $time);
        $sql = "select 	r.nip,
        				r.".$tgl."_masuk as masuk,
        				r.".$tgl."_pulang as pulang,
        				r.".$tgl."_status as status,
        				r.".$tgl."_keterangan as keterangan,
        				s.jenis,
        				if(".$tgl."_pulang <> '00:00:00' and ".$tgl."_masuk <> '00:00:00',timediff(".$tgl."_pulang,".$tgl."_masuk),'00:00:00') as durasi,
        				p.nama from presensi_rekap r join pegawai p on (r.nip = p.nip)
												join golongan g on (p.golongan = g.golong)
												join (select nama_ijin as jenis,kode from jenis_ijin union
													  select keterangan as jenis,kode from keterangan) as s on (r.".$tgl."_status=s.kode)
													where r.bulan = month('".$this->db->esc($_GET['tanggal'])."') and
													r.tahun = year('".$this->db->esc($_GET['tanggal'])."') and
													r.skpd = '".$this->db->esc($_GET['kodeskpd'])."'
											order by 
											if(p.eselon = '-',1,0),
											p.eselon,g.urut,p.nip,if(p.status = 'pns',0,1)";

		$res = $this->db->query($sql);
		$no = 1;
		while ($data = $this->db->fetchArray($res)) {
			$this->table .= '<tr class="hov transbg">
					<td class="td1">'.$no.'</td>
					<td width="140px">'.$data['nama'].'</td>
					<td width="140px">'.$this->util->formatNIP($data['nip']).'</td>
					<td width="60px" class="td1">'.$data['masuk'].'</td>
					<td class="td1" width="60px">'.$data['pulang'].'</td>
					<td class="td1" width="60px">'.$data['durasi'].'</td>
					<td>'.$data['jenis'].'</td>
					<td>'.$data['keterangan'].'</td>
				  </tr>';
			$no++;
		}
        $this->table .= "</table>";
        $sql = "select skpd from skpd where id = '".$this->db->esc($_GET['kodeskpd'])."'";
		$res = $this->db->query($sql);
		$data = $this->db->fetchArray($res);

		$this->dtpres['skpd'] = $data['skpd'];
        include("mpdf/mpdf.php");
		
		$html = $this->parse_report('presensi_harian');
		
		$mpdf=new mPDF('','A4', 0, '', 15, 15, 50, 16, 9, 9);
		$stylesheet = file_get_contents('css/cssreport.css');
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->WriteHTML($html,2);
		
		// $mpdf->WriteHTML('<pagebreak />');
		// $mpdf->WriteHTML('<pagebreak />');
		$mpdf->Output();
		
		exit;
	}
	function ambil_bulanan(){
		$sumday = $this->dt->jumlah_hari($_POST['tahun'],$_POST['bulan']);

		echo '<table class="tabdata">
					<tr>
						<th class="biru" width="30px" rowspan="2">No.</th>
            			<th class="biru" rowspan="2">Nama Pegawai</th>
            			<th class="biru" rowspan="2">NIP</th>
            			<th class="biru" colspan="'.$sumday.'">Tanggal</th>
            		</tr>
            		<tr>';
		for($i=1;$i <= $sumday;$i++){
			echo '<th class="biru">'.$i.'</th>';
		}
		echo '</tr>';
		
		
		$sql = "select r.*,p.nama from presensi_rekap r join pegawai p on (r.nip = p.nip)
												join golongan g on (p.golongan = g.golong)
													where r.bulan = '".$this->db->esc($_POST['bulan'])."' and
													r.tahun = '".$this->db->esc($_POST['tahun'])."' and
													r.skpd = '".$this->db->esc($_POST['kodeskpd'])."'
											order by 
											if(p.eselon = '-',1,0),
											p.eselon,g.urut,p.nip,if(p.status = 'pns',0,1)";
		
		$res = $this->db->query($sql);
		$nrw = $this->db->numRows($res);
		if($nrw > 0){
			$no = 1;
			while($data = $this->db->fetchArray($res)){
				echo '<tr><td class="td1">'.$no.'</td>
						  <td width="160px">'.$data['nama'].'</td>
						  <td width="160px">'.$this->util->formatNIP($data['nip']).'</td>';
				for($i=1;$i <= $sumday;$i++){
					$field = ''.$i.'_status';
					
					$color = '';
					if($data[$field] == 'L'){
						$color = '#FF8080';	
					}else{
						$color = '#FFFFFF';
					}
					$ket = ($data[$field] == 'M')?'HD':$data[$field];
					echo '<td class="td1" style="background-color:'.$color.';">'.$ket.'</td>';	
				}
				echo '</tr>';
				$no++;
			}
		}else{
			$cols = $sumday+3;
			if($_POST['kodeskpd'] == ''){
				$text = 'Pilih SKPD terlebih dahulu';	
			}else{
				$text = 'Tidak Ada Data Untuk Ditampilkan';	
			}
			echo '<tr><td class="td1" colspan="'.$cols.'">'.$text.'</td></tr>';	
		}
		echo '</table>';

	}
	function ambil_perorangan(){
		$sumday = $this->dt->jumlah_hari($_POST['tahun'],$_POST['bulan']);
		echo '<table class="tabdata">
				<tr>
					<th class="biru" rowspan="2" width="30px">Tgl.</th>
					<th class="biru" rowspan="2" width="160px">Hari</th>
					<th class="biru" colspan="2">Jam Presensi</th>
					<th class="biru" rowspan="2" width="100px">Durasi</th>
					<th class="biru" rowspan="2" width="100px">Status</th>
					<th class="biru" rowspan="2">Keterangan</th>
				</tr>
				<tr>
					<th class="biru" width="100px">Masuk</th>
					<th class="biru" width="100px">Pulang</th>
				</tr>';

		$sql = "select nama_ijin as jenis,kode from jenis_ijin 
				union
				select keterangan as jenis,kode from keterangan";
		$res = $this->db->query($sql);
		$arrstatus = array();
		while ($dtstatus = $this->db->fetchArray($res)) {
			$arrstatus[$dtstatus['kode']] = $dtstatus['jenis'];
		}

		$sql = "select * from presensi_rekap p 
					where p.bulan = '".$this->db->esc($_POST['bulan'])."' and
						p.tahun = '".$this->db->esc($_POST['tahun'])."' and
						p.nip = '".$this->db->esc($_POST['nip'])."'";
		
		
		$res = $this->db->query($sql);
		$nrw = $this->db->numRows($res);
		if($nrw == '0'){
			echo '<tr><td class="td1" colspan="7">Tidak Ada Data Untuk Ditampilkan</td></tr>';	
		}else{
			$data = $this->db->fetchArray($res);
			for($i=1;$i <= $sumday;$i++){
				
				$date = ''.$_POST['tahun'].'-'.$_POST['bulan'].'-'.$i.'';
				$du = '';
				$durasi = '';
				$color = '';
				$masuk = ''.$i.'_masuk';
				$pulang = ''.$i.'_pulang';
				$datastatus = ''.$i.'_status';
				$status = $data[$datastatus];
				$keterangan = ''.$i.'_keterangan';
				if($data[$masuk] <> '00:00:00' and $data[$pulang] <> '00:00:00'){
					$last = strtotime($data[$pulang]);
					$start = strtotime($data[$masuk]);
					$second = $last - $start;

					$durasi = gmdate("H:i:s", $second);
				}else{
					$durasi = '00:00:00';	
				}
				if($status == 'L'){
					$color = '#FF8080';	
				}
				echo '<tr bgcolor="'.$color.'">
						<td class="td1">'.$i.'</td>
						<td>'.$this->dt->date_to_day($date).'</td>
						<td class="td1">'.$data[$masuk].'</td>
						<td class="td1">'.$data[$pulang].'</td>
						<td class="td1">'.$durasi.'</td>
						<td >'.$arrstatus[$status].'</td>
						<td>'.$data[$keterangan].'</td>
					  </tr>';	
			}
		}
		
		echo '</table>';
		
	}
	function cetak_bulanan(){
		$sumday = $this->dt->jumlah_hari($_GET['tahun'],$_GET['bulan']);
		$this->data['table'] =  '<table border="1" width="100%">
					<thead>
					<tr>
						<th class="biru" width="30px" rowspan="2">No.</th>
            			<th class="biru" rowspan="2">Nama Pegawai</th>
            			<th class="biru" rowspan="2">NIP</th>
            			<th class="biru" colspan="'.$sumday.'">Tanggal</th>
            		</tr>
            		<tr>';
		for($i=1;$i <= $sumday;$i++){
			$this->data['table'] .= '<th class="biru">'.$i.'</th>';
		}
		$this->data['table'] .= '</tr>
            		</thead>';
		$sql = "select skpd from skpd where id = '".$this->db->esc($_GET['kodeskpd'])."'";
		$res = $this->db->query($sql);
		$data = $this->db->fetchArray($res);

		$this->dtpres['skpd'] = $data['skpd'];
		
		$sql = "select r.*,p.nama from presensi_rekap r join pegawai p on (r.nip = p.nip)
												join golongan g on (p.golongan = g.golong)
													where r.bulan = '".$this->db->esc($_GET['bulan'])."' and
													r.tahun = '".$this->db->esc($_GET['tahun'])."' and
													r.skpd = '".$this->db->esc($_GET['kodeskpd'])."'
											order by 
											if(p.eselon = '-',1,0),
											p.eselon,g.urut,p.nip,if(p.status = 'pns',0,1)";

		$res = $this->db->query($sql);
		$nrw = $this->db->numRows($res);
		if($nrw > 0){
			$no = 1;
			while($data = $this->db->fetchArray($res)){
				$this->data['table'] .= '<tr><td class="td1">'.$no.'</td>
						  <td width="200px">'.$data['nama'].'</td>
						  <td width="200px">'.$this->util->formatNIP($data['nip']).'</td>';
				for($i=1;$i <= $sumday;$i++){
					$field = ''.$i.'_status';
					$perhari = ($data[$field] == 'M')?'HD':$data[$field];
					$color = '';
					if($perhari == 'L'){
						$color = '#FF8080';	
					}
					
					$this->data['table'] .= '<td class="td1" bgcolor="'.$color.'">'.$perhari.'</td>';	
				}
				$this->data['table'] .= '</tr>';
				$no++;
			}
		}else{
			$cols = $sumday+3;
			if($_POST['kodeskpd'] == ''){
				$text = 'Pilih SKPD terlebih dahulu';	
			}else{
				$text = 'Tidak Ada Data Untuk Ditampilkan';	
			}
			$this->data['table'] .= '<tr><td class="td1" colspan="'.$cols.'">'.$text.'</td></tr>';	
		}
		$this->data['table'] .= '</table>';
		
		include("mpdf/mpdf.php");
		
		$this->data['bulan'] = $this->db->esc($_GET['bulan']);
		$this->data['tahun'] = $this->db->esc($_GET['tahun']);
		$this->data['kodeskpd'] = $this->db->esc($_GET['kodeskpd']);
		$this->data['jumlah'] = $this->dt->jumlah_hari($_GET['tahun'],$_GET['bulan']);
		
		$html = $this->parse_report('presensi_bulanan');
		
		$mpdf=new mPDF('','A4-L', 0, '', 15, 15, 50, 55, 9, 9);
		$stylesheet = file_get_contents('css/cssreport.css');
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->WriteHTML($html,2);
		
		// $mpdf->WriteHTML('<pagebreak />');
		// $mpdf->WriteHTML('<pagebreak />');
		$mpdf->Output();
		
		exit;
	}
	function cetak_perorangan(){
		$sumday = $this->dt->jumlah_hari($_GET['tahun'],$_GET['bulan']);
		$this->data['table'] = '<table class="tabdata" border="1" width="100%">
				<tr>
					<th class="biru" rowspan="2" width="30px">Tgl.</th>
					<th class="biru" rowspan="2" width="100px">Hari</th>
					<th class="biru" colspan="2">Jam Presensi</th>
					<th class="biru" rowspan="2" width="70px">Durasi</th>
					<th class="biru" rowspan="2" width="120px">Status</th>
					<th class="biru" rowspan="2">Keterangan</th>
				</tr>
				<tr>
					<th class="biru" width="70px">Masuk</th>
					<th class="biru" width="70px">Pulang</th>
				</tr>';
		$sql = "select nama_ijin as jenis,kode from jenis_ijin 
				union
				select keterangan as jenis,kode from keterangan";
		$res = $this->db->query($sql);
		$arrstatus = array();
		while ($dtstatus = $this->db->fetchArray($res)) {
			$arrstatus[$dtstatus['kode']] = $dtstatus['jenis'];
		}
		
		$sql = "select p.*,s.skpd as nama_skpd from pegawai p join skpd s on p.skpd=s.id 
				where p.nip = '".$this->db->esc($_GET['nip'])."'";
		$res = $this->db->query($sql);
		$this->dtpeg = $this->db->fetchArray($res);
		
		$sql = "select * from presensi_rekap where bulan = '".$this->db->esc($_GET['bulan'])."' and
												   tahun = '".$this->db->esc($_GET['tahun'])."' and
												   nip = '".$this->db->esc($_GET['nip'])."'";
		$this->jum_jam = '00:00:00';
		$M = 0; $TL = 0; $PL = 0; $TP = 0; $AS = 0; $I = 0;
		$S = 0; $DL = 0; $C = 0; $TB = 0; $TH = 0;
		$this->dtket['tl'] = '00:00:00';
		$this->dtket['bl'] = '00:00:00';
		
		$res = $this->db->query($sql);
		$nrw = $this->db->numRows($res);
		if($nrw == '0'){
			$this->data['table'] .= '<tr><td class="td1" colspan="7">Tidak Ada Data Untuk Ditampilkan</td></tr>';	
		}else{
			$this->dtpres = $this->db->fetchArray($res);
			
			
			for($i=1;$i <= $sumday;$i++){
				
				$date = ''.$_GET['tahun'].'-'.$_GET['bulan'].'-'.$i.'';
				$du = '';
				$durasi = '';
				$color = '';
				$masuk = ''.$i.'_masuk';
				$pulang = ''.$i.'_pulang';
				$datastatus = ''.$i.'_status';
				$status = $this->dtpres[$datastatus];
				$keterangan = ''.$i.'_keterangan';

				switch ($this->dtpres[$datastatus]) {
						case 'M':
							$M++;
						break;
						case 'TL':
							$batas = strtotime('08:00:00');
							$start = strtotime($this->dtpres[$masuk]);
							$second = $start - $batas;
							
							$durasi = gmdate("H:i:s", $second);
							$this->dtket['tl'] = $this->sum_the_time($this->dtket['tl'],$durasi);
							
							$TL++;
						break;
						case 'PL':
							$batasp = strtotime('14:30:00');
							$start = strtotime($this->dtpres[$pulang]);
							$second = $start - $batasp;
							
							$durasi = gmdate("H:i:s", $second);
							$this->dtket['bl'] = $this->sum_the_time($this->dtket['bl'],$durasi);

							$PL++;
						break;
						case 'TP':
							//berngkat
							$batas = strtotime('08:00:00');
							$start = strtotime($this->dtpres[$masuk]);
							$second = $start - $batas;
							$durasi = gmdate("H:i:s", $second);
							$this->dtket['tl'] = $this->sum_the_time($this->dtket['tl'],$durasi);

							//pulang
							$batasp = strtotime('14:30:00');
							$startp = strtotime($this->dtpres[$pulang]);
							$secondp = $startp - $batasp;
							
							$durasip = gmdate("H:i:s", $secondp);
							$this->dtket['bl'] = $this->sum_the_time($this->dtket['bl'],$durasip);
							$TP++;
						break;
						case 'AS':
							$AS++;
						break;
						case 'I':
							$I++;
						break;
						case 'S':
							$S++;
						break;
						case 'DL':
							$DL++;
						break;
						case 'C':
							$C++;
						break;
						case 'TB':
							$TB++;
						break;
						case 'TH':
							$TH++;
						break;
				}

				if($this->dtpres[$masuk] <> '00:00:00' and $this->dtpres[$pulang] <> '00:00:00'){
					$last = strtotime($this->dtpres[$pulang]);
					$start = strtotime($this->dtpres[$masuk]);
					$second = $last - $start;
					
					$durasi = gmdate("H:i:s", $second);
					$this->jum_jam = $this->sum_the_time($this->jum_jam,$durasi);
				}else{
					$durasi = '00:00:00';	
				}
				if($status == 'L'){
					$color = '#FF8080';	
				}
				$this->data['table'] .= '<tr bgcolor="'.$color.'">
						<td class="td1">'.$i.'</td>
						<td>'.$this->dt->date_to_day($date).'</td>
						<td class="td1">'.$this->dtpres[$masuk].'</td>
						<td class="td1">'.$this->dtpres[$pulang].'</td>
						<td class="td1">'.$durasi.'</td>
						<td >'.$arrstatus[$status].'</td>
						<td>'.$this->dtpres[$keterangan].'</td>
					  </tr>';
					
			}
		}
		$this->dtket['i'] = $I;
		$this->dtket['dl'] = $DL;
		$this->dtket['s'] = $S;
		$this->dtket['tb'] = $TB;
		$this->dtket['th'] = $TH;

		$this->data['table'] .= '</table>';
		include("mpdf/mpdf.php");
		
		$this->data['bulan'] = $this->db->esc($_GET['bulan']);
		$this->data['tahun'] = $this->db->esc($_GET['tahun']);
		$this->data['kodeskpd'] = $this->db->esc($_GET['kodeskpd']);
		$this->data['jumlah'] = $this->dt->jumlah_hari($_GET['tahun'],$_GET['bulan']);
		
		$html = $this->parse_report('presensi_perorangan');
		//die($html);
		$mpdf=new mPDF('s','A4', 0, '', 15, 15, 73, 16, 9, 9);
		$stylesheet = file_get_contents('css/cssreport.css');
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->WriteHTML($html,2);
		$mpdf->Output();
		
		exit;	
	}
	function sum_the_time($time1, $time2) {
	  $times = array($time1, $time2);
	  $seconds = 0;
	  foreach ($times as $time)
	  {
		list($hour,$minute,$second) = explode(':', $time);
		$seconds += $hour*3600;
		$seconds += $minute*60;
		$seconds += $second;
	  }
	  $hours = floor($seconds/3600);
	  $seconds -= $hours*3600;
	  $minutes  = floor($seconds/60);
	  $seconds -= $minutes*60;
	  // return "{$hours}:{$minutes}:{$seconds}";
	  return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds); // Thanks to Patrick
	}
	function parse_report($str){
		ob_start();
			include('system/report/'.$str.'.php');
			$result = ob_get_clean();
		return $result;
	}	
	function optBulan($val){
		$option = '<select id="bulan" name="bulan">';
		
		for($x=1;$x<=12;$x++) {
			$sel = ($x == $val)?'selected':'';
			$option .= '<option value="'.$x.'" '.$sel.'>'.$this->util->longMonth[$x].'</option>';
		}
		$option .= '</select>';
		return $option;	
	}
	
	function optTahun($val){
		$option = '<select id="tahun" name="tahun">';
		for($i=date("Y");$i>=2010;$i--) {
			$sel = ($i == $val)?'selected':'';
			$option .= '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
		}
		$option .= '</select>';
		return $option;	
	}
	function perorangan(){
		$this->template('laporan_perorangan','admin');
	}
	function optPegawai(){
		$option = '<select name="nip" id="nip">';
		$sql = "select nip,nama from pegawai p 
										join golongan g on (p.golongan = g.golong)
										where skpd='".$this->db->esc($_GET['skpd'])."' 
											order by 
											if(p.eselon = '-',1,0),
											p.eselon,g.urut,p.nip,if(p.status = 'pns',0,1)";
		$res = $this->db->query($sql);
		while($data = $this->db->fetchArray($res)){
			$option .= '<option value="'.$data['nip'].'">'.$data['nip'].' - '.$data['nama'].'</option>';
		}
		$option .= '</select>';
		echo $option;
	}
	function data_perorangan(){
		$sql = "select * from vpresensi where 
						skpd='".$this->db->esc($_GET['skpd'])."' and 
						nip='".$this->db->esc($_GET['nip'])."' and
						dwDate between '".$this->db->esc($_GET['mulai'])."' and '".$this->db->esc($_GET['selesai'])."'
						order by dwDate";
		$res = $this->db->query($sql);
		$nrw = $this->db->numRows($res);
		if($nrw == 0){
			$datapresensi .= '<tr class="data">
								<td class="td1" colspan="5">Tidak Ada Data</td>
							  </tr>';	
		}
		$no = 1;
		while($data = $this->db->fetchArray($res)){
			$datapresensi .= '<tr class="data">
								<td class="td1">'.$no.'</td>
								<td>'.$this->dt->indonesian_date($data['dwDate'],'l, j F Y').'</td>
								<td class="td1">'.$data['berangkat'].'</td>
								<td class="td1">'.$data['pulang'].'</td>
								<td></td>
							  </tr>';
			$no++;
		}
		
		echo $datapresensi;	
	}
	function cekLibur($date){
		$timestamp = strtotime($date);
		$day = date('D', $timestamp);
		if($day == 'Sun' || $day == 'Sat'){
			$return = 0;
		}else{
			$return = 1;
		}
		return $return;	
	}
	function formproses(){
		$this->template('laporan_formproses','admin');
	}
	function prosesdata(){
		$res = $this->db->query("select * from presensi_jamkerja order by id");
		while($row=$this->db->fetchArray($res)) $arrJamKerja[$row["id"]] = $row;

		$sumday = $this->dt->jumlah_hari($_POST['tahun'],$_POST['bulan']);
		$sql = "select tab.*,p.skpd from 
					(select p.nip,g.dwDate as tanggal from pegawai p join generallogdata g
					on (p.dwMachineNumber=g.dwMachineNumber and p.dwEnrollNumber=g.dwEnrollNumber )
					group by p.nip,g.dwDate
				union
					select nip,`date` as tanggal from presensi_manual) as tab 
				join pegawai p on (tab.nip=p.nip)
				where  
				month(tanggal) = '".$this->db->esc($_POST['bulan'])."' and 
				year(tanggal) = '".$this->db->esc($_POST['tahun'])."' and 
				skpd = '".$this->db->esc($_POST['kodeskpd'])."'";
		$res = $this->db->query($sql);
		$nrw = $this->db->numRows($res);
		if($nrw == 0){
			echo '0';
			die();	
		}
		//Query Libur
		$sql = "select *,day(tanggal) as day_libur from presensi_harilibur where month(tanggal) = '".$this->db->esc($_POST['bulan'])."' and 
													   year(tanggal) = '".$this->db->esc($_POST['tahun'])."'";
		$res = $this->db->query($sql);
		while($data = $this->db->fetchArray($res)){
			$libur[$data['day_libur']] = $data['keterangan'];
		}
		for($i = 1; $i <= $sumday;$i++){
			$tanggal = ''.$_POST['tahun'].'-'.$_POST['bulan'].'-'.$i.'';
			$ceklibur = $this->cekLibur($tanggal);
			if($ceklibur == '0'){
				$arrlibur[$i] = array('L','');	
			}
			if(count($libur) > 0){
				if(array_key_exists($i,$libur)){
					$arrlibur[$i] = array('L',$libur[$i]);
				}
			}
		}
		
		$sukses = true;
		$this->db->query('SET AUTOCOMMIT=0');
		$this->db->query('START TRANSACTION');
		
		//Query Ambil Pegawai
		$sql = "select nip from pegawai where skpd = '".$this->db->esc($_POST['kodeskpd'])."'";
		$res = $this->db->query($sql);
		while($data = $this->db->fetchArray($res)){
			unset($arrpresen);
			unset($arrijin);
			
			//Query Ambil Data
			$sql = "select nip,day(var.tanggal) as tanggal,
							min(var.masuk) as masuk,
							max(var.pulang) as pulang,
							timediff(max(var.pulang),
							min(var.masuk)) as durasi 
					from 
					(select p.nip,g.dwDate as tanggal,min(g.dwTime) as masuk,max(g.dwTime) as pulang 
							from generallogdata g join pegawai p
						 		on (p.dwMachineNumber=g.dwMachineNumber and 
								 	 p.dwEnrollNumber=g.dwEnrollNumber and 
									 p.nip = '".$data['nip']."' and
									 month(g.dwDate) = '".$this->db->esc($_POST['bulan'])."' and
									 year(g.dwDate) = '".$this->db->esc($_POST['tahun'])."')
					group by g.dwDate
					union
					select nip,date,if(inoutmode = 0,time,null) as masuk,if(inoutmode = 1,time,null) as pulang 
							from presensi_manual where nip = '".$data['nip']."' and 
									month(`date`) = '".$this->db->esc($_POST['bulan'])."' and
									year(`date`) = '".$this->db->esc($_POST['tahun'])."') as var
					group by var.tanggal";
			
			$resdata = $this->db->query($sql);
			while($dtsub = $this->db->fetchArray($resdata)){
				$arrpresen[$dtsub['tanggal']] = array($dtsub['masuk'],
														$dtsub['pulang'],
														$this->util->statusAbsen($dtsub['masuk'],
														$dtsub['pulang'],
														$dtsub['tanggal'],
														$arrJamKerja),'');
			}
			//Query ijin 
			$sql = "select p.*,j.kode,month(date_start) as month_start,month(date_end) as month_end,day(date_start) as day_start,day(date_end) as day_end 
							from presensi_ijin p join jenis_ijin j on (p.jenis_ijin=j.id_jenisijin)
							where nip='".$data['nip']."' and 
													  ((month(date_start) = '".$this->db->esc($_POST['bulan'])."' and 
													  year(date_start) = '".$this->db->esc($_POST['tahun'])."') or 
													  (month(date_end) = '".$this->db->esc($_POST['bulan'])."' and 
													  year(date_end) = '".$this->db->esc($_POST['tahun'])."'))";
			$resijin = $this->db->query($sql);
			while($dtijin = $this->db->fetchArray($resijin)){
				$awal = $dtijin['day_start'];
				$akhir = $dtijin['day_end'];
				if($dtijin['month_start'] <> $_POST['bulan']){
					$awal = 1;
				}
				if($dtijin['month_end'] <> $_POST['bulan']){
					$akhir = $this->dt->jumlah_hari($_POST['tahun'],$_POST['bulan']);
				}
				for($i = $awal;$i <= $akhir;$i++){
					$arrijin[$i] = array($dtijin['kode'],$dtijin['keterangan']);
				}
			}
			//Looping jumlah hari
			$sqllanjutan = '';
			$jml = 0;
			$jml_hari = $sumday;
			for($i=1;$i <= $sumday;$i++){
				$sqldate = '';
				$plus = 0;
				$sqldate = ",".$i."_status = 'TH'";
				if(count($arrpresen) > 0){
					if(array_key_exists($i,$arrpresen)){
						$sqldate = ",".$i."_masuk = '".$arrpresen[$i][0]."',".$i."_pulang = '".$arrpresen[$i][1]."',".$i."_status = '".$arrpresen[$i][2]."'";
						$plus = 1;
					}
				}
				if(count($arrijin) > 0){
					if(array_key_exists($i,$arrijin)){
						$sqldate = ",".$i."_status = '".$arrijin[$i][0]."',".$i."_keterangan = '".$arrijin[$i][1]."'";
						$plus = 0;
					}
				}
				if(count($arrlibur) > 0){
					if(array_key_exists($i,$arrlibur)){
						$sqldate = ",".$i."_status = 'L',".$i."_keterangan = '".$arrlibur[$i][1]."'";
						$plus = 0;
						$jml_hari = $jml_hari - 1;
					}
				}
				$jml = $jml + $plus;
				$sqllanjutan .= $sqldate;
			}
			$sql = "replace into presensi_rekap set bulan = '".$this->db->esc($_POST['bulan'])."',
													tahun = '".$this->db->esc($_POST['tahun'])."',
													nip = '".$data['nip']."',
													jml_harikerja = '".$jml_hari."',
													jml_masuk = '".$jml."',
													skpd = '".$this->db->esc($_POST['kodeskpd'])."' ".$sqllanjutan."";
			
			if(!$this->db->query($sql)){
				$sukses = false;	
			}
		}
		if($sukses){
			$this->db->query('commit');
			echo '100';	
		}else{
			$this->db->query('rollback');
			echo 'e';	
		}
			
	}	
}
<?php
class ijin extends Controller
{
	function __construct(){
		parent::__construct();
		$this->ceklogin();
		$this->library('date');
		$this->dt = new DateClass;
		$this->init();
	}
	function init(){
		$mode = ($_POST['mode'])?$_POST['mode']:$_GET['mode'];
		switch($mode){
			case 'insert':
				//$this->view('loading');
				$this->insert();
			break;
			case 'update':
			//$this->view('loading');
				$this->update();
			break;
			case 'add':
				$this->formadd($_GET['kodeskpd']);
			break;
			case 'edit':
				$this->formedit($_GET['id']);
			break;
			case 'delete':
				$this->view('loading');
				$this->delete();
			break;
			default:
				$this->datalist(($this->user['kodeskpd']!=''?$this->user['kodeskpd']:$_GET['kodeskpd']));
			break;	
		}
	}
	
	function optPegawai($kodeskpd,$nip = ''){
		$sql = "select nip,nama from pegawai p join golongan g on (p.golongan = g.golong)
										where skpd = '".$this->db->esc($kodeskpd)."' order by 
											if(p.eselon = '-',1,0),
											p.eselon,g.urut,p.nip,if(p.status = 'pns',0,1)";
		$res = $this->db->query($sql);
		$option = '<option value="">- Pilih Pegawai -</option>';
		while($data = $this->db->fetchArray($res)){
			$sel = ($data['nip'] == $nip)?'selected':'';
			$option .= '<option value="'.$data['nip'].'" '.$sel.'>'.$data['nip'].' - '.$data['nama'].'</option>';
		}
		return $option;
	}
	function getSKPD($id){
		$sql = "select * from skpd where id='".$this->db->esc($id)."'";
		$res = $this->db->query($sql);
		$data = $this->db->fetchArray($res);
		return $data['skpd'];
	}
	function formadd(){
		$this->template('ijin_add','admin');	
	}
	function formedit($id){
		$sql = "select * from presensi_ijin where id_ijin = '".$this->db->esc($id)."'";
		$res = $this->db->query($sql);
		$this->data = $this->db->fetchArray($res);
		
		$this->template('ijin_edit','admin');
	}
	function cekLibur($date){
		$timestamp = strtotime($date);
		$day = date('D', $timestamp);
		if($day == 'Sun' || $day == 'Sat'){
			$return = true;
		}else{
			$return = false;
		}
		return $return;
	}
	function hitung_harikerja($start,$end){
		$sql = "select * from presensi_harilibur where 
				tanggal between '".$this->db->esc($start)."' and '".$this->db->esc($end)."'";
		
		$res = $this->db->query($sql);

		$arrlibur = array();
		while ($data = $this->db->fetchArray($res)) {
			$arrlibur[$data['tanggal']] = 1;
		}
		$val = 0;
		$end = date('Y-m-d', strtotime('+1 day', strtotime($end)));
		$start = new DateTime($start);
		$end = new DateTime($end);

		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($start, $interval, $end);

		foreach ( $period as $dt ){
			$i = $dt->format("Y-m-d");
			if($this->cekLibur($i)){
					
			}else{
				if(array_key_exists($i, $arrlibur)){
					
				}else{
					$val++;
				}
			}	
		}
		return $val;	
	}
	function insert(){
		$bulan = date('m',strtotime($_POST['date_start']));
		$tahun = date('Y',strtotime($_POST['date_start']));
		$jum = $this->hitung_harikerja($_POST['date_start'],$_POST['date_end']);

		if($_POST['idjenis'] == '5'){
			$sql = "select sum(jumlah_harikerja) as jumlah from presensi_ijin where nip = '".$this->db->esc($_POST['nip'])."' and
																		  year(date_start) = '".$tahun."' and
																		  jenis_ijin   = '".$this->db->esc($_POST['idjenis'])."'";
			
			$res = $this->db->query($sql);
			$dtcek = $this->db->fetchArray($res);
			$jumlah = (int) $dtcek['jumlah']+$jum;
			
			if($jumlah > 12){
				echo "<script>alert('Untuk jumlah cuti pertahun tidak boleh lebih dari 12 hari');</script>";
				echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=ijin&mode=add&id=".$_POST['idjenis']."&kodeskpd=".$_POST['kodeskpd']."'>";		
				die();
			}
		}else{
			$sql = "select sum(jumlah_harikerja) as jumlah from presensi_ijin where nip = '".$this->db->esc($_POST['nip'])."' and
																		  month(date_start) = '".$bulan."' and
																		  jenis_ijin   = '".$this->db->esc($_POST['idjenis'])."'";
			
			$res = $this->db->query($sql);
			$dtcek = $this->db->fetchArray($res);
			$jumlah = (int) $dtcek['jumlah']+$jum;
			
			if($jum > 10){
				echo "<script>alert('Untuk jumlah ijin tidak boleh lebih dari 10 hari');</script>";
				echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=ijin&mode=add&id=".$_POST['idjenis']."&kodeskpd=".$_POST['kodeskpd']."'>";		
				die();
			}

		}
		

		$sql = "insert into presensi_ijin set nip 			= '".$this->db->esc($_POST['nip'])."',
											  date_start   = '".$this->db->esc($_POST['date_start'])."',
											  time_start   = '".$this->db->esc($_POST['time_start'])."',
											  date_end 	   = '".$this->db->esc($_POST['date_end'])."',
											  time_end 	   = '".$this->db->esc($_POST['time_end'])."',
											  jenis_ijin   = '".$this->db->esc($_POST['idjenis'])."',
											  keterangan   = '".$this->db->esc($_POST['keterangan'])."',
											  jumlah_harikerja = '".$jum."'";
		
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=ijin&id=".$_POST['idjenis']."&kodeskpd=".$_POST['kodeskpd']."'>";		
	}
	function update(){
		
		$bulan = date('m',strtotime($_POST['date_start']));
		$tahun = date('Y',strtotime($_POST['date_start']));
		$jum = $this->hitung_harikerja($_POST['date_start'],$_POST['date_end']);
		
		if($_POST['idjenis'] == '5'){
			$sql = "select sum(jumlah_harikerja) as jumlah from presensi_ijin where nip = '".$this->db->esc($_POST['nip'])."' and
																		  year(date_start) = '".$tahun."' and
																		  jenis_ijin   = '".$this->db->esc($_POST['idjenis'])."' and
																		  id_ijin <> '".$this->db->esc($_POST['id'])."'";
			
			$res = $this->db->query($sql);
			$dtcek = $this->db->fetchArray($res);
			$jumlah = (int) $dtcek['jumlah']+$jum;
			
			if($jumlah > 12){
				echo "<script>alert('Untuk jumlah cuti pertahun tidak boleh lebih dari 12 hari');</script>";
				echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=ijin&mode=add&id=".$_POST['idjenis']."&kodeskpd=".$_POST['kodeskpd']."'>";		
				die();
			}
		}elseif($_POST['idjenis'] == '4'){


		}else{
			// $monthstart = date('m',strtotime($_POST['date_start']));
			// $monthend = date('m',strtotime($_POST['date_end']));
			// //jika ijin antara 2bulan
			// if($monthend > $monthstart){
			// 	$enddate = date('Y-m-t',strtotime($_POST['date_start']));

			// 	$jum = $this->hitung_harikerja($_POST['date_start'],$enddate);
			// 	echo "$jum";
			// 	//die();
			// 	$startdate = date('Y-m-1',strtotime($_POST['date_start']));
			// 	$jum2 = $this->hitung_harikerja($startdate,$_POST['date_end']);
			// }
			// $sql = "select sum(jumlah_harikerja) as jumlah from presensi_ijin where nip = '".$this->db->esc($_POST['nip'])."' and
			// 															  month(date_start) = '".$bulan."' and
			// 															  jenis_ijin   = '".$this->db->esc($_POST['idjenis'])."' and
			// 															  id_ijin <> '".$this->db->esc($_POST['id'])."'";
			
			// $res = $this->db->query($sql);
			// $dtcek = $this->db->fetchArray($res);
			// $jumlah = (int) $dtcek['jumlah']+$jum;
			
			if($jum > 10){
				echo "<script>alert('Untuk jumlah ijin tidak boleh lebih dari 10 hari');</script>";
				echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=ijin&mode=add&id=".$_POST['idjenis']."&kodeskpd=".$_POST['kodeskpd']."'>";		
				die();
			}

		}

		$sql = "update presensi_ijin set nip 			= '".$this->db->esc($_POST['nip'])."',
											  date_start   = '".$this->db->esc($_POST['date_start'])."',
											  time_start   = '".$this->db->esc($_POST['time_start'])."',
											  date_end 	   = '".$this->db->esc($_POST['date_end'])."',
											  time_end 	   = '".$this->db->esc($_POST['time_end'])."',
											  jenis_ijin   = '".$this->db->esc($_POST['idjenis'])."',
											  keterangan   = '".$this->db->esc($_POST['keterangan'])."',
											  jumlah_harikerja = '".$jum."'
									where id_ijin = '".$this->db->esc($_POST['id'])."'";
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=ijin&&id=".$_POST['idjenis']."&kodeskpd=".$_POST['kodeskpd']."'>";
	}
	function delete(){
		$sql = "delete from presensi_ijin where id_ijin = '".$this->db->esc($_GET['id'])."'";
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=ijin&&id=".$_GET['jenis']."&kodeskpd=".$_GET['kodeskpd']."'>";	
	}
	function getJenisIjin($id){
		$sql = "select * from jenis_ijin where id_jenisijin='".$this->db->esc($id)."'";
		$res = $this->db->query($sql);
		$data = $this->db->fetchArray($res);
		return $data['nama_ijin'];
	}
	function optSKPD($val){
		if($val <> ''){
			$sql = "select * from skpd where id='".$val."'";
			$res = $this->db->query($sql);
			$data = $this->db->fetchArray($res);
			$option = $data['skpd'];
		}else{
			$sql = "select * from skpd order by kode";
			$res = $this->db->query($sql);
			$option = '<select id="optskpd">';
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
	
	function datalist($kodeskpd){
		if($_GET['id'] <> ''){

			$sql = "select * from presensi_ijin i join pegawai p 
					on i.nip=p.nip join jenis_ijin j 
					on i.jenis_ijin=j.id_jenisijin 
					where i.jenis_ijin = '".$this->db->esc($_GET['id'])."' and p.skpd='".$this->db->esc($kodeskpd)."' 
					order by id_ijin desc";
			//die($sql);
			$this->res = $this->db->query($sql);
			$this->template('ijin_list','admin');
		}else{
			echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=ijin&&id=1'>";
		}
	}	
}
?>
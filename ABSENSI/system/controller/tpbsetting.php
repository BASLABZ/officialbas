<?php
class tpbsetting extends Controller
{
	var $util;
	
	function __construct(){
		parent::__construct();
		$this->library("CUtilities");
		$this->util = new CUtilities();
		
		$this->ceklogin();
		$this->init();
			
	}
	
	function init(){		
				
		$mode = ($_POST['mode'])?$_POST['mode']:$_GET['mode'];
		switch($mode){	
			case 'tpbsetting':
				$this->tpbsetting((trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']));	
			break;
			case 'tpbkhusussetting':
				$this->tpbkhusussetting((trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']));	
			break;
			case 'tpb04besaran':
				if (isset($_POST["Simpan"])) {
					$this->res = $this->db->query("UPDATE setting04 set ".
													"persen_disiplin=".$this->esc($_POST['persen_disiplin']).", ". 
													"persen_kehadiran=".$this->esc($_POST['persen_kehadiran']).", ". 
													"persen_kepatuhan=".$this->esc($_POST['persen_kepatuhan']).", ". 
													"persen_kinerja=".$this->esc($_POST['persen_kinerja']).", ". 
													"persen_prestasi=".$this->esc($_POST['persen_prestasi']).", ". 
													"persen_inovasi_kreativitas=".$this->esc($_POST['persen_inovasi_kreativitas']).", ". 
													"persen_kemampuan_managerial=".$this->esc($_POST['persen_kemampuan_managerial']).", ". 
													"persen_kemampuan_interpersonal=".$this->esc($_POST['persen_kemampuan_interpersonal']));
				}
				$this->template('tpb04besaran','tpb');	
			break;
			case 'tpb05besaran':
				if (isset($_POST["Simpan"])) {
					$this->res = $this->db->query("UPDATE setting05 set ".
													"persen_disiplin=".$this->esc($_POST['persen_disiplin']).", ". 
													"persen_kehadiran=".$this->esc($_POST['persen_kehadiran']).", ". 
													"persen_kepatuhan=".$this->esc($_POST['persen_kepatuhan']).", ". 
													"persen_kinerja=".$this->esc($_POST['persen_kinerja']).", ". 
													"persen_prestasi=".$this->esc($_POST['persen_prestasi']).", ". 
													"persen_inovasi_kreativitas=".$this->esc($_POST['persen_inovasi_kreativitas']).", ". 
													"persen_kemampuan_teknis=".$this->esc($_POST['persen_kemampuan_teknis']).", ". 
													"persen_kemampuan_interpersonal=".$this->esc($_POST['persen_kemampuan_interpersonal']));
				}
				$this->template('tpb05besaran','tpb');	
			break;
			case 'tpbkhususbesaran':
				$this->formtpbkhusus();	
			break;
			case 'updatebesarantpbkhusus':
				$this->updatebesarantpbkhusus();
			break;
			default:
				$this->tpbsetting((trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']));
			break;	
		}
	}
	function updatebesarantpbkhusus(){
		if (isset($_POST["simpan"])) {
			$jum = count($_POST['nilai']);
			for ($i=1; $i<= $jum ; $i++) { 
				$sql = "update besaran_tpb_khusus set nilai = '".$this->esc($_POST[nilai][$i])."' 
						where id = '".$i."'";
				$this->db->query($sql);
			}
		}
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=tpbsetting&mode=tpbkhususbesaran'>";
	}
	function optSKPD($val){
		if($val <> ''){
			$sql = "select * from skpd where id='".$this->esc($val)."'";
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
	
	function optSKPDKhusus($val){
		if($val <> ''){
			$sql = "select * from skpd where id='".$this->esc($val)."' and upper(skpd) like 'RUMAH SAKIT%' ";
			$res = $this->db->query($sql);
			$data = $this->db->fetchArray($res);
			$option = $data['skpd'];
		}else{
			$sql = "select * from skpd where upper(skpd) like 'RUMAH SAKIT%' order by kode";
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
	
	function optBulan($val){
		$option = '<select id="bulan">';
		for($x=1;$x<=12;$x++) {
			$sel = ($x == $val)?'selected':'';
			$option .= '<option value="'.$x.'" '.$sel.'>'.$this->util->longMonth[$x].'</option>';
		}
		$option .= '</select>';
		return $option;	
	}
	
	function optTahun($val){
		$option = '<select id="tahun">';
		for($i=date("Y");$i>=2010;$i--) {
			$sel = ($i == $val)?'selected':'';
			$option .= '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
		}
		$option .= '</select>';
		return $option;	
	}		
	
	function tpbsetting($id){
		$this->data['id'] = $id;
		$edit=false;
		if (($_POST["bulan"]!='') && ($_POST["tahun"]!='')) {
			$this->res = $this->db->query("SELECT hari, jam, nama_kepala, nip_kepala, nama_bendahara, nip_bendahara, nama_petugas, nip_petugas FROM setting WHERE skpd = '".$this->esc($id)."' AND bulan = '".$this->esc($_POST['bulan'])."' AND tahun = '".$this->esc($_POST['tahun'])."'");

			if(isset($_POST['Simpan'])) {
				$this->db->query("REPLACE INTO setting (skpd,bulan,tahun,hari, jam, nama_kepala, nip_kepala, nama_bendahara, nip_bendahara, nama_petugas, nip_petugas) VALUES ".
				                 "('".$this->esc($_POST['skpd'])."','".$this->esc($_POST['bulan'])."','".$this->esc($_POST['tahun'])."','".$this->esc($_POST['hari'])."','".$this->esc($_POST['jam'])."',".
								 "'".$this->esc($_POST['nama_kepala'])."','".$this->esc($_POST['nip_kepala'])."','".$this->esc($_POST['nama_bendahara'])."','".$this->esc($_POST['nip_bendahara'])."',".
								 "'".$this->esc($_POST['nama_petugas'])."','".$this->esc($_POST['nip_petugas'])."')");
			} else 	{
			   $this->template('tpbsetting_edit','tpb');
			   $edit=true;
			}
		} 
		
		if (!$edit) {
			$this->res = $this->db->query("SELECT bulan,tahun,hari, jam, nama_kepala, nama_petugas FROM setting WHERE skpd = '".$this->esc($id)."' ORDER BY tahun desc,cast(bulan as UNSIGNED) desc");
			$this->template('tpbsetting','tpb');	
		}
	}		
	function formtpbkhusus(){
		$sql = "select * from besaran_tpb_khusus order by id";
		$this->res = $this->db->query($sql);
		$this->template('tpbsetting_khusus','tpb');

	}
	function tpbkhusussetting($id){
		$this->data['id'] = $id;
		$edit=false;
		if (($_POST["bulan"]!='') && ($_POST["tahun"]!='')) {
			$this->res = $this->db->query("SELECT nama_direktur,nip_direktur,nama_kepala_sdm,nip_kepala_sdm,nama_petugas,nip_petugas FROM setting_tpb_khusus WHERE skpd = '".$this->esc($id)."' AND bulan = '".$this->esc($_POST['bulan'])."' AND tahun = '".$this->esc($_POST['tahun'])."'");

			if(isset($_POST['Simpan'])) {
				$this->db->query("REPLACE INTO setting_tpb_khusus (skpd,bulan,tahun,nama_direktur,nip_direktur,nama_kepala_sdm,nip_kepala_sdm,nama_petugas,nip_petugas) VALUES ".
				                 "('".$this->esc($_POST['skpd'])."','".$this->esc($_POST['bulan'])."','".$this->esc($_POST['tahun'])."',".
								 "'".$this->esc($_POST['nama_direktur'])."','".$this->esc($_POST['nip_direktur'])."','".$this->esc($_POST['nama_kepala_sdm'])."','".$this->esc($_POST['nip_kepala_sdm'])."',".
								 "'".$this->esc($_POST['nama_petugas'])."','".$this->esc($_POST['nip_petugas'])."')");
			} else 	{
			   $this->template('tpbkhusussetting_edit','tpb');
			   $edit=true;
			}
		} 
		
		if (!$edit) {
			$this->res = $this->db->query("SELECT bulan,tahun,nama_direktur,nip_direktur,nama_kepala_sdm,nip_kepala_sdm,nama_petugas,nip_petugas FROM setting_tpb_khusus WHERE skpd = '".$this->esc($id)."' ORDER BY tahun desc,cast(bulan as UNSIGNED) desc");
			$this->template('tpbkhusussetting','tpb');	
		}
	}
	
	function workDay($date) {
		$sql = "select * from presensi_harilibur where tanggal like '".date("Y-m-",$date)."'";
		$res = $this->db->query($sql);
		$liburs = array();
		while ($row = $this->db->fetchArray($res)) {
			$liburs[$row['tanggal']] = $row['keterangan'];
		}
		
		$day = 0;
		for ($i=1;$i<=date("t",$date);$i++) {
			$tgl = mktime(0,0,0,date("m",$date),$i,date("Y",$date));
			if (!array_key_exists(date("Y-m-d",$tgl), $liburs) && (date("w",$tgl)!=0) && (date("w",$tgl)!=6)) $day++;
		}
		return $day;
	}	
	
	
}
?>
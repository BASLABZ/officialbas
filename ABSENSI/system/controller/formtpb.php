<?php
class formtpb extends Controller
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
			case 'tpb01':
				$this->tpb01((trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']));
			break;
			case 'print_tpb01':
				$this->report('cetak01');
			break;
			case 'word_tpb01':
				
				$this->report('word01');
			break;
			case 'tpb02':
				$this->tpb02((trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']));
			break;
			case 'print_tpb02':
				$this->report('cetak02');
			break;
			case 'word_tpb02':
				
				$this->report('word02');
			break;	
			case 'tpb03':
				$this->tpb03((trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']));
			break;
			case 'print_tpb03':
				$this->report('cetak03');
			break;
			case 'word_tpb03':
				
				$this->report('word03');
			break;						
			default:
				$this->tpb01((trim($this->user['kodeskpd'])!=''?$this->user['kodeskpd']:$_GET['kodeskpd']));
			break;	
		}
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
	
	
	function tpb01($id){
		$this->data['id'] = $id;
		if (($_POST["bulan"]!='') && ($_POST["tahun"]!='')) {
			$sql = "select * from pegawai p join eselon e on (p.eselon=e.urai) join golongan g on (p.golongan=g.golong) where upper(p.eselon)<>'ESELON I' and upper(p.eselon)<>'ESELON II' and upper(p.eselon)<>'ESELON III' and p.skpd = '".$this->esc($id)."' order by e.urut,g.urut, p.nama";
			$this->res = $this->db->query($sql);
		}
		$this->template('tpb01','tpb');	
	}
	
	function tpb02($id){
		$this->data['id'] = $id;
		if (($_POST["bulan"]!='') && ($_POST["tahun"]!='')) {
			$sql = "select * from pegawai p join eselon e on (p.eselon=e.urai) join golongan g on (p.golongan=g.golong) where upper(p.eselon)<>'ESELON IV' and upper(p.eselon)<>'-' and p.skpd = '".$this->esc($id)."' order by e.urut,g.urut, p.nama";
			$this->res = $this->db->query($sql);
		}
		$this->template('tpb02','tpb');	
	}
	
	function tpb03($id){
		$this->data['id'] = $id;
		if (($_POST["bulan"]!='') && ($_POST["tahun"]!='')) {
			$sql = "select * from pegawai p join eselon e on (p.eselon=e.urai) join golongan g on (p.golongan=g.golong) where upper(p.eselon)<>'ESELON I' and upper(p.eselon)<>'ESELON II' and upper(p.eselon)<>'ESELON III' and p.skpd = '".$this->esc($id)."' order by e.urut, g.urut, p.nama";
			$this->res = $this->db->query($sql);
		}
		$this->template('tpb03','tpb');	
	}	
	
	
	
}
?>
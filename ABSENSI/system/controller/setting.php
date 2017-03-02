<?php
class setting extends Controller
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
			case 'alat':
				$this->datalist_alat();	
			break;
			case 'ijin':
				$this->datalist_ijin();
			break;
			case 'ins_jenis':
				$this->view('loading');
				$this->insert_jenis();
			break;
			case 'update_jenis':
				$this->view('loading');
				$this->update_ijin();
			break;
			case 'addjenis':
				$this->addjenis();
			break;
			case 'edit_ijin':
				$this->ijin_edit();
			break;
			case 'update_alat':
				$this->view('loading');
				$this->update_alat();
			break;
			case 'insert_alat':
				$this->view('loading');
				$this->insert_alat();
			break;
			case 'delete_alat':
				$this->delete_alat();
			break;
			case 'add_alat':
				$this->add_alat();
			break;
			case 'edit_alat':
				$this->edit_alat($_GET['id']);
			break;
			case 'editjamkerja':
				$this->editjamkerja();
			break;
			case 'update_jamkerja':
				$this->view('loading');
				$this->updatejamkerja();
			break;
			case 'jamkerja':
				$this->jamkerja_list();
			break;
			case 'insert_libur':
				$this->view('loading');
				$this->insert_libur();
			break;
			case 'addlibur':
				$this->addlibur();
			break;
			case 'editlibur':
				$this->editlibur();
			break;
			case 'libur':
				$this->libur();
			break;
			case 'update_libur':
				$this->view('loading');
				$this->update_libur();
			break;
			case 'deletelibur':
				$this->view('loading');
				$this->delete_libur();
			break;
			case 'runningtext':
				$this->runningtext_list();
			break;
			case 'add_text':
				$this->add_text();
			break;
			case 'edit_text':
				$this->edit_text();
			break;
			case 'insert_text':
				$this->view('loading');
				$this->insert_text();
			break;
			case 'update_text':
				$this->update_text();
			break;
			case 'delete_text':
				$this->view('loading');
				$this->delete_text();
			break;
			case 'delete_ijin':
				$this->view('loading');
				$this->delete_ijin();
			break;
			case 'update_ijin':
				$this->view('loading');
				$this->update_ijin();
			break;	
		}
	}
	function optSKPD($val){
		$sql = "select * from skpd order by kode";
		$res = $this->db->query($sql);
		
		$option = '<option value="">- Pilih SKPD -</option>';
		$i=1;
		while($data = $this->db->fetchArray($res)){
			$sel = ($data['id'] == $val)?'selected':'';
			$option .= '<option value="'.$data['id'].'" '.$sel.'>'.($i++).' - '.$data['skpd'].'</option>';
		}
		
		return $option;	
	}
	function optStatus($val){
		$arr = array('Aktif' => '-1','Tidak Aktif' => '0');
		$option = '<option value="">- Pilih -</option>';
		foreach($arr as $key => $value){
			$sel = ($val == $value)?'selected':'';
			$option .= '<option value="'.$value.'" '.$sel.'>'.$key.'</option>';
		}
		return $option;
	}
	function add_alat(){
		$this->template('setting_alat_add','admin');
	}
	function insert_alat(){
		$sql = "insert into machine set dwMachineNumber = '".$this->db->esc($_POST['no_alat'])."',
									dwIPAddress = '".$this->db->esc($_POST['ip'])."',
									dwPort = '".$this->db->esc($_POST['port'])."',
									dwPassword = '".$this->db->esc($_POST['password'])."',
									dwTitle = '".$this->db->esc($_POST['nama_alat'])."',
									dwEnable = '".$this->db->esc($_POST['status'])."',
									kodeskpd = '".$this->db->esc($_POST['skpd'])."'";
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=setting&mode=alat'>";
	}
	function update_alat(){
		$sql = "update machine set dwMachineNumber = '".$this->db->esc($_POST['no_alat'])."',
									dwIPAddress = '".$this->db->esc($_POST['ip'])."',
									dwPort = '".$this->db->esc($_POST['port'])."',
									dwPassword = '".$this->db->esc($_POST['password'])."',
									dwTitle = '".$this->db->esc($_POST['nama_alat'])."',
									dwEnable = '".$this->db->esc($_POST['status'])."',
									kodeskpd = '".$this->db->esc($_POST['skpd'])."'
								where dwMachineNumber = '".$this->db->esc($_POST['id'])."'";
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=setting&mode=alat'>";	
	}
	function delete_alat(){
		$sql = "delete from machine where dwMachineNumber = '".$this->db->esc($_GET['id'])."'";
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=setting&mode=alat'>";	
	}
	function edit_alat($id){
		$sql = "select * from machine where dwMachineNumber = '".$this->db->esc($id)."'";
		$res = $this->db->query($sql);
		$this->data = $this->db->fetchArray($res);
		$this->template('setting_alat_edit','admin');
	}
	function jamkerja_list(){
		$sql = "select * from presensi_jamkerja order by id";
		$this->res = $this->db->query($sql);
		$this->template('setting_jamkerja_list','admin');
	}
	function datalist_alat(){
		$sql = "select * from machine m left join skpd s on m.kodeskpd=s.id order by dwMachineNumber";
		$this->res = $this->db->query($sql);
		$this->template('setting_alat_list','admin');
	}
	function datalist_ijin(){
		$sql = "select * from jenis_ijin order by id_jenisijin";
		$this->res = $this->db->query($sql);
		$this->template('ijin_jenis_list','admin');
	}
	function insert_jenis(){
		$sql = "insert into jenis_ijin set nama_ijin = '".$this->db->esc($_POST['ijin'])."',
											kode = '".$this->db->esc($_POST['kode'])."'";
		
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=setting&mode=ijin'>";
	}
	function addjenis(){
		$this->template('ijin_jenis_add','admin');	
	}
	function ijin_edit(){
		$sql = "select * from jenis_ijin where id_jenisijin = '".$this->db->esc($_GET['id'])."'";
		$res = $this->db->query($sql);
		$this->data = $this->db->fetchArray($res);
		$this->template('setting_ijin_edit','admin');	
	}
	function update_ijin(){
		$sql = "update jenis_ijin set nama_ijin = '".$this->db->esc($_POST['ijin'])."',
										kode = '".$this->db->esc($_POST['kode'])."'
									where id_jenisijin = '".$this->db->esc($_POST['id'])."'";
		
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=setting&mode=ijin'>";
	}
	function delete_ijin(){
		$sql = "delete from jenis_ijin where id_jenisijin='".$this->db->esc($_GET['id'])."'";
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=setting&mode=ijin'>";
	}
	function editjamkerja(){
		$sql = "select * from presensi_jamkerja";
		$res = $this->db->query($sql);
		while($data = $this->db->fetchArray($res)){
			$start = 'start_'.$data['id'].'';
			$end   = 'end_'.$data['id'].'';
			$this->data[$start] = substr($data['workStart'],0,5);
			$this->data[$end] = substr($data['workEnd'],0,5);
			$this->data['toleransi'] = substr($data['tolerance'],3,2);
		}
		$this->template('setting_jamkerja_edit','admin');
	}	
	function libur(){
		$sql = "select * from presensi_harilibur order by tanggal desc";
		$this->res = $this->db->query($sql);
		$this->template('setting_libur_list','admin');
	}
	function addlibur(){
		$this->data['status'] = 'Tambah';
		$this->data['action'] = 'insert_libur';
		$this->template('setting_addlibur','admin');	
	}
	function editlibur(){
		$sql = "select * from presensi_harilibur where id_libur='".$this->db->esc($_GET['id'])."'";
		$res = $this->db->query($sql);
		$this->data = $this->db->fetchArray($res);
		$this->data['status'] = 'Edit';
		$this->data['action'] = 'update_libur';
		$this->template('setting_addlibur','admin');
	}
	function insert_libur(){
		$sql = "insert into presensi_harilibur set tanggal = '".$this->db->esc($_POST['tanggal'])."',
												   keterangan = '".$this->db->esc($_POST['keterangan'])."'";
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=setting&mode=libur'>";	
	}
	function update_libur(){
		$sql = "update presensi_harilibur set tanggal = '".$this->db->esc($_POST['tanggal'])."',
												   keterangan = '".$this->db->esc($_POST['keterangan'])."'
											where id_libur = '".$this->db->esc($_POST['id'])."'";
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=setting&mode=libur'>";	
	}
	function delete_libur(){
		$sql = "delete from presensi_harilibur where id_libur = '".$this->db->esc($_GET['id'])."'";
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=setting&mode=libur'>";
	}
	function runningtext_list(){
		$sql = "select * from running_text order by id desc";
		$this->res = $this->db->query($sql);
		$this->template('setting_text_list','admin');
	}
	function add_text(){
		$this->data['status'] = 'TAMBAH';
		$this->data['action'] = 'insert_text';
 		$this->template('setting_text_add','admin');	
	}
	function edit_text(){
		$sql = "select * from running_text where id='".$this->db->esc($_GET['id'])."'";
		$res = $this->db->query($sql);
		$this->data = $this->db->fetchArray($res);
		$this->data['status'] = 'EDIT';
		$this->data['action'] = 'update_text';
		$this->template('setting_text_add','admin');	
	}
	function insert_text(){
		$sql = "insert into running_text set `text` = '".$this->db->esc($_POST['text'])."',
											 `enable` = '".$this->db->esc($_POST['enable'])."'";
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=setting&mode=runningtext'>";
	}
	function update_text(){
		$sql = "update running_text set `text` = '".$this->db->esc($_POST['text'])."',
										`enable` = '".$this->db->esc($_POST['enable'])."'
									where id = '".$this->db->esc($_POST['id'])."'";
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=setting&mode=runningtext'>";
	}
	function delete_text(){
		$sql = "delete from running_text where id = '".$this->db->esc($_GET['id'])."'";
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=setting&mode=runningtext'>";
	}
	function updatejamkerja(){
		for ($i=1; $i <= 5 ; $i++) { 
			$sql = "update presensi_jamkerja set workStart = '".$_POST['start'][$i]."',
												 workEnd = '".$_POST['end'][$i]."'
											where id = '".$i."'";
			$this->db->query($sql);
		}
		$toleransi = '00:'.$_POST['toleransi'];
		$sql = "update presensi_jamkerja set tolerance = '".$toleransi."'";
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=setting&mode=jamkerja'>";
	}
}
?>
<?php
class user extends Controller
{
	function __construct(){
		parent::__construct();
		$this->ceklogin();
		$this->init();	
	}
	function init(){
		$mode = ($_POST['mode'])?$_POST['mode']:$_GET['mode'];
		switch($mode){
			case 'add':
				$this->add();	
			break;
			case 'edit':
				$this->edit();
			break;
			case 'delete':
				$this->view('loading');
				$this->delete();
			break;
			case 'insert':
				//$this->view('loading');
				$this->insert();
			break;
			case 'update':
				$this->view('loading');
				$this->update();
			break;
			default:
				$this->datalist($_GET['id']);
			break;	
		}
	}
	function getHakakses($id){
		$sql = "select hakakses from hakakses where id_hakakses='".$this->db->esc($id)."'";
		$res = $this->db->query($sql);
		$data = $this->db->fetchArray($res);
		
		return strtoupper($data['hakakses']);
	}
	function add(){
		$this->data['status'] = 'tambah';
		$this->template('user_add','admin');
		
	}
	function edit(){
		$sql = "select * from pengguna where id_user='".$this->db->esc($_GET['id'])."'";
		$res = $this->db->query($sql);
		$this->data = $this->db->fetchArray($res);
		$this->template('user_edit','admin');
	}
	function insert(){

		$sql = "select * from pengguna where username = '".$this->db->esc($_POST['username'])."'";
		$res = $this->db->query($sql);
		$nrw = $this->db->numRows($res);

		if($nrw > 0){
			echo "<script>alert('Username Sudah Dipakai, Gunakan username yg lain');</script>";
				echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=user&mode=add&kodeskpd=&id=".$_POST['hakakses']."'>";
		}else{

			$sql = "insert into pengguna set nama = '".$this->db->esc($_POST['nama'])."',
										 username = '".$this->db->esc($_POST['username'])."',
										 password = '".md5($this->db->esc($_POST['password']))."',
										 hakakses = '".$this->db->esc($_POST['hakakses'])."',
										 kodeskpd = '".$this->db->esc($_POST['kodeskpd'])."'";
			
			$this->db->query($sql);
			echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=user&id=".$_POST['hakakses']."'>";
		}
	}
	function update(){
		$sql = "select * from pengguna where username = '".$this->db->esc($_POST['username'])."' 
				and id_user <> '".$this->db->esc($_POST['id_user'])."'";
		$res = $this->db->query($sql);
		$nrw = $this->db->numRows($res);
		if($nrw > 0){
			
			echo '<script>alert("Silahkan gunakan username yang lain");history.back(-1)</script>';

			die();
		}else{
			$sqlpass = ($_POST['password'] <> '')?"password = '".md5($this->db->esc($_POST['password']))."',":"";
			$sql = "update pengguna set nama = '".$this->db->esc($_POST['nama'])."',
										 username = '".$this->db->esc($_POST['username'])."',
										 ".$sqlpass."
										 hakakses = '".$this->db->esc($_POST['hakakses'])."',
										 kodeskpd = '".$this->db->esc($_POST['kodeskpd'])."' 
									where id_user = '".$this->db->esc($_POST['id_user'])."'";
			
			$this->db->query($sql);
			echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=user&kodeskpd=".$_POST['kodeskpd']."&id=".$_POST['hakakses']."'>";
			
		}
	}
	function getSKPD($id){
		$sql = "select * from skpd where id='".$this->db->esc($id)."'";
		$res = $this->db->query($sql);
		$data = $this->db->fetchArray($res);
		
		return $data['skpd'];
	}
	function optSKPD($val = ''){
		if($this->user['kodeskpd'] <> ''){
			$sql = "select skpd from skpd where id = '".$this->esc($this->user['kodeskpd'])."'";
			$res = $this->db->query($sql);
			$data = $this->db->fetchArray($res);
			$option = $data['skpd'];
			$option .= '<input type="hidden" name="kodeskpd" value="'.$this->user['kodeskpd'].'"/>';
		}else{
			$sql = "select * from skpd order by kode";
			$res = $this->db->query($sql);
			$option = '<select id="kodeskpd" name="kodeskpd">';
			$option .= '<option value="">- Pilih SKPD -</option>';
			$i=1;
			while($data = $this->db->fetchArray($res)){
				$sel = ($data['id'] == $val)?'selected':'';
				$option .= '<option value="'.$data['id'].'" '.$sel.'>'.($i++).' - '.$data['skpd'].'</option>';
			}
			$option .= '</select>';
		}
		return $option;	
	}
	function datalist($id){
		if($id <> ''){
			$this->data['id'] = $kodeskpd;
			$sqlskpd = ($this->user['kodeskpd'] <> '')?"and kodeskpd = '".$this->user['kodeskpd']."'":'';
			$sql = "select p.*,s.skpd,h.hakakses as jenis from pengguna p join hakakses h on (p.hakakses=h.id_hakakses)
					left join skpd s on (s.id=p.kodeskpd)  
					where p.hakakses <> '1' and p.hakakses='".$this->db->esc($id)."' ".$sqlskpd." order by s.kode";
			
			$this->res = $this->db->query($sql);
			$this->template('user_list','admin');
		}
	}
	function delete(){
		$sql = "delete from pengguna where id_user='".$this->db->esc($_GET['id'])."'";
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=user&kodeskpd=".$_GET['kodeskpd']."&id=".$_GET['jenis']."'>";
	}	
}
?>
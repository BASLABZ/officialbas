<?php
class skpd extends Controller
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
				$this->template('skpd_add','admin');
			break;
			case 'tambah':
				$this->tambah($_GET['id']);
			break;
			case 'edit':
				$this->edit($_GET['id']);
			break;
			case 'editBidang':
				$this->editBidang($_GET['id']);
			break;
			case 'insert':
				$this->view('loading');
				$this->insert();
			break;
			case 'insert_bidang':
				$this->view('loading');
				$this->insert_bidang($_POST['id']);
			break;
			case 'update':
				$this->view('loading');
				$this->update($_POST['id']);
			break;
			case 'delete':
				$this->view('loading');
				$this->delete($_GET['id']);
			break;
			case 'deleteBidang':
				$this->view('loading');
				$this->deleteBidang($_GET['id']);
			break;
			case 'loading':
				$this->view('loading');
			break;
			case 'updateBidang':
				$this->view('loading');
				$this->updateBidang($_POST['id']);
			break;
			default:
				$this->datalist();
			break;
		}	
	}
	function edit($id){
		$sql = "select * from skpd where id='".$this->db->esc($id)."'";
		$res = $this->db->query($sql);
		$this->data = $this->db->fetchArray($res);
		$this->template('skpd_edit','admin');	
	}
	function editBidang($id){
		$sql = "select * from bidang where id='".$this->db->esc($id)."'";
		$res = $this->db->query($sql);
		$this->data = $this->db->fetchArray($res);
		$this->template('bidang_edit','admin');	
	}
	function tambah($id){
		$sql = "select skpd, id, kode from skpd where id='".$this->db->esc($id)."'";
		$res = $this->db->query($sql);
		$this->data = $this->db->fetchArray($res);
		$this->template('bidang_add','admin');
	}
	function insert(){
		$sql = "insert into skpd set kode = '".$this->db->esc($_POST['kode'])."',skpd = '".$this->db->esc($_POST['urai'])."', singkat = '".$this->db->esc($_POST['singkat'])."'";
		
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=skpd'>";	
	}
	function insert_bidang(){
		$sql = "insert into bidang set id_skpd = '".$this->db->esc($_POST['id_skpd'])."',nama_bidang = '".$this->db->esc($_POST['nama_bidang'])."'";

		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=skpd'>";
	}
	function update($id){
		$sql = "update skpd set kode = '".$this->db->esc($_POST['kode'])."',skpd = '".$this->db->esc($_POST['urai'])."', singkat = '".$this->db->esc($_POST['singkat'])."' where id='".$this->db->esc($id)."'";
		
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=skpd'>";	
	}
	function updateBidang($id){
		$sql = "update bidang set nama_bidang = '".$this->db->esc($_POST['nama_bidang'])."' where id='".$this->db->esc($id)."'";
		
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=skpd'>";	
	}
	function delete($id){
		$sql = "delete from skpd where id='".$this->db->esc($id)."'";
		
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=skpd'>";	
	}
	function deleteBidang($id){
		$sql = "delete from bidang where id='".$this->db->esc($id)."'";
		
		$this->db->query($sql);
		echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=skpd'>";	
	}
	function datalist(){
		$sql = "select * from skpd order by kode";
		$this->res = $this->db->query($sql);
		$this->template('skpd_list','admin');
	}
}

?>
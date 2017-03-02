<?php
class profil extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->init();
	}
	function init(){
		$mode = ($_POST['mode'])?$_POST['mode']:$_GET['mode'];
		switch ($mode) {
			case 'update':
				$this->update();
			break;
			default:
				$this->formProfil();
			break;
		}
	}
	function formProfil(){
		$this->template('profil_form','admin');
	}
	function update(){
		if(isset($_POST['simpan'])){

			$sqlpass = ($_POST['password'] <> '')?"password = '".md5($_POST['password'])."',":"";
			$sql = "update pengguna set nama = '".$_POST['nama']."',
										".$sqlpass."
										username = '".$this->user['username']."'
					where id_user = '".$this->user['id_user']."'";
			$this->db->query($sql);
			echo "<script>alert('Profil Berhasil Diubah');</script>";
			echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."?pg=profil'>";
		}
	}
}
?>
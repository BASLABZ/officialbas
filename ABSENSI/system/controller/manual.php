<?php
class manual extends Controller
{
	function __construct(){
		parent::__construct();
		$this->ceklogin();
		$this->init();	
	}
	function init(){
		$mode = ($_POST['mode'])?$_POST['mode']:$_GET['mode'];
		switch($mode){
			default:
				$this->datalist($_GET['kodeskpd']);
			break;	
		}
	}
	function datalist($id){
		$this->template('manual_list','admin');
	}	
}
?>
<?php
Class ModulClass{

	/**
	* modul disimpan dalam 1 file untuk kemudahan upload modul
	* fungsi insert, update, delete, manage, dan pembuatan form 
	* disertakan dalam tiap modul. Template dipisahkan, masuk dalam 
	* folder themes. class ini merupakan abstrak untuk di extend oleh
	* modul-modul yang akan dipakai
	* @author Bruri <bruri@gi.co.id>
	* @version 1.0
	* @package Modul
	**/

	function __construct($owner){
		//gunakan objek dari cms menghemat memori
		$this->owner = $owner;
		$this->cnf = $owner->cnf;
		$this->db = $owner->db;
		$this->str = $owner->str;
		$this->scr = $owner->scr;
		$this->date = $owner->date;
		$this->url = $owner->url;
		$this->grid = $owner->grid;
		$this->template = $owner->template;
		$this->auth = $owner->auth;
		$this->dl = $owner->dl;
		$this->menu = $owner->menu;
		
		$this->loadTemplateTag();
	}
	
	function loadTemplateTag() {
		$sql = "SELECT * FROM conf";
		$res = $this->db->query($sql);
		while($data = $this->db->fetchArray($res)){
			$this->template->defineTag(strtoupper($data['conf']),$data['val']);
		}	
		$this->template->defineTag('THEME_URL',THEME_URL);
		$this->template->defineTag('ROOT_URL',ROOT_URL);
		$this->template->defineTag('MENU',$this->menu->MainMenu());
		$this->template->defineTag('USERMENU',$this->menu->UserMenu());
		$this->template->defineTag('SIDEBARMENU',$this->menu->SideBarMenu());	
		$this->template->defineTag('NAVMODE','');
		$this->template->defineTag('PAGECONTENT','');
		$this->template->defineTag('PAGESCRIPT','');
	}

	function Init(){
			$mode = ($_GET['cntmode'] <> '')?$_GET['cntmode']:$_POST['cntmode'];
			switch($mode){
				case 'form':
					$this->content = $this->buildForm();
				break;
				case 'ins':
					$this->insert();
				break;
				case 'upd':
					$this->update();
				break;
				case 'del':
					$this->delete();
				break;			
				default :
					$this->Manage();	
				break;
			}
	}

	function buildForm(){
		# menampilkan form
	}
	function Insert(){
		# query insert 
	}
	function Update(){
		# query update 
	}
	function Delete(){
		# query delete 
	}
	function Service(){
		# service handle
	}	
	function Manage(){
		# grid & manajemen data
	}
	function FrontDisplay(){
		# tampilan depan
		$this->owner->getIndex();
	}
	function FrontList(){
		# daftar artikel
	}
	function GetDetail($id){
		# detail artikel
	}
	function Download($id){
		# download handle
	}	

}
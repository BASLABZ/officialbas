<?php
class menu extends Controller
{
	function __construct(){
		parent::__construct();
		$this->arrmenu = array(0 => '',
						 1 => '1,2,3,4,5,6,7,8,9,0', 
						 2 => '2,3,4,5,6,7,8,9,0',
						 7 => '2,3,5,6,0',
						 3 => '3,5,7,9,0',
						 4 => '4,6,8,0',
						 5 => '5,9,0',
						 6 => '6,8,0');
		$this->hakakses = $this->arrmenu[$this->user['hakakses']];
	}
	function getMenu(){
		
		$sql = "select * from menu where id_parent = '0' and hakakses in(".$this->hakakses.")";
		
		$res = $this->db->query($sql);
		return $res;
	}
	function getSubMenu($id){
		$sql = "select * from menu where id_parent = '".$this->db->esc($id)."' and hakakses in(".$this->hakakses.")";
		$res = $this->db->query($sql);
		return $res;
	}	
}
?>
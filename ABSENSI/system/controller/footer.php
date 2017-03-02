<?php
class footer extends Controller
{
	function __construct(){
		parent::__construct();
	}
	function getText(){
		$sql = "select * from running_text where enable = '-1'";
		$res = $this->db->query($sql);
		while($data = $this->db->fetchArray($res)){
			$datatext .= '<img src="img/papua-kecil.png"/> <p>'.$data['text'].'</p>';
		}
		return $datatext;	
	}	
}
?>
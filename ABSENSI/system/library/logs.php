<?php
class logs {
	function __construct(){
		$this->db 		 = new DatabaseClass();
		$this->cnf 		= new ConfigClass();
		
	}
	function writeLogs($id,$type,$idx){
		//keterangan
		$id = $this->db->esc($id);
		$type = $this->db->esc($type);
		$idx = $this->db->esc($idx);
		$ip = substr($_SERVER['REMOTE_ADDR'],0,255);
		$user_agent = substr($_SERVER['HTTP_USER_AGENT'],0,255);
		$now = date("Y-m-d H:i:s");
		if($type == 'logout' || $type == 'login'){
			$sql = "insert into log (log_ip,log_user,log_waktu,log_user_agent,jenis) 
				values('".$ip."','".$id."','".$now."','".$user_agent."','".$type."')";
		}else{
			$sql = "insert into log (log_ip,log_user,log_waktu,log_user_agent,jenis,idusulan) 
				values('".$ip."','".$id."','".$now."','".$user_agent."','".$type."','".$idx."')";
		}
		$this->db->query($sql);
		
	}
}
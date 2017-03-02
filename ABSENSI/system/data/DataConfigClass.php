<?php
class DataConfigClass{
 	 function DataConfigClass(){
		 $this->db = new DatabaseClass;
	 }
	 function getConf($conf){				
			$res = $this->db->query("select * from KONFIGURASI where KONFIG='".$this->db->esc($conf)."'"); 
			$data = $this->db->fetchObject($res);
			
			return $data->KONFIGVALUE;
		}
		
	  function setConf($conf,$val){				
			$this->db->query("update KONFIGURASI set KONFIGVALUE='".$this->db->esc($val)."' where KONFIG='".$this->db->esc($conf)."'");
		}
	
}
?>
<?php
class MysqliClass Extends DatabaseClass {	
	var $conected;
	var $con;
	var $sql;
	var $error;
	var $config;
	var $secur;
	
	
	function MysqliClass()
	  {
			$this->connected = false;	
			$this->config = new ConfigClass; 
			$this->con = @mysqli_connect($this->config->DB['HOST'], $this->config->DB['USER'], $this->config->DB['PASSWORD'],$this->config->DB['DATABASE']);
			
			if (!mysqli_connect_errno()){
				$this->connected = true;	
			}
						
		}
	
		
	
	function query($qry){ 
			$this->sql = $qry;
			if($this->config->writeLog){
				// write log
			}
			return @$this->con->query($qry);
	}	
	
	function fetchArray($qry){
			return @$qry->fetch_array(MYSQLI_BOTH);
	} 

	function fetchAssoc($qry){
			return @$qry->fetch_array(MYSQLI_ASSOC);
	} 

	function fetchObject($qry){
			return @$qry->fetch_object();
	}

	function numRows($qry){
			return @$qry->num_rows;
	}

	function numField($qry){
			return @$qry->lengths;
	}	  
	
	function getData($table){
			return $this->query("SELECT * FROM ".$table);
	}
	
	function getDataWhere($table,$wfield,$wvalue){
			return $this->query("SELECT * FROM ".$table." WHERE  ".$wfield." = '".$wvalue."'");
	}
	
	function affectedRow() {
		return @mysqli_affected_rows($this->con);
	}
	
	function insertId() {
		return @ mysqli_insert_id($this->con);
	}
	

}
?>
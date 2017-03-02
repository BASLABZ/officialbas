<?php
class MysqlClass Extends DatabaseClass {	
	var $conected;
	var $con;
	var $sql;
	var $error;
	var $host;
	var $user;
	var $password;
	var $database;
	var $config;
	var $secur;
	var $writeLog;
	
	
	function MysqlClass()
	  {
			$this->connected = false;	
			$this->config = new ConfigClass; 
						
			if ( $this->con = @mysql_connect(DB_HOST, DB_USER, DB_PASS)or die(new ErrorClass('Saat ini kami sedang melakukan perbaikan Database')) ){
				if(mysql_select_db(DB_NAME, $this->con)){
						$this->connected = true;	
				}
			}
						
		}		
	
	function query($qry){ 
			$this->sql = $qry;
			if($this->config->writeLog){
				// write log
			}
			return mysql_query($qry);
	}	
	
	function fetchArray($qry){
			return mysql_fetch_array($qry);
	} 

	function fetchAssoc($qry){
			return mysql_fetch_assoc($qry);
	} 

	function fetchObject($qry){
			return mysql_fetch_object($qry);
	}

	function numRows($qry){
			return mysql_num_rows($qry);
	}

	function numField($qry){
			return mysql_num_fields($qry);
	}	  
	
	function getData($table){
			return $this->query("SELECT * FROM ".$table);
	}
	
	function getDataWhere($table,$wfield,$wvalue){
			return $this->query("SELECT * FROM ".$table." WHERE  ".$wfield." = '".$wvalue."'");
	}
	
	function affectedRow(){
			return mysql_affected_rows($this->con);
	}	

	function fetchField($qry){
			return mysql_fetch_field($qry);
	} 	
	
	function fieldName($qry,$i) {
			return mysql_field_name($qry,$i);
	}
	
	function fieldType($qry,$i) {
			return mysql_field_type($qry,$i);
	}
	
}
?>
<?php
class MysqlClass {	
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
	
	function connect()
	  {
			$this->connected = false;	
			$this->config = new ConfigClass; 
			$host 		= ($this->host=='')?$this->config->DB['HOST']:$this->host;
			$user 		= ($this->user=='')?$this->config->DB['USER']:$this->user;
			$password 	= ($this->password=='')?$this->config->DB['PASSWORD']:$this->password;
			$database 	= ($this->database=='')?$this->config->DB['DATABASE']:$this->database;
			
			if ( $this->con = @mysql_connect($host, $user, $password) ){
				if(@mysql_select_db($database, $this->con)){
						$this->connected = true;	
						$this->createLog();
				}
			}
			
			
	}
	
	function disconnect(){
		if($this->connected == true){
			mysql_close($this->con);
			$this->connected = false;
		}
			
	}
	
	function createLog(){
		if($this->config->writeLog){
			@mysql_query ("CREATE TABLE IF NOT EXISTS `".$this->config->logTable."` (                     
						  `id` int(11) NOT NULL AUTO_INCREMENT,  
						  `timestamp` datetime DEFAULT NULL,     
						  `log` text,
						  `ip` varchar(25),
						  PRIMARY KEY (`id`))");
		}
	}	
	
	function query($qry){
		$this->connect(); 
		$this->sql = $qry;
		$res = @mysql_query($qry);
		$this->disconnect();	
		return $res;
	}	
	
	function fetchArray($qry){
		return @mysql_fetch_array($qry);
	} 
	
	function fetchRow($qry){
		return @mysql_fetch_row($qry);
	} 
	
	function fetchObject($qry){
		return @mysql_fetch_object($qry);
	}
	
	function numRows($qry){
		return @mysql_num_rows($qry);
	}
	
	function affectedRows($res){
		return @mysql_affected_rows($res);
	}
	
	function numField($qry){
		return @mysql_num_fields($qry);
	}	  
	
	function getData($table){
		return $this->query("SELECT * FROM ".$table);
	}
	
	function getDataWhere($table,$wfield,$wvalue){
		return $this->query("SELECT * FROM ".$table." WHERE  ".$wfield." = '".$this->esc($wvalue)."'");
	}
	
	function printLog(){ 
		$result = @mysql_query("SELECT * FROM `".$this->config->logTable."` ORDER BY timestamp DESC LIMIT 0,10");
		while($data = $this->fetchArray($result)){
			echo $data['timestamp']." : <br>".$data['log']."<br>".$data['ip']."<hr>";
		}
	}
	
	function esc($str) {
		return mysql_escape_string($str);
	}
}
?>
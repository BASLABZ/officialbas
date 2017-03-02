<?php
class FirebirdClass {	
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
			
			if ( $this->con = @ibase_connect($host.$database, $user, $password) ){				
						$this->connected = true;							
			}		
			
		}
	
	function disconnect(){
		if($this->connected == true){
			ibase_close($this->con);
			$this->connected = false;
		}
			
	}	
	
	function createLog(){
		if($this->config->writeLog){
			@ibase_query ("CREATE TABLE ".$this->config->logTable."` (                     
						  `id` int(11) NOT NULL PRIMARY KEY,  
						  `timestamp` date DEFAULT NULL,     
						  `log` varchar(1000),
						  `ip` varchar(25))");
			
		}
	}
	
	function query($qry){ 
		$this->connect(); 
		$this->sql = $qry;
		$res = 	@ibase_query($this->con, $qry);
		$this->disconnect();	
		return $res;
	}	
	
	function fetchArray($qry){
		return @ibase_fetch_assoc($qry);
	} 	
	
	function fetchRow($qry){
		return @ibase_fetch_row($qry);
	} 

	function fetchObject($qry){
		return @ibase_fetch_object($qry);
	}

	
	function numRows($qry){
			$x = 0;
			while($tmp = ibase_fetch_row($qry)){			
				$x++;
			}			
			return $x;
	}
	
		
	function affectedRows($res){
		return @ibase_affected_rows($res);
	}
	

	function numField($qry){
			return @ibase_num_fields($qry);
	}	  
	
	function getData($table){
			return $this->query("SELECT * FROM ".$table);
	}
	
	function getDataWhere($table,$wfield,$wvalue){
			return $this->query("SELECT * FROM ".$table." WHERE  ".$wfield." = '".$wvalue."'");
	}
	
	function printLog(){ 
		$result = @ibase_query("SELECT FIRST 10 * FROM `".$this->config->logTable."` ORDER BY timestamp DESC");
		while($data = $this->fetchArray($result)){
			echo $data['timestamp']." : <br>".$data['log']."<br>".$data['ip']."<hr>";
		}
	}
	
	function esc($str) {
		return addslashes($str);
	}
}

?>
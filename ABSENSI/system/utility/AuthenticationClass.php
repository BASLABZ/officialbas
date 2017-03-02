<?php
class AuthenticationClass
{	
	
	var $db;	
	var $group;
	var $sql;
	var $ssusrvar;
	var $sspassvar;
	var $timeout;
	
	function __construct()
	{
		$this->db 	 = new DatabaseClass();
		$this->encr  = new EncryptClass;
		$this->ssusrvar  = md5('ssusr');
		$this->sspassvar = md5('sspsw');
		$this->timeout = 60*60*60;
	}	
	
	
	function validLogin($usr,$pass)
	{
		$this->sql = "SELECT * FROM pengguna WHERE username='".$this->db->esc($usr)."' AND password='".$this->db->esc($pass)."'";
		$res 	= $this->db->query($this->sql);
		
		if($this->db->numRows($res) > 0 ){
			return true;
		}else{
			return false;
		}
	}
	
	function setCookie($name,$val)
  	{		
		setcookie($name, $val, time() + $this->timeout );
  	}
	
	

	function unsetCookie( $name ) {
		setcookie ($name, "", time() - 3600);
	} 
	
	
	
	function getExpire()
	{
		return $this->timeout;
	}
	
	function getDetail()
  	{
		$usr 	= $this->encr->decrypt(@$_SESSION[$this->ssusrvar]);
		$res 	= $this->db->query("SELECT * FROM pengguna WHERE username= '".$this->db->esc($usr)."' ");
		return  $this->db->fetchArray($res);						
	}

	function login($usr,$pass){
		if($this->validLogin($usr,$pass)){
			
			$_SESSION[$this->ssusrvar] = $this->encr->encrypt($usr); 
			$_SESSION[$this->sspassvar] = $this->encr->encrypt($pass); 
			$this->setCookie(md5('coousr'),$this->encr->encrypt($usr));
			$this->setCookie(md5('coopsw'),$this->encr->encrypt($pass));
			
			return true;
		}else{
			return false;
		}
	}
	
	
	function isAuth(){		
		$usr 	= $this->encr->decrypt(@$_SESSION[$this->ssusrvar]);
		$pass   = $this->encr->decrypt(@$_SESSION[$this->sspassvar]);
		$sql 	= "SELECT * FROM pengguna WHERE username='".$this->db->esc($usr)."' AND password='".$this->db->esc($pass)."'";
		$res 	= $this->db->query($sql);
		if($this->db->numRows($res) > 0 && $_SESSION[$this->ssusrvar] == $_COOKIE[md5('coousr')] ){
			return true;
		}else{
			return false;
		}
	}
	
	function logout(){
		unset($_SESSION[$this->ssusrvar]);
		unset($_SESSION[$this->sspassvar]);		
		$this->unsetCookie(md5('coousr'));
		$this->unsetCookie(md5('coopsw'));
	}
	
	
	
}

?>
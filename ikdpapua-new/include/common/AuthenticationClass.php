<?php
class AuthenticationClass
{	
	
	var $db;	
	var $group;
	var $sql;
	var $ssusrvar;
	var $ssusridvar;
	var $sspassvar;
	var $sshakvar;
	var $timeout;
	
	// hak akses md5(concat(username,hak_md5))
	// passwd md5(concat(username,passwd_md5))
	// ojo lali
	
	var $hak = Array('73acd9a5972130b75066c82595a1fae3'=>'ADMIN',
				 '986496ca5b23669b8661171566a167c3'=>'OPERATOR',
				 '1006e797dd16d1e7eacfc449685be47e'=>'KABUPATEN');	 
	var $sHak = Array('73acd9a5972130b75066c82595a1fae3'=>'Administrator',
				 '986496ca5b23669b8661171566a167c3'=>'Operator BPKAD',
				 '1006e797dd16d1e7eacfc449685be47e'=>'Kabupaten/Kota');
				 
	function AuthenticationClass($owner)
	{
		$this->db 	 = $owner->db;
		$this->scr	 = $owner->scr;
		$this->encr  = new EncryptClass;
		$this->ssusridvar  = md5('ssusrid');
		$this->ssusrvar  = md5('ssusr');
		$this->sspassvar = md5('sspsw');
		$this->sshakvar  = md5('sshak');
		$this->timeout = 60*60*60;		

	}	
	
	
	function validLogin($usr,$pass)
	{
		$this->sql = "SELECT * FROM users WHERE md5(username)='".$this->scr->filter($usr)."' AND pass=md5(concat(username,'".$this->scr->filter($pass)."'))";
		$res 	= $this->db->query($this->sql);
		if($this->db->numRows($res) > 0 ){
			$data = $this->db->fetchArray($res);
			$_SESSION[$this->ssusrvar] = $this->encr->encrypt($data['username']); 
			$_SESSION[$this->sspassvar] = $this->encr->encrypt($pass); 			
			$_SESSION[$this->ssusridvar] = $data['iduser'];
			$_SESSION[$this->sshakvar] = $data['hak'];
			return true;
		}else{
			return false;
		}
	}
	
	function getExpire()
	{
		return $this->timeout;
	}
	/*
	function getDetail()
  	{
		$usr 	= $this->encr->decrypt($_SESSION[$this->ssusrvar]);
		$sql	= "SELECT * FROM users WHERE md5(md5(username))= '$usr' ";
		$res 	= $this->db->query($sql);
		return  $this->db->fetchArray($res);						
	}
	*/
	
	
	function login($usr,$pass){
		if($this->validLogin($usr,$pass)){
			$this->sql = "
				INSERT INTO users_log SET
				username='".$this->getUserVar()."',
				waktu=NOW(),
				ip='".(isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR'])."'
				
				";
			$res = $this->db->query($this->sql);		
			return true;
		}else{
			return false;
		}
	}
	
	
	function isAuth(){	
		if (!isset($_SESSION[$this->ssusrvar])) return false;
		$usr 	= $this->encr->decrypt($_SESSION[$this->ssusrvar]);
		$pass 	= $this->encr->decrypt($_SESSION[$this->sspassvar]);
		$this->sql = "SELECT * FROM users WHERE username='".$this->scr->filter($usr)."' AND pass=md5(concat(username,'".$this->scr->filter($pass)."'))";
		
		$res 	= $this->db->query($this->sql);
		if($this->db->numRows($res) > 0){
			$data = $this->db->fetchArray($res);
			$_SESSION[$this->ssusridvar] = $data['iduser'];
			$_SESSION[$this->sshakvar] = $data['hak'];
			return true;
		}else{
			return false;
		}
	}
	
	function logout(){
		session_unset();		
	}
	
	function getHak($user,$hash) {
		$hak = '';
		foreach ($this->hak as $key => $val) {
			if (md5($user.$key)==$hash) return $val;
		}
		return $hak;
	}
	
	function getSHak($user,$hash) {
		$sHak = '';
		foreach ($this->sHak as $key => $val) {
			if (md5($user.$key)==$hash) return $val;
		}
		return $sHak;
	}

	function getMD5Hak($user,$hash) {
		$hak = '';
		foreach ($this->hak as $key => $val) {
			if (md5($user.$key)==$hash) return $key;
		}
		return $hak;
	}	
	
	function isGranted($arrHak) {
		$hak = $this->getHakVar();
		if (is_array($arrHak)) {
			return in_array($hak,$arrHak);
		} else {
			return ($hak==$arrHak);
		}
	
	}
	
	function getHakVar() {
		return $this->getHak($this->encr->decrypt($_SESSION[$this->ssusrvar]),$_SESSION[$this->sshakvar]);
	}
	
	function getUserIDVar() {
		return $_SESSION[$this->ssusridvar];
	}

	function getKodePemda() {
		$result = '';
		if ($this->getHakVar()=='KABUPATEN') {
                        $sql = "SELECT kodepemda FROM users_kab WHERE iduser=".$this->getUserIDVar();
                        $res = $this->db->query($sql);
                        if ($tmpdata = $this->db->fetchArray($res)) $result = $tmpdata['kodepemda'];
                }
		return $result;
	}
	
	function getUserVar() {
		return $this->encr->decrypt($_SESSION[$this->ssusrvar]);
	}
	
	function saveState() {
		$_SESSION['POST'] = isset($_POST)?$_POST:Array();
		$_SESSION['URL'] = $_SERVER['PHP_SELF'];
		$_SESSION['QUERY'] = $_SERVER['QUERY_STRING'];
	}

	
	
}

?>

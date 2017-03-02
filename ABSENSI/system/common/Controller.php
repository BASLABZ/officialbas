<?php
class Controller{
	var $data;
	var $user;
	
	function __construct(){
		$this->db 		= new MysqlClass; // DatabaseClass;
		$this->cnf 		= new ConfigClass();
		$this->auth 	= new AuthenticationClass();
		$this->user 	= $this->auth->getDetail();
	}
	function module($str){
		if(file_exists("system/controller/".$str.".php")){
			include("system/controller/".$str.".php");
		}else{
			die(include("system/error/404.php"));
		}
	}
	function library($str){
		if(file_exists("system/library/".$str.".php")){
			include("system/library/".$str.".php");
		}else{
			die(include("system/error/404.php"));
		}
	}
	function view($str){
		if(file_exists("system/view/".$str.".php")){
			include("system/view/".$str.".php");
		}else{
			die(include("system/error/404.php"));
		}
	}
	function template($view, $template=''){
		$this->data['view'] = $view;
		if(file_exists("system/view/themes/".$template.".php")){
			include("system/view/themes/".$template.".php");
		}else{
			die(include("system/error/404.php"));
		}
	}
	
	function esc($str) {
		return $this->db->esc($str);
	}
	
	function report($template=''){
		set_time_limit(0);
		
		if(file_exists("system/report/".$template.".php")){
			include("system/report/".$template.".php");
		}else{
			die(include("system/error/404.php"));
		}
	}
	
	function ceklogin(){
		if($this->auth->isAuth() <> '1'){
			header('Location: '.$this->cnf->ROOTDIR.'');	
		}	
	}
} 
<?php
class AutoloadClass
{
	function __construct(){
		$this->cnf = new ConfigClass();
		$this->init();	
	}	
	function init(){
		//Load Library	
		if(count($this->cnf->LIB_AUTOLOAD) <> 0){
			foreach($this->cnf->LIB_AUTOLOAD as $row){
				if(file_exists('system/library/'.$row.'.php')){
					include('system/library/'.$row.'.php');	
				}else{
					die('Autoload library file not found');	
				}
			}	
		}
	}
}
?>
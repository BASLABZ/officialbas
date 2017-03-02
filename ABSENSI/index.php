<?php
session_start();
define('GI','1',true);
include("inc.php");
class index extends Controller{
	function __construct(){
		parent::__construct();
		//$auto = new AutoloadClass();
		$this->init();
	}
	function init(){
@			$pg = trim($_GET['pg']);
			
			if (empty($pg)){
				if(file_exists("system/controller/".$this->cnf->ROUTE.".php")){
					$class = $this->cnf->ROUTE;
					if(class_exists($class))
					{				
						new $class();
					}
				}
				else{ 
					$this->view('error404');
				}
			}
			else
			{
				
				if(file_exists("system/controller/".$pg.".php")){
					$class = $pg;
					if(class_exists($class))
					{				
						new $class();
					}
				}
				else{ 
					$this->view('error404');
				}
			}
			
	}	
}
new index();
?>
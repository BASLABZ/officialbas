<?php
class ConfigClass 
{	
  var $writeLog, $DB;
  
  function __CONSTRUCT()
  	{	  	
	  /* Database */	
	  if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
	  if (!defined('DB_USER')) define('DB_USER', 'root');
	  if (!defined('DB_PASS')) define('DB_PASS', 'root');
	  if (!defined('DB_NAME')) define('DB_NAME', 'ikd_papua');
	  /* Theme */	  
	  if (!defined('HOST')) define('HOST', "http://".$_SERVER['HTTP_HOST']);
	  if (!defined('ROOT_URL')) define('ROOT_URL', HOST."/PAPUA/ikdpapua-new/");
	  if (!defined('THEME')) define('THEME', 'default');
	  if (!defined('THEME_URL')) define('THEME_URL', ROOT_URL."themes/".THEME."/");
	  if (!defined('ROOT_PATH')) define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']."/PAPUA/ikdpapua-new/");
	  /* Security */  
	  error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
	  if (!defined('DISPLAY_ERRORS')) define('DISPLAY_ERRORS', true);

	  $this->init();	   
	  
	}		

	function init(){	   	
	  (DISPLAY_ERRORS)?ini_set('display_errors','1'):ini_set('display_errors','0');  	 
	  $this->DB['HOST'] = DB_HOST;
	  $this->DB['USER'] = DB_USER;
	  $this->DB['PASSWORD'] = DB_PASS;
	  $this->DB['DATABASE'] = DB_NAME;
		
	}
	
}
?>

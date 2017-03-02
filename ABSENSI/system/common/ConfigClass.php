<?php
class ConfigClass
{	
  function ConfigClass()
  	{	  	
	  /* Database */		
		$this->DB['HOST']	    	= "localhost";
		$this->DB['USER']			= "root";
		$this->DB['PASSWORD']		= "";
		$this->DB['DATABASE'] 		= "absensi_presensi";	  
	  /* log */
		$this->writeLog			= false;
		$this->logTable			= "log";
	  /* Theme */	  
		$this->HOST				= "http://".$_SERVER['HTTP_HOST']."absensi";
		$this->ROOTDIR			= "";
	  /* Timezone*/
	    $this->TIMEZONE			= "Asia/Jayapura";
	  /* Security */
	  	$this->ENCRYPT			= false;	  
	  	$this->DISPLAY_ERRORS	= false;
	  /* Routes*/
	  	$this->ROUTE			= 'login';
	  /* Autoload */
	  	$this->MOD_AUTOLOAD		= array('menu');
		$this->LIB_AUTOLOAD		= array('date');
	  	$this->init();
			  	  	  
	}	
	
	function init(){
	  ($this->TIMEZONE <> '')?date_default_timezone_set($this->TIMEZONE):'';	
	  ($this->DISPLAY_ERRORS)?ini_set('display_errors','1'):ini_set('display_errors','0');
	  ini_set('upload_max_filesize','5M');
	  ini_set('post_max_size','5M');
	}
	
	
}
?>
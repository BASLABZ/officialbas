<?php
class SCP{
	
	var $filter; 
	
	
		function filter($str){
			if(get_magic_quotes_gpc()){
				   $str = stripcslashes($str);
				 }
			   $str = 											 
											 utf8_decode(
											 addslashes($str));   
			   $forbidstr = array(";","select","insert","#","'","\\\\","\*");   
			   foreach( $forbidstr as $fbd => $prs){
					$str = eregi_replace($prs,'',$str);
				  }  
			   return mysql_real_escape_string($str);
		}		
		
		function cleanRequest($str)
		{		     
		   return $this->filter($str);
		}		
		
		function cleanAllRequest(){
				# REQUEST
				foreach( $_REQUEST as $key => $val)
				{
				  $_REQUEST[$key] = $this->filter($val);		  
				} 		
				# POST
				foreach( $_POST as $key => $val)
				{
				  $_POST[$key] = $this->filter($val);	 		  
				} 	
				# GET
				if (isset($_GET)){
				foreach( $_GET as $key => $val)
				{
				  $_GET[$key] = $this->filter($val);			
				} 
				}
				# SESSION	
				if (isset($_SESSION)){
					foreach( $_SESSION as $key => $val)
					{
					  $_SESSION[$key] = $this->filter($val);	  		  
					} 
				}
	
		}
		
}
?>
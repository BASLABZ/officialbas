<?php
class SecurityClass{
	
	var $filter; 
	
	
		function filter($str){
				
				
				//if(get_magic_quotes_gpc()){
				   $str = stripcslashes($str);
				// }
			
			   $str = utf8_decode(addslashes($str));   
			  	/*
			   $forbidstr = array(";","select","insert","#","'","\\\\","\*");   
			   foreach( $forbidstr as $fbd => $prs){
					$str = str_replace($prs,'',$str);
				}
				*/
			
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
					if(!is_array($_REQUEST[$key]))	
				  $_REQUEST[$key] = $this->filter($val);		  
				} 
						
				# POST
				foreach( $_POST as $key => $val)
				{
					if(!is_array($_POST[$key]))	
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
		
		function track(){			
			echo "<pre> POST : "; print_r($_POST);echo "</pre>";
			echo "<pre> GET : "; print_r($_GET);echo "</pre>";		
			echo "<pre> REQUEST : "; print_r($_REQUEST);echo "</pre>";
			echo "<pre> SESSION : "; print_r($_SESSION);echo "</pre>";
		}
		
}
?>
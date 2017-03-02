<?php
class report 
{
	function parse_report($str){
		ob_start();
			include('applikasi/report/'.$str.'.php');
			$result = ob_get_clean();
		return $result;
	}	
}
?>
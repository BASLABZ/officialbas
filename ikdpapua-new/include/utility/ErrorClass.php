<?php
class ErrorClass{

	function __construct($errorstring) { 
		$self::showError($errorstring); 
	}
	
	function ErrorClass($errorstring) { 
		$self::showError($errorstring); 
	}
	
	public static function showError($errorstring){
		$cnf = new ConfigClass;
		
		$themepath = ROOT_PATH.'themes/error/';
		$themefile = $themepath.'index.html';

		$themeurl = ROOT_URL.'themes/error/';

		if(file_exists($themefile)){		
			$define = array(		
				'rooturl' => ROOT_URL,
				'themeurl' => $themeurl,
				'pagetitle' => 'GIPANEL System Report',
				'error_message' => ($errorstring <> '')?$errorstring:'Saat Ini Sedang Dilakukan Perbaikan.',
				'additional_message' => '',
				'sorry_text' => 'Mohon maaf atas ketidak nyaman ini, kami akan melakukan perbaikan secepatnya.<br/>Silahkan coba kembali beberapa saat lagi.',
			);

			$html = @file($themefile);
			$html = implode("", $html);
			foreach($define as $key => $value){
				$html = str_replace('{'.$key.'}', $value, $html);
			}
			print($html);
			die();
		}
		else{
			print('<br/> <h2 align=center> '.$errorstring.'</h2>');
			die();
		}	
	}
}
?>
<?php
defined('im') or die('404');

$_SESSION['DEBUG']=true;

set_error_handler('errhandler',E_ALL);
function errhandler($number,$string,$file,$line,$context){
	
	$themepath = dirname($_SERVER['SCRIPT_FILENAME']).'/themes/error/';
	$themefile = $themepath.'index.html';

	$errorstring = "error : ($number) $string <br /> $file  online:  $line";

	if(file_exists($themefile)){		
		$define = array(	
			'rooturl' => dirname($_SERVER['PHP_SELF']).'/',
			'pagetitle' => 'GIPANEL System Report',
			'error_message' => ($_SESSION['DEBUG']===true)?$errorstring:'Saat Ini Sedang Dilakukan Perbaikan.',
			'additional_message' => '',
			'sorry_text' => 'Mohon maaf atas ketidak nyaman ini, kami akan melakukan perbaikan secepatnya.<br/>Silahkan coba kembali beberapa saat lagi.',
		);

		$html = @file($themefile);
		$html = implode("", $html);
		foreach($define as $key => $value){
			$html = str_replace('{'.$key.'}', $value, $html);
		}
		die($html);
	}
	else{
		print('<br/> <h2 align=center> '.$errorstring.'</h2>');
	}
	
}



?>
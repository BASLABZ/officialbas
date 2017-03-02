<?php
	include("system/common/ConfigClass.php");
	include("system/common/Controller.php");
	//include("system/common/AutoLoadClass.php");
	include("system/data/MysqlClass.php");
	include("system/data/DatabaseClass.php");
	include("system/utility/EncryptClass.php");
	include("system/utility/SecurityClass.php");
	include("system/utility/AuthenticationClass.php");
	include("system/utility/enkripsi.php");
	
	if ($handle = opendir('system/controller')) {
    while (false !== ($files = readdir($handle))) {
        if ($files != "." && $files != "..") {			
			$pattern = '/\b.php\b/i';
			if(preg_match($pattern, $files)){
				include('system/controller/'.$files);			
			}
        }
    }
    closedir($handle);
}	
?>
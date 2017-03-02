<?php
session_start();

define('im', true);
error_reporting(E_ALL);

include('error.php');

include('include/common/ConfigClass.php');
include('include/common/TemplateClass.php');
include('include/data/DatabaseClass.php');
include('include/data/MysqliClass.php');

include('include/utility/ErrorClass.php');
include('include/utility/EncryptClass.php');
include('include/utility/SecurityClass.php');	
include('include/utility/StringClass.php');

include('include/common/AuthenticationClass.php');

include('include/utility/DateClass.php');
include('include/utility/DownloadClass.php');
include('include/utility/UrlClass.php');
include('include/utility/UploadClass.php');
include('include/utility/ImageClass.php');
include('include/utility/phpQueryClass.php');
include('include/utility/XmlStreamerClass.php');
include('include/utility/KomandanParserClass.php');
include('include/utility/SimpleParserClass.php');

include('include/component/CounterClass.php');
include('include/component/DbGridClass.php');
include('include/component/PaginateClass.php');

// auto load module
include('include/common/Modul.php'); #priority base class


if ($handle = opendir('modules')) {
    while (false !== ($files = readdir($handle))) {
        if ($files != "." && $files != "..") {			
			$pattern = '/\wClass\.php$/i';
			if(preg_match($pattern, $files)){
				//echo 'modules/'.$files;
				include('modules/'.$files);			
			}
        }
    }
    closedir($handle);
}

?>
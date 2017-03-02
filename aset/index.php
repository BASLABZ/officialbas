 <?php
			if(empty( $_GET['p']) ||  $_GET['p'] ==""){
			$_GET['p'] = "main.php";
			}
			if(file_exists( $_GET['p'].".php")){
			include  $_GET['p'].".php";
			}else {
			include"main.php";
			}   
			?> 